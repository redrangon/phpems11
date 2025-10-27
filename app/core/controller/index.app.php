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
		$courses = M('course','course')->getCourseList(array(),1,6);
		$basic = M('basic','exam');
		$basics = $basic->getBasicList(array(),1,6);
		$topimgs = M('position','content')->getPosContentList(array(array("AND","pcposid = 1")),1,5);
        $topnews = M('position','content')->getPosContentList(array(array("AND","pcposid = 2")),1,10);
        $links = M('content','content')->getContentList(array(array("AND","contentcatid = 11")),1,10);
        $notices = M('content','content')->getContentList(array(array("AND","contentcatid = 26")),1,10);
        M('tpl')->assign('notices',$notices);
        M('tpl')->assign('links',$links);
		M('tpl')->assign('courses',$courses);
		M('tpl')->assign('basics',$basics);
		M('tpl')->assign('topimgs',$topimgs);
        M('tpl')->assign('topnews',$topnews);
		M('tpl')->display('index');
	}
}


?>
