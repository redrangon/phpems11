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
		$page = intval(M('ev')->get('page'));
		$args = array();
		$args[] = array("AND","cequserid = :cequserid","cequserid",$this->user['userid']);
		$certificates = M('ce','certificate')->getCeQueueList($args,$page,10);
		$news = M('ce','certificate')->getCeList(array(),$page,10);
		M('tpl')->assign('news',$news['data']);
		M('tpl')->assign('certificates',$certificates);
		M('tpl')->assign('status',M('config','user')->status);
		M('tpl')->assign('page',$page);
		M('tpl')->display('certificate');
	}
}


?>
