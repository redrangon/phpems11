<?php
namespace PHPEMS;
/*
 * Created on 2013-12-26
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
//if(php_sapi_name() != 'cli')exit('Access denied!');
set_time_limit(0);
define('PEPATH',dirname(dirname(__FILE__)));
class app
{
	public function run()
	{
		//
	}
}
include PEPATH.'/lib/init.cls.php';
ginkgo::loadMoudle();
ginkgo::run();


?>