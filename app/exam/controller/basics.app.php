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
        $this->area = M('area','exam');
		$action = $this->ev->url(3);
		if(!method_exists($this,$action))
		$action = "index";
		$this->$action();
		exit;
	}

	private function openit()
	{
		$basicid = $this->ev->get('basicid');
		$basic = $this->basic->getBasicById($basicid);
		if(!$basic)
		{
			$message = array(
				'statusCode' => 300,
				"message" => "操作失败，此考场不存在"
			);
			\PHPEMS\ginkgo::R($message);
		}
		if((!$basic['basicexam']['allowgroup']) || (strpos(','.$basic['basicexam']['allowgroup'].',',",{$this->_user['sessiongroupid']},") !== false))
		$allowopen = 1;
		if(!$allowopen)
		{
			$message = array(
				'statusCode' => 300,
				"message" => "您做所在的用户组不能开通本考场"
			);
			\PHPEMS\ginkgo::R($message);
		}
		$userid = $this->_user['sessionuserid'];
		if($this->basic->getOpenBasicByUseridAndBasicid($userid,$basicid))
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
			$opentype = intval($this->ev->get('opentype'));
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
			$user = $this->user->getUserById($this->_user['sessionuserid']);
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
				$this->user->modifyUserInfo($this->_user['sessionuserid'],$args);
                M('consume','bank')->addConsumeLog(array('conluserid' => $this->_user['sessionuserid'],'conlcost' => $score,'conltype' => 1,'conltime' => TIME,'conlinfo' => '开通考场'.$basic['basic']."{$t['time']}天"));
            }
		}
		$args = array('obuserid'=>$userid,'obbasicid'=>$basicid,'obendtime'=>TIME + $time);
		$this->basic->openBasic($args);
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
		if($this->ev->get('coupon'))
		{
			$couponsn = strtoupper($this->ev->get('couponsn'));
			$r = M('coupon','bank')->useCouponById($couponsn,$this->_user['sessionuserid']);
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
		$this->basic->delOpenPassBasic($this->_user['sessionuserid']);
		$this->area = M('area','exam');
		$basicid = $this->ev->get('basicid');
		$basic = $this->basic->getBasicById($basicid);
		$areas = $this->area->getAreaList();
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
			$this->tpl->assign('price',$price);
		}
		if((!$basic['basicexam']['allowgroup']) || (strpos(','.$basic['basicexam']['allowgroup'].',',",{$this->_user['sessiongroupid']},") !== false))
		$allowopen = 1;
		$isopen = $this->basic->getOpenBasicByUseridAndBasicid($this->_user['sessionuserid'],$basicid);
        $subject = $this->basic->getSubjectById($basic['basicsubjectid']);
        $args = array();
        $args[] = array("AND","basicclosed = 0");
        $basics = $this->basic->getBasicsByArgs($args,5);
        $this->tpl->assign('news',$basics);
        $this->tpl->assign('subject',$subject);
		$this->tpl->assign('isopen',$isopen);
		$this->tpl->assign('areas',$areas);
		$this->tpl->assign('allowopen',$allowopen);
		$this->tpl->assign('basic',$basic);
		$this->tpl->display('basics_detail');
	}

	private function index()
	{
        $search = $this->ev->get('search');
        $page = $this->ev->get('page');
        $page = $page > 1?$page:1;
        $subjects = $this->basic->getSubjectList();
		$args = array();
		if($search['basicdemo'])$args[] = array("AND","basicdemo = :basicdemo",'basicdemo',$search['basicdemo']);
		if($search['keyword'])$args[] = array("AND","basic LIKE :basic",'basic',"%{$search['keyword']}%");
		if($search['basicareaid'])$args[] = array("AND","basicareaid = :basicareaid","basicareaid",$search['basicareaid']);
		if($search['basicsubjectid'])$args[] = array("AND","basicsubjectid = :basicsubjectid",'basicsubjectid',$search['basicsubjectid']);
		if($search['basicapi'])$args[] = array("AND","basicapi = :basicapi",'basicapi',$search['basicapi']);
        $basics = $this->basic->getBasicList($args,$page,15);
        $areas = $this->area->getAreaList();
        $args = array();
        $args[] = array("AND","basictop = 1");
        $news = $this->basic->getBasicsByArgs($args,5);
        $this->tpl->assign('news',$news);
        $this->tpl->assign('search',$search);
        $this->tpl->assign('areas',$areas);
        $this->tpl->assign('subjects',$subjects);
        $this->tpl->assign('basics',$basics);
        $this->tpl->display('basics');
	}
}


?>
