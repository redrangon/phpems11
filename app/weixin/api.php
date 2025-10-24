<?php

namespace PHPEMS;

class app
{
	public $G;

	public function __construct()
	{
				
		$this->ev = M('ev');
		$this->tpl = M('tpl');
		$this->session = M('session');
		$this->user = M('user','user');
		$this->_user = $_user = $this->session->getSessionUser();
		if($this->_user['sessionuserid'])
		$this->tpl->assign('_user',$this->user->getUserById($this->_user['sessionuserid']));
        $this->tpl->assign('navs',M('nav','core')->getWebNavs());
	}
}
?>