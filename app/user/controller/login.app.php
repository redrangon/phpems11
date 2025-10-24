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

	private function index()
	{
		$appid = 'user';
		$app = M('apps','core')->getApp($appid);
		$this->tpl->assign('app',$app);
		if($this->ev->get('userlogin'))
		{
			$tmp = $this->session->getSessionValue();
			if(TIME - $tmp['sessionlasttime'] < 1)
			{
				$message = array(
					'statusCode' => 300,
					"message" => "操作失败"
				);
				\PHPEMS\ginkgo::R($message);
			}
			$args = $this->ev->get('args');
			$user = $this->user->getUserByUserName($args['username']);
			if($user['userdisable'] == 1)
			{
				$message = array(
					'statusCode' => 300,
					"message" => "账号已禁用"
				);
				\PHPEMS\ginkgo::R($message);
			}
			if($user['userid'])
			{
				if($user['userpassword'] == md5($args['userpassword']))
				{
                    if($_SESSION['openid'] && USEWX)
                    {
                        $this->user->modifyUserInfo($user['userid'],array('useropenid' => $_SESSION['openid']));
                    }
					if($app['appsetting']['loginmodel'] == 1)
					$this->session->offOnlineUser($user['userid']);
					$this->session->setSessionUser(array('sessionuserid'=>$user['userid'],'sessionpassword'=>$user['userpassword'],'sessionip'=>$this->ev->getClientIp(),'sessiongroupid'=>$user['usergroupid'],'sessionlogintime'=>TIME,'sessionusername'=>$user['username']));
					$this->user->insertUserLog(array('uluserid'=>$user['userid'],'ulcliect'=>'pc'));
					$message = array(
						'statusCode' => 201,
						"message" => "操作成功",
					    "callbackType" => 'forward',
					    "forwardUrl" => "reload"
					);
					\PHPEMS\ginkgo::R($message);
				}
				else
				{
					$message = array(
						'statusCode' => 300,
						'errorinput' => 'args[username]',
						"message" => "登录失败，请检查用户名和密码后重试"
					);
					\PHPEMS\ginkgo::R($message);
				}
			}
			else
			{
				$message = array(
					'statusCode' => 300,
					'errorinput' => 'args[username]',
					"message" => "登录失败，请检查用户名和密码后重试"
				);
				\PHPEMS\ginkgo::R($message);
			}
		}
		else
		{
			$this->tpl->display('login');
		}
	}
}


?>
