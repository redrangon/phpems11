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

	public function index()
	{
		$page = M('ev')->get('page');
		$args = array(
			array("AND","askuserid = :askuserid","askuserid",$this->user['userid'])
		);
		$asks = M('ask','ask')->getAskList($args,$page);
		M('tpl')->assign('status',array("未回答","已回答"));
		M('tpl')->assign('asks',$asks);
		M('tpl')->display('ask');
	}
}


?>
