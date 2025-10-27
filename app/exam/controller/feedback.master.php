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
		$fbid = M('ev')->get('fbid');
		M('feedback','exam')->delFeedBack($fbid);
		$message = array(
			'statusCode' => 200,
			"message" => "操作成功",
			"callbackType" => "forward",
		    "forwardUrl" => "reload"
		);
		\PHPEMS\ginkgo::R($message);
	}

	private function donefeedback()
	{
		$fbid = M('ev')->get('fbid');
		$status = M('ev')->get('status');
		M('feedback','exam')->modifyFeedBackById($fbid,array('fbstatus' => $status,'fbdoneuserid' => $this->user['userid'],'fbdonetime' => TIME));
		$message = array(
			'statusCode' => 200,
			"message" => "操作成功",
			"callbackType" => "forward",
		    "forwardUrl" => "reload"
		);
		\PHPEMS\ginkgo::R($message);
	}

	private function index()
	{
		$page = M('ev')->get('page');
		$page = $page > 0?$page:1;
		$feedback = M('feedback','exam')->getFeedBackList(1,$page);
		M('tpl')->assign('page',$page);
		M('tpl')->assign('feedback',$feedback);
		M('tpl')->assign('status',array('待处理','已处理'));
		M('tpl')->display('feedback');
	}
}


?>
