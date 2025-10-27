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
		M('tpl')->assign('status',array("未回答","已回答"));
		M('tpl')->assign('showstatus',array("不公开","公开"));
		$action = M('ev')->url(3);
		if(!method_exists($this,$action))
		$action = "index";
		$this->$action();
		exit;
	}

	private function answer()
	{
		$asrid = M('ev')->get('asrid');
		$answer = M('ask','ask')->getAnswerById($asrid);
		M('tpl')->assign('answer',$answer);
		M('tpl')->display('ask_answer');
	}

	private function delanswer()
	{
		$asrid = M('ev')->get('asrid');
		M('ask','ask')->delAnswer($asrid);
		$message = array(
			'statusCode' => 200,
			"message" => "操作成功！",
			"callbackType" => 'forward',
			"forwardUrl" => "reload"
		);
		R($message);
	}

	private function modifyanswer()
	{
		$asrid = M('ev')->get('asrid');
		$answer = M('ask','ask')->getAnswerById($asrid);
		if(M('ev')->get('submit'))
		{
			$args = M('ev')->get('args');
			M('ask','ask')->modifyAnswer($asrid,$args);
			$message = array(
				'statusCode' => 200,
				"message" => "操作成功！",
				"callbackType" => 'forward',
				"forwardUrl" => "index.php?ask-master-ask-answers&askid=".$answer['asraskid']
			);
			R($message);
		}
		else
		{
			$askid = $answer['asraskid'];
			$ask = M('ask','ask')->getAskById($askid);
			M('tpl')->assign('ask',$ask);
			M('tpl')->assign('answer',$answer);
			M('tpl')->display('ask_modifyanswer');
		}
	}

	private function addanswer()
	{
		if(M('ev')->get('submit'))
		{
			$args = M('ev')->get('args');
			$askid = $args['asraskid'];
			$ask = M('ask','ask')->getAskById($askid);
			$args['asruserid'] = $this->user['userid'];
			$args['asrstatus'] = 1;
			M('ask','ask')->addAnswer($args);
			if(!$ask['askstatus'])
			{
				M('ask','ask')->modifyAsk($askid,array('askstatus' => 1));
			}
			$message = array(
				'statusCode' => 200,
				"message" => "操作成功！",
				"callbackType" => 'forward',
				"forwardUrl" => "index.php?ask-master-ask-answers&askid=".$args['asraskid']
			);
			R($message);
		}
		else
		{
			$askid = M('ev')->get('askid');
			$ask = M('ask','ask')->getAskById($askid);
			M('tpl')->assign('ask',$ask);
			M('tpl')->display('ask_addanswer');
		}
	}

	private function answers()
	{
		$askid = M('ev')->get('askid');
		$page = M('ev')->get('page');
		$ask = M('ask','ask')->getAskById($askid);
		$answers = M('ask','ask')->getAnswerList(array(array("AND","asraskid = :asraskid","asraskid",$askid)),$page);
		M('tpl')->assign('answers',$answers);
		M('tpl')->assign('ask',$ask);
		M('tpl')->display('ask_answers');
	}

	private function ask()
	{
		$page = M('ev')->get('page');
		$args = array(
			array("AND","askstatus = 1")
		);
		$asks = M('ask','ask')->getAskList($args,$page);
		M('tpl')->assign('asks',$asks);
		M('tpl')->display('ask_ask');
	}

	private function del()
	{
		$askid = M('ev')->get('askid');
		M('ask','ask')->delAsk($askid);
		$message = array(
			'statusCode' => 200,
			"message" => "操作成功！",
			"callbackType" => 'forward',
			"forwardUrl" => "reload"
		);
		R($message);
	}

	private function order()
	{
		if(M('ev')->get('order'))
		{
			if(M('ev')->get('action') == 'delete')
			{
				$ids = M('ev')->get('delids');
				foreach($ids as $key => $id)
				{
					M('ask','ask')->delAsk($key);
				}
			}
			elseif(M('ev')->get('action') == 'show')
			{
				$ids = M('ev')->get('delids');
				foreach($ids as $key => $id)
				{
					M('ask','ask')->modifyAsk($key,array("askisshow" => 1));
				}
			}
			elseif(M('ev')->get('action') == 'unshow')
			{
				$ids = M('ev')->get('delids');
				foreach($ids as $key => $id)
				{
					M('ask','ask')->modifyAsk($key,array("askisshow" => 0));
				}
			}
			else
			{
				$ids = M('ev')->get('ids');
				foreach($ids as $key => $id)
				{
					M('ask','ask')->modifyAsk($key,array('askorder' => $id));
				}
			}
			$message = array(
				'statusCode' => 200,
				"message" => "操作成功",
				"callbackType" => "forward",
				"forwardUrl" => "reload"
			);
			R($message);
		}
		else
		{
			$message = array(
				'statusCode' => 300,
				"message" => "无效访问"
			);
			R($message);
		}
	}

	public function index()
	{
		$page = M('ev')->get('page');
		$args = array(
			array("AND","askstatus = 0")
		);
		$asks = M('ask','ask')->getAskList($args,$page);
		M('tpl')->assign('asks',$asks);
		M('tpl')->display('ask');
	}
}


?>
