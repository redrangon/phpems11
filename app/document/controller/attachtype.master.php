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

	private function del()
	{
		$page = M('ev')->get('page');
		$atid = M('ev')->get('atid');
		M('attach','document')->delAttachtypeById($atid);
		$message = array(
			'statusCode' => 200,
			"message" => "操作成功",
			"callbackType" => "forward",
		    "forwardUrl" => "index.php?document-master-attachtype&page={$page}{$u}"
		);
		\PHPEMS\ginkgo::R($message);
	}

	private function batdel()
	{
		$page = M('ev')->get('page');
		$delids = M('ev')->get('delids');
		foreach($delids as $atid)
		M('attach','document')->delAttachtypeById($atid);
		$message = array(
			'statusCode' => 200,
			"message" => "操作成功",
			"callbackType" => "forward",
		    "forwardUrl" => "index.php?document-master-attachtype&page={$page}{$u}"
		);
		\PHPEMS\ginkgo::R($message);
	}

	private function modify()
	{
		$page = M('ev')->get('page');
		$atid = M('ev')->get('atid');
		if(M('ev')->get('modifyattachtype'))
		{
			$args = M('ev')->get('args');
			M('attach','document')->modifyAttachtypeById($args,$atid);
			$message = array(
				'statusCode' => 200,
				"message" => "操作成功",
				"callbackType" => "forward",
			    "forwardUrl" => "index.php?document-master-attachtype&page={$page}{$u}"
			);
			\PHPEMS\ginkgo::R($message);
		}
		else
		{
			$attachtype = M('attach','document')->getAttachtypeById($atid);
			M('tpl')->assign('attachtype',$attachtype);
			M('tpl')->display('types_modify');
		}
	}

	private function add()
	{
		if(M('ev')->get('inserttype'))
		{
			$args = M('ev')->get('args');
			$id = M('attach','document')->addAttachtype($args);
			$message = array(
				'statusCode' => 200,
				"message" => "操作成功",
				"callbackType" => "forward",
			    "forwardUrl" => "index.php?document-master-attachtype{$u}"
			);
			\PHPEMS\ginkgo::R($message);
		}
		else
		{
			M('tpl')->display('types_add');
		}
	}

	private function index()
	{
		$types = M('attach','document')->getAttachtypeList();
		M('tpl')->assign('types',$types);
		M('tpl')->display('types');
	}
}


?>
