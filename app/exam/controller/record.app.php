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

    private function ajax()
    {
        switch(M('ev')->url(4))
        {
            //删除一个错题
            case 'delrecord':
                $recordid = M('ev')->get('recordid');
                M('favor','exam')->delRecord($recordid);
                $message = array(
                    'statusCode' => 200,
                    "message" => "操作成功",
                    "callbackType" => 'forward',
                    "forwardUrl" => "reload"
                );
                \PHPEMS\ginkgo::R($message);
                break;

            default:
                break;
        }
    }

    private function selectquestions()
    {
        if(!M('ev')->get('setExecriseConfig'))
        {
            $message = array(
                'statusCode' => 300,
                "message" => "非法操作！"
            );
            \PHPEMS\ginkgo::R($message);
        }
        M('exam','exam')->delExamSession();
        $args = M('ev')->get('args');
        $sessionvars = M('exam','exam')->getExamSessionBySessionid();
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
        $data = M('favor','exam')->getRecordDataByUseridAndSubjectid($this->user['userid'],$this->data['currentbasic']['basicsubjectid']);
        $questionids = M('question','exam')->selectRecords($args['number'],$data['rddata'],$this->data['currentbasic']['basicknows']);
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
                $questions[$key] = M('exam','exam')->getQuestionListByIds($ids);
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
                        $questionrows[$key][$t] = M('exam','exam')->getQuestionRowsById($t);
                    }
                }
            }
            else $questionrows[$key][$p] = M('exam','exam')->getQuestionRowsByArgs("qrid = '{$p}'");
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
        $sargs['examsessionkey'] = $args['knowsid'];
        $sargs['examsessionissave'] = 0;
        $sargs['examsessionsign'] = NULL;
        $sargs['examsessionsign'] = '';
        $sargs['examsessionuserid'] = $this->user['userid'];
        $sargs['examsessiontoken'] = uniqid();
        $sargs['examsessionid'] = md5(serialize($sargs));
        $token = md5($sargs['examsessionid'].'-'.$this->user['userid'].'-'.$sargs['examsessiontoken']);
        M('exam','exam')->insertExamSession($sargs);
        $message = array(
            'statusCode' => 200,
            "message" => "抽题完毕，转入试卷页面",
            "callbackType" => 'forward',
            "forwardUrl" => "index.php?exam-app-exercise-paper&sessionid={$sargs['examsessionid']}&token={$token}"
        );
        \PHPEMS\ginkgo::R($message);
    }

    private function papers()
    {
        $data = M('favor','exam')->getRecordDataByUseridAndSubjectid($this->user['userid'],$this->data['currentbasic']['basicsubjectid']);
        $tmp = array();
        foreach($this->data['currentbasic']['basicknows'] as $ps)
        {
            foreach($ps as $p)
            {
                if($data['rddata'][$p])
                {
                    foreach($data['rddata'][$p] as $key => $qs)
                    {
                        foreach($qs['question'] as $qid)
                        {
                            $tmp[$key]['question'][] = $qid;
                        }
                        foreach($qs['questionrows'] as $qrid)
                        {
                            $tmp[$key]['questionrows'][] = $qrid;
                        }
                    }
                }
            }
        }
		$questype = M('basic','exam')->getQuestypeList();
        foreach ($questype as $key => $type)
        {
            $number = 0;
            if(is_array($tmp[$key]['questionrows']) && count($tmp[$key]['questionrows']))
            {
                $number += M('exam','exam')->getQuestionrowsSumNumber($tmp[$key]['questionrows']);
            }
            if(is_array($tmp[$key]['question']))$number += count($tmp[$key]['question']);
            $questype[$key]['number'] = $number;
        }
        M('tpl')->assign('questype',$questype);
        M('tpl')->display('record_papers');
    }

    private function index()
	{
		$page = M('ev')->get('page');
		$page = $page > 0?$page:1;
        $args = array();
        $args[] = array("AND","recorduserid = :recorduserid","recorduserid",$this->user['userid']);
        $args[] = array("AND","recordsubjectid = :recordsubjectid","recordsubjectid",$this->data['currentbasic']['basicsubjectid']);
        $args[] = array("AND","recordquestionid = questionid");
        $args[] = array("AND","questionstatus = 1");
        $questions = M('favor','exam')->getRecordList($args,$page);
        $parents = array();
        foreach($questions['data'] as $question)
        {
            if($question['questionparent'])
            {
                if(!$parents[$question['questionparent']])
                {
                    $parents[$question['questionparent']] = M('exam','exam')->getQuestionRowsById($question['questionparent'],false,false);
                }
            }
        }
		$questype = M('basic','exam')->getQuestypeList();
        M('tpl')->assign('parents',$parents);
		M('tpl')->assign('questype',$questype);
		M('tpl')->assign('page',$page);
		M('tpl')->assign('questions',$questions);
		M('tpl')->display('record');
	}
}


?>
