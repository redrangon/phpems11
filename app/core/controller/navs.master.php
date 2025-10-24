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
		$this->nav = M('nav','core');
		$action = $this->ev->url(3);
		if(!method_exists($this,$action))
		$action = "index";
		$this->$action();
		exit;
	}

	public function add()
	{
		if($this->ev->get('addnav'))
		{
			$args = $this->ev->get('args');
			$this->nav->addNav($args);
			$message = array(
				'statusCode' => 200,
				"message" => "操作成功，正在转入目标页面",
				"callbackType" => 'forward',
				"forwardUrl" => "index.php?core-master-navs"
			);
			\PHPEMS\ginkgo::R($message);
		}
		else
		{
			$this->tpl->display('nav_add');
		}
	}

	public function modify()
	{
		$navid = $this->ev->get('navid');
		$nav = $this->nav->getNav($navid);
		if($this->ev->get('modifynav'))
		{
			$args = $this->ev->get('args');
			$this->nav->modifyNav($navid,$args);
			$message = array(
				'statusCode' => 200,
				"message" => "操作成功，正在转入目标页面",
				"callbackType" => 'forward',
				"forwardUrl" => "index.php?core-master-navs"
			);
			\PHPEMS\ginkgo::R($message);
		}
		else
		{
			$this->tpl->assign('nav',$nav);
			$this->tpl->display('nav_modify');
		}
	}

	public function lite()
	{
		switch ($this->ev->get('action'))
		{
			case 'lite':
				$ids = $this->ev->get('ids');
				foreach($ids as $id => $p)
				{
					$this->nav->modifyNav($id,array('navsequence' => $p));
				}
				break;

			case 'open':
				$delids = $this->ev->get('delids');
				foreach($delids as $id => $p)
				{
					$this->nav->modifyNav($id,array('navstatus' => 1));
				}
				break;

			case 'close':
				$delids = $this->ev->get('delids');
				foreach($delids as $id => $p)
				{
					$this->nav->modifyNav($id,array('navstatus' => 0));
				}
				break;

			case 'delete':
				$delids = $this->ev->get('delids');
				foreach($delids as $id => $p)
				{
					$this->nav->delNav($id);
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
		\PHPEMS\ginkgo::R($message);
	}

	public function index()
	{
		$page = $this->ev->get('page');
		$page = $page?$page:1;
		$args = array();
		$navs = $this->nav->getNavList($args,$page);
		$this->tpl->assign('navs',$navs);
		$this->tpl->display('navs');
	}
}


?>
