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

	private function add()
	{
		if(M('ev')->get('addcategory'))
		{
			$args = M('ev')->get('args');
			$page = M('ev')->get('page');
			M('category')->addCategory($args);
			if($args['catparent'])
			{
				$parent = M('category')->getCategoryById($args['catparent']);
				$parent = intval($parent['catparent']);
			}
			else $parent = 0;
			$message = array(
				'statusCode' => 200,
				"message" => "操作成功",
			    "target" => "",
			    "rel" => "",
			    "callbackType" => "forward",
			    "forwardUrl" => "index.php?content-master-category&parent={$parent}&page={$page}"
			);
			\PHPEMS\ginkgo::R($message);
		}
		else
		{
			$parent = M('ev')->get('parent');
			$tpls = array();
			foreach(glob("app/content/tpls/app/category_*.tpl") as $p)
			{
				$tpls[] = substr(basename($p),0,-4);
			}
			M('tpl')->assign('parent',$parent);
			M('tpl')->assign('tpls',$tpls);
			M('tpl')->display('category_add');
		}
	}

	private function lite()
	{
		$ids = M('ev')->get('ids');
		foreach($ids as $key => $p)
		{
			$args = array('catlite' => $p);
			M('category')->modifyCategory($key,$args);
		}
		$message = array(
			'statusCode' => 200,
			"message" => "操作成功",
		    "callbackType" => "forward",
		    "forwardUrl" => "reload"
		);
		\PHPEMS\ginkgo::R($message);
	}

	private function ajax()
	{
		switch(M('ev')->url(4))
		{
			case 'getchildcategory':
			$catid = M('ev')->get('catid');
			$out = '';
			if($catid)
			{
				$child = M('category')->getCategoriesByArgs(array(array("AND","catparent = :catparent",':catparent',$catid)));
				foreach($child as $c)
				{
					$out .= '<option value="'.$c['catid'].'">'.$c['catname'].'</option>';
				}
			}
			if($out)
			{
				$message = array(
					'statusCode' => 200,
				    "html" => $out
				);
				\PHPEMS\ginkgo::R($message);
			}
			else
			{
				$message = array(
					'statusCode' => 300
				);
				\PHPEMS\ginkgo::R($message);
			}
			break;

			case 'getchilddata':
			$catid = M('ev')->get('catid');
			$child = M('category')->getCategoriesByArgs(array(array("AND","catparent = :catparent",':catparent',$catid)));
			exit(json_encode($child));
			M('tpl')->assign('child',$child);
			M('tpl')->assign('catid',$catid);
			M('tpl')->display('category_ajax_data');
			break;

			default:
			break;
		}
	}

	private function edit()
	{
		$parent = M('ev')->get('parent');
		$catid = M('ev')->get('catid');
		$page = M('ev')->get('page');
		if(M('ev')->get('submit'))
		{
			$args = M('ev')->get('args');
			$cat = M('category')->getCategoryById($catid);
			M('category')->modifyCategory($catid,$args);
			$message = array(
				'statusCode' => 200,
				"message" => "操作成功",
			    "callbackType" => "forward",
			    "forwardUrl" => "index.php?content-master-category&parent={$cat['catparent']}&page={$page}"
			);
			\PHPEMS\ginkgo::R($message);
		}
		else
		{
			$category = M('category')->getCategoryById($catid);
			$tpls = array();
			foreach(glob("app/content/tpls/app/category_*.tpl") as $p)
			{
				$tpls[] = substr(basename($p),0,-4);
			}
			M('tpl')->assign('tpls',$tpls);
			M('tpl')->assign('parent',$parent);
			M('tpl')->assign('category',$category);
			M('tpl')->assign('catid',$catid);
			M('tpl')->assign('page',$page);
			M('tpl')->display('category_edit');
		}
	}

	private function del()
	{
		$catid = M('ev')->get('catid');
		$cat = M('category')->getCategoryById($catid);
		$catstring = M('category')->getChildCategoryString($catid,0);
		$contents = M('content','content')->getContentList(array(array("AND","contentcatid = :contentcatid",'contentcatid',$catid)));
		if($catstring || $contents['number'])
		{
			$message = array(
				'statusCode' => 300,
				"message" => "操作失败，请先删除该分类下所有子分类和内容"
			);
			\PHPEMS\ginkgo::R($message);
		}
		M('category')->delCategory($catid);
		$message = array(
			'statusCode' => 200,
			"message" => "操作成功",
		    "target" => "",
		    "rel" => "",
		    "callbackType" => "forward",
		    "forwardUrl" => "reload"
		);
		\PHPEMS\ginkgo::R($message);
	}

	private function index()
	{
		$page = intval(M('ev')->get('page'));
		$page = $page?$page:1;
		$parent = intval(M('ev')->get('parent'));
		$categorys = M('category')->getCategoryList(array(array("AND","catparent = :catparent",'catparent',$parent)),$page,5);
		$categories = M('category')->getAllCategory();
		M('tpl')->assign('parent',$parent);
		M('tpl')->assign('categorys',$categorys);
		M('tpl')->assign('categories',$categories);
		M('tpl')->assign('page',$page);
		M('tpl')->display('category');
	}
}


?>
