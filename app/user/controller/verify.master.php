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

	private function batverify()
	{
		$page = M('ev')->get('page');
		$ids = M('ev')->get('ids');
		if(M('ev')->get('action') == 'isverify')
		{
			foreach($ids as $userid => $p)
			{
				M('user','user')->modifyUserInfo($userid,array('userstatus'=>3));
			}
		}
		if(M('ev')->get('action') == 'passverify')
		{
			foreach($ids as $userid => $p)
			{
				M('user','user')->modifyUserInfo($userid,array('userstatus'=>2));
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
		$verify = M('ev')->get('verify');
		$userid = M('ev')->get('userid');
		if($verify == 'isverify')
		{
			M('user','user')->modifyUserInfo($userid,array('userstatus'=>3));
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
			M('user','user')->modifyUserInfo($userid,array('userstatus'=>2));
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
		$page = M('ev')->get('page')?M('ev')->get('page'):1;
		$args = array();
		if(!$this->search['userstatus'])$args[] = array('AND',"userstatus > :userstatus",'userstatus',0);
		if($this->search['userstatus'] == '1')$args[] = array('AND',"userstatus = :userstatus",'userstatus',1);
		if($this->search['userstatus'] == '2')$args[] = array('AND',"userstatus = :userstatus",'userstatus',2);
		if($this->search['userstatus'] == '3')$args[] = array('AND',"userstatus = :userstatus",'userstatus',3);
		$users = M('user','user')->getUserList($args,$page,10);
		M('tpl')->assign('users',$users);
		M('tpl')->assign('page',$page);
		M('tpl')->display('verify');
	}
}


?>
