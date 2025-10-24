<?php

namespace PHPEMS;

class app
{
	public $G;

	public function __construct()
	{
		
		$this->ev = M('ev');
		$this->session = M('session');
		$this->_user = $this->session->getSessionUser();		
		$this->user = M('user','user');
		$this->tpl = M('tpl');
		if($this->_user['sessionuserid'])
		{
			$this->tpl->assign('_user',$this->user->getUserById($this->_user['sessionuserid']));
			switch($this->ev->url(2))
			{
				case 'login':
				case 'register':
				$message = array(
					'statusCode' => 200,
					"message" => "您已登录",
					"callbackType" => 'forward',
					"forwardUrl" => "index.php?".\PHPEMS\ginkgo::$defaultApp
				);
				\PHPEMS\ginkgo::R($message);
				break;
				
				default:				
				break;
			}
		}
		else
		{
			switch($this->ev->url(2))
			{
				case 'login':
				case 'register':
				break;
				
				default:
				$message = array(
					'statusCode' => 301,
					"message" => "请您登录",
					"callbackType" => 'forward',
					"forwardUrl" => "index.php?user-app-login"
				);
				\PHPEMS\ginkgo::R($message);
				break;
			}
		}
        $this->module = M('module');
		$this->order = M('orders','bank');
		$groups = $this->user->getUserGroups();
		$this->tpl->assign('groups',$groups);
		$this->tpl->assign('userhash',$this->ev->get('userhash'));
		$this->orderstatus = array(1=>'待支付',2=>'待发货',3=>'待收货',4 => '已完成',99 =>'已取消');
		$this->tpl->assign('orderstatus',$this->orderstatus);
		$this->tpl->assign('navs',M('nav','core')->getWebNavs());
	}
}

?>