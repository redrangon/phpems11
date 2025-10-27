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
	    $action = M('ev')->url(3);
		if(!method_exists($this,$action))
		$action = "index";
		$this->$action();
		exit;
	}

	private function reporterror()
	{
		if(M('ev')->get('reporterror'))
		{
			$args = M('ev')->get('args');
			if($args['fbquestionid'] && $args['fbtype'])
			{
				$args['fbuserid'] = $this->user['userid'];
				M('feedback','exam')->addFeedBack($args);
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
		switch(M('ev')->url(4))
		{
			case 'questions':
			$number = M('ev')->get('number');
			$questid = M('ev')->get('questid');
			$knowsid = M('ev')->get('knowsid');
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
				$exer = $this->exer->getExerciseProcessByUser($this->user['userid'],$this->data['currentbasic']['basicid'],$knowsid);
				if($exer['exernumber'])$number = $exer['exernumber'];
				else $number = 1;
            }
            else
			$args = array('exeruserid' => $this->user['userid'],'exerbasicid' => $this->data['currentbasic']['basicid'],'exerknowsid' => $knowsid,'exernumber' => $number,'exerqutype' => $questid);
            $this->exer->setExercise($args);
            $knows = M('section','exam')->getQuestionsByKnows($knowsid);
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
			$question = M('exam','exam')->getQuestionByArgs(array(array("AND","questionid = :questionid",'questionid',$questions[intval($number - 1)])));
			if($question['questionparent'])
			{
				$parent = M('exam','exam')->getQuestionRowsById($question['questionparent'],false,false);
                M('tpl')->assign('parent',$parent);
			}
			$questypes = M('basic','exam')->getQuestypeList();
			M('tpl')->assign('question',$question);
			M('tpl')->assign('questype',$questypes[$question['questiontype']]);
			M('tpl')->assign('knows',$knows);
			M('tpl')->assign('allnumber',$allnumber);
			M('tpl')->assign('number',$number);
			M('tpl')->display('lesson_ajaxquestion');
			break;
		}
	}

	private function paper()
	{
		$questid = M('ev')->get('questype');
		$knowsid = M('ev')->get('knowsid');
		if($questid)
		$questype = M('basic','exam')->getQuestypeById($questid);
		$knows = M('section','exam')->getKnowsById($knowsid);
		M('tpl')->assign('knows',$knows);
		M('tpl')->assign('questype',$questype);
		M('tpl')->display('lesson_paper');
	}

	public function index()
	{
		$basic = $this->data['currentbasic'];
		$sections = M('section','exam')->getSectionListByArgs(array(array("AND","sectionsubjectid = :sectionsubjectid",'sectionsubjectid',$basic['basicsubjectid'])));
        $knows = array();
        foreach($basic['basicknows'] as $knowsids)
		{
			foreach($knowsids as $knowsid)
			{
                $knows[$knowsid] = M('section','exam')->getQuestionsByKnows($knowsid);
			}
		}
		$record = $this->exer->getExerciseProcessByUser($this->user['userid'],$basic['basicid']);
		M('tpl')->assign('record',$record);
		M('tpl')->assign('basic',$basic);
		M('tpl')->assign('sections',$sections);
		M('tpl')->assign('knows',$knows);
		M('tpl')->display('lesson');
	}
}


?>
