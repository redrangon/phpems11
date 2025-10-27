<?php
namespace PHPEMS;
class app
{
    public $user;
    public $session;
    public $allowexts;

    public function __construct()
    {
        $this->session = M('session')->getSessionUser();
        if(!$this->session['sessionuserid'])
        {
            $message = array(
                'statusCode' => 300,
                "message" => "请您重新登录",
                "callbackType" => 'forward',
                "forwardUrl" => "index.php?core-master-login"
            );
            R($message);
        }
        $this->user = M('user','user')->getUserById($this->session['sessionuserid']);
        $this->allowexts = M('attach','document')->getAllowAttachExts();
    }
}

?>