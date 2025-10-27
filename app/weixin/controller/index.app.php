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
        if($this->user['userid'])
		{
            $message = array(
                'statusCode' => 200,
                "callbackType" => "forward",
                "forwardUrl" => "index.php"
            );
            \PHPEMS\ginkgo::R($message);
		}
		$action = M('ev')->url(3);
		if(!method_exists($this,$action))
		$action = "index";
		$this->$action();
		exit;
	}

	private function autologin()
	{
        $sessionid = M('session')->getSessionid();
        $info = M('login','weixin')->getLogin($sessionid);
		$user = $info['wxinfo'];
		if($user['userid'])
		{
			$app = M('apps','core')->getApp('user');
			if($app['appsetting']['loginmodel'] == 1)M('session')->offOnlineUser($user['userid']);
			M('session')->setSessionUser(array('sessionuserid'=>$user['userid'],'sessionpassword'=>$user['userpassword'],'sessionip'=>M('ev')->getClientIp(),'sessiongroupid'=>$user['usergroupid'],'sessionlogintime'=>TIME,'sessionusername'=>$user['username']));
            M('login','weixin')->delLogin($sessionid);
            $message = array(
                'statusCode' => 200,
                "message" => "操作成功",
                "callbackType" => "forward",
                "forwardUrl" => "index.php"
            );
            \PHPEMS\ginkgo::R($message);
		}
        $message = array(
            'statusCode' => 200
        );
        \PHPEMS\ginkgo::R($message);
	}

	private function login()
	{
		$sessionid = M('session')->getSessionid();
		$img = M('peqr')->pngString(WP.'index.php?weixin-phone-index-pclogin&sessionid='.$sessionid);
        M('tpl')->assign('img',$img);
        M('tpl')->display('login');
	}

	private function index()
	{
        //
	}
}


?>
