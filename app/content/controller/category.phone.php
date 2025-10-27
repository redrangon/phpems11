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
		if($cat['catuseurl'] && $cat['caturl'])
        {
            $message = array(
                'statusCode' => 201,
                "message" => "操作成功",
                "callbackType" => "forward",
                "forwardUrl" => html_entity_decode($cat['caturl'])
            );
            \PHPEMS\ginkgo::R($message);
        }
		if($cat['catparent'])$catparent = M('category')->getCategoryById($cat['catparent']);
		$catbread = M('category')->getCategoryPos($catid);
		$catstring = M('category')->getChildCategoryString($catid);
		$catchildren = M('category')->getCategoriesByArgs(array(array('AND',"catparent = :catparent",'catparent',$catid),array('AND',"catinmenu = '0'")));
		$contents = M('content','content')->getContentList(array(array("AND","find_in_set(contentcatid,:contentcatid)",'contentcatid',$catstring)),$page);
		$catbrother = M('category')->getCategoriesByArgs(array(array('AND',"catparent = :catparent",'catparent',$cat['catparent']),array('AND',"catinmenu = '0'")));
		if($cat['cattpl'])$template = $cat['cattpl'];
		else $template = 'category_default';
		M('tpl')->assign('cat',$cat);
		M('tpl')->assign('page',$page);
		M('tpl')->assign('catbrother',$catbrother);
		M('tpl')->assign('catchildren',$catchildren);
		M('tpl')->assign('catparent',$catparent);
		M('tpl')->assign('catbread',$catbread);
		M('tpl')->assign('contents',$contents);
		M('tpl')->display('category_default');
	}
}


?>
