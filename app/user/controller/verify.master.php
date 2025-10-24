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

	private function batverify()
	{
		$page = $this->ev->get('page');
		$ids = $this->ev->get('ids');
		if($this->ev->get('action') == 'isverify')
		{
			foreach($ids as $userid => $p)
			{
				$this->user->modifyUserInfo($userid,array('userstatus'=>3));
			}
		}
		if($this->ev->get('action') == 'passverify')
		{
			foreach($ids as $userid => $p)
			{
				$this->user->modifyUserInfo($userid,array('userstatus'=>2));
			}
		}
		$message = array(
			'statusCode' => 200,
			"message" => "操作成功",
			"callbackType" => "forward",
			"forwardUrl" => "index.php?user-master-verify&page={$page}{$this->u}"
		);
		\PHPEMS\ginkgo::R($message);
	}

	private function verify()
	{
		$verify = $this->ev->get('verify');
		$userid = $this->ev->get('userid');
		if($verify == 'isverify')
		{
			$this->user->modifyUserInfo($userid,array('userstatus'=>3));
			$message = array(
				'statusCode' => 200,
				"message" => "操作成功",
				"callbackType" => 'forward',
				"forwardUrl" => "reload"
			);
			\PHPEMS\ginkgo::R($message);
		}
		if ($verify == 'passverify')
		{
			$this->user->modifyUserInfo($userid,array('userstatus'=>2));
			$message = array(
				'statusCode' => 200,
				"message" => "操作成功",
				"callbackType" => 'forward',
				"forwardUrl" => "reload"
			);
			\PHPEMS\ginkgo::R($message);
		}
	}

	private function index()
	{
		$page = $this->ev->get('page')?$this->ev->get('page'):1;
		$args = array();
		if(!$this->search['userstatus'])$args[] = array('AND',"userstatus > :userstatus",'userstatus',0);
		if($this->search['userstatus'] == '1')$args[] = array('AND',"userstatus = :userstatus",'userstatus',1);
		if($this->search['userstatus'] == '2')$args[] = array('AND',"userstatus = :userstatus",'userstatus',2);
		if($this->search['userstatus'] == '3')$args[] = array('AND',"userstatus = :userstatus",'userstatus',3);
		$users = $this->user->getUserList($args,$page,10);
		$this->tpl->assign('users',$users);
		$this->tpl->assign('page',$page);
		$this->tpl->display('verify');
	}
}


?>
