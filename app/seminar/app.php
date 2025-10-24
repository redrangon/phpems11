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
		$this->content = M('content','content');
		$this->user = M('user','user');
		$this->_user = $_user = $this->session->getSessionUser();
		$this->tpl->assign('_user',$this->user->getUserById($this->_user['sessionuserid']));
		$rcats = $this->category->getCategoriesByArgs(array(array("AND","catparent = '0'")));
		$this->tpl->assign('rcats',$rcats);
        $this->seminar = M('seminar','seminar');
        $this->tpl->assign('navs',M('nav','core')->getWebNavs());
	}
}
?>