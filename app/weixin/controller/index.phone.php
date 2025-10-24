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
        $this->login = M('login','weixin');
	    $action = $this->ev->url(3);
		if(!method_exists($this,$action))
		$action = "index";
		$this->$action();
		exit;
	}

	private function items()
    {
        $this->item = M('item','weixin');
        $ids = $this->ev->get('itemids');
        $ids = explode(',',$ids);
        $items = $this->item->getItemsByArgs(array(array("AND","itemid IN (:itemid)","itemid",$ids)));
        $this->tpl->assign("items",$items);
        $this->tpl->display('items');
    }

	private function pclogin()
    {
        if(!$_SESSION['autosessionid'])
        {
            $sessionid = $this->ev->get('sessionid');
            $_SESSION['autosessionid'] = $sessionid;
        }
        else
        $sessionid = $_SESSION['autosessionid'];
        $openid = $this->wxpay->getwxopenid(true);
        $user = $this->user->getUserByOpenId($openid);
        if($user)
        {
            $args = array(
                'wxsid' => $sessionid,
                'wxinfo' => $user,
                'wxtime' => TIME,
                'wxtoken' => md5($sessionid.CS)
            );
            $this->login->addLogin($args);
        }
        else
        {
            if(WXAUTOREG)
            {
                $wxuser = $this->wxpay->getUserInfo();
                $username = 'wx_'.uniqid();
                $defaultgroup = $this->user->getDefaultGroup();
                $args = array(
                    'useropenid' => $openid,
                    'usertruename' => $wxuser['nickname'],
                    'username' => $username,
                    'useremail' => $username.EP,
                    'usergroupid' => $defaultgroup['groupid'],
                    'userpassword' => md5($username),
                    'userphoto' => $wxuser['headimgurl']
                );
                $this->user->insertUser($args);
                $user = $this->user->getUserByOpenId($openid);
                $args = array(
                    'wxsid' => $sessionid,
                    'wxinfo' => $user,
                    'wxtime' => TIME,
                    'wxtoken' => md5($sessionid.CS)
                );
                $this->login->addLogin($args);
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
        $this->tpl->assign("user",$user);
        $this->tpl->display('pclogin');
    }

    private function bindlogin()
    {
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
            if($user['userid'])
            {
                if($user['userpassword'] == md5($args['userpassword']))
                {
                    $this->user->modifyUserInfo($user['userid'],array('useropenid' => $_SESSION['bindopenid']));
                    if($_SESSION['bindtype'] == 'pc')
                    {
                        $args = array(
                            'wxsid' => $_SESSION['autosessionid'],
                            'wxinfo' => $user,
                            'wxtime' => TIME,
                            'wxtoken' => md5($_SESSION['autosessionid'].CS)
                        );
                        $this->login->addLogin($args);
                        $_SESSION['bindopenid'] = null;
                        $_SESSION['bindtype'] = null;
                        $_SESSION['autosessionid'] = null;
                        $this->tpl->assign("user",$user);
                        $this->tpl->display('pclogin');
                    }
                    else
                    {
                        $app = M('apps','core')->getApp('user');
                        if($app['appsetting']['loginmodel'] == 1)$this->session->offOnlineUser($user['userid']);
                        $this->session->setSessionUser(array('sessionuserid'=>$user['userid'],'sessionpassword'=>$user['userpassword'],'sessionip'=>$this->ev->getClientIp(),'sessiongroupid'=>$user['usergroupid'],'sessionlogintime'=>TIME,'sessionusername'=>$user['username']));
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
            $this->tpl->display('login');
        }
    }

    private function bindregister()
    {
        $appid = 'user';
        $app = M('apps','core')->getApp($appid);
        $this->tpl->assign('app',$app);
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
        if($this->ev->get('userregister'))
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
            $args = $this->ev->get('args');
            $defaultgroup = $this->user->getDefaultGroup();
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
                $randcode = $this->ev->get('randcode');
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
            $user = $this->user->getUserByUserName($username);
            if($user)
            {
                $message = array(
                    'statusCode' => 300,
                    "message" => "用户已经存在"
                );
                \PHPEMS\ginkgo::R($message);
            }
            $email = $args['useremail'];
            $user = $this->user->getUserByEmail($email);
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
            $id = $this->user->insertUser($fargs);
            $user = $this->user->getUserById($id);
            if($_SESSION['bindtype'] == 'pc')
            {
                $args = array(
                    'wxsid' => $_SESSION['autosessionid'],
                    'wxinfo' => $user,
                    'wxtime' => TIME,
                    'wxtoken' => md5($_SESSION['autosessionid'].CS)
                );
                $this->login->addLogin($args);
                $_SESSION['bindopenid'] = null;
                $_SESSION['bindtype'] = null;
                $_SESSION['autosessionid'] = null;
                $this->tpl->assign("user",$user);
                $this->tpl->display('pclogin');
            }
            else
            {
                $this->session->setSessionUser(array('sessionuserid'=>$user['userid'],'sessionpassword'=>$user['userpassword'],'sessionip'=>$this->ev->getClientIp(),'sessiongroupid'=>$user['usergroupid'],'sessionlogintime'=>TIME,'sessionusername'=>$user['username']));
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
            $this->tpl->assign('forms',$forms);
            $this->tpl->display('register');
        }
    }

	private function getopenid()
    {
        if($this->_user['sessionuserid'])
        {
            header("location:index.php");
            exit;
        }
        $openid = $this->wxpay->getwxopenid();
        $user = $this->user->autoLoginWxUser($openid);
        if(!$user)
        {
            if(WXAUTOREG)
            {
                $wxuser = $this->wxpay->getUserInfo();
                $username = 'wx_'.uniqid();
                $defaultgroup = $this->user->getDefaultGroup();
                $args = array(
                    'useropenid' => $openid,
                    'usertruename' => $wxuser['nickname'],
                    'username' => $username,
                    'useremail' => $username.EP,
                    'usergroupid' => $defaultgroup['groupid'],
                    'userpassword' => md5($username),
                    'userphoto' => $wxuser['headimgurl']
                );
                $this->user->insertUser($args);
                $user = $this->user->autoLoginWxUser($openid);
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
