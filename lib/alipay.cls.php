<?php
 namespace PHPEMS;

require_once PEPATH."/lib/include/alipay/AopSdk.php";
require_once PEPATH."/lib/include/alipay/AlipayTradeService.php";
require_once PEPATH."/lib/include/alipay/AlipayTradePagePayContentBuilder.php";
require_once PEPATH."/lib/include/alipay/AlipayTradeWapPayContentBuilder.php";
require_once PEPATH."/lib/include/alipay/AlipayTradeAppPayContentBuilder.php";

class alipay
{
	public $config = array();

    public function __construct()
    {
    	$this->setDefaultConfig();
    }

    private function setDefaultConfig()
    {
    	$this->config['app_id'] = ALIAPPID;
		//商户私钥，您的原始格式RSA私钥
		$this->config['merchant_private_key'] = ALIPRIKEY;
		//签名方式 不需修改
		$this->config['sign_type'] = strtoupper('RSA2');
		//字符编码格式 目前支持 gbk 或 utf-8
		$this->config['charset'] = strtoupper('UTF-8');
		//支付宝网关
		$this->config['gatewayUrl'] = "https://openapi.alipay.com/gateway.do";
		//$this->config['gatewayUrl'] = "https://openapi.alipaydev.com/gateway.do";
		//支付宝公钥
		$this->config['alipay_public_key'] = ALIPUBKEY;
		//异步通知地址
		$this->config['notify_url'] = WP."api/alinotify.php";
		//同步跳转
		$this->config['return_url'] = WP."api/alireturn.php";
    }
	
	public function outPayForUrl($order,$notify_url,$return_url)
	{
		$this->config['notify_url'] = $notify_url;
		$this->config['return_url'] = $return_url;
		return $this->createPagePayLink($order);
	}
	
	public function outPhonePayForUrl($order,$notify_url,$return_url)
	{
		$this->config['notify_url'] = $notify_url;
		$this->config['return_url'] = $return_url;
		return $this->createWapPayLink($order);
	}
	
	public function outUniAppPayFor($order,$notify_url,$return_url)
	{
		$link = substr($this->createAppPayLink($order,$notify_url,$return_url),strlen($this->config['gatewayUrl'])+1);
		return $link;
	}

    public function createPagePayLink($order)
    {
        $payRequestBuilder = new \AlipayTradePagePayContentBuilder();
        $payRequestBuilder->setBody("购买课程，开通考场");
        $payRequestBuilder->setSubject($order['ordertitle']);
        $payRequestBuilder->setOutTradeNo($order['ordersn']);
        $payRequestBuilder->setTotalAmount($order['orderprice']);

        $payResponse = new \AlipayTradeService($this->config);
        return $payResponse->pagePay($payRequestBuilder,$this->config['return_url'],$this->config['notify_url']);
    }

    public function createWapPayLink($order)
    {
        $payRequestBuilder = new \AlipayTradeWapPayContentBuilder();
        $payRequestBuilder->setBody("购买课程，开通考场");
        $payRequestBuilder->setSubject($order['ordertitle']);
        $payRequestBuilder->setOutTradeNo($order['ordersn']);
        $payRequestBuilder->setTotalAmount($order['orderprice']);

        $payResponse = new \AlipayTradeService($this->config);
        return $payResponse->wapPay($payRequestBuilder,$this->config['return_url'],$this->config['notify_url']);
    }
	
	public function createAppPayLink($order)
    {
        $payRequestBuilder = new \AlipayTradeAppPayContentBuilder();
        $payRequestBuilder->setBody("购买课程，开通考场");
        $payRequestBuilder->setSubject($order['ordertitle']);
        $payRequestBuilder->setOutTradeNo($order['ordersn']);
        $payRequestBuilder->setTotalAmount($order['orderprice']);

        $payResponse = new \AlipayTradeService($this->config);
        return $payResponse->appPay($payRequestBuilder,$this->config['return_url'],$this->config['notify_url']);
    }

    public function alireturn()
    {
    	$alipaySevice = new \AlipayTradeService($this->config);
    	return $alipaySevice->check($_GET);
    }

    public function alinotify()
    {
    	$alipaySevice = new \AlipayTradeService($this->config);
    	return $alipaySevice->check($_POST);
    }
}

?>