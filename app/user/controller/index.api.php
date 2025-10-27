<?php
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
		$ordersn = M('ev')->get('ordersn');
		M('orders','bank') = M('orders','bank');
		$order = M('orders','bank')->getOrderById($ordersn);
		M('tpl')->assign('order',$order);
		M('tpl')->display('payfor_status');
	}
}


?>
