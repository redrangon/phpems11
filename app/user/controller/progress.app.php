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
		$this->progress = M('progress','user');
        M('basic','exam') = M('basic','exam');
        M('course','course') = M('course','course');
		if(!method_exists($this,$action))
		$action = "index";
		$this->$action();
		exit;
	}

	public function index()
	{
		$page = M('ev')->get('page');
		$args = array(array("AND","prsuserid = :prsuserid",'prsuserid',$this->user['userid']));
		$progresses = $this->progress->getUserProgressesListByArgs($args,$page);
		$courses = array();
		$basics = array();
		foreach($progresses['data'] as $p)
		{
			if(!$courses[$p['prscourseid']])
            $courses[$p['prscourseid']] = M('course','course')->getCourseById($p['prscourseid']);
            if(!$basics[$p['prsexamid']])
            $basics[$p['prsexamid']] = M('basic','exam')->getBasicById($p['prsexamid']);
		}
        M('tpl')->assign('status',array('未完成','已完成'));
        M('tpl')->assign('basics',$basics);
        M('tpl')->assign('courses',$courses);
		M('tpl')->assign('progresses',$progresses);
		M('tpl')->display('progress');
	}
}


?>
