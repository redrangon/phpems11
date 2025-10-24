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
		$this->user = M('user','user');
		$this->survey = M('survey','survey');
        $this->config = M('config','survey');
		$this->_user = $_user = $this->session->getSessionUser();
        if(!$this->_user['sessionuserid'])
        {
            $message = array(
                'statusCode' => 301,
                "message" => "请您重新登陆",
                "callbackType" => 'forward',
                "forwardUrl" => "index.php?user-app-login"
            );
            ginkgo::R($message);
        }
		$this->tpl->assign('_user',$this->user->getUserById($this->_user['sessionuserid']));
		$rcats = $this->category->getCategoriesByArgs(array(array("AND","catparent = '0'")));
		$this->tpl->assign('selectors',$this->config->selectors);
		$this->tpl->assign('rcats',$rcats);
        $this->tpl->assign('navs',M('nav','core')->getWebNavs());
	}
}
?>