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

	private function index()
	{
		$page = intval($this->ev->get('page'));
		$args = array();
		$args[] = array("AND","svyendtime > :syendtime","syendtime",TIME);
		$surveies = $this->survey->getSurveyList($args,$page);
		$this->tpl->assign('surveies',$surveies);
		$this->tpl->display('survey');
	}
}


?>
