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
		$this->search = M('ev')->get('search');
		if($this->search)
		{
			M('tpl')->assign('search',$this->search);
			$this->u = '';
			foreach($this->search as $key => $arg)
			{
				$this->u .= "&search[{$key}]={$arg}";
			}
			M('tpl')->assign('u',$this->u);
		}
		$groups = M('user','user')->getUserGroups();
		M('tpl')->assign('groups',$groups);
		if(!method_exists($this,$action))
		$action = "index";
		$this->$action();
		exit;
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

	private function resetinfo()
	{
		$ehid = M('ev')->get('ehid');
		$logs = M('favor','exam')->getAllExamHistoryLogByArgs(array(array("AND","ehlehid = :ehlehid","ehlehid",$ehid)));
		M('tpl')->assign('logs',$logs);
		M('tpl')->display('users_ajax_resetinfo');
	}

	private function resetexamhistroy()
	{
		$ehid = M('ev')->get('ehid');
		$history = M('favor','exam')->getExamHistoryById($ehid);
		M('tpl')->assign('history',$history);
		M('tpl')->display('history_ajax_reset');
	}

	private function resetstatus()
	{
		$ehid = M('ev')->get('ehid');
		$resetinfo = M('ev')->get('resetinfo');
		M('favor','exam')->addExamHistoryLog(array('ehlehid'=>$ehid,'ehluserid'=>$this->user['userid'],'ehltype'=>2,'ehlinfo'=>$resetinfo));
		M('favor','exam')->modifyExamHistory($ehid,array('ehstatus'=>0));
		$message = array(
			'statusCode' => 200,
			"message" => "操作成功",
			"callbackType" => 'forward',
			"forwardUrl" => "reload"
		);
		\PHPEMS\ginkgo::R($message);
	}

	private function orderpoint()
	{
		$delids = M('ev')->get('delids');
		foreach($delids as $knowsid => $v)
		{
			M('section','exam')->modifyKnows($knowsid,array('knowssequence' => $v));
		}
        $message = array(
            'statusCode' => 200,
            "message" => "操作成功",
            "callbackType" => 'forward',
            "forwardUrl" => "reload"
        );
		\PHPEMS\ginkgo::R($message);
	}

    private function ordersection()
    {
        $delids = M('ev')->get('delids');
        foreach($delids as $sectionid => $v)
        {
            M('section','exam')->modifySection($sectionid,array('sectionsequence' => $v));
        }
        $message = array(
            'statusCode' => 200,
            "message" => "操作成功",
            "callbackType" => 'forward',
            "forwardUrl" => "reload"
        );
        \PHPEMS\ginkgo::R($message);
    }

    private function historyquestionbyuser()
    {
        $this->search = M('ev')->get('search');
        $page = M('ev')->get('page');
        if($page < 1)$page = 1;
        M('tpl')->assign('page',$page);
        $args = array();
        $basicid = M('ev')->get('basicid');
        $args[] =  array('AND',"ehbasicid = :ehbasicid",'ehbasicid',$basicid);
		$args[] = array('AND',"ehstatus = 1");
		$args[] = array('AND',"ehtype = 2");
        if($this->search['stime'])
        {
            $stime = strtotime($this->search['stime']);
            $args[] = array('AND',"ehstarttime >= :stime",'stime',$stime);
        }
        if($this->search['etime'])
        {
            $etime = strtotime($this->search['etime']);
            $args[] = array('AND',"ehstarttime <= :etime",'etime',$etime);
        }
        if($this->search['sscore'])
        {
            $args[] = array('AND',"ehscore >= :sscore",'sscore',$this->search['sscore']);
        }
        if($this->search['escore'])
        {
            $args[] = array('AND',"ehscore <= :escore",'escore',$this->search['escore']);
        }
        if($this->search['examid'])
        {
            $args[] = array('AND',"ehexamid = :ehexamid",'ehexamid',$this->search['examid']);
        }
        $rs = M('favor','exam')->getStatsAllExamHistoryByArgs($args);
        $number = count($rs);
        $basic = M('basic','exam')->getBasicById($basicid);
        M('tpl')->assign('basic',$basic);
        $stats = array();

        $questionid = M('ev')->get('questionid');
        M('tpl')->assign('questionid',$questionid);
        $questiontype = M('basic','exam')->getQuestypeList();
        $member = array();
        foreach($rs as $p)
        {
            if(isset($p['ehscorelist'][$questionid]))
            {
                if($p['ehscorelist'][$questionid] > 0)
                {
                    $member['right'][] = array('id' => $p['ehid'],'userid' => $p['ehuserid'],'username' => $p['ehusername']);
                }
                else
                    $member['wrong'][] = array('id' => $p['ehid'],'userid' => $p['ehuserid'],'username' => $p['ehusername']);
            }
        }
        M('tpl')->assign('member',$member);
        M('tpl')->assign('basicid',$basicid);
        M('tpl')->display('basic_uqstats');
    }

	private function stats()
	{
		$this->search = M('ev')->get('search');
		$page = M('ev')->get('page');
		if($page < 1)$page = 1;
		M('tpl')->assign('page',$page);
		$args = array();
		$basicid = M('ev')->get('basicid');
		$type = M('ev')->get('type');
		M('tpl')->assign('type',$type);
		$args[] =  array('AND',"ehbasicid = :ehbasicid",'ehbasicid',$basicid);
		$args[] = array('AND',"ehstatus = 1");
		$args[] = array('AND',"ehtype = 2");
		if($this->search['stime'])
		{
			$stime = strtotime($this->search['stime']);
			$args[] = array('AND',"ehstarttime >= :stime",'stime',$stime);
		}
		if($this->search['etime'])
		{
			$etime = strtotime($this->search['etime']);
			$args[] = array('AND',"ehstarttime <= :etime",'etime',$etime);
		}
		if($this->search['sscore'])
		{
			$args[] = array('AND',"ehscore >= :sscore",'sscore',$this->search['sscore']);
		}
		if($this->search['escore'])
		{
			$args[] = array('AND',"ehscore <= :escore",'escore',$this->search['escore']);
		}
		if($this->search['examid'])
		{
			$args[] = array('AND',"ehexamid = :ehexamid",'ehexamid',$this->search['examid']);
		}
		if($this->search['ehbatch'])
		{
			$args[] = array('AND',"ehbatch = :ehbatch",'ehbatch',$this->search['ehbatch']);
		}
		$rs = M('favor','exam')->getStatsAllExamHistoryByArgs($args);
		$number = count($rs);
		$basic = M('basic','exam')->getBasicById($basicid);
		$questypes = M('basic','exam')->getQuestypeList();
		M('tpl')->assign('questypes',$questypes);
		M('tpl')->assign('basic',$basic);
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
						$stats[$question['questionid']]['type'] = $question['questiontype'];
						$stats[$question['questionid']]['id'] = $question['questionid'];
						if($p['ehscorelist'][$question['questionid']] > 0)
						$stats[$question['questionid']]['right'] = intval($stats[$question['questionid']]['right']) + 1;
						$stats[$question['questionid']]['number'] = intval($stats[$question['questionid']]['number']) + 1;
						if($p['ehuseranswer'][$question['questionid']] && $questiontype[$question['questiontype']]['questsort'] == 0 && $questiontype[$question['questiontype']]['questchoice'] < 5)
						{
                            if(is_array($p['ehuseranswer'][$question['questionid']]))
						    $p['ehuseranswer'][$question['questionid']] = implode("",$p['ehuseranswer'][$question['questionid']]);
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
							$stats[$question['questionid']]['title'] = $questionrow['qrquestion'].'<br />'.$question['question'];
							$stats[$question['questionid']]['id'] = $question['questionid'];
							$stats[$question['questionid']]['type'] = $question['questiontype'];
							if($p['ehscorelist'][$question['questionid']] > 0)
							{
								$stats[$question['questionid']]['right'] = intval($stats[$question['questionid']]['right']) + 1;
							}
							$stats[$question['questionid']]['number'] = intval($stats[$question['questionid']]['number']) + 1;
							if($p['ehuseranswer'][$question['questionid']] && $questiontype[$question['questiontype']]['questsort'] == 0 && $questiontype[$question['questiontype']]['questchoice'] < 5)
							{
                                if(is_array($p['ehuseranswer'][$question['questionid']]))
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
			M('tpl')->display('basic_stats');
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
			M('tpl')->display('basic_knowsstats');
		}
	}

	public function userimage()
	{
		$this->userid = M('ev')->get('userid');
		$basicid = M('ev')->get('basicid');
		$args = array();
		$args[] =  array('AND',"ehbasicid = :ehbasicid",'ehbasicid',$basicid);
		$args[] = array('AND',"ehuserid = :ehuserid",'ehuserid',$this->userid);
		$args[] = array('AND',"ehstatus = 1");
		$args[] = array('AND',"ehtype = 2");
		$rs = M('favor','exam')->getExamHistoryListByArgs($args,1,20,false,"ehid desc");
		$charts = array();
		foreach($rs['data'] as $r)
		{
			$charts['time'][] = date('Y-m-d H:i',$r['ehstarttime']);
			$charts['score'][] = $r['ehscore'];
		}
		$charts['time'] = array_reverse($charts['time']);
		$charts['score'] = array_reverse($charts['score']);
		$avg = array_sum($charts['score'])/count($charts['score']);
		$questypes = M('basic','exam')->getQuestypeList();
		$number = array();
		$right = array();
		$score = array();
		$allscore = array();
		$stats = array();
		foreach($questypes as $key => $q)
		{
			$number[$key] = 0;
			$right[$key] = 0;
			$score[$key] = 0;
			foreach($rs['data'] as $sessionvars)
			{
				$sessionvars['ehquestion'] = unserialize(gzuncompress(base64_decode($sessionvars['ehquestion'])));
				$sessionvars['ehsetting'] = unserialize(gzuncompress(base64_decode($sessionvars['ehsetting'])));
				$sessionvars['ehscorelist'] = unserialize($sessionvars['ehscorelist']);
				if ($sessionvars['ehquestion']['questions'][$key])
				{
					foreach ($sessionvars['ehquestion']['questions'][$key] as $p)
					{
						$number[$key]++;
						if ($sessionvars['ehsetting']['examsetting']['scores'])
						{
							if ($sessionvars['ehscorelist'][$p['questionid']] == $sessionvars['ehsetting']['examsetting']['scores'][$p['questionid']])
							{
								$right[$key]++;
							}
							$allscore[$key] += $sessionvars['ehsetting']['examsetting']['scores'];
						}
						else
						{
							if ($sessionvars['ehscorelist'][$p['questionid']] == $sessionvars['ehsetting']['examsetting']['questype'][$key]['score'])
							{
								$right[$key]++;
							}
							$allscore[$key] += $sessionvars['ehsetting']['examsetting']['questype'][$key]['score'];
						}
						$score[$key] = $score[$key] + $sessionvars['ehscorelist'][$p['questionid']];
						foreach ($p['questionknowsid'] as $knows)
						{
							$stats[$knows['knowsid']]['knowsid'] = $knows['knowsid'];
							$stats[$knows['knowsid']]['knows'] = $knows['knows'];
							$stats[$knows['knowsid']]['number'] = intval($stats[$knows['knowsid']]['number']) + 1;
							if ($sessionvars['ehscorelist'][$p['questionid']] > 0)
							{
								$stats[$knows['knowsid']]['right'] = intval($stats[$knows['knowsid']]['right']) + 1;
							}
						}
					}
				}
				if ($sessionvars['ehquestion']['questionrows'][$key])
				{
					foreach ($sessionvars['ehquestion']['questionrows'][$key] as $v)
					{
						foreach ($v['data'] as $p)
						{
							$number[$key]++;
							if ($sessionvars['ehsetting']['examsetting']['scores'])
							{
								if ($sessionvars['ehscorelist'][$p['questionid']] == $sessionvars['ehsetting']['examsetting']['scores'][$p['questionid']])
								{
									$right[$key]++;
								}
							}
							else
							{
								if ($sessionvars['ehscorelist'][$p['questionid']] == $sessionvars['ehsetting']['examsetting']['questype'][$key]['score'])
								{
									$right[$key]++;
								}
							}
							$score[$key] = $score[$key] + $sessionvars['ehscorelist'][$p['questionid']];
							foreach ($v['qrknowsid'] as $knows)
							{
								$stats[$knows['knowsid']]['knowsid'] = $knows['knowsid'];
								$stats[$knows['knowsid']]['knows'] = $knows['knows'];
								$stats[$knows['knowsid']]['number'] = intval($stats[$knows['knowsid']]['number']) + 1;
								if ($sessionvars['ehscorelist'][$p['questionid']] > 0)
								{
									$stats[$knows['knowsid']]['right'] = intval($stats[$knows['knowsid']]['right']) + 1;
								}
							}
						}
					}
				}
			}
		}
		M('tpl')->assign('avg',$avg);
		M('tpl')->assign('charts',$charts);
		M('tpl')->assign('rs',$rs);
		M('tpl')->assign('questypes',$questypes);
		M('tpl')->assign('stats',$stats);
		M('tpl')->assign('number',$number);
		M('tpl')->assign('right',$right);
		M('tpl')->assign('score',$score);
		M('tpl')->display('basic_userimage');
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

		$this->search = M('ev')->get('search');
		$args = array();
		$basicid = M('ev')->get('basicid');
		if($basicid)
		{
			$fname = 'data/score/'.TIME.'-'.$basicid.'-score.xlsx';
			M('files')->mdir(PEPATH.'/data/score/');
			$args[] =  array('AND',"ehbasicid = :ehbasicid",'ehbasicid',$basicid);
			$args[] =  array('AND',"ehneedresit = 0");
			$args[] =  array('AND',"ehtype = 2");
			if($this->search['ehbatch'])
			{
				$args[] = array('AND',"ehbatch = :ehbatch",'ehbatch',$this->search['ehbatch']);
			}
			if($this->search['stime'])
			{
				$stime = strtotime($this->search['stime']);
				$args[] = array('AND',"ehstarttime >= :stime",'stime',$stime);
			}
			if($this->search['etime'])
			{
				$etime = strtotime($this->search['etime']);
				$args[] = array('AND',"ehstarttime <= :etime",'etime',$etime);
			}
			if($this->search['sscore'])
			{
				$args[] = array('AND',"ehscore >= :sscore",'sscore',$this->search['sscore']);
			}
			if($this->search['escore'])
			{
				$args[] = array('AND',"ehscore <= :escore",'escore',$this->search['escore']);
			}
			if($this->search['examid'])
			{
				$args[] = array('AND',"ehexamid = :ehexamid",'ehexamid',$this->search['examid']);
			}
			$sf = array('ehusername','ehscore');
			foreach($fields as $p)
			{
				$sf[] = $p['field'];
			}
			$rs = M('favor','exam')->getAllExamHistoryByArgs($args,$sf);
			$r = array();
			foreach($rs as $p)
			{
				$tmp = array('ehusername' => $p['ehusername'],'ehscore' => $p['ehscore']);
				foreach($fields as $ps)
				{
					$tmp[$ps['field']] = $p[$ps['field']];
				}
				$r[] = $tmp;
			}
			if(M('xlsx')->putExcelContent(PEPATH.'/'.$fname,$r))
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

	private function download()
	{
		$questype = M('basic','exam')->getQuestypeList();
		M('tpl')->assign('questype',$questype);
		$ehids = M('ev')->get('ehids');
		$sessionvars = array();
		$this->users = array();
		foreach($ehids as $ehid => $tmp)
		{
			$eh = M('favor','exam')->getExamHistoryById($ehid);
			$sessionvar = array('userid' => $eh['ehuserid'],'examsession'=>$eh['ehexam'],'examsessionscore'=>$eh['ehscore'],'examsessionscorelist'=>$eh['ehscorelist'],'examsessionsetting'=>$eh['ehsetting'],'examsessionquestion'=>$eh['ehquestion'],'examsessionuseranswer'=>$eh['ehuseranswer']);
			$sessionvars[] = $sessionvar;
			if(!$this->users[$eh['ehuserid']])
			{
				$this->users[$eh['ehuserid']] = M('user','user')->getUserById($eh['ehuserid']);
			}
		}
		M('tpl')->assign("users",$this->users);
		M('tpl')->assign("sessionvars",$sessionvars);
		$content = M('tpl')->fetchExeCnt('basic_download');
		$content = M('word')->WordMake($content);
		M('files')->mdir(PEPATH.'/data/word/');
		$fname = 'data/word/'.uniqid().".doc";//转换好生成的word文件名编码
		$fp = fopen(PEPATH.'/'.$fname, 'w');//打开生成的文档
		fwrite($fp, $content);//写入包保存文件
		fclose($fp);
		$message = array(
			'statusCode' => 200,
			"message" => "成绩导出成功，转入下载页面，如果浏览器没有相应，请<a href=\"{$fname}\">点此下载</a>",
			"callbackType" => 'forward',
			"forwardUrl" => "{$fname}"
		);
		\PHPEMS\ginkgo::R($message);
	}

	private function delhistory()
	{
		$ehid = M('ev')->get('ehid');
		M('favor','exam')->delExamHistory($ehid);
		$message = array(
			'statusCode' => 200,
			"message" => "操作成功",
			"callbackType" => 'forward',
			"forwardUrl" => "reload"
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
		M('tpl')->display('basic_examview');
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
		$this->search = M('ev')->get('search');
		$basicid = intval(M('ev')->get('basicid'));
		$basic = M('basic','exam')->getBasicById($basicid);
		$page = $page > 0?$page:1;
		$args = array();
		$args[] = array('AND',"ehtype = '2'");
		//$args[] = array('AND',"ehstatus = '1'");
		$args[] = array('AND',"ehbasicid = :ehbasicid",'ehbasicid',$basicid);
		if($this->search['ehbatch'])
		{
			$args[] = array('AND',"ehbatch = :ehbatch",'ehbatch',$this->search['ehbatch']);
		}
		if($this->search['stime'])
		{
			$stime = strtotime($this->search['stime']);
			$args[] = array('AND',"ehstarttime >= :stime",'stime',$stime);
		}
		if($this->search['etime'])
		{
			$etime = strtotime($this->search['etime']);
			$args[] = array('AND',"ehstarttime <= :etime",'etime',$etime);
		}
		if($this->search['sscore'])
		{
			$args[] = array('AND',"ehscore >= :sscore",'sscore',$this->search['sscore']);
		}
		if($this->search['escore'])
		{
			$args[] = array('AND',"ehscore <= :escore",'escore',$this->search['escore']);
		}
		if($this->search['examid'])
		{
			$args[] = array('AND',"ehexamid = :ehexamid",'ehexamid',$this->search['examid']);
		}
		$exams = M('favor','exam')->getExamHistoryListByArgs($args,$page,30);
		$ids = trim($basic['basicexam']['self'],', ');
		if(!$ids)$ids = '0';
		$exampaper = M('exam','exam')->getExamSettingsByArgs(array(array("AND","find_in_set(examid,:examid)",'examid',$ids)));
		M('tpl')->assign('basicid',$basicid);
		M('tpl')->assign('search',$this->search);
		M('tpl')->assign('basic',$basic);
		M('tpl')->assign('page',$page);
		M('tpl')->assign('fields',$fields);
		M('tpl')->assign('exampaper',$exampaper);
		M('tpl')->assign('exams',$exams);
		M('tpl')->display('basic_scorelist');
	}

	private function selectmember()
	{
		$page = intval(M('ev')->get('page'));
		$basicid = intval(M('ev')->get('basicid'));
		$basic = M('basic','exam')->getBasicById($basicid);
		$this->search = M('ev')->get('search');
		$this->u = '';
		if($this->search)
		{
			foreach($this->search as $key => $arg)
			{
				$this->u .= "&search[{$key}]={$arg}";
			}
		}
		if(M('ev')->get('submit'))
		{
			$this->userids = M('ev')->get('delids');
			$days = M('ev')->get('days');
			if($this->userids && $days)
			{
				foreach($this->userids as $this->userid => $p)
				{
					M('basic','exam')->openBasic(array('obuserid'=>$this->userid,'obbasicid'=>$basicid,'obendtime' => TIME + $days*24*3600));
				}
				$message = array(
					'statusCode' => 200,
					"message" => "操作成功",
					"callbackType" => "forward",
			    	"forwardUrl" => "index.php?exam-master-basic-members&basicid=".$basicid
				);
			}
			else
			{
				$message = array(
					'statusCode' => 300,
					"message" => "操作失败"
				);
			}
			\PHPEMS\ginkgo::R($message);
		}
		else
		{
			$args = array();
			if($this->search['userid'])$args[] = array('AND',"userid = :userid",'userid',$this->search['userid']);
			if($this->search['userfree1'])$args[] = array('AND',"userfree1 = :userfree1",'userfree1',$this->search['userfree1']);
			if($this->search['username'])$args[] = array('AND',"username LIKE :username",'username','%'.$this->search['username'].'%');
			if($this->search['useremail'])$args[] = array('AND',"useremail  LIKE :useremail",'useremail','%'.$this->search['useremail'].'%');
			if($this->search['groupid'])$args[] = array('AND',"usergroupid = :usergroupid",'usergroupid',$this->search['groupid']);
			if($this->search['stime'] || $this->search['etime'])
			{
				if(!is_array($args))$args = array();
				if($this->search['stime']){
					$stime = strtotime($this->search['stime']);
					$args[] = array('AND',"userregtime >= :userregtime",'userregtime',$stime);
				}
				if($this->search['etime']){
					$etime = strtotime($this->search['etime']);
					$args[] = array('AND',"userregtime <= :userregtime",'userregtime',$etime);
				}
			}
			$this->users = M('user','user')->getUserList($args,$page,10);
			M('tpl')->assign('basic',$basic);
			M('tpl')->assign('users',$this->users);
			M('tpl')->assign('search',$this->search);
			M('tpl')->assign('u',$this->u);
			M('tpl')->assign('page',$page);
			M('tpl')->display('basic_selectmember');
		}
	}

	private function members()
	{
		$basicid = M('ev')->get('basicid');
		$this->search = M('ev')->get('search');
		$page = M('ev')->get('page');
		$args = array();
		$args[] = array("AND",'openbasics.obbasicid = :obbasicid','obbasicid',$basicid);
		$args[] = array("AND",'openbasics.obendtime >= :obendtime','obendtime',TIME);
		if($this->search['userid'])
		{
			$args[] = array("AND",'user.userid = :userid','userid',$this->search['userid']);
		}
		if($this->search['username'])
		{
			$args[] = array("AND",'user.username LIKE :username','username','%'.$this->search['username'].'%');
		}
		$members = M('basic','exam')->getOpenBasicMember($args,$page);
		$basic = M('basic','exam')->getBasicById($basicid);
		M('tpl')->assign('search',$this->search);
		M('tpl')->assign('basicid',$basicid);
		M('tpl')->assign('basic',$basic);
		M('tpl')->assign('members',$members);
		M('tpl')->assign('page',$page);
		M('tpl')->display('basic_members');
	}

	private function selectgroups()
	{
		$this->useframe = M('ev')->get('useframe');
		$target = M('ev')->get('target');
		$page = M('ev')->get('page');
		$page = $page > 0?$page:1;
		M('pg')->setUrlTarget('modal-body" class="ajax');
		$args = array();
		$actors = M('user','user')->getUserGroupList($args,$page,10);
		M('tpl')->assign('page',$page);
		M('tpl')->assign('target',$target);
		M('tpl')->assign('actors',$actors);
		M('tpl')->display('basic_allowgroups');
	}

	private function getsubjectquestype()
	{
		$subjectid = M('ev')->get('subjectid');
		$subject = M('basic','exam')->getSubjectById($subjectid);
		$r = array();
		if($subject['subjectsetting']['questypes'])
		{
			foreach($subject['subjectsetting']['questypes'] as $key => $p)
			{
				if($p)$r[] = $key;
			}
		}
		exit(json_encode($r));
	}

	private function getbasicmembernumber()
	{
		$basicid = M('ev')->get('basicid');
		$number = M('basic','exam')->getOpenBasicNumber($basicid);
		echo $number;
	}

	private function output()
	{
		$args = array(array("AND","quest2knows.qkquestionid = questions.questionid"),array("AND","questions.questionstatus = '1'"),array("AND","questions.questionparent = 0"),array("AND","quest2knows.qktype = 0") );
		$rargs = array(array("AND","quest2knows.qkquestionid = questionrows.qrid"),array("AND","questionrows.qrstatus = '1'"),array("AND","quest2knows.qktype = 1") );
		$tmpknows = '0';
		if(M('ev')->get('subjectid'))
		{
			$knows = M('section','exam')->getAllKnowsBySubject(M('ev')->get('subjectid'));
			foreach($knows as $p)
			{
				if($p['knowsid'])$tmpknows .= ','.$p['knowsid'];
			}
			$args[] = array("AND","find_in_set(quest2knows.qkknowsid,:qkknowsid)",'qkknowsid',$tmpknows);
			$rargs[] = array("AND","find_in_set(quest2knows.qkknowsid,:qkknowsid)",'qkknowsid',$tmpknows);
		}
		elseif(M('ev')->get('sectionid'))
		{
			$knows = M('section','exam')->getKnowsListByArgs(array(array("AND","knowsstatus = 1"),array("AND","knowssectionid = :knowssectionid",'knowssectionid',M('ev')->get('sectionid'))));
			foreach($knows as $p)
			{
				if($p['knowsid'])$tmpknows .= ','.$p['knowsid'];
			}
			$args[] = array("AND","find_in_set(quest2knows.qkknowsid,:qkknowsid)",'qkknowsid',$tmpknows);
			$rargs[] = array("AND","find_in_set(quest2knows.qkknowsid,:qkknowsid)",'qkknowsid',$tmpknows);
		}
		elseif(M('ev')->get('knowsid'))
		{
			$knowsid = M('ev')->get('knowsid');
			$args[] = array("AND","find_in_set(quest2knows.qkknowsid,:qkknowsid)",'qkknowsid',$knowsid);
			$rargs[] = array("AND","find_in_set(quest2knows.qkknowsid,:qkknowsid)",'qkknowsid',$knowsid);
		}
		else
		{
			$message = array(
				'statusCode' => 300,
				"message" => "参数错误"
			);
			\PHPEMS\ginkgo::R($message);
		}
		$questions = M('exam','exam')->getQuestionListByArgs($args);
		M('files')->mdir(PEPATH.'/data/score/');
		$fname = 'data/score/'.M('ev')->get('subjectid').'-'.M('ev')->get('sectionid').'-'.M('ev')->get('knowsid').'-questions.xlsx';
		$r = array();
		foreach($questions as $p)
		{
			$r[] = array(
				'questiontype' => $p['questiontype'],
				'question' => html_entity_decode($p['question']),
				'questionselect' => html_entity_decode($p['questionselect']),
				'questionselectnumber' => $p['questionselectnumber'],
				'questionanswer' => html_entity_decode($p['questionanswer']),
				'questiondescribe' => html_entity_decode($p['questiondescribe']),
				'knowsid' => $p['qkknowsid'],
				'questionlevel' => $p['questionlevel']
			);
		}
		$questionrows = M('exam','exam')->getAllQuestionRowsByArgs($rargs);
		foreach($questionrows as $p)
		{
			$knows = M('section','exam')->getKnowsByArgs(array(array("AND","knowsid = :knowsid","knowsid",$p['qkknowsid'])));
			$r[] = array(
				'questiontype' => $p['qrtype'],
				'question' => html_entity_decode($p['qrquestion']),
				'questionselect' => html_entity_decode($p['qrselect']),
				'questionselectnumber' => $p['qrselectnumber'],
				'questionanswer' => html_entity_decode($p['qranswer']),
				'questiondescribe' => html_entity_decode($p['qrdescribe']),
				'knowsid' => html_entity_decode($knows['knowsid']),
				'questionlevel' => $p['qrlevel'],
				1,1
			);
			$qtp = M('exam','exam')->getSimpleQuestionListByArgs(array(array("AND","questionparent = :qrid",'qrid',$p['qrid']),array("AND","questionstatus = 1")));
			foreach($qtp as $qt)
			{
				$r[] = array(
					'questiontype' => $p['qrtype'],
					'question' => html_entity_decode($qt['question']),
					'questionselect' => html_entity_decode($qt['questionselect']),
					'questionselectnumber' => $qt['questionselectnumber'],
					'questionanswer' => html_entity_decode($qt['questionanswer']),
					'questiondescribe' => html_entity_decode($qt['questiondescribe']),
					'knowsid' => html_entity_decode($knows['knowsid']),
					'questionlevel' => $p['qrlevel'],
					1,0
				);
			}
		}
		if(M('xlsx')->putExcelContent(PEPATH.'/'.$fname,$r))
		$message = array(
			'statusCode' => 200,
			"message" => "试题导出成功，转入下载页面，如果浏览器没有相应，请<a href=\"{$fname}\">点此下载</a>",
		    "callbackType" => 'forward',
		    "forwardUrl" => "{$fname}"
		);
		else
		$message = array(
			'statusCode' => 300,
			"message" => "试题导出失败"
		);
		\PHPEMS\ginkgo::R($message);
	}

	private function section()
	{
		$subjectid = M('ev')->get('subjectid');
		$subjects = M('basic','exam')->getSubjectList();
		$page = M('ev')->get('page');
		$page = $page > 0?$page:1;
		$sections = M('section','exam')->getSectionList($page,10,array(array("AND","sectionsubjectid = :sectionsubjectid",'sectionsubjectid',$subjectid)));
		M('tpl')->assign('sections',$sections);
		M('tpl')->assign('subjectid',$subjectid);
		M('tpl')->assign('subjects',$subjects);
		M('tpl')->display('basic_section');
	}

	private function addsection()
	{
		if(M('ev')->get('insertsection'))
		{
			$args = M('ev')->get('args');
			$section = M('section','exam')->getSectionByArgs(array(array("AND","section = :section",'section',$args['section']),array("AND","sectionsubjectid = :sectionsubjectid",'sectionsubjectid',$args['sectionsubjectid'])));
			if($section)
			{
				$message = array(
					'statusCode' => 300,
					"message" => "操作失败，该科目下已经存在同名的章节"
				);
			}
			else
			{
				M('section','exam')->addSection($args);
				$message = array(
					'statusCode' => 200,
					"message" => "操作成功",
					"callbackType" => "forward",
				    "forwardUrl" => "index.php?exam-master-basic-section&subjectid={$args['sectionsubjectid']}"
				);
			}
			\PHPEMS\ginkgo::R($message);
		}
		else
		{
			$subjectid = M('ev')->get('subjectid');
			$subjects = M('basic','exam')->getSubjectList();
			M('tpl')->assign('subjectid',$subjectid);
			M('tpl')->assign('subjects',$subjects);
			M('tpl')->display('basic_addsection');
		}
	}

	private function modifysection()
	{
		if(M('ev')->get('modifysection'))
		{
			$args = M('ev')->get('args');
			$page = M('ev')->get('page');
			$sectionid = M('ev')->get('sectionid');
			$section = M('section','exam')->getSectionByArgs(array(array("AND","sectionid = :sectionid",'sectionid',$sectionid)));
			$tpsection = M('section','exam')->getSectionByArgs(array(array("AND","sectionsubjectid = :sectionsubjectid",'sectionsubjectid',$section['sectionsubjectid']),array("AND","section = :section",'section',$args['section']),array("AND","sectionid != :sectionid",'sectionid',$sectionid)));
			if($tpsection)
			{
				$message = array(
					'statusCode' => 300,
					"message" => "操作失败，本科目下已经存在这个章节",
				    "forwardUrl" => "index.php?exam-master-basic-section&subjectid={$section['sectionsubjectid']}&page={$page}"
				);
			}
			else
			{
				M('section','exam')->modifySection($sectionid,$args);
				$message = array(
					'statusCode' => 200,
					"message" => "操作成功",
					"callbackType" => "forward",
				    "forwardUrl" => "index.php?exam-master-basic-section&subjectid={$section['sectionsubjectid']}&page={$page}"
				);
			}
			\PHPEMS\ginkgo::R($message);
		}
		else
		{
			$page = M('ev')->get('page');
			$sectionid = M('ev')->get('sectionid');
			$section = M('section','exam')->getSectionByArgs(array(array("AND","sectionid = :sectionid",'sectionid',$sectionid)));
			$subjects = M('basic','exam')->getSubjectList();
			M('tpl')->assign('subjects',$subjects);
			M('tpl')->assign('section',$section);
			M('tpl')->display('basic_modifysection');
		}
	}

	private function delsection()
	{
		$sectionid = M('ev')->get('sectionid');
		$page = M('ev')->get('page');
		$section = M('section','exam')->getSectionByArgs(array(array("AND","sectionid = :sectionid",'sectionid',$sectionid)));
		M('section','exam')->delSection($sectionid);
		$message = array(
			"statusCode" => 200,
			"message" => "操作成功",
			"callbackType" => "forward",
		    "forwardUrl" => "index.php?exam-master-basic-section&subjectid={$section['sectionsubjectid']}&page={$page}"
		);
		\PHPEMS\ginkgo::R($message);
	}

	private function point()
	{
		$page = M('ev')->get('page');
		$page = $page > 0?$page:1;
		$sectionid = M('ev')->get('sectionid');
		$section = M('section','exam')->getSectionByArgs(array(array("AND","sectionid = :sectionid",'sectionid',$sectionid)));
		if(!$section['sectionid'])
		{
			header('location:index.php?exam-master-subject');
			exit;
		}
		else
		{
			$subjects = M('basic','exam')->getSubjectList();
			$knows = M('section','exam')->getKnowsList($page,10,array(array("AND","knowssectionid = :sectionid",'sectionid',$sectionid),array("AND","knowsstatus = 1")));
			M('tpl')->assign('section',$section);
			M('tpl')->assign('knows',$knows);
			M('tpl')->assign('subjects',$subjects);
			M('tpl')->display('basic_point');
		}
	}

	private function addpoint()
	{
		if(M('ev')->get('insertknows'))
		{
			$args = M('ev')->get('args');
			$page = M('ev')->get('page');
			$knows = explode(",",$args['knows']);
			$errmsg = '';
			foreach($knows as $know)
			{
				if($know)
				{
					$data = M('section','exam')->getKnowsByArgs(array(array("AND","knowsstatus = 1"),array("AND","knows = :knows",'knows',$know),array("AND","knowssectionid = :knowssectionid",'knowssectionid',$args['knowssectionid'])));
					if($data)
					{
						$errmsg .= $know.',';
					}
					else
					M('section','exam')->addKnows(array("knowssectionid" => $args['knowssectionid'],"knows" => $know));
				}
			}
			$errmsg = trim($errmsg,' ,');
			if($errmsg)$errmsg = $errmsg.'等知识点已经存在，程序自动忽略！';
			$message = array(
				'statusCode' => 200,
				"message" => "操作成功！".$errmsg,
			    "forwardUrl" => "index.php?exam-master-basic-point&sectionid={$args['knowssectionid']}"
			);
			\PHPEMS\ginkgo::R($message);
		}
		else
		{
			$page = M('ev')->get('page');
			$page = $page > 0?$page:1;
			$sectionid = M('ev')->get('sectionid');
			$section = M('section','exam')->getSectionByArgs(array(array("AND","sectionid = :sectionid",'sectionid',$sectionid)));
			if(!$section['sectionid'])
			{
				header('location:index.php?exam-master-subject');
				exit;
			}
			else
			{
				$subjects = M('basic','exam')->getSubjectList();
				$knows = M('section','exam')->getKnowsList($page,10,array(array("AND","knowssectionid = :sectionid",'sectionid',$sectionid),array("AND","knowsstatus = 1")));
				M('tpl')->assign('section',$section);
				M('tpl')->assign('subjects',$subjects);
				M('tpl')->display('basic_addpoint');
			}
		}
	}

	private function clearpoint()
	{
        $subjectid = M('ev')->get('subjectid');
		$sectionid = M('ev')->get('sectionid');
		$knowsid = M('ev')->get('knowsid');
		if($knowsid)
		{
            M('section','exam')->modifyKnows($knowsid,array('knowsnumber'=>'','knowsquestions'=>''));
		}
		elseif($sectionid)
		{
            $tpknows = M('section','exam')->getKnowsListByArgs(array(array("AND","knowssectionid = :knowssectionid",'knowssectionid',$sectionid)));
			foreach($tpknows as $p)
			{
                M('section','exam')->modifyKnows($p['knowsid'],array('knowsnumber'=>'','knowsquestions'=>''));
			}
        }
		elseif($subjectid)
		{
            $tpknows = M('section','exam')->getAllKnowsBySubject($subjectid);
            foreach($tpknows as $p)
            {
                M('section','exam')->modifyKnows($p['knowsid'],array('knowsnumber'=>'','knowsquestions'=>''));
            }
		}
        $message = array(
            "statusCode" => 200,
            "message" => "操作成功！",
            "callbackType" => "forward",
            "forwardUrl" => "reload"
        );
        \PHPEMS\ginkgo::R($message);
	}

	private function modifypoint()
	{
		if(M('ev')->get('modifypoint'))
		{
			$args = M('ev')->get('args');
			$page = M('ev')->get('page');
			$knowsid = M('ev')->get('knowsid');
			$knows = M('section','exam')->getKnowsByArgs(array(array("AND","knowsid = :knowsid",'knowsid',$knowsid)));
			$tpknows = M('section','exam')->getKnowsByArgs(array(array("AND","knowssectionid = :knowssectionid",'knowssectionid',$knows['knowssectionid']),array("AND","knows = :knows",'knows',$args['knows']),array("AND","knowsid != :",'knowsid',$knowsid)));
			if($tpknows)
			{
				$message = array(
					"statusCode" => 300,
					"message" => "操作失败，该章节下已经存在同名的知识点"
				);
			}
			else
			{
				M('section','exam')->modifyKnows($knowsid,$args);
				$message = array(
					"statusCode" => 200,
					"message" => "操作成功",
					"callbackType" => "forward",
				    "forwardUrl" => "index.php?exam-master-basic-point&sectionid={$knows['knowssectionid']}&page={$page}"
				);
			}
			\PHPEMS\ginkgo::R($message);
		}
		else
		{
			$page = M('ev')->get('page');
			$knowsid = M('ev')->get('knowsid');
			$knows = M('section','exam')->getKnowsByArgs(array(array("AND","knowsid = :knowsid",'knowsid',$knowsid)));
			$section = M('section','exam')->getSectionByArgs(array(array("AND","sectionid = :sectionid",'sectionid',$knows['knowssectionid'])));
			M('tpl')->assign('section',$section);
			M('tpl')->assign('knows',$knows);
			M('tpl')->display('basic_modifypoint');
		}
	}

	private function delpoint()
	{
		$knowsid = M('ev')->get('knowsid');
		$sectionid = M('ev')->get('sectionid');
		$page = M('ev')->get('page');
		M('section','exam')->delKnows($knowsid);
		$message = array(
			"statusCode" => 200,
			"message" => "操作成功！",
			"callbackType" => "forward",
		    "forwardUrl" => "reload"
		);
		\PHPEMS\ginkgo::R($message);
	}

	private function subject()
	{
		$subjects = M('basic','exam')->getSubjectList();
		M('tpl')->assign('subjects',$subjects);
		M('tpl')->display('basic_subject');
	}

	private function addsubject()
	{
		if(M('ev')->get('insertsubject'))
		{
			$args = array('subject' => M('ev')->get('subject'),'subjectsetting' => M('ev')->get('setting'));
			$data = M('basic','exam')->getSubjectByName($args['subject']);
			if($data)
			{
				$message = array(
				'statusCode' => 300,
				"message" => "操作失败，该科目已经存在"
				);
				\PHPEMS\ginkgo::R($message);
			}
			M('basic','exam')->addSubject($args);
			$message = array(
				'statusCode' => 200,
				"message" => "操作成功",
				"callbackType" => "forward",
			    "forwardUrl" => "index.php?exam-master-basic-subject"
			);
			\PHPEMS\ginkgo::R($message);
		}
		else
		{
			$subjects = M('basic','exam')->getSubjectList();
			$questypes = M('basic','exam')->getQuestypeList();
			M('tpl')->assign('questypes',$questypes);
			M('tpl')->assign('subjects',$subjects);
			M('tpl')->display('basic_addsubject');
		}
	}

	private function modifysubject()
	{
		if(M('ev')->get('modifysubject'))
		{
			$args = M('ev')->get('args');
			$subjectid = M('ev')->get('subjectid');
			M('basic','exam')->modifySubject($subjectid,$args);
			$message = array(
				'statusCode' => 200,
				"message" => "操作成功",
				"callbackType" => "forward",
			    "forwardUrl" => "index.php?exam-master-basic-subject"
			);
			\PHPEMS\ginkgo::R($message);
		}
		else
		{
			$subjectid = M('ev')->get('subjectid');
			$subject = M('basic','exam')->getSubjectById($subjectid);
			$questypes = M('basic','exam')->getQuestypeList();
			M('tpl')->assign('questypes',$questypes);
			M('tpl')->assign('subject',$subject);
			M('tpl')->display('basic_modifysubject');
		}
	}

	private function delsubject()
	{
		$subjectid = M('ev')->get('subjectid');
		$section = M('section','exam')->getSectionByArgs(array(array("AND","sectionsubjectid = :sectionsubjectid",'sectionsubjectid',$subjectid)));
		if($section)
		$message = array(
			'statusCode' => 300,
			"message" => "操作失败，请删除该科目下所有章节后再删除本科目"
		);
		else
		{
			M('basic','exam')->delSubject($subjectid);
			$message = array(
				'statusCode' => 200,
				"message" => "操作成功",
				"callbackType" => "forward",
			    "forwardUrl" => "index.php?exam-master-basic-subject"
			);
		}
		\PHPEMS\ginkgo::R($message);
	}

	private function questype()
	{
		$questypes = M('basic','exam')->getQuestypeList();
		M('tpl')->assign('questypes',$questypes);
		M('tpl')->display('basic_questype');
	}

	private function addquestype()
	{
		if(M('ev')->get('insertquestype'))
		{
			$args = M('ev')->get('args');
			$page = M('ev')->get('page');
			if(!$args['questchoice'])
			{
				if($args['questsort'])$args['questchoice'] = 101;
				else $args['questchoice'] = 1;
			}
			M('basic','exam')->addQuestype($args);
			$message = array(
				'statusCode' => 200,
				"message" => "操作成功",
				"callbackType" => "forward",
			    "forwardUrl" => "index.php?exam-master-basic-questype&page={$page}"
			);
			\PHPEMS\ginkgo::R($message);
		}
		else
		{
			M('tpl')->display('basic_addquestype');
		}
	}

	private function modifyquestype()
	{
		if(M('ev')->get('modifyquestype'))
		{
			$args = M('ev')->get('args');
			$page = M('ev')->get('page');
			$questid = M('ev')->get('questid');
			M('basic','exam')->modifyQuestype($questid,$args);
			$message = array(
				'statusCode' => 200,
				"message" => "操作成功",
				"callbackType" => "forward",
			    "forwardUrl" => "index.php?exam-master-basic-questype&page={$page}"
			);
			\PHPEMS\ginkgo::R($message);
		}
		else
		{
			$questid = M('ev')->get('questid');
			$quest = M('basic','exam')->getQuestypeById($questid);
			M('tpl')->assign('quest',$quest);
			M('tpl')->display('basic_modifyquest');
		}
	}

	private function delquestype()
	{
		$questid = M('ev')->get('questid');
		$page = M('ev')->get('page');
		M('basic','exam')->delQuestype($questid);
		$message = array(
			'statusCode' => 200,
			"message" => "操作成功",
			"callbackType" => "forward",
		    "forwardUrl" => "index.php?exam-master-basic-questype&page={$page}"
		);
		\PHPEMS\ginkgo::R($message);
	}

	private function delarea()
	{
		$areaid = intval(M('ev')->get('areaid'));
		M('area','exam')->delArea($areaid);
		$message = array(
			'statusCode' => 200,
			"message" => "操作成功",
			"callbackType" => "forward",
		    "forwardUrl" => "reload"
		);
		\PHPEMS\ginkgo::R($message);
	}

	private function modifyarea()
	{
		if(M('ev')->get('modifyarea'))
		{
			$args = M('ev')->get('args');
			$areaid = M('ev')->get('areaid');
			M('area','exam')->modifyArea($areaid,$args);
			$message = array(
				'statusCode' => 200,
				"message" => "操作成功",
				"callbackType" => "forward",
			    "forwardUrl" => "index.php?exam-master-basic-area&page={$page}{$this->u}"
			);
			\PHPEMS\ginkgo::R($message);
		}
		else
		{
			$page = intval(M('ev')->get('page'));
			$areaid = intval(M('ev')->get('areaid'));
			$area = M('area','exam')->getAreaById($areaid);
			M('tpl')->assign('page',$page);
			M('tpl')->assign('area',$area);
			M('tpl')->display('basic_modifyarea');
		}
	}

	private function addarea()
	{
		if(M('ev')->get('insertarea'))
		{
			$args = M('ev')->get('args');
			$id = M('area','exam')->addArea($args);
			if(!$id)
			$message = array(
				'statusCode' => 300,
				"message" => "操作失败，区号已存在"
			);
			else
			$message = array(
				'statusCode' => 200,
				"message" => "操作成功",
				"callbackType" => "forward",
			    "forwardUrl" => "index.php?exam-master-basic-area&page={$page}{$this->u}"
			);
			\PHPEMS\ginkgo::R($message);
		}
		else
		{
			M('tpl')->display('basic_addarea');
		}
	}

	private function area()
	{
		$page = M('ev')->get('page');
		$page = $page > 1?$page:1;
		$areas = M('area','exam')->getAreaListByPage($page,10);
		M('tpl')->assign('page',$page);
		M('tpl')->assign('areas',$areas);
		M('tpl')->display('basic_area');
	}

	private function delbasic()
	{
		$page = M('ev')->get('page');
		$basicid = M('ev')->get('basicid');
		M('basic','exam')->delBasic($basicid);
		$message = array(
			'statusCode' => 200,
			"message" => "操作成功",
			"callbackType" => "forward",
		    "forwardUrl" => "index.php?exam-master-basic&page={$page}{$this->u}"
		);
		\PHPEMS\ginkgo::R($message);
	}

	private function batdelbasic()
	{
		$page = M('ev')->get('page');
		$delids = M('ev')->get('delids');
		foreach($delids as $basicid => $p)
		{
			M('basic','exam')->delBasic($basicid);
        }
		$message = array(
			'statusCode' => 200,
			"message" => "操作成功",
			"callbackType" => "forward",
		    "forwardUrl" => "reload"
		);
		\PHPEMS\ginkgo::R($message);
	}

	private function modifybasic()
	{
		$page = M('ev')->get('page');
		if(M('ev')->get('modifybasic'))
		{
			$basicid = M('ev')->get('basicid');
			$args = M('ev')->get('args');
			M('basic','exam')->setBasicConfig($basicid,$args);
			$message = array(
				'statusCode' => 200,
				"message" => "操作成功",
				"callbackType" => "forward",
			    "forwardUrl" => "index.php?exam-master-basic&page={$page}"
			);
			\PHPEMS\ginkgo::R($message);
		}
		else
		{
			$basicid = M('ev')->get('basicid');
			$basic = M('basic','exam')->getBasicById($basicid);
			$subjects = M('basic','exam')->getSubjectList();
			$areas = M('area','exam')->getAreaList();
			M('tpl')->assign('areas',$areas);
			M('tpl')->assign('subjects',$subjects);
			M('tpl')->assign('basic',$basic);
			M('tpl')->display('basic_modify');
		}
	}

	private function offpaper()
	{
		$page = M('ev')->get('page');
		$basicid = M('ev')->get('basicid');
		$args = array();
		$args[] = array("AND","examsessionbasic = :examsessionbasic",'examsessionbasic',$basicid);
		$args[] = array("AND","examsessiontype = 2");
		$sessionusers = M('exam','exam')->getExamSessionByArgs($args,$page);
		M('tpl')->assign('sessionusers',$sessionusers);
		M('tpl')->display('basic_offpaper');
	}

    private function savepaper()
    {
        $sessionid = M('ev')->get('sessionid');
        $questype = M('basic','exam')->getQuestypeList();
        $sessionvars = M('exam','exam')->getExamSessionBySessionid($sessionid);
        $result = M('exam','exam')->markscore($sessionvars,$questype);
        $message = array(
            'statusCode' => 200,
            "message" => "操作成功",
            "callbackType" => "forward",
            "forwardUrl" => "reload"
        );
        \PHPEMS\ginkgo::R($message);
    }

	private function setexamrange()
	{
		$page = M('ev')->get('page');
		$basicid = M('ev')->get('basicid');
		if(M('ev')->get('setexamrange'))
		{
			$args = M('ev')->get('args');
			$args['basicsection'] = array();
			if(is_array($args['basicknows']))
			foreach($args['basicknows'] as $key => $p)
			{
				$args['basicsection'][] = $key;
			}
			$args['basicexam']['opentime']['start'] = strtotime($args['basicexam']['opentime']['start']);
			$args['basicexam']['opentime']['end'] = strtotime($args['basicexam']['opentime']['end']);
			$args['basicsection'] = $args['basicsection'];
			$args['basicknows'] = $args['basicknows'];
			$args['basicexam'] = $args['basicexam'];
			M('basic','exam')->setBasicConfig($basicid,$args);
			$message = array(
				'statusCode' => 200,
				"message" => "操作成功",
				"callbackType" => "forward",
			    "forwardUrl" => "index.php?exam-master-basic&page={$page}{$this->u}"
			);
			\PHPEMS\ginkgo::R($message);
		}
		else
		{
			$basic = M('basic','exam')->getBasicById($basicid);
			$subjects = M('basic','exam')->getSubjectList();
			$areas = M('area','exam')->getAreaList();
			$tmpknows = M('section','exam')->getAllKnowsBySubject($basic['basicsubjectid']);
			$knows = array();
			$sections = M('section','exam')->getSectionListByArgs(array(array("AND","sectionsubjectid = :sectionsubjectid",'sectionsubjectid',$basic['basicsubjectid'])));
			foreach($tmpknows as $p)
			{
				$knows[$p['knowssectionid']][] = $p;
			}
			$tpls = array();
			foreach(glob("app/exam/tpls/app/exampaper_paper*.tpl") as $p)
			{
				$tpls['ep'][] = substr(basename($p),0,-4);
			}
			foreach(glob("app/exam/tpls/app/exam_paper*.tpl") as $p)
			{
				$tpls['pp'][] = substr(basename($p),0,-4);
			}
			M('tpl')->assign('tpls',$tpls);
			M('tpl')->assign('basic',$basic);
			M('tpl')->assign('areas',$areas);
			M('tpl')->assign('sections',$sections);
			M('tpl')->assign('knows',$knows);
			M('tpl')->assign('subjects',$subjects);
			M('tpl')->display('basic_examrange');
		}
	}

	private function add()
	{
		if(M('ev')->get('insertbasic'))
		{
			$args = M('ev')->get('args');
			$page = M('ev')->get('page');
			$id = M('basic','exam')->addBasic($args);
			$message = array(
				'statusCode' => 200,
				"message" => "操作成功",
				"callbackType" => "forward",
			    "forwardUrl" => "index.php?exam-master-basic-setexamrange&basicid={$id}&page={$page}{$this->u}"
			);
			\PHPEMS\ginkgo::R($message);
		}
		else
		{
			$subjects = M('basic','exam')->getSubjectList();
			$areas = M('area','exam')->getAreaList();
			M('tpl')->assign('areas',$areas);
			M('tpl')->assign('subjects',$subjects);
			M('tpl')->display('basic_add');
		}
	}

	private function index()
	{
		$page = M('ev')->get('page');
		$this->search = M('ev')->get('search');
		$page = $page > 1?$page:1;
		$subjects = M('basic','exam')->getSubjectList();
		if(!$this->search)
		$args = 1;
		else
		$args = array();
		if($this->search['basicid'])$args[] = array("AND","basicid = :basicid",'basicid',$this->search['basicid']);
		else
		{
			if($this->search['keyword'])$args[] = array("AND","basic LIKE :basic",'basic',"%{$this->search['keyword']}%");
			if($this->search['basicareaid'])$args[] = array("AND","basicareaid = :basicareaid",'basicareaid',$this->search['basicareaid']);
			if($this->search['basicsubjectid'])$args[] = array("AND","basicsubjectid = :basicsubjectid",'basicsubjectid',$this->search['basicsubjectid']);
			if($this->search['basicapi'])$args[] = array("AND","basicapi = :basicapi",'basicapi',$this->search['basicapi']);
			if($this->search['basicclosed'])
			{
				if($this->search['basicclosed'] == 1)$basicclosed = 1;
				else
				$basicclosed = 0;
				$args[] = array("AND","basicclosed = :basicclosed",'basicclosed',$basicclosed);
			}
		}
		$basics = M('basic','exam')->getBasicList($args,$page,10);
		$areas = M('area','exam')->getAreaList();
		M('tpl')->assign('areas',$areas);
		M('tpl')->assign('subjects',$subjects);
		M('tpl')->assign('basics',$basics);
		M('tpl')->display('basic');
	}
}


?>
