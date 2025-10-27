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
        $this->user = M('user','user')->getUserById($this->session['sessionuserid']);
        if($this->user['groupid'] != 1)
        {
            $message = array(
                'statusCode' => 300,
                "message" => "请您重新登录",
                "callbackType" => 'forward',
                "forwardUrl" => "index.php?core-master-login"
            );
            R($message);
        }
        $localapps = M('apps','core')->getLocalAppList();
        $apps = M('apps','core')->getAppList();
        if(!in_array(ginkgo::$app,$this->user['manager_apps']) && $apps['user']['appsetting']['managemodel'])
        {
            header("location:index.php?core-master");
            exit();
        }
        $this->modules = M('module')->getModulesByApp('course');
        M('tpl')->assign('sectionorder',M('config','exam')->sectionorder);
        M('tpl')->assign('ols',M('config','exam')->ols);
        M('tpl')->assign('localapps',$localapps);
        M('tpl')->assign('apps',$apps);
        M('tpl')->assign('_user',$this->user);
        M('tpl')->assign('modules',$this->modules);
    }
}

?>