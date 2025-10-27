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
		$page = M('ev')->get('page');
		$attid = M('ev')->get('attid');
		M('attach','document')->delAttach($attid);
		$message = array(
			'statusCode' => 200,
			"message" => "操作成功",
			"callbackType" => "forward",
		    "forwardUrl" => "reload"
		);
		\PHPEMS\ginkgo::R($message);
	}

	private function batdel()
	{
		$page = M('ev')->get('page');
		$delids = M('ev')->get('delids');
		foreach($delids as $attid => $p)
		M('attach','document')->delAttach($attid);
		$message = array(
			'statusCode' => 200,
			"message" => "操作成功",
			"callbackType" => "forward",
		    "forwardUrl" => "reload"
		);
		\PHPEMS\ginkgo::R($message);
	}

	private function modifyquestion()
	{
		if(M('ev')->get('modifyquestion'))
		{
			$page = M('ev')->get('page');
			$args = M('ev')->get('args');
			$questionid = M('ev')->get('questionid');
			$targs = M('ev')->get('targs');
			$questype = $this->basic->getQuestypeById($args['questiontype']);
			if($questype['questsort'])$choice = 0;
			else $choice = $questype['questchoice'];
			$args['questionanswer'] = $targs['questionanswer'.$choice];
			if(is_array($args['questionanswer']))$args['questionanswer'] = implode('',$args['questionanswer']);
			$this->exam->modifyQuestions($questionid,$args);
			if($args['questionparent'])
			$message = array(
				'statusCode' => 200,
				"message" => "操作成功",
				"callbackType" => "forward",
				"forwardUrl" => "index.php?exam-master-questions&page={$page}{$u}"
			);
			else
			$message = array(
				'statusCode' => 200,
				"message" => "操作成功",
				"callbackType" => "forward",
			    "forwardUrl" => "index.php?exam-master-questions&page={$page}{$u}"
			);
			\PHPEMS\ginkgo::R($message);
		}
		else
		{
			$page = M('ev')->get('page');
			$questionparent = M('ev')->get('questionparent');
			$knowsid = M('ev')->get('knowsid');
			$questionid = M('ev')->get('questionid');
			$questypes = $this->basic->getQuestypeList();
			$question = $this->exam->getQuestionByArgs("questionid = '{$questionid}'");
			$subjects = $this->basic->getSubjectList();
			foreach($question['questionknowsid'] as $key => $p)
			{
				$knows = $this->section->getKnowsByArgs("knowsid = '{$p['knowsid']}'");
				$question['questionknowsid'][$key]['knows'] = $knows['knows'];
			}
			M('tpl')->assign('subjects',$subjects);
			M('tpl')->assign('questionparent',$questionparent);
			M('tpl')->assign('questypes',$questypes);
			M('tpl')->assign('page',$page);
			M('tpl')->assign('knowsid',$knowsid);
			M('tpl')->assign('question',$question);
			if($questionparent)
			M('tpl')->display('questionchildrows_modify');
			else
			M('tpl')->display('questions_modify');
		}
	}

	private function detail()
	{
		$questionid = M('ev')->get('questionid');
		$questionparent = M('ev')->get('questionparent');
		if($questionparent)
		{
			$questions = $this->exam->getQuestionByArgs("questionparent = '{$questionparent}'");
		}
		else
		{
			$question = $this->exam->getQuestionByArgs("questionid = '{$questionid}'");
			$sections = array();
			foreach($question['questionknowsid'] as $key => $p)
			{
				$knows = $this->section->getKnowsByArgs("knowsid = '{$p['knowsid']}'");
				$question['questionknowsid'][$key]['knows'] = $knows['knows'];
				$sections[] = $this->section->getSectionByArgs("sectionid = '{$knows['knowssectionid']}'");
			}
			$subject = $this->basic->getSubjectById($sections[0]['sectionsubjectid']);
		}
		M('tpl')->assign("subject",$subject);
		M('tpl')->assign("sections",$sections);
		M('tpl')->assign("question",$question);
		M('tpl')->assign("questions",$questions);
		M('tpl')->display('question_detail');
	}

	private function index()
	{
		$search = M('ev')->get('search');
		$u = '';
		if($search)
		{
			M('tpl')->assign('search',$search);
			foreach($search as $key => $arg)
			{
				$u .= "&search[{$key}]={$arg}";
			}
		}
		M('tpl')->assign('u',$u);
		$page = M('ev')->get('page');
		M('tpl')->assign('page',$page);
		$page = $page > 0?$page:1;
		$types = M('attach','document')->getAttachtypeList();
		$args = array();
		if($search['attid'])
		{
			$args[] = array('AND',"attid = :attid",'attid',$search['attid']);
		}
		if($search['stime'])
		{
			$args[] = array('AND',"attinputtime >= :attinputtime",'attinputtime',strtotime($search['stime']));
		}
		if($search['etime'])
		{
			$args[] = array('AND',"attinputtime <= :attinputtime",'attinputtime',strtotime($search['etime']));
		}
		if($search['atttype'])
		{
			$exts = implode(',',explode(',',$types[$search['atttype']]['attachexts']));
			if($exts)
			$args[] = array('AND',"find_in_set(attext,:attext)",'attext',$exts);
		}
		if($search['username'])
		{
			$user = M('user','user')->getUserByUserName($search['username']);
			if($user)
			$args[] = array('AND',"attuserid = :attuserid",'attuserid',$user['userid']);
		}
		$attach = M('attach','document')->getAttachList($args,$page);
		M('tpl')->assign('attachtypes',$types);
		M('tpl')->assign('attach',$attach);
		M('tpl')->display('attachs');
	}
}


?>
