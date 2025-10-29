<?php
namespace PHPEMS;
class app
{
    public $user;
    public $session;
    public $modules;

    public function __construct()
    {
        $this->session = M('session')->getSessionUser();
        if(!$this->session['sessionuserid'])
        {
            $message = array(
                'statusCode' => 301,
                "message" => "请您重新登录",
                "callbackType" => 'forward',
                "forwardUrl" => "index.php?user-app-login"
            );
            R($message);
        }
        $this->user = M('user','user')->getUserById($this->session['sessionuserid']);
        $this->modules = M('module')->getModulesByApp('course');
        M('tpl')->assign('modules',$this->modules);
        M('tpl')->assign('_user',$this->user);
        M('tpl')->assign('navs',M('nav','core')->getWebNavs());
    }
}

?>