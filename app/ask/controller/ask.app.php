<?php
 namespace PHPEMS;
/*
 * Created on 2016-5-19
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
class action extends app
{
	public function display()
	{
		$this->coin = 20;
		if(!$this->_user['sessionuserid'])
		{
			$message = array(
				'statusCode' => 301,
				"message" => "请您重新登录",
				"callbackType" => 'forward',
				"forwardUrl" => "index.php?user-app-login"
			);
			\PHPEMS\ginkgo::R($message);
		}
		$action = $this->ev->url(3);
		if(!method_exists($this,$action))
		$action = "index";
		$this->$action();
		exit;
	}

	public function index()
	{
		if($this->ev->get('submit'))
		{
			$user = $this->user->getUserById($this->_user['sessionuserid']);
			if($user['usercoin'] < $this->coin)
			{
				$message = array(
					'statusCode' => 300,
					"message" => "积分不足，不能提问"
				);
				\PHPEMS\ginkgo::R($message);
			}
			$coin = $user['usercoin'] - $this->coin;
			$args = $this->ev->get('args');
			$args['askcontent'] = M('safe')->tidyHtml($args['askcontent']);
			$args['askuserid'] = $this->_user['sessionuserid'];
			$this->ask->addAsk($args);
			$this->user->modifyUserInfo($this->_user['sessionuserid'],array("usercoin" => $coin));
			$message = array(
				'statusCode' => 200,
				"message" => "提问成功，请等待管理员回复",
				"callbackType" => 'forward',
				"forwardUrl" => "index.php?user-app-ask"
			);
			\PHPEMS\ginkgo::R($message);
		}
		else
		{
		    $this->tpl->display('ask');
        }
	}
}


?>
