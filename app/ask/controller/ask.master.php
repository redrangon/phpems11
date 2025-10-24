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
		$this->tpl->assign('status',array("未回答","已回答"));
		$this->tpl->assign('showstatus',array("不公开","公开"));
		$action = $this->ev->url(3);
		if(!method_exists($this,$action))
		$action = "index";
		$this->$action();
		exit;
	}

	private function answer()
	{
		$asrid = $this->ev->get('asrid');
		$answer = $this->ask->getAnswerById($asrid);
		$this->tpl->assign('answer',$answer);
		$this->tpl->display('ask_answer');
	}

	private function delanswer()
	{
		$asrid = $this->ev->get('asrid');
		$this->ask->delAnswer($asrid);
		$message = array(
			'statusCode' => 200,
			"message" => "操作成功！",
			"callbackType" => 'forward',
			"forwardUrl" => "reload"
		);
		\PHPEMS\ginkgo::R($message);
	}

	private function modifyanswer()
	{
		$asrid = $this->ev->get('asrid');
		$answer = $this->ask->getAnswerById($asrid);
		if($this->ev->get('submit'))
		{
			$args = $this->ev->get('args');
			$this->ask->modifyAnswer($asrid,$args);
			$message = array(
				'statusCode' => 200,
				"message" => "操作成功！",
				"callbackType" => 'forward',
				"forwardUrl" => "index.php?ask-master-ask-answers&askid=".$answer['asraskid']
			);
			\PHPEMS\ginkgo::R($message);
		}
		else
		{
			$askid = $answer['asraskid'];
			$ask = $this->ask->getAskById($askid);
			$this->tpl->assign('ask',$ask);
			$this->tpl->assign('answer',$answer);
			$this->tpl->display('ask_modifyanswer');
		}
	}

	private function addanswer()
	{
		if($this->ev->get('submit'))
		{
			$args = $this->ev->get('args');
			$askid = $args['asraskid'];
			$ask = $this->ask->getAskById($askid);
			$args['asruserid'] = $this->_user['sessionuserid'];
			$args['asrstatus'] = 1;
			$this->ask->addAnswer($args);
			if(!$ask['askstatus'])
			{
				$this->ask->modifyAsk($askid,array('askstatus' => 1));
			}
			$message = array(
				'statusCode' => 200,
				"message" => "操作成功！",
				"callbackType" => 'forward',
				"forwardUrl" => "index.php?ask-master-ask-answers&askid=".$args['asraskid']
			);
			\PHPEMS\ginkgo::R($message);
		}
		else
		{
			$askid = $this->ev->get('askid');
			$ask = $this->ask->getAskById($askid);
			$this->tpl->assign('ask',$ask);
			$this->tpl->display('ask_addanswer');
		}
	}

	private function answers()
	{
		$askid = $this->ev->get('askid');
		$page = $this->ev->get('page');
		$ask = $this->ask->getAskById($askid);
		$answers = $this->ask->getAnswerList(array(array("AND","asraskid = :asraskid","asraskid",$askid)),$page);
		$this->tpl->assign('answers',$answers);
		$this->tpl->assign('ask',$ask);
		$this->tpl->display('ask_answers');
	}

	private function ask()
	{
		$page = $this->ev->get('page');
		$args = array(
			array("AND","askstatus = 1")
		);
		$asks = $this->ask->getAskList($args,$page);
		$this->tpl->assign('asks',$asks);
		$this->tpl->display('ask_ask');
	}

	private function del()
	{
		$askid = $this->ev->get('askid');
		$this->ask->delAsk($askid);
		$message = array(
			'statusCode' => 200,
			"message" => "操作成功！",
			"callbackType" => 'forward',
			"forwardUrl" => "reload"
		);
		\PHPEMS\ginkgo::R($message);
	}

	private function order()
	{
		if($this->ev->get('order'))
		{
			if($this->ev->get('action') == 'delete')
			{
				$ids = $this->ev->get('delids');
				foreach($ids as $key => $id)
				{
					$this->ask->delAsk($key);
				}
			}
			elseif($this->ev->get('action') == 'show')
			{
				$ids = $this->ev->get('delids');
				foreach($ids as $key => $id)
				{
					$this->ask->modifyAsk($key,array("askisshow" => 1));
				}
			}
			elseif($this->ev->get('action') == 'unshow')
			{
				$ids = $this->ev->get('delids');
				foreach($ids as $key => $id)
				{
					$this->ask->modifyAsk($key,array("askisshow" => 0));
				}
			}
			else
			{
				$ids = $this->ev->get('ids');
				foreach($ids as $key => $id)
				{
					$this->ask->modifyAsk($key,array('askorder' => $id));
				}
			}
			$message = array(
				'statusCode' => 200,
				"message" => "操作成功",
				"callbackType" => "forward",
				"forwardUrl" => "reload"
			);
			\PHPEMS\ginkgo::R($message);
		}
		else
		{
			$message = array(
				'statusCode' => 300,
				"message" => "无效访问"
			);
			\PHPEMS\ginkgo::R($message);
		}
	}

	public function index()
	{
		$page = $this->ev->get('page');
		$args = array(
			array("AND","askstatus = 0")
		);
		$asks = $this->ask->getAskList($args,$page);
		$this->tpl->assign('asks',$asks);
		$this->tpl->display('ask');
	}
}


?>
