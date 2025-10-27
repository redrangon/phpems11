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

	private function gomorder()
	{
		if($this->user['sessiongroupid'])
		{
			$page = M('ev')->get('page');
			$args = array();
			$orders = M('orders','bank')->getOrderList($args,$page);
			M('tpl')->assign('orders',$orders);
			M('tpl')->display('payfor_gorder');
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

	private function morder()
	{
		if($this->user['sessiongroupid'])
		{
			$ordersn = M('ev')->get('ordersn');
			$order = M('orders','bank')->getOrderById($ordersn);
			M('tpl')->assign('order',$order);
			M('tpl')->display('payfor_morder');
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

	private function wxpay()
	{
		$ordersn = M('ev')->get('ordersn');
		$order = M('orders','bank')->getOrderById($ordersn,$this->user['userid']);
		$agent = M('ev')->isWeixin();
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
		if($order['orderstatus'] == 1 && $agent == 'wxapp')
		{
			$wxpay = M('wxpay');
			$result = $wxpay->outJsPay($order);
			M('tpl')->assign('jsApiParameters', $result);
		}
		M('tpl')->assign('agent',$agent);
		M('tpl')->assign('order',$order);
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
			    "forwardUrl" => "index.php?user-center-payfor-orderdetail&ordersn=".$ordersn
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
	
	public function orderdetail()
	{
		$oid = M('ev')->get('ordersn');
		if(!$oid)
		{
			$message = array(
				'statusCode' => 300,
				"message" => "非法参数"
			);
			\PHPEMS\ginkgo::R($message);
		}
		$order = M('orders','bank')->getOrderById($oid,$this->user['userid']);
		if(WXPAY && M('ev')->isWeixin() && $order['orderstatus'] == 1)
		{
			$message = array(
				'statusCode' => 200,
				"callbackType" => 'forward',
				"forwardUrl" => "index.php?user-phone-payfor-wxpay&ordersn=".$oid
			);
			\PHPEMS\ginkgo::R($message);
		}
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
		if($order['orderstatus'] == 1)
		{
			if(ALIPAY)
			{
				$alipay = M('alipay');
				$payforurl = $alipay->createWapPayLink($order,WP.'/api/alinotify.php',WP.'/api/alireturn.php');
				M('tpl')->assign('payforurl',$payforurl);
			}
			if(WXPAY)
			{
				$wxpay = M('wxpay');
				$result = $wxpay->outMwebUrl($order);
				M('tpl')->assign('result',$result);
			}
		}
		M('tpl')->assign('order',$order);
		M('tpl')->display('payfor_detail');
	}

	public function orders()
	{
		$search = M('ev')->get('search');
		$page = M('ev')->get('page');
		$args = array(array("AND","orderuserid = :orderuserid",'orderuserid',$this->user['userid']));
		if($search['ordersn'])
		{
			$args[] = array("AND","ordersn = :ordersn",'ordersn',$search['ordersn']);
		}
		$myorders = M('orders','bank')->getOrderList($args,$page);
		if($myorders['number'] < 1)
		{
			$message = array(
				'statusCode' => 300,
				"message" => "未查询到订单"
			);
			\PHPEMS\ginkgo::R($message);
		}
		M('tpl')->assign('search',$search);
		M('tpl')->assign('orders',$myorders);
		M('tpl')->display('payfor_orders');
	}

	public function index()
	{
		if(M('ev')->get('payforit'))
		{
			$money = intval(M('ev')->get('money'));
			$paytype = M('ev')->get('paytype');
			if($paytype != 'alipay')$paytype = 'wxpay';
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
			if(M('ev')->isWeixin())
			{
                $message = array(
                    'statusCode' => 200,
                    "message" => "订单创建成功",
                    "callbackType" => 'forward',
                    "forwardUrl" => "index.php?user-phone-payfor-orderdetail&ordersn=".$args['ordersn']
                );
			}
			else
			{
				if($paytype == 'alipay')
				{
					$alipay = M('alipay');
					$payforurl = $alipay->outPhonePayForUrl($args,WP.'/api/alinotify.php',WP.'/api/alireturn.php');
                    $message = array(
                        'statusCode' => 201,
                        "message" => "订单创建成功",
                        "callbackType" => 'forward',
                        "forwardUrl" => $payforurl
                    );
				}
				else
				{
					$wxpay = M('wxpay');
                    $result = $wxpay->outMwebUrl($args);
                    if($result['return_code'] == 'FAIL')
					$message = array(
						'statusCode' => 300,
						"message" => $result['return_msg'],
						"result" => $result
					);
                    else
					$message = array(
                        'statusCode' => 201,
                        "message" => "订单创建成功",
                        "callbackType" => 'forward',
                        "forwardUrl" => $result['mweb_url']
                    );
				}
			}
			\PHPEMS\ginkgo::R($message);
		}
		else
		{
			$page = M('ev')->get('page');
			$args = array(array("AND","orderuserid = :orderuserid",'orderuserid',$this->user['userid']));
			$myorders = M('orders','bank')->getOrderList($args,$page);
            M('tpl')->assign('iswx',M('ev')->isWeixin());
			M('tpl')->assign('orders',$myorders);
			M('tpl')->display('payfor');
		}
	}
}


?>
