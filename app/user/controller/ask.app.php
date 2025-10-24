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
		$this->ask = M('ask','ask');
		$this->tpl->assign('status',array("未回答","已回答"));
		$action = $this->ev->url(3);
		if(!method_exists($this,$action))
		$action = "index";
		$this->$action();
		exit;
	}

	public function index()
	{
		$page = $this->ev->get('page');
		$args = array(
			array("AND","askuserid = :askuserid","askuserid",$this->_user['sessionuserid'])
		);
		$asks = $this->ask->getAskList($args,$page);
		$this->tpl->assign('asks',$asks);
		$this->tpl->display('ask');
	}
}


?>
