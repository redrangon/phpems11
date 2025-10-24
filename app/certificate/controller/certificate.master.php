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
		$action = $this->ev->url(3);
		if(!method_exists($this,$action))
		$action = "index";
		$this->$action();
		exit;
	}

	private function modify()
	{
		$ceid = $this->ev->get('ceid');
		$ce = $this->ce->getCeById($ceid);
		$this->tpl->assign('ce',$ce);
		if($this->ev->get('modifycertificate'))
		{
			$args = $this->ev->get('args');
			$args['cetime'] = strtotime($args['cetime']);
			$this->ce->modifyCe($ceid,$args);
			$message = array(
				'statusCode' => 200,
				"message" => "操作成功",
				"callbackType" => "forward",
			    "forwardUrl" => "reload"
			);
			\PHPEMS\ginkgo::R($message);
		}
		else
		$this->tpl->display('certificate_edit');
	}

	private function del()
	{
		$ceid = $this->ev->get('ceid');
		$this->ce->delCe($ceid);
		$message = array(
			'statusCode' => 200,
			"message" => "操作成功",
			"callbackType" => "forward",
		    "forwardUrl" => "reload"
		);
		\PHPEMS\ginkgo::R($message);
	}

	private function add()
	{
		if($this->ev->get('addcertificate'))
		{
			$args = $this->ev->get('args');
			$args['cetime'] = strtotime($args['cetime']);
			$this->ce->addCe($args);
			$message = array(
				'statusCode' => 200,
				"message" => "操作成功",
				"callbackType" => "forward",
			    "forwardUrl" => "index.php?certificate-master-certificate"
			);
			\PHPEMS\ginkgo::R($message);
		}
		else
		$this->tpl->display('certificate_add');
	}

	private function modifyqueue()
	{
		$ceqid = $this->ev->get('ceqid');
		$status = $this->ev->get('status');
		$this->ce->modifyCeQueue($ceqid,array('ceqstatus' => $status));
		$message = array(
			'statusCode' => 200,
			"message" => "操作成功",
			"callbackType" => "forward",
		    "forwardUrl" => "reload"
		);
		\PHPEMS\ginkgo::R($message);
	}

	private function outdata()
	{
		$search = $this->ev->get('search');
		$ceid = $this->ev->get('ceid');
		$ce = $this->ce->getCeById($ceid);
		$args = array();
		$args[] = array("AND","ceqceid = :ceqceid","ceqceid",$ceid);
		if($search['username'])
		{
			$user = $this->_user->getUserByUserName($search['username']);
			if($user)
			{
				$args[] = array("AND","cequserid = :cequserid","cequserid",$user['userid']);
			}
		}
		if($search['ceqstatus'] || $search['ceqstatus'] === '0')
		{
			$args[] = array("AND","ceqstatus = :ceqstatus","ceqstatus",$search['ceqstatus']);
		}
		if($search['stime'])
		{
			$args[] = array("AND","ceqtime >= :sceqtime","sceqtime",strtotime($search['stime']));
		}
		if($search['etime'])
		{
			$args[] = array("AND","ceqtime <= :eceqtime","eceqtime",strtotime($search['etime']));
		}
		$certificates = $this->ce->getCeQueuesByArgs($args);
		$r = array();
		foreach($certificates as $p)
		{
			$tmp = array(
				'usertruename' => iconv("UTF-8","GBK",$p['ceqinfo']['usertruename']),
				'userpassport' => ':'.iconv("UTF-8","GBK",$p['ceqinfo']['userpassport']),
				'userphone' => iconv("UTF-8","GBK",$p['ceqinfo']['userphone']),
				'useraddress' => iconv("UTF-8","GBK",$p['ceqinfo']['useraddress']),
				'time' => date('Y-m-d',$p['ceqtime'])
			);
			$r[] = $tmp;
		}
		$fname = 'data/cert/'.TIME.'-'.$ceid.'-cert.xlsx';
		M('files')->mdir(PEPATH.'/data/cert/');
		if(M('xlsx')->putExcelContent(PEPATH.'/'.$fname,$r))
		{
			$message = array(
				'statusCode' => 200,
				"message" => "导出成功，转入下载页面，如果浏览器没有相应，请<a href=\"{$fname}\">点此下载</a>",
				"callbackType" => 'forward',
				"forwardUrl" => "{$fname}"
			);
		}
		else
		{
			$message = array(
				'statusCode' => 300,
				"message" => "导出失败，数据不能为空"
			);
		}
		\PHPEMS\ginkgo::R($message);
	}

	private function queue()
	{
		$page = intval($this->ev->get('page'));
		$search = $this->ev->get('search');
		$this->u = '';
		if($search)
		{
			$this->tpl->assign('search',$search);
			foreach($search as $key => $arg)
			{
				$this->u .= "&search[{$key}]={$arg}";
			}
		}
		$this->tpl->assign('search',$search);
		$this->tpl->assign('u',$this->u);
		$ceid = $this->ev->get('ceid');
		$ce = $this->ce->getCeById($ceid);
		$args = array();
		$args[] = array("AND","ceqceid = :ceqceid","ceqceid",$ceid);
		if($search['username'])
		{
			$user = $this->user->getUserByUserName($search['username']);
			if($user)
			{
				$args[] = array("AND","cequserid = :cequserid","cequserid",$user['userid']);
			}
			else
			{
				$args[] = array("AND","cequserid = 0");
			}
		}
		if($search['ceqstatus'] || $search['ceqstatus'] === '0')
		{
			$args[] = array("AND","ceqstatus = :ceqstatus","ceqstatus",$search['ceqstatus']);
		}
		if($search['stime'])
		{
			$args[] = array("AND","ceqtime >= :sceqtime","sceqtime",strtotime($search['stime']));
		}
		if($search['etime'])
		{
			$args[] = array("AND","ceqtime <= :eceqtime","eceqtime",strtotime($search['etime']));
		}
		$certificates = $this->ce->getCeQueueList($args,$page,10);
		$this->tpl->assign('certificates',$certificates);
		$this->tpl->assign('status',array('申请中','已受理','已出证','申请被驳回'));
		$this->tpl->assign('page',$page);
		$this->tpl->assign('ce',$ce);
		$this->tpl->display('certificate_queue');
	}

	private function index()
	{
		$page = intval($this->ev->get('page'));
		$certificates = $this->ce->getCeList(array(),$page,10);
		$this->tpl->assign('certificates',$certificates);
		$this->tpl->assign('page',$page);
		$this->tpl->display('certificate');
	}
}


?>
