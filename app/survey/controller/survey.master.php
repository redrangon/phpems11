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
		$this->search = $this->ev->get('search');
		$this->u = '';
		if($this->search)
		{
			$this->tpl->assign('search',$this->search);
			foreach($this->search as $key => $arg)
			{
				$this->u .= "&search[{$key}]={$arg}";
			}
			$this->tpl->assign('u',$this->u);
		}
		$action = $this->ev->url(3);
		if(!method_exists($this,$action))
		$action = "index";
		$this->$action();
		exit;
	}

	public function delquestion()
	{
		$syqnid = $this->ev->get('syqnid');
		$this->survey->delSurveyQuestion($syqnid);
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
		$syneid = $this->ev->get('syneid');
		$this->survey->delSurveyNode($syneid);
		$this->survey->delSurveyQuestions(array(
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
		$svyid = $this->ev->get('svyid');
		$this->survey->delSurvey($svyid);
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
		$syhyid = $this->ev->get('syhyid');
		$this->survey->delSurveyHistory($syhyid);
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
		$syneid = $this->ev->get('syneid');
		$surveynode = $this->survey->getSurveyNodeById($syneid);
		$svyid = $surveynode['synesvyid'];
		$survey = $this->survey->getSurveyById($svyid);
		if($this->ev->get('addquestion'))
		{
			$args = $this->ev->get('args');
			$args['syqnsvyid'] = $svyid;
			$args['syqnsyneid'] = $syneid;
			$this->survey->addSurveyQuestion($args);
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
			$questypes = $this->survey->getQuestypeList();
			$this->tpl->assign('questypes',$questypes);
			$this->tpl->assign('node',$surveynode);
			$this->tpl->assign('survey',$survey);
			$this->tpl->display('survey_addquestion');
		}
	}

	public function modifyquestion()
	{
		$syqnid = $this->ev->get('syqnid');
		$question = $this->survey->getSurveyQuestionById($syqnid);
		if($this->ev->get('modifyquestion'))
		{
			$args = $this->ev->get('args');
			$this->survey->modifySurveyQuestion($syqnid,$args);
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
			$questypes = $this->survey->getQuestypeList();
			$this->tpl->assign('questypes',$questypes);
			$this->tpl->assign('question',$question);
			$this->tpl->display('survey_modifyquestion');
		}
	}

	public function addpaper()
	{
		if($this->ev->get('addpaper'))
		{
			$args = $this->ev->get('args');
			$args['svyuserid'] = $this->_user['sessionuserid'];
			$args['svystime'] = strtotime($args['svystime']);
			$args['svyendtime'] = strtotime($args['svyendtime']);
			$args['svytime'] = TIME;
			$this->survey->addSurvey($args);
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
			$this->tpl->display('survey_addpaper');
		}
	}

	public function modifypaper()
	{
		$svyid = $this->ev->get('svyid');
		$survey = $this->survey->getSurveyById($svyid);
		if($this->ev->get('modifypaper'))
		{
			$args = $this->ev->get('args');
			$args['svyuserid'] = $this->_user['sessionuserid'];
			$args['svystime'] = strtotime($args['svystime']);
			$args['svyendtime'] = strtotime($args['svyendtime']);
			$args['svytime'] = TIME;
			$this->survey->modifySurvey($svyid,$args);
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
			$this->tpl->assign('survey',$survey);
			$this->tpl->display('survey_modifypaper');
		}
	}

	public function addnode()
	{
		$svyid = $this->ev->get('svyid');
		$survey = $this->survey->getSurveyById($svyid);
		if($this->ev->get('addnode'))
		{
			$args = $this->ev->get('args');
			$args['synesvyid'] = $svyid;
			$this->survey->addSurveyNode($args);
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
			$this->tpl->assign('survey',$survey);
			$this->tpl->display('survey_addnode');
		}
	}

	public function modifynode()
	{
		$syneid = $this->ev->get('syneid');
		$surveynode = $this->survey->getSurveyNodeById($syneid);
		if($this->ev->get('modifynode'))
		{
			$args = $this->ev->get('args');
			$this->survey->modifySurveyNode($syneid,$args);
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
			$this->tpl->assign('node',$surveynode);
			$this->tpl->display('survey_modifynode');
		}
	}

	public function downloadstats()
	{
		$svyid = $this->ev->get('svyid');
		$survey = $this->survey->getSurveyById($svyid);
		$nodes = $this->survey->getSurveyNodesByArgs(array(
			array("AND","synesvyid = :synesvyid","synesvyid",$svyid)
		));
		$questions = array();
		foreach($nodes as $node)
		{
			$questions[$node['syneid']] = $this->survey->getSurveyQuestionsByArgs(array(
				array("AND","syqnsyneid = :syqnsyneid","syqnsyneid",$node['syneid'])
			));
		}
		$questypes = $this->survey->getQuestypeList();
		$args = array();
		$args[] = array("AND","syhysvyid = :syhysvyid","syhysvyid",$svyid);
		if($this->cuser['usercity'])
		{
			$args[] = array("AND","syhycity = :syhycity","syhycity",$this->cuser['usercity']);
		}
		$histories = $this->survey->getSurveyHistoriesByArgs($args);
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
					foreach($this->config->selectors as $key => $selector)
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
		$svyid = $this->ev->get('svyid');
		$survey = $this->survey->getSurveyById($svyid);
		$nodes = $this->survey->getSurveyNodesByArgs(array(
			array("AND","synesvyid = :synesvyid","synesvyid",$svyid)
		));
		$questions = array();
		foreach($nodes as $node)
		{
			$questions[$node['syneid']] = $this->survey->getSurveyQuestionsByArgs(array(
				array("AND","syqnsyneid = :syqnsyneid","syqnsyneid",$node['syneid'])
			));
		}
		$questypes = $this->survey->getQuestypeList();
		$args = array();
		$args[] = array("AND","syhysvyid = :syhysvyid","syhysvyid",$svyid);
		if($this->cuser['usercity'])
		{
			$args[] = array("AND","syhycity = :syhycity","syhycity",$this->cuser['usercity']);
		}
		$histories = $this->survey->getSurveyHistoriesByArgs($args);
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
		$this->tpl->assign('rate',$rate);
		$this->tpl->assign('number',$number);
		$this->tpl->assign('qnumber',$qnumber);
		$this->tpl->assign('histories',$histories);
		$this->tpl->assign('questypes',$questypes);
		$this->tpl->assign('nodes',$nodes);
		$this->tpl->assign('questions',$questions);
		$this->tpl->assign('survey',$survey);
		$this->tpl->display('survey_stats');
	}

	public function paper()
	{
		$svyid = $this->ev->get('svyid');
		$survey = $this->survey->getSurveyById($svyid);
		$nodes = $this->survey->getSurveyNodesByArgs(array(
			array("AND","synesvyid = :synesvyid","synesvyid",$svyid)
		));
		$questions = array();
		foreach($nodes as $node)
		{
			$questions[$node['syneid']] = $this->survey->getSurveyQuestionsByArgs(array(
				array("AND","syqnsyneid = :syqnsyneid","syqnsyneid",$node['syneid'])
			));
		}
		$questypes = $this->survey->getQuestypeList();
		$this->tpl->assign('questypes',$questypes);
		$this->tpl->assign('nodes',$nodes);
		$this->tpl->assign('questions',$questions);
		$this->tpl->assign('survey',$survey);
		$this->tpl->display('survey_paper');
	}

	public function viewhistory()
	{
		$syhyid = $this->ev->get('syhyid');
		$history = $this->survey->getSurveyHistoryById($syhyid);
		$svyid = $history['syhysvyid'];
		$survey = $this->survey->getSurveyById($svyid);
		$nodes = $this->survey->getSurveyNodesByArgs(array(
			array("AND","synesvyid = :synesvyid","synesvyid",$svyid)
		));
		$questions = array();
		foreach($nodes as $node)
		{
			$questions[$node['syneid']] = $this->survey->getSurveyQuestionsByArgs(array(
				array("AND","syqnsyneid = :syqnsyneid","syqnsyneid",$node['syneid'])
			));
		}
		$questypes = $this->survey->getQuestypeList();
		$this->tpl->assign('questypes',$questypes);
		$this->tpl->assign('nodes',$nodes);
		$this->tpl->assign('questions',$questions);
		$this->tpl->assign('answers',$history['syhyanswers']);
		$this->tpl->assign('survey',$survey);
		$this->tpl->display('survey_viewhistory');
	}

	public function answers()
	{
		M('pg')->setUrlTarget('modal-body" class="ajax');
		$svyid = $this->ev->get('svyid');
		$syqnid = $this->ev->get('syqnid');
		$survey = $this->survey->getSurveyById($svyid);
		$page = intval($this->ev->get('page'));
		$args = array();
		$args[] = array("AND","syhysvyid = :syhysvyid","syhysvyid",$svyid);
		if($survey['svytype'])$histories = $this->survey->getSurveyHistoryAndUsersList($args,$page);
		else $histories = $this->survey->getSurveyHistoryList($args,$page);
		$this->tpl->assign('survey',$survey);
		$this->tpl->assign('syqnid',$syqnid);
		$this->tpl->assign('histories',$histories);
		$this->tpl->display('survey_answers');
	}

	public function history()
	{
		$svyid = $this->ev->get('svyid');
		$survey = $this->survey->getSurveyById($svyid);
		$page = intval($this->ev->get('page'));
		$args = array();
		$args[] = array("AND","syhysvyid = :syhysvyid","syhysvyid",$svyid);
		if($survey['svytype'])$histories = $this->survey->getSurveyHistoryAndUsersList($args,$page);
		else $histories = $this->survey->getSurveyHistoryList($args,$page);
		$this->tpl->assign('survey',$survey);
		$this->tpl->assign('histories',$histories);
		$this->tpl->display('survey_history');
	}

	public function index()
	{
		$page = intval($this->ev->get('page'));
		$args = array();
		if($this->search['keyword'])
		{
			$args[] = array("AND","svytitle LIKE :svytitle","svytitle","%{$this->search['keyword']}%");
		}		
		$surveies = $this->survey->getSurveyList($args,$page);
		$this->tpl->assign('surveies',$surveies);
		$this->tpl->display('survey');
	}
}


?>
