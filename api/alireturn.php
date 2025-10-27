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
		$verify_result = M('alipay')->alireturn();
		if($verify_result)
		{
            if(M('ev')->get('trade_status') == 'TRADE_FINISHED' || M('ev')->get('trade_status') == 'TRADE_SUCCESS')
            {
                M('orders','bank')->payforOrder($orderid,'alipay');
            }
            else
            {
                //
            }
		}
		else
		{
			//
		}
		if(M('ev')->isMobile())
        header("location:../index.php?user-phone-payfor-orderdetail&ordersn=".$orderid);
        else
		header("location:../index.php?user-center-payfor-orderdetail&ordersn=".$orderid);
		exit();
	}
}
require PEPATH."/lib/system.func.php";
$app = new app();
$app->run();
?>