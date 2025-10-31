<?php

namespace PHPEMS\user;

use function \PHPEMS\M;

class user
{
	public function autoLoginWxUser($openid)
	{
        $user = $this->getUserByOpenId($openid);
		if(!$user)return false;
		$app = M('apps','core')->getApp('user');
		if($app['appsetting']['loginmodel'] == 1)M('session')->offOnlineUser($user['userid']);
		M('session')->setSessionUser(array(
			'sessionuserid'=>$user['userid'],
			'sessionpassword'=>$user['userpassword'],
			'sessionip'=>M('ev')->getClientIp(),
			'sessiongroupid'=>$user['usergroupid'],
			'sessionlogintime'=>TIME,
			'sessionusername'=>$user['username']
		));
		return true;
	}
	
	public function autoLoginMpUser($openid)
	{
        $user = $this->getUserByArgs(array(array('AND','usermpopenid = :usermpopenid','usermpopenid',$openid)));
		if(!$user)return false;
		$app = M('apps','core')->getApp('user');
		if($app['appsetting']['loginmodel'] == 1)
		{
			M('session')->offOnlineUser($user['userid']);
		}
		M('session')->setSessionUser(array(
			'sessionuserid'=>$user['userid'],
			'sessionpassword'=>$user['userpassword'],
			'sessionip'=>M('ev')->getClientIp(),
			'sessiongroupid'=>$user['usergroupid'],
			'sessionlogintime'=>TIME,
			'sessionusername'=>$user['username']
		));
		return true;
	}

	public function getUserByOpenId($openid)
	{
        $user = $this->getUserByArgs(array(array('AND','useropenid = :useropenid','useropenid',$openid)));
        return $user;
	}

    public function insertUser($args)
    {
        $args['userregip'] = M('ev')->getClientIp();
        $args['userregtime'] = TIME;
        return M('pepdo')->insertElement(array('table' => 'user','query' => $args));
    }

    public function delUserById($userid)
    {
        return M('pepdo')->delElement(array('table' => 'user','query' => array(array('AND',"userid = :userid",'userid',$userid))));
    }

    public function getUserById($id)
    {
		$args = array(
			array("AND","userid = :userid","userid",$id),
			array("AND","groupid = usergroupid")
		);
		return $this->getUserByArgs($args);
    }

    public function getUserByArgs($args)
    {
        $data = array(false,array('user','user_group'),$args);
        $sql = M('pepdo')->makeSelect($data);
        return M('pepdo')->fetch($sql,array('userinfo','groupright','manager_apps'));
    }

    public function getUsersByArgs($args)
    {
        $data = array(false,array('user','user_group'),$args,false,false,false);
        $sql = M('pepdo')->makeSelect($data);
        return M('pepdo')->fetchAll($sql,'userid',array('userinfo','groupright'));
    }

    public function getUserList($args,$page,$number = 10,$orderby = "userid desc")
    {
        $args[] = array("AND","groupid = usergroupid");
    	$data = array(
            'table' => array('user','user_group'),
            'query' => $args,
            'index' => 'userid',
			'orderby' => $orderby
        );
        return M('pepdo')->listElements($page,$number,$data);
    }

	public function modifyUserGroup($userid,$groupid)
	{
		$user = $this->getUserById($userid);
		if($groupid == $user['usergroupid'])return true;
		$group = $this->getGroupById($groupid);
		if($group['groupmoduleid'] == $user['groupmoduleid'])
		{
			$data = array('user',array('usergroupid'=>$groupid),array(array("AND","userid = :userid",'userid',$userid)));
			$sql = M('pepdo')->makeUpdate($data);
			M('pepdo')->exec($sql);
			return true;
		}
		else
		{
			$args = array('usergroupid'=>$groupid);
			$fields = M('module')->getPrivateMoudleFields($user['groupmoduleid']);
			foreach($fields as $p)
			{
				$args[$p['field']] = NULL;
			}
			$data = array('user',$args,array(array("AND","userid = :userid",'userid',$userid)));
			$sql = M('pepdo')->makeUpdate($data);
			M('pepdo')->exec($sql);
			return true;
		}
	}

	public function modifyUserPassword($userid,$args)
	{
		$data = array('user',array('userpassword'=>md5($args['password'])),array(array("AND","userid = :userid",'userid',$userid)));
		$sql = M('pepdo')->makeUpdate($data);
		M('pepdo')->exec($sql);
		return true;
	}

	public function modifyUserInfo($userid,$args)
	{
		if(!$args)return false;
		$data = array('user',$args,array(array('AND',"userid = :userid",'userid',$userid)));
		$sql = M('pepdo')->makeUpdate($data);
		return M('pepdo')->exec($sql);
	}

	public function delActorById($groupid)
	{
		$data = array('count(*) as number','user',array(array("AND","usergroupid = :usergroupid","usergroupid",$groupid)));
        $sql = M('pepdo')->makeSelect($data);
		$r = M('pepdo')->fetch($sql);
		if($r['number'])return false;
		else
		{
			$args = array(
				'table' => "user_group",
				'query' => array(array('AND',"groupid = :groupid",'groupid',$groupid))
			);
			return M('pepdo')->delElement($args);
		}
	}

