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
		$action = $this->ev->url(3);
		if(!method_exists($this,$action))
		$action = "index";
		$this->$action();
		exit;
	}

	public function img()
	{
		$ceqid = $this->ev->get('ceqid');
		$ceq = $this->ce->getCeQueueById($ceqid);
		$ce = $this->ce->getCeById($ceq['ceqceid']);
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
		$ceqid = $this->ev->get('ceqid');
		$ceq = $this->ce->getCeQueueById($ceqid);
		$ce = $this->ce->getCeById($ceq['ceqceid']);
		$this->tpl->assign('ce',$ce);
		$this->tpl->assign('ceq',$ceq);
		$this->tpl->display('certificate_detail');
	}

	private function apply()
	{
		$ceid = $this->ev->get('ceid');
		$ce = $this->ce->getCeById($ceid);
		if($this->ev->get('apply'))
		{
			$user = $this->user->getUserById($this->_user['sessionuserid']);
			if($user['usercoin'] < $ce['ceprice'])
			{
				$message = array(
					'statusCode' => 300,
					"message" => "余额不足，请到个人中心充值"
				);
				\PHPEMS\ginkgo::R($message);
			}
			$cq = $this->ce->getCeQueueByArgs(array(
				array("AND","cequserid = :cequserid","cequserid",$this->_user['sessionuserid']),
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
					$eh = M('favor','exam')->getExamHistoryByArgs(array(array("AND","ehuserid = :ehuserid","ehuserid",$this->_user['sessionuserid']),array("AND","ehispass = 1"),array("AND","ehtype = 2"),array("AND","ehbasicid = :ehbasicid","ehbasicid",$basicid)));
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
			$info = $this->ev->get('args');
            if(!$info['useraddress'] || !$info['userphone'])
            {
                $message = array(
                    'statusCode' => 300,
                    "message" => "请填写地址和联系电话"
                );
                \PHPEMS\ginkgo::R($message);
            }
			$args = array();
			$args['cequserid'] = $this->_user['sessionuserid'];
			$args['ceqtime'] = TIME;
			$args['ceqstatus'] = 0;
			$args['ceqceid'] = $ceid;
			$args['ceqinfo'] = $info;
			$this->ce->addCeQueue($args);
			$coin = $user['usercoin'] - $ce['ceprice'];
			$this->user->modifyUserInfo($this->_user['sessionuserid'],array('usercoin' => $coin));
			M('consume','bank')->addConsumeLog(array('conluserid' => $this->_user['sessionuserid'],'conlcost' => $ce['ceprice'],'conltype' => 1,'conltime' => TIME,'conlinfo' => '申请证书'.$ce['cetitle']));
			$user = $this->user->getUserById($this->_user['sessionuserid']);
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
			$this->tpl->assign('ce',$ce);
			$this->tpl->display('certificate_apply');
		}
	}

	private function index()
	{
        $this->pg->isPhone = 1;
        $this->pg->target = 'class="ajax" data-target="certificate-list" data-page="certificate-list" ';
		$page = intval($this->ev->get('page'));
		$certificates = $this->ce->getCeList(array(),$page,10);
		$this->tpl->assign('certificates',$certificates);
		$this->tpl->assign('page',$page);
		$this->tpl->display('certificate');
	}
}


?>
