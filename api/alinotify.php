<?php

/*
 * Created on 2013-12-26
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
namespace PHPEMS;
define('PEPATH',dirname(dirname(__FILE__)));
class app
{
	public function run()
	{
		$orderid = M('ev')->get('out_trade_no');
		$order = M('orders','bank')->getOrderById($orderid);
		$verify_result = M('alipay')->alinotify();
		if($verify_result)
		{
			if(M('ev')->get('trade_status') == 'TRADE_FINISHED' || M('ev')->get('trade_status') == 'TRADE_SUCCESS')
			{
				if($order['orderstatus'] != 2)
				{
                    M('orders','bank')->payforOrder($orderid,'alipay');
				}
				exit('sucess');
			}
			elseif($_POST['trade_status'] == 'WAIT_BUYER_PAY')
			{
				exit('fail');
			}
			else
			{
				exit('fail');
			}
		}
		else
		{
			exit('fail');
		}
	}
}
require PEPATH."/lib/system.func.php";
$app = new app();
$app->run();
?>