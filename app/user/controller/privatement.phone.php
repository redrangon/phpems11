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

	private function unbind()
    {
        $userid = $this->user['userid'];
        $id = M('user','user')->modifyUserInfo($userid,array('useropenid' => ''));
        $message = array(
            'statusCode' => 200,
            "callbackType" => 'forward',
            "forwardUrl" => "index.php?user-phone-logout"
        );
        \PHPEMS\ginkgo::R($message);
    }

	private function modifypass()
	{
		if(M('ev')->get('modifyuserpassword'))
		{
			$args = M('ev')->get('args');
			$oldpassword = M('ev')->get('oldpassword');
			$userid = $this->user['userid'];
			$user = M('user','user')->getUserById($userid);
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
				$id = M('user','user')->modifyUserPassword($userid,$args);
				$message = array(
					'statusCode' => 200,
					"message" => "操作成功",
				    "callbackType" => 'forward',
				    "forwardUrl" => "index.php?user-phone-logout"
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
			M('tpl')->display('modifypass');
		}
	}

	private function comment()
	{
		$page = M('ev')->get('page');
		M('pg')->setUrlTarget('modal-body" data-target="page6" class="ajax');
		M('pg')->setPageType('wap');
		$comments = $this->comment->getCommentList($page,$this->user['userid']);
		M('tpl')->assign('comments',$comments);
		M('tpl')->assign('page',$page);
		M('tpl')->display('comment');
	}

	private function index()
	{
		$page = M('ev')->get('page');
		$search = M('ev')->get('search');
		$u = '';
		if($search)
		{
			M('tpl')->assign('search',$search);
			foreach($search as $key => $arg)
			{
				$u .= "&search[{$key}]={$arg}";
			}
		}
		if(M('ev')->get('modifyuserinfo'))
		{
			$args = M('ev')->get('args');
			$userid = $this->user['userid'];
			$group = M('user','user')->getGroupById($this->user['sessiongroupid']);
			$args = M('module')->tidyNeedFieldsPars($args,$group['groupmoduleid'],0);
            unset($args['usercoin'],$args['userpassword'],$args['username'],$args['useremail'],$args['usergroupid']);
			$id = M('user','user')->modifyUserInfo($userid,$args);
			$message = array(
				'statusCode' => 200,
				"message" => "操作成功",
			    "callbackType" => 'forward',
			    "forwardUrl" => "reload"
			);
			\PHPEMS\ginkgo::R($message);
		}
		else
		{
			$userid = $this->user['userid'];
			$user = M('user','user')->getUserById($userid);
			$group = M('user','user')->getGroupById($user['usergroupid']);
			$fields = M('module')->getMoudleFields($group['groupmoduleid']);
			$forms = M('html')->buildHtml($fields,$user);
			$actors = M('user','user')->getGroupsByModuleid($group['groupmoduleid']);
			M('tpl')->assign('moduleid',$group['groupmoduleid']);
			M('tpl')->assign('fields',$fields);
			M('tpl')->assign('forms',$forms);
			M('tpl')->assign('actors',$actors);
			M('tpl')->assign('user',$user);
			M('tpl')->assign('page',$page);
			M('tpl')->display('modifyuser');
		}
	}
}


?>