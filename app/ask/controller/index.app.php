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
		$action = M('ev')->url(3);
		if(!method_exists($this,$action))
		$action = "index";
		$this->$action();
		exit;
	}

	public function search()
	{
		M('tpl')->display('search');
	}

	public function answer()
	{
		$askid = M('ev')->get('askid');
		$ask = M('ask','ask')->getAskById($askid);
		$answer = M('ask','ask')->getAnswerByArgs(array(array("AND","asraskid = :asraskid","asraskid",$askid)));
		M('tpl')->assign('answer',$answer);
		M('tpl')->assign('ask',$ask);
		M('tpl')->display('answer');
	}

	public function index()
	{
		$page = M('ev')->get('page');
		$args = array(
			array("AND","askisshow = 1"),
			array("AND","askstatus = 1")
		);
		$asks = M('ask','ask')->getAskList($args,$page);
		M('tpl')->assign('asks',$asks);
		M('tpl')->display('index');
	}
}


?>
