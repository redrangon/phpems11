<?php
namespace PHPEMS;
class app
{
    public $user;
    public $session;
    public $teachsubjects;

    public function __construct()
    {
        $this->session = M('session')->getSessionUser();
        $this->user = M('user','user')->getUserById($this->session['sessionuserid']);
        if(!$this->user['teacher_subjects'])
        {
            $message = array(
                'statusCode' => 301,
                "message" => "请您重新登录",
                "callbackType" => 'forward',
                "forwardUrl" => "index.php?user-app-login"
            );
            R($message);
        }
        //生产一个对象
        $this->teachsubjects = implode(',',$this->user['teacher_subjects']);
        M('tpl')->assign('_user',$this->user);
	}
}

?>