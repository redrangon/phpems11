<?php
namespace PHPEMS;
class app
{
	public $G;

    public function __construct()
    {

        $this->ev = M('ev');
        $this->tpl = M('tpl');
        $this->session = M('session');
        $this->category = M('category');
        $this->course = M('course','course');
        $this->content = M('content','course');
        $this->user = M('user','user');
        $this->_user = $_user = $this->session->getSessionUser();
        if(!$this->_user['sessionuserid'])
        {
            if($this->ev->get('userhash'))
                exit(json_encode(array(
                    'statusCode' => 301,
                    "message" => "请您重新登陆",
                    "callbackType" => 'forward',
                    "forwardUrl" => "index.php?user-phone-login"
                )));
            else
            {
                header("location:index.php?user-app-login");
                exit;
            }
        }
        $this->tpl->assign('_user',$this->user->getUserById($this->_user['sessionuserid']));
        $this->rcats = $rcats = $this->category->getCategoriesByArgs("catparent  = '0'");
        $this->tpl->assign('rcats',$rcats);
        $this->tpl->assign('userhash',$this->ev->get('userhash'));
        $this->log = M('log','course');
        $this->tpl->assign('navs',M('nav','core')->getWebNavs());
        $this->module = M('module');
        $modules = $this->module->getModulesByApp('course');
        $this->tpl->assign('modules',$modules);
    }
}

?>