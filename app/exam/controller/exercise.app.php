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

	private function ajax()
	{
		switch($this->ev->url(4))
		{
			case 'getQuestionNumber':
				$questype = $this->basic->getQuestypeList();
				$subject = $this->basic->getSubjectById($this->data['currentbasic']['basicsubjectid']);
				$sectionid = $this->ev->get('sectionid');
				$knowids = $this->ev->get('knowsid');
				if(!$knowids)
				{
					if(!$sectionid)$knows = $this->section->getAllKnowsBySubject($this->data['currentsubject']['subjectid']);
					else
						$knows = $this->section->getKnowsListByArgs(array(array("AND","knowssectionid = :knowssectionid",'knowssectionid',$sectionid),array("AND","knowsstatus = 1")));
					foreach($knows as $key => $p)
						$knowids .= "{$key},";
					$knowids = trim($knowids," ,");
				}
				$numbers = array();
				$numbers = array();
				foreach($questype as $p)
				{
					if($subject['subjectsetting']['questypes'][$p['questid']])
					{
						$numbers[$p['questid']] = intval(ceil($this->exam->getQuestionNumberByQuestypeAndKnowsid($p['questid'],$knowids)));
					}
				}
				$this->tpl->assign('numbers',$numbers);
				$this->tpl->assign('questype',$questype);
				$this->tpl->display('exercise_number');
				break;

			default:
		}
	}

	private function score()
	{
        $questype = $this->basic->getQuestypeList();
		if($this->ev->get('insertscore'))
		{
			$sessionid = $this->ev->get('sessionid');
			$token = $this->ev->get('token');
			$sessionvars = $this->exam->getExamSessionBySessionid($sessionid);
			if(!$sessionvars['examsessionid'] || (md5($sessionvars['examsessionid'].'-'.$this->_user['sessionuserid'].'-'.$sessionvars['examsessiontoken']) != $token))
			{
                $message = array(
                    'statusCode' => 300,
                    "message" => "非法参数"
                );
                \PHPEMS\ginkgo::R($message);
			}
			$question = $this->ev->get('question');
            $sessionvars['examsessionuseranswer'] = $question;
			$result = $this->exam->markscore($sessionvars,$questype);
			if($result['needhand'])
			{
				$message = array(
					'statusCode' => 200,
					"message" => "交卷成功",
					"callbackType" => 'forward',
					"forwardUrl" => "index.php?exam-app-history-makescore&ehid={$result['ehid']}"
				);
            }
            else
			{
                $message = array(
                    'statusCode' => 200,
                    "message" => "交卷成功",
                    "callbackType" => 'forward',
                    "forwardUrl" => "index.php?exam-app-history-stats&ehid={$result['ehid']}"
                );
			}
            \PHPEMS\ginkgo::R($message);
		}
		else
		{
            $message = array(
                'statusCode' => 300,
                "message" => "非法参数"
            );
            \PHPEMS\ginkgo::R($message);
		}
	}

	private function paper()
	{
		$sessionid = $this->ev->get('sessionid');
		$token = $this->ev->get('token');
		$sessionvars = $this->exam->getExamSessionBySessionid($sessionid);
		if(!$sessionvars['examsessionid'] || (md5($sessionvars['examsessionid'].'-'.$this->_user['sessionuserid'].'-'.$sessionvars['examsessiontoken']) != $token))
		{
			header("location:index.php?exam-app-exercise");
			exit;
		}
        $lefttime = 0;
        $questype = $this->basic->getQuestypeList();
        $this->tpl->assign('questype',$questype);
        $this->tpl->assign('sessionvars',$sessionvars);
		$this->tpl->assign('token',$token);
        $this->tpl->assign('lefttime',$lefttime);
        $this->tpl->assign('donumber',is_array($sessionvars['examsessionuseranswer'])?count($sessionvars['examsessionuseranswer']):0);
        $this->tpl->display('exercise_paper');
	}

	public function index()
	{
		if($this->ev->get('setExecriseConfig'))
		{
			$args = $this->ev->get('args');
			if(!$args['sectionid'])
			{
                $message = array(
                    'statusCode' => 300,
                    "message" => "请选择章节"
                );
                \PHPEMS\ginkgo::R($message);
			}
            if(!$args['knowsid'])
            {
                $message = array(
                    'statusCode' => 300,
                    "message" => "请选择知识点"
                );
                \PHPEMS\ginkgo::R($message);
            }
			if(!$args['knowsid'])
			{
				$args['knowsid'] = '';
				if($args['sectionid'])
				$knowsids = $this->section->getKnowsListByArgs(array(array("AND","knowssectionid = :knowssectionid",'knowssectionid',$args['sectionid']),array("AND","knowsstatus = 1")));
				else
				{
					$knowsids = $this->section->getAllKnowsBySubject($this->data['currentsubject']['subjectid']);
				}
				foreach($knowsids as $key => $p)
				$args['knowsid'] .= intval($key).",";
				$args['knowsid'] = trim($args['knowsid']," ,");
			}
			else
			{
				if(is_array($args['knowsid']))
				{
					$args['knowsid'] = implode(',',$args['knowsid']);
				}
			}
			arsort($args['number']);
			$snumber = 0;
			foreach($args['number'] as $key => $v)
			{
				$snumber += $v;
				if($snumber > 100)
				{
					$message = array(
						'statusCode' => 300,
						"message" => "强化练习最多一次只能抽取100道题"
					);
					\PHPEMS\ginkgo::R($message);
				}
			}
			if(!$snumber)
			{
                $message = array(
                    'statusCode' => 300,
                    "message" => "请填写抽题数量"
                );
                \PHPEMS\ginkgo::R($message);
			}
			$dt = key($args['number']);
			$questionids = $this->question->selectQuestionsByKnows($args['knowsid'],$args['number'],$dt);
			$questions = array();
			$questionrows = array();
			foreach($questionids['question'] as $key => $p)
			{
				$ids = "";
				if(count($p))
				{
					foreach($p as $t)
					{
						$ids .= $t.',';
					}
					$ids = trim($ids," ,");
					if(!$ids)$ids = 0;
					$questions[$key] = $this->exam->getQuestionListByIds($ids);
				}
			}
			foreach($questionids['questionrow'] as $key => $p)
			{
				$ids = "";
				if(is_array($p))
				{
					if(count($p))
					{
						foreach($p as $t)
						{
							$questionrows[$key][$t] = $this->exam->getQuestionRowsById($t);
						}
					}
				}
				else $questionrows[$key][$p] = $this->exam->getQuestionRowsByArgs("qrid = '{$p}'");
			}
			$sargs['examsessionquestion'] = array('questionids'=>$questionids,'questions'=>$questions,'questionrows'=>$questionrows);
			$sargs['examsessionsetting'] = $args;
			$sargs['examsessionstarttime'] = TIME;
			$sargs['examsessionuseranswer'] = NULL;
			$sargs['examsession'] = $args['title'];
			$sargs['examsessiontime'] = $args['time']>0?$args['time']:60;
			$sargs['examsessionstatus'] = 0;
			$sargs['examsessiontype'] = 0;
			$sargs['examsessionbasic'] = $this->data['currentbasic']['basicid'];
			$sargs['examsessionkey'] = 0;
			$sargs['examsessionissave'] = 0;
			$sargs['examsessionsign'] = NULL;
			$sargs['examsessionsign'] = '';
			$sargs['examsessionuserid'] = $this->_user['sessionuserid'];
			$sargs['examsessiontoken'] = uniqid();
			$sargs['examsessionid'] = md5(serialize($sargs));
			$token = md5($sargs['examsessionid'].'-'.$this->_user['sessionuserid'].'-'.$sargs['examsessiontoken']);
			$this->exam->insertExamSession($sargs);
			$message = array(
				'statusCode' => 200,
				"message" => "抽题完毕，转入试卷页面",
				"callbackType" => 'forward',
				"forwardUrl" => "index.php?exam-app-exercise-paper&sessionid={$sargs['examsessionid']}&token={$token}"
			);
			\PHPEMS\ginkgo::R($message);
		}
		else
		{
			$questype = $this->basic->getQuestypeList();
			$sections = $this->section->getSectionListByArgs(array(array("AND","sectionsubjectid = :sectionsubjectid",'sectionsubjectid',$this->data['currentbasic']['basicsubjectid'])));
			$knows = $this->section->getAllKnowsBySubject($this->data['currentbasic']['basicsubjectid']);
			$subject = $this->basic->getSubjectById($this->data['currentbasic']['basicsubjectid']);
			$questypes = array();
			foreach($subject['subjectsetting']['questypes'] as $key => $p)
			{
				$questypes[$key] = $questype[$key];
			}
			$this->tpl->assign('basicnow',$this->data['currentbasic']);
			$this->tpl->assign('sections',$sections);
			$this->tpl->assign('knows',$knows);
			$this->tpl->assign('questype',$questypes);
			$this->tpl->display('exercise');
		}
	}
}


?>
