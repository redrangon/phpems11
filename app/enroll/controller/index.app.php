<?php
/*
 * Created on 2016-5-19
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
namespace PHPEMS;
class action extends app
{
	public function display()
	{
		$this->enroll = M('enroll','enroll');
		$action = $this->ev->url(3);
		if(!method_exists($this,$action))
		$action = "index";
		$this->$action();
		exit;
	}

	public function index()
	{
		$page = $this->ev->get('page');
		$args = array();
		//$args[] = array("AND","enbstarttime <= :stime","stime",TIME);
		//$args[] = array("AND","enbendtime >= :etime","etime",TIME);
		$enbats = $this->enroll->getEnrollBatsList($args,$page,9);
		$args = array();
		$args[] = array("AND","enrolluserid = :enrolluserid","enrolluserid",$this->_user['sessionuserid']);
		$myenrolls = $this->enroll->getEnrollPlusList($args,1,5);
		$this->tpl->assign('page',$page);
		$this->tpl->assign('enbats',$enbats);
		$this->tpl->assign('myenrolls',$myenrolls);
		$this->tpl->display('index');
	}
}

?>
