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
		$this->search = $this->ev->get('search');
		$this->u = '';
		if($this->search)
		{
			foreach($this->search as $key => $arg)
			{
				$this->u .= "&search[{$key}]={$arg}";
			}
			$this->tpl->assign('u',$this->u);
		}
		$this->tpl->assign('search',$this->search);
		if(!method_exists($this,$action))
		$action = "index";
		$this->$action();
		exit;
	}

	private function del()
	{
		$page = $this->ev->get('page');
		$ulid = $this->ev->get('ulid');
		$this->user->delUserLogById($ulid);
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
		$stime = $this->ev->get('stime');
		$etime = $this->ev->get('etime');
		$args = array();
		if($stime)$args[] = array('AND',"ultime >= :stime",'stime',strtotime($stime));
		if($etime)$args[] = array('AND',"ultime <= :etime",'etime',strtotime($etime));
		$this->user->clearUserLogByArgs($args);
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
		if($this->ev->get('action') == 'delete')
		{
			$page = $this->ev->get('page');
			$delids = $this->ev->get('delids');
			foreach($delids as $ulid => $p)
			$this->user->delUserLogById($ulid);
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
		$page = $this->ev->get('page')?$this->ev->get('page'):1;
		$args = array();
		$userid = $this->ev->get('userid');
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
		$userlogs = $this->user->getUserLogList($args,$page,50);
		$this->tpl->assign('userlogs',$userlogs);
		$this->tpl->assign('page',$page);
		$this->tpl->assign('userid',$userid);
		$this->tpl->display('userlog');
	}
}


?>
