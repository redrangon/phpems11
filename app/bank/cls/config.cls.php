<?php
namespace PHPEMS\bank;
use function \PHPEMS\M;
/*
 * Created on 2013-5-31
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
class config
{
	public $orderstatus = array(1=>'待支付',2=>'待发货',3=>'待收货',4 => '已完成',99 =>'已取消');
	public $paytypes = array('handle' => '手动','alipay' => '支付宝','wxpay' => '微信');
}
?>
