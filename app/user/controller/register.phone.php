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

    private function findpassword()
    {
        $appid = 'user';
        $app = M('apps','core')->getApp($appid);
        $this->tpl->assign('app',$app);
        if(!$app['appsetting']['emailverify'])
        {
            $message = array(
                'statusCode' => 300,
                "message" => "开通邮箱验证才能找回密码"
            );
            \PHPEMS\ginkgo::R($message);
        }
        if($this->ev->get('findpassword'))
        {
            $randcode = $this->ev->get('randcode');
            if((!$randcode) || ($randcode != $_SESSION['phonerandcode']['findpassword']))
            {
                $message = array(
                    'statusCode' => 300,
                    "message" => "验证码错误"
                );
                \PHPEMS\ginkgo::R($message);
            }
            else
            {
                $_SESSION['phonerandcode']['findpassword'] = 0;
            }
            $args = $this->ev->get('args');
            $username = $args['username'];
            $user = $this->user->getUserByUserName($username);
            if(!$user)
            {
                $message = array(
                    'statusCode' => 300,
                    "message" => "此用户未注册"
                );
                \PHPEMS\ginkgo::R($message);
            }
            if(($user['useremail'] != $args['useremail']) || ($user['useremail'] != $_SESSION['phonerandcode']['email']))
            {
                $message = array(
                    'statusCode' => 300,
                    "message" => "邮箱与用户不对应"
                );
                \PHPEMS\ginkgo::R($message);
            }
            $this->user->modifyUserPassword($user['userid'],array('password' => $args['userpassword']));
            $message = array(
                'statusCode' => 200,
                "message" => "密码修改成功",
                "callbackType" => 'forward',
                "forwardUrl" => "index.php?user-phone-login"
            );
            \PHPEMS\ginkgo::R($message);
        }
        else
        {
            $this->tpl->display('findpassword');
        }
    }

	private function index()
	{
		$appid = 'user';
		$app = M('apps','core')->getApp($appid);
		$this->tpl->assign('app',$app);
		$fields = array();
		$tpfields = explode(',',$app['appsetting']['regfields']);
		foreach($tpfields as $f)
		{
			$tf = $this->module->getFieldByNameAndModuleid($f);
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
			$id = $this->user->insertUser($fargs);
			$this->session->setSessionUser(array('sessionuserid'=>$id,'sessionpassword'=>md5($args['userpassword']),'sessionip'=>$this->ev->getClientIp(),'sessiongroupid'=>$defaultgroup['groupid'],'sessionlogintime'=>TIME,'sessionusername'=>$username));
			$message = array(
				'statusCode' => 200,
				"message" => "操作成功",
			    "callbackType" => 'forward',
			    "forwardUrl" => "index.php?core-phone"
			);
			\PHPEMS\ginkgo::R($message);
		}
		else
		{
			$forms = $this->html->buildHtml($fields);
			$this->tpl->assign('forms',$forms);
			$this->tpl->display('register');
		}
	}
}


?>
