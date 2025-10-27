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

	private function index()
	{
		$page = intval(M('ev')->get('page'));
		$certificates = M('ce','certificate')->getCeList(array(),$page,PN);
		$args = array();
		$args[] = array("AND","cequserid = :cequserid","cequserid",$this->user['userid']);
		$news = M('ce','certificate')->getCeList(array(),1,10);
		M('tpl')->assign('news',$news);
		M('tpl')->assign('certificates',$certificates);
		M('tpl')->assign('page',$page);
		M('tpl')->display('index');
	}
}


?>
