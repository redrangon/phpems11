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
        M('enroll','enroll') = M('enroll','enroll');
        $action = M('ev')->url(3);
        if(!method_exists($this,$action))
            $action = "index";
        $this->$action();
        exit;
    }

    public function index()
    {
        $page = M('ev')->get('page');
        $args = array();
        //$args[] = array("AND","enbstarttime <= :stime","stime",TIME);
        //$args[] = array("AND","enbendtime >= :etime","etime",TIME);
        $enbats = M('enroll','enroll')->getEnrollBatsList($args,$page,20);
        M('tpl')->assign('page',$page);
        M('tpl')->assign('enbats',$enbats);
        M('tpl')->display('index');
    }
}


?>
