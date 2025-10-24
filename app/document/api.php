<?php
namespace PHPEMS;
class app
{
	public $G;
	private $sc = 'testSys&dongao';

	public function __construct()
	{
		
		$this->ev = M('ev');
		$this->files = M('files');
		$this->session = M('session');
		$this->user = M('user','user');
		$this->apps = M('apps','core');
		$_user = $this->_user = $this->session->getSessionUser();
		$group = $this->user->getGroupById($_user['sessiongroupid']);
		if(!$_user['sessionuserid'])
		{
            $message = array(
                'statusCode' => 300,
                "message" => "请您重新登录",
                "callbackType" => 'forward',
                "forwardUrl" => "index.php?user-app-login"
            );
            \PHPEMS\ginkgo::R($message);
		}
		$this->attach = M('attach','document');
		$this->allowexts = $this->attach->getAllowAttachExts();
        $this->forbidden = array('rpm','exe','hta','php','phpx','asp','aspx','jsp');
		//$this->allowexts = array('zip','jpg','rar','png','gif','mp3','mp4','ogg','webm');
	}
}

?>