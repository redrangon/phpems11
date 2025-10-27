<?php
namespace PHPEMS;
class app
{
	public $G;

	public function __construct()
	{
		
		M('ev') = M('ev');
		M('tpl') = M('tpl');
		
		M('pepdo') = M('pepdo');
		$this->pg = M('pg');
		M('module') = M('module');
		M('html') = M('html');
		M('session') = M('session');
		M('user','user') = M('user','user');
		$groups = M('user','user')->getUserGroups();
		M('tpl')->assign('groups',$groups);
		M('tpl')->assign('userhash',M('ev')->get('userhash'));
		$this->user = $_user = M('session')->getSessionUser();
		M('orders','bank') = M('orders','bank');
		if(!$_user['sessionuserid'] && !in_array(M('ev')->url(2),array('register','login')))
		{
			$message = array(
				'statusCode' => 301,
				"message" => "请您重新登录",
			    "callbackType" => 'forward',
			    "forwardUrl" => "index.php?user-phone-login"
			);
			\PHPEMS\ginkgo::R($message);
		}
        $groups = M('user','user')->getUserGroups();
        M('tpl')->assign('groups',$groups);
        M('tpl')->assign('userhash',M('ev')->get('userhash'));
        M('orders','bank')tatus = array(1=>'待支付',2=>'待发货',3=>'待收货',4 => '已完成',99 =>'已取消');
        $this->status = array('申请中','已受理','已出证','申请被驳回');
        M('tpl')->assign('orderstatus',M('orders','bank')tatus);
        M('tpl')->assign('status',$this->status);
	}
}

?>