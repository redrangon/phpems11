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

	private function modify()
	{
		$page = M('ev')->get('page');
		if(M('ev')->get('modifyblock'))
		{
			$blockid = M('ev')->get('blockid');
			$args = M('ev')->get('args');
			unset($args['blocktype']);
			M('block','content')->modifyBlock($blockid,$args);
			$message = array(
				'statusCode' => 200,
				"message" => "操作成功",
			    "target" => "",
			    "rel" => "",
			    "callbackType" => "forward",
			    "forwardUrl" => "index.php?content-master-blocks&page={$page}"
			);
			\PHPEMS\ginkgo::R($message);
		}
		else
		{
			$blockid = M('ev')->get('blockid');
			$block = M('block','content')->getBlockById($blockid);
			$block['blockcontent'] = M('ev')->stripSlashes($block['blockcontent']);
			M('tpl')->assign('block',$block);
			M('tpl')->assign('page',$page);
			M('tpl')->display('blocks_modify');
		}
	}

	private function add()
	{
		if(M('ev')->get('addblock'))
		{
			$args = M('ev')->get('args');
			$args['blockcontent'] = $args['blockcontent'];
			M('block','content')->addBlock($args);
			$message = array(
				'statusCode' => 200,
				"message" => "操作成功",
			    "target" => "",
			    "rel" => "",
			    "callbackType" => "forward",
			    "forwardUrl" => "index.php?content-master-blocks"
			);
			\PHPEMS\ginkgo::R($message);
		}
		else
		{
			$apps = M('apps','core')->getAppList();
			$blockapps = array();
			foreach($apps as $id => $app)
			{
				$tmp = M('api',$app['appid']);
				if($tmp && method_exists($tmp,'parseBlock'))
				$blockapps[$id] = $app;
			}
			M('tpl')->assign('blockapps',$blockapps);
			M('tpl')->display('blocks_add');
		}
	}

	private function del()
	{
		$blockid = M('ev')->get('blockid');
		M('block','content')->delBlock($blockid);
		$message = array(
			'statusCode' => 200,
			"message" => "操作成功",
		    "target" => "",
		    "rel" => "",
		    "callbackType" => "forward",
		    "forwardUrl" => "index.php?content-master-blocks&page={$page}"
		);
		\PHPEMS\ginkgo::R($message);
	}

	private function change()
	{
		$blockid = M('ev')->get('blockid');
		$blocktype = M('ev')->get('blocktype');
		M('block','content')->modifyBlock($blockid,array('blocktype' => $blocktype));
		$message = array(
			'statusCode' => 200,
			"message" => "操作成功",
		    "target" => "",
		    "rel" => "",
		    "callbackType" => "forward",
		    "forwardUrl" => "index.php?content-master-blocks&page={$page}"
		);
		\PHPEMS\ginkgo::R($message);
	}

	private function index()
	{
		$page = M('ev')->get('page');
		$blocks = M('block','content')->getBlockList(1,$page,10);
		M('tpl')->assign('blocks',$blocks);
		M('tpl')->assign('page',$page);
		M('tpl')->display('blocks');
	}
}


?>
