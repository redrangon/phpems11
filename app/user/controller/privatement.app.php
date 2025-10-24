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
		$this->html = M('html');
		$action = $this->ev->url(3);
		if(!method_exists($this,$action))
		$action = "index";
		$this->$action();
		exit;
	}

	private function password()
	{
        if($this->ev->get('modifyuserpassword'))
        {
            $args = $this->ev->get('args');
            $oldpassword = $this->ev->get('oldpassword');
            $userid = $this->_user['sessionuserid'];
            $user = $this->user->getUserById($userid);
            if(md5($oldpassword) != $user['userpassword'])
            {
                $message = array(
                    'statusCode' => 300,
                    "message" => "操作失败，原密码验证失败"
                );
                \PHPEMS\ginkgo::R($message);
            }
            if($args['password'] == $args['password2'] && $userid)
            {
                $id = $this->user->modifyUserPassword($userid,$args);
                $message = array(
                    'statusCode' => 200,
                    "message" => "操作成功",
                    "callbackType" => 'forward',
                    "forwardUrl" => "index.php?user-app-logout"
                );
                \PHPEMS\ginkgo::R($message);
            }
            else
            {
                $message = array(
                    'statusCode' => 300,
                    "message" => "操作失败"
                );
                \PHPEMS\ginkgo::R($message);
            }
        }
        else
        {
            $this->tpl->display('modifypassword');
        }
	}

	private function index()
	{
		if($this->ev->get('modifyuserinfo'))
		{
			$args = $this->ev->get('args');
			$userid = $this->_user['sessionuserid'];
			$group = $this->user->getGroupById($this->_user['sessiongroupid']);
			$args = $this->module->tidyNeedFieldsPars($args,$group['groupmoduleid'],0);
			unset($args['usercoin'],$args['userpassword'],$args['username'],$args['useremail'],$args['usergroupid']);
			$id = $this->user->modifyUserInfo($userid,$args);
			$message = array(
				'statusCode' => 200,
				"message" => "操作成功",
			    "callbackType" => 'forward',
			    "forwardUrl" => "index.php?user-app-privatement"
			);
			\PHPEMS\ginkgo::R($message);
		}
		else
		{
			$userid = $this->_user['sessionuserid'];
			$user = $this->user->getUserById($userid);
			$group = $this->user->getGroupById($user['usergroupid']);
			$fields = $this->module->getMoudleFields($group['groupmoduleid'],0);
			$forms = $this->html->buildHtml($fields,$user);
			$actors = $this->user->getGroupsByModuleid($group['groupmoduleid']);
			$this->tpl->assign('moduleid',$group['groupmoduleid']);
			$this->tpl->assign('fields',$fields);
			$this->tpl->assign('forms',$forms);
			$this->tpl->assign('actors',$actors);
			$this->tpl->assign('user',$user);
			$this->tpl->display('modifyuser');
		}
	}
}


?>
