<?php

namespace PHPEMS;
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
        spl_autoload_register([self::class, 'autoLoadClass']);
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

    static public function autoLoadClass($class)
    {
        $class = explode('\\',$class);
        if($class[0] == 'PHPEMS')
        {
            $number = count($class);
            if ($number >= 2 && $number <= 3 )
            {
                if ($number == 2)
                {
                    $class = $class[1];
                    $path = PEPATH . '/lib/' . $class . '.cls.php';
                }
                else
                {
                    unset($class[0]);
                    $path = PEPATH . '/app/' . $class[1] . '/cls/'.$class[2].'.cls.php';
                }
                if (file_exists($path)) {
                    include $path;
                }
            }
        }
    }

    static public function make($G,$app = NULL,$param = 'default')
    {
        if($app)
        {
            if(!isset(self::$L[$app][$G][$param]))
            {
                $o = $app.'\\'.$G;
                $clsname = '\\PHPEMS\\'.$o;
                self::$L[$app][$G][$param] = new $clsname($param);
            }
            return self::$L[$app][$G][$param];
        }
        else
        {
            if(!isset(self::$G[$G][$param]))
            {
                $clsname = '\\PHPEMS\\'.$G;
                self::$G[$G][$param] = new $clsname($param);
            }
            return self::$G[$G][$param];
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
            $tpl->assign('userhash',$ev->get('userhash'));
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
            if($message['forwardUrl'] == 'reload')
            {
                if($ev->server['HTTP_REFERER'])
                {
                    $message['forwardUrl'] = $ev->server['HTTP_REFERER'];
                }
                else $message['forwardUrl'] = 'index.php';
            }
            if($message['forwardUrl'] && !$message['message'])
            {
                exit(header("location:{$message['forwardUrl']}"));
            }
            $tpl = clone M('tpl');
            $tpl->setDir();
            $tpl->assign('message',$message);
            $tpl->display('error');
			exit;
		}
	}
}

?>