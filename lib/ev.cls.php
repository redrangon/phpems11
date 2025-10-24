<?php

namespace PHPEMS;

class ev
{
	public $cookie;
	public $post;
	public $get;
	public $file;
	public $url;
	private $e;

	public function __construct()
    {
    	if (ini_get('magic_quotes_gpc')) {
			$get    = $this->stripSlashes($_REQUEST);
			$post   = $this->stripSlashes($_POST);
			$this->cookie = $this->stripSlashes($_COOKIE);
		} else {
			$get    = $_REQUEST;
			$post   = $_POST;
			$this->cookie = $_COOKIE;
		}

		$this->file = $_FILES;
		$this->get = $this->initData($get);
		$this->post = $this->initData($post);
		$this->url = $this->parseUrl();
		$this->cookie = $this->initData($this->cookie);
    }
	
	static function isApp()
    {
        $agent = strtolower($_SERVER['HTTP_APP_AGENT']);
        if(strpos($agent, 'phpemsapkinterface') === false)
        {
            return false;
        }
        return true;
    }

    public function isWeixin()
    {
		$agent = strtolower($_SERVER['HTTP_USER_AGENT']);
    	if(strpos($agent,'micromessenger') !== false)
		{
			if(strpos($agent, "miniprogram"))//小程序
			{
				$platform = 'mpapp';
			}
			else
			{
				$platform = 'wxapp';
			}
			return $platform;
		}
		return false;
	}

