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
        if($this->data['currentbasic']['basicexam']['model'] == 2)
		{
			if(!in_array($action,array('makescore','stats')))
			{
                header("location:index.php?exam-app-exam");
                exit;
			}
		}
		if(!method_exists($this,$action))
		$action = "index";
		$this->$action();
		exit;
	}

    private function wrongs()
    {
        $ehid = M('ev')->get('ehid');
        $eh = M('favor','exam')->getExamHistoryById($ehid);
        if(!$eh['ehstatus'] && ($eh['ehtype'] == 1 || $eh['ehsetting']['examdecide']))
        {
            header("location:index.php?exam-app-history-makescore&ehid=".$ehid);
            exit;
        }
        $questype = M('basic','exam')->getQuestypeList();
        $sessionvars = array(
        	'examsession' => $eh['ehexam'],
			'examsessionscorelist' => $eh['ehscorelist'],
			'examsessionsetting' => $eh['ehsetting'],
			'examsessionquestion' => $eh['ehquestion'],
			'examsessionuseranswer' => $eh['ehuseranswer']
		);
		if(!$eh['ehtype'])
		{
			$sessionvars['examsessionsetting']['examsetting']['questypelite'] = $questype;
		}
        M('tpl')->assign('sessionvars',$sessionvars);
        M('tpl')->assign('eh',$eh);
        M('tpl')->assign('questype',$questype);
        M('tpl')->display('history_examwrongs');
    }


	private function makescore()
	{
        $ehid = M('ev')->get('ehid');
        $eh = M('favor','exam')->getExamHistoryById($ehid);
        if($eh['ehstatus'] || ($eh['ehsetting']['examdecide'] && $eh['ehtype'] == 2))
        {
            header("location:index.php?exam-app-history-stats&ehid={$ehid}");
            exit;
        }
		if(M('ev')->get('makescore'))
		{
            $score = M('ev')->get('score');
            $scorelist = $eh['ehscorelist'];
            foreach($score as $key => $p)
			{
                $scorelist[$key] = $p;
			}
			$args = array();
            $args['ehstatus'] = 1;
			$args['ehscorelist'] = $scorelist;
            $args['ehscore'] = array_sum($scorelist);
            if($eh['ehtype'])
			{
                $args['ehispass'] = $args['ehscore'] >= $eh['ehsetting']['examsetting']['passscore']?1:0;
			}
            M('favor','exam')->modifyExamHistory($ehid,$args);
            $message = array(
                'statusCode' => 200,
                "message" => "判分成功",
                "callbackType" => 'forward',
                "forwardUrl" => "index.php?exam-app-history-stats&ehid={$ehid}"
            );
            \PHPEMS\ginkgo::R($message);
		}
		else
		{
			$questype = M('basic','exam')->getQuestypeList();
			foreach($questype as $quest)
			{
				$needhand = 0;
				if($quest['questsort'])$needhand = 1;
				else
				{
					unset($eh['ehquestion']['questions'][$quest['questid']]);
					foreach($eh['ehquestion']['questionrows'][$quest['questid']] as $rows)
					{
						foreach($rows['data'] as $question)
						{
							if($questype[$question['questiontype']]['questsort'])
							{
								$needhand = 1;
								break;
							}
						}
						if($needhand)break;
					}
				}
				if(!$needhand)unset($eh['ehquestion']['questionrows'][$quest['questid']]);
			}
			M('tpl')->assign('eh',$eh);
			M('tpl')->assign('questype',$questype);
			M('tpl')->display('history_mkscore');
        }
	}

	public function stats()
	{
        $ehid = M('ev')->get('ehid');
        $eh = M('favor','exam')->getExamHistoryById($ehid);
        $sessionvars = array(
            'examsession' => $eh['ehexam'],
            'examsessiontype'=> $eh['ehtype'] == 2?1:$eh['ehtype'],
            'examsessionsetting'=> $eh['ehsetting'],
            'examsessionbasic'=> $eh['ehbasicid'],
            'examsessionquestion'=> $eh['ehquestion'],
            'examsessionuseranswer'=>$eh['ehanswer'],
            'examsessiontime'=> $eh['ehsetting']['time'],
            'examsessionscorelist'=> $eh['ehscorelist'],
            'examsessionscore'=>$eh['ehscore'],
            'examsessionstarttime'=>$eh['ehstarttime']
        );
        $number = array();
        $right = array();
        $score = array();
        $allnumber = 0;
        $allright = 0;
        $questype = M('basic','exam')->getQuestypeList();
        foreach($questype as $key => $q)
        {
            $number[$key] = 0;
            $right[$key] = 0;
            $score[$key] = 0;
            if($sessionvars['examsessionquestion']['questions'][$key])
            {
                foreach($sessionvars['examsessionquestion']['questions'][$key] as $p)
                {
                    $number[$key]++;
                    $allnumber++;
                    if($sessionvars['examsessionsetting']['examsetting']['scores'])
					{
						if($sessionvars['examsessionscorelist'][$p['questionid']] == $sessionvars['examsessionsetting']['examsetting']['scores'][$p['questionid']])
						{
							$right[$key]++;
							$allright++;
						}
					}
                    else
					{
						if($sessionvars['examsessionscorelist'][$p['questionid']] == $sessionvars['examsessionsetting']['examsetting']['questype'][$key]['score'])
						{
							$right[$key]++;
							$allright++;
						}
					}
                    $score[$key] = $score[$key] + floatval($sessionvars['examsessionscorelist'][$p['questionid']]);
                }
            }
            if($sessionvars['examsessionquestion']['questionrows'][$key])
            {
                foreach($sessionvars['examsessionquestion']['questionrows'][$key] as $v)
                {
                    foreach($v['data'] as $p)
                    {
                        $number[$key]++;
                        $allnumber++;
                        if($sessionvars['examsessionsetting']['examsetting']['scores'])
					{
						if($sessionvars['examsessionscorelist'][$p['questionid']] == $sessionvars['examsessionsetting']['examsetting']['scores'][$p['questionid']])
						{
							$right[$key]++;
							$allright++;
						}
					}
                    else {
						if ($sessionvars['examsessionscorelist'][$p['questionid']] == $sessionvars['examsessionsetting']['examsetting']['questype'][$key]['score']) {
							$right[$key]++;
							$allright++;
						}
					}
                        $score[$key] = $score[$key]+floatval($sessionvars['examsessionscorelist'][$p['questionid']]);
                    }
                }
            }
        }
        $stats = array();
        foreach($eh['ehquestion']['questions'] as $questions)
        {
            foreach($questions as $key => $question)
            {
                foreach($question['questionknowsid'] as $knows)
                {
                    $stats[$knows['knowsid']]['knowsid'] = $knows['knowsid'];
                    $stats[$knows['knowsid']]['knows'] = $knows['knows'];
                    $stats[$knows['knowsid']]['number'] = intval($stats[$knows['knowsid']]['number']) + 1;
                    if($eh['ehscorelist'][$question['questionid']] > 0)
                        $stats[$knows['knowsid']]['right'] = intval($stats[$knows['knowsid']]['right']) + 1;
                }
            }
        }
        foreach($eh['ehquestion']['questionrows'] as $questionrows)
        {
            foreach($questionrows as $questionrow)
            {
                foreach($questionrow['data'] as $key => $question)
                {

                    foreach($questionrow['qrknowsid'] as $knows)
                    {
                        $stats[$knows['knowsid']]['knowsid'] = $knows['knowsid'];
                        $stats[$knows['knowsid']]['knows'] = $knows['knows'];
                        $stats[$knows['knowsid']]['number'] = intval($stats[$knows['knowsid']]['number']) + 1;
                        if($eh['ehscorelist'][$question['questionid']] > 0)
                            $stats[$knows['knowsid']]['right'] = intval($stats[$knows['knowsid']]['right']) + 1;
                    }
                }
            }
        }

        M('tpl')->assign('stats',$stats);
        M('tpl')->assign('ehid',$ehid);
        M('tpl')->assign('eh',$eh);
        M('tpl')->assign('allright',$allright);
        M('tpl')->assign('allnumber',$allnumber);
        M('tpl')->assign('right',$right);
        M('tpl')->assign('score',$score);
        M('tpl')->assign('number',$number);
        M('tpl')->assign('questype',$questype);
        M('tpl')->assign('sessionvars',$sessionvars);
        M('tpl')->display('history_stats');
	}

	private function del()
	{
		$ehid = M('ev')->get('ehid');
		$ehtype = M('ev')->get('ehtype');
		$page = M('ev')->get('page');
		M('favor','exam')->delExamHistory($ehid,$this->user['userid']);
		$message = array(
			'statusCode' => 200,
			"message" => "操作成功",
		    "callbackType" => 'forward',
		    "forwardUrl" => "reload"
		);
		\PHPEMS\ginkgo::R($message);
	}

	private function batdelexercise()
	{
		$exercise = M('ev')->get('exercise');
		foreach($exercise as $p)
		M('favor','exam')->delExamHistory($p,$this->user['userid']);
		header("location:index.php?exam-app-history");
		exit;
	}

	private function batdelexam()
	{
		$exam = M('ev')->get('exam');
		foreach($exam as $p)
		M('favor','exam')->delExamHistory($p,$this->user['userid']);
		header("location:index.php?exam-app-history");
		exit;
	}

	private function view()
	{
		$ehid = M('ev')->get('ehid');
		$eh = M('favor','exam')->getExamHistoryById($ehid);
		if($eh['ehuserid'] != $this->user['userid'] || $eh['ehbasicid'] != $this->user['sessioncurrent'])
		{
			header("location:index.php?exam-app");
			exit;
		}
		if(!$eh['ehstatus'] && ($eh['ehtype'] == 1 || $eh['ehsetting']['examdecide']))
		{
            header("location:index.php?exam-app-history-makescore&ehid=".$ehid);
            exit;
		}
		$questype = M('basic','exam')->getQuestypeList();
		$sessionvars = array('examsession'=>$eh['ehexam'],'examsessiontimelist'=>$eh['ehtimelist'],'examsessionscore'=>$eh['ehscore'],'examsessionscorelist'=>$eh['ehscorelist'],'examsessionsetting'=>$eh['ehsetting'],'examsessionquestion'=>$eh['ehquestion'],'examsessionuseranswer'=>$eh['ehuseranswer']);
		M('tpl')->assign('sessionvars',$sessionvars);
		M('tpl')->assign('questype',$questype);
		M('tpl')->assign('eh',$eh);
		M('tpl')->assign('ehtype',$eh['ehtype']);
		if($eh['ehtype'])
		M('tpl')->display('history_examview');
		else
		M('tpl')->display('history_exerciseview');
	}

	private function redo()
	{
		$ehid = M('ev')->get('ehid');
		$eh = M('favor','exam')->getExamHistoryById($ehid);
		$args = array(
            'examsession' => $eh['ehexam'].'重做',
            'examsessiontype'=>$eh['ehtype'] == 2?1:$eh['ehtype'],
            'examsessionuserid' => $this->user['userid'],
            'examsessionkey' => $eh['examid'],
            'examsessionsetting'=>$eh['ehsetting'],
            'examsessionbasic'=>$eh['ehbasicid'],
            'examsessionquestion'=>$eh['ehquestion'],
            'examsessionuseranswer'=>'',
            'examsessiontime'=>$eh['ehsetting']['examsetting']['examtime']?$eh['ehsetting']['examsetting']['examtime']:60,
            'examsessionscorelist'=>'',
            'examsessionscore'=>0,
            'examsessionstarttime'=>TIME,
            'examsessionissave'=> 0,
            'examsessionstatus'=> 0
        );
		$args['examsessiontoken'] = uniqid();
		$args['examsessionid'] = md5(serialize($args));
		$token = md5($args['examsessionid'].'-'.$this->user['userid'].'-'.$args['examsessiontoken']);
		M('exam','exam')->insertExamSession($args);
		if($eh['ehtype'])
		$message = array(
			'statusCode' => 200,
			"message" => "试题加载成功，即将进入考试页面",
		    "callbackType" => 'forward',
		    "forwardUrl" => "index.php?exam-app-exampaper-paper&sessionid={$args['examsessionid']}&token={$token}"
		);
		else
		$message = array(
			'statusCode' => 200,
			"message" => "试题加载成功，即将进入考试页面",
		    "callbackType" => 'forward',
		    "forwardUrl" => "index.php?exam-app-exercise-paper&sessionid={$args['examsessionid']}&token={$token}"
		);
		\PHPEMS\ginkgo::R($message);
	}

	private function index()
	{
		$page = M('ev')->get('page');
		$ehtype = intval(M('ev')->get('ehtype'));
		$page = $page > 0?$page:1;
		$basicid = $this->data['currentbasic']['basicid'];
		$args = array(
		    array("AND","ehuserid = :ehuserid",'ehuserid',$this->user['userid']),
            array("AND","ehbasicid = :ehbasicid",'ehbasicid',$basicid),
            array("AND","ehtype = :ehtype",'ehtype',$ehtype)
        );
		$exams = M('favor','exam')->getExamHistoryListByArgs($args,$page,20,false,'ehid desc');
		foreach($exams['data'] as $key => $p)
		{
			$exams['data'][$key]['errornumber'] = 0;
			$questions = unserialize(gzuncompress(base64_decode($p['ehquestion'])));
			$scorelist = unserialize($p['ehscorelist']);
			$examsetting = unserialize(gzuncompress(base64_decode($p['ehsetting'])));
			if(is_array($questions['questions']) && is_array($scorelist))
			{
				foreach($questions['questions'] as $nkey => $q)
				{
					if(is_array($q))
					{
						foreach($q as $qid => $t)
						{
							if($p['ehtype'] == 0)
							{
								if($scorelist[$qid] != 1)$exams['data'][$key]['errornumber']++;
							}
							elseif($p['ehtype'] == 1)
							{
								if($scorelist[$qid] != $examsetting['examsetting']['questype'][$nkey]['score'])$exams['data'][$key]['errornumber']++;
							}
							else
							{
								if($scorelist[$qid] != $examsetting['examsetting']['questype'][$nkey]['score'])$exams['data'][$key]['errornumber']++;
							}
						}
					}
				}
				foreach($questions['questionrows'] as $nkey => $qt)
				{
					foreach($qt as $qtid => $q)
					{
						if(is_array($q))
						{
							foreach($q['data'] as $qid => $t)
							{
								if($p['ehtype'] == 0)
								{
									if($scorelist[$qid] != 1)$exams['data'][$key]['errornumber']++;
								}
								elseif($p['ehtype'] == 1)
								{
									if($scorelist[$qid] != $examsetting['examsetting']['questype'][$nkey]['score'])$exams['data'][$key]['errornumber']++;
								}
								else
								{
									if($scorelist[$qid] != $examsetting['examsetting']['questype'][$nkey]['score'])$exams['data'][$key]['errornumber']++;
								}
							}
						}
					}
				}
			}
		}
		$avgscore = floatval(M('favor','exam')->getAvgScore(array(array("AND","ehuserid = :ehuserid",'ehuserid',$this->user['userid']),array("AND","ehbasicid = :ehbasicid",'ehbasicid',$basicid),array("AND","ehtype = :ehtype",'ehtype',$ehtype))));
		M('tpl')->assign('ehtype',$ehtype);
		M('tpl')->assign('page',$page);
		M('tpl')->assign('exams',$exams);
		M('tpl')->assign('avgscore',$avgscore);
		M('tpl')->display('history');
	}
}


?>
