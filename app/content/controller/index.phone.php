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

	private function test()
	{
        $this->tpl->display('test');
	}

	private function index()
	{
        $catids = $this->category->getCategoriesByArgs(array(array("AND","catinmenu = 0"),array("AND","catapp = 'content'"),array("AND","catparent = 0")));
        $contents = array();
        if($catids)
        {
            foreach($catids as $p)
            {
                if($p['catindex'])
                {
                    $catstring = $this->category->getChildCategoryString($p['catid']);
                    $contents[$p['catid']] = $this->content->getContentList(array(array("AND","find_in_set(contentcatid,:catstring)",'catstring',$catstring)),1,$p['catindex']?$p['catindex']:10);
                }
            }
        }
        $this->tpl->assign('categories',$this->category->categories);
        $this->tpl->assign('contents',$contents);
        $this->tpl->assign('catids',$catids);
        $this->tpl->display('index');
	}
}


?>