	public function getUserByUserName($username)
	{
		$data = array(false,array('user','user_group'),array(array('AND',"user.username = :username",'username',$username),array('AND','user.usergroupid = user_group.groupid')));
		$sql = M('pepdo')->makeSelect($data);
		return M('pepdo')->fetch($sql,array('userinfo','groupright'));
	}

	public function getUserByEmail($email)
	{
		$data = array(false,array('user','user_group'),array(array('AND',"user.useremail = :email",'email',$email),array('AND','user.usergroupid = user_group.groupid')));
		$sql = M('pepdo')->makeSelect($data);
		return M('pepdo')->fetch($sql,array('userinfo','groupright'));
	}

	public function getGroupById($groupid)
	{
		$data = array(false,'user_group',array(array('AND',"groupid = :groupid",'groupid',$groupid)),false,'groupid DESC',false);
		$sql = M('pepdo')->makeSelect($data);
		return M('pepdo')->fetch($sql,'groupright');
	}

	public function getGroupByArgs($args)
	{
		$data = array(false,'user_group',$args);
		$sql = M('pepdo')->makeSelect($data);
		return M('pepdo')->fetch($sql,'groupright');
	}

	public function getUserGroups()
	{
		$data = array(false,'user_group',1,false,'groupid DESC',false);
		$sql = M('pepdo')->makeSelect($data);
		return M('pepdo')->fetchAll($sql,'groupid','groupright');
	}

	public function getUserGroupList($args,$page = 1,$number = 10)
	{
        $data = array(
			'table' => 'user_group',
			'query' => $args,
			'index' => 'groupid',
			'serial' => 'groupright'
		);
		return M('pepdo')->listElements($page,$number,$data);
	}

	public function getGroupsByModuleid($moduleid)
	{
		$data = array(false,'user_group',array(array('AND',"groupmoduleid = :groupmoduleid",'groupmoduleid',$moduleid)),false,false,false);
		$sql = M('pepdo')->makeSelect($data);
		return M('pepdo')->fetchAll($sql,'groupid','groupright');
	}

	public function getDefaultGroupByModuleid($moduleid)
	{
		$data = array(false,'user_group',array(array('AND',"groupmoduledefault = 1"),array('AND',"groupmoduleid = :groupmoduleid",'groupmoduleid',$moduleid)),false,'groupid DESC',false);
		$sql = M('pepdo')->makeSelect($data);
		return M('pepdo')->fetch($sql);
	}

	public function insertActor($args)
	{
		unset($args['groupmoduledefault']);
		$data = array('user_group',$args);
		$sql = M('pepdo')->makeInsert($data);
		M('pepdo')->exec($sql);
		return M('pepdo')->lastInsertId();
	}

	public function modifyActor($groupid,$args)
	{
		$r = $this->getGroupByArgs(array(array('AND',"groupname = :groupname",'groupname',$args['groupname']),array('AND',"groupid != :groupid",'groupid',$groupid)));
		if($r)return false;
		$data = array('user_group',$args,array(array('AND',"groupid = :groupid",'groupid',$groupid)));
		$sql = M('pepdo')->makeUpdate($data);
        return M('pepdo')->exec($sql);
	}

	public function selectDefaultActor($groupid)
	{
		$args = array("groupdefault" => 0);
		$data = array('user_group',$args);
		$sql = M('pepdo')->makeUpdate($data);
		M('pepdo')->exec($sql);
		$args = array("groupdefault" => 1);
		$data = array('user_group',$args,array(array('AND',"groupid = :groupid",'groupid',$groupid)));
		$sql = M('pepdo')->makeUpdate($data);
        return M('pepdo')->exec($sql);
	}

	public function getDefaultGroup()
	{
		$data = array(false,'user_group',array(array('AND',"groupdefault = 1")));
		$sql = M('pepdo')->makeSelect($data);
		return M('pepdo')->fetch($sql);
	}

	public function insertUserLog($args)
	{
		$args['ulip'] = M('ev')->getClientIp();
		$args['ultime'] = TIME;
		return M('pepdo')->insertElement(array('table' => 'user_log','query' => $args));
	}

	public function getUserLogList($args,$page = 1,$number = 10)
	{
		$args[] = array("AND","uluserid = userid");
		$data = array(
			'table' => array('user_log','user'),
			'query' => $args
		);
		return M('pepdo')->listElements($page,$number,$data);
	}

	public function delUserLogById($ulid)
	{
		return M('pepdo')->delElement(array('table' => 'user_log','query' => array(array('AND',"ulid = :ulid",'ulid',$ulid))));
	}

	public function clearUserLogByArgs($args)
	{
		return M('pepdo')->delElement(array('table' => 'user_log','query' => $args));
	}

}

?>
