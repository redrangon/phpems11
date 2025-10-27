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
		$search = M('ev')->get('search');
		$this->u = '';
		if($search)
		{
			M('tpl')->assign('search',$search);
			foreach($search as $key => $arg)
			{
				$this->u .= "&search[{$key}]={$arg}";
			}
		}
		M('tpl')->assign('u',$this->u);
		$this->$action();
		exit;
	}

	private function makequery()
	{
		$message = array(
			"statusCode" => 200,
			"message" => "操作成功，正在转入查询结果",
			"callbackType" => "forward",
		    "forwardUrl" => "index.php?exam-master-questions{$u}"
		);
		\PHPEMS\ginkgo::R($message);
	}

	private function filebataddquestion()
	{
		if(M('ev')->get('insertquestion'))
		{
			$page = M('ev')->get('page');
			$uploadfile = M('ev')->get('uploadfile');
			$knowsid = trim(M('ev')->get('knowsid'));
			M('exam','exam')->importQuestionBat($uploadfile,$knowsid,$this->user);
			$message = array(
				'statusCode' => 200,
				"message" => "操作成功",
				"callbackType" => "forward",
			    "forwardUrl" => "index.php?exam-master-questions&page={$page}{$this->u}"
			);
			\PHPEMS\ginkgo::R($message);
		}
		else
		M('tpl')->display('question_filebatadd');
	}

	private function addquestion()
	{
		if(M('ev')->get('insertquestion'))
		{
			$type = M('ev')->get('type');
			$questionparent = M('ev')->get('questionparent');
			//批量添加
			if($type)
			{
				$page = M('ev')->get('page');
				$content = M('ev')->get('content');
				M('exam','exam')->insertQuestionBat($content,$questionparent);
			}
			//单个添加
			else
			{
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
			}
			if($questionparent)
			{
				M('exam','exam')->resetRowsQuestionNumber($questionparent);
				$message = array(
					'statusCode' => 200,
					"message" => "操作成功",
					"callbackType" => "forward",
					"forwardUrl" => "index.php?exam-master-rowsquestions-rowsdetail&questionid={$questionparent}&page={$page}{$u}"
				);
			}
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
			$search = M('ev')->get('search');
			$questypes = M('basic','exam')->getQuestypeList();
			$subjects = M('basic','exam')->getSubjectList();
			$sections = M('section','exam')->getSectionListByArgs(array(array("AND","sectionsubjectid = :sectionsubjectid",'sectionsubjectid',$search['questionsubjectid'])));
			$knows = M('section','exam')->getKnowsListByArgs(array(array("AND","knowsstatus = 1"),array("AND","knowssectionid = :knowssectionid",'knowssectionid',$search['questionsectionid'])));
			M('tpl')->assign('subjects',$subjects);
			M('tpl')->assign('sections',$sections);
			M('tpl')->assign('knows',$knows);
			M('tpl')->assign('questypes',$questypes);
			M('tpl')->display('question_add');
		}
	}

	private function bataddquestion()
	{
		if(M('ev')->get('insertquestion'))
		{
			$page = M('ev')->get('page');
			$questionparent = M('ev')->get('questionparent');
			$content = M('ev')->get('content');
			M('exam','exam')->insertQuestionBat($content,$questionparent);
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
			M('tpl')->display('question_batadd');
		}
	}

	private function delquestion()
	{
		$page = M('ev')->get('page');
		$questionid = M('ev')->get('questionid');
		$questionparent = M('ev')->get('questionparent');
		M('exam','exam')->delQuestions($questionid);
		$message = array(
			'statusCode' => 200,
			"message" => "操作成功",
			"callbackType" => "forward",
		    "forwardUrl" => "index.php?exam-master-questions&page={$page}{$u}"
		);
		\PHPEMS\ginkgo::R($message);
	}

	private function batdel()
	{
		$page = M('ev')->get('page');
		$delids = M('ev')->get('delids');
		foreach($delids as $questionid => $p)
		M('exam','exam')->delQuestions($questionid);
		$message = array(
			'statusCode' => 200,
			"message" => "操作成功",
			"callbackType" => "forward",
		    "forwardUrl" => "index.php?exam-master-questions&page={$page}{$u}"
		);
		\PHPEMS\ginkgo::R($message);
	}

	private function backquestion()
	{
		$page = M('ev')->get('page');
		$questionid = M('ev')->get('questionid');
		$questions = M('exam','exam')->backQuestions($questionid);
		$message = array(
			'statusCode' => 200,
			"message" => "操作成功",
			"callbackType" => "forward",
		    "forwardUrl" => "index.php?exam-master-recyle&page={$page}"
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
			$questype = M('basic','exam')->getQuestypeById($args['questiontype']);
			if($questype['questsort'])$choice = 0;
			else $choice = $questype['questchoice'];
			$args['questionanswer'] = $targs['questionanswer'.$choice];
			if(is_array($args['questionanswer']))$args['questionanswer'] = implode('',$args['questionanswer']);
			M('exam','exam')->modifyQuestions($questionid,$args);
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
			$questypes = M('basic','exam')->getQuestypeList();
			$question = M('exam','exam')->getQuestionByArgs(array(array("AND","questionid = :questionid",'questionid',$questionid)));
			if($question['questionparent'])
			{
				header("location:index.php?exam-master-rowsquestions-modifychildquestion&page={$page}&questionparent={$question['questionparent']}&questionid={$questionid}");
				exit;
			}
			$subjects = M('basic','exam')->getSubjectList();
			foreach($question['questionknowsid'] as $key => $p)
			{
				$knows = M('section','exam')->getKnowsByArgs(array(array("AND","knowsid = :knowsid",'knowsid',$p['knowsid'])));
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

	private function ajax()
	{
		switch(M('ev')->url(4))
		{
			//根据章节获取知识点信息
			case 'getknowsbysectionid':
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
			//exit(json_encode($data));
			break;

			//根据科目获取章节信息
			case 'getsectionsbysubjectid':
			$esid = M('ev')->get('subjectid');
			$aknows = M('section','exam')->getSectionListByArgs(array(array("AND","sectionsubjectid = :sectionsubjectid",'sectionsubjectid',$esid)));
			$data = array(array(0,'选择章节'));
			foreach($aknows as $knows)
			{
				$data[] = array($knows['sectionid'],$knows['section']);
			}
			foreach($data as $p)
			{
				echo "<option value=\"{$p[0]}\">{$p[1]}</option>";
			}
			//exit(json_encode($data));
			break;

			default:
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

	private function index()
	{
		$search = M('ev')->get('search');
		$page = M('ev')->get('page');
		$page = $page > 0?$page:1;
		$args = array(array("AND","quest2knows.qkquestionid = questions.questionid"),array("AND","questions.questionstatus = '1'"),array("AND","questions.questionparent = 0"),array("AND","quest2knows.qktype = 0") );
		if($search['questionid'])
		{
			$args[] = array("AND","questions.questionid = :questionid",'questionid',$search['questionid']);
		}
		if($search['keyword'])
		{
			$args[] = array("AND","questions.question LIKE :question",'question','%'.$search['keyword'].'%');
		}
		if($search['username'])
		{
			$args[] = array("AND","questions.questionusername = :questionusername",'questionusername',$search['username']);
		}
		if($search['knowsids'])
		{
			$args[] = array("AND","find_in_set(questions.questionknowsid,:questionknowsid)",'questionknowsid',$search['knowsids']);
		}
		if($search['stime'])
		{
			$args[] = array("AND","questions.questioncreatetime >= :questioncreatetime",'questioncreatetime',strtotime($search['stime']));
		}
		if($search['etime'])
		{
			$args[] = array("AND","questions.questioncreatetime <= :questionendtime",'questionendtime',strtotime($search['etime']));
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
			elseif($search['questionsubjectid'])
			{
				$knows = M('section','exam')->getAllKnowsBySubject($search['questionsubjectid']);
				foreach($knows as $p)
				{
					if($p['knowsid'])$tmpknows .= ','.$p['knowsid'];
				}
				$args[] = array("AND","find_in_set(quest2knows.qkknowsid,:qkknowsid)",'qkknowsid',$tmpknows);
			}
		}
		$questypes = M('basic','exam')->getQuestypeList();
		if($search)
		$questions = M('exam','exam')->getQuestionsList($page,50,$args);
		else
		$questions = M('exam','exam')->getSimpleQuestionsList($page,50,array(array("AND","questionstatus = '1'"),array("AND","questionparent = 0")));
		$subjects = M('basic','exam')->getSubjectList();
		$sections = M('section','exam')->getSectionListByArgs(array(array("AND","sectionsubjectid = :sectionsubjectid",'sectionsubjectid',$search['questionsubjectid'])));
		$knows = M('section','exam')->getKnowsListByArgs(array(array("AND","knowsstatus = 1"),array("AND","knowssectionid = :knowssectionid",'knowssectionid',$search['questionsectionid'])));
		M('tpl')->assign('subjects',$subjects);
		M('tpl')->assign('sections',$sections);
		M('tpl')->assign('knows',$knows);
		M('tpl')->assign('questypes',$questypes);
		M('tpl')->assign('questions',$questions);
		M('tpl')->display('questions');
	}
}


?>
