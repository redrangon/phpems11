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
		if(!method_exists($this,$action))
		$action = "index";
		$this->$action();
		exit;
	}

	private function setCurrentBasic()
	{
		$basicid = $this->ev->get('basicid');
		if($this->data['openbasics'][$basicid])
		{
			if($this->data['openbasics'][$basicid]['basicclosed'])
			{
				$message = array(
					'statusCode' => 300,
					"message" => "此考场处于关闭状态"
				);
				\PHPEMS\ginkgo::R($message);
			}
			$this->session->setSessionValue(array('sessioncurrent'=>$basicid));
			$message = array(
				'statusCode' => 200,
			    "callbackType" => 'forward',
			    "forwardUrl" => "index.php?exam-phone-basics-page"
			);
		}
		else
		{
			$basic = $this->basic->getBasicById($basicid);
			if($basic['basicclosed'])
			{
				$message = array(
					'statusCode' => 300,
					"message" => "此考场处于关闭状态"
				);
				\PHPEMS\ginkgo::R($message);
			}
			$message = array(
				'statusCode' => 200,
				"message" => "您尚未开通本考场，系统将引导您开通",
			    "callbackType" => 'forward',
			    "forwardUrl" => "index.php?exam-phone-basics-detail&basicid=".$basicid
			);
		}
		\PHPEMS\ginkgo::R($message);
	}

	private function ajax()
	{
		switch($this->ev->url(4))
		{
			//根据章节获取知识点信息
            case 'getknowsbysectionid':
			$sectionid = $this->ev->get('sectionid');
			$knowsids = $this->data['currentbasic']['basicknows'][$sectionid];
			$aknows = $this->section->getKnowsListByArgs(array(array("AND","knowsid in (:knowsid)",'knowsid',$knowsids),array("AND","knowsstatus = 1")));
			if($sectionid)
				$data = '<option value="0">选择知识点</option>'."\n";
			else
				$data = '<option value="0">请先选择章节</option>'."\n";
			foreach($aknows as $knows)
			{
				$data .= '<option value="'.$knows['knowsid'].'">'.$knows['knows'].'</option>'."\n";
			}
			exit($data);
			break;

			//获取剩余时间
			case 'lefttime':
			$sessionid = $this->ev->get('sessionid');
			$sessionvars = $this->exam->getExamSessionBySessionid($sessionid);
			$lefttime = TIME - $sessionvars['examsessionstarttime'];
			if($lefttime < 0 )$lefttime = 0;
			exit("{$lefttime}");
			break;

			//根据科目获取章节信息
            case 'getsectionsbysubjectid':
			$sectionids = $this->data['currentbasic']['basicsection'];
			$aknows = $this->section->getSectionListByArgs(array(array("AND","sectionid IN (:sectionsubjectid)",'sectionsubjectid',$sectionids)));
			$data = array(array(0,'选择章节'));
			foreach($aknows as $knows)
			{
				$data[] = array($knows['sectionid'],$knows['section']);
			}
			exit(json_encode($data));
			break;

			//标注题目
			case 'sign':
			$questionid = intval($this->ev->get('questionid'));
			$sessionid = $this->ev->get('sessionid');
			$sessionvars = $this->exam->getExamSessionBySessionid($sessionid);
			$args['examsessionsign'] = $sessionvars['examsessionsign'];
			if($questionid && !$args['examsessionsign'][$questionid])
			{
				$args['examsessionsign'][$questionid] = 1;
				$args['examsessionsign'] = $args['examsessionsign'];
				$this->exam->modifyExamSession($sessionid,$args);
				exit('1');
			}
			else
			{
				unset($args['examsessionsign'][$questionid]);
				$args['examsessionsign'] = $args['examsessionsign'];
				$this->exam->modifyExamSession($sessionid,$args);
				exit('2');
			}
			break;

            case 'saveUserAnswer':
			$sessionid = $this->ev->get('sessionid');
			$sessionvars = $this->exam->getExamSessionBySessionid($sessionid);
			$question = $this->ev->post('question');
			$token = $this->ev->get('token');
			if(!$token || (md5($sessionvars['examsessionid'].'-'.$this->_user['sessionuserid'].'-'.$sessionvars['examsessiontoken']) != $token))
			{
				$message = array(
					'statusCode' => 300,
					"message" => "系统检测到试卷错误，请停止作答，联系监考老师！"
				);
				\PHPEMS\ginkgo::R($message);
			}
			foreach($question as $key => $t)
			{
				if($t == '')unset($question[$key]);
			}
			$this->exam->modifyExamSession($sessionid,array('examsessionuseranswer'=>$question));
			$message = array(
				'statusCode' => 200
			);
			\PHPEMS\ginkgo::R($message);
			break;

			default:
		}
	}

	public function index()
	{
		$this->tpl->assign('basics',$this->data['openbasics']);
		$this->tpl->display('index');
	}
}


?>
