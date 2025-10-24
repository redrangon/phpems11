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
        $this->ask = M('ask','ask');
        $this->user = M('user','user');
        $this->_user = $_user = $this->session->getSessionUser();
        $this->tpl->assign('_user',$this->user->getUserById($this->_user['sessionuserid']));
	}
}

?>