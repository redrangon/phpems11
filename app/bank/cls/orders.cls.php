<?php
namespace PHPEMS\bank;
use function \PHPEMS\M;
class orders
{
	public $db;
	public $user;
	public $module;

	public function __construct($parms = 'default')
	{
		$this->db = M('pepdo');
		$this->user = M('user','user');
		$this->module = M('module');
	}

	public function payforOrder($ordersn,$paytype = 'handle')
	{
		$order = $this->getOrderById($ordersn);
		if($order['orderstatus'] == 1)
		{
			$this->modifyOrderById($ordersn,array('orderstatus' => 4,'orderfinishtime' => TIME,'orderpaytype' => $paytype));
			$user = $this->user->getUserById($order['orderuserid']);
			$args['usercoin'] = $user['usercoin']+$order['orderprice']*10;
			$this->user->modifyUserInfo($order['orderuserid'],$args);
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
		return $this->db->listElements($page,$number,$data);
	}

	public function delOrder($id)
	{
		return $this->db->delElement(array('table' => 'orders','query' => array(array("AND","ordersn = :ordersn",'ordersn',$id))));
	}

	public function modifyOrder($id,$args)
	{
		$data = array(
			'table' => 'orders',
			'value' => $args,
			'query' => array(array("AND","ordersn = :ordersn",'ordersn',$id))
		);
		return $this->db->updateElement($data);
	}

	public function addOrder($args)
	{
		return $this->db->insertElement(array('table' => 'orders','query' => $args));
	}

	public function getOrderById($id,$userid = null)
	{
		if($userid)
		$data = array(false,'orders',array(array("AND","ordersn = :ordersn",'ordersn',$id),array("AND","orderuserid = :orderuserid",'orderuserid',$userid)));
		else
		$data = array(false,'orders',array(array("AND","ordersn = :ordersn",'ordersn',$id)));
		$sql = $this->db->makeSelect($data);
		return $this->db->fetch($sql,array('orderitems','orderaddress','orderdescribe','orderpost','orderuserinfo','orderfaq'));
	}

	public function modifyOrderById($id,$args)
	{
		$data = array('orders',$args,array(array("AND","ordersn = :ordersn",'ordersn',$id)));
		$sql = $this->db->makeUpdate($data);
		return $this->db->exec($sql);
	}
}

?>