   	public function isMobile()
	{
		$_SERVER['ALL_HTTP'] = isset($_SERVER['ALL_HTTP'])?$_SERVER['ALL_HTTP']:'';
		$mobile_browser = '0';
		if(preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|iphone|ipad|ipod|android|xoom)/i', strtolower($_SERVER['HTTP_USER_AGENT'])))
		$mobile_browser++;
		if((isset($_SERVER['HTTP_ACCEPT'])) and (strpos(strtolower($_SERVER['HTTP_ACCEPT']),'application/vnd.wap.xhtml+xml') !== false))
		$mobile_browser++;
		if(isset($_SERVER['HTTP_X_WAP_PROFILE']))
		$mobile_browser++;
		if(isset($_SERVER['HTTP_PROFILE']))
		$mobile_browser++;
		$mobile_ua = strtolower(substr($_SERVER['HTTP_USER_AGENT'],0,4));
		$mobile_agents = array(
			'w3c ','acs-','alav','alca','amoi','audi','avan','benq','bird','blac',
			'blaz','brew','cell','cldc','cmd-','dang','doco','eric','hipt','inno',
			'ipaq','java','jigs','kddi','keji','leno','lg-c','lg-d','lg-g','lge-',
			'maui','maxo','midp','mits','mmef','mobi','mot-','moto','mwbp','nec-',
			'newt','noki','oper','palm','pana','pant','phil','play','port','prox',
			'qwap','sage','sams','sany','sch-','sec-','send','seri','sgh-','shar',
			'sie-','siem','smal','smar','sony','sph-','symb','t-mo','teli','tim-',
			'tosh','tsm-','upg1','upsi','vk-v','voda','wap-','wapa','wapi','wapp',
			'wapr','webc','winw','winw','xda','xda-'
		);
		if(in_array($mobile_ua, $mobile_agents))
		$mobile_browser++;
		if(strpos(strtolower($_SERVER['ALL_HTTP']), 'operamini') !== false)
		$mobile_browser++;
		if(strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'windows') !== false)
		$mobile_browser=0;
		if(strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'windows phone') !== false)
		$mobile_browser++;
		if($mobile_browser>0)
		return true;
		else
		return false;
	}

	//解析url
	public function parseUrl()
	{
		if(isset($_REQUEST['route']))
		{
			$r = explode('-',$_REQUEST['route']);
			foreach($r as $key => $p)
			{
				$r[$key] = urlencode($p);
			}
		}
		elseif(isset($_SERVER['QUERY_STRING']))
		{
			$tmp = explode('#',$_SERVER['QUERY_STRING'],2);
			$tp = explode('&',$tmp[0],2);
			$r = explode('-',$tp[0]);
			foreach($r as $key => $p)
			{
				$r[$key] = urlencode($p);
			}
		}
		else return false;		
        if(!$r[0] || !file_exists('app/'.$r[0].'/'))
        {
            $r[0] = \PHPEMS\ginkgo::$defaultApp;
        }
		if(!file_exists('app/'.$r[0].'/'.$r[1].'.php') || $r[1] == 'auto')
		{
			$r[1] = 'app';
		}
		if(!file_exists('app/'.$r[0].'/controller/'.$r[2].'.'.$r[1].'.php'))
		{
			$r[2] = 'index';
		}
        if($r[1] == 'app' && $this->isMobile())
		{
            $r[1] = 'phone';
		}
		if(!isset($r[3]))$r[3] = 'index';
		if(substr($r[3],0,1) == '_')$r[3] = 'index';
        return $r;
	}

    //返回$_REQUEST数组内的值
    public function get($par)
    {
    	if(isset($this->get[$par]))return $this->get[$par];
    	else return false;
    }

    //返回$_POST数组内的值
    public function post($par)
    {
    	if(isset($this->post[$par]))return $this->post[$par];
    	else return false;
    }

    //返回URL数组中的值
    public function url($par)
    {
    	$par = intval($par);
    	if(isset($this->url[$par]))return $this->url[$par];
    	else return false;
    }

	//设置COOKIE
	public function setCookie($name,$value,$time=3600)
    {
    	if($time)$time = TIME + $time;
		else $time = 0;
		if(CDO)setCookie(CH.$name,$value,$time,CP,CDO,false,TRUE);
    	else setCookie(CH.$name,$value,$time,CP,'',false,TRUE);
    }

	//获取cookie
	public function getCookie($par,$nohead = 0)
    {
    	if(isset($this->cookie[CH.$par]))return $this->cookie[CH.$par];
    	elseif(isset($this->cookie[$par]) && $nohead)return $this->cookie[$par];
    	else return false;
    }

	//获取$_FILE
	public function getFile($par)
    {
    	if(isset($this->file[$par]))return $this->file[$par];
    	else return false;
    }

    //初始化数据
    public function initData($data)
    {
		//if($_SERVER['HTTP_HOST'] != '127.0.0.1')return false;
		if(is_array($data))
		{
			foreach($data as $key => $value)
			{
				if(M('strings')->isAllowKey($key) === false)
				{
					unset($data[$key]);
				}
				else
				$data[$key] = $this->initData($value);
			}
			return $data;
		}
		else
		{
			if(is_numeric($data))
			{
				if($data[0] === 0)return $this->addSlashes($data);
				if(strlen($data) >= 11)return $this->addSlashes($data);
				if(strpos($data,'.'))return floatval($data);
				else return $data;
			}
			if(is_string($data))return $this->addSlashes($data);
			if(is_bool($data))return (bool)$data;
			return false;
		}
    }

	//去除转义字符
	public function stripSlashes($data)
    {
    	if (is_array($data)) {
	  		foreach ($data as $key => $value) {
	    		$data[$key] = $this->stripSlashes($value);
	  		}
		} else {
	  		$data = stripSlashes(trim($data));
		}

		return $data;
	}

	//添加转义字符
	public function addSlashes($data)
    {
    	if (is_array($data)) {
	  		foreach ($data as $key => $value) {
	    		$data[$key] = $this->addSlashes($value);
	  		}
		} else {
	  		$data = addSlashes(trim($data));
		}
		return $data;
	}

	//获取客户端IP
	public function getClientIp()
	{
		if(!isset($this->e['ip']))
		{
			if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
				$ipList = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
				$ip = trim($ipList[0]);

				if (!filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 | FILTER_FLAG_IPV6)) {
					$ip = '';
				}
			}

			if (empty($ip) && !empty($_SERVER['HTTP_CLIENT_IP'])) {
				$ip = $_SERVER['HTTP_CLIENT_IP'];
				if (!filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 | FILTER_FLAG_IPV6)) {
					$ip = '';
				}
			}

			if (empty($ip)) {
				$ip = $_SERVER['REMOTE_ADDR'];
			}

			$ip = filter_var($ip, FILTER_VALIDATE_IP) ? $ip : '0.0.0.0';
			$this->e['ip'] = $ip;
		}
		return $this->e['ip'];
	}
}
?>
