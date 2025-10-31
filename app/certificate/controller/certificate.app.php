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
		$this->gd = M('gd');
		$new = M('ce','certificate')->getCeQueueList(array(),1,10);
		M('tpl')->assign('news',$new['data']);
		$action = M('ev')->url(3);
		if(!method_exists($this,$action))
		$action = "index";
		$this->$action();
		exit;
	}

	public function img()
	{
		$ceqid = M('ev')->get('ceqid');
		$ceq = M('ce','certificate')->getCeQueueById($ceqid);
		$ce = M('ce','certificate')->getCeById($ceq['ceqceid']);
		header("Content-type: image/png");
		$setting = $ce['cetags'];
		foreach($ceq['ceqinfo'] as $key => $info)
		{
			$setting = str_replace('{'.$key.'}',$info,$setting);
		}
		$setting = str_replace('{ceqtime}',date('Y-m-d',$ceq['ceqtime']),$setting);
		$setting = str_replace('{ceqsn}',$ceq['ceqsn'],$setting);
		$imgsetting = array();
		$setting = explode("\n",$setting);
		foreach($setting as $s)
		{
			$s = explode(',',$s);
			$imgsetting[] = $s;
		}
		$this->gd->creatCertImg($ce['cetpl'],$imgsetting);
	}

	public function detail()
	{
		$ceqid = M('ev')->get('ceqid');
		$ceq = M('ce','certificate')->getCeQueueById($ceqid);
		$ce = M('ce','certificate')->getCeById($ceq['ceqceid']);
		$news = M('ce','certificate')->getCeList(array(),1,10);
		M('tpl')->assign('news',$news);
		M('tpl')->assign('ce',$ce);
		M('tpl')->assign('ceq',$ceq);
		M('tpl')->display('certificate_detail');
	}

	private function apply()
	{
		$ceid = M('ev')->get('ceid');
		$ce = M('ce','certificate')->getCeById($ceid);
		if(M('ev')->get('apply'))
		{
			$user = M('user','user')->getUserById($this->user['userid']);
			if($user['usercoin'] < $ce['ceprice'])
			{
				$message = array(
					'statusCode' => 300,
					"message" => "余额不足，请到个人中心充值"
				);
				\PHPEMS\ginkgo::R($message);
			}
			$cq = M('ce','certificate')->getCeQueueByArgs(array(
				array("AND","cequserid = :cequserid","cequserid",$this->user['userid']),
				array("AND","ceqceid = :ceqceid","ceqceid",$ceid),
				array("AND","ceqstatus < 3"),
				array("AND","ceqtime >= :ceqtime","ceqtime",TIME - $ce['cedays'] * 24 * 3600)
			));
			if($cq['ceqid'])
			{
				$message = array(
					'statusCode' => 300,
					"message" => "您已经申请过本证书了"
				);
				\PHPEMS\ginkgo::R($message);
			}
			$ce['cebasic'] = explode(',',$ce['cebasic']);
			foreach($ce['cebasic'] as $basicid)
			{
				if($basicid)
				{
					$eh = M('favor','exam')->getExamHistoryByArgs(array(array("AND","ehuserid = :ehuserid","ehuserid",$this->user['userid']),array("AND","ehispass = 1"),array("AND","ehtype = 2"),array("AND","ehbasicid = :ehbasicid","ehbasicid",$basicid)));
					if(!$eh['ehid'])
					{
						$message = array(
							'statusCode' => 300,
							"message" => "您需要通过考试后才能申请"
						);
						\PHPEMS\ginkgo::R($message);
					}
				}
			}
			$info = M('ev')->get('info');
            if(!$info['useraddress'] || !$info['userphone'])
            {
                $message = array(
                    'statusCode' => 300,
                    "message" => "请填写地址和联系电话"
                );
                \PHPEMS\ginkgo::R($message);
            }
			$args = array();
			$args['cequserid'] = $this->user['userid'];
			$args['ceqtime'] = TIME;
			$args['ceqstatus'] = 0;
			$args['ceqceid'] = $ceid;
			$args['ceqinfo'] = $info;
			M('ce','certificate')->addCeQueue($args);
			$coin = $user['usercoin'] - $ce['ceprice'];
			M('user','user')->modifyUserInfo($this->user['userid'],array('usercoin' => $coin));
			M('consume','bank')->addConsumeLog(array('conluserid' => $this->user['userid'],'conlcost' => $ce['ceprice'],'conltype' => 1,'conltime' => TIME,'conlinfo' => '申请证书'.$ce['cetitle']));
			$user = M('user','user')->getUserById($this->user['userid']);
			$message = array(
				'statusCode' => 200,
				"message" => "操作成功",
				"callbackType" => "forward",
			    "forwardUrl" => "index.php?certificate"
			);
			\PHPEMS\ginkgo::R($message);
		}
		else
		{
			$news = M('ce','certificate')->getCeList(array(),1,10);
			M('tpl')->assign('news',$news);
			M('tpl')->assign('ce',$ce);
			M('tpl')->display('certificate_apply');
		}
	}

	private function index()
	{
		header("location:index.php?certificate");
		exit();
		$page = intval(M('ev')->get('page'));
		$certificates = M('ce','certificate')->getCeList(array(),$page,10);
		$args = array();
		$args[] = array("AND","cequserid = :cequserid","cequserid",$this->user['userid']);		
		M('tpl')->assign('certificates',$certificates);
		M('tpl')->assign('page',$page);
		M('tpl')->display('certificate');
	}
}


?>
