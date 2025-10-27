<?php
/*
 * Created on 2016-5-19
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 * 接口地址：
 * 考试系统地址/index.php?core-api-login
 * 参数：
 * username:工号,ts:当前时间戳，sign：签名
 * 签名方式 MD5（username-约定密钥-ts）
 * 操作原理：
 * 当第三方系统发起考试系统登录请求，生成登录地址，如
 * 考试系统地址/index.php?core-api-login&username=username&ts=ts&sign=sign
 * 考试系统接受后，先验证签名和时间,签名正确且时间不超过300秒，判定成功，然后判断系统是否存在用户名为username的用户，存在后，以username身份登录并转到考试系统首页
 * 启用时请注释或删除第31行
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
		exit();//启用时请注释或删除本行
		$this->sc = 'JOAa4HeKdq52b7jJZYXo';//密钥，需修改双方一致
		$sign = M('ev')->get('sign');
		$username = M('ev')->get('username');
		$ts = M('ev')->get('ts');
		if(M('ev')->get('checkyes'))
		{
			$rand =rand(1,6);
			if($rand == 5)
			{
				$this->session->clearOutTimeUser();
				$this->exam->clearOutTimeExamSession();
			}
			if(TIME - $ts < 300)
			{
				if($sign == md5($username.$this->sc.$ts))
				{
					$user = M('user','user');
					$u = $user->getUserByUserName($username);
					if(!$u)
					{
						$defaultgroup = M('user','user')->getDefaultGroup();
						$pass = md5(rand(1000,9999));
						$id = M('user','user')->insertUser(array('username' => $username,'usergroupid' => $defaultgroup['groupid'],'userpassword' => md5($pass),'useremail' => $username.EP));
						$this->session->setSessionUser(array('sessionuserid'=>$id,'sessionpassword'=>md5($pass),'sessionip'=>M('ev')->getClientIp(),'sessiongroupid'=>$defaultgroup,'sessionlogintime'=>TIME,'sessionusername'=>$username));
					}
					else
					{
						$args = array('sessionuserid'=>$u['userid'],'sessionpassword'=>$u['userpassword'],'sessionip'=>M('ev')->getClientIp(),'sessiongroupid'=>$u['usergroupid'],'sessionlogintime'=>TIME,'sessionusername'=>$u['username']);
						$this->session->setSessionUser($args);
					}
					header("location:".'index.php?'.\PHPEMS\ginkgo::$app.'-app');
				}
				else
				header("location:".'index.php?exam');//更改为验证失败后要跳转的地址
			}
			else
			header("location:".'index.php?exam');//更改为超时失败后要跳转的地址
		}
		else header("location:".'index.php?core-api-login&checkyes=1&sign='.$sign.'&username='.$username.'&ts='.$ts);
		exit();
	}
}


?>
