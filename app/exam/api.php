<?php

class app
{
	public $G;
	//联系密钥
	private $sc = '';

	public function __construct()
	{
		
		$this->ev = M('ev');
		$this->tpl = M('tpl');
		
		$this->db = M('pepdo');
		$this->pg = M('pg');
		$this->html = M('html');
		$this->session = M('session');
		$this->exam = M('exam','exam');
		$this->user = M('user','user');
	}
}

?>