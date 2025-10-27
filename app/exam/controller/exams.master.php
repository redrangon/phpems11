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

	private function showsetting()
	{
		$setting = M('ev')->get('setting');
		$setting = explode("|",$setting);
		$rs = array();
		foreach($setting as $p)
		{
			if($p)
			{
				$tp = explode(':',$p);
				$knows = M('section','exam')->getKnowsListByArgs(array(array("AND","find_in_set(knowsid,:knowsid)",'knowsid',$tp[0])));
				$n = array();
				foreach($knows as $s)
				{
					$n[] = $s['knows'];
				}
				$o = explode(',',$tp[2]);
				$rs[] = array('knows' => implode(',',$n),'number' => $tp[1],'easy' => intval($o[0]),'mid' => intval($o[1]),'hard' => intval($o[2]));
			}
		}
		M('tpl')->assign('rs',$rs);
		M('tpl')->display('exams_autosetting');
	}

	private function selectexams()
	{
		$search = M('ev')->get('search');
		$useframe = M('ev')->get('useframe');
		$target = M('ev')->get('target');
		$page = M('ev')->get('page');
		$page = $page > 0?$page:1;
		$this->pg->setUrlTarget('modal-body" class="ajax');
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
		    "forwardUrl" => "index.php?exam-master-exams&page={$page}{$u}"
		);
		\PHPEMS\ginkgo::R($message);
	}

	private function download()
	{
		$questype = M('basic','exam')->getQuestypeList();
		M('tpl')->assign('questype',$questype);
		$examids = M('ev')->get('examids');
		$sessionvars = array();
		foreach($examids as $examid => $tmp)
		{
			$r = M('exam','exam')->getExamSettingById($examid);
			$args = array();
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
			$sessionvars[] = $args;
		}
		M('tpl')->assign("sessionvars",$sessionvars);
		$content = M('tpl')->fetchExeCnt('exams_download');
		$content = M('word')->WordMake($content);
		$fname = 'data/word/'.uniqid().".doc";//转换好生成的word文件名编码
		$fp = fopen($fname, 'w');//打开生成的文档
		fwrite($fp, $content);//写入包保存文件
		fclose($fp);
		$message = array(
			'statusCode' => 200,
			"message" => "成绩导出成功，转入下载页面，如果浏览器没有相应，请<a href=\"{$fname}\">点此下载</a>",
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

	private function modifypaper()
	{
		$examid = M('ev')->get('examid');
		$questionid = M('ev')->get('questionid');
		$qrid = M('ev')->get('qrid');
		$r = M('exam','exam')->getExamSettingById($examid);
		$questypes = M('basic','exam')->getQuestypeList();
		M('tpl')->assign("questypes",$questypes);
		if(M('ev')->get('modifypaper'))
		{
			$args = M('ev')->get('args');
			$targs = M('ev')->get('targs');
			$q = null;
			if($qrid)
			{
				foreach($r['examquestions']['questionrows'] as $tkey => $tp)
				{
					foreach($tp as $key => $p)
					{
						if($p['qrid'] == $qrid)
						{
							$r['examquestions']['questionrows'][$tkey][$key]['qrquestion'] = $args['qrquestion'];
							$q = 1;
							break;
						}
						if($q)break;
					}
					if($q)break;
				}
			}
			else
			{
				foreach($r['examquestions']['questions'] as $tkey => $tp)
				{
					foreach($tp as $key => $p)
					{
						if($p['questionid'] == $questionid)
						{
							$args['questionid'] = $questionid;
							$questype = M('basic','exam')->getQuestypeById($args['questiontype']);
							if($questype['questsort'])$choice = 0;
							else $choice = $questype['questchoice'];
							$args['questionanswer'] = $targs['questionanswer'.$choice];
							$r['examquestions'][$tkey][$key] = $args;
							$q = 1;
							break;
						}
					}
					if($q)break;
				}

				foreach($r['examquestions']['questionrows'] as $qkey => $tp)
				{
					foreach($tp as $tkey => $ttp)
					{
						foreach($ttp['data'] as $key => $p)
						{
							if($p['questionid'] == $questionid)
							{
								$args['questionid'] = $questionid;
								$questype = M('basic','exam')->getQuestypeById($args['questiontype']);
								if($questype['questsort'])$choice = 0;
								else $choice = $questype['questchoice'];
								$args['questionanswer'] = $targs['questionanswer'.$choice];
								$r['examquestions']['questionrows'][$qkey][$tkey]['data'][$key] = $args;
								$q = 1;
								break;
							}
						}
						if($q)break;
					}
					if($q)break;
				}
			}
			M('exam','exam')->modifyExamSetting($examid,array('examquestions' => $r['examquestions']));
			$message = array(
				'statusCode' => 200,
				"message" => "操作成功",
				"callbackType" => "forward",
			    "forwardUrl" => "index.php?exam-master-exams-preview&examid=".$examid
			);
			\PHPEMS\ginkgo::R($message);
		}
		else
		{
			$question = null;
			if($qrid)
			{
				foreach($r['examquestions']['questionrows'] as $tp)
				{
					foreach($tp as $p)
					{
						if($p['qrid'] == $qrid)
						{
							$question = $p;
							break;
						}
						if($question)break;
					}
					if($question)break;
				}
			}
			else
			{
				foreach($r['examquestions']['questions'] as $tp)
				{
					foreach($tp as $p)
					{
						if($p['questionid'] == $questionid)
						{
							$question = $p;
							break;
						}
					}
					if($question)break;
				}
				foreach($r['examquestions']['questionrows'] as $tp)
				{
					foreach($tp as $ttp)
					{
						foreach($ttp['data'] as $p)
						{
							if($p['questionid'] == $questionid)
							{
								$question = $p;
								break;
							}
						}
						if($question)break;
					}
					if($question)break;
				}
			}
			M('tpl')->assign("examid",$examid);
			M('tpl')->assign("questionid",$questionid);
			M('tpl')->assign("qrid",$qrid);
			M('tpl')->assign("question",$question);
			M('tpl')->display('exams_modifypaper');
		}
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

	private function outcsv()
	{
		$this->files = M('files');
		$examid = M('ev')->get('examid');
		$exam = M('exam','exam')->getExamSettingById($examid);
		$questypes = M('basic','exam')->getQuestypeList();
		$data = array();
		foreach($exam['examquestions'] as $tp)
		{
			foreach($tp as $p)
			$data[] = array(iconv("UTF-8","GBK//IGNORE",$questypes[$p['questiontype']]['questchar']),iconv("UTF-8","GBK//IGNORE",html_entity_decode($p['question'])),iconv("UTF-8","GBK//IGNORE",html_entity_decode($p['questionselect'])),iconv("UTF-8","GBK//IGNORE",$p['questionselectnumber']),iconv("UTF-8","GBK//IGNORE",html_entity_decode($p['questionanswer'])),iconv("UTF-8","GBK//IGNORE",html_entity_decode($p['questiondescribe'])));
		}
		$fname = 'data/exams/'.TIME.'-'.$examid.'-score.csv';
		if($this->files->outCsv($fname,$data))
		$message = array(
			'statusCode' => 200,
			"message" => "成绩导出成功，转入下载页面，如果浏览器没有相应，请<a href=\"{$fname}\">点此下载</a>",
		    "callbackType" => 'forward',
		    "forwardUrl" => "{$fname}"
		);
		else
		$message = array(
			'statusCode' => 300,
			"message" => "成绩导出失败"
		);
		\PHPEMS\ginkgo::R($message);
	}

	private function ajax()
	{
		switch(M('ev')->url(4))
		{
			case 'getsubjectknows':
			$subjectid = M('ev')->get('subjectid');
			$questype = M('ev')->get('questype');
			$tmpknows = M('section','exam')->getAllKnowsBySubject($subjectid);
			$knows = array();
			$numbers = array();
			$sections = M('section','exam')->getSectionListByArgs(array(array("AND","sectionsubjectid = :sectionsubjectid",'sectionsubjectid',$subjectid)));
			foreach($tmpknows as $p)
			{
				$knows[$p['knowssectionid']][] = $p;
				$numbers[$p['knowsid']] = intval(ceil(M('exam','exam')->getQuestionNumberByQuestypeAndKnowsid($questype,$p['knowsid'])));
			}
			M('tpl')->assign('sections',$sections);
			M('tpl')->assign('numbers',$numbers);
			M('tpl')->assign('knows',$knows);
			M('tpl')->display('exam_ajax_getsubjectknows');
			break;

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
		    "forwardUrl" => "index.php?exam-master-exams&page={$page}{$u}"
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
			$args['examauthor'] = $this->user['sessionusername'];
			$args['examtype'] = 1;

			$totalscore = 0;
			foreach($args['examsetting']['questype'] as $key => $p)
			{
				if(!$args['examsetting']['questypelite'][$key])
				{
					unset($args['examsetting']['questype'][$key],$args['examquestions'][$key]);
				}
				$totalscore += $p['number'] * $p['score'];
			}
			if($args['examsetting']['score'] != $totalscore)
			{
				$message = array(
					'statusCode' => 300,
					"message" => "分数设置不正确，请检查"
				);
				\PHPEMS\ginkgo::R($message);
			}
			M('exam','exam')->addExamSetting($args);
			$message = array(
				'statusCode' => 200,
				"message" => "操作成功",
			    "forwardUrl" => "index.php?exam-master-exams&page={$page}{$u}"
			);
			\PHPEMS\ginkgo::R($message);
		}
		else
		{
			$subjects = M('basic','exam')->getSubjectList();
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
			$args['examauthor'] = $this->user['sessionusername'];
			$args['examtype'] = 2;
			$args['examquestions'] = $args['examquestions'];

			foreach($args['examsetting']['questype'] as $key => $p)
			{
				if(!$args['examsetting']['questypelite'][$key])
				{
					unset($args['examsetting']['questype'][$key],$args['examquestions'][$key]);
				}
			}

			$id = M('exam','exam')->addExamSetting($args);
			$message = array(
				'statusCode' => 200,
				"message" => "操作成功",
				"callbackType" => "forward",
			    "forwardUrl" => "index.php?exam-master-exams-examself&examid={$id}&page={$page}{$u}"
			);
			\PHPEMS\ginkgo::R($message);
		}
		else
		{
			$subjects = M('basic','exam')->getSubjectList();
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
							//$qustionnumber++;
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
						//$qustionnumber++;
					}
				}
			}
			$args['examquestions'] = array('questions' => $questions,'questionrows' => $questionrows);
			//$args['examsetting']['questype'][1]['number'] = $qustionnumber;
			//$args['examsetting']['questype'][1]['score'] = intval(100/$qustionnumber);
			$id = M('exam','exam')->addExamSetting($args);
			$message = array(
				'statusCode' => 200,
				"message" => "操作成功",
				"callbackType" => "forward",
			    "forwardUrl" => "index.php?exam-master-exams-examself&examid={$id}&page={$page}{$u}"
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
			$questions = M('exam','exam')->getQuestionListByArgs(array(array("AND","questionstatus = 1"),array("AND","find_in_set(questionid,:questionid)",'questionid',$questionids)));
			$rowsquestions = array();
			$rowsquestionids = explode(',',$rowsquestionids);
			foreach($rowsquestionids as $p)
			{
				if($p)
				$rowsquestions[$p] = M('exam','exam')->getQuestionRowsByArgs(array(array("AND","qrstatus = 1"),array("AND","qrid = :qrid",'qrid',$p)));
			}
			M('tpl')->assign('rowsquestions',$rowsquestions);
			M('tpl')->assign('questions',$questions);
			M('tpl')->assign('show',$show);
			M('tpl')->display('exams_selected');
	}

	private function selectquestions()
	{
		$search = M('ev')->get('search');
		$useframe = M('ev')->get('useframe');
		$page = M('ev')->get('page');
		$page = $page > 0?$page:1;
		$this->pg->setUrlTarget('modal-body" class="ajax');
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
				$args[] = array("AND","questionrows.qrtime >= :sqrtime",'sqrtime',strtotime($search['stime']));
			}
			if($search['etime'])
			{
				$args[] = array("AND","questionrows.qrtime <= :eqrtime",'eqrtime',strtotime($search['etime']));
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
		$sections = M('section','exam')->getSectionListByArgs(array(array("AND","sectionsubjectid = :sectionsubjectid",'sectionsubjectid',$search['questionsubjectid'])));
		$knows = M('section','exam')->getKnowsListByArgs(array(array("AND","knowsstatus = 1"),array("AND","knowssectionid = :knowssectionid",'knowssectionid',$search['questionsectionid'])));
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

	private function modify()
	{
		$search = M('ev')->get('search');
		$examid = M('ev')->get('examid');
		$exam = M('exam','exam')->getExamSettingById($examid);
		if(M('ev')->get('submitsetting'))
		{
			$args = M('ev')->get('args');
			$args['examsetting'] = $args['examsetting'];
			if($exam['examtype'] == 3)
			{
				$uploadfile = M('ev')->get('uploadfile');
				if($uploadfile)
				{
					setlocale(LC_ALL,'zh_CN');
					$handle = fopen($uploadfile,"r");
					$questions = array();
					$index = 0;
					$rindex = 0;
					while($data = fgetcsv($handle))
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
									$targs['questionselectnumber'] = intval($question[3]);
									$targs['questionanswer'] = M('ev')->addSlashes(htmlspecialchars(iconv("GBK","UTF-8//IGNORE",trim($question[4]," \n\t"))));
									$targs['questiondescribe'] = M('ev')->addSlashes(htmlspecialchars(iconv("GBK","UTF-8//IGNORE",trim($question[5]," \n\t"))));
									$targs['questioncreatetime'] = TIME;
									$questionrows[$targs['questiontype']][intval($rindex - 1)]['data'][] = $targs;
									//$qustionnumber++;
								}
							}
							else
							{
								$index++;
								$targs['questionid'] = 'q_'.$index;
								$targs['questiontype'] = $question[0];
								$targs['question'] = M('ev')->addSlashes(htmlspecialchars(iconv("GBK","UTF-8//IGNORE",trim(nl2br($question[1])," \n\t"))));
								/**
								$ei = md5($targs['question']);
								if($isexit[$ei])
								{
									$message = array(
										'statusCode' => 300,
										"message" => "试题重复，该试题是:".$targs['question']
									);
									\PHPEMS\ginkgo::R($message);
								}
								else
								$isexit[$ei] = 1;
								**/
								$targs['questionselect'] = M('ev')->addSlashes(htmlspecialchars(iconv("GBK","UTF-8//IGNORE",trim(nl2br($question[2])," \n\t"))));
								if(!$targs['questionselect'] && $targs['questiontype'] == 3)
								$targs['questionselect'] = '<p>A、对<p><p>B、错<p>';
								$targs['questionselectnumber'] = $question[3];
								$targs['questionanswer'] = M('ev')->addSlashes(htmlspecialchars(iconv("GBK","UTF-8//IGNORE",trim($question[4]," \n\t"))));
								$targs['questiondescribe'] = M('ev')->addSlashes(htmlspecialchars(iconv("GBK","UTF-8//IGNORE",trim($question[5]," \n\t"))));
								$targs['questioncreatetime'] = TIME;
								$questions[$targs['questiontype']][] = $targs;
								//$qustionnumber++;
							}
						}
					}
					$args['examquestions'] = array('questions' => $questions,'questionrows' => $questionrows);
				}
			}
			else
			$args['examquestions'] = $args['examquestions'];
			foreach($args['examsetting']['questype'] as $key => $p)
			{
				if(!$args['examsetting']['questypelite'][$key])
				{
					unset($args['examsetting']['questype'][$key],$args['examquestions'][$key]);
				}
			}

			M('exam','exam')->modifyExamSetting($examid,$args);
			$message = array(
				'statusCode' => 200,
				"message" => "操作成功",
				"callbackType" => "forward",
			    "forwardUrl" => "index.php?exam-master-exams&page={$page}{$u}"
			);
			\PHPEMS\ginkgo::R($message);
		}
		else
		{
			$subjects = M('basic','exam')->getSubjectList();
			$questypes = M('basic','exam')->getQuestypeList();
			foreach($exam['examquestions'] as $key => $p)
			{
				$exam['examnumber'][$key] = M('exam','exam')->getExamQuestionNumber($p);
			}
			foreach($exam['examsetting']['questypelite'] as $key => $p)
			{
				if(!$subjects[$exam['examsubject']]['subjectsetting']['questypes'][$key])
				{
					$exam['examsetting']['questypelite'][$key] = 0;
				}
			}
			foreach($subjects[$exam['examsubject']]['subjectsetting']['questypes'] as $key => $p)
			{
				if(!$exam['examsetting']['questypelite'][$key])
				{
					$exam['examsetting']['questypelite'][$key] = 1;
				}
			}
			M('tpl')->assign('search',$search);
			M('tpl')->assign('subjects',$subjects);
			M('tpl')->assign('exam',$exam);
			M('tpl')->assign('questypes',$questypes);
			if($exam['examtype'] == 1)
			M('tpl')->display('exams_modifyauto');
			elseif($exam['examtype'] == 2)
			M('tpl')->display('exams_modifyself');
			else
			M('tpl')->display('exams_modifytemp');
		}
	}

	private function index()
	{
		$search = M('ev')->get('search');
		$page = M('ev')->get('page');
		$page = $page > 0?$page:1;
		$args = array();
		if($search)
		{
			if($search['examsubject'])$args[] = array("AND","examsubject = :examsubject",'examsubject',$search['examsubject']);
			if($search['examtype'])$args[] = array("AND","examtype = :examtype",'examtype',$search['examtype']);
		}
		$exams = M('exam','exam')->getExamSettingList($args,$page,10);
		$subjects = M('basic','exam')->getSubjectList();
		M('tpl')->assign('subjects',$subjects);
		M('tpl')->assign('exams',$exams);
		M('tpl')->display('exams');
	}
}


?>
