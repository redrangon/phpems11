<?php
namespace PHPEMS;

require_once PEPATH."/lib/include/htmlpurifier/HTMLPurifier.auto.php";
class safe
{
	public $html;

    public function __construct()
    {
    	$this->html = new \HTMLPurifier(\HTMLPurifier_Config::createDefault());
    }

    public function tidyHtml($code = false)
    {
		if(!$code)return '';
        return $this->html->purify($code);
    }
}
?>