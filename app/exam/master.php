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
		$this->user = M('user','user');
		$this->_user = $_user = $this->session->getSessionUser();
		$group = $this->user->getGroupById($_user['sessiongroupid']);
		if($group['groupmoduleid'] != 1)
		{
			if($this->ev->get('userhash'))
			exit(json_encode(array(
				'statusCode' => 301,
				"message" => "请您重新登录",
			    "callbackType" => 'forward',
			    "forwardUrl" => "index.php?core-master-login"
			)));
			else
			{
				header("location:?core-master-login");
				exit;
			}
		}
		//生产一个对象
		$this->tpl = M('tpl');
		$this->apps = M('apps','core');
		$this->basic = M('basic','exam');
		$this->area = M('area','exam');
		$this->section = M('section','exam');
		$this->exam = M('exam','exam');
		$this->favor = M('favor','exam');
		$this->module = M('module');
		$this->tpl->assign('action',$this->ev->url(2)?$this->ev->url(2):'exams');
		$user = $this->user->getUserById($_user['sessionuserid']);
		$user['manager_apps'] = unserialize($user['manager_apps']);
		$this->tpl->assign('_user',$user);
		$localapps = $this->apps->getLocalAppList();
		$apps = $this->apps->getAppList();
		if(!in_array(\PHPEMS\ginkgo::$app,$user['manager_apps']) && $apps['user']['appsetting']['managemodel'])
		{
			header("location:index.php?core-master");
			exit();
		}
		$this->tpl->assign('sectionorder',array(1=>'第一章','第二章','第三章','第四章','第五章','第六章','第七章','第八章','第九章','第十章','第十一章','第十二章','第十三章','第十四章','第十五章','第十六章','第十七章','第十八章','第十九章','第二十章','第二十一章','第二十二章'));
		$this->tpl->assign('ols',array(1=>'一','二','三','四','五','六','七','八','九','十','十一','十二','十三','十四','十五','十六','十七','十八','十九','二十'));
		$this->tpl->assign('userhash',$this->ev->get('userhash'));
		$localapps = $this->apps->getLocalAppList();
		$apps = $this->apps->getAppList();
		$this->tpl->assign('localapps',$localapps);
		$this->tpl->assign('apps',$apps);
	}
}

?>