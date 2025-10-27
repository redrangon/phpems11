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
		$app = M('apps','core')->getApp('exam');
        $this->setting = $app['appsetting'];
        if($app['appsetting']['recordperiodic'])
        {
            $etime = TIME - $app['appsetting']['recordperiodic'] * 24 * 3600;
            $args = array(
                array("AND","recordtime <= :recordtime","recordtime",$etime)
            );
            M('favor','exam')->delRecordByArgs($args);
        }
		M('favor','exam')->recordTask();
		exit('Records task finished!');
	}
}
require PEPATH."/lib/system.func.php";