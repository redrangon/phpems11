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
		$this->config = M('config','ce');
		$action = M('ev')->url(3);
		if(!method_exists($this,$action))
		$action = "index";
		$this->$action();
		exit;
	}

	private function index()
	{
		$page = intval(M('ev')->get('page'));
		$args = array();
		$args[] = array("AND","cequserid = :cequserid","cequserid",$this->user['userid']);
		$certificates = M('ce','certificate')->getCeQueueList($args,$page,10);
		M('tpl')->assign('certificates',$certificates);
		M('tpl')->assign('status',$this->config->status);
		M('tpl')->assign('page',$page);
		M('tpl')->display('index');
	}
}


?>
