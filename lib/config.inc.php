<?php

/** 常规常量设置 */
define('DOMAINTYPE','off');
define('CH','exam_');
define('CDO','');
define('CP','/');
define('CRT',180);
define('CS','1hqfx6ticwRxtfviTp940vng!yC^QK^6');//请随机生成32位字符串修改此处值
define('PN',10);
define('TIME',time());
if(dirname($_SERVER['SCRIPT_NAME']))
{
	define('WP','http://'.$_SERVER['SERVER_NAME'].dirname($_SERVER['SCRIPT_NAME']).'/');
}
else
{
	define('WP','http://'.$_SERVER['SERVER_NAME'].'/');
}
define('OPENOSS',false);

/**composer开关**/
define('COMPOSER',0);
/** 数据库设置 */
define('SQLDEBUG',0);
define('DB','phpems11');//MYSQL数据库名
define('DH','127.0.0.1');//MYSQL主机名，不用改
define('DU','root');//MYSQL数据库用户名
define('DP','root');//MYSQL数据库用户密码
define('DTH','x2_');//系统表前缀，不用改

/** 微信相关设置 */
define('USEWX',true);//微信使用开关，绑定用户，false时不启用
define('WXAUTOREG',true);//微信开启自动注册,设置为false时转向登录和注册页面，绑定openid
define('WXPAY',true);
define('EP','@phpems.net');//微信开启自动注册时注册邮箱后缀
define('OPENAPPID','OPENAPPID');//开放平台账号
define('OPENAPPSECRET','OPENAPPSECRET');
define('MPAPPID','MPAPPID');//小程序账号
define('MPAPPSECRET','MPAPPSECRET');
define('WXAPPID','WXAPPID');//公众号账号
define('WXAPPSECRET','WXAPPSECRET');
define('WXMCHID','WXMCHID');//MCHID
define('WXKEY','WXKEY');

/** 支付宝相关设置 */
define('ALIPAY',true);
/**RAS2**/
define('ALIAPPID','2016092200000000');
define('ALIPRIKEY','ALIPRIKEY');
define('ALIPUBKEY','ALIPUBKEY');


?>