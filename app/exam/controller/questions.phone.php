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
		if(!method_exists($this,$action))
		$action = "index";
		$this->$action();
		exit;
	}

	private function getknowsbysectionid()
	{
		$sectionid = $this->ev->get('sectionid');
		$aknows = $this->section->getKnowsListByArgs(array(array("AND","knowssectionid = :knowssectionid",'knowssectionid',$sectionid),array("AND","knowsstatus = 1")));
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
		$questionid = $this->ev->get('questionid');
		$questionparent = $this->ev->get('questionparent');
		if($questionparent)
		{
			$questions = $this->exam->getQuestionByArgs(array(array("AND","questionparent = :questionparent",'questionparent',$questionparent)));
		}
		else
		{
			$question = $this->exam->getQuestionByArgs(array(array("AND","questionid = :questionid",'questionid',$questionid)));
			$sections = array();
			foreach($question['questionknowsid'] as $key => $p)
			{
				$knows = $this->section->getKnowsByArgs(array(array("AND","knowsid = :knowsid",'knowsid',$p['knowsid'])));
				$question['questionknowsid'][$key]['knows'] = $knows['knows'];
				$sections[] = $this->section->getSectionByArgs(array(array("AND","sectionid = :sectionid",'sectionid',$knows['knowssectionid'])));
			}
			$subject = $this->basic->getSubjectById($sections[0]['sectionsubjectid']);
		}
		$this->tpl->assign("subject",$subject);
		$this->tpl->assign("sections",$sections);
		$this->tpl->assign("question",$question);
		$this->tpl->assign("questions",$questions);
		$this->tpl->display('question_detail');
	}

	private function child()
	{
		$questionid = $this->ev->get('questionid');
		$question = $this->exam->getQuestionRowsByArgs(array(array("AND","qrid = :qrid",'qrid',$questionid)));
		$sections = array();
		foreach($question['qrknowsid'] as $key => $p)
		{
			$knows = $this->section->getKnowsByArgs(array(array("AND","knowsid = :knowsid",'knowsid',$p['knowsid'])));
			$question['qrknowsid'][$key]['knows'] = $knows['knows'];
			$sections[] = $this->section->getSectionByArgs(array(array("AND","sectionid = :sectionid",'sectionid',$knows['knowssectionid'])));
		}
		$subject = $this->basic->getSubjectById($sections[0]['sectionsubjectid']);
		$this->tpl->assign("subject",$subject);
		$this->tpl->assign("sections",$sections);
		$this->tpl->assign("question",$question);
		$this->tpl->display('questions_child');
	}

	private function questionrows()
	{
		$page = $this->ev->get('page');
		$page = $page > 0?$page:1;
		$questypes = $this->basic->getQuestypeList();
		$basic = $this->data['currentbasic'];
		$search = $this->ev->get('search');
		$args = array(array("AND","quest2knows.qkquestionid = questionrows.qrid"),array("AND","quest2knows.qktype = 1"),array("AND","questionrows.qrstatus = '1'"));
		if($search['questiontype'])
		{
			$args[] = array("AND","questionrows.qrtype = :qrtype",'qrtype',$search['questiontype']);
		}
		if($search['keyword'])
		{
			$args[] = array("AND","questionrows.qrquestion LIKE :qrquestion",'qrquestion',"%".$search['keyword']."%");
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
				$knows = $this->section->getKnowsListByArgs(array(array("AND","knowsstatus = 1"),array("AND","knowssectionid = :knowssectionid",'knowssectionid',$search['questionsectionid'])));
				foreach($knows as $p)
				{
					if($p['knowsid'])$tmpknows .= ','.$p['knowsid'];
				}
				$args[] = array("AND","find_in_set(quest2knows.qkknowsid,:qkknowsid)",'qkknowsid',$tmpknows);
			}
			else
			{
				$knows = $this->section->getAllKnowsBySubject($basic['basicsubjectid']);
				foreach($knows as $p)
				{
					if($p['knowsid'])$tmpknows .= ','.$p['knowsid'];
				}
				$args[] = array("AND","find_in_set(quest2knows.qkknowsid,:qkknowsid)",'qkknowsid',$tmpknows);
			}
		}
		$questions = $this->exam->getQuestionrowsList($page,10,$args);
		$subjects = $this->basic->getSubjectList();
		$sections = $this->section->getSectionListByArgs(array(array("AND","sectionsubjectid = :sectionsubjectid",'sectionsubjectid',$basic['basicsubjectid'])));
		$knows = $this->section->getKnowsListByArgs(array(array("AND","knowsstatus = 1"),array("AND","knowssectionid = :knowssectionid",'knowssectionid',$search['questionsectionid'])));
		$this->tpl->assign('search',$search);
		$this->tpl->assign('subjects',$subjects);
		$this->tpl->assign('sections',$sections);
		$this->tpl->assign('knows',$knows);
		$this->tpl->assign('questypes',$questypes);
		$this->tpl->assign('questions',$questions);
		$this->tpl->display('question_rows');
	}

	public function questions()
	{
		$page = $this->ev->get('page');
		$search = $this->ev->get('search');
		$basic = $this->data['currentbasic'];
		$args = array(array("AND","quest2knows.qkquestionid = questions.questionid"),array("AND","questions.questionstatus = '1'"),array("AND","questions.questionparent = 0"),array("AND","quest2knows.qktype = 0") );
		if($search['keyword'])
		{
			$args[] = array("AND","question LIKE :question",'question','%'.$search['keyword'].'%');
		}
		if($search['questiontype'])
		{
			$args[] = array("AND","questiontype = :questiontype",'questiontype',$search['questiontype']);
		}
		$ids = array();
		foreach($basic['basicknows'] as $knows)
		{
			foreach($knows as $kn)
			{
				$ids[] = $kn;
			}
		}
		$args[] = array("AND","quest2knows.qkknowsid in (:qkknowsid)",'qkknowsid',$ids);
		$questions = $this->exam->getQuestionsList($page,50,$args);
		$this->tpl->assign('questions',$questions);
		$this->tpl->assign('search',$search);
		$this->tpl->assign('page',$page);
		$this->tpl->display('questions_questions');
	}

	public function index()
	{
		$this->tpl->display('questions');
	}
}


?>
