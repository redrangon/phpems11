<?php
 namespace PHPEMS;
/*
 * Created on 2016-5-19
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
class action extends app
{
	public function display()
	{
		$action = M('ev')->url(3);
		if(!method_exists($this,$action))
		$action = "index";
		$this->$action();
		exit;
	}

	private function index()
	{
		$page = M('ev')->get('page');
		$page = $page < 1?1:$page;
		$s = M('favor','exam')->getUserTopScore($this->data['currentbasic']['basicid'],$this->user['userid']);
		$scores = M('favor','exam')->getExamScoreListByBasicId($this->data['currentbasic']['basicid'],$page);
		M('tpl')->assign('s',$s);
		M('tpl')->assign('page',$page);
		M('tpl')->assign('scores',$scores);
		M('tpl')->display('scores');
	}
}


?>
