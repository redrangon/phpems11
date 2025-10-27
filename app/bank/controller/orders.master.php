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

	private function modifyorder()
	{
		$ordersn = M('ev')->get('ordersn');
		$order = M('orders','bank')->getOrderById($ordersn);
		$orderstatus = M('ev')->get('orderstatus');
		$reason = M('ev')->get('reason');
		if($orderstatus && $reason)
		{
			$faq = array();
			$faq['reason'] = $reason;
			$faq['prestatus'] = $order['orderstatus'];
			$faq['status'] = $orderstatus;
			$faq['username'] = $this->_user['sessionusername'];
			$faq['time'] = TIME;
			$args = array();
			$args['orderstatus'] = $orderstatus;
			$args['orderfaq'] = $order['orderfaq'];
			$args['orderfaq'][] = $faq;
			if($orderstatus == 4)
			{
				if(!$order['orderfinishtime'])
				{
					$args['orderfinishtime'] = TIME;
				}
			}
			M('orders','bank')->modifyOrderById($ordersn,$args);
			$message = array(
				'statusCode' => 200,
				"message" => "订单修改成功",
				"callbackType" => 'forward',
				"forwardUrl" => "reload"
			);
			\PHPEMS\ginkgo::R($message);
		}
		$message = array(
			'statusCode' => 300,
			"message" => "订单操作失败"
		);
		\PHPEMS\ginkgo::R($message);
	}
	
	private function setbill()
	{
		$ordersn = M('ev')->get('ordersn');
		$uploadfile = M('ev')->get('uploadfile');
		if($uploadfile)
		M('orders','bank')->modifyOrderById($ordersn,array('orderbill' => $uploadfile));
		$message = array(
			'statusCode' => 200,
			"message" => "订单修改成功",
			"callbackType" => 'forward',
			"forwardUrl" => "reload"
		);
		\PHPEMS\ginkgo::R($message);
	}

	private function sendorder()
	{
		$ordersn = M('ev')->get('ordersn');
		$order = M('orders','bank')->getOrderById($ordersn);
		if($order['orderstatus'] == 2)
		{
			$postname = M('ev')->get('postname');
			$postorder = M('ev')->get('postorder');
			if($postname && $postorder)
			{
				$args = array();
				$args['orderpost'] = array('postname' => $postname,'postorder' => $postorder);
				$args['ordersendtime'] = TIME;
				$args['orderfactfee'] = M('ev')->get('orderfactfee');;
				$args['orderstatus'] = 3;
				M('orders','bank')->modifyOrderById($ordersn,$args);
				$message = array(
					'statusCode' => 200,
					"message" => "订单发货成功",
					"callbackType" => 'forward',
					"forwardUrl" => "reload"
				);
				\PHPEMS\ginkgo::R($message);
			}
		}
		$message = array(
			'statusCode' => 300,
			"message" => "订单操作失败"
		);
		\PHPEMS\ginkgo::R($message);
	}

	private function orderdetail()
	{
		$ordersn = M('ev')->get('ordersn');
		$order = M('orders','bank')->getOrderById($ordersn);
		$modules = M('module')->getModulesByApp('item');
		$mfields = array();
		foreach($modules as $p)
		{
			$mfields[$p['moduleid']] = M('module')->getMoudleFields($p['moduleid'],1);
		}
		M('tpl')->assign('order',$order);
		M('tpl')->assign('mfields',$mfields);
		M('tpl')->display('orderdetail');
	}

	private function remove()
	{
		$oid = M('ev')->get('ordersn');
		$order = M('orders','bank')->getOrderById($oid);
		if($order['orderstatus'] == 1 || $order['orderstatus'] == 99)
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

	private function batremove()
	{
		$delids = M('ev')->get('delids');
		foreach($delids as $oid => $p)
		{
			$order = M('orders','bank')->getOrderById($oid);
			if($order['orderstatus'] == 1 || $order['orderstatus'] == 99)
			{
				M('orders','bank')->delOrder($oid);
			}
		}
		$message = array(
			'statusCode' => 200,
			"message" => "订单删除成功",
		    "callbackType" => 'forward',
		    "forwardUrl" => "reload"
		);
		\PHPEMS\ginkgo::R($message);
	}

	private function change()
	{
		$ordersn = M('ev')->get('ordersn');
		$orderstatus = M('ev')->get('orderstatus');
		$args = array('orderstatus' => $orderstatus);
		M('orders','bank')->modifyOrderById($ordersn,$args);
		$message = array(
			'statusCode' => 200,
			"message" => "操作成功",
		    "target" => "",
		    "rel" => "",
		    "callbackType" => "forward",
		    "forwardUrl" => "reload"
		);
		\PHPEMS\ginkgo::R($message);
	}

	public function index()
	{
		$search = M('ev')->get('search');
		$page = intval(M('ev')->get('page'));
		$u = '';
		if($search)
		{
			M('tpl')->assign('search',$search);
			foreach($search as $key => $arg)
			{
				$u .= "&search[{$key}]={$arg}";
			}
		}
		M('tpl')->assign('u',$u);
		M('tpl')->assign('page',$page);
		$args = array();
		if($search['ordersn'])$args[] = array("AND","ordersn = :ordersn","ordersn",$search['ordersn']);
		if($search['stime'])$args[] = array("AND","ordercreatetime >= :stime","stime",strtotime($search['stime']));
		if($search['etime'])$args[] = array("AND","ordercreatetime <= :etime","etime",strtotime($search['etime']));
		if($search['username']){
			$user = M('user','user')->getUserByUserName($search['username']);
			if($user['userid'])
			{
				$args[] = array("AND","orderuserid = :orderuserid","orderuserid",$user['userid']);
			}
		}
		if($search['orderstatus'])$args[] = array("AND","orderstatus = :orderstatus","orderstatus",$search['orderstatus']);
		if($search['paytype'])$args[] = array("AND","orderpaytype = :orderpaytype","orderpaytype",$search['paytype']);
		$orders = M('orders','bank')->getOrderList($args,$page);
		M('tpl')->assign('orders',$orders);
		M('tpl')->display('orders');
	}
}


?>
