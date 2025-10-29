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
		M('module') = M('module');
		$action = M('ev')->url(3);
		$search = M('ev')->get('search');
		$u = '';
		if($search)
		{
			M('tpl')->assign('search',$search);
			foreach($search as $key => $arg)
			{
				$u .= "&search[{$key}]={$arg}";
			}
		}
		M('tpl')->assign('u',$u);
		if(!method_exists($this,$action))
		$action = "index";
		$this->$action();
		exit;
	}

	private function resetinfo()
	{
		$ehid = M('ev')->get('ehid');
		$logs = M('favor','exam')->getAllExamHistoryLogByArgs(array(array("AND","ehlehid = :ehlehid","ehlehid",$ehid)));
		M('tpl')->assign('logs',$logs);
		M('tpl')->display('users_ajax_resetinfo');
	}

	private function stats()
	{
		$search = M('ev')->get('search');
		$page = M('ev')->get('page');
		if($page < 1)$page = 1;
		M('tpl')->assign('page',$page);
		$args = array();
		$basicid = M('ev')->get('basicid');
		$type = M('ev')->get('type');
		M('tpl')->assign('type',$type);
		$args[] =  array('AND',"ehbasicid = :ehbasicid",'ehbasicid',$basicid);
		if($search['stime'])
		{
			$stime = strtotime($search['stime']);
			$args[] = array('AND',"ehstarttime >= :stime",'stime',$stime);
		}
		if($search['etime'])
		{
			$etime = strtotime($search['etime']);
			$args[] = array('AND',"ehstarttime <= :etime",'etime',$etime);
		}
		if($search['sscore'])
		{
			$args[] = array('AND',"ehscore >= :sscore",'sscore',$search['sscore']);
		}
		if($search['escore'])
		{
			$args[] = array('AND',"ehscore <= :escore",'escore',$search['escore']);
		}
		if($search['examid'])
		{
			$args[] = array('AND',"ehexamid = :ehexamid",'ehexamid',$search['examid']);
		}
		$rs = M('favor','exam')->getStatsAllExamHistoryByArgs($args);
		$number = count($rs);
		$stats = array();
		if(!$type)
		{
			$os = array('A','B','C','D','E','F','G','H');
			$questiontype = M('basic','exam')->getQuestypeList();
			foreach($rs as $p)
			{
                $p['ehquestion'] = unserialize(gzuncompress(base64_decode($p['ehquestion'])));
                $p['ehsetting'] = unserialize(gzuncompress(base64_decode($p['ehsetting'])));
				foreach($p['ehquestion']['questions'] as $questions)
				{
					foreach($questions as $key => $question)
					{
						$stats[$question['questionid']]['title'] = $question['question'];
						$stats[$question['questionid']]['id'] = $question['questionid'];
						if($p['ehscorelist'][$question['questionid']] > 0)
						$stats[$question['questionid']]['right'] = intval($stats[$question['questionid']]['right']) + 1;
						$stats[$question['questionid']]['number'] = intval($stats[$question['questionid']]['number']) + 1;
						if($p['ehuseranswer'][$question['questionid']] && $questiontype[$question['questiontype']]['questsort'] == 0 && $questiontype[$question['questiontype']]['questchoice'] < 5)
						{
							foreach($os as $o)
							{
								if(strpos($p['ehuseranswer'][$question['questionid']],$o) !== false)
								$stats[$question['questionid']][$o] = intval($stats[$question['questionid']][$o]) + 1;
							}
						}
					}
				}
				foreach($p['ehquestion']['questionrows'] as $questionrows)
				{
					foreach($questionrows as $questionrow)
					{
						foreach($questionrow['data'] as $key => $question)
						{
							if(!$key)
							{
								$stats[$question['questionid']]['title'] = $questionrow['qrquestion'].'<br />'.$question['question'];
							}
							$stats[$question['questionid']]['id'] = $question['questionid'];
							if($p['ehscorelist'][$question['questionid']] > 0)
							$stats[$question['questionid']]['right'] = intval($stats[$question['questionid']]['right']) + 1;
							$stats[$question['questionid']]['number'] = intval($stats[$question['questionid']]['number']) + 1;
							if($p['ehuseranswer'][$question['questionid']] && $questiontype[$question['questiontype']]['questsort'] == 0 && $questiontype[$question['questiontype']]['questchoice'] < 5)
							{
                                $p['ehuseranswer'][$question['questionid']] = implode("",$p['ehuseranswer'][$question['questionid']]);
                                foreach($os as $o)
								{
									if(strpos($p['ehuseranswer'][$question['questionid']],$o) !== false)
									$stats[$question['questionid']][$o] = intval($stats[$question['questionid']][$o]) + 1;
								}
							}
						}
					}
				}
			}
			ksort($stats);
			$start = $page - 1;
			$start = $start >= 0?$start:0;
			$tmp = array_slice($stats,$start * 20,20);
			$pages = M('pg')->outPage(M('pg')->getPagesNumber(count($stats),20),$page);
			M('tpl')->assign('stats',array('data' => $tmp,'pages' => $pages));
			M('tpl')->assign('basicid',$basicid);
			M('tpl')->display('users_stats');
		}
		else
		{
			foreach($rs as $p)
			{
                $p['ehquestion'] = unserialize(gzuncompress(base64_decode($p['ehquestion'])));
                $p['ehsetting'] = unserialize(gzuncompress(base64_decode($p['ehsetting'])));
				foreach($p['ehquestion']['questions'] as $questions)
				{
					foreach($questions as $key => $question)
					{
						foreach($question['questionknowsid'] as $knows)
						{
							$stats[$knows['knowsid']]['knowsid'] = $knows['knowsid'];
							$stats[$knows['knowsid']]['knows'] = $knows['knows'];
							$stats[$knows['knowsid']]['number'] = intval($stats[$knows['knowsid']]['number']) + 1;
							if($p['ehscorelist'][$question['questionid']] > 0)
							$stats[$knows['knowsid']]['right'] = intval($stats[$knows['knowsid']]['right']) + 1;
						}
					}
				}
				foreach($p['ehquestion']['questionrows'] as $questionrows)
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
								if($p['ehscorelist'][$question['questionid']] > 0)
								$stats[$knows['knowsid']]['right'] = intval($stats[$knows['knowsid']]['right']) + 1;
							}
						}
					}
				}
			}
			ksort($stats);
			$start = $page - 1;
			$start = $start >= 0?$start:0;
			$tmp = array_slice($stats,$start * 20,20);
			$pages = M('pg')->outPage(M('pg')->getPagesNumber(count($stats),20),$page);
			M('tpl')->assign('stats',array('data' => $tmp,'pages' => $pages));
			M('tpl')->assign('basicid',$basicid);
			M('tpl')->display('users_knowsstats');
		}
	}

    private function outanswer()
    {
        $search = M('ev')->get('search');
        $args = array();
        $basicid = M('ev')->get('basicid');
        if($basicid)
        {
            $fname = 'data/score/'.TIME.'-'.$basicid.'-answer.csv';
            $args[] =  array('AND',"ehbasicid = :ehbasicid",'ehbasicid',$basicid);
            $args[] =  array('AND',"ehneedresit = 0");
            $args[] = array('AND',"ehstatus = '1'");
            $args[] =  array('AND',"ehtype = 2");
            if($search['stime'])
            {
                $stime = strtotime($search['stime']);
                $args[] = array('AND',"ehstarttime >= :stime",'stime',$stime);
            }
            if($search['etime'])
            {
                $etime = strtotime($search['etime']);
                $args[] = array('AND',"ehstarttime <= :etime",'etime',$etime);
            }
            if($search['sscore'])
            {
                $args[] = array('AND',"ehscore >= :sscore",'sscore',$search['sscore']);
            }
            if($search['escore'])
            {
                $args[] = array('AND',"ehscore <= :escore",'escore',$search['escore']);
            }
            if($search['examid'])
            {
                $args[] = array('AND',"ehexamid = :ehexamid",'ehexamid',$search['examid']);
            }
            $sf = array('ehusername','useremail','usertruename','ehstarttime','ehtime','ehquestion','ehuseranswer');
            $rs = M('favor','exam')->getAllExamHistoryByArgs($args,$sf);
            $r = array();
            $index = array();
            $questions = array();
            $answers = array();
            $info = array();
            foreach($rs as $p)
            {
                $info[] = array('ehstarttime' => $p['ehstarttime'],'useremail' =>$p['useremail'],'ehusername' =>$p['ehusername'],'usertruename' => $p['usertruename'],'ehtime' => $p['ehtime']);
            	$p['ehquestion'] = unserialize(gzuncompress(base64_decode($p['ehquestion'])));
                $p['ehuseranswer'] = unserialize($p['ehuseranswer']);
                foreach($p['ehquestion']['questions'] as $fquestions)
                {
                    foreach($fquestions as $key => $question)
                    {
                    	if(!$questions[$question['questionid']])
						{

							$questions[$question['questionid']]['title'] = strip_tags(html_entity_decode($question['question']));
                            $index[] = $question['questionid'];
						}
                    }
                }
                foreach($p['ehquestion']['questionrows'] as $questionrows)
                {
                    foreach($questionrows as $questionrow)
                    {
                        foreach($questionrow['data'] as $key => $question)
                        {
                            if(!$questions[$question['questionid']])
                            {
                                $questions[$question['questionid']]['title'] = strip_tags(html_entity_decode($question['question']));
                                $index[] = $question['questionid'];
                            }
                        }
                    }
                }
                $answers[] = $p['ehuseranswer'];
            }
            $r = array();
            $tmp = array();
            $tmp[] = iconv("UTF-8","GBK",'序号');
            $tmp[] = iconv("UTF-8","GBK",'答题时间');
            $tmp[] = iconv("UTF-8","GBK",'所用时间(秒)');
            $tmp[] = iconv("UTF-8","GBK",'邮箱');
            $tmp[] = iconv("UTF-8","GBK",'用户名');
            $tmp[] = iconv("UTF-8","GBK",'姓名');
            foreach($index as $inx)
			{
                $tmp[] = iconv("UTF-8","GBK",$questions[$inx]['title']);
			}
            $r[] = $tmp;
            $i = 0;
            foreach($answers as $key => $answer)
			{
                $tmp = array();
                $tmp[] = iconv("UTF-8","GBK",++$i);
                $tmp[] = iconv("UTF-8","GBK",date('Y-m-d H:i:s',$info[$key]['ehstarttime']));
                $tmp[] = iconv("UTF-8","GBK",$info[$key]['ehtime']);
                $tmp[] = iconv("UTF-8","GBK",$info[$key]['useremail']);
                $tmp[] = iconv("UTF-8","GBK",$info[$key]['ehusername']);
                $tmp[] = iconv("UTF-8","GBK",$info[$key]['usertruename']);
                foreach($index as $inx)
                {

                	$tmp[] = iconv("UTF-8","GBK",$answer[$inx]);
                }
                $r[] = $tmp;
			}
            if($this->files->outCsv($fname,$r))
                $message = array(
                    'statusCode' => 200,
                    "message" => "导出成功，转入下载页面，如果浏览器没有相应，请<a href=\"{$fname}\">点此下载</a>",
                    "callbackType" => 'forward',
                    "forwardUrl" => "{$fname}"
                );
            else
                $message = array(
                    'statusCode' => 300,
                    "message" => "导出失败"
                );
        }
        else
            $message = array(
                'statusCode' => 300,
                "message" => "请选择好考场"
            );
        \PHPEMS\ginkgo::R($message);
    }


    private function outscore()
	{
		$appid = 'user';
		$app = M('apps','core')->getApp($appid);
		M('tpl')->assign('app',$app);
		$fields = array();
		$tpfields = explode(',',$app['appsetting']['outfields']);
		foreach($tpfields as $f)
		{
			$tf = M('module')->getFieldByNameAndModuleid($f);
			if($tf && $tf['fieldappid'] == 'user')
			{
				$fields[$tf['fieldid']] = $tf;
			}
		}

		$search = M('ev')->get('search');
		$args = array();
		$basicid = M('ev')->get('basicid');
		if($basicid)
		{
			$fname = 'data/score/'.TIME.'-'.$basicid.'-score.csv';
			$args[] =  array('AND',"ehbasicid = :ehbasicid",'ehbasicid',$basicid);
			$args[] =  array('AND',"ehneedresit = 0");
			$args[] =  array('AND',"ehtype > 0");
			if($search['ehbatch'])
			{
				$args[] = array('AND',"ehbatch = :ehbatch",'ehbatch',$search['ehbatch']);
			}
			if($search['username'])
			{
				$args[] = array('AND',"ehusername = :ehusername",'ehusername',$search['username']);
			}
			if($search['stime'])
			{
				$stime = strtotime($search['stime']);
				$args[] = array('AND',"ehstarttime >= :stime",'stime',$stime);
			}
			if($search['etime'])
			{
				$etime = strtotime($search['etime']);
				$args[] = array('AND',"ehstarttime <= :etime",'etime',$etime);
			}
			if($search['sscore'])
			{
				$args[] = array('AND',"ehscore >= :sscore",'sscore',$search['sscore']);
			}
			if($search['escore'])
			{
				$args[] = array('AND',"ehscore <= :escore",'escore',$search['escore']);
			}
			if($search['examid'])
			{
				$args[] = array('AND',"ehexamid = :ehexamid",'ehexamid',$search['examid']);
			}
			if($search['examtype'])
			{
				$args[] = array('AND',"ehtype = :ehtype",'ehtype',$search['examtype']);
			}
			$sf = array('ehusername','ehscore','ehtime','ehstarttime');
			foreach($fields as $p)
			{
				$sf[] = $p['field'];
			}
			$rs = M('favor','exam')->getAllExamHistoryByArgs($args,$sf);
			$r = array();
			foreach($rs as $p)
			{
				$tmp = array('ehusername' => iconv("UTF-8","GBK",$p['ehusername']),'ehscore' => $p['ehscore'],'ehtime' => $p['ehtime'],'ehstrattime' => date('Y-m-d H:i:s',$p['ehstarttime']));
				foreach($fields as $ps)
				{
					$tmp[$ps['field']] = iconv("UTF-8","GBK",$p[$ps['field']]);
				}
				$r[] = $tmp;
			}
			if($this->files->outCsv($fname,$r))
			$message = array(
				'statusCode' => 200,
				"message" => "成绩导出成功，转入下载页面，如果浏览器没有相应，请<a href=\"{$fname}\">点此下载</a>",
			    "callbackType" => 'forward',
			    "forwardUrl" => "{$fname}"
			);
			else
			$message = array(
				'statusCode' => 300,
				"message" => "成绩导出失败"
			);
		}
		else
		$message = array(
			'statusCode' => 300,
			"message" => "请选择好考场"
		);
		\PHPEMS\ginkgo::R($message);
	}

	private function readpaper()
	{
		$ehid = M('ev')->get('ehid');
		$eh = M('favor','exam')->getExamHistoryById($ehid);
		$questype = M('basic','exam')->getQuestypeList();
		$sessionvars = array('examsession'=>$eh['ehexam'],'examsessionscore'=>$eh['ehscore'],'examsessionscorelist'=>$eh['ehscorelist'],'examsessionsetting'=>$eh['ehsetting'],'examsessionquestion'=>$eh['ehquestion'],'examsessionuseranswer'=>$eh['ehuseranswer']);
		M('tpl')->assign('eh',$eh);
		M('tpl')->assign('user',M('user','user')->getUserById($eh['ehuserid']));
		M('tpl')->assign('sessionvars',$sessionvars);
		M('tpl')->assign('questype',$questype);
		M('tpl')->display('exam_view');
	}

	private function makescore()
	{
		$questype = M('basic','exam')->getQuestypeList();
		$ehid = M('ev')->get('ehid');
		$eh = M('favor','exam')->getExamHistoryById($ehid);
		if(M('ev')->get('makescore'))
		{
			if($eh['ehteacher'] != $this->user['username'])
			{
                $message = array(
                    'statusCode' => 300,
                    "message" => "本试卷已被{$eh['ehteacher']}锁定批改中"
                );
                \PHPEMS\ginkgo::R($message);
			}
			$score = M('ev')->get('score');
			$sumscore = 0;
			if(is_array($score))
			{
				foreach($score as $key => $p)
				{
                    $eh['ehscorelist'][$key] = $p;
				}
			}
			foreach($eh['ehscorelist'] as $p)
			{
				$sumscore = $sumscore + floatval($p);
			}
            $eh['ehscore'] = $sumscore;
			$args['ehscorelist'] = $eh['ehscorelist'];
			$args['ehscore'] = $eh['ehscore'];
			$args['ehstatus'] = 1;
			if($eh['ehscore'] >= $eh['ehsetting']['examsetting']['passscore'])$args['ehispass'] = 1;
			M('favor','exam')->modifyExamHistory($ehid,$args);
			M('favor','exam')->addExamHistoryLog(array('ehlehid'=>$ehid,'ehluserid'=>$this->user['userid'],'ehltype'=>1,'ehlinfo'=>'完成评卷'));
			$message = array(
				'statusCode' => 200,
				"message" => "评分完成",
				"callbackType" => 'forward',
			    "forwardUrl" => "index.php?exam-teach-users-exams&basicid=".$eh['ehbasicid']
			);
			\PHPEMS\ginkgo::R($message);
		}
	}

	private function score()
	{
		$ehid = M('ev')->get('ehid');
		$sessionvars = M('favor','exam')->getExamHistoryById($ehid);
		if(!$sessionvars['ehstatus'] && !$sessionvars['ehteacher'])
		{
            $args = array();
            $sessionvars['ehteacher'] = $args['ehteacher'] = $this->user['username'];
            $sessionvars['ehdecidetime'] = $args['ehdecidetime'] = TIME;
			M('favor','exam')->modifyExamHistory($ehid,$args);
		}
		$questype = M('basic','exam')->getQuestypeList();
		M('tpl')->assign('ehid',$ehid);
		M('tpl')->assign('sessionvars',$sessionvars);
		M('tpl')->assign('questype',$questype);
		M('tpl')->display('users_decide');
	}

	private function scorelist()
	{
		$appid = 'user';
		$app = M('apps','core')->getApp($appid);
		M('tpl')->assign('app',$app);
		$fields = array();
		$tpfields = explode(',',$app['appsetting']['outfields']);
		foreach($tpfields as $f)
		{
			$tf = M('module')->getFieldByNameAndModuleid($f);
			if($tf && $tf['fieldappid'] == 'user')
			{
				$fields[$tf['fieldid']] = $tf;
			}
		}
		$page = M('ev')->get('page');
		$search = M('ev')->get('search');
		$basicid = intval(M('ev')->get('basicid'));
		$basic = M('basic','exam')->getBasicById($basicid);
		$page = $page > 0?$page:1;
		$args = array();
		$args[] =  array('AND',"ehtype > 0");
		$args[] = array('AND',"ehstatus = '1'");
		$args[] = array('AND',"ehbasicid = :ehbasicid",'ehbasicid',$basicid);
		if($search['ehbatch'])
		{
			$args[] = array('AND',"ehbatch = :ehbatch",'ehbatch',$search['ehbatch']);
		}
		if($search['username'])
		{
			$args[] = array('AND',"ehusername = :ehusername",'ehusername',$search['username']);
		}
		if($search['stime'])
		{
			$stime = strtotime($search['stime']);
			$args[] = array('AND',"ehstarttime >= :stime",'stime',$stime);
		}
		if($search['etime'])
		{
			$etime = strtotime($search['etime']);
			$args[] = array('AND',"ehstarttime <= :etime",'etime',$etime);
		}
		if($search['sscore'])
		{
			$args[] = array('AND',"ehscore >= :sscore",'sscore',$search['sscore']);
		}
		if($search['escore'])
		{
			$args[] = array('AND',"ehscore <= :escore",'escore',$search['escore']);
		}
		if($search['examid'])
		{
			$args[] = array('AND',"ehexamid = :ehexamid",'ehexamid',$search['examid']);
		}
		if($search['examtype'])
		{
			$args[] = array('AND',"ehtype = :ehtype",'ehtype',$search['examtype']);
		}
		if($search['order'])$order = null;
		else $order = "ehid desc";
		$exams = M('favor','exam')->getExamHistoryListByArgs($args,$page,30,false,$order);
		$ids = trim($basic['basicexam']['self'],', ');
		if(!$ids)$ids = '0';
		$exampaper = M('exam','exam')->getExamSettingsByArgs(array(array("AND","find_in_set(examid,:examid)",'examid',$ids)));
		M('tpl')->assign('basicid',$basicid);
		M('tpl')->assign('search',$search);
		M('tpl')->assign('basic',$basic);
		M('tpl')->assign('page',$page);
		M('tpl')->assign('fields',$fields);
		M('tpl')->assign('exampaper',$exampaper);
		M('tpl')->assign('exams',$exams);
		M('tpl')->display('users_scorelist');
	}

	private function setresit()
	{
		$ehid = M('ev')->get('ehid');
		M('favor','exam')->modifyExamHistory($ehid,array('ehneedresit' => 1));
		M('favor','exam')->addExamHistoryLog(array('ehlehid'=>$ehid,'ehluserid'=>$this->user['userid'],'ehltype'=>3,'ehlinfo'=>'要求补考'));
		$message = array(
			'statusCode' => 200,
			"message" => "设置成功",
			"callbackType" => 'forward',
		    "forwardUrl" => "reload"
		);
		\PHPEMS\ginkgo::R($message);
	}

	private function exams()
	{
		$page = M('ev')->get('page');
		$basicid = intval(M('ev')->get('basicid'));
		$page = $page > 0?$page:1;
		$args = array(array('AND',"ehstatus = '0'"),array('AND',"ehtype = 2"),array('AND',"ehbasicid = :ehbasicid",'ehbasicid',$basicid));
		$exams = M('favor','exam')->getExamHistoryListByArgs($args,$page,10,false,'ehid desc');
		M('tpl')->assign('page',$page);
		M('tpl')->assign('exams',$exams);
		M('tpl')->display('users_history');
	}

	private function index()
	{
		$page = M('ev')->get('page');
		$search = M('ev')->get('search');
		$page = $page > 1?$page:1;
		$subjects = M('basic','exam')->getSubjectList(array(array('AND',"find_in_set(subjectid,:subjectid)",'subjectid',$this->teachsubjects)));
		$args = array(array('AND',"find_in_set(basicsubjectid,:basicsubjectid)",'basicsubjectid',$this->teachsubjects));
		if($search['basicid'])$args[] = array('AND',"basicid = :basicid",'basicid',$search['basicid']);
		else
		{
			if($search['keyword'])$args[] = array('AND',"basic LIKE :basic",'basic',"%{$search['keyword']}%");
			if($search['basicareaid'])$args[] = array('AND',"basicareaid = :basicareaid",'basicareaid',$search['basicareaid']);
			if($search['basicsubjectid'])$args[] = array('AND',"basicsubjectid = :basicsubjectid",'basicsubjectid',$search['basicsubjectid']);
			if($search['basicapi'])$args[] = array('AND',"basicapi = :basicapi",'basicapi',$search['basicapi']);
		}
		$basics = M('basic','exam')->getBasicList($args,$page,10);
		$areas = M('area','exam')->getAreaList();
		M('tpl')->assign('areas',$areas);
		M('tpl')->assign('subjects',$subjects);
		M('tpl')->assign('basics',$basics);
		M('tpl')->display('users_basic');
	}
}


?>
