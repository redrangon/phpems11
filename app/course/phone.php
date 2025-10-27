<?php
namespace PHPEMS;
class app
{
    public $user;
    public $session;

    public function __construct()
    {
        $this->session = M('session')->getSessionUser();
        if(!$this->session['sessionuserid'])
        {
            $message = array(
                'statusCode' => 301,
                "message" => "请您重新登录",
                "callbackType" => 'forward',
                "forwardUrl" => "index.php?user-phone-login"
            );
            R($message);
        }
        $this->user = M('user','user')->getUserById($this->session['sessionuserid']);
        M('tpl')->assign('_user',$this->user);
    }
}

?>