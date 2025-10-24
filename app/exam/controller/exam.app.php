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
        if($this->data['currentbasic']['basicexam']['model'] != 2)
		{
            header("location:index.php?exam-app-lesson");
            exit;
		}
		$intime = 0;
        if($this->data['currentbasic']['basicexam']['opentime']['start'] || $this->data['currentbasic']['basicexam']['opentime']['end'])
		{
			if($this->data['currentbasic']['basicexam']['opentime']['start'] < TIME)
			{
				if($this->data['currentbasic']['basicexam']['opentime']['end'])
				{
					if($this->data['currentbasic']['basicexam']['opentime']['end'] > TIME)
					{
                        $intime = 1;
					}
				}
				else
				{
                    $intime = 1;
				}
			}
		}
		else
		{
            $intime = 1;
		}
        $this->tpl->assign('intime',$intime);
        if(!method_exists($this,$action))
		{
			$action = "index";
		}
		$this->$action();
		exit;
	}

	private function history()
	{
        $page = $this->ev->get('page');
        $ehtype = 2;
        $page = $page > 0?$page:1;
        $basicid = $this->data['currentbasic']['basicid'];
        $args = array(
            array("AND","ehuserid = :ehuserid",'ehuserid',$this->_user['sessionuserid']),
            array("AND","ehbasicid = :ehbasicid",'ehbasicid',$basicid),
            array("AND","ehtype = :ehtype",'ehtype',$ehtype)
        );
        $exams = $this->favor->getExamHistoryListByArgs($args,$page,10,false,'ehid desc');
		$this->tpl->assign('exams',$exams);
        $this->tpl->display('exam_history');
	}

    private function score()
    {
        if($this->data['currentbasic']['basicexam']['opentime']['end'])
		{
			if($this->data['currentbasic']['basicexam']['opentime']['end'] < TIME)
			{
                $message = array(
                    'statusCode' => 300,
                    "message" => "考场已关闭，不能交卷"
                );
                \PHPEMS\ginkgo::R($message);
			}
		}
    	$questype = $this->basic->getQuestypeList();
        if($this->ev->get('insertscore'))
        {
			$sessionid = $this->ev->get('sessionid');
			$token = $this->ev->get('token');
        	$sessionvars = $this->exam->getExamSessionBySessionid($sessionid);
            if($this->data['currentbasic']['basicexam']['examnumber'])
            {
                $overflow = false;
                $ids = trim($this->data['currentbasic']['basicexam']['self'],', ');
                if(!$ids)$ids = '0';
                $number = array();
                if($ids)
                {
                    $ids = explode(',',$ids);
                    foreach($ids as $t)
                    {
                        $num = $this->favor->getExamUseNumber($this->_user['sessionuserid'],$t,$this->data['currentbasic']['basicid'],$this->data['currentbasic']['basicexam']['batch']);
                        $number['child'][$t] = $num;
                        $number['all'] = intval($number['all'])+$num;
                    }
                }
                if($this->data['currentbasic']['basicexam']['selectrule'])
                {
                    if($number['all'] >= $this->data['currentbasic']['basicexam']['examnumber'])
                    {
                        $overflow = true;
                    }
                }
                else
                {
                    if($number['child'][$sessionvars['examsessionkey']] >= $this->data['currentbasic']['basicexam']['examnumber'])
                    {
                        $overflow = true;
                    }
                }
                if($overflow)
                {
                    $message = array(
                        'statusCode' => 300,
                        "message" => "您的考试次数已经用完了！"
                    );
                    \PHPEMS\ginkgo::R($message);
                }
            }
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
            $result = $this->exam->markscore($sessionvars,$questype,$this->data['currentbasic']['basicexam']['batch']);
            if($result['wrongids'] && $this->setting['autorecord'])
			{
				$this->favor->addRecords($this->_user['sessionuserid'],$result['wrongids'],$this->data['currentbasic']['basicsubjectid']);
			}
            if($result['needhand'] && !$sessionvars['examsessionsetting']['examdecide'])
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
            header("location:index.php?exam-app-exam");
            exit;
        }
        $lefttime = 0;
        $questype = $this->basic->getQuestypeList();
		$this->tpl->assign('questype',$questype);
		$this->tpl->assign('sessionvars',$sessionvars);
		$this->tpl->assign('token',$token);
		$this->tpl->assign('lefttime',$lefttime);
		$this->tpl->assign('donumber',is_array($sessionvars['examsessionuseranswer'])?count($sessionvars['examsessionuseranswer']):0);
		if($this->data['currentbasic']['basicexam']['selftemplate'])
		{
			$this->tpl->display($this->data['currentbasic']['basicexam']['selftemplate']);
		}
		else
		{
			$this->tpl->display('exam_paper');
		}
	}

	private function selectquestions()
	{
		if($this->data['currentbasic']['basicexam']['unjointime'] && $this->data['currentbasic']['basicexam']['opentime']['start'])
		{
			if((TIME - $this->data['currentbasic']['basicexam']['opentime']['start']) > $this->data['currentbasic']['basicexam']['unjointime'] * 60)
			{
				$message = array(
					'statusCode' => 300,
					"message" => "开考超过{$this->data['currentbasic']['basicexam']['unjointime']}分钟，禁止考试！"
				);
				\PHPEMS\ginkgo::R($message);
			}
		}
		if($this->data['currentbasic']['basicexam']['faceverify'])
		{
			$photo = $this->ev->get('photo');
			$user = $this->user->getUserById($this->_user['sessionuserid']);
			if($user['userstatus'] != 3)
			{
				$message = array(
					'statusCode' => 300,
					"message" => "您没有通过实名认证"
				);
				ginkgo::R($message);
			}
			elseif(!file_exists($user['userphoto']))
			{
				$message = array(
					'statusCode' => 300,
					"message" => "您没有上传对比照片"
				);
				ginkgo::R($message);
			}
			else
			{
				$userphoto = M('files')->base64Img($user['userphoto'],false);
				if(!$userphoto)
				{
					$message = array(
						'statusCode' => 300,
						"message" => "您没有上传照片"
					);
					ginkgo::R($message);
				}
				$photo = explode('base64,',$photo,2);
				$photo = $photo[1];
				$data = array(
					'img1' => $userphoto,
					'img2' => $photo
				);
				$this->face = M('face');
				$score = $this->face->face($data);
				if(!$score)
				{
					$message = array(
						'statusCode' => 300,
						"message" => "人脸对比不符，请重新验证"
					);
					ginkgo::R($message);
				}
			}
		}
		if($this->data['currentbasic']['basicexam']['selectrule'])
		{
			$ids = explode(',',trim($this->data['currentbasic']['basicexam']['self'],', '));
			$p = rand(0,count($ids)-1);
			$examid = $ids[$p];
		}
		else
		$examid = $this->ev->get('examid');
		$r = $this->exam->getExamSettingById($examid);
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
            if($this->data['currentbasic']['basicexam']['examnumber'])
            {
                $overflow = false;
                $ids = trim($this->data['currentbasic']['basicexam']['self'],', ');
                if(!$ids)$ids = '0';
                $number = array();
                if($ids)
                {
                    $ids = explode(',',$ids);
                    foreach($ids as $t)
                    {
                        $num = $this->favor->getExamUseNumber($this->_user['sessionuserid'],$t,$this->data['currentbasic']['basicid'],$this->data['currentbasic']['basicexam']['batch']);
                        $number['child'][$t] = $num;
                        $number['all'] = intval($number['all'])+$num;
                    }
                }
                if($this->data['currentbasic']['basicexam']['selectrule'])
                {
                    if($number['all'] >= $this->data['currentbasic']['basicexam']['examnumber'])
                    {
                        $overflow = true;
                    }
                }
                else
                {
                    if($number['child'][$r['examid']] >= $this->data['currentbasic']['basicexam']['examnumber'])
                    {
                        $overflow = true;
                    }
                }
                if($overflow)
                {
                    $message = array(
                        'statusCode' => 300,
                        "message" => "您的考试次数已经用完了！"
                    );
                    \PHPEMS\ginkgo::R($message);
                }
            }
			if($this->data['currentbasic']['basicexam']['opentime']['end'] && $this->data['currentbasic']['basicexam']['opentime']['end'] <= (TIME + 300 + $r['examsetting']['examtime'] * 60) )
			{
				$examtime = intval(($this->data['currentbasic']['basicexam']['opentime']['end'] - 300 - TIME)/60);
			}
			elseif($r['examsetting']['examtime'])
			{
				$examtime = $r['examsetting']['examtime'];
			}
			else $examtime = 60;
			if($r['examtype'] == 1)
			{
				$questionids = $this->question->selectQuestions($examid,$this->data['currentbasic']);
				$questions = array();
				$questionrows = array();
				foreach($questionids['question'] as $key => $p)
				{
                    $questions[$key] = $this->exam->getQuestionListByIds($p);
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
					else $questionrows[$key][$p] = $this->exam->getQuestionRowsById($p);
				}
				$sargs['examsessionquestion'] = array('questionids'=>$questionids,'questions'=>$questions,'questionrows'=>$questionrows);
				$sargs['examsessionsetting'] = $r;
				$sargs['examsessionstarttime'] = TIME;
				$sargs['examsession'] = $r['exam'];
				$sargs['examsessiontime'] = $examtime;
				$sargs['examsessionstatus'] = 0;
				$sargs['examsessiontype'] = 2;
				$sargs['examsessionsign'] = '';
				$sargs['examsessionuseranswer'] = '';
				$sargs['examsessionbasic'] = $this->data['currentbasic']['basicid'];
				$sargs['examsessionkey'] = $examid;
				$sargs['examsessionissave'] = 0;
				$sargs['examsessionsign'] = '';
				$sargs['examsessionuserid'] = $this->_user['sessionuserid'];
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
					$questions[$key] = $this->exam->getQuestionListByIds($qids);
					if($p['rowsquestions'])$qrids = trim($p['rowsquestions']," ,");
					if($qrids)
					{
						$qrids = explode(",",$qrids);
						foreach($qrids as $t)
						{
							$qr = $this->exam->getQuestionRowsById($t);
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
				$args['examsessionuseranswer'] = '';
				$args['examsessionscorelist'] = '';
				$args['examsessionsign'] = '';
				$args['examsessiontime'] = $examtime;
				$args['examsessionstatus'] = 0;
				$args['examsessiontype'] = 2;
				$args['examsessionkey'] = $r['examid'];
				$args['examsessionissave'] = 0;
				$args['examsessionbasic'] = $this->data['currentbasic']['basicid'];
				$args['examsessionuserid'] = $this->_user['sessionuserid'];
				$sargs = $args;
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
				$args['examsessiontime'] = $examtime;
				$args['examsessionstatus'] = 0;
				$args['examsessiontype'] = 2;
				$args['examsessionkey'] = $r['examid'];
				$args['examsessionissave'] = 0;
				$args['examsessionbasic'] = $this->data['currentbasic']['basicid'];
				$args['examsessionuserid'] = $this->_user['sessionuserid'];
				$sargs = $args;
			}
			$sargs['examsessiontoken'] = uniqid();
			$sargs['examsessionid'] = md5(serialize($sargs));
			$token = md5($sargs['examsessionid'].'-'.$this->_user['sessionuserid'].'-'.$sargs['examsessiontoken']);
			$this->exam->insertExamSession($sargs);
			$message = array(
				'statusCode' => 200,
				"message" => "抽题完毕，转入试卷页面",
				"callbackType" => 'forward',
				"forwardUrl" => "index.php?exam-app-exam-paper&sessionid={$sargs['examsessionid']}&token={$token}"
			);
			\PHPEMS\ginkgo::R($message);
		}
	}

	public function index()
	{
		$page = $this->ev->get('page');
		$ids = trim($this->data['currentbasic']['basicexam']['self'],', ');
		if(!$ids)$ids = '0';
		$exams = $this->exam->getExamSettingList(array(array("AND","find_in_set(examid,:examid)",'examid',$ids)),$page,20);
        $sessionvars = $this->exam->getExamSessionByUserid($this->_user['sessionuserid'],$this->data['currentbasic']['basicid']);
        if($sessionvars)
        {
			$token = md5($sessionvars['examsessionid'].'-'.$this->_user['sessionuserid'].'-'.$sessionvars['examsessiontoken']);
        	$this->tpl->assign('sessionvars',$sessionvars);
			$this->tpl->assign('token',$token);
        }
        $number = array();
        if($ids)
        {
            $ids = explode(',',$ids);
            foreach($ids as $t)
            {
                $num = $this->favor->getExamUseNumber($this->_user['sessionuserid'],$t,$this->data['currentbasic']['basicid'],$this->data['currentbasic']['basicexam']['batch']);
                $number['child'][$t] = $num;
                $number['all'] = intval($number['all'])+$num;
            }
        }
        $this->tpl->assign('number',$number);
        $this->tpl->assign('exams',$exams);
		$this->tpl->display('exam');
	}
}


?>
