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
			    "forwardUrl" => "index.php?exam-teach-basic&page={$page}{$u}"
			);
			\PHPEMS\ginkgo::R($message);
		}
		else
		{
			$basic = M('basic','exam')->getBasicById($basicid);
			$subjects = M('basic','exam')->getSubjectList(array(array('AND',"find_in_set(subjectid,:subjectid)",'subjectid',$this->teachsubjects)));
			$areas = M('area','exam')->getAreaList();
			$tmpknows = M('section','exam')->getAllKnowsBySubject($basic['basicsubjectid']);
			$knows = array();
			$sections = M('section','exam')->getSectionListByArgs(array(array('AND',"sectionsubjectid = :sectionsubjectid",'sectionsubjectid',$basic['basicsubjectid'])));
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

	private function savepaper()
	{
		$sessionid = M('ev')->get('examsessionid');
		$questype = M('basic','exam')->getQuestypeList();
		$sessionvars = M('exam','exam')->getExamSessionBySessionid($sessionid);
		$question = $sessionvars['examsessionuseranswer'];
		$needhand = 0;
		foreach($sessionvars['examsessionquestion']['questions'] as $key => $tmp)
		{
			if(!$questype[$key]['questsort'])
			{
				foreach($tmp as $p)
				{
					if(is_array($sessionvars['examsessionuseranswer'][$p['questionid']]))
					{
						$nanswer = '';
						$answer = $sessionvars['examsessionuseranswer'][$p['questionid']];
						asort($answer);
						$nanswer = implode("",$answer);
						if($nanswer == $p['questionanswer'])$score = $sessionvars['examsessionsetting']['examsetting']['questype'][$key]['score'];
						else
						{
							if($questype[$key]['questchoice'] == 3)
							{
								$alen = strlen($p['questionanswer']);
								$rlen = 0;
								foreach($answer as $t)
								{
									if(strpos($p['questionanswer'],$t) === false)
									{
										$rlen = 0;
										break;
									}
									else
									{
										$rlen ++;
									}
								}
								$score = floatval($sessionvars['examsessionsetting']['examsetting']['questype'][$key]['score'] * $rlen/$alen);
							}
							else $score = 0;
						}
					}
					else
					{
						$answer = $sessionvars['examsessionuseranswer'][$p['questionid']];
						if($answer == $p['questionanswer'])$score = $sessionvars['examsessionsetting']['examsetting']['questype'][$key]['score'];
						else $score = 0;
					}
					$scorelist[$p['questionid']] = $score;
				}
			}
			else
			{
				if(is_array($tmp) && count($tmp))
				$needhand = 1;
			}
		}
		foreach($sessionvars['examsessionquestion']['questionrows'] as $key => $tmp)
		{
			if(!$questype[$key]['questsort'])
			{
				foreach($tmp as $tmp2)
				{
					foreach($tmp2['data'] as $p)
					{
						if(is_array($sessionvars['examsessionuseranswer'][$p['questionid']]))
						{
							$answer = $sessionvars['examsessionuseranswer'][$p['questionid']];
							asort($answer);
							$nanswer = implode("",$answer);
							if($nanswer == $p['questionanswer'])$score = $sessionvars['examsessionsetting']['examsetting']['questype'][$key]['score'];
							else
							{
								if($questype[$key]['questchoice'] == 3)
								{
									$alen = strlen($p['questionanswer']);
									$rlen = 0;
									foreach($answer as $t)
									{
										if(strpos($p['questionanswer'],$t) === false)
										{
											$rlen = 0;
											break;
										}
										else
										{
											$rlen ++;
										}
									}
									$score = $sessionvars['examsessionsetting']['examsetting']['questype'][$key]['score'] * $rlen/$alen;
								}
								else $score = 0;
							}
						}
						else
						{
							$answer = $sessionvars['examsessionuseranswer'][$p['questionid']];
							if($answer == $p['questionanswer'])$score = $sessionvars['examsessionsetting']['examsetting']['questype'][$key]['score'];
							else $score = 0;
						}
						$scorelist[$p['questionid']] = $score;
					}
				}
			}
			else
			{
				if(!$needhand)
				{
					if(is_array($tmp) && count($tmp))
					$needhand = 1;
				}
			}
		}
		$args['examsessionuseranswer'] = $question;
		$args['examsessionscorelist'] = $scorelist;
		$args['examsessionscore'] = array_sum($scorelist);
		M('exam','exam')->modifyExamSession($args,$sessionid);
		M('favor','exam')->addExamHistory($sessionid);
		$message = array(
			'statusCode' => 200,
			"message" => "操作成功",
			"callbackType" => "forward",
		    "forwardUrl" => "reload"
		);
		\PHPEMS\ginkgo::R($message);
	}

    private function selectgroups()
    {
        $useframe = M('ev')->get('useframe');
        $target = M('ev')->get('target');
        $page = M('ev')->get('page');
        $page = $page > 0?$page:1;
        $this->pg->setUrlTarget('modal-body" class="ajax');
        $args = 1;
        $actors = M('user','user')->getUserGroupList($args,$page,10);
        M('tpl')->assign('page',$page);
        M('tpl')->assign('target',$target);
        M('tpl')->assign('actors',$actors);
        M('tpl')->display('basic_allowgroups');
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

	private function getbasicmembernumber()
	{
		$basicid = M('ev')->get('basicid');
		$number = M('basic','exam')->getOpenBasicNumber($basicid);
		echo $number;
	}

	private function index()
	{
		$page = M('ev')->get('page');
		$search = M('ev')->get('search');
		$page = $page > 1?$page:1;
		$subjects = M('basic','exam')->getSubjectList(array(array('AND','find_in_set(subjectid,:subjectid)','subjectid',$this->teachsubjects)));
		$args = array(array('AND','find_in_set(basicsubjectid,:basicsubjectid)','basicsubjectid',$this->teachsubjects));
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
		M('tpl')->display('basic');
	}
}


?>
