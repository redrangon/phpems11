<?php

namespace PHPEMS;

class app
{
	public $G;
	public $data = array();
	public $sessionvars;

	public function __construct()
	{
		
		$this->ev = M('ev');
		$this->tpl = M('tpl');
		
		
		$this->db = M('pepdo');
		$this->pg = M('pg');
		$this->html = M('html');
		$this->session = M('session');
		$this->user = M('user','user');
		$this->_user = $this->session->getSessionUser();
		if(!$this->_user['sessionuserid'])
		{
			if($this->ev->get('userhash'))
			exit(json_encode(array(
				'statusCode' => 301,
				"message" => "请您重新登录",
			    "callbackType" => 'forward',
			    "forwardUrl" => "index.php?user-app-login"
			)));
			else
			{
				header("location:index.php?user-app-login");
				exit;
			}
		}
		$this->ce = M('ce','certificate');
		$this->tpl->assign('_user',$this->user->getUserById($this->_user['sessionuserid']));
		$this->tpl->assign('userhash',$this->ev->get('userhash'));
        $this->tpl->assign('navs',M('nav','core')->getWebNavs());
	}
}

?>