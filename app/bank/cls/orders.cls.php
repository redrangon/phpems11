<?php
namespace PHPEMS\bank;
use function \PHPEMS\M;
class orders
{
	public function payforOrder($ordersn,$paytype = 'handle')
	{
		$order = $this->getOrderById($ordersn);
		if($order['orderstatus'] == 1)
		{
			$this->modifyOrderById($ordersn,array('orderstatus' => 4,'orderfinishtime' => TIME,'orderpaytype' => $paytype));
			$user = M('user','user')->getUserById($order['orderuserid']);
			$args['usercoin'] = $user['usercoin']+$order['orderprice']*10;
			M('user','user')->modifyUserInfo($order['orderuserid'],$args);
		}
		return true;
	}

	public function getOrderList($args,$page,$number = 20,$order = 'ordercreatetime DESC')
	{
		$data = array(
			'select' => false,
			'table' => 'orders',
			'query' => $args,
			'orderby' => $order,
			'serial' => array('orderitems','orderpost','orderaddress','orderuserinfo','orderdescribe','orderfaq')
		);
		return M('pepdo')->listElements($page,$number,$data);
	}

	public function delOrder($id)
	{
		return M('pepdo')->delElement(array('table' => 'orders','query' => array(array("AND","ordersn = :ordersn",'ordersn',$id))));
	}

	public function modifyOrder($id,$args)
	{
		$data = array(
			'table' => 'orders',
			'value' => $args,
			'query' => array(array("AND","ordersn = :ordersn",'ordersn',$id))
		);
		return M('pepdo')->updateElement($data);
	}

	public function addOrder($args)
	{
		return M('pepdo')->insertElement(array('table' => 'orders','query' => $args));
	}

	public function getOrderById($id,$userid = null)
	{
		if($userid)
		$data = array(false,'orders',array(array("AND","ordersn = :ordersn",'ordersn',$id),array("AND","orderuserid = :orderuserid",'orderuserid',$userid)));
		else
		$data = array(false,'orders',array(array("AND","ordersn = :ordersn",'ordersn',$id)));
		$sql = M('pepdo')->makeSelect($data);
		return M('pepdo')->fetch($sql,array('orderitems','orderaddress','orderdescribe','orderpost','orderuserinfo','orderfaq'));
	}

	public function modifyOrderById($id,$args)
	{
		$data = array('orders',$args,array(array("AND","ordersn = :ordersn",'ordersn',$id)));
		$sql = M('pepdo')->makeUpdate($data);
		return M('pepdo')->exec($sql);
	}
}

?>
