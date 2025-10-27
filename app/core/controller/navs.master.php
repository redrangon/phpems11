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

	public function add()
	{
		if(M('ev')->get('addnav'))
		{
			$args = M('ev')->get('args');
			M('nav','core')->addNav($args);
			$message = array(
				'statusCode' => 200,
				"message" => "操作成功，正在转入目标页面",
				"callbackType" => 'forward',
				"forwardUrl" => "index.php?core-master-navs"
			);
			R($message);
		}
		else
		{
			M('tpl')->display('nav_add');
		}
	}

	public function modify()
	{
		$navid = M('ev')->get('navid');
		$nav = M('nav','core')->getNav($navid);
		if(M('ev')->get('modifynav'))
		{
			$args = M('ev')->get('args');
			M('nav','core')->modifyNav($navid,$args);
			$message = array(
				'statusCode' => 200,
				"message" => "操作成功，正在转入目标页面",
				"callbackType" => 'forward',
				"forwardUrl" => "index.php?core-master-navs"
			);
			R($message);
		}
		else
		{
			M('tpl')->assign('nav',$nav);
			M('tpl')->display('nav_modify');
		}
	}

	public function lite()
	{
		switch (M('ev')->get('action'))
		{
			case 'lite':
				$ids = M('ev')->get('ids');
				foreach($ids as $id => $p)
				{
					M('nav','core')->modifyNav($id,array('navsequence' => $p));
				}
				break;

			case 'open':
				$delids = M('ev')->get('delids');
				foreach($delids as $id => $p)
				{
					M('nav','core')->modifyNav($id,array('navstatus' => 1));
				}
				break;

			case 'close':
				$delids = M('ev')->get('delids');
				foreach($delids as $id => $p)
				{
					M('nav','core')->modifyNav($id,array('navstatus' => 0));
				}
				break;

			case 'delete':
				$delids = M('ev')->get('delids');
				foreach($delids as $id => $p)
				{
					M('nav','core')->delNav($id);
				}
				break;

			default:
				break;
		}
		$message = array(
			'statusCode' => 200,
			"message" => "操作成功，正在转入目标页面",
			"callbackType" => 'forward',
			"forwardUrl" => "reload"
		);
		R($message);
	}

	public function index()
	{
		$page = M('ev')->get('page');
		$page = $page?$page:1;
		$args = array();
		$navs = M('nav','core')->getNavList($args,$page);
		M('tpl')->assign('navs',$navs);
		M('tpl')->display('navs');
	}
}


?>
