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
		$this->basic = M('basic','exam');
		$action = $this->ev->url(3);
		if(!method_exists($this,$action))
			$action = "index";
		$this->$action();
		exit;
	}

	public function index()
	{
		$user = $this->user->getUserById($this->_user['sessionuserid']);
		if($this->ev->get('verify'))
		{
			$args = $this->ev->get('args');
			$args['userstatus'] = 1;
			$args['userverifytime'] = TIME;
			$this->user->modifyUserInfo($this->_user['sessionuserid'],$args);
			$message = array(
				'statusCode' => 200,
				"message" => "实名认证申请已提交，请耐心等待审核！",
				"callbackType" => 'forward',
				"forwardUrl" => "reload"
			);
			\PHPEMS\ginkgo::R($message);
		}
		$this->tpl->assign('user',$user);
		$this->tpl->display('verify');
	}
}


?>
