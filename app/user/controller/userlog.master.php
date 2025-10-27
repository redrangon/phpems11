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
		$this->search = M('ev')->get('search');
		$this->u = '';
		if($this->search)
		{
			foreach($this->search as $key => $arg)
			{
				$this->u .= "&search[{$key}]={$arg}";
			}
			M('tpl')->assign('u',$this->u);
		}
		M('tpl')->assign('search',$this->search);
		if(!method_exists($this,$action))
		$action = "index";
		$this->$action();
		exit;
	}

	private function del()
	{
		$page = M('ev')->get('page');
		$ulid = M('ev')->get('ulid');
		M('user','user')->delUserLogById($ulid);
		$message = array(
			'statusCode' => 200,
			"message" => "操作成功",
		    "navTabId" => "",
		    "rel" => "",
		    "callbackType" => "forward",
		    "forwardUrl" => "index.php?user-master-userlog&page={$page}{$this->u}"
		);
		\PHPEMS\ginkgo::R($message);
	}

	private function clearlog()
	{
		$stime = M('ev')->get('stime');
		$etime = M('ev')->get('etime');
		$args = array();
		if($stime)$args[] = array('AND',"ultime >= :stime",'stime',strtotime($stime));
		if($etime)$args[] = array('AND',"ultime <= :etime",'etime',strtotime($etime));
		M('user','user')->clearUserLogByArgs($args);
		$message = array(
			'statusCode' => 200,
			"message" => "操作成功",
			"callbackType" => "forward",
			"forwardUrl" => "index.php?user-master-userlog"
		);
		\PHPEMS\ginkgo::R($message);
	}

	private function batdel()
	{
		if(M('ev')->get('action') == 'delete')
		{
			$page = M('ev')->get('page');
			$delids = M('ev')->get('delids');
			foreach($delids as $ulid => $p)
			M('user','user')->delUserLogById($ulid);
			$message = array(
				'statusCode' => 200,
				"message" => "操作成功",
			    "callbackType" => "forward",
			    "forwardUrl" => "index.php?user-master-userlog&page={$page}{$this->u}"
			);
			\PHPEMS\ginkgo::R($message);
		}
	}

	private function index()
	{
		$page = M('ev')->get('page')?M('ev')->get('page'):1;
		$args = array();
		$userid = M('ev')->get('userid');
		if($userid)$args[] = array('AND',"uluserid = :userid",'userid',$userid);
		if($this->search['userid'])$args[] = array('AND',"uluserid = :userid",'userid',$this->search['userid']);
		if($this->search['username'])$args[] = array('AND',"username LIKE :username",'username','%'.$this->search['username'].'%');
		if($this->search['stime']){
			$stime = strtotime($this->search['stime']);
			$args[] = array('AND',"ultime >= :ultime",'ultime',$stime);
		}
		if($this->search['etime']){
			$etime = strtotime($this->search['etime']);
			$args[] = array('AND',"ultime <= :ultime",'ultime',$etime);
		}
		$userlogs = M('user','user')->getUserLogList($args,$page,50);
		M('tpl')->assign('userlogs',$userlogs);
		M('tpl')->assign('page',$page);
		M('tpl')->assign('userid',$userid);
		M('tpl')->display('userlog');
	}
}


?>
