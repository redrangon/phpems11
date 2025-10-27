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
	public $search;
	public $u;

	public function display()
	{
		$this->search = M('ev')->get('search');
		$this->u = '';
		if($this->search)
		{
			M('tpl')->assign('search',$this->search);
			foreach($this->search as $key => $arg)
			{
				$this->u .= "&search[{$key}]={$arg}";
			}
			M('tpl')->assign('u',$this->u);
		}
		$action = M('ev')->url(3);
		if(!method_exists($this,$action))
		$action = "index";
		$this->$action();
		exit;
	}

	public function delquestion()
	{
		$syqnid = M('ev')->get('syqnid');
		M('survey','survey')->delSurveyQuestion($syqnid);
		$message = array(
			'statusCode' => 200,
			"message" => "操作成功，正在转入目标页面",
			"callbackType" => 'forward',
			"forwardUrl" => "reload"
		);
		ginkgo::R($message);
	}

	public function delnode()
	{
		$syneid = M('ev')->get('syneid');
		M('survey','survey')->delSurveyNode($syneid);
		M('survey','survey')->delSurveyQuestions(array(
			array("AND","syqnsyneid = :syqnsyneid","syqnsyneid",$syneid)
		));
		$message = array(
			'statusCode' => 200,
			"message" => "操作成功，正在转入目标页面",
			"callbackType" => 'forward',
			"forwardUrl" => "reload"
		);
		ginkgo::R($message);
	}

	public function del()
	{
		$svyid = M('ev')->get('svyid');
		M('survey','survey')->delSurvey($svyid);
		$message = array(
			'statusCode' => 200,
			"message" => "操作成功，正在转入目标页面",
			"callbackType" => 'forward',
			"forwardUrl" => "reload"
		);
		ginkgo::R($message);
	}

	public function delhistory()
	{
		$syhyid = M('ev')->get('syhyid');
		M('survey','survey')->delSurveyHistory($syhyid);
		$message = array(
			'statusCode' => 200,
			"message" => "操作成功，正在转入目标页面",
			"callbackType" => 'forward',
			"forwardUrl" => "reload"
		);
		ginkgo::R($message);
	}

	public function addquestion()
	{
		$syneid = M('ev')->get('syneid');
		$surveynode = M('survey','survey')->getSurveyNodeById($syneid);
		$svyid = $surveynode['synesvyid'];
		$survey = M('survey','survey')->getSurveyById($svyid);
		if(M('ev')->get('addquestion'))
		{
			$args = M('ev')->get('args');
			$args['syqnsvyid'] = $svyid;
			$args['syqnsyneid'] = $syneid;
			M('survey','survey')->addSurveyQuestion($args);
			$message = array(
				'statusCode' => 200,
				"message" => "操作成功，正在转入目标页面",
				"callbackType" => 'forward',
				"forwardUrl" => "index.php?survey-master-survey-paper&svyid={$survey['svyid']}"
			);
			ginkgo::R($message);
		}
		else
		{
			$questypes = M('survey','survey')->getQuestypeList();
			M('tpl')->assign('questypes',$questypes);
			M('tpl')->assign('node',$surveynode);
			M('tpl')->assign('survey',$survey);
			M('tpl')->display('survey_addquestion');
		}
	}

	public function modifyquestion()
	{
		$syqnid = M('ev')->get('syqnid');
		$question = M('survey','survey')->getSurveyQuestionById($syqnid);
		if(M('ev')->get('modifyquestion'))
		{
			$args = M('ev')->get('args');
			M('survey','survey')->modifySurveyQuestion($syqnid,$args);
			$message = array(
				'statusCode' => 200,
				"message" => "操作成功，正在转入目标页面",
				"callbackType" => 'forward',
				"forwardUrl" => "index.php?survey-master-survey-paper&svyid={$question['syqnsvyid']}"
			);
			ginkgo::R($message);
		}
		else
		{
			$questypes = M('survey','survey')->getQuestypeList();
			M('tpl')->assign('questypes',$questypes);
			M('tpl')->assign('question',$question);
			M('tpl')->display('survey_modifyquestion');
		}
	}

	public function addpaper()
	{
		if(M('ev')->get('addpaper'))
		{
			$args = M('ev')->get('args');
			$args['svyuserid'] = $this->user['userid'];
			$args['svystime'] = strtotime($args['svystime']);
			$args['svyendtime'] = strtotime($args['svyendtime']);
			$args['svytime'] = TIME;
			M('survey','survey')->addSurvey($args);
			$message = array(
				'statusCode' => 200,
				"message" => "操作成功，正在转入目标页面",
				"callbackType" => 'forward',
				"forwardUrl" => "index.php?survey-master-survey"
			);
			ginkgo::R($message);
		}
		else
		{
			M('tpl')->display('survey_addpaper');
		}
	}

	public function modifypaper()
	{
		$svyid = M('ev')->get('svyid');
		$survey = M('survey','survey')->getSurveyById($svyid);
		if(M('ev')->get('modifypaper'))
		{
			$args = M('ev')->get('args');
			$args['svyuserid'] = $this->user['userid'];
			$args['svystime'] = strtotime($args['svystime']);
			$args['svyendtime'] = strtotime($args['svyendtime']);
			$args['svytime'] = TIME;
			M('survey','survey')->modifySurvey($svyid,$args);
			$message = array(
				'statusCode' => 200,
				"message" => "操作成功，正在转入目标页面",
				"callbackType" => 'forward',
				"forwardUrl" => "index.php?survey-master-survey"
			);
			ginkgo::R($message);
		}
		else
		{
			M('tpl')->assign('survey',$survey);
			M('tpl')->display('survey_modifypaper');
		}
	}

	public function addnode()
	{
		$svyid = M('ev')->get('svyid');
		$survey = M('survey','survey')->getSurveyById($svyid);
		if(M('ev')->get('addnode'))
		{
			$args = M('ev')->get('args');
			$args['synesvyid'] = $svyid;
			M('survey','survey')->addSurveyNode($args);
			$message = array(
				'statusCode' => 200,
				"message" => "操作成功，正在转入目标页面",
				"callbackType" => 'forward',
				"forwardUrl" => "index.php?survey-master-survey-paper&svyid={$survey['svyid']}"
			);
			ginkgo::R($message);
		}
		else
		{
			M('tpl')->assign('survey',$survey);
			M('tpl')->display('survey_addnode');
		}
	}

	public function modifynode()
	{
		$syneid = M('ev')->get('syneid');
		$surveynode = M('survey','survey')->getSurveyNodeById($syneid);
		if(M('ev')->get('modifynode'))
		{
			$args = M('ev')->get('args');
			M('survey','survey')->modifySurveyNode($syneid,$args);
			$message = array(
				'statusCode' => 200,
				"message" => "操作成功，正在转入目标页面",
				"callbackType" => 'forward',
				"forwardUrl" => "index.php?survey-master-survey-paper&svyid={$surveynode['synesvyid']}"
			);
			ginkgo::R($message);
		}
		else
		{
			M('tpl')->assign('node',$surveynode);
			M('tpl')->display('survey_modifynode');
		}
	}

	public function downloadstats()
	{
		$svyid = M('ev')->get('svyid');
		$survey = M('survey','survey')->getSurveyById($svyid);
		$nodes = M('survey','survey')->getSurveyNodesByArgs(array(
			array("AND","synesvyid = :synesvyid","synesvyid",$svyid)
		));
		$questions = array();
		foreach($nodes as $node)
		{
			$questions[$node['syneid']] = M('survey','survey')->getSurveyQuestionsByArgs(array(
				array("AND","syqnsyneid = :syqnsyneid","syqnsyneid",$node['syneid'])
			));
		}
		$questypes = M('survey','survey')->getQuestypeList();
		$args = array();
		$args[] = array("AND","syhysvyid = :syhysvyid","syhysvyid",$svyid);
		if($this->cuser['usercity'])
		{
			$args[] = array("AND","syhycity = :syhycity","syhycity",$this->cuser['usercity']);
		}
		$histories = M('survey','survey')->getSurveyHistoriesByArgs($args);
		$number = array();
		$qnumber = array();
		$rate = array();
		foreach($histories as $history)
		{
			foreach($history['syhyanswers'] as $key => $answer)
			{
				if(!$questypes[$questions[$key]['syqnid']]['questsort'])
				{
					if($answer)
					{
						$number[$key]++;
					}
					if(is_array($answer))
					{
						foreach($answer as $a)
						{
							$qnumber[$key][$a]++;
						}
					}
					else
					{
						$qnumber[$key][$answer]++;
					}
				}
			}
		}
		foreach($qnumber as $key => $qnums)
		{
			foreach($qnums as $so => $num)
			{
				$rate[$key][$so] = intval(100*$num/$number[$key]);
			}
		}
		$data = array(
			array("题干","选项","有效记录数","A(%)","B(%)","C(%)","D(%)","E(%)","F(%)","G(%)","H(%)")
		);
		foreach($nodes as $node)
		{
			foreach($questions[$node['syneid']] as $question)
			{
				if(!$questypes[$question['syqnquestiontype']]['questsort'])
				{
					$args = array();
					$args[] = strip_tags(html_entity_decode(stripslashes($question['syqnquestion'])));
					$args[] = strip_tags(html_entity_decode(stripslashes($question['syqnquestionselect'])));
					$args[] = $number[$question['syqnid']];
					foreach(M('config','survey')->selectors as $key => $selector)
					{
						$args[] = intval(100 * $qnumber[$question['syqnid']][$selector] / $number[$question['syqnid']]);
						if($key == $question['syqnquestionselectnumber'])
						{
							break;
						}
					}
					$data[] = $args;
				}
			}
		}
		$fname = 'data/survey/'.TIME.'-'.$svyid.'-survey.xlsx';
		M('files')->mdir(PEPATH.'/data/survey/');
		if(M('xlsx')->putExcelContent(PEPATH.'/'.$fname,$data))
		{	$message = array(
				'statusCode' => 200,
				"message" => "导出成功，转入下载页面，如果浏览器没有相应，请<a href=\"{$fname}\">点此下载</a>",
				"callbackType" => 'forward',
				"forwardUrl" => "{$fname}"
			);
		}
		else
		{
			$message = array(
				'statusCode' => 300,
				"message" => "导出失败"
			);
		}
		\PHPEMS\ginkgo::R($message);
	}

	public function stats()
	{
		$svyid = M('ev')->get('svyid');
		$survey = M('survey','survey')->getSurveyById($svyid);
		$nodes = M('survey','survey')->getSurveyNodesByArgs(array(
			array("AND","synesvyid = :synesvyid","synesvyid",$svyid)
		));
		$questions = array();
		foreach($nodes as $node)
		{
			$questions[$node['syneid']] = M('survey','survey')->getSurveyQuestionsByArgs(array(
				array("AND","syqnsyneid = :syqnsyneid","syqnsyneid",$node['syneid'])
			));
		}
		$questypes = M('survey','survey')->getQuestypeList();
		$args = array();
		$args[] = array("AND","syhysvyid = :syhysvyid","syhysvyid",$svyid);
		if($this->cuser['usercity'])
		{
			$args[] = array("AND","syhycity = :syhycity","syhycity",$this->cuser['usercity']);
		}
		$histories = M('survey','survey')->getSurveyHistoriesByArgs($args);
		$number = array();
		$qnumber = array();
		$rate = array();
		foreach($histories as $history)
		{
			foreach($history['syhyanswers'] as $key => $answer)
			{
				if(!$questypes[$questions[$key]['syqnid']]['questsort'])
				{
					if($answer)
					{
						$number[$key]++;
					}
					if(is_array($answer))
					{
						foreach($answer as $a)
						{
							$qnumber[$key][$a]++;
						}
					}
					else
					{
						$qnumber[$key][$answer]++;
					}
				}
			}
		}
		foreach($qnumber as $key => $qnums)
		{
			foreach($qnums as $so => $num)
			{
				$rate[$key][$so] = intval(100*$num/$number[$key]);
			}
		}
		M('tpl')->assign('rate',$rate);
		M('tpl')->assign('number',$number);
		M('tpl')->assign('qnumber',$qnumber);
		M('tpl')->assign('histories',$histories);
		M('tpl')->assign('questypes',$questypes);
		M('tpl')->assign('nodes',$nodes);
		M('tpl')->assign('questions',$questions);
		M('tpl')->assign('survey',$survey);
		M('tpl')->display('survey_stats');
	}

	public function paper()
	{
		$svyid = M('ev')->get('svyid');
		$survey = M('survey','survey')->getSurveyById($svyid);
		$nodes = M('survey','survey')->getSurveyNodesByArgs(array(
			array("AND","synesvyid = :synesvyid","synesvyid",$svyid)
		));
		$questions = array();
		foreach($nodes as $node)
		{
			$questions[$node['syneid']] = M('survey','survey')->getSurveyQuestionsByArgs(array(
				array("AND","syqnsyneid = :syqnsyneid","syqnsyneid",$node['syneid'])
			));
		}
		$questypes = M('survey','survey')->getQuestypeList();
		M('tpl')->assign('questypes',$questypes);
		M('tpl')->assign('nodes',$nodes);
		M('tpl')->assign('questions',$questions);
		M('tpl')->assign('survey',$survey);
		M('tpl')->display('survey_paper');
	}

	public function viewhistory()
	{
		$syhyid = M('ev')->get('syhyid');
		$history = M('survey','survey')->getSurveyHistoryById($syhyid);
		$svyid = $history['syhysvyid'];
		$survey = M('survey','survey')->getSurveyById($svyid);
		$nodes = M('survey','survey')->getSurveyNodesByArgs(array(
			array("AND","synesvyid = :synesvyid","synesvyid",$svyid)
		));
		$questions = array();
		foreach($nodes as $node)
		{
			$questions[$node['syneid']] = M('survey','survey')->getSurveyQuestionsByArgs(array(
				array("AND","syqnsyneid = :syqnsyneid","syqnsyneid",$node['syneid'])
			));
		}
		$questypes = M('survey','survey')->getQuestypeList();
		M('tpl')->assign('questypes',$questypes);
		M('tpl')->assign('nodes',$nodes);
		M('tpl')->assign('questions',$questions);
		M('tpl')->assign('answers',$history['syhyanswers']);
		M('tpl')->assign('survey',$survey);
		M('tpl')->display('survey_viewhistory');
	}

	public function answers()
	{
		M('pg')->setUrlTarget('modal-body" class="ajax');
		$svyid = M('ev')->get('svyid');
		$syqnid = M('ev')->get('syqnid');
		$survey = M('survey','survey')->getSurveyById($svyid);
		$page = intval(M('ev')->get('page'));
		$args = array();
		$args[] = array("AND","syhysvyid = :syhysvyid","syhysvyid",$svyid);
		if($survey['svytype'])$histories = M('survey','survey')->getSurveyHistoryAndUsersList($args,$page);
		else $histories = M('survey','survey')->getSurveyHistoryList($args,$page);
		M('tpl')->assign('survey',$survey);
		M('tpl')->assign('syqnid',$syqnid);
		M('tpl')->assign('histories',$histories);
		M('tpl')->display('survey_answers');
	}

	public function history()
	{
		$svyid = M('ev')->get('svyid');
		$survey = M('survey','survey')->getSurveyById($svyid);
		$page = intval(M('ev')->get('page'));
		$args = array();
		$args[] = array("AND","syhysvyid = :syhysvyid","syhysvyid",$svyid);
		if($survey['svytype'])$histories = M('survey','survey')->getSurveyHistoryAndUsersList($args,$page);
		else $histories = M('survey','survey')->getSurveyHistoryList($args,$page);
		M('tpl')->assign('survey',$survey);
		M('tpl')->assign('histories',$histories);
		M('tpl')->display('survey_history');
	}

	public function index()
	{
		$page = intval(M('ev')->get('page'));
		$args = array();
		if($this->search['keyword'])
		{
			$args[] = array("AND","svytitle LIKE :svytitle","svytitle","%{$this->search['keyword']}%");
		}		
		$surveies = M('survey','survey')->getSurveyList($args,$page);
		M('tpl')->assign('surveies',$surveies);
		M('tpl')->display('survey');
	}
}


?>
