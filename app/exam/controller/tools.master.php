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

	private function clearouttimeexamsession()
	{
		$search = M('ev')->get('search');
		if($search['argsmodel'])
		{
			if($search['stime'])$time = strtotime($search['stime']);
			M('exam','exam')->clearOutTimeExamSession($time);
			$message = array(
				'statusCode' => 200,
				"message" => "操作成功",
			    "callbackType" => "forward",
			    "forwardUrl" => "reload"
			);
		}
		else
		$message = array(
			'statusCode' => 300,
			"message" => "请先选择查询条件"
		);
		\PHPEMS\ginkgo::R($message);
	}

	private function clearouttimesession()
	{
		$search = M('ev')->get('search');
		if($search['argsmodel'])
		{
			if($search['stime'])$time = strtotime($search['stime']);
			M('session')->clearOutTimeUser($time);
			$message = array(
				'statusCode' => 200,
				"message" => "操作成功",
			    "callbackType" => "forward",
			    "forwardUrl" => "reload"
			);
		}
		else
		$message = array(
			'statusCode' => 300,
			"message" => "请先选择查询条件"
		);
		\PHPEMS\ginkgo::R($message);
	}

	private function clearsession()
	{
		M('tpl')->display('tools_session');
	}

	private function clearquestionrows()
	{
		$search = M('ev')->get('search');
		if($search['argsmodel'])
		{
			$args = array(array("AND","quest2knows.qkquestionid = questionrows.qrid"));
			if($search['questionid'])
			{
				$args[] = array("AND","questionrows.qrid = :qrid",'qrid',$search['questionid']);
			}
			if($search['questiontype'])
			{
				$args[] = array("AND","questionrows.qrtype = :qrtype",'qrtype',$search['questiontype']);
			}
			if($search['keyword'])
			{
				$args[] = array("AND","questionrows.qrquestion LIKE :qrquestion",'qrquestion','%'.$search['keyword'].'%');
			}
			if($search['stime'])
			{
				$args[] = array("AND","questionrows.qrtime >= :stime",'stime',strtotime($search['stime']));
			}
			if($search['etime'])
			{
				$args[] = array("AND","questionrows.qrtime <= :etime",'etime',strtotime($search['etime']));
			}
			if($search['qrlevel'])
			{
				$args[] = array("AND","questionrows.qrlevel = :qrlevel",'qrlevel',$search['qrlevel']);
			}
			if($search['questionknowsid'])
			{
				$args[] = array("AND","quest2knows.qkknowsid = :qkknowsid",'qkknowsid',$search['questionknowsid']);
			}
			else
			{
				$tmpknows = '0';
				if($search['questionsectionid'])
				{
					$knows = M('section','exam')->getKnowsListByArgs(array(array("AND","knowsstatus = 1"),array("AND","knowssectionid = :knowssectionid",'knowssectionid',$search['questionsectionid'])));
					foreach($knows as $p)
					{
						if($p['knowsid'])$tmpknows .= ','.$p['knowsid'];
					}
					$args[] = array("AND","find_in_set(quest2knows.qkknowsid,:qkknowsid)",'qkknowsid',$tmpknows);
				}
				elseif($search['questionsubjectid'])
				{
					$knows = M('section','exam')->getAllKnowsBySubject($search['questionsubjectid']);
					foreach($knows as $p)
					{
						if($p['knowsid'])$tmpknows .= ','.$p['knowsid'];
					}
					$args[] = array("AND","find_in_set(quest2knows.qkknowsid,:qkknowsid)","qkknowsid",$tmpknows);
				}
			}
			$questions = M('exam','exam')->getQuestionRowsByArgs($args,'qrid');
			foreach($questions as $n)
			{
				M('exam','exam')->finalDelQuestionRows($n['qrid']);
			}
			$message = array(
				'statusCode' => 200,
				"message" => "操作成功",
			    "callbackType" => "forward",
			    "forwardUrl" => "reload"
			);
			\PHPEMS\ginkgo::R($message);
		}
		else
		{
			$message = array(
				'statusCode' => 300,
				"message" => "请先选择查询条件"
			);
			\PHPEMS\ginkgo::R($message);
		}
	}

	private function clearhistory()
	{
		$search = M('ev')->get('search');
		if($search['argsmodel'])
		{
			if($search['stime'] || $search['etime'])
			{
				$args = array();
				if($search['stime'])$args[] = array("AND","ehstarttime >= :ehstarttime",'ehstarttime',strtotime($search['stime']));
				if($search['etime'])$args[] = array("AND","ehstarttime <= :ehendtime",'ehendtime',strtotime($search['etime']));
				M('favor','exam')->clearExamHistory($args);
				$message = array(
					'statusCode' => 200,
					"message" => "操作成功",
				    "callbackType" => "forward",
				    "forwardUrl" => "reload"
				);
				\PHPEMS\ginkgo::R($message);
			}
			else
			{
				$message = array(
					'statusCode' => 300,
					"message" => "请先选择起止时间"
				);
				\PHPEMS\ginkgo::R($message);
			}
		}
		else
		M('tpl')->display('tools_history');
	}

	private function clearquestions()
	{
		$search = M('ev')->get('search');
		if($search['argsmodel'])
		{
			$args = array(array("AND","quest2knows.qkquestionid = questions.questionid"),array("AND","questions.questionparent = 0"),array("AND","quest2knows.qktype = 0"));
			if($search['knowsids'])
			{
				$args[] = array("AND","find_in_set(questions.questionknowsid,:questionknowsid)",'questionknowsid',$search['knowsids']);
			}
			if($search['stime'])
			{
				$args[] = array("AND","questions.questioncreatetime >= :stime",'stime',strtotime($search['stime']));
			}
			if($search['etime'])
			{
				$args[] = array("AND","questions.questioncreatetime <= :etime",'etime',strtotime($search['etime']));
			}
			if($search['questiontype'])
			{
				$args[] = array("AND","questions.questiontype = :questiontype",'questiontype',$search['questiontype']);
			}
			if($search['questionlevel'])
			{
				$args[] = array("AND","questions.questionlevel = :questionlevel",'questionlevel',$search['questionlevel']);
			}
			if($search['questionknowsid'])
			{
				$args[] = array("AND","quest2knows.qkknowsid = :qkknowsid",'qkknowsid',$search['questionknowsid']);
			}
			else
			{
				$tmpknows = '0';
				if($search['questionsectionid'])
				{
					$knows = M('section','exam')->getKnowsListByArgs(array(array("AND","knowsstatus = 1"),array("AND","knowssectionid = :knowssectionid",'knowssectionid',$search['questionsectionid'])));
					foreach($knows as $p)
					{
						if($p['knowsid'])$tmpknows .= ','.$p['knowsid'];
					}
					$args[] = array("AND","find_in_set(quest2knows.qkknowsid,:qkknowsid)",'qkknowsid',$tmpknows);
				}
				elseif($search['questionsubjectid'])
				{
					$knows = M('section','exam')->getAllKnowsBySubject($search['questionsubjectid']);
					foreach($knows as $p)
					{
						if($p['knowsid'])$tmpknows .= ','.$p['knowsid'];
					}
					$args[] = array("AND","find_in_set(quest2knows.qkknowsid,:qkknowsid",'qkknowsid',$tmpknows);
				}
			}
			$questions = M('exam','exam')->getQuestionListByArgs($args,'questionid');
			foreach($questions as $n)
			{
				M('exam','exam')->fanalDelQuestions($n['questionid']);
			}
			$message = array(
				'statusCode' => 200,
				"message" => "操作成功",
			    "callbackType" => "forward",
			    "forwardUrl" => "reload"
			);
			\PHPEMS\ginkgo::R($message);
		}
		else
		{
			$message = array(
				'statusCode' => 300,
				"message" => "请先选择查询条件"
			);
			\PHPEMS\ginkgo::R($message);
		}
	}

	private function index()
	{
		$search = M('ev')->get('search');
		$questypes = M('basic','exam')->getQuestypeList();
		$subjects = M('basic','exam')->getSubjectList();
		$sections = M('section','exam')->getSectionListByArgs(array(array("AND","sectionsubjectid = :sectionsubjectid",'sectionsubjectid',$search['questionsubjectid'])));
		$knows = M('section','exam')->getKnowsListByArgs(array(array("AND","knowsstatus = 1"),array("AND","knowssectionid = :knowssectionid",'knowssectionid',$search['questionsectionid'])));
		M('tpl')->assign('subjects',$subjects);
		M('tpl')->assign('sections',$sections);
		M('tpl')->assign('knows',$knows);
		M('tpl')->assign('questypes',$questypes);
		M('tpl')->display('tools');
	}
}


?>
