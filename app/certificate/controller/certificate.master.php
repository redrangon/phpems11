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

	private function modify()
	{
		$ceid = M('ev')->get('ceid');
		$ce = M('ce','certificate')->getCeById($ceid);
		M('tpl')->assign('ce',$ce);
		if(M('ev')->get('modifycertificate'))
		{
			$args = M('ev')->get('args');
			$args['cetime'] = strtotime($args['cetime']);
			M('ce','certificate')->modifyCe($ceid,$args);
			$message = array(
				'statusCode' => 200,
				"message" => "操作成功",
				"callbackType" => "forward",
			    "forwardUrl" => "reload"
			);
			\PHPEMS\ginkgo::R($message);
		}
		else
		M('tpl')->display('certificate_edit');
	}

	private function del()
	{
		$ceid = M('ev')->get('ceid');
		M('ce','certificate')->delCe($ceid);
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
		if(M('ev')->get('addcertificate'))
		{
			$args = M('ev')->get('args');
			$args['cetime'] = strtotime($args['cetime']);
			M('ce','certificate')->addCe($args);
			$message = array(
				'statusCode' => 200,
				"message" => "操作成功",
				"callbackType" => "forward",
			    "forwardUrl" => "index.php?certificate-master-certificate"
			);
			\PHPEMS\ginkgo::R($message);
		}
		else
		M('tpl')->display('certificate_add');
	}

	private function modifyqueue()
	{
		$ceqid = M('ev')->get('ceqid');
		$status = M('ev')->get('status');
		M('ce','certificate')->modifyCeQueue($ceqid,array('ceqstatus' => $status));
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
		$search = M('ev')->get('search');
		$ceid = M('ev')->get('ceid');
		$ce = M('ce','certificate')->getCeById($ceid);
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
		$certificates = M('ce','certificate')->getCeQueuesByArgs($args);
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
		$page = intval(M('ev')->get('page'));
		$search = M('ev')->get('search');
		$this->u = '';
		if($search)
		{
			M('tpl')->assign('search',$search);
			foreach($search as $key => $arg)
			{
				$this->u .= "&search[{$key}]={$arg}";
			}
		}
		M('tpl')->assign('search',$search);
		M('tpl')->assign('u',$this->u);
		$ceid = M('ev')->get('ceid');
		$ce = M('ce','certificate')->getCeById($ceid);
		$args = array();
		$args[] = array("AND","ceqceid = :ceqceid","ceqceid",$ceid);
		if($search['username'])
		{
			$user = M('user','user')->getUserByUserName($search['username']);
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
		$certificates = M('ce','certificate')->getCeQueueList($args,$page,10);
		M('tpl')->assign('certificates',$certificates);
		M('tpl')->assign('status',array('申请中','已受理','已出证','申请被驳回'));
		M('tpl')->assign('page',$page);
		M('tpl')->assign('ce',$ce);
		M('tpl')->display('certificate_queue');
	}

	private function index()
	{
		$page = intval(M('ev')->get('page'));
		$certificates = M('ce','certificate')->getCeList(array(),$page,10);
		M('tpl')->assign('certificates',$certificates);
		M('tpl')->assign('page',$page);
		M('tpl')->display('certificate');
	}
}


?>
