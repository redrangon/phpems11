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
		$this->search = M('ev')->get('search');
		$this->u = '';
		if($this->search)
		{
			foreach($this->search as $key => $arg)
			{
				$this->u .= "&search[{$key}]={$arg}";
			}
			$this->tpl->assign('u',$this->u);
		}
		$this->tpl->assign('search',$this->search);
		if(!method_exists($this,$action))
		$action = "index";
		$this->$action();
		exit;
	}

	private function userdisable()
	{
		$userdisable = M('ev')->get('userdisable');
		$userid = M('ev')->get('userid');
		M('user','user')->modifyUserInfo($userid,array('userdisable' => $userdisable));
		if($userdisable == 1)$this->session->offOnlineUser($userid);
		$message = array(
			'statusCode' => 200,
			"message" => "操作成功",
			"callbackType" => "forward",
			"forwardUrl" => "reload"
		);
		\PHPEMS\ginkgo::R($message);
	}

	private function clearuserlog()
	{
		$userid = M('ev')->get('userid');
		M('user','user')->clearUserLogByArgs(array(array("AND","uluserid = :uluserid","uluserid",$userid)));
		$message = array(
			'statusCode' => 200,
			"message" => "操作成功",
			"callbackType" => "forward",
			"forwardUrl" => "reload"
		);
		\PHPEMS\ginkgo::R($message);
	}

	private function userlog()
	{
		$page = M('ev')->get('page')?M('ev')->get('page'):1;
		$args = array();
		$userid = M('ev')->get('userid');
		$args[] = array('AND',"uluserid = :userid",'userid',$userid);
		$userlogs = M('user','user')->getUserLogList($args,$page,20);
		$this->tpl->assign('userlogs',$userlogs);
		$this->tpl->assign('userid',$userid);
		$this->tpl->display('user_log');
	}

	private function del()
	{
		$page = M('ev')->get('page');
		$userid = M('ev')->get('userid');
		M('user','user')->delUserById($userid);
		$message = array(
			'statusCode' => 200,
			"message" => "操作成功",
		    "callbackType" => "forward",
		    "forwardUrl" => "index.php?user-master-user&page={$page}{$this->u}"
		);
		\PHPEMS\ginkgo::R($message);
	}

	private function batdel()
	{
		if(M('ev')->get('action') == 'delete')
		{
			$page = M('ev')->get('page');
			$delids = M('ev')->get('delids');
			foreach($delids as $userid => $p)
			M('user','user')->delUserById($userid);
			$message = array(
				'statusCode' => 200,
				"message" => "操作成功",
			    "callbackType" => "forward",
			    "forwardUrl" => "index.php?user-master-user&page={$page}{$this->u}"
			);
			\PHPEMS\ginkgo::R($message);
		}
	}

	private function modify()
	{
		$page = M('ev')->get('page');
		if(M('ev')->get('modifyusergroup'))
		{
			$groupid = M('ev')->get('groupid');
			$userid = M('ev')->get('userid');
			M('user','user')->modifyUserGroup($userid,$groupid);
			$message = array(
				'statusCode' => 200,
				"message" => "操作成功",
			    "callbackType" => "forward",
			    "forwardUrl" => "index.php?user-master-user&page={$page}{$this->u}"
			);
			\PHPEMS\ginkgo::R($message);
		}
		elseif(M('ev')->get('setteachsubject'))
		{
			$subjects = M('ev')->get('subjects');
			$userid = M('ev')->get('userid');
			$user = M('user','user')->getUserById($userid);
			$modules = M('module')->getModulesByApp('user');
			if($modules[$user['groupmoduleid']]['modulecode'] != 'teacher')
			{
                $message = array(
                    'statusCode' => 300,
                    "message" => "此用户不是教师"
                );
                \PHPEMS\ginkgo::R($message);
			}
            M('user','user')->modifyUserInfo($userid,array('teacher_subjects' => $subjects));
            $message = array(
                'statusCode' => 200,
                "message" => "操作成功",
                "callbackType" => "forward",
                "forwardUrl" => "reload"
            );
            \PHPEMS\ginkgo::R($message);
		}
		elseif(M('ev')->get('modifyuserinfo'))
		{
			$args = M('ev')->get('args');
			$userid = M('ev')->get('userid');
			$user = M('user','user')->getUserById($userid);
			$group = M('user','user')->getGroupById($user['usergroupid']);
			$args = M('module')->tidyNeedFieldsPars($args,$group['groupmoduleid'],1);
			$id = M('user','user')->modifyUserInfo($userid,$args);
			$message = array(
				'statusCode' => 200,
				"message" => "操作成功",
			    "callbackType" => "forward",
			    "forwardUrl" => "index.php?user-master-user&page={$page}{$this->u}"
			);
			\PHPEMS\ginkgo::R($message);
		}
		elseif(M('ev')->get('modifyuserpassword'))
		{
			$args = M('ev')->get('args');
			$userid = M('ev')->get('userid');
			if($args['password'] == $args['password2'] && $userid)
			{
				$id = M('user','user')->modifyUserPassword($userid,$args);
				$message = array(
					'statusCode' => 200,
					"message" => "操作成功",
				    "callbackType" => "forward",
				    "forwardUrl" => "index.php?user-master-user&page={$page}{$this->u}"
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
			$userid = M('ev')->get('userid');
			$user = M('user','user')->getUserById($userid);
			$group = M('user','user')->getGroupById($user['usergroupid']);
			$fields = M('module')->getMoudleFields($group['groupmoduleid'],1);
			$forms = $this->html->buildHtml($fields,$user);
			$subjects = M('basic','exam')->getSubjectList();
            $this->tpl->assign('subjects',$subjects);
			$this->tpl->assign('moduleid',$group['groupmoduleid']);
			$this->tpl->assign('fields',$fields);
			$this->tpl->assign('forms',$forms);
			$this->tpl->assign('user',$user);
			$this->tpl->assign('page',$page);
			$this->tpl->display('modifyuser');
		}
	}

	private function batadd()
	{
		if(M('ev')->post('insertUser'))
		{
			$uploadfile = M('ev')->get('uploadfile');
			if(!file_exists($uploadfile))
			{
				$message = array(
					'statusCode' => 300,
					"message" => "上传文件不存在"
				);
				\PHPEMS\ginkgo::R($message);
			}
			else
			{
				$datas = M('xlsx')->getExcelContent($uploadfile);
				$defaultgroup = M('user','user')->getDefaultGroup();
                $app = M('apps','core')->getApp('user');
                $tpfields = explode(',',$app['appsetting']['regfields']);
				foreach ($datas as $data)
				{

				    if($data[0] && $data[1])
				    {
					    $args = array();
					    $args['username'] = $data[0];
					    if(M('strings')->isUserName($args['username']))
					    {
						    $u = M('user','user')->getUserByUserName($args['username']);
						    if(!$u)
						    {
							    $args['useremail'] = $data[1];
							    if(M('strings')->isEmail($args['useremail']))
							    {
								    $u = M('user','user')->getUserByEmail($args['useremail']);
								    if(!$u)
								    {
								    	if(!$data[2])$data[2] = '111111';
								    	$args['userpassword'] = md5($data[2]);
								    	$args['usergroupid'] = $defaultgroup['groupid'];
								    	$i = 3;
								    	foreach($tpfields as $p)
										{
                                            $args[$p] = $data[$i];
                                            $i++;
										}
								    	M('user','user')->insertUser($args);
								    }
							    }
						    }
					    }
				    }
				}
				$message = array(
					'statusCode' => 200,
					"message" => "操作成功",
				    "callbackType" => "forward",
				    "forwardUrl" => "index.php?user-master-user"
				);
				\PHPEMS\ginkgo::R($message);
			}
		}
		else
		{
			$this->tpl->display('batadduser');
		}
	}

	private function add()
	{
		if(M('ev')->post('insertUser'))
		{
			$args = M('ev')->post('args');
			if($args['userpassword'] == $args['userpassword2'])
			{
				$userbyname = M('user','user')->getUserByUserName($args['username']);
				$userbyemail = M('user','user')->getUserByEmail($args['useremail']);
				if($userbyname)
				$errmsg = "这个用户名已经被注册了";
				if($userbyemail)
				$errmsg = "这个邮箱已经被注册了";
				if($errmsg)
				{
					$message = array(
						'statusCode' => 300,
						"message" => "{$errmsg}"
					);
					\PHPEMS\ginkgo::R($message);
				}
				$args['userpassword'] = md5($args['userpassword']);
				$search = M('ev')->get('search');
				$u = '';
				if($search)
				{
					foreach($search as $key => $arg)
					{
						$u .= "&search[{$key}]={$arg}";
					}
				}
				unset($args['userpassword2']);
				$id = M('user','user')->insertUser($args);
				$message = array(
					'statusCode' => 200,
					"message" => "操作成功",
				    "callbackType" => "forward",
				    "forwardUrl" => "index.php?user-master-user{$this->u}"
				);
				\PHPEMS\ginkgo::R($message);
			}
		}
		else
		{
			$this->tpl->display('adduser');
		}
	}

	private function index()
	{
		$page = M('ev')->get('page')?M('ev')->get('page'):1;
		$args = array();
		if($this->search['userid'])$args[] = array('AND',"userid = :userid",'userid',$this->search['userid']);
		if($this->search['username'])$args[] = array('AND',"username LIKE :username",'username','%'.$this->search['username'].'%');
		if($this->search['useremail'])$args[] = array('AND',"useremail  LIKE :useremail",'useremail','%'.$this->search['useremail'].'%');
		if($this->search['groupid'])$args[] = array('AND',"usergroupid = :usergroupid",'usergroupid',$this->search['groupid']);
		if($this->search['stime']){
			$stime = strtotime($this->search['stime']);
			$args[] = array('AND',"userregtime >= :userregtime",'userregtime',$stime);
		}
		if($this->search['etime']){
			$etime = strtotime($this->search['etime']);
			$args[] = array('AND',"userregtime <= :userregtime",'userregtime',$etime);
		}
		$users = M('user','user')->getUserList($args,$page,50);
		$this->tpl->assign('users',$users);
		$this->tpl->assign('page',$page);
		$this->tpl->display('user');
	}
}


?>
