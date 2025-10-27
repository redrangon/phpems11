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
	public $search;
	public $u;
	
	public function display()
	{
		$action = M('ev')->url(3);
		$this->search = M('ev')->get('search');
		$this->u = '';
		if($this->search)
		{
			M('tpl')->assign('search',$this->search);
			foreach($this->search as $key => $arg)
			{
				$this->u .= "&search[{$key}]={$arg}";
			}
		}
		M('tpl')->assign('search',$this->search);
		if(!method_exists($this,$action))
			$action = "index";
		$this->$action();
		exit;
	}

	private function setCurrentBasic()
	{
		$basicid = M('ev')->get('basicid');
		if($this->data['openbasics'][$basicid])
		{
			M('session')->setSessionValue(array('sessioncurrent'=>$basicid));
			if($this->data['openbasics'][$basicid]['basicclosed'])
			{
				$message = array(
					'statusCode' => 300,
					"message" => "此考场处于关闭状态"
				);
				\PHPEMS\ginkgo::R($message);
			}
			if($this->data['openbasics'][$basicid]['basicexam']['modal'] == 2)
			{
				$message = array(
					'statusCode' => 200,
					"message" => "操作成功",
					"callbackType" => 'forward',
					"forwardUrl" => "index.php?exam-app-exam"
				);
			}
			else
			{
				$message = array(
                    'statusCode' => 200,
                    "message" => "操作成功",
                    "callbackType" => 'forward',
                    "forwardUrl" => "index.php?exam-app-lesson"
                );
            }
		}
		else
		{
			$basic = M('basic','exam')->getBasicById($basicid);
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
			    "forwardUrl" => "index.php?exam-app-basics-detail&basicid=".$basicid
			);
		}
		\PHPEMS\ginkgo::R($message);
	}

	private function ajax()
	{
		switch(M('ev')->url(4))
		{
			//根据章节获取知识点信息
			case 'getknowsbysectionid':
			$sectionid = M('ev')->get('sectionid');
			$knowsids = $this->data['currentbasic']['basicknows'][$sectionid];
			$aknows = M('section','exam')->getKnowsListByArgs(array(array("AND","knowsid in (:knowsid)",'knowsid',$knowsids),array("AND","knowsstatus = 1")));
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
			$sessionid = M('ev')->get('sessionid');
			$sessionvars = M('exam','exam')->getExamSessionBySessionid($sessionid);
			$lefttime = TIME - $sessionvars['examsessionstarttime'];
			if($lefttime < 0 )$lefttime = 0;
			exit("{$lefttime}");
			break;

            case 'saveUserAnswer':
			$sessionid = M('ev')->get('sessionid');
			$sessionvars = M('exam','exam')->getExamSessionBySessionid($sessionid);
			$question = M('ev')->post('question');
			$token = M('ev')->get('token');
			if(!$token || (md5($sessionvars['examsessionid'].'-'.$this->user['userid'].'-'.$sessionvars['examsessiontoken']) != $token))
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
			M('exam','exam')->modifyExamSession($sessionid,array('examsessionuseranswer'=>$question));
			$message = array(
				'statusCode' => 200
			);
        	\PHPEMS\ginkgo::R($message);
			break;

			//根据科目获取章节信息
			case 'getsectionsbysubjectid':
			$sectionids = $this->data['currentbasic']['basicsection'];
			$aknows = M('section','exam')->getSectionListByArgs(array(array("AND","sectionid IN (:sectionsubjectid)",'sectionsubjectid',$sectionids)));
			$data = array(array(0,'选择章节'));
			foreach($aknows as $knows)
			{
				$data[] = array($knows['sectionid'],$knows['section']);
			}
			exit(json_encode($data));
			break;

			//标注题目
			case 'sign':
			$questionid = M('ev')->get('questionid');
			$sessionid = M('ev')->get('sessionid');
			$sessionvars = M('exam','exam')->getExamSessionBySessionid($sessionid);
			$args['examsessionsign'] = $sessionvars['examsessionsign'];
			if($questionid && !$args['examsessionsign'][$questionid])
			{
				$args['examsessionsign'][$questionid] = 1;
				$args['examsessionsign'] = $args['examsessionsign'];
				M('exam','exam')->modifyExamSession($sessionid,$args);
				exit('1');
			}
			else
			{
				unset($args['examsessionsign'][$questionid]);
				$args['examsessionsign'] = $args['examsessionsign'];
				M('exam','exam')->modifyExamSession($sessionid,$args);
				exit('2');
			}
			break;

			default:
		}
	}

	public function index()
	{
		$this->search = M('ev')->get('search');
		$page = M('ev')->get('page');
		$page = $page > 1?$page:1;
		$subjects = M('basic','exam')->getSubjectList();
		$args = array();
		if($this->search['keyword'])$args[] = array("AND","basic LIKE :basic",'basic',"%{$this->search['keyword']}%");
		$basics = M('basic','exam')->getBasicList($args,$page,15);
		$areas = M('area','exam')->getAreaList();
		$args = array();
		$args[] = array("AND","basicclosed = 0");
		$news = M('basic','exam')->getBasicsByArgs($args,5);
		M('tpl')->assign('news',$news);
		M('tpl')->assign('search',$this->search);
		M('tpl')->assign('areas',$areas);
		M('tpl')->assign('subjects',$subjects);
		M('tpl')->assign('basics',$basics);
		M('tpl')->display('index');
	}
}


?>
