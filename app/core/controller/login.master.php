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

	private function index()
	{
		if(M('ev')->get('userlogin'))
		{
			$args = M('ev')->get('args');
			$randcode = strtoupper(M('ev')->get('randcode'));
			$_user = $this->session->getSessionValue();
			if($randcode && ($randcode == $_user['sessionrandcode']))
			{
				$this->session->setRandCode(0);
				$user = M('user','user')->getUserByUserName($args['username']);
				if($user['userdisable'] == 1)
				{
					$message = array(
						'statusCode' => 300,
						"message" => "账号已禁用"
					);
					R($message);
				}
				if($user['userid'])
				{
					if($user['userpassword'] == md5($args['userpassword']))
					{
						$group = M('user','user')->getGroupById($user['groupid']);
						if($group['groupmoduleid'] != 1)
						{
							exit(json_encode(array(
								'statusCode' => 300,
								"message" => "您无权进入后台",
							    "callbackType" => 'forward',
							    "forwardUrl" => "index.php?core-master-login"
							)));
						}
						else
						{
							$this->session->setSessionUser(array('sessionuserid'=>$user['userid'],'sessionpassword'=>$user['userpassword'],'sessionip'=>M('ev')->getClientIp(),'sessiongroupid'=>$user['usergroupid'],'sessionlogintime'=>TIME,'sessionusername'=>$user['username']));
							$message = array(
								'statusCode' => 200,
								"message" => "操作成功，正在转入目标页面",
							    "callbackType" => 'forward',
							    "forwardUrl" => "index.php?core-master"
							);
							R($message);
						}
					}
					else
					{
						$message = array(
							"statusCode" => 300,
							"message" => "操作失败，您的用户名或者密码错误！"
						);
						R($message);
					}
				}
			}
			$message = array(
				"statusCode" => 300,
				"message" => "操作失败，验证码错误！".$_user['sessionrandcode']
			);
			R($message);
		}
		else
		{
			M('tpl')->display('login');
		}
	}
}


?>
