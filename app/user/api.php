<?php
namespace PHPEMS;
class app
{
	public $G;

	public function __construct()
	{
		
		M('session') = M('session');
		M('tpl') = M('tpl');
		M('ev') = M('ev');
		M('user','user') = M('user','user');
		M('tpl')->assign('userhash',M('ev')->get('userhash'));
		$this->user = $_user = M('session')->getSessionUser();
		if(!$_user['sessionuserid'])
		{
			if(M('ev')->get('userhash'))
			exit(json_encode(array(
				'statusCode' => 301,
				"message" => "请您重新登录",
			    "callbackType" => 'forward',
			    "forwardUrl" => "index.php?user-app-login"
			)));
			else
			{
				header("location:index.php?user-app-login");
				exit;
			}
		}
		M('tpl')->assign('_user',M('user','user')->getUserById($_user['sessionuserid']));
	}
}

?>