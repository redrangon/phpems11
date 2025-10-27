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
        $search = M('ev')->get('search');
        $this->u = '';
        if($search)
        {
            M('tpl')->assign('search',$search);
            foreach($search as $key => $arg)
            {
                $this->u .= "&search[{$key}]={$arg}";
            }
        }
        M('tpl')->assign('search',$search);
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

    private function search()
    {
        $search = M('ev')->get('search');
        $page = M('ev')->get('page');
        $args = array();
        if($search['keyword'])$args[] = array("AND","cstitle LIKE :cstitle",'cstitle',"%{$search['keyword']}%");
        $contents = M('course','course')->getCourseList($args,$page,15);
        $news = M('course','course')->getCourseList(array(),1,5);
        M('tpl')->assign('news',$news['data']);
        M('tpl')->assign('contents',$contents);
        M('tpl')->assign('page',$page);
        M('tpl')->display('search');
    }

    private function index()
    {
        $page = M('ev')->get('page');
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
        $news = M('course','course')->getCourseList(array(),1,5);
        M('tpl')->assign('news',$news['data']);
        M('tpl')->assign('contents',$contents);
        M('tpl')->assign('page',$page);
        M('tpl')->display('index');
    }
}


?>
