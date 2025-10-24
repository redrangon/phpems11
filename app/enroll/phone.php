<?php
namespace PHPEMS;
class app
{
	public $G;

	public function __construct()
	{
		$this->ev = M('ev');
		$this->tpl = M('tpl');
		
		

		$this->db = M('pdodb');
		$this->pg = M('pg');
		$this->html = M('html');
		$this->files = M('files');
		$this->session = M('session');
		$this->category = M('category');
		$this->course = M('course','course');
		$this->content = M('content','content');
		$this->user = M('user','user');
		$this->_user = $_user = $this->session->getSessionUser();
        if(!$this->_user['sessionuserid'])
        {
            $message = array(
                'statusCode' => 301,
                "message" => "请您重新登录",
                "callbackType" => 'forward',
                "forwardUrl" => "index.php?user-phone-login"
            );
            \PHPEMS\ginkgo::R($message);
        }
		$this->tpl->assign('_user',$this->user->getUserById($this->_user['sessionuserid']));
		$rcats = $this->category->getCategoriesByArgs(array(array("AND","catparent = '0'")));
		$this->tpl->assign('rcats',$rcats);
		$this->tpl->assign('userhash',$this->ev->get('userhash'));
	}
}

?>