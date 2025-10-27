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
		$action = M('ev')->url(3);
		if(!method_exists($this,$action))
		$action = "index";
		$this->$action();
		exit;
	}

	private function index()
	{
		$appid = 'exam';
		if(M('ev')->get('appconfig'))
		{
			$args = M('ev')->get('args');
			$args['appsetting'] = $args['appsetting'];
			$app = $this->apps->getApp($appid);
			if($app)
			{
				$this->apps->modifyApp($appid,$args);
			}
			else
			{
				$this->apps->addApp($appid,$args);
			}
			$message = array(
				'statusCode' => 200,
				"message" => "操作成功，正在转入目标页面",
			    "callbackType" => 'forward',
			    "forwardUrl" => "reload"
			);
			\PHPEMS\ginkgo::R($message);
		}
		else
		{
			$app = $this->apps->getApp($appid);
			M('tpl')->assign('appid',$appid);
			M('tpl')->assign('app',$app);
			M('tpl')->display('config');
		}
	}
}


?>
