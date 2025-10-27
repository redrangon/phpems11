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

	private function clearquestions()
	{
		if(M('ev')->get('clearall'))
		{
			M('exam','exam')->clearDeletedQuestions();
		}
        $message = array(
            'statusCode' => 200,
            "message" => "操作成功",
            "callbackType" => "forward",
            "forwardUrl" => "reload"
        );
        \PHPEMS\ginkgo::R($message);
	}

    private function clearquestionrows()
	{
		if(M('ev')->get('clearall'))
		{
            M('exam','exam')->clearDeletedQuestionrows();
		}
        $message = array(
            'statusCode' => 200,
            "message" => "操作成功",
            "callbackType" => "forward",
            "forwardUrl" => "reload"
        );
        \PHPEMS\ginkgo::R($message);
	}

	private function backknows()
	{
		$knowsid = M('ev')->get('knowsid');
		$page = M('ev')->get('page');
		$nknow = M('section','exam')->getKnowsByArgs(array(array("AND","knowsid = :knowsid",'knowsid',$knowsid)));
		$know = M('section','exam')->getKnowsByArgs(array(array("AND","knowsstatus = 1",array("AND","knows = :knows",'knows',$nknow['knows']),array("AND","knowssectionid = :knowssectionid",'knowssectionid',$nknow['knowssectionid']))));
		if($know)
		{
			$message = array(
				'statusCode' => 300,
				"message" => "操作失败，所在章节下存在同名且未删除的知识点"
			);
			\PHPEMS\ginkgo::R($message);
		}
		M('section','exam')->backKnows($knowsid);
		$message = array(
			'statusCode' => 200,
			"message" => "操作成功",
			"callbackType" => "forward",
		    "forwardUrl" => "index.php?exam-master-recyle-knows&page={$page}"
		);
		\PHPEMS\ginkgo::R($message);
	}

	private function delknows()
	{
		$knowsid = M('ev')->get('knowsid');
		$page = M('ev')->get('page');
		M('section','exam')->delKnows($knowsid,true);
		$message = array(
			'statusCode' => 200,
			"message" => "操作成功",
			"callbackType" => "forward",
		    "forwardUrl" => "index.php?exam-master-recyle-knows&page={$page}"
		);
		\PHPEMS\ginkgo::R($message);
	}

	private function knows()
	{
		$page = M('ev')->get('page');
		$page = $page > 0?$page:1;
		$args = array("knowsstatus = '0'");
		$knows = M('section','exam')->getKnowsList($page,10,array(array("AND","knowsstatus = 0")));
		M('tpl')->assign('page',$page);
		M('tpl')->assign('knows',$knows);
		M('tpl')->display('recyle_knows');
	}

	private function rows()
	{
		$page = M('ev')->get('page');
		$page = $page > 0?$page:1;
		$args = array(array("AND","questionrows.qrstatus = '0'"),array("AND","questionrows.qrid = quest2knows.qkquestionid"),array("AND","quest2knows.qktype = 1"));
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
		    "forwardUrl" => "index.php?exam-master-recyle&page={$page}"
		);
		\PHPEMS\ginkgo::R($message);
	}

	private function finaldelrowsquestion()
	{
		$page = M('ev')->get('page');
		$questionid = M('ev')->get('questionid');
		M('exam','exam')->finalDelQuestionRows($questionid);
		M('exam','exam')->fanalDelQuestionsByArgs(array(array("AND","questionparent = :questionparent",'questionparent',$questionid)));
		$message = array(
			'statusCode' => 200,
			"message" => "操作成功",
			"callbackType" => "forward",
		    "forwardUrl" => "index.php?exam-master-recyle-rows&page={$page}"
		);
		\PHPEMS\ginkgo::R($message);
	}

	private function index()
	{
		$page = M('ev')->get('page');
		$page = $page > 0?$page:1;
		$args = array(array("AND","quest2knows.qkquestionid = questions.questionid"),array("AND","questions.questionstatus = '0'"),array("AND","questions.questionparent = 0"),array("AND","quest2knows.qktype = 0" ));
		$questypes = M('basic','exam')->getQuestypeList();
		$questions = M('exam','exam')->getQuestionsList($page,20,$args);
		M('tpl')->assign('page',$page);
		M('tpl')->assign('questypes',$questypes);
		M('tpl')->assign('questions',$questions);
		M('tpl')->display('recyle_questions');
	}
}


?>
