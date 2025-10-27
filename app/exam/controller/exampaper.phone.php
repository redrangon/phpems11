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

    private function score()
    {
        $questype = M('basic','exam')->getQuestypeList();
        if(M('ev')->get('insertscore'))
        {
			$sessionid = M('ev')->get('sessionid');
			$token = M('ev')->get('token');
			$sessionvars = M('exam','exam')->getExamSessionBySessionid($sessionid);
			if(!$sessionvars['examsessionid'] || (md5($sessionvars['examsessionid'].'-'.$this->user['userid'].'-'.$sessionvars['examsessiontoken']) != $token))
			{
                $message = array(
                    'statusCode' => 300,
                    "message" => "非法参数"
                );
                \PHPEMS\ginkgo::R($message);
            }
            $question = M('ev')->get('question');
            $sessionvars['examsessionuseranswer'] = $question;
            $result = M('exam','exam')->markscore($sessionvars,$questype,$this->data['currentbasic']['basicexam']['batch']);
            if($result['wrongids'] && $this->setting['autorecord'])
            {
                M('favor','exam')->addRecords($this->user['userid'],$result['wrongids'],$this->data['currentbasic']['basicsubjectid']);
            }
            if($result['needhand'])
            {
                $message = array(
                    'statusCode' => 200,
                    "message" => "交卷成功",
                    "callbackType" => 'forward',
                    "forwardUrl" => "index.php?exam-phone-history-makescore&ehid={$result['ehid']}"
                );
            }
            else
            {
                $message = array(
                    'statusCode' => 200,
                    "message" => "交卷成功",
                    "callbackType" => 'forward',
                    "forwardUrl" => "index.php?exam-phone-history-stats&ehid={$result['ehid']}"
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
		$sessionid = M('ev')->get('sessionid');
		$token = M('ev')->get('token');
		$sessionvars = M('exam','exam')->getExamSessionBySessionid($sessionid);
		if(!$sessionvars['examsessionid'] || (md5($sessionvars['examsessionid'].'-'.$this->user['userid'].'-'.$sessionvars['examsessiontoken']) != $token))
		{
            $message = array(
                'statusCode' => 200,
                "callbackType" => 'forward',
                "forwardUrl" => "back"
            );
            \PHPEMS\ginkgo::R($message);
        }
        $lefttime = 0;
        $questype = M('basic','exam')->getQuestypeList();
		M('tpl')->assign('questype',$questype);
		M('tpl')->assign('sessionvars',$sessionvars);
		M('tpl')->assign('token',$token);
		M('tpl')->assign('lefttime',$lefttime);
		M('tpl')->assign('donumber',is_array($sessionvars['examsessionuseranswer'])?count($sessionvars['examsessionuseranswer']):0);
		M('tpl')->display('exampaper_paper');
	}

	private function selectquestions()
	{
		$examid = M('ev')->get('examid');
		$r = M('exam','exam')->getExamSettingById($examid);
		if(!$r['examid'])
		{
			$message = array(
				'statusCode' => 300,
				"message" => "参数错误，尝试退出后重新进入"
			);
			\PHPEMS\ginkgo::R($message);
		}
		else
		{
			if($r['examtype'] == 1)
			{
				$questionids = M('question','exam')->selectQuestions($examid,$this->data['currentbasic']);
				$questions = array();
				$questionrows = array();
				$str = '';
				foreach($questionids['question'] as $key => $p)
				{
					$questions[$key] = M('exam','exam')->getQuestionListByIds($p);
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
								$questionrows[$key][$t] = M('exam','exam')->getQuestionRowsById($t);
							}
						}
					}
					else $questionrows[$key][$p] = M('exam','exam')->getQuestionRowsById($p);
				}
				$args = array();
				$args['examsessionquestion'] = array('questionids'=>$questionids,'questions'=>$questions,'questionrows'=>$questionrows);
				$args['examsessionsetting'] = $r;
				$args['examsessionstarttime'] = TIME;
				$args['examsession'] = $r['exam'];
				$args['examsessiontime'] = $r['examsetting']['examtime']>0?$r['examsetting']['examtime']:60;
				$args['examsessionstatus'] = 0;
				$args['examsessiontype'] = 1;
				$args['examsessionsign'] = NULL;
				$args['examsessionuseranswer'] = NULL;
				$args['examsessionbasic'] = $this->data['currentbasic']['basicid'];
				$args['examsessionkey'] = $examid;
				$args['examsessionissave'] = 0;
				$args['examsessionsign'] = '';
				$args['examsessionuserid'] = $this->user['userid'];
			}
			elseif($r['examtype'] == 2)
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
				$args['examsessionuseranswer'] = NULL;
				$args['examsessionscorelist'] = NULL;
				$args['examsessionsign'] = NULL;
				$args['examsessiontime'] = $r['examsetting']['examtime'];
				$args['examsessionstatus'] = 0;
				$args['examsessiontype'] = 1;
				$args['examsessionkey'] = $r['examid'];
				$args['examsessionissave'] = 0;
				$args['examsessionbasic'] = $this->data['currentbasic']['basicid'];
				$args['examsessionuserid'] = $this->user['userid'];
			}
			else
			{
				$args['examsessionquestion'] = $r['examquestions'];
				$args['examsessionsetting'] = $r;
				$args['examsessionstarttime'] = TIME;
				$args['examsession'] = $r['exam'];
				$args['examsessionscore'] = 0;
				$args['examsessionuseranswer'] = '';
				$args['examsessionscorelist'] = '';
				$args['examsessionsign'] = '';
				$args['examsessiontime'] = $r['examsetting']['examtime'];
				$args['examsessionstatus'] = 0;
				$args['examsessiontype'] = 1;
				$args['examsessionkey'] = $r['examid'];
				$args['examsessionissave'] = 0;
				$args['examsessionbasic'] = $this->data['currentbasic']['basicid'];
				$args['examsessionuserid'] = $this->user['userid'];
			}
			$args['examsessiontoken'] = uniqid();
			$args['examsessionid'] = md5(serialize($args));
			$token = md5($args['examsessionid'].'-'.$this->user['userid'].'-'.$args['examsessiontoken']);
			M('exam','exam')->insertExamSession($args);
			$message = array(
				'statusCode' => 200,
				"message" => "抽题完毕，转入试卷页面",
				"callbackType" => 'forward',
				"forwardUrl" => "index.php?exam-phone-exampaper-paper&sessionid={$args['examsessionid']}&token={$token}"
			);
			\PHPEMS\ginkgo::R($message);
		}
	}

	public function index()
	{
        $page = M('ev')->get('page');
		$ids = trim($this->data['currentbasic']['basicexam']['auto'],', ');
		if(!$ids)$ids = 0;
		$exams = M('exam','exam')->getExamSettingList(array(array("AND","find_in_set(examid,:examid)",'examid',$ids)),$page,20);
		M('tpl')->assign('exams',$exams);
		M('tpl')->display('exampaper');
	}
}


?>
