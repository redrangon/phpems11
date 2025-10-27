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

	private function rows()
	{
		$page = M('ev')->get('page');
		$page = $page > 0?$page:1;
		$args = array(array("AND","questionrows.qrstatus = '0'"),array("AND","questionrows.qrid = quest2knows.qkquestionid"),array("AND","quest2knows.qktype = 1"));
		$knows = M('section','exam')->getAllKnowsBySubjects($this->teachsubjects);
		foreach($knows as $p)
		{
			if($p['knowsid'])$tmpknows .= ','.$p['knowsid'];
		}
		$tmpknows = trim($tmpknows,', ');
		if(!$tmpknows)$tmpknows = 0;
		$args[] = array('AND',"find_in_set(quest2knows.qkknowsid,:qkknowsids)","qkknowsids",$tmpknows);
		$questypes = M('basic','exam')->getQuestypeList();
		$questions = M('exam','exam')->getQuestionrowsList($page,20,$args);
		M('tpl')->assign('page',$page);
		M('tpl')->assign('questypes',$questypes);
		M('tpl')->assign('questions',$questions);
		M('tpl')->display('recyle_rowsquestions');
	}

	private function finaldelquestion()
	{
		$page = M('ev')->get('page');
		$questionid = M('ev')->get('questionid');
		M('exam','exam')->fanalDelQuestions($questionid);
		$message = array(
			'statusCode' => 200,
			"message" => "操作成功",
			"callbackType" => "forward",
		    "forwardUrl" => "index.php?exam-teach-recyle&page={$page}"
		);
		\PHPEMS\ginkgo::R($message);
	}

	private function finaldelrowsquestion()
	{
		$page = M('ev')->get('page');
		$questionid = M('ev')->get('questionid');
		M('exam','exam')->finalDelQuestionRows($questionid);
		M('exam','exam')->fanalDelQuestionsByArgs("questionparent = '{$questionid}'");
		$message = array(
			'statusCode' => 200,
			"message" => "操作成功",
			"callbackType" => "forward",
		    "forwardUrl" => "index.php?exam-teach-recyle-rows&page={$page}"
		);
		\PHPEMS\ginkgo::R($message);
	}

	private function index()
	{
		$page = M('ev')->get('page');
		$page = $page > 0?$page:1;
		$args = array(array("AND","quest2knows.qkquestionid = questions.questionid"),array("AND","questions.questionstatus = '0'"),array("AND","questions.questionparent = 0"),array("AND","quest2knows.qktype = 0") );
		$knows = M('section','exam')->getAllKnowsBySubjects($this->teachsubjects);
		foreach($knows as $p)
		{
			if($p['knowsid'])$tmpknows .= ','.$p['knowsid'];
		}
		$tmpknows = trim($tmpknows,', ');
		if(!$tmpknows)$tmpknows = 0;
		$args[] = array("AND","find_in_set(quest2knows.qkknowsid,:qkknowsid)",'qkknowsid',$tmpknows);
		$questypes = M('basic','exam')->getQuestypeList();
		$questions = M('exam','exam')->getQuestionsList($page,20,$args);
		M('tpl')->assign('page',$page);
		M('tpl')->assign('questypes',$questypes);
		M('tpl')->assign('questions',$questions);
		M('tpl')->display('recyle_questions');
	}
}


?>
