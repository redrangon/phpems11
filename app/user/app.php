<?php

namespace PHPEMS;

class app
{
    public $user;
    public $session;
    public $setting;
    public $data = array();

    public function __construct()
    {

        $this->session = M('session')->getSessionUser();
        if($this->session['sessionuserid'])
        {
            $this->user = M('user','user')->getUserById($this->session['sessionuserid']);
            switch(M('ev')->url(2))
            {
                case 'login':
                case 'register':
                    $message = array(
                        'statusCode' => 200,
                        "callbackType" => 'forward',
                        "forwardUrl" => "index.php?".\PHPEMS\ginkgo::$defaultApp
                    );
                    \PHPEMS\ginkgo::R($message);
                    break;

                default:
                    break;
            }
        }
        else
        {
            switch(M('ev')->url(2))
            {
                case 'login':
                case 'register':
                    break;

                default:
                    $message = array(
                        'statusCode' => 301,
                        "message" => "请您登录",
                        "callbackType" => 'forward',
                        "forwardUrl" => "index.php?user-app-login"
                    );
                    \PHPEMS\ginkgo::R($message);
                    break;
            }
        }
        M('tpl')->assign('_user',$this->user);
        M('tpl')->assign('navs',M('nav','core')->getWebNavs());
		M('tpl')->assign('orderstatus',M('config','bank')->orderstatus);
		M('tpl')->assign('navs',M('nav','core')->getWebNavs());
	}
}

?>