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
		$search = M('ev')->get('search');
		$page = M('ev')->get('page');
		if($search)
		{
			M('tpl')->assign('search',$search);
			foreach($search as $key => $arg)
			{
				$u .= "&search[{$key}]={$arg}";
			}
		}
		M('tpl')->assign('page',$page);
		M('tpl')->assign('u',$u);
		$this->$action();
		exit;
	}

	private function basics()
	{
		$page = M('ev')->get('page');
		$search = M('ev')->get('search');
		$page = $page > 1?$page:1;
		$userid = M('ev')->get('userid');
		$subjects = M('basic','exam')->getSubjectList();
		if(!$search)
		$args = 1;
		else
		$args = array();
		if($search['basicid'])$args[] = array("AND","basicid = :basicid",'basicid',$search['basicid']);
		else
		{
			if($search['keyword'])$args[] = array("AND","basic LIKE :basic",'basic',"%{$search['keyword']}%");
			if($search['basicareaid'])$args[] = array("AND","basicareaid = :basicareaid",'basicareaid',$search['basicareaid']);
			if($search['basicsubjectid'])$args[] = array("AND","basicsubjectid = :basicsubjectid",'basicsubjectid',$search['basicsubjectid']);
			if($search['basicapi'])$args[] = array("AND","basicapi = :basicapi",'basicapi',$search['basicapi']);
		}
		$basics = M('basic','exam')->getBasicList($args,$page,10);
		$areas = M('area','exam')->getAreaList();
		$openbasics = M('basic','exam')->getOpenBasicsByUserid($userid);
		M('tpl')->assign('basics',$basics);
		M('tpl')->assign('openbasics',$openbasics);
		M('tpl')->assign('areas',$areas);
		M('tpl')->assign('subjects',$subjects);
		M('tpl')->assign('basics',$basics);
		M('tpl')->assign('userid',$userid);
		M('tpl')->display('users_basic');
	}

	private function openbasics()
	{
		$basicid = M('ev')->get('basicid');
		$userid = M('ev')->get('userid');
		if(M('basic','exam')->getOpenBasicByUseridAndBasicid($userid,$basicid))
		{
			$message = array(
				'statusCode' => 300,
				"message" => "您已经开通了本考场"
			);
		}
		else
		{
			M('basic','exam')->openBasic(array('obuserid'=>$userid,'obbasicid'=>$basicid,'obendtime' => TIME + 30*24*3600));
			$message = array(
				'statusCode' => 200,
				"message" => "操作成功",
				"callbackType" => "forward",
			    "forwardUrl" => "index.php?exam-master-users-basics&userid={$userid}{$u}"
			);
		}
		\PHPEMS\ginkgo::R($message);
	}

	private function closebasics()
	{
		$basicid = M('ev')->get('basicid');
		$userid = M('ev')->get('userid');
		$ob = M('basic','exam')->getOpenBasicByUseridAndBasicid($userid,$basicid);
		M('basic','exam')->delOpenBasic($ob['obid']);
		$message = array(
			'statusCode' => 200,
			"message" => "操作成功",
			"callbackType" => "forward",
		    "forwardUrl" => "reload"
		);
		\PHPEMS\ginkgo::R($message);
	}

	private function batopen()
	{
		if(M('ev')->get('batopen'))
		{
			$userids = M('ev')->get('userids');
			$usernames = M('ev')->get('usernames');
			$usergroupids = M('ev')->get('usergroupids');
			$basics = M('ev')->get('basics');
			$days = M('ev')->get('days');
			if($userids && $basics && $days)
			{
				$userids = explode(",",$userids);
				$basics = explode(",",$basics);
				foreach($userids as $userid)
				{
					foreach($basics as $basicid)
					{
						M('basic','exam')->openBasic(array('obuserid'=>$userid,'obbasicid'=>$basicid,'obendtime' => TIME + $days*24*3600));
					}
				}
				$message = array(
					'statusCode' => 200,
					"message" => "操作成功"
				);
			}
			elseif($usernames && $basics && $days)
			{
				$usernames = implode(",",array_unique(explode(",",$usernames)));
				$basics = explode(",",$basics);
				$userids = M('user','user')->getUsersByArgs(array(array("AND","find_in_set(username,:username)",'username',$usernames),array("AND","user.usergroupid = user_group.groupid")),false,false,false);
				foreach($userids as $user)
				{
					foreach($basics as $basicid)
					{
						M('basic','exam')->openBasic(array('obuserid'=>$user['userid'],'obbasicid'=>$basicid,'obendtime' => TIME + $days*24*3600));
					}
				}
				$message = array(
					'statusCode' => 200,
					"message" => "操作成功"
				);
			}
			elseif($usergroupids && $basics && $days)
			{
				$usergroupids = implode(",",array_unique(explode(",",$usergroupids)));
				$basics = explode(",",$basics);
				$userids = M('user','user')->getUsersByArgs(array(array("AND","find_in_set(usergroupid,:usergroupid)",'usergroupid',$usergroupids),array("AND","user.usergroupid = user_group.groupid")),false,false,false);
				foreach($userids as $user)
				{
					foreach($basics as $basicid)
					{
						M('basic','exam')->openBasic(array('obuserid'=>$user['userid'],'obbasicid'=>$basicid,'obendtime' => TIME + $days*24*3600));
					}
				}
				$message = array(
					'statusCode' => 200,
					"message" => "操作成功"
				);
			}
			else
			{
				$message = array(
					'statusCode' => 300,
					"message" => "参数错误"
				);
			}
			\PHPEMS\ginkgo::R($message);
		}
		else
		{
			$basicid = M('ev')->get('basicid');
			M('tpl')->assign('basicid',$basicid);
			M('tpl')->display('user_batopen');
		}
	}

	private function index()
	{
		$page = M('ev')->get('page')?M('ev')->get('page'):1;
		$search = M('ev')->get('search');
		$u = '';
		if($search)
		{
			foreach($search as $key => $arg)
			{
				$u .= "&search[{$key}]={$arg}";
			}
            M('tpl')->assign('search',$search);
            M('tpl')->assign('u',$u);
		}
        $args = array();
		if($search['userid'])
		$args[] = array("AND","userid = :userid",'userid',$search['userid']);
		elseif($search['groupid'] || $search['username'])
		{
			$args = array();
			if($search['groupid'])
			$args[] = array("AND","usergroupid = :usergroupid",'usergroupid',$search['groupid']);
			if($search['username'])
			$args[] = array("AND","username LIKE :username",'username',"%{$search['username']}%");
		}
		$users = M('user','user')->getUserList($args,$page,10);
		$groups = M('user','user')->getUserGroups();
		M('tpl')->assign('groups',$groups);
		M('tpl')->assign('users',$users);
		M('tpl')->display('user');
	}
}


?>
