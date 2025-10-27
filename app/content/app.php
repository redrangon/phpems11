<?php
namespace PHPEMS;
class app
{
    public $user;
    public $session;

    public function __construct()
    {
        $this->session = M('session')->getSessionUser();
        $this->user = M('user','user')->getUserById($this->session['sessionuserid']);
        M('tpl')->assign('_user',$this->user);
        M('tpl')->assign('navs',M('nav','core')->getWebNavs());
    }
}
?>