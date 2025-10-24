<?php
 namespace PHPEMS;

class app
{
	public $G;

	public function __construct()
	{
				
		$this->ev = M('ev');
		$this->tpl = M('tpl');
		
		
		

		$this->db = M('pdodb');
		$this->pg = M('pg');
		$this->html = M('html');
		$this->files = M('files');
		$this->session = M('session');
		$this->category = M('category');
		$this->course = M('course','course');
		$this->content = M('content','content');
		$this->user = M('user','user');
		$this->_user = $_user = $this->session->getSessionUser();
		$this->tpl->assign('_user',$this->user->getUserById($this->_user['sessionuserid']));
		$rcats = $this->category->getCategoriesByArgs(array(array("AND","catparent = '0'")));
		$this->tpl->assign('rcats',$rcats);
	}
}
?>