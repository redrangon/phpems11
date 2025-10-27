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

    private function batdel()
    {
        $page = M('ev')->get('page');
        $delids = M('ev')->get('delids');
        foreach($delids as $questionid => $p)
            M('exam','exam')->delQuestionRows($questionid);
        $message = array(
            'statusCode' => 200,
            "message" => "操作成功",
            "callbackType" => "forward",
            "forwardUrl" => "index.php?exam-teach-rowsquestions&page={$page}{$u}"
        );
        \PHPEMS\ginkgo::R($message);
    }

	private function delquestion()
	{
		$page = M('ev')->get('page');
		$questionid = M('ev')->get('questionid');
		$question = M('exam','exam')->getQuestionRowsByArgs("qrid = '{$questionid}'");
		if($question['data'])
		{
			$message = array(
				'statusCode' => 300,
				"message" => "操作失败，请先删除子试题"
			);
			\PHPEMS\ginkgo::R($message);
		}
		M('exam','exam')->delQuestionRows($questionid);
		$message = array(
			'statusCode' => 200,
			"message" => "操作成功",
			"callbackType" => "forward",
		    "forwardUrl" => "index.php?exam-teach-rowsquestions&page={$page}{$u}"
		);
		\PHPEMS\ginkgo::R($message);
	}

	private function delchildquestion()
	{
		$page = M('ev')->get('page');
		$questionid = M('ev')->get('questionid');
		$questionparent = M('ev')->get('questionparent');
		M('exam','exam')->delQuestions($questionid);
		M('exam','exam')->resetRowsQuestionNumber($questionparent);
		$message = array(
			'statusCode' => 200,
			"message" => "操作成功",
			"callbackType" => "forward",
			"forwardUrl" => "index.php?exam-teach-rowsquestions-rowsdetail&questionid={$questionparent}&page={$page}{$u}"
		);
		\PHPEMS\ginkgo::R($message);
	}

	private function backquestion()
	{
		$page = M('ev')->get('page');
		$questionid = M('ev')->get('questionid');
		$questions = M('exam','exam')->backQuestionRows($questionid);
		$message = array(
			'statusCode' => 200,
			"message" => "操作成功",
			"callbackType" => "forward",
		    "forwardUrl" => "index.php?exam-teach-recyle-rows&page={$page}"
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
			M('exam','exam')->modifyQuestionRows($questionid,$args);
			$message = array(
				'statusCode' => 200,
				"message" => "操作成功",
				"callbackType" => "forward",
			    "forwardUrl" => "index.php?exam-teach-rowsquestions&page={$page}{$u}"
			);
			\PHPEMS\ginkgo::R($message);
		}
		else
		{
			$page = M('ev')->get('page');
			$questionid = M('ev')->get('questionid');
			$question = M('exam','exam')->getQuestionRowsByArgs(array(array("AND","qrid = :qrid",'qrid',$questionid)));
			$subjects = M('basic','exam')->getSubjectList(array(array("AND","find_in_set(subjectid,:subjectid)",'subjectid',$this->teachsubjects)));
			$questypes = M('basic','exam')->getQuestypeList();
			foreach($question['qrknowsid'] as $key => $p)
			{
				$knows = M('section','exam')->getKnowsByArgs(array(array("AND","knowsid = :knowsid",'knowsid',$p['knowsid'])));
				$question['qrknowsid'][$key]['knows'] = $knows['knows'];
			}
			M('tpl')->assign('questypes',$questypes);
			M('tpl')->assign('subjects',$subjects);
			M('tpl')->assign('page',$page);
			M('tpl')->assign('question',$question);
			M('tpl')->display('questionrows_modify');
		}
	}

	private function modifychildquestion()
	{
		if(M('ev')->get('modifyquestion'))
		{
			$page = M('ev')->get('page');
			$args = M('ev')->get('args');
			$questionid = M('ev')->get('questionid');
			$targs = M('ev')->get('targs');
			$questype = M('basic','exam')->getQuestypeById($args['questiontype']);
			if($questype['questsort'])$choice = 0;
			else $choice = $questype['questchoice'];
			$args['questionanswer'] = $targs['questionanswer'.$choice];
			if(is_array($args['questionanswer']))$args['questionanswer'] = implode('',$args['questionanswer']);
			M('exam','exam')->modifyQuestions($questionid,$args);
			$message = array(
				'statusCode' => 200,
				"message" => "操作成功",
				"callbackType" => "forward",
				"forwardUrl" => "index.php?exam-teach-rowsquestions-rowsdetail&questionid={$args['questionparent']}&page={$page}{$u}"
			);
			\PHPEMS\ginkgo::R($message);
		}
		else
		{
			$page = M('ev')->get('page');
			$questionparent = M('ev')->get('questionparent');
			$knowsid = M('ev')->get('knowsid');
			$questionid = M('ev')->get('questionid');
			$questypes = M('basic','exam')->getQuestypeList();
			$question = M('exam','exam')->getQuestionByArgs(array(array("AND","questionid = :questionid",'questionid',$questionid)));
			$subjects = M('basic','exam')->getSubjectList(array(array("AND","find_in_set(subjectid,:subjectid)",'subjectid',$this->teachsubjects)));
			M('tpl')->assign('subjects',$subjects);
			M('tpl')->assign('questionparent',$questionparent);
			M('tpl')->assign('questypes',$questypes);
			M('tpl')->assign('page',$page);
			M('tpl')->assign('knowsid',$knowsid);
			M('tpl')->assign('question',$question);
			M('tpl')->display('questionchildrows_modify');
		}
	}

	private function detail()
	{
		$questionid = M('ev')->get('questionid');
		$question = M('exam','exam')->getQuestionRowsByArgs("qrid = '{$questionid}'");
		$sections = array();
		foreach($question['qrknowsid'] as $key => $p)
		{
			$knows = M('section','exam')->getKnowsByArgs("knowsid = '{$p['knowsid']}'");
			$question['qrknowsid'][$key]['knows'] = $knows['knows'];
			$sections[] = M('section','exam')->getSectionByArgs("sectionid = '{$knows['knowssectionid']}'");
		}
		$subject = M('basic','exam')->getSubjectById($sections[0]['sectionsubjectid']);
		M('tpl')->assign("subject",$subject);
		M('tpl')->assign("sections",$sections);
		M('tpl')->assign("question",$question);
		M('tpl')->display('questionrows_detail');
	}

	private function rowsdetail()
	{
		$questionid = M('ev')->get('questionid');
		$question = M('exam','exam')->getQuestionRowsByArgs(array(array("AND","qrid = :qrid",'qrid',$questionid)));
		$questypes = M('basic','exam')->getQuestypeList();
		M('tpl')->assign('questypes',$questypes);
		M('tpl')->assign("question",$question);
		M('tpl')->assign("questionparent",$questionid);
		M('tpl')->display('questionrows_list');
	}

	private function addchildquestion()
	{
		if(M('ev')->get('insertquestion'))
		{
			$questionparent = M('ev')->get('questionparent');
			$args = M('ev')->get('args');
			$targs = M('ev')->get('targs');
			if(!$questionparent)$questionparent = $args['questionparent'];
			$questype = M('basic','exam')->getQuestypeById($args['questiontype']);
			$args['questionuserid'] = $this->user['userid'];
			if($questype['questsort'])$choice = 0;
			else $choice = $questype['questchoice'];
			$args['questionanswer'] = $targs['questionanswer'.$choice];
			if(is_array($args['questionanswer']))$args['questionanswer'] = implode('',$args['questionanswer']);
			$page = M('ev')->get('page');
			$args['questioncreatetime'] = TIME;
			$args['questionusername'] = $this->user['sessionusername'];
			M('exam','exam')->addQuestions($args);
			M('exam','exam')->resetRowsQuestionNumber($questionparent);
			$message = array(
				'statusCode' => 200,
				"message" => "操作成功",
				"callbackType" => "forward",
				"forwardUrl" => "index.php?exam-teach-rowsquestions-rowsdetail&questionid={$questionparent}&page={$page}{$u}"
			);
			\PHPEMS\ginkgo::R($message);
		}
		else
		{
			$questionid = M('ev')->get('questionid');
			$question = M('exam','exam')->getQuestionRowsByArgs(array(array("AND","qrid = :qrid",'qrid',$questionid)));
			$questypes = M('basic','exam')->getQuestypeList();
			M('tpl')->assign('questypes',$questypes);
			M('tpl')->assign("question",$question);
			M('tpl')->assign("questionparent",$questionid);
			M('tpl')->display('questionrows_addchild');
		}
	}

	private function bataddchildquestion()
	{
		if(M('ev')->get('insertquestion'))
		{
			$questionparent = M('ev')->get('questionparent');
			$page = M('ev')->get('page');
			$content = M('ev')->get('content');
			M('exam','exam')->insertQuestionBat($content,$questionparent);
			M('exam','exam')->resetRowsQuestionNumber($questionparent);
			$message = array(
				'statusCode' => 200,
				"message" => "操作成功",
				"forwardUrl" => "index.php?exam-teach-rowsquestions-rowsdetail&questionid={$questionparent}&page={$page}{$u}"
			);
			\PHPEMS\ginkgo::R($message);
		}
		else
		{
			$questionid = M('ev')->get('questionid');
			$question = M('exam','exam')->getQuestionRowsByArgs("qrid = '{$questionid}'");
			$questypes = M('basic','exam')->getQuestypeList();
			M('tpl')->assign('questypes',$questypes);
			M('tpl')->assign("question",$question);
			M('tpl')->assign("questionparent",$questionid);
			M('tpl')->display('questionrows_bataddchild');
		}
	}

	private function done()
	{
		$sequence = M('ev')->get('sequence');
		$questionparent = M('ev')->get('questionparent');
		foreach($sequence as $key => $l)
		{
			M('exam','exam')->modifyQuestionSequence($key,array('questionsequence'=>$l));
		}
		$message = array(
			'statusCode' => 200,
			"message" => "操作成功",
			"callbackType" => "forward",
			"forwardUrl" => "index.php?exam-teach-rowsquestions-rowsdetail&questionid={$questionparent}&page={$page}{$u}"
		);
		\PHPEMS\ginkgo::R($message);
	}

	private function bataddquestionrows()
	{
		if(M('ev')->get('insertquestion'))
		{
			$page = M('ev')->get('page');
			$content = M('ev')->get('content');
			M('exam','exam')->insertQuestionRowsBat($content);
			$message = array(
				'statusCode' => 200,
				"message" => "操作成功",
				"callbackType" => "forward",
			    "forwardUrl" => "index.php?exam-teach-rowsquestions&page={$page}{$u}"
			);
			\PHPEMS\ginkgo::R($message);
		}
		else
		{
			$subjects = M('basic','exam')->getSubjectList(array(array("AND","find_in_set(subjectid,:subjectid)",'subjectid',$this->teachsubjects)));
			M('tpl')->assign('subjects',$subjects);
			M('tpl')->display('questionrows_batadd');
		}
	}

	private function addquestionrows()
	{
		if(M('ev')->get('insertquestion'))
		{
			$args = M('ev')->get('args');
			$args['qrtime'] = TIME;
			$args['qruserid'] = $this->user['userid'];
			$args['qrusername'] = $this->user['username'];
			M('exam','exam')->addQuestionRows($args);
			$message = array(
				'statusCode' => 200,
				"message" => "操作成功",
				"callbackType" => "forward",
			    "forwardUrl" => "index.php?exam-teach-rowsquestions&page={$page}{$u}"
			);
			\PHPEMS\ginkgo::R($message);
		}
		else
		{
			$subjects = M('basic','exam')->getSubjectList(array(array("AND","find_in_set(subjectid,:subjectid)",'subjectid',$this->teachsubjects)));
			$questypes = M('basic','exam')->getQuestypeList();
			M('tpl')->assign('questypes',$questypes);
			M('tpl')->assign('subjects',$subjects);
			M('tpl')->display('questionrows_add');
		}
	}

	private function index()
	{
		$page = M('ev')->get('page');
		$search = M('ev')->get('search');
		$page = $page > 0?$page:1;
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
			$args[] = array("AND","questionrows.qrquestion LIKE :qrquestion",'qrquestion',"%{$search['keyword']}%");
		}
		if($search['username'])
		{
			$args[] = array("AND","questionrows.qrusername = :qrusername",'qrusername',$search['username']);
		}
		if($search['stime'])
		{
			$args[] = array("AND","questionrows.qrtime >= :sqrtime",'sqrtime',strtotime($search['stime']));
		}
		if($search['etime'])
		{
			$args[] = array("AND","questionrows.qrtime >= :eqrtime",'eqrtime',strtotime($search['etime']));
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
				$args[] = array('AND',"find_in_set(quest2knows.qkknowsid,:qkknowsids)","qkknowsids",$tmpknows);
			}
			elseif($search['questionsubjectid'])
			{
				$knows = M('section','exam')->getAllKnowsBySubject($search['questionsubjectid']);
				foreach($knows as $p)
				{
					if($p['knowsid'])$tmpknows .= ','.$p['knowsid'];
				}
				$args[] = array('AND',"find_in_set(quest2knows.qkknowsid,:qkknowsids)","qkknowsids",$tmpknows);
			}
			else
			{
				$knows = M('section','exam')->getAllKnowsBySubjects($this->teachsubjects);
				foreach($knows as $p)
				{
					if($p['knowsid'])$tmpknows .= ','.$p['knowsid'];
				}
				$args[] = array('AND',"find_in_set(quest2knows.qkknowsid,:qkknowsids)","qkknowsids",$tmpknows);
			}
		}
		$questypes = M('basic','exam')->getQuestypeList();
		$questions = M('exam','exam')->getQuestionrowsList($page,50,$args);
		$subjects = M('basic','exam')->getSubjectList(array(array("AND","find_in_set(subjectid,:subjectid)",'subjectid',$this->teachsubjects)));
		$sections = M('section','exam')->getSectionListByArgs(array(array("AND","sectionsubjectid = :sectionsubjectid",'sectionsubjectid',$search['questionsubjectid'])));
		$knows = M('section','exam')->getKnowsListByArgs(array(array("AND","knowsstatus = 1"),array("AND","knowssectionid = :knowssectionid",'knowssectionid',$search['questionsectionid'])));
		M('tpl')->assign('subjects',$subjects);
		M('tpl')->assign('sections',$sections);
		M('tpl')->assign('knows',$knows);
		M('tpl')->assign('questypes',$questypes);
		M('tpl')->assign('questions',$questions);
		M('tpl')->display('questionrows');
	}
}


?>
