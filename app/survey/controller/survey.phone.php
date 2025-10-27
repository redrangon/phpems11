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
		M('tpl')->assign('cities',M('config','survey')->cities);
		$action = M('ev')->url(3);
		if(!method_exists($this,$action))
		$action = "index";
		$this->$action();
		exit;
	}
	
	/**
	 *
	 * history值存在，用成功页面，不存在，用失败页面
	 *
	 **/
	public function view()
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
		$questypes = M('basic','exam')->getQuestypeList();
		M('tpl')->assign('questypes',$questypes);
		M('tpl')->assign('nodes',$nodes);
		M('tpl')->assign('questions',$questions);
		M('tpl')->assign('survey',$survey);
		M('tpl')->display('survey_view');
	}
	
	public function paper()
	{
		$svyid = M('ev')->get('svyid');
		$survey = M('survey','survey')->getSurveyById($svyid);
		if($survey['svyendtime'] < TIME)
		{
			$message = array(
				'statusCode' => 300,
				"message" => "进入失败，问卷已过期"
			);
			ginkgo::R($message);
		}
		if(M('ev')->get('popstatus') == 'back')
		{
			$message = array(
				'statusCode' => 200,
				"callbackType" => 'forward',
				"forwardUrl" => "back"
			);
			ginkgo::R($message);
		}
		if($survey['svytype'])
		{
			$rs = M('survey','survey')->getSurveyHistoryByArgs(array(
				array("AND", "syhyuserid = :syhyuserid", "syhyuserid", $this->user['userid']),
				array("AND", "syhysvyid = :syhysvyid", "syhysvyid", $survey['syhyid'])
			));
			if ($rs)
			{
				$message = array(
					'statusCode' => 300,
					"message" => "操作失败，您已经参加过了",
					"callbackType" => 'forward',
					"forwardUrl" => "back"
				);
				ginkgo::R($message);
			}
		}
		if(M('ev')->get('submitpaper'))
		{
			$args = array();
			if($survey['svytype'])
			{
				$args['syhyuserid'] = $this->user['userid'];
			}
			$questions = M('ev')->get('question');
			$args['syhysvyid'] = $svyid;
			$args['syhyanswers'] = $questions;
			$args['syhytime'] = TIME;
			$syhyid = M('survey','survey')->addSurveyHistory($args);
			$message = array(
				'statusCode' => 200,
				"message" => "操作成功，正在转入目标页面",
			    "callbackType" => 'forward',
			    "forwardUrl" => "index.php?survey-phone-survey-view&syhyid={$syhyid}"
			);
			\PHPEMS\ginkgo::R($message);			
		}
		else
		{
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
			$questypes = M('basic','exam')->getQuestypeList();
			M('tpl')->assign('questypes',$questypes);
			M('tpl')->assign('nodes',$nodes);
			M('tpl')->assign('questions',$questions);
			M('tpl')->assign('survey',$survey);
			M('tpl')->display('survey_paper');
		}
	}

	public function index()
	{
		$page = intval(M('ev')->get('page'));
		$args = array();
		$args[] = array("AND","svyendtime > :syendtime","syendtime",TIME);
		$surveies = M('survey','survey')->getSurveyList($args,$page);
		M('tpl')->assign('surveies',$surveies);		
		M('tpl')->display('survey');
	}
}


?>
