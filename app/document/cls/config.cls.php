<?php
namespace PHPEMS\document;
use function \PHPEMS\M;
/*
 * Created on 2013-5-31
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
class config
{
	public $forbidden = array('rpm','exe','hta','php','phpx','asp','aspx','jsp');
	public $paytypes = array('handle' => '手动','alipay' => '支付宝','wxpay' => '微信');
}
?>
