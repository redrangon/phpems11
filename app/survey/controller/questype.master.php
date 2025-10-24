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
		$action = $this->ev->url(3);
		$this->search = $this->ev->get('search');
		if($this->search)
		{
			$this->u = '';
			$this->tpl->assign('search',$this->search);
			foreach($this->search as $key => $arg)
			{
				$this->u .= "&search[{$key}]={$arg}";
			}
			$this->tpl->assign('u',$this->u);
		}
		if(!method_exists($this,$action))
		$action = "index";
		$this->$action();
		exit;
	}

	private function add()
	{
		if($this->ev->get('addquestype'))
		{
			$args = $this->ev->get('args');
			$this->survey->addQuestype($args);
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
			$this->tpl->display('questype_add');
		}
	}

	private function modify()
	{
		if($this->ev->get('modifyquestype'))
		{
			$args = $this->ev->get('args');
			$questid = $this->ev->get('questid');
			$this->survey->modifyQuestype($questid,$args);
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
			$questid = $this->ev->get('questid');
			$quest = $this->survey->getQuestypeById($questid);
			$this->tpl->assign('quest',$quest);
			$this->tpl->display('questype_modify');
		}
	}

	private function del()
	{
		$questid = $this->ev->get('questid');
		$this->survey->delQuestype($questid);
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
		$questypes = $this->survey->getQuestypeList();
		$this->tpl->assign('questypes',$questypes);
		$this->tpl->display('questype');
	}
}


?>
