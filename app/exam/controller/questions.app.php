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
        if($this->data['currentbasic']['basicexam']['model'])
		{
			header("location:index.php?exam-app-lesson");
			exit;
		}
		$action = M('ev')->url(3);
		if(!method_exists($this,$action))
		$action = "index";
		$this->$action();
		exit;
	}

	private function getknowsbysectionid()
	{
		$sectionid = M('ev')->get('sectionid');
		$aknows = M('section','exam')->getKnowsListByArgs(array(array("AND","knowssectionid = :knowssectionid",'knowssectionid',$sectionid),array("AND","knowsstatus = 1")));
		$data = array(array("",'选择知识点'));
		foreach($aknows as $knows)
		{
			$data[] = array($knows['knowsid'],$knows['knows']);
		}
		foreach($data as $p)
		{
			echo "<option value=\"{$p[0]}\">{$p[1]}</option>";
		}
	}

	private function detail()
	{
		$questionid = M('ev')->get('questionid');
		$questionparent = M('ev')->get('questionparent');
		if($questionparent)
		{
			$questions = M('exam','exam')->getQuestionByArgs(array(array("AND","questionparent = :questionparent",'questionparent',$questionparent)));
		}
		else
		{
			$question = M('exam','exam')->getQuestionByArgs(array(array("AND","questionid = :questionid",'questionid',$questionid)));
			$sections = array();
			foreach($question['questionknowsid'] as $key => $p)
			{
				$knows = M('section','exam')->getKnowsByArgs(array(array("AND","knowsid = :knowsid",'knowsid',$p['knowsid'])));
				$question['questionknowsid'][$key]['knows'] = $knows['knows'];
				$sections[] = M('section','exam')->getSectionByArgs(array(array("AND","sectionid = :sectionid",'sectionid',$knows['knowssectionid'])));
			}
			$subject = M('basic','exam')->getSubjectById($sections[0]['sectionsubjectid']);
		}
		M('tpl')->assign("subject",$subject);
		M('tpl')->assign("sections",$sections);
		M('tpl')->assign("question",$question);
		M('tpl')->assign("questions",$questions);
		M('tpl')->display('question_detail');
	}

	private function rowsdetail()
	{
		$questionid = M('ev')->get('questionid');
		$question = M('exam','exam')->getQuestionRowsByArgs(array(array("AND","qrid = :qrid",'qrid',$questionid)));
		$sections = array();
		foreach($question['qrknowsid'] as $key => $p)
		{
			$knows = M('section','exam')->getKnowsByArgs(array(array("AND","knowsid = :knowsid",'knowsid',$p['knowsid'])));
			$question['qrknowsid'][$key]['knows'] = $knows['knows'];
			$sections[] = M('section','exam')->getSectionByArgs(array(array("AND","sectionid = :sectionid",'sectionid',$knows['knowssectionid'])));
		}
		$subject = M('basic','exam')->getSubjectById($sections[0]['sectionsubjectid']);
		M('tpl')->assign("subject",$subject);
		M('tpl')->assign("sections",$sections);
		M('tpl')->assign("question",$question);
		M('tpl')->display('questionrows_detail');
	}

	private function questionrows()
	{
		$page = M('ev')->get('page');
		$page = $page > 0?$page:1;
		$questypes = M('basic','exam')->getQuestypeList();
		$basic = $this->data['currentbasic'];
		$search = M('ev')->get('search');
		$args = array(array("AND","quest2knows.qkquestionid = questionrows.qrid"),array("AND","quest2knows.qktype = 1"),array("AND","questionrows.qrstatus = '1'"));
		if($search['questionid'])
		{
			$args[] = array("AND","questionrows.qrid = :qrid",'qrid',$search['questionid']);
		}
		if($search['questiontype'])
		{
			$args[] = array("AND","questionrows.qrtype = :qrtype",'qrtype',$search['questiontype']);
		}
		if($search['keyword'])
		{
			$args[] = array("AND","questionrows.qrquestion LIKE :qrquestion",'qrquestion',"%".$search['keyword']."%");
		}
		if($search['qrlevel'])
		{
			$args[] = array("AND","questionrows.qrlevel = :qrlevel",'qrlevel',$search['qrlevel']);
		}
		if($search['questionknowsid'])
		{
			$args[] = array("AND","quest2knows.qkknowsid = :qkknowsid",'qkknowsid',$search['questionknowsid']);
		}
		else
		{
			$tmpknows = '0';
			if($search['questionsectionid'])
			{
				$knows = M('section','exam')->getKnowsListByArgs(array(array("AND","knowsstatus = 1"),array("AND","knowssectionid = :knowssectionid",'knowssectionid',$search['questionsectionid'])));
				foreach($knows as $p)
				{
					if($p['knowsid'])$tmpknows .= ','.$p['knowsid'];
				}
				$args[] = array("AND","find_in_set(quest2knows.qkknowsid,:qkknowsid)",'qkknowsid',$tmpknows);
			}
			else
			{
				$knows = M('section','exam')->getAllKnowsBySubject($basic['basicsubjectid']);
				foreach($knows as $p)
				{
					if($p['knowsid'])$tmpknows .= ','.$p['knowsid'];
				}
				$args[] = array("AND","find_in_set(quest2knows.qkknowsid,:qkknowsid)",'qkknowsid',$tmpknows);
			}
		}
		$questions = M('exam','exam')->getQuestionrowsList($page,10,$args);
		$subjects = M('basic','exam')->getSubjectList();
		$sections = M('section','exam')->getSectionListByArgs(array(array("AND","sectionsubjectid = :sectionsubjectid",'sectionsubjectid',$basic['basicsubjectid'])));
		$knows = M('section','exam')->getKnowsListByArgs(array(array("AND","knowsstatus = 1"),array("AND","knowssectionid = :knowssectionid",'knowssectionid',$search['questionsectionid'])));
		M('tpl')->assign('search',$search);
		M('tpl')->assign('subjects',$subjects);
		M('tpl')->assign('sections',$sections);
		M('tpl')->assign('knows',$knows);
		M('tpl')->assign('questypes',$questypes);
		M('tpl')->assign('questions',$questions);
		M('tpl')->display('questionrows');
	}

	private function index()
	{
		$page = M('ev')->get('page');
		$search = M('ev')->get('search');
		$basic = $this->data['currentbasic'];
		$sections = M('section','exam')->getSectionListByArgs(array(array("AND","sectionsubjectid = :sectionsubjectid",'sectionsubjectid',$basic['basicsubjectid'])));
		$args = array(array("AND","quest2knows.qkquestionid = questions.questionid"),array("AND","questions.questionstatus = '1'"),array("AND","questions.questionparent = 0"),array("AND","quest2knows.qktype = 0") );
		if($search['questionid'])
		{
			$args[] = array("AND","questions.questionid = :questionid",'questionid',$search['questionid']);
		}
		if($search['keyword'])
		{
			$args[] = array("AND","questions.question LIKE :question",'question','%'.$search['keyword'].'%');
		}
		if($search['questiontype'])
		{
			$args[] = array("AND","questions.questiontype = :questiontype",'questiontype',$search['questiontype']);
		}
		if($search['questionlevel'])
		{
			$args[] = array("AND","questions.questionlevel = :questionlevel",'questionlevel',$search['questionlevel']);
		}
		if($search['questionknowsid'])
		{
			$args[] = array("AND","quest2knows.qkknowsid = :qkknowsid",'qkknowsid',$search['questionknowsid']);
		}
		else
		{
			$tmpknows = '0';
			if($search['questionsectionid'])
			{
				$knows = M('section','exam')->getKnowsListByArgs(array(array("AND","knowsstatus = 1"),array("AND","knowssectionid = :knowssectionid",'knowssectionid',$search['questionsectionid'])));
				foreach($knows as $p)
				{
					if($p['knowsid'])$tmpknows .= ','.$p['knowsid'];
				}
				$args[] = array("AND","find_in_set(quest2knows.qkknowsid,:qkknowsid)",'qkknowsid',$tmpknows);
			}
			else
			{
				$knows = M('section','exam')->getAllKnowsBySubject($basic['basicsubjectid']);
				foreach($knows as $p)
				{
					if($p['knowsid'])$tmpknows .= ','.$p['knowsid'];
				}
				$args[] = array("AND","find_in_set(quest2knows.qkknowsid,:qkknowsid)",'qkknowsid',$tmpknows);
			}
		}
		$questions = M('exam','exam')->getQuestionsList($page,10,$args);
		$knows = M('section','exam')->getKnowsListByArgs(array(array("AND","knowsstatus = 1"),array("AND","knowssectionid = :knowssectionid",'knowssectionid',$search['questionsectionid'])));
        $questypes = M('basic','exam')->getQuestypeList();
		M('tpl')->assign('questypes',$questypes);
		M('tpl')->assign('knows',$knows);
		M('tpl')->assign('questions',$questions);
		M('tpl')->assign('sections',$sections);
		M('tpl')->assign('search',$search);
		M('tpl')->assign('page',$page);
		M('tpl')->display('questions');
	}
}


?>
