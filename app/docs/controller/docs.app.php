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

    private function history()
	{
        $docid = M('ev')->get('docid');
        $page = M('ev')->get('page');
        $doc = M('doc','docs')->getDocById($docid,false);
        $args = array();
        $args[] = array("AND","dhstatus = 1");
        $args[] = array("AND","dhdocid = :dhdocid","dhdocid",$docid);
        $histories = M('doc','docs')->getDocHistoryListByArgs($args,$page);
        M('tpl')->assign('doc',$doc);
        M('tpl')->assign('histories',$histories);
		M('tpl')->display('history');
	}

    private function viewhistory()
	{
        $dhid = M('ev')->get('dhid');
        $history = M('doc','docs')->getDocHistroyById($dhid);
        $doc = M('doc','docs')->getDocById($history['dhdocid']);
        $doc['content'] = $history;
        M('tpl')->assign('doc',$doc);
        M('tpl')->display('history_view');
    }

	private function index()
	{
		$docid = M('ev')->get('docid');
		$doc = M('doc','docs')->getDocById($docid);
		$catbread = M('category')->getCategoryPos($doc['doccatid']);
		$cat = M('category')->getCategoryById($doc['doccatid']);
		$template = 'doc_default';
		M('tpl')->assign('cat',$cat);
		M('tpl')->assign('catbread',$catbread);
		M('tpl')->assign('doc',$doc);
		M('tpl')->display($template);
	}
}


?>
