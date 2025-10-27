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
        $this->wxpay = M('wxpay');
        $action = M('ev')->url(3);
		if(!method_exists($this,$action))
		$action = "index";
		$this->$action();
		exit;
	}

	private function items()
    {
        $this->item = M('item','weixin');
        $ids = M('ev')->get('itemids');
        $ids = explode(',',$ids);
        $items = $this->item->getItemsByArgs(array(array("AND","itemid IN (:itemid)","itemid",$ids)));
        M('tpl')->assign("items",$items);
        M('tpl')->display('items');
    }

	private function pclogin()
    {
        if(!$_SESSION['autosessionid'])
        {
            $sessionid = M('ev')->get('sessionid');
            $_SESSION['autosessionid'] = $sessionid;
        }
        else
        $sessionid = $_SESSION['autosessionid'];
        $openid = $this->wxpay->getwxopenid(true);
        $user = M('user','user')->getUserByOpenId($openid);
        if($user)
        {
            $args = array(
                'wxsid' => $sessionid,
                'wxinfo' => $user,
                'wxtime' => TIME,
                'wxtoken' => md5($sessionid.CS)
            );
            M('login','weixin')->addLogin($args);
        }
        else
        {
            if(WXAUTOREG)
            {
                $wxuser = $this->wxpay->getUserInfo();
                $username = 'wx_'.uniqid();
                $defaultgroup = M('user','user')->getDefaultGroup();
                $args = array(
                    'useropenid' => $openid,
                    'usertruename' => $wxuser['nickname'],
                    'username' => $username,
                    'useremail' => $username.EP,
                    'usergroupid' => $defaultgroup['groupid'],
                    'userpassword' => md5($username),
                    'userphoto' => $wxuser['headimgurl']
                );
                M('user','user')->insertUser($args);
                $user = M('user','user')->getUserByOpenId($openid);
                $args = array(
                    'wxsid' => $sessionid,
                    'wxinfo' => $user,
                    'wxtime' => TIME,
                    'wxtoken' => md5($sessionid.CS)
                );
                M('login','weixin')->addLogin($args);
            }
            else
            {
                $_SESSION['bindopenid'] = $openid;
                $_SESSION['bindtype'] = 'pc';
                header("location:index.php?weixin-phone-index-bindlogin");
                exit;
            }
        }
        $_SESSION['autosessionid'] = null;
        M('tpl')->assign("user",$user);
        M('tpl')->display('pclogin');
    }

    private function bindlogin()
    {
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
            if($user['userid'])
            {
                if($user['userpassword'] == md5($args['userpassword']))
                {
                    M('user','user')->modifyUserInfo($user['userid'],array('useropenid' => $_SESSION['bindopenid']));
                    if($_SESSION['bindtype'] == 'pc')
                    {
                        $args = array(
                            'wxsid' => $_SESSION['autosessionid'],
                            'wxinfo' => $user,
                            'wxtime' => TIME,
                            'wxtoken' => md5($_SESSION['autosessionid'].CS)
                        );
                        M('login','weixin')->addLogin($args);
                        $_SESSION['bindopenid'] = null;
                        $_SESSION['bindtype'] = null;
                        $_SESSION['autosessionid'] = null;
                        M('tpl')->assign("user",$user);
                        M('tpl')->display('pclogin');
                    }
                    else
                    {
                        $app = M('apps','core')->getApp('user');
                        if($app['appsetting']['loginmodel'] == 1)M('session')->offOnlineUser($user['userid']);
                        M('session')->setSessionUser(array('sessionuserid'=>$user['userid'],'sessionpassword'=>$user['userpassword'],'sessionip'=>M('ev')->getClientIp(),'sessiongroupid'=>$user['usergroupid'],'sessionlogintime'=>TIME,'sessionusername'=>$user['username']));
                        $_SESSION['bindopenid'] = null;
                        $_SESSION['bindtype'] = null;
                        $message = array(
                            'statusCode' => 201,
                            "message" => "操作成功",
                            "callbackType" => 'forward',
                            "forwardUrl" => "index.php?core-phone"
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

    private function bindregister()
    {
        $appid = 'user';
        $app = M('apps','core')->getApp($appid);
        M('tpl')->assign('app',$app);
        $fields = array();
        $tpfields = explode(',',$app['appsetting']['regfields']);
        foreach($tpfields as $f)
        {
            $tf = M('module')->getFieldByNameAndModuleid($f);
            if($tf && $tf['fieldappid'] == 'user')
            {
                $fields[$tf['fieldid']] = $tf;
            }
        }
        if(M('ev')->get('userregister'))
        {
            if($app['appsetting']['closeregist'])
            {
                $message = array(
                    'statusCode' => 300,
                    "message" => "管理员禁止了用户注册"
                );
                \PHPEMS\ginkgo::R($message);
            }
            $fob = array('admin','管理员','站长');
            $args = M('ev')->get('args');
            $defaultgroup = M('user','user')->getDefaultGroup();
            if(!$defaultgroup['groupid'] || !trim($args['username']))
            {
                $message = array(
                    'statusCode' => 300,
                    "message" => "用户不能注册"
                );
                \PHPEMS\ginkgo::R($message);
            }
            if($app['appsetting']['emailverify'])
            {
                $randcode = M('ev')->get('randcode');
                if((!$randcode) || ($randcode != $_SESSION['phonerandcode']['reg']))
                {
                    $message = array(
                        'statusCode' => 300,
                        "message" => "验证码错误"
                    );
                    \PHPEMS\ginkgo::R($message);
                }
                else
                {
                    $_SESSION['phonerandcode']['reg'] = 0;
                }
            }
            $username = $args['username'];
            foreach($fob as $f)
            {
                if(strpos($username,$f) !== false)
                {
                    $message = array(
                        'statusCode' => 300,
                        "message" => "用户已经存在"
                    );
                    \PHPEMS\ginkgo::R($message);
                }
            }
            $user = M('user','user')->getUserByUserName($username);
            if($user)
            {
                $message = array(
                    'statusCode' => 300,
                    "message" => "用户已经存在"
                );
                \PHPEMS\ginkgo::R($message);
            }
            $email = $args['useremail'];
            $user = M('user','user')->getUserByEmail($email);
            if($user)
            {
                $message = array(
                    'statusCode' => 300,
                    'errorinput' => 'args[username]',
                    "message" => "邮箱已经被注册"
                );
                \PHPEMS\ginkgo::R($message);
            }
            $fargs = array('username' => $username,'usergroupid' => $defaultgroup['groupid'],'userpassword' => md5($args['userpassword']),'useremail' => $email);
            foreach($fields as $key => $p)
            {
                $fargs[$p['field']] = $args[$p['field']];
            }
            $fargs['useropenid'] = $_SESSION['bindopenid'];
            $id = M('user','user')->insertUser($fargs);
            $user = M('user','user')->getUserById($id);
            if($_SESSION['bindtype'] == 'pc')
            {
                $args = array(
                    'wxsid' => $_SESSION['autosessionid'],
                    'wxinfo' => $user,
                    'wxtime' => TIME,
                    'wxtoken' => md5($_SESSION['autosessionid'].CS)
                );
                M('login','weixin')->addLogin($args);
                $_SESSION['bindopenid'] = null;
                $_SESSION['bindtype'] = null;
                $_SESSION['autosessionid'] = null;
                M('tpl')->assign("user",$user);
                M('tpl')->display('pclogin');
            }
            else
            {
                M('session')->setSessionUser(array('sessionuserid'=>$user['userid'],'sessionpassword'=>$user['userpassword'],'sessionip'=>M('ev')->getClientIp(),'sessiongroupid'=>$user['usergroupid'],'sessionlogintime'=>TIME,'sessionusername'=>$user['username']));
                $_SESSION['bindopenid'] = null;
                $_SESSION['bindtype'] = null;
                $message = array(
                    'statusCode' => 201,
                    "message" => "操作成功",
                    "callbackType" => 'forward',
                    "forwardUrl" => "index.php?core-phone"
                );
                \PHPEMS\ginkgo::R($message);
            }
        }
        else
        {
            $this->html = M('html');
            $forms = $this->html->buildHtml($fields);
            M('tpl')->assign('forms',$forms);
            M('tpl')->display('register');
        }
    }

	private function getopenid()
    {
        if($this->user['userid'])
        {
            header("location:index.php");
            exit;
        }
        $openid = $this->wxpay->getwxopenid();
        $user = M('user','user')->autoLoginWxUser($openid);
        if(!$user)
        {
            if(WXAUTOREG)
            {
                $wxuser = $this->wxpay->getUserInfo();
                $username = 'wx_'.uniqid();
                $defaultgroup = M('user','user')->getDefaultGroup();
                $args = array(
                    'useropenid' => $openid,
                    'usertruename' => $wxuser['nickname'],
                    'username' => $username,
                    'useremail' => $username.EP,
                    'usergroupid' => $defaultgroup['groupid'],
                    'userpassword' => md5($username),
                    'userphoto' => $wxuser['headimgurl']
                );
                M('user','user')->insertUser($args);
                $user = M('user','user')->autoLoginWxUser($openid);
            }
            else
            {
                $_SESSION['bindopenid'] = $openid;
                header("location:index.php?weixin-phone-index-bindlogin");
                exit;
            }
        }
        header("location:index.php");
        exit;
    }

	private function index()
	{
        //
	}
}


?>
