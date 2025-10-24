<?php
 namespace PHPEMS;
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
		if($this->ev->isMobile())
		{
			header("location:index.php?content-phone");
			exit;
		}
        $this->position = M('position','content');
		$action = $this->ev->url(3);
		if(!method_exists($this,$action))
		$action = "index";
		$this->$action();
		exit;
	}

	public function index()
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
        $topnews = $this->position->getPosContentList(array(array("AND","pcposid = 2")),1,10);
        $this->tpl->assign('topnews',$topnews);
        $this->tpl->assign('categories',$this->category->categories);
        $this->tpl->assign('contents',$contents);
        $this->tpl->assign('catids',$catids);
        $this->tpl->display('index');
	}
}


?>
