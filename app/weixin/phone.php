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
		$this->category = M('category');
		$this->user = M('user','user');
		$this->_user = $this->session->getSessionUser();
		$user = $this->user->getUserById($this->_user['sessionuserid']);
		$this->tpl->assign('_user',$user);
		$this->tpl->assign('userhash',$this->ev->get('userhash'));
	}
}

?>