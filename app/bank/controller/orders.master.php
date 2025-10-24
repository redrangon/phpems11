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
		$this->module = M('module');
		$action = $this->ev->url(3);
		if(!method_exists($this,$action))
		$action = "index";
		$this->$action();
		exit;
	}

	private function modifyorder()
	{
		$ordersn = $this->ev->get('ordersn');
		$order = $this->orders->getOrderById($ordersn);
		$orderstatus = $this->ev->get('orderstatus');
		$reason = $this->ev->get('reason');
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
			$this->orders->modifyOrderById($ordersn,$args);
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
		$ordersn = $this->ev->get('ordersn');
		$uploadfile = $this->ev->get('uploadfile');
		if($uploadfile)
		$this->orders->modifyOrderById($ordersn,array('orderbill' => $uploadfile));
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
		$ordersn = $this->ev->get('ordersn');
		$order = $this->orders->getOrderById($ordersn);
		if($order['orderstatus'] == 2)
		{
			$postname = $this->ev->get('postname');
			$postorder = $this->ev->get('postorder');
			if($postname && $postorder)
			{
				$args = array();
				$args['orderpost'] = array('postname' => $postname,'postorder' => $postorder);
				$args['ordersendtime'] = TIME;
				$args['orderfactfee'] = $this->ev->get('orderfactfee');;
				$args['orderstatus'] = 3;
				$this->orders->modifyOrderById($ordersn,$args);
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
		$ordersn = $this->ev->get('ordersn');
		$order = $this->orders->getOrderById($ordersn);
		$modules = $this->module->getModulesByApp('item');
		$mfields = array();
		foreach($modules as $p)
		{
			$mfields[$p['moduleid']] = $this->module->getMoudleFields($p['moduleid'],1);
		}
		$this->tpl->assign('order',$order);
		$this->tpl->assign('mfields',$mfields);
		$this->tpl->display('orderdetail');
	}

	private function remove()
	{
		$oid = $this->ev->get('ordersn');
		$order = $this->orders->getOrderById($oid);
		if($order['orderstatus'] == 1 || $order['orderstatus'] == 99)
		{
			$this->orders->delOrder($oid);
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
		$delids = $this->ev->get('delids');
		foreach($delids as $oid => $p)
		{
			$order = $this->orders->getOrderById($oid);
			if($order['orderstatus'] == 1 || $order['orderstatus'] == 99)
			{
				$this->orders->delOrder($oid);
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
		$ordersn = $this->ev->get('ordersn');
		$orderstatus = $this->ev->get('orderstatus');
		$args = array('orderstatus' => $orderstatus);
		$this->orders->modifyOrderById($ordersn,$args);
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
		$search = $this->ev->get('search');
		$page = intval($this->ev->get('page'));
		$u = '';
		if($search)
		{
			$this->tpl->assign('search',$search);
			foreach($search as $key => $arg)
			{
				$u .= "&search[{$key}]={$arg}";
			}
		}
		$this->tpl->assign('u',$u);
		$this->tpl->assign('page',$page);
		$args = array();
		if($search['ordersn'])$args[] = array("AND","ordersn = :ordersn","ordersn",$search['ordersn']);
		if($search['stime'])$args[] = array("AND","ordercreatetime >= :stime","stime",strtotime($search['stime']));
		if($search['etime'])$args[] = array("AND","ordercreatetime <= :etime","etime",strtotime($search['etime']));
		if($search['username']){
			$user = $this->user->getUserByUserName($search['username']);
			if($user['userid'])
			{
				$args[] = array("AND","orderuserid = :orderuserid","orderuserid",$user['userid']);
			}
		}
		if($search['orderstatus'])$args[] = array("AND","orderstatus = :orderstatus","orderstatus",$search['orderstatus']);
		if($search['paytype'])$args[] = array("AND","orderpaytype = :orderpaytype","orderpaytype",$search['paytype']);
		$orders = $this->orders->getOrderList($args,$page);
		$this->tpl->assign('orders',$orders);
		$this->tpl->display('orders');
	}
}


?>
