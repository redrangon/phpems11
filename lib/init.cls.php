<?php

namespace PHPEMS;

ini_set("display_errors","on");
error_reporting(E_ERROR || E_PARSE);

class ginkgo
{
    static $G = array();
    static $L = array();
    static $app;
    static $module;
    static $method;
    static $defaultApp = 'core';

    static function loadMoudle()
    {
        include PEPATH.'/lib/config.inc.php';
        header('Content-Type: text/html; charset=utf-8');
		header('X-Frame-Options:SAMEORIGIN');
		header('X-XSS-Protection:1;mode=block');
		header('X-Content-Type-Options: nosniff');
        //header("Content-Security-Policy: default-src 'self'; script-src 'self';style-src 'self' 'sha256-Kfm50PMQvu1vvfq+iHjwXC0a2D4fa0A5RVvMCgH2N+c='");
        ini_set('date.timezone','Asia/Shanghai');
        date_default_timezone_set("Etc/GMT-8");
        $path = PEPATH."/vendor/vendor/autoload.php";
        if(file_exists($path) && COMPOSER)
        {
            include_once $path;
        }
    }
	
    /**
     * @param $G
     * @param null $app
     * @return static
     */
	static public function make($G,$app = NULL,$parm = 'default')
	{
		if($app)
        {
            if(!isset(self::$L[$app][$G][$parm]))
            {
                $fl = PEPATH.'/app/'.$app.'/cls/'.$G.'.cls.php';
                if(file_exists($fl))
                {
                    include_once $fl;
                }
                else return false;
                $o = $app.'\\'.$G;
                $clsname = '\\PHPEMS\\'.$o;
                self::$L[$app][$G][$parm] = new $clsname($parm);
            }
            return self::$L[$app][$G][$parm];
        }
		else
		{
			if(!isset(self::$G[$G][$parm]))
			{
				if(file_exists(PEPATH.'/lib/'.$G.'.cls.php'))
				{
					include_once PEPATH.'/lib/'.$G.'.cls.php';
				}
				else return false;
				$clsname = '\\PHPEMS\\'.$G;
                self::$G[$G][$parm] = new $clsname($parm);
			}
			return self::$G[$G][$parm];
		}

	}

	//执行页面
	static function run()
	{        
        self::$app = self::$defaultApp;
        $ev = self::make('ev');
        if($ev->url(0))
        {
            self::$app = $ev->url(0);
        }
        self::$module = $ev->url(1);
        self::$method = $ev->url(2);
		if(!self::$module)self::$module = 'app';
		if(!self::$method)self::$method = 'index';
		include PEPATH.'/app/'.self::$app.'/'.self::$module.'.php';
		
		$modulefile = PEPATH.'/app/'.self::$app.'/controller/'.self::$method.'.'.self::$module.'.php';
		if(file_exists($modulefile))
		{			
			include $modulefile;			
			$tpl = self::make('tpl');
			$tpl->assign('_app',self::$app);
			$tpl->assign('method',self::$method);
			$run = new action();
			$run->display();
		}
		else die('error:Unknown app to load, the app is '.self::$app);
	}

	static public function R($message)
	{
		$ev = self::make('ev');
		if($ev->get('userhash'))
		{
			exit(json_encode($message,JSON_UNESCAPED_UNICODE));
		}
		else
		{
            if($message['statusCode'] == 301)
            {
                exit(header("location:index.php?user-app-login"));
            }
            $tpl = clone M('tpl');
            $tpl->setDir();
            $tpl->assign('message',$message);
            $tpl->display('error');
		}
	}
}

function M($G,$app = NULL,$parm = 'default'){
    return ginkgo::make($G,$app,$parm);
}
?>