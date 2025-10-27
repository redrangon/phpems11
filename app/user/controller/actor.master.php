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

	private function selectactor()
	{
		$groupid = M('ev')->get('groupid');
		$group = M('user','user')->getGroupById($groupid);
		if($group)
		{
			M('user','user')->selectDefaultActor($groupid);
			$message = array(
				'statusCode' => 200,
				"message" => "操作成功",
				"callbackType" => "forward",
			    "forwardUrl" => "reload"
			);
		}
		else
		$message = array(
			'statusCode' => 300,
			"message" => "操作失败，存在同名用户组！"
		);
		\PHPEMS\ginkgo::R($message);
	}

	private function modifyactor()
	{
		$page = M('ev')->get('page');
		if(M('ev')->get('modifyactor'))
		{
			$groupid = M('ev')->get('groupid');
			$args = M('ev')->get('args');
			$r = M('user','user')->modifyActor($groupid,$args);
			if($r)
			{
				$message = array(
					'statusCode' => 200,
					"message" => "操作成功",
					"callbackType" => "forward",
				    "forwardUrl" => "index.php?user-master-actor"
				);
			}
			else
			{
				$message = array(
					'statusCode' => 300,
					"message" => "操作失败，存在同名用户组！",
				    "callbackType" => ''
				);
			}
			\PHPEMS\ginkgo::R($message);
		}
		else
		{
			$groupid = M('ev')->get('groupid');
			$group = M('user','user')->getGroupById($groupid);
			M('tpl')->assign('group',$group);
			M('tpl')->display('modifyactor');
		}
	}

	private function delactor()
	{
		$page = intval(M('ev')->get('page'));
		$groupid = M('ev')->get('groupid');
		$r = M('user','user')->delActorById($groupid);
		if($r)
		{
			$message = array(
				'statusCode' => 200,
				"message" => "操作成功",
				"callbackType" => "forward",
				"forwardUrl" => "index.php?user-master-actor&page={$page}"
			);
		}
		else
		{
			$message = array(
				'statusCode' => 300,
				"message" => "操作失败，该用户组下存在用户，请删除所有用户后再删除本用户组"
			);
		}
		\PHPEMS\ginkgo::R($message);
	}

	private function add()
	{
		if(M('ev')->post('insertactor'))
		{
			$args = M('ev')->post('args');
			$id = M('user','user')->insertActor($args);
			$message = array(
				'statusCode' => 200,
				"message" => "操作成功",
				"callbackType" => "forward",
				"forwardUrl" => "index.php?user-master-actor"
			);
			\PHPEMS\ginkgo::R($message);
		}
		else
		{
			M('tpl')->display('addactor');
		}
	}

	private function index()
	{
		$search = M('ev')->post('search');
		$args = 1;
		$page = M('ev')->get('page');
		$page = $page>1?$page:1;
		if($search['groupmoduleid'])
		{
			$args = array(array('AND',"groupmoduleid = :groupmoduleid",'groupmoduleid',$search['groupmoduleid']));
		}
		$actors = M('user','user')->getUserGroupList($args,$page,10);
		M('tpl')->assign('page',$page);
		M('tpl')->assign('actors',$actors);
		M('tpl')->display('actor');
	}
}


?>
