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
		$action = $this->ev->url(3);
		if(!method_exists($this,$action))
		$action = "index";
		$this->$action();
		exit;
	}

	public function search()
	{
		$this->tpl->display('search');
	}

	public function answer()
	{
		$askid = $this->ev->get('askid');
		$ask = $this->ask->getAskById($askid);
		$answer = $this->ask->getAnswerByArgs(array(array("AND","asraskid = :asraskid","asraskid",$askid)));
		$this->tpl->assign('answer',$answer);
		$this->tpl->assign('ask',$ask);
		$this->tpl->display('answer');
	}

	public function index()
	{
		$page = $this->ev->get('page');
		$args = array(
			array("AND","askisshow = 1"),
			array("AND","askstatus = 1")
		);
		$asks = $this->ask->getAskList($args,$page);
		$this->tpl->assign('asks',$asks);
		$this->tpl->display('index');
	}
}


?>
