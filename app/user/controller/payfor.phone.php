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
		$action = $this->ev->url(3);
		if(!method_exists($this,$action))
		$action = "index";
		$this->$action();
		exit;
	}

	private function gomorder()
	{
		if($this->_user['sessiongroupid'])
		{
			$page = $this->ev->get('page');
			$args = array();
			$orders = $this->order->getOrderList($args,$page);
			$this->tpl->assign('orders',$orders);
			$this->tpl->display('payfor_gorder');
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
		if($this->_user['sessiongroupid'])
		{
			$ordersn = $this->ev->get('ordersn');
			$order = $this->order->getOrderById($ordersn);
			$this->tpl->assign('order',$order);
			$this->tpl->display('payfor_morder');
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
		$ordersn = $this->ev->get('ordersn');
		$order = $this->order->getOrderById($ordersn,$this->_user['sessionuserid']);
		if($order['orderstatus'] == 3)
		{
			$this->order->modifyOrder($ordersn,array('orderstatus' => 4));
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
		$ordersn = $this->ev->get('ordersn');
		$order = $this->order->getOrderById($ordersn,$this->_user['sessionuserid']);
		$agent = $this->ev->isWeixin();
		if($order['orderapp'] == 'item')
		{
			$modules = $this->module->getModulesByApp('item');
			$mfields = array();
			foreach($modules as $p)
			{
				$mfields[$p['moduleid']] = $this->module->getMoudleFields($p['moduleid'],1,false,'item');
			}
			$this->tpl->assign('mfields',$mfields);
		}
		if($order['orderstatus'] == 1 && $agent == 'wxapp')
		{
			$wxpay = M('wxpay');
			$result = $wxpay->outJsPay($order);
			$this->tpl->assign('jsApiParameters', $result);
		}
		$this->tpl->assign('agent',$agent);
		$this->tpl->assign('order',$order);
		$this->tpl->display('payfor_wxpay');
	}

	private function ispayfor()
	{
		$ordersn = $this->ev->get('ordersn');
		$order = $this->order->getOrderById($ordersn,$this->_user['sessionuserid']);
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
		$oid = $this->ev->get('ordersn');
		$order = $this->order->getOrderById($oid,$this->_user['sessionuserid']);
		if($order['orderstatus'] == 1)
		{
			$this->order->delOrder($oid);
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
		$oid = $this->ev->get('ordersn');
		if(!$oid)
		{
			$message = array(
				'statusCode' => 300,
				"message" => "非法参数"
			);
			\PHPEMS\ginkgo::R($message);
		}
		$order = $this->order->getOrderById($oid,$this->_user['sessionuserid']);
		if(WXPAY && $this->ev->isWeixin() && $order['orderstatus'] == 1)
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
			$modules = $this->module->getModulesByApp('item');
			$mfields = array();
			foreach($modules as $p)
			{
				$mfields[$p['moduleid']] = $this->module->getMoudleFields($p['moduleid'],1,false,'item');
			}
			$this->tpl->assign('mfields',$mfields);
		}
		if($order['orderstatus'] == 1)
		{
			if(ALIPAY)
			{
				$alipay = M('alipay');
				$payforurl = $alipay->createWapPayLink($order,WP.'/api/alinotify.php',WP.'/api/alireturn.php');
				$this->tpl->assign('payforurl',$payforurl);
			}
			if(WXPAY)
			{
				$wxpay = M('wxpay');
				$result = $wxpay->outMwebUrl($order);
				$this->tpl->assign('result',$result);
			}
		}
		$this->tpl->assign('order',$order);
		$this->tpl->display('payfor_detail');
	}

	public function orders()
	{
		$search = $this->ev->get('search');
		$page = $this->ev->get('page');
		$args = array(array("AND","orderuserid = :orderuserid",'orderuserid',$this->_user['sessionuserid']));
		if($search['ordersn'])
		{
			$args[] = array("AND","ordersn = :ordersn",'ordersn',$search['ordersn']);
		}
		$myorders = $this->order->getOrderList($args,$page);
		if($myorders['number'] < 1)
		{
			$message = array(
				'statusCode' => 300,
				"message" => "未查询到订单"
			);
			\PHPEMS\ginkgo::R($message);
		}
		$this->tpl->assign('search',$search);
		$this->tpl->assign('orders',$myorders);
		$this->tpl->display('payfor_orders');
	}

	public function index()
	{
		if($this->ev->get('payforit'))
		{
			$money = intval($this->ev->get('money'));
			$paytype = $this->ev->get('paytype');
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
			$args['orderuserid'] = $this->_user['sessionuserid'];
			$args['ordercreatetime'] = TIME;
			$args['orderuserinfo'] = array('username' => $this->_user['sessionusername']);
			$this->order->addOrder($args);
			if($this->ev->isWeixin())
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
			$page = $this->ev->get('page');
			$args = array(array("AND","orderuserid = :orderuserid",'orderuserid',$this->_user['sessionuserid']));
			$myorders = $this->order->getOrderList($args,$page);
            $this->tpl->assign('iswx',$this->ev->isWeixin());
			$this->tpl->assign('orders',$myorders);
			$this->tpl->display('payfor');
		}
	}
}


?>
