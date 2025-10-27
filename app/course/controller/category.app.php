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

	private function index()
	{
		$page = M('ev')->get('page');
		$catid = M('ev')->get('catid');
		$cat = M('category')->getCategoryById($catid);
		$catbread = M('category')->getCategoryPos($catid);
		$catstring = M('category')->getChildCategoryString($catid);
		$catchildren = M('category')->getCategoriesByArgs(array(array('AND',"catparent = :catparent",'catparent',$catid),array('AND',"catinmenu = '0'"),array('AND',"catapp = 'course'")));
		$contents = M('course','course')->getCourseList(array(array("AND","find_in_set(cscatid,:cscatid)",'cscatid',$catstring)),$page);
		$catbrother = M('category')->getCategoriesByArgs(array(array('AND',"catparent = :catparent",'catparent',$cat['catparent']),array('AND',"catinmenu = '0'"),array('AND',"catapp = 'course'")));
		if($cat['cattpl'])$template = $cat['cattpl'];
		else $template = 'category_default';
		M('tpl')->assign('cat',$cat);
		M('tpl')->assign('page',$page);
		M('tpl')->assign('catbrother',$catbrother);
		M('tpl')->assign('catchildren',$catchildren);
		M('tpl')->assign('catbread',$catbread);
		M('tpl')->assign('contents',$contents);
        M('tpl')->assign('categories',M('category')->categories);
		M('tpl')->display($template);
	}
}


?>
