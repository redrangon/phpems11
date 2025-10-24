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
		$this->course = M('course','course');
		$action = $this->ev->url(3);
		if(!method_exists($this,$action))
		$action = "index";
		$this->$action();
		exit;
	}

	public function index()
	{
		$page = $this->ev->get('page');
		$contents = $this->course->getOpenCourseListByUserid($this->_user['sessionuserid'],$page);
		$this->tpl->assign('contents',$contents);
		$this->tpl->assign('page',$page);
		$this->tpl->display('course');
	}
}


?>
