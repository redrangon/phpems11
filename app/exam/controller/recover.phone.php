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

	private function clearexamsession()
	{
		$sessionid = M('ev')->get('sessionid');
		$token = M('ev')->get('token');
		$sessionvars = M('exam','exam')->getExamSessionBySessionid($sessionid);
		if(!$sessionvars['examsessionid'] || (md5($sessionvars['examsessionid'].'-'.$this->user['userid'].'-'.$sessionvars['examsessiontoken']) != $token))
		{
			$message = array(
				'statusCode' => 300,
				"message" => "清理失败"
			);
		}
		else
		{
			M('exam','exam')->delExamSession($sessionvars['examsessionid']);
			$message = array(
				'statusCode' => 200,
				"message" => "操作成功，正在刷新考试页面",
				"callbackType" => 'forward',
				"forwardUrl" => "reload"
			);
		}
		\PHPEMS\ginkgo::R($message);
	}

	public function index()
	{
		$sessionid = M('ev')->get('sessionid');
		$token = M('ev')->get('token');
		$sessionvars = M('exam','exam')->getExamSessionBySessionid($sessionid);
		if(!$sessionvars['examsessionid'] || (md5($sessionvars['examsessionid'].'-'.$this->user['userid'].'-'.$sessionvars['examsessiontoken']) != $token))
		{
			$message = array(
				'statusCode' => 300,
				"message" => "恢复失败，考试已经结束"
			);
		}
		else
		{
			$message = array(
				'statusCode' => 200,
				"message" => "恢复成功，正在转向考试页面",
				"callbackType" => 'forward',
				"forwardUrl" => "index.php?exam-phone-exam-paper&sessionid={$sessionid}&token={$token}"
			);
		}
		\PHPEMS\ginkgo::R($message);
	}
}


?>
