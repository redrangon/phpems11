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
        M('tpl')->assign('navs',M('nav','core')->getWebNavs());
        if(!$this->data['openbasics'])
        {
            $this->data['openbasics'] = M('basic','exam')->getOpenBasicsByUserid($this->user['userid']);
        }
        if(!$this->user['sessioncurrent'] || !$this->data['openbasics'][$this->user['sessioncurrent']])
        {
            $this->data['currentbasic'] = current($this->data['openbasics']);
            $this->user['sessioncurrent'] = $this->data['currentbasic']['basicid'];
            M('session')->setSessionValue(array('sessioncurrent'=>$this->user['sessioncurrent']));
        }
        else
            $this->data['currentbasic'] = $this->data['openbasics'][$this->user['sessioncurrent']];
        $app = M('apps','core')->getApp('exam');
        $this->setting = $app['appsetting'];
        M('tpl')->assign('ols',M('config','exam')->ols);
        M('tpl')->assign('selectorder',M('config','exam')->selectorder);
        M('tpl')->assign('data',$this->data);
        if($this->data['currentbasic']['basicexam']['model'] == 2)
        {
            if(M('ev')->url('2') && !in_array(M('ev')->url('2'),array('index','basics','exam','recover','history')))
            {
                header("location:index.php?exam-phone-exam");
                exit;
            }
        }
    }
}

?>