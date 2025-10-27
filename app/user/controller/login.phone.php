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
		if($this->user['userid'])
		{
            $message = array(
                'statusCode' => 200,
                "callbackType" => 'forward',
                "forwardUrl" => "index.php?core-phone"
            );
            \PHPEMS\ginkgo::R($message);
		}
		$appid = 'user';
		$app = M('apps','core')->getApp($appid);
		M('tpl')->assign('app',$app);
		if(M('ev')->get('userlogin'))
		{
			$tmp = M('session')->getSessionValue();
			if(TIME - $tmp['sessionlasttime'] < 1)
			{
				$message = array(
					'statusCode' => 300,
					"message" => "操作失败"
				);
				\PHPEMS\ginkgo::R($message);
			}
			$args = M('ev')->get('args');
			$user = M('user','user')->getUserByUserName($args['username']);
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
					if($app['appsetting']['loginmodel'] == 1)
					{
						M('session')->offOnlineUser($user['userid']);
                    }
					M('session')->setSessionUser(array('sessionuserid'=>$user['userid'],'sessionpassword'=>$user['userpassword'],'sessionip'=>M('ev')->getClientIp(),'sessiongroupid'=>$user['usergroupid'],'sessionlogintime'=>TIME,'sessionusername'=>$user['username']));
					M('user','user')->insertUserLog(array('uluserid'=>$user['userid'],'ulcliect'=>'mobile'));
					$message = array(
						'statusCode' => 201,
						"message" => "操作成功",
					    "callbackType" => 'forward',
					    "forwardUrl" => "index.php?core-phone"
					);
					\PHPEMS\ginkgo::R($message);
				}
				else
				{
					$message = array(
						'statusCode' => 300,
						'errorinput' => 'args[username]',
						"message" => "操作失败"
					);
					\PHPEMS\ginkgo::R($message);
				}
			}
			else
			{
				$message = array(
					'statusCode' => 300,
					'errorinput' => 'args[username]',
					"message" => "操作失败"
				);
				\PHPEMS\ginkgo::R($message);
			}
		}
		else
		{
			M('tpl')->display('login');
		}
	}
}


?>
