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
        $this->position = M('position','content');
		$action = $this->ev->url(3);
		if(!method_exists($this,$action))
		$action = "index";
		$this->$action();
		exit;
	}

	public function index()
	{
		$catids = $this->category->getCategoriesByArgs(array(array("AND","catinmenu = 0"),array("AND","catapp = 'seminar'")));
		$seminars = array();
		if($catids)
		{
			foreach($catids as $p)
			{
				$catstring = $this->category->getChildCategoryString($p['catid']);
                $seminars[$p['catid']] = $this->seminar->getSeminarList(array(array("AND","find_in_set(seminarcatid,:catstring)",'catstring',$catstring)),1,$p['catindex']?$p['catindex']:10);
			}
		}
        $topseminars = $this->position->getPosContentList(array(array("AND","pcposid = 3")),1,10);
        $this->tpl->assign('categories',$this->category->categories);
		$this->tpl->assign('topseminars',$topseminars);
        $this->tpl->assign('seminars',$seminars);
		$this->tpl->assign('catids',$catids);
		$this->tpl->display('index');
	}
}


?>
