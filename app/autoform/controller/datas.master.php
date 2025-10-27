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

	private function records()
	{
        $moduleid = M('ev')->get('moduleid');
        $module = M('module')->getModuleById($moduleid);
		$page = M('ev')->get('page');
        $args = array();
		$data = array(
			'select' => false,
            'table' => $module['moduletable'],
            'query' => $args,
            'orderby' => $module['modulecode'].'id desc'
		);
        $rs = M('db')->listElements($page,PN,$data);
        $fields = M('module')->getTableMoudleFields($moduleid,1);
        M('tpl')->assign('fields',$fields);
        M('tpl')->assign('module',$module);
        M('tpl')->assign('rs',$rs);
        M('tpl')->display('datas_records');
	}

	private function index()
	{
        $page = M('ev')->get('page');
        $page = $page > 1?$page:1;
        $args = array();
        $args[] = array("AND","moduleapp = 'autoform'");
        $modules = M('module')->getModulesList($args);
        M('tpl')->assign('modules',$modules);
		M('tpl')->display('datas');
	}
}


?>
