<?php
 namespace PHPEMS;
/*
 * Created on 2016-5-19
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
class action extends app
{
	public function display()
	{
        $action = M('ev')->url(3);
		if(!method_exists($this,$action))
		$action = "index";
		$this->$action();
		exit;
	}

	private function openit()
	{
		$basicid = M('ev')->get('basicid');
		$basic = M('basic','exam')->getBasicById($basicid);
		if(!$basic)
		{
			$message = array(
				'statusCode' => 300,
				"message" => "操作失败，此考场不存在"
			);
			\PHPEMS\ginkgo::R($message);
		}
		if((!$basic['basicexam']['allowgroup']) || (strpos(','.$basic['basicexam']['allowgroup'].',',",{$this->user['sessiongroupid']},") !== false))
		$allowopen = 1;
		if(!$allowopen)
		{
			$message = array(
				'statusCode' => 300,
				"message" => "您做所在的用户组不能开通本考场"
			);
			\PHPEMS\ginkgo::R($message);
		}
		$userid = $this->user['userid'];
		if(M('basic','exam')->getOpenBasicByUseridAndBasicid($userid,$basicid))
		{
			$message = array(
				'statusCode' => 300,
				"message" => "您已经开通了本考场"
			);
		}
		if($basic['basicdemo'])
		{
			$time = 365*24*3600;
		}
		else
		{
			$opentype = intval(M('ev')->get('opentype'));
			$price = 0;
			if(trim($basic['basicprice']))
			{
				$price = array();
				$basic['basicprice'] = explode("\n",$basic['basicprice']);
				foreach($basic['basicprice'] as $p)
				{
					if($p)
					{
						$p = explode(":",$p);
						$price[] = array('time'=>intval($p[0]),'price'=>intval($p[1]));
					}
				}
			}
			if(!$price[$opentype])$t = $price[0];
			else
			$t = $price[$opentype];
			$time = $t['time']*24*3600;
			$score = $t['price'];
			$user = M('user','user')->getUserById($this->user['userid']);
			if($user['usercoin'] < $score)
			{
				$message = array(
					'statusCode' => 300,
					"message" => "操作失败，您的积分不够"
				);
				\PHPEMS\ginkgo::R($message);
			}
			else
			{
				$args = array("usercoin" => $user['usercoin'] - $score);
				M('user','user')->modifyUserInfo($this->user['userid'],$args);
                M('consume','bank')->addConsumeLog(array('conluserid' => $this->user['userid'],'conlcost' => $score,'conltype' => 1,'conltime' => TIME,'conlinfo' => '开通考场'.$basic['basic']."{$t['time']}天"));
            }
		}
		$args = array('obuserid'=>$userid,'obbasicid'=>$basicid,'obendtime'=>TIME + $time);
		M('basic','exam')->openBasic($args);
		$message = array(
			'statusCode' => 200,
			"message" => "操作成功",
			"callbackType" => "forward",
		    "forwardUrl" => "index.php?exam-app"
		);
		\PHPEMS\ginkgo::R($message);
	}

	private function coupon()
	{
		if(M('ev')->get('coupon'))
		{
			$couponsn = strtoupper(M('ev')->get('couponsn'));
			$r = M('coupon','bank')->useCouponById($couponsn,$this->user['userid']);
			if(!$r)
			$message = array(
				'statusCode' => 300,
				"message" => "错误的代金券"
			);
			elseif($r == '301')
			$message = array(
				'statusCode' => 300,
				"message" => "使用过的代金券"
			);
			elseif($r == '302')
			$message = array(
				'statusCode' => 300,
				"message" => "过期的代金券"
			);
			else
			$message = array(
				'statusCode' => 200,
				"message" => "充值成功",
				"callbackType" => "forward",
			    "forwardUrl" => "reload"
			);
		}
		else
		$message = array(
			'statusCode' => 300,
			"message" => "操作失败"
		);
		\PHPEMS\ginkgo::R($message);
	}

	private function detail()
	{
		M('basic','exam')->delOpenPassBasic($this->user['userid']);
		$basicid = M('ev')->get('basicid');
		$basic = M('basic','exam')->getBasicById($basicid);
		$areas = M('area','exam')->getAreaList();
		$price = 0;
		if(trim($basic['basicprice']))
		{
			$price = array();
			$basic['basicprice'] = explode("\n",$basic['basicprice']);
			foreach($basic['basicprice'] as $p)
			{
				if($p)
				{
					$p = explode(":",$p);
					$price[] = array('time'=>$p[0],'price'=>$p[1]);
				}
			}
			M('tpl')->assign('price',$price);
		}
		if((!$basic['basicexam']['allowgroup']) || (strpos(','.$basic['basicexam']['allowgroup'].',',",{$this->user['sessiongroupid']},") !== false))
		$allowopen = 1;
		$isopen = M('basic','exam')->getOpenBasicByUseridAndBasicid($this->user['userid'],$basicid);
        $subject = M('basic','exam')->getSubjectById($basic['basicsubjectid']);
        $args = array();
        $args[] = array("AND","basicclosed = 0");
        $basics = M('basic','exam')->getBasicsByArgs($args,5);
        M('tpl')->assign('news',$basics);
        M('tpl')->assign('subject',$subject);
		M('tpl')->assign('isopen',$isopen);
		M('tpl')->assign('areas',$areas);
		M('tpl')->assign('allowopen',$allowopen);
		M('tpl')->assign('basic',$basic);
		M('tpl')->display('basics_detail');
	}

	private function index()
	{
        $search = M('ev')->get('search');
        $page = M('ev')->get('page');
        $page = $page > 1?$page:1;
        $subjects = M('basic','exam')->getSubjectList();
		$args = array();
		if($search['basicdemo'])$args[] = array("AND","basicdemo = :basicdemo",'basicdemo',$search['basicdemo']);
		if($search['keyword'])$args[] = array("AND","basic LIKE :basic",'basic',"%{$search['keyword']}%");
		if($search['basicareaid'])$args[] = array("AND","basicareaid = :basicareaid","basicareaid",$search['basicareaid']);
		if($search['basicsubjectid'])$args[] = array("AND","basicsubjectid = :basicsubjectid",'basicsubjectid',$search['basicsubjectid']);
		if($search['basicapi'])$args[] = array("AND","basicapi = :basicapi",'basicapi',$search['basicapi']);
        $basics = M('basic','exam')->getBasicList($args,$page,15);
        $areas = M('area','exam')->getAreaList();
        $args = array();
        $args[] = array("AND","basictop = 1");
        $news = M('basic','exam')->getBasicsByArgs($args,5);
        M('tpl')->assign('news',$news);
        M('tpl')->assign('search',$search);
        M('tpl')->assign('areas',$areas);
        M('tpl')->assign('subjects',$subjects);
        M('tpl')->assign('basics',$basics);
        M('tpl')->display('basics');
	}
}


?>
