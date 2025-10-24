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
		$openbasics = $this->basic->getOpenBasicsByUserid($this->_user['sessionuserid']);
		$this->tpl->assign('basics',$openbasics);
		$this->tpl->display('exam');
	}
}


?>
