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
        $this->exer = M('exercise','exam');
	    $action = $this->ev->url(3);
		if(!method_exists($this,$action))
		$action = "index";
		$this->$action();
		exit;
	}

	private function reporterror()
	{
		if($this->ev->get('reporterror'))
		{
			$args = $this->ev->get('args');
			if($args['fbquestionid'] && $args['fbtype'])
			{
				$this->feedback = M('feedback','exam');
				$args['fbuserid'] = $this->_user['sessionuserid'];
				$this->feedback->addFeedBack($args);
				$message = array(
					'statusCode' => 200,
					"message" => "提交成功，请等待管理员处理"
				);
			}
			else
			$message = array(
				'statusCode' => 300,
				"message" => "缺少参数"
			);
			\PHPEMS\ginkgo::R($message);
		}
	}

	private function ajax()
	{
		switch($this->ev->url(4))
		{
			case 'questions':
			$number = $this->ev->get('number');
			$questid = $this->ev->get('questid');
			$knowsid = $this->ev->get('knowsid');
			$basic = $this->data['currentbasic'];
			$verify = false;
			foreach($basic['basicknows'] as $knowsids)
			{
				if(in_array($knowsid,$knowsids))
				{
					$verify = true;
					break;
				}
			}
			if(!$knowsid || !$verify)
			{
				$message = array(
					'statusCode' => 200,
					"message" => "操作超时，请重新开始练习",
				    "callbackType" => 'forward',
				    "forwardUrl" => "index.php?exam-app-lesson"
				);
				\PHPEMS\ginkgo::R($message);
			}
			if(!$number)
			{
				$exer = $this->exer->getExerciseProcessByUser($this->_user['sessionuserid'],$this->data['currentbasic']['basicid'],$knowsid);
				if($exer['exernumber'])$number = $exer['exernumber'];
				else $number = 1;
            }
            else
			$args = array('exeruserid' => $this->_user['sessionuserid'],'exerbasicid' => $this->data['currentbasic']['basicid'],'exerknowsid' => $knowsid,'exernumber' => $number,'exerqutype' => $questid);
            $this->exer->setExercise($args);
            $knows = $this->section->getQuestionsByKnows($knowsid);
			if($questid)
			{
				$allnumber = $knows['knowsnumber'][$questid];
                $questions = $knows['knowsquestions'][$questid];
			}
			else
			{
				$allnumber = array_sum($knows['knowsnumber']);
                $questions = array();
                foreach($knows['knowsquestions'] as $p)
				{
                    $questions = array_merge($questions,$p);
				}
            }
            unset($knows['knowsquestions'],$knows['knowsnumber']);
			if(($number > $allnumber) && $allnumber)$number = $allnumber;
			$qunumber = count($questions);
			$question = $this->exam->getQuestionByArgs(array(array("AND","questionid = :questionid",'questionid',$questions[intval($number - 1)])));
			if($question['questionparent'])
			{
				$parent = $this->exam->getQuestionRowsById($question['questionparent'],false,false);
                $this->tpl->assign('parent',$parent);
			}
			$questypes = $this->basic->getQuestypeList();
			$this->tpl->assign('question',$question);
			$this->tpl->assign('questype',$questypes[$question['questiontype']]);
			$this->tpl->assign('knows',$knows);
			$this->tpl->assign('allnumber',$allnumber);
			$this->tpl->assign('number',$number);
			$this->tpl->display('lesson_ajaxquestion');
			break;
		}
	}

	private function paper()
	{
		$questid = $this->ev->get('questype');
		$knowsid = $this->ev->get('knowsid');
		if($questid)
		$questype = $this->basic->getQuestypeById($questid);
		$knows = $this->section->getKnowsById($knowsid);
		$this->tpl->assign('knows',$knows);
		$this->tpl->assign('questype',$questype);
		$this->tpl->display('lesson_paper');
	}

	public function index()
	{
		$basic = $this->data['currentbasic'];
		$sections = $this->section->getSectionListByArgs(array(array("AND","sectionsubjectid = :sectionsubjectid",'sectionsubjectid',$basic['basicsubjectid'])));
        $knows = array();
        foreach($basic['basicknows'] as $knowsids)
		{
			foreach($knowsids as $knowsid)
			{
                $knows[$knowsid] = $this->section->getQuestionsByKnows($knowsid);
			}
		}
		$record = $this->exer->getExerciseProcessByUser($this->_user['sessionuserid'],$basic['basicid']);
		$this->tpl->assign('record',$record);
		$this->tpl->assign('basic',$basic);
		$this->tpl->assign('sections',$sections);
		$this->tpl->assign('knows',$knows);
		$this->tpl->display('lesson');
	}
}


?>
