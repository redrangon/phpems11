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
		$this->sc = 'JOAa4HeKdq52b7jJZYXo';//密钥，需修改双方一致
		$sign = M('ev')->get('sign');
		$userid = M('ev')->get('userid');
		$username = M('ev')->get('username');
		$useremail = M('ev')->get('useremail');
		$ts = M('ev')->get('ts');
		if(M('ev')->get('checkyes'))
		{
			$rand =rand(1,6);
			if($rand == 5)
			{
				M('session')->clearOutTimeUser();
				M('exam','exam')->clearOutTimeExamSession();
			}
			if(TIME - $ts < 300)
			{
				if($sign == md5($userid.$username.$useremail.$this->sc.$ts))
				{
					$u = M('user','user')->getUserByUserName($username);
					if(!$u)
					{
						$defaultgroup = M('user','user')->getDefaultGroup();
						$pass = md5(rand(1000,9999));
						$id = M('user','user')->insertUser(array('username' => $username,'usergroupid' => $defaultgroup['groupid'],'userpassword' => md5($pass),'useremail' => $useremail));
						M('session')->setSessionUser(array('sessionuserid'=>$id,'sessionpassword'=>md5($pass),'sessionip'=>M('ev')->getClientIp(),'sessiongroupid'=>$defaultgroup,'sessionlogintime'=>TIME,'sessionusername'=>$username));
					}
					else
					{
						$args = array('sessionuserid'=>$u['userid'],'sessionpassword'=>$u['userpassword'],'sessionip'=>M('ev')->getClientIp(),'sessiongroupid'=>$u['usergroupid'],'sessionlogintime'=>TIME,'sessionusername'=>$u['username']);
						M('session')->setSessionUser($args);
					}
					header("location:".'index.php?'.\PHPEMS\ginkgo::$app.'-app');
				}
				else
				header("location:".'index.php?exam');//更改为验证失败后要跳转的地址
			}
			else
			header("location:".'index.php?exam');//更改为超时失败后要跳转的地址
		}
		else header("location:".'index.php?exam-api-login&checkyes=1&sign='.$sign.'&userid='.$userid.'&username='.$username.'&useremail='.$useremail.'&ts='.$ts);
		exit();
	}
}


?>
