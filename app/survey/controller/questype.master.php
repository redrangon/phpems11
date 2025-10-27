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
		$this->search = M('ev')->get('search');
		if($this->search)
		{
			$this->u = '';
			M('tpl')->assign('search',$this->search);
			foreach($this->search as $key => $arg)
			{
				$this->u .= "&search[{$key}]={$arg}";
			}
			M('tpl')->assign('u',$this->u);
		}
		if(!method_exists($this,$action))
		$action = "index";
		$this->$action();
		exit;
	}

	private function add()
	{
		if(M('ev')->get('addquestype'))
		{
			$args = M('ev')->get('args');
			M('survey','survey')->addQuestype($args);
			$message = array(
				'statusCode' => 200,
				"message" => "操作成功",
				"callbackType" => "forward",
			    "forwardUrl" => "index.php?survey-master-questype"
			);
			\PHPEMS\ginkgo::R($message);
		}
		else
		{
			M('tpl')->display('questype_add');
		}
	}

	private function modify()
	{
		if(M('ev')->get('modifyquestype'))
		{
			$args = M('ev')->get('args');
			$questid = M('ev')->get('questid');
			M('survey','survey')->modifyQuestype($questid,$args);
			$message = array(
				'statusCode' => 200,
				"message" => "操作成功",
				"callbackType" => "forward",
			    "forwardUrl" => "index.php?survey-master-questype"
			);
			\PHPEMS\ginkgo::R($message);
		}
		else
		{
			$questid = M('ev')->get('questid');
			$quest = M('survey','survey')->getQuestypeById($questid);
			M('tpl')->assign('quest',$quest);
			M('tpl')->display('questype_modify');
		}
	}

	private function del()
	{
		$questid = M('ev')->get('questid');
		M('survey','survey')->delQuestype($questid);
		$message = array(
			'statusCode' => 200,
			"message" => "操作成功",
			"callbackType" => "forward",
		    "forwardUrl" => "index.php?survey-master-questype"
		);
		\PHPEMS\ginkgo::R($message);
	}

	private function index()
	{
		$questypes = M('survey','survey')->getQuestypeList();
		M('tpl')->assign('questypes',$questypes);
		M('tpl')->display('questype');
	}
}


?>
