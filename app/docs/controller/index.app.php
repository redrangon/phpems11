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
		if($this->ev->isMobile())
		{
			header("location:index.php?content-phone");
			exit;
		}
		$action = $this->ev->url(3);
		if(!method_exists($this,$action))
		$action = "index";
		$this->$action();
		exit;
	}

	private function index()
	{
        $catids = $this->category->getCategoriesByArgs(array(array("AND","catinmenu = 0"),array("AND","catapp = 'docs'"),array("AND","catparent = 0")));
        $contents = array();
        if($catids)
        {
            foreach($catids as $p)
            {
                if($p['catindex'])
                {
                    $catstring = $this->category->getChildCategoryString($p['catid']);
                    $docs[$p['catid']] = $this->doc->getDocList(array(array("AND","find_in_set(doccatid,:catstring)",'catstring',$catstring)),1,$p['catindex']?$p['catindex']:10);
                }
            }
        }
		$args = array();
        $args[] = array("AND","docneedmore = 1");
        $more = $this->doc->getDocList($args,1,10);
        $this->tpl->assign('categories',$this->category->categories);
        $this->tpl->assign('catids',$catids);
        $this->tpl->assign('docs',$docs);
        $this->tpl->assign('more',$more);
        $this->tpl->display('index');
	}
}


?>
