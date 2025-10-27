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
			//根据章节获取知识点
			case 'getknowsbysectionid':
			$esid = M('ev')->get('esid');
			$knowsid = M('ev')->get('knowsid');
			$aknows = M('section','exam')->getKnowsListByArgs(array(array("AND","knowssectionid = :knowssectionid",'knowssectionid',$esid),array("AND","knowsstatus = 1")));
			echo "<option value='0'>全部</option>";
			foreach($aknows as $knows)
			{
				if($knowsid == $knows['knowsid'])
				echo "<option value='{$knows['knowsid']}' selected>{$knows['knows']}</option>";
				else
				echo "<option value='{$knows['knowsid']}'>{$knows['knows']}</option>";
				echo "\n";
			}
			exit();
			break;

			//根据科目获取章节
			case 'getsectionsbysubjectid':
			$esid = M('ev')->get('subjectid');
			$knowsid = intval(M('ev')->get('knowsid'));
			if($knowsid)
			$tmp = M('section','exam')->getSubjectAndSectionByKnowsid($knowsid);
			else
			{
				$tmp['knowssectionid'] = intval(M('ev')->get('sectionid'));
			}
			$aknows = M('section','exam')->getSectionListByArgs(array(array("AND","sectionsubjectid = :sectionsubjectid",'sectionsubjectid',$esid)));
			echo "<option value='0'>全部</option>";
			foreach($aknows as $knows)
			{
				if($tmp['knowssectionid'] == $knows['sectionid'])
				echo "<option value='{$knows['sectionid']}' selected>{$knows['section']}</option>";
				else
				echo "<option value='{$knows['sectionid']}'>{$knows['section']}</option>";
				echo "\n";
			}
			exit();
			break;

			default:
			break;
		}
	}

	private function batdel()
	{
		$askids = M('ev')->get('askids');
		foreach($askids as $id)
		{
			$this->answer->delAsksById($id);
		}
		header("location:index.php?exam-app-answer");
	}

	private function ask()
	{
		$askid = M('ev')->get('askid');
		$page = M('ev')->get('page');
		if(!$askid)
		{
			$questionid = M('ev')->get('questionid');
			if(!$questionid)
			{
				header("location:index.php?exam-app-answer");
				exit;
			}
			else
			$ask = $this->answer->getAskByArgs(array(array("AND","askuserid = :askuserid",'askuserid',$this->user['userid']),array("AND","askquestionid = :askquestionid",'askquestionid',$questionid)));
			if(!$ask)$ask = array('askquestionid' => $questionid);
		}
		else
		$ask = $this->answer->getAskById($askid);
		$question = M('exam','exam')->getQuestionByArgs(array(array("AND","questionid = :questionid",'questionid',$ask['askquestionid'])));
		if($ask['askid'])
		{
			M('tpl')->assign('allknows',M('section','exam')->getAllKnowsBySubject($ask['asksubjectid']));
			M('tpl')->assign('answers',$this->answer->getAnswerList($page,20,array(array("AND","answeraskid = :answeraskid",'answeraskid',$ask['askid']))));
		}
		else
		{
			$tmp = M('section','exam')->getSubjectAndSectionByKnowsid($question['questionknowsid']);
			M('tpl')->assign('allknows',M('section','exam')->getAllKnowsBySubject($tmp['sectionsubjectid']));
		}
		$knows = M('section','exam')->getKnowsByArgs(array(array("AND","knowsid = :knowsid",'knowsid',$question['questionknowsid'])));
		M('tpl')->assign('knows',$knows);
		M('tpl')->assign('question',$question);
		M('tpl')->assign('ask',$ask);
		M('tpl')->display('ask');
	}

	private function addanswer()
	{
		$questionid = M('ev')->get('questionid');
		$args = M('ev')->get('args');
		if(!$questionid)
		{
			header("location:index.php?exam-app-answer");
			exit;
		}
		else
		{
			$ask = $this->answer->getAskByArgs(array(array("AND","askuserid = :askuserid",'askuserid',$this->user['userid']),array("AND","askquestionid = :askquestionid",'askquestionid',$questionid)));
			if(!$ask)
			{
				$question = M('exam','exam')->getQuestionByArgs(array(array("AND","questionid = :questionid",'questionid',$questionid)));
				$tmp = M('section','exam')->getSubjectAndSectionByKnowsid($question['questionknowsid']);
				$askargs = array('asksubjectid'=>$tmp['sectionsubjectid'],'askquestionid'=>$questionid,'askuserid'=>$this->user['userid'],'asktime'=>TIME,'asklasttime'=>TIME);
				$id = $this->answer->insertAsks($askargs);
				$ask = $this->answer->getAskById($id);
			}
			$args['answeraskid'] = $ask['askid'];
			$args['answerasktime'] = TIME;
			$this->answer->insertAnswer($args);
			header('location:index.php?exam-app-answer-ask&askid='.$ask['askid']);
			exit;
		}
	}

	private function index()
	{
		$page = M('ev')->get('page');
		$knowsid = M('ev')->get('knowsid');
		$sectionid = M('ev')->get('sectionid');
		$status = M('ev')->get('status');
		$etime = M('ev')->get('etime');
		$subjectid = M('ev')->get('subjectid');
		if($etime)$etime = strtotime($etime);
		$subjects = M('basic','exam')->getSubjectList();
		$args = array(array("AND","asks.askdel = 0"));
		$args[] = array("AND","asks.askquestionid = questions.questionid");
		$args[] = array("AND","asks.askuserid = :askuserid",'askuserid',$this->user['userid']);
		if($knowsid)$args[] = array("AND","questions.questionknowsid = :questionknowsid",'questionknowsid',$knowsid);
		else
		{
			if($sectionid)
			{
				$knowsids = M('section','exam')->getKnowsListByArgs(array(array("AND","knowssectionid = :knowssectionid",'knowssectionid',$sectionid)));
				$tm = array();
				foreach($knowsids as $p)
				{
					$tm[] = $p['knowsid'];
				}
				$ids = implode(",",$tm);
				if(!$ids)$ids = 0;
				$args[] = array("AND","questions.questionknowsid IN (:questionknowsid)",'questionknowsid',$ids);
			}
			elseif($subjectid)
			{
				$args[] = array("AND","asks.asksubjectid = :asksubjectid",'asksubjectid',$subjectid);
			}
		}
		if($etime)$args[] = array("AND","asks.asklasttime = :asklasttime",'asklasttime',$etime);
		if($status)
		{
			if($status == 1)$args[] = array("AND","asks.askstatus = '1'");
			else
			$args[] = array("AND","asks.askstatus = '0'");
		}
		$asks = $this->answer->getAskList($page,20,$args);
		M('tpl')->assign('knowsid',$knowsid);
		M('tpl')->assign('status',$status);
		M('tpl')->assign('etime',$etime);
		M('tpl')->assign('asks',$asks);
		M('tpl')->assign('subjectid',$subjectid);
		M('tpl')->assign('subjects',$subjects);
		M('tpl')->assign('sectionid',$sectionid);
		M('tpl')->display('wddy');
	}
}


?>
