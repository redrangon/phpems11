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

    private function lists()
    {
        $catids = array();
        $catids = M('category')->getCategoriesByArgs(array(array("AND","catinmenu = '0'"),array("AND","catapp = 'course'"),array("AND","catparent = 0")));
        $contents = array();
        if($catids)
        {
            foreach($catids as $p)
            {
                $catstring = M('category')->getChildCategoryString($p['catid']);
                $contents[$p['catid']] = M('course','course')->getCourseList(array(array("AND","find_in_set(cscatid,:catstring)",'catstring',$catstring)),1,$p['catindex']?$p['catindex']:6);
            }
        }
        M('tpl')->assign('catids',$catids);
        M('tpl')->assign('categories',M('category')->categories);
        M('tpl')->assign('contents',$contents);
        M('tpl')->display('index_lists');
    }

    private function index()
    {
        $this->pg->isPhone = 1;
        $this->pg->target = 'class="ajax" data-target="course" data-page="course" ';
    	$page = M('ev')->get('page');
        $contents = M('course','course')->getOpenCourseListByUserid($this->user['userid'],$page);
        M('tpl')->assign('contents',$contents);
        M('tpl')->assign('page',$page);
        M('tpl')->display('index');
    }
}


?>
