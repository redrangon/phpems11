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
		//使用通用通知接口
		//$notify = M('wxpay')->getNotifyPubObject();
		//$notify->handle(false);
        M('wxpay')->pehandle(false);
		exit;
	}
}
include PEPATH.'/lib/init.cls.php';
ginkgo::loadMoudle();
ginkgo::run();

?>