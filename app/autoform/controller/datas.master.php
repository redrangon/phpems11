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

	private function records()
	{
        $moduleid = $this->ev->get('moduleid');
        $module = $this->module->getModuleById($moduleid);
		$page = $this->ev->get('page');
        $page = $page > 1?$page:1;
        $args = array();
		$data = array(
			'select' => false,
            'table' => $module['moduletable'],
            'query' => $args,
            'orderby' => $module['moduletable'].'id desc'
		);
        $rs = $this->db->listElements($page,PN,$data);
        $fields = $this->module->getTableMoudleFields($moduleid,1);
        $this->tpl->assign('fields',$fields);
        $this->tpl->assign('module',$module);
        $this->tpl->assign('rs',$rs);
        $this->tpl->display('datas_records');
	}

	private function index()
	{
        $page = $this->ev->get('page');
        $page = $page > 1?$page:1;
        $args = array();
        $args[] = array("AND","moduleapp = 'autoform'");
        $modules = $this->module->getModulesList($args);
        $this->tpl->assign('modules',$modules);
		$this->tpl->display('datas');
	}
}


?>
