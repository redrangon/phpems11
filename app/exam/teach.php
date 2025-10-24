<?php
namespace PHPEMS;
class app
{
	public $G;

	//初始化信息
	public function __construct()
	{
		
		$this->ev = M('ev');
		$this->session = M('session');
		$this->files = M('files');
		$this->user = M('user','user');
		$_user = $this->session->getSessionUser();

		$this->_user = $this->user->getUserById($_user['sessionuserid']);
		$this->_user['teacher_subjects'] = unserialize($this->_user['teacher_subjects']);
		$group = $this->user->getGroupById($_user['sessiongroupid']);
		if(!$this->_user['teacher_subjects'])
		{
			if($this->ev->get('userhash'))
			exit(json_encode(array(
				'statusCode' => 300,
				"message" => "您不具备管理权限",
			    "callbackType" => 'forward',
			    "forwardUrl" => "index.php?exam-app"
			)));
			else
			{
				header("location:index.php?exam-app");
				exit;
			}
		}
		//生产一个对象
		$this->teachsubjects = implode(',',$this->_user['teacher_subjects']);
		$this->tpl = M('tpl');
		$this->db = M('pepdo');

		$this->pg = M('pg');
		$this->html = M('html');
		$this->apps = M('apps','core');
		$this->basic = M('basic','exam');
		$this->area = M('area','exam');

		$this->section = M('section','exam');
		$this->favor = M('favor','exam');
		$this->exam = M('exam','exam');

		$this->tpl->assign('ols',array(1=>'一','二','三','四','五','六','七','八','九','十','十一','十二','十三','十四','十五','十六','十七','十八','十九','二十'));
		$this->tpl->assign('action',$this->ev->url(2)?$this->ev->url(2):'exams');
		$this->tpl->assign('_user',$this->_user);
		$this->tpl->assign('userhash',$this->ev->get('userhash'));
		$apps = $this->apps->getAppList();
		$this->tpl->assign('apps',$apps);
	}
}

?>