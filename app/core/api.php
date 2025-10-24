<?php
namespace PHPEMS;
class app
{
	public $G;

	public function __construct()
	{
		
		$this->files = M('files');
		$this->session = M('session');
		$this->tpl = M('tpl');
		$this->ev = M('ev');
	}

}

?>