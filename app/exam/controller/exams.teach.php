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

	private function selectexams()
	{
		$search = M('ev')->get('search');
		$useframe = M('ev')->get('useframe');
		$target = M('ev')->get('target');
		$page = M('ev')->get('page');
		$page = $page > 0?$page:1;
		M('pg')->setUrlTarget('modal-body" class="ajax');
		$args = array();
		if($search)
		{
			if($search['subjectid'])$args[] = array("AND","examsubject = :examsubject",'examsubject',$search['subjectid']);
		}
		if(!count($args))$args = 1;
		$exams = M('exam','exam')->getExamSettingList($args,$page,10);
		$subjects = M('basic','exam')->getSubjectList();
		M('tpl')->assign('subjects',$subjects);
		M('tpl')->assign('target',$target);
		M('tpl')->assign('exams',$exams);
		M('tpl')->display('exams_ajax');
	}

	private function delexam()
	{
		$examid = M('ev')->get('examid');
		$page = M('ev')->get('page');
		M('exam','exam')->delExamSetting($examid);
		$message = array(
			'statusCode' => 200,
			"message" => "操作成功",
			"callbackType" => "forward",
		    "forwardUrl" => "index.php?exam-teach-exams&page={$page}{$u}"
		);
		\PHPEMS\ginkgo::R($message);
	}

	private function ajax()
	{
		switch(M('ev')->url(4))
		{
			default:
			$subjectid = M('ev')->get('subjectid');
			$type = M('ev')->get('type');
			if($subjectid)
			{
				$basic = M('basic','exam')->getBasicBySubjectId($subjectid);
				$questypes = M('basic','exam')->getQuestypeList();
				M('tpl')->assign('questypes',$questypes);
				M('tpl')->assign("type",$type);
				M('tpl')->assign("subjectid",$subjectid);
				M('tpl')->assign("basic",$basic);
				M('tpl')->display('exams_ajaxsetting');
			}
		}
	}

	private function score()
	{
		$examid = M('ev')->get('examid');
		$exam = M('exam','exam')->getExamSettingById($examid);
		$questypes = M('basic','exam')->getQuestypeList();
		M('tpl')->assign("questypes",$questypes);
		if(M('ev')->get('scoreself'))
		{
			$score = M('ev')->get('score');
			$exam['examsetting']['scores'] = $score;
			M('exam','exam')->modifyExamSetting($examid,array('examsetting' => $exam['examsetting']));
			$message = array(
				'statusCode' => 200,
				"message" => "操作成功",
				"callbackType" => "forward",
				"forwardUrl" => "reload"
			);
			\PHPEMS\ginkgo::R($message);
		}
		else
		{
			foreach($exam['examquestions'] as $key => $p)
			{
				$qids = '';
				$qrids = '';
				if($p['questions'])
				{
					$qids = trim($p['questions']," ,");
				}
				if($qids)
				{
					$questions[$key] = M('exam','exam')->getQuestionListByIds($qids);
				}
				if($p['rowsquestions'])
				{
					$qrids = trim($p['rowsquestions']," ,");
				}
				if($qrids)
				{
					$qrids = explode(",",$qrids);
					foreach($qrids as $t)
					{
						$qr = M('exam','exam')->getQuestionRowsById($t);
						if($qr)
						{
							$questionrows[$key][$t] = $qr;
						}
					}
				}
			}
			$exam['examquestions'] = array('questions'=>$questions,'questionrows'=>$questionrows);
			M('tpl')->assign("exam",$exam);
			M('tpl')->display('exams_scoreself');
		}
	}

	private function del()
	{
		$page = M('ev')->get('page');
		$examid = M('ev')->get('examid');
		M('exam','exam')->delExamSetting($examid);
		$message = array(
			'statusCode' => 200,
			"message" => "操作成功",
			"callbackType" => "forward",
		    "forwardUrl" => "index.php?exam-teach-exams&page={$page}{$u}"
		);
		\PHPEMS\ginkgo::R($message);
	}

	private function autopage()
	{
		if(M('ev')->get('submitsetting'))
		{
			$args = M('ev')->get('args');
			$args['examsetting'] = $args['examsetting'];
			$args['examauthorid'] = $this->user['userid'];
			$args['examauthor'] = $this->user['username'];
			$args['examtype'] = 1;
			M('exam','exam')->addExamSetting($args);
			$message = array(
				'statusCode' => 200,
				"message" => "操作成功",
			    "forwardUrl" => "index.php?exam-teach-exams&page={$page}{$u}"
			);
			\PHPEMS\ginkgo::R($message);
		}
		else
		{
			$subjects = M('basic','exam')->getSubjectList(array(array('AND','find_in_set(subjectid,:subjectid)','subjectid',$this->teachsubjects)));
			$questypes = M('basic','exam')->getQuestypeList();
			M('tpl')->assign('questypes',$questypes);
			M('tpl')->assign('subjects',$subjects);
			M('tpl')->display('exams_auto');
		}
	}

	private function selfpage()
	{
		if(M('ev')->get('submitsetting'))
		{
			$args = M('ev')->get('args');
			$args['examsetting'] = $args['examsetting'];
			$args['examauthorid'] = $this->user['userid'];
			$args['examauthor'] = $this->user['username'];
			$args['examtype'] = 2;
			$args['examquestions'] = $args['examquestions'];
			$id = M('exam','exam')->addExamSetting($args);
			$message = array(
				'statusCode' => 200,
				"message" => "操作成功",
				"callbackType" => "forward",
			    "forwardUrl" => "index.php?exam-teach-exams-examself&examid={$id}&page={$page}{$u}"
			);
			\PHPEMS\ginkgo::R($message);
		}
		else
		{
			$subjects = M('basic','exam')->getSubjectList(array(array("AND","find_in_set(subjectid,:subjectid)",'subjectid',$this->teachsubjects)));
			$questypes = M('basic','exam')->getQuestypeList();
			M('tpl')->assign('questypes',$questypes);
			M('tpl')->assign('subjects',$subjects);
			M('tpl')->display('exams_self');
		}
	}

	private function temppage()
	{
		if(M('ev')->get('submitsetting'))
		{
			$args = M('ev')->get('args');
			$uploadfile = M('ev')->get('uploadfile');
			if(!$uploadfile)
			{
				$message = array(
					'statusCode' => 300,
					"message" => "请上传即时试卷试题"
				);
				\PHPEMS\ginkgo::R($message);
			}
			$args['examsetting'] = $args['examsetting'];
			$args['examauthorid'] = $this->user['userid'];
			$args['examauthor'] = $this->user['sessionusername'];
			$args['examtype'] = 3;
			setlocale(LC_ALL,'zh_CN');
			$handle = fopen($uploadfile,"r");
			$questions = array();
			$rindex = 0;
			$index = 0;
			while ($data = fgetcsv($handle))
			{
				$targs = array();
				$question = $data;
				if(count($question) >= 5)
				{
					$isqr = intval(trim($question[6]," \n\t"));
					if($isqr)
					{
						$istitle = intval(trim($question[7]," \n\t"));;
						if($istitle)
						{
							$rindex ++;
							$targs['qrid'] = 'qr_'.$rindex;
							$targs['qrtype'] = $question[0];
							$targs['qrquestion'] = M('ev')->addSlashes(htmlspecialchars(iconv("GBK","UTF-8//IGNORE",trim(nl2br($question[1])," \n\t"))));
							$targs['qrcreatetime'] = TIME;
							$questionrows[$targs['qrtype']][intval($rindex - 1)] = $targs;
						}
						else
						{
							$index ++;
							$targs['questionid'] = 'q_'.$index;
							$targs['questiontype'] = $question[0];
							$targs['question'] = M('ev')->addSlashes(htmlspecialchars(iconv("GBK","UTF-8//IGNORE",trim(nl2br($question[1])," \n\t"))));
							$targs['questionselect'] = M('ev')->addSlashes(htmlspecialchars(iconv("GBK","UTF-8//IGNORE",trim(nl2br($question[2])," \n\t"))));
							if(!$targs['questionselect'] && $targs['questiontype'] == 3)
							$targs['questionselect'] = '<p>A、对<p><p>B、错<p>';
							$targs['questionselectnumber'] = $question[3];
							$targs['questionanswer'] = M('ev')->addSlashes(htmlspecialchars(iconv("GBK","UTF-8//IGNORE",trim($question[4]," \n\t"))));
							$targs['questiondescribe'] = M('ev')->addSlashes(htmlspecialchars(iconv("GBK","UTF-8//IGNORE",trim($question[5]," \n\t"))));
							$targs['questioncreatetime'] = TIME;
							$questionrows[$targs['questiontype']][intval($rindex - 1)]['data'][] = $targs;
						}
					}
					else
					{
						$index++;
						$targs['questionid'] = 'q_'.$index;
						$targs['questiontype'] = $question[0];
						$targs['question'] = M('ev')->addSlashes(htmlspecialchars(iconv("GBK","UTF-8//IGNORE",trim(nl2br($question[1])," \n\t"))));
						$targs['questionselect'] = M('ev')->addSlashes(htmlspecialchars(iconv("GBK","UTF-8//IGNORE",trim(nl2br($question[2])," \n\t"))));
						if(!$targs['questionselect'] && $targs['questiontype'] == 3)
						$targs['questionselect'] = '<p>A、对<p><p>B、错<p>';
						$targs['questionselectnumber'] = intval($question[3]);
						$targs['questionanswer'] = M('ev')->addSlashes(htmlspecialchars(iconv("GBK","UTF-8//IGNORE",trim($question[4]," \n\t"))));
						$targs['questiondescribe'] = M('ev')->addSlashes(htmlspecialchars(iconv("GBK","UTF-8//IGNORE",trim($question[5]," \n\t"))));
						$targs['questioncreatetime'] = TIME;
						$questions[$targs['questiontype']][] = $targs;
					}
				}
			}
			$args['examquestions'] = array('questions' => $questions,'questionrows' => $questionrows);
			$id = M('exam','exam')->addExamSetting($args);
			$message = array(
				'statusCode' => 200,
				"message" => "操作成功",
				"callbackType" => "forward",
			    "forwardUrl" => "index.php?exam-teach-exams-examself&examid={$id}&page={$page}{$u}"
			);
			\PHPEMS\ginkgo::R($message);
		}
		else
		{
			$subjects = M('basic','exam')->getSubjectList();
			$questypes = M('basic','exam')->getQuestypeList();
			M('tpl')->assign('questypes',$questypes);
			M('tpl')->assign('subjects',$subjects);
			M('tpl')->display('exams_temp');
		}
	}

	private function selected()
	{
		$show = M('ev')->get('show');
		$questionids = trim(M('ev')->get('questionids')," ,");
		$rowsquestionids = trim(M('ev')->get('rowsquestionids')," ,");
		if(!$questionids)$questionids = '0';
		if(!$rowsquestionids)$rowsquestionids = '0';
		$questions = M('exam','exam')->getQuestionListByArgs(array(array('AND',"questionstatus = 1"),array('AND',"find_in_set(questionid,:questionid)",'questionid',$questionids)));
		$rowsquestions = array();
		$rowsquestionids = explode(',',$rowsquestionids);
		foreach($rowsquestionids as $p)
		{
			if($p)
			$rowsquestions[$p] = M('exam','exam')->getQuestionRowsByArgs(array(array('AND',"qrstatus = 1"),array('AND',"qrid = :qrid",'qrid',$p)));
		}
		M('tpl')->assign('rowsquestions',$rowsquestions);
		M('tpl')->assign('questions',$questions);
		M('tpl')->assign('show',$show);
		M('tpl')->display('exams_selected');
	}

	private function selectquestions()
	{
		$useframe = M('ev')->get('useframe');
		$search = M('ev')->get('search');
		$page = M('ev')->get('page');
		$page = $page > 0?$page:1;
		M('pg')->setUrlTarget('modal-body" class="ajax');
		if(!$search['questionisrows'])
		{
			$args = array(array("AND","quest2knows.qkquestionid = questions.questionid"),array("AND","questions.questionstatus = '1'"),array("AND","questions.questionparent = 0"),array("AND","quest2knows.qktype = 0") );
			if($search['keyword'])
			{
				$args[] = array("AND","questions.question LIKE :question",'question','%'.$search['keyword'].'%');
			}
			if($search['knowsids'])
			{
				$args[] = array("AND","find_in_set(questions.questionknowsid,:questionknowsid)",'questionknowsid',$search['knowsids']);
			}
			if($search['stime'])
			{
				$args[] = array("AND","questions.questioncreatetime >= :squestioncreatetime",'squestioncreatetime',strtotime($search['stime']));
			}
			if($search['etime'])
			{
				$args[] = array("AND","questions.questioncreatetime <= :equestioncreatetime",'equestioncreatetime',strtotime($search['etime']));
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
					$args[] = array("AND","find_in_set(quest2knows.qkknowsid,:qkknowsid)",'qkknowsid' ,$tmpknows);
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
				else
				{
					$knows = M('section','exam')->getAllKnowsBySubjects($this->teachsubjects);
					foreach($knows as $p)
					{
						if($p['knowsid'])$tmpknows .= ','.$p['knowsid'];
					}
					$args[] = array("AND","find_in_set(quest2knows.qkknowsid,:qkknowsid)",'qkknowsid',$tmpknows);
				}
			}
			$questions = M('exam','exam')->getQuestionsList($page,10,$args);
		}
		else
		{
			$args = array(array("AND","quest2knows.qkquestionid = questionrows.qrid"),array("AND","questionrows.qrstatus = '1'"));
			if($search['keyword'])
			{
				$args[] = array("AND","questionrows.qrquestion LIKE :qrquestion",'qrquestion','%'.$search['keyword'].'%');
			}
			if($search['questiontype'])
			{
				$args[] = array("AND","questionrows.qrtype = :qrtype",'qrtype',$search['questiontype']);
			}
			if($search['stime'])
			{
				$args[] = array("AND","questionrows.qrtime >= :stime",'stime',strtotime($search['stime']));
			}
			if($search['etime'])
			{
				$args[] = array("AND","questionrows.qrtime <= :etime",'etime',strtotime($search['etime']));
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
					$args[] = array("AND","find_in_set(quest2knows.qkknowsid,:qkknowsid)",'qkknowsid' ,$tmpknows);
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
				else
				{
					$knows = M('section','exam')->getAllKnowsBySubjects($this->teachsubjects);
					foreach($knows as $p)
					{
						if($p['knowsid'])$tmpknows .= ','.$p['knowsid'];
					}
					$args[] = array("AND","find_in_set(quest2knows.qkknowsid,:qkknowsid)",'qkknowsid',$tmpknows);
				}
			}
			$questions = M('exam','exam')->getQuestionrowsList($page,10,$args);
		}
		if($useframe)$questions['pages'] = str_replace('&useframe=1','',$questions['pages']);
		$questypes = M('basic','exam')->getQuestypeList();
		$sections = M('section','exam')->getSectionListByArgs(array(array("AND","sectionsubjectid = :sectionsubjectid","sectionsubjectid",$search['questionsubjectid'])));
		$knows = M('section','exam')->getKnowsListByArgs(array(array("AND","knowsstatus = 1"),array("AND","knowssectionid = :knowssectionid","knowssectionid",$search['questionsectionid'])));
		//M('tpl')->assign('subjects',$subjects);
		M('tpl')->assign('search',$search);
		M('tpl')->assign('sections',$sections);
		M('tpl')->assign('knows',$knows);
		M('tpl')->assign('questypes',$questypes);
		M('tpl')->assign('questiontype',$search['questiontype']);
		M('tpl')->assign('questions',$questions);
		M('tpl')->assign('useframe',$useframe);
		M('tpl')->display('selectquestions');
	}

	private function downloadexam()
	{
		$examid = M('ev')->get('examid');
		$r = M('exam','exam')->getExamSettingById($examid);
		M('tpl')->assign("setting",$r);
		$questions = array();
		$questionrows = array();
		foreach($r['examquestions'] as $key => $p)
		{
			$qids = '';
			$qrids = '';
			if($p['questions'])$qids = trim($p['questions']," ,");
			if($qids)
				$questions[$key] = M('exam','exam')->getQuestionListByIds($qids);
			if($p['rowsquestions'])$qrids = trim($p['rowsquestions']," ,");
			if($qrids)
			{
				$qrids = explode(",",$qrids);
				foreach($qrids as $t)
				{
					$qr = M('exam','exam')->getQuestionRowsById($t);
					if($qr)
						$questionrows[$key][$t] = $qr;
				}
			}
		}
		$args['examsessionquestion'] = array('questions'=>$questions,'questionrows'=>$questionrows);
		$args['examsessionsetting'] = $r;
		$questype = M('basic','exam')->getQuestypeList();
		M('tpl')->assign('questype',$questype);
		M('tpl')->assign("sessionvars",$args);
		$content = M('tpl')->fetchExeCnt('exam_download');
		$content = M('word')->WordMake($content);
		$this->files->mdir("data/word/");
		$fname = 'data/word/'.uniqid().".doc";//转换好生成的word文件名编码
		$fp = fopen($fname, 'w');//打开生成的文档
		fwrite($fp, $content);//写入包保存文件
		fclose($fp);
		$message = array(
			'statusCode' => 200,
			"message" => "试卷导出成功，转入下载页面，如果浏览器没有相应，请<a href=\"{$fname}\">点此下载</a>",
			"callbackType" => 'forward',
			"forwardUrl" => "{$fname}"
		);
		\PHPEMS\ginkgo::R($message);
	}

	private function preview()
	{
		$examid = M('ev')->get('examid');
		$r = M('exam','exam')->getExamSettingById($examid);
		M('tpl')->assign("setting",$r);
		if($r['examtype'] == 2)
		{
			$questions = array();
			$questionrows = array();
			foreach($r['examquestions'] as $key => $p)
			{
				$qids = '';
				$qrids = '';
				if($p['questions'])$qids = trim($p['questions']," ,");
				if($qids)
				$questions[$key] = M('exam','exam')->getQuestionListByIds($qids);
				if($p['rowsquestions'])$qrids = trim($p['rowsquestions']," ,");
				if($qrids)
				{
					$qrids = explode(",",$qrids);
					foreach($qrids as $t)
					{
						$qr = M('exam','exam')->getQuestionRowsById($t);
						if($qr)
						$questionrows[$key][$t] = $qr;
					}
				}
			}
			$args['examsessionquestion'] = array('questions'=>$questions,'questionrows'=>$questionrows);
			$args['examsessionsetting'] = $r;
			$args['examsessionstarttime'] = TIME;
			$args['examsession'] = $r['exam'];
			$args['examsessionscore'] = 0;
			$args['examsessiontime'] = $r['examsetting']['examtime'];
			$args['examsessiontype'] = 2;
			$args['examsessionkey'] = $r['examid'];
			$args['examsessionissave'] = 0;
		}
		else
		{
			$args['examsessionquestion'] = array('questions'=>$r['examquestions']['questions'],'questionrows'=>$r['examquestions']['questionrows']);
			$args['examsessionsetting'] = $r;
			$args['examsessionstarttime'] = TIME;
			$args['examsession'] = $r['exam'];
			$args['examsessiontime'] = $r['examsetting']['examtime'];
			$args['examsessiontype'] = 2;
			$args['examsessionkey'] = $r['examid'];
		}
		$questype = M('basic','exam')->getQuestypeList();
		M('tpl')->assign('questype',$questype);
		M('tpl')->assign("sessionvars",$args);
		M('tpl')->display('exams_paper');
	}

	private function modify()
	{
		$search = M('ev')->get('search');
		if(M('ev')->get('submitsetting'))
		{
			$examid = M('ev')->get('examid');
			$args = M('ev')->get('args');
			$args['examsetting'] = $args['examsetting'];
			$args['examquestions'] = $args['examquestions'];
			M('exam','exam')->modifyExamSetting($examid,$args);
			$message = array(
				'statusCode' => 200,
				"message" => "操作成功",
				"callbackType" => "forward",
			    "forwardUrl" => "index.php?exam-teach-exams&page={$page}{$u}"
			);
			\PHPEMS\ginkgo::R($message);
		}
		else
		{
			$examid = M('ev')->get('examid');
			$exam = M('exam','exam')->getExamSettingById($examid);
			$subjects = M('basic','exam')->getSubjectList(array(array('AND','find_in_set(subjectid,:subjectid)','subjectid',$this->teachsubjects)));
			$questypes = M('basic','exam')->getQuestypeList();
			foreach($exam['examquestions'] as $key => $p)
			{
				$exam['examnumber'][$key] = M('exam','exam')->getExamQuestionNumber($p);
			}
			M('tpl')->assign('search',$search);
			M('tpl')->assign('subjects',$subjects);
			M('tpl')->assign('exam',$exam);
			M('tpl')->assign('questypes',$questypes);
			if($exam['examtype'] == 1)
			M('tpl')->display('exams_modifyauto');
			else
			M('tpl')->display('exams_modifyself');
		}
	}

	private function index()
	{
		$search = M('ev')->get('search');
		$page = M('ev')->get('page');
		$page = $page > 0?$page:1;
		$args = array(array('AND','find_in_set(examsubject,:examsubject)','examsubject',$this->teachsubjects));
		if($search)
		{
			if($search['examsubject'])$args[] = array('AND',"examsubject = :sexamsubject",'sexamsubject',$search['examsubject']);
			if($search['examtype'])$args[] = array('AND',"examtype = :examtype","examtype",$search['examtype']);
		}
		if(!count($args))$args = 1;
		$exams = M('exam','exam')->getExamSettingList($args,$page,10);
		$subjects = M('basic','exam')->getSubjectList(array(array("AND","find_in_set(subjectid,:subjectid)",'subjectid',$this->teachsubjects)));
		//$subjects = M('basic','exam')->getSubjectList("subjectid IN ({$this->teachsubjects})");
		M('tpl')->assign('subjects',$subjects);
		M('tpl')->assign('exams',$exams);
		M('tpl')->display('exams');
	}
}


?>
