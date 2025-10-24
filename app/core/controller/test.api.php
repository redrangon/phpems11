<?php
/*
 * Created on 2016-5-19
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
namespace PHPEMS;
set_time_limit(0);
class action extends app
{
	public function display()
	{
        $this->pdo = M('pepdo');
	    $action = $this->ev->url(3);
		if(!method_exists($this,$action))
		$action = "index";
		$this->$action();
		exit;
	}
	
	public function searchimg()
	{
		$img = base64_encode(file_get_contents('test.jpg'));
		$baidu = M('baidu');
		$res = $baidu->searchItemImg(array('image' => $img));
		print_r($res);
	}

	public function index()
	{
		$mppay = M('mppay');
		$orders = M('orders','bank');
		$openid = $mppay->getmpopenid();
		$order = $orders->getOrderById('20221109172822257');
		$info = $mppay->outMpPay($order);
		print_r($info);
		exit;
	}
}


?>
