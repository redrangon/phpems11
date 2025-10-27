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

	private function finish()
	{
		$ordersn = M('ev')->get('ordersn');
		$order = M('orders','bank')->getOrderById($ordersn,$this->user['userid']);
		if($order['orderstatus'] == 3)
		{
			M('orders','bank')->modifyOrder($ordersn,array('orderstatus' => 4));
			$message = array(
				'statusCode' => 200,
				"message" => "订单设置成功",
				"callbackType" => 'forward',
				"forwardUrl" => "reload"
			);
			\PHPEMS\ginkgo::R($message);
		}
		else
		{
			$message = array(
				'statusCode' => 300,
				"message" => "订单操作失败"
			);
			\PHPEMS\ginkgo::R($message);
		}
	}
	
	private function alipay()
	{
		$ordersn = M('ev')->get('ordersn');
		$order = M('orders','bank')->getOrderById($ordersn,$this->user['userid']);
		$alipay = M('alipay');	
		if($order['orderstatus'] == 1)
		{
			try{
				$payforurl = $alipay->createPagePayLink($order,WP.'api/alinotify.php',WP.'api/alireturn.php');
				$message = array(
					'statusCode' => 200,
					"callbackType" => 'forward',
					"forwardUrl" => $payforurl
				);
			}catch(\Exception $e){
				$message = array(
					'statusCode' => 300,
					"message" => "订单错误，稍后重试"
				);
			}			
		}
		else
		$message = array(
			'statusCode' => 300,
			"message" => "订单错误，请联系管理员"
		);
		\PHPEMS\ginkgo::R($message);
	}

	private function wxpay()
	{
		$ordersn = M('ev')->get('ordersn');
		$order = M('orders','bank')->getOrderById($ordersn,$this->user['userid']);
		$wxpay = M('wxpay');
		$result = $wxpay->outNativeUrl($order);
		M('tpl')->assign('order',$order);
		M('tpl')->assign('result',$result);
		M('tpl')->assign('img',M('peqr')->pngString($result['code_url']));
		M('tpl')->display('payfor_wxpay');
	}

	private function ispayfor()
	{
		$ordersn = M('ev')->get('ordersn');
		$order = M('orders','bank')->getOrderById($ordersn,$this->user['userid']);
		if($order['orderstatus'] == 2)
		{
			$message = array(
				'statusCode' => 200,
				"message" => "订单支付成功",
			    "callbackType" => 'forward',
			    "forwardUrl" => "index.php?user-app-payfor-orderdetail&ordersn=".$ordersn
			);
		}
		else
		$message = array(
			'statusCode' => 300,
			"message" => "订单未支付成功，请刷新页面重新支付"
		);
		\PHPEMS\ginkgo::R($message);
	}

	private function remove()
	{
		$oid = M('ev')->get('ordersn');
		$order = M('orders','bank')->getOrderById($oid,$this->user['userid']);
		if($order['orderstatus'] == 1)
		{
			M('orders','bank')->delOrder($oid);
			$message = array(
				'statusCode' => 200,
				"message" => "订单删除成功",
			    "callbackType" => 'forward',
			    "forwardUrl" => "reload"
			);
		}
		else
		$message = array(
			'statusCode' => 300,
			"message" => "订单操作失败"
		);
		\PHPEMS\ginkgo::R($message);
	}

	private function orderdetail()
	{
		$oid = M('ev')->get('ordersn');
		if(!$oid)exit(header("location:index.php?user-app"));
		$order = M('orders','bank')->getOrderById($oid,$this->user['userid']);
		if($order['orderapp'] == 'item')
		{
			$modules = M('module')->getModulesByApp('item');
			$mfields = array();
			foreach($modules as $p)
			{
				$mfields[$p['moduleid']] = M('module')->getMoudleFields($p['moduleid'],1,false,'item');
			}
			M('tpl')->assign('mfields',$mfields);
		}		
		M('tpl')->assign('order',$order);
		M('tpl')->display('payfor_detail');
	}

	public function index()
	{
		if(M('ev')->get('payforit'))
		{
			$money = intval(M('ev')->get('money'));
			if($money < 1)
			{
				$message = array(
					'statusCode' => 300,
					"message" => "最少需要充值1元"
				);
				\PHPEMS\ginkgo::R($message);
			}
			$args = array();
			$args['orderprice'] = $money;
			$args['ordertitle'] = "考试系统充值 {$args['orderprice']} 元";
			$args['ordersn'] = date('YmdHis').rand(100,999);
			$args['orderstatus'] = 1;
			$args['orderuserid'] = $this->user['userid'];
			$args['ordercreatetime'] = TIME;
			$args['orderuserinfo'] = array('username' => $this->user['sessionusername']);
			M('orders','bank')->addOrder($args);
			$message = array(
				'statusCode' => 200,
				"message" => "订单创建成功",
				'ordersn' => $args['ordersn'],
			    "callbackType" => 'forward',
			    "forwardUrl" => "index.php?user-app-payfor-orderdetail&ordersn=".$args['ordersn']
			);
			\PHPEMS\ginkgo::R($message);
		}
		else
		{
			$page = M('ev')->get('page');
			$args = array(array("AND","orderuserid = :orderuserid",'orderuserid',$this->user['userid']));
			$myorders = M('orders','bank')->getOrderList($args,$page);
			M('tpl')->assign('orders',$myorders);
			M('tpl')->display('payfor');
		}
	}
}


?>
