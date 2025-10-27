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

	private function del()
	{
		$askid = M('ev')->get('askid');
		$page = M('ev')->get('page');
		$this->answer->delAsksById($askid);
		\PHPEMS\ginkgomsg(array('url'=>'index.php?exam-master-asks&page='.$page));
	}

	private function delanswer()
	{
		$answerid = M('ev')->get('answerid');
		$answer = $this->answer->getAnswerById($answerid);
		$page = M('ev')->get('page');
		$this->answer->delAnswerById($answerid);
		\PHPEMS\ginkgomsg(array('url'=>'index.php?exam-master-asks-detail&askid='.$answer['answeraskid'].'&page='.$page));
	}

	private function done()
	{
		$page = M('ev')->get('page');
		$ids = M('ev')->get('delids');
		foreach($ids as $key => $id)
		{
			$this->answer->delAsksById($id);
		}
		\PHPEMS\ginkgomsg(array('url'=>'index.php?exam-master-asks&page='.$page));
	}

	private function detail()
	{
		$page = M('ev')->get('page');
		$askid = M('ev')->get('askid');
		$ask = $this->answer->getAskById($askid);
		$question = M('exam','exam')->getQuestionByArgs(array(array("AND","questionid = :questionid",'questionid',$ask['askquestionid'])));
		$answers = $this->answer->getAnswerList($page,20,array(array("AND","answeraskid = :answeraskid",'answeraskid',$ask['askid'])));
		M('tpl')->assign('question',$question);
		M('tpl')->assign('answers',$answers);
		M('tpl')->display('ask_answer');
	}

	private function rely()
	{
		$page = M('ev')->get('page');
		$answerid = M('ev')->get('answerid');
		$args = M('ev')->get('args');
		$args['answertime'] = TIME;
		$args['answerteacher'] = $this->user['sessionusername'];
		$args['answerteacherid'] = $this->user['userid'];
		$id = $this->answer->giveAnswer($answerid,$args);
		\PHPEMS\ginkgomsg(array('url'=>'index.php?exam-master-asks-detail&askid='.$id.'&page='.$page));
	}

	private function index()
	{
		$sargs = M('ev')->get('args');
		$page = M('ev')->get('page');
		$page = $page > 1?$page:1;
		$args = array(array("AND","asks.askquestionid = questions.questionid"));
		if($sargs['asksubjectid'])$args[] = array("AND","asks.asksubjectid = :asksubjectid",'asksubjectid',$sargs['asksubjectid']);
		if($sargs['asklasttime'])$args[] = array("AND","asks.asklasttime >= :asklasttime",'asklasttime',$sargs['asklasttime']);
		if($sargs['askuserid'])$args[] = array("AND","asks.asklastteacherid = :asklastteacherid",'asklastteacherid',$sargs['askuserid']);
		if($sargs['askstatus'])
		{
			if($sargs['askstatus'] == -1)
			$args[] = array("AND","asks.askstatus = '0'");
			else
			$args[] = array("AND","asks.askstatus = '1'");
		}
		$subjects = M('basic','exam')->getSubjectList();
		$asks = $this->answer->getAskList($page,20,$args);
		M('tpl')->assign('args',$sargs);
		M('tpl')->assign('asks',$asks);
		M('tpl')->assign('subjects',$subjects);
		M('tpl')->display('asks');
	}
}


?>
