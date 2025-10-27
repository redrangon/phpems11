<?php
namespace PHPEMS\docs;
use function \PHPEMS\M;

class doc
{
	public function getDocNumber($args)
	{
        $data = array('count(*) as number','docs',$args);
        $sql = M('pepdo')->makeSelect($data);
        $r = M('pepdo')->fetch($sql);
        return $r['number'];
	}

	public function getDocList($args,$page = 1,$number = 20,$order = 'docsequence desc,docid DESC')
	{
		$data = array(
			'select' => false,
			'table' => 'docs',
			'query' => $args,
			'orderby' => $order
		);
		$r = M('pepdo')->listElements($page,$number,$data);
		return $r;
	}

	public function delDoc($id)
	{
        M('pepdo')->delElement(array('table' => 'docs','query' => array(array('AND',"docid = :docid",'docid',$id))));
        M('pepdo')->delElement(array('table' => 'dochistory','query' => array(array('AND',"dhdocid = :dhdocid",'dhdocid',$id))));
		return true;
	}

	public function modifyDoc($id,$args)
	{
		$data = array(
			'table' => 'docs',
			'value' => $args,
			'query' => array(array('AND',"docid = :docid",'docid',$id))
		);
		return M('pepdo')->updateElement($data);
	}

	public function addDoc($args)
	{
		return M('pepdo')->insertElement(array('table' => 'docs','query' => $args));
	}

	public function getDocById($id,$withcontent = true)
	{
		$data = array(false,'docs',array(array('AND',"docid = :docid",'docid',$id)));
		$sql = M('pepdo')->makeSelect($data);
		$r = M('pepdo')->fetch($sql);
		if($r['doccontentid'] && $withcontent)
		{
			$data = array(false,'dochistory',array(array('AND',"dhid = :dhid",'dhid',$r['doccontentid'])));
			$sql = M('pepdo')->makeSelect($data);
			$rs = M('pepdo')->fetch($sql);
			$r['content'] = $rs;
        }
		return $r;
	}

    public function getDocHistroyById($dhid)
    {
        $data = array(false,'dochistory',array(array('AND',"dhid = :dhid",'dhid',$dhid)));
        $sql = M('pepdo')->makeSelect($data);
        return M('pepdo')->fetch($sql);
    }

    public function getDocHistoryByArgs($args)
	{
        $data = array(false,'dochistory',$args);
        $sql = M('pepdo')->makeSelect($data);
        return M('pepdo')->fetch($sql);
	}

	public function getDocHistoryListByDocid($id,$page,$number = 20,$order = 'dhid DESC')
	{
        $data = array(
            'select' => false,
            'table' => 'dochistory',
            'query' => array(array("AND","dhdocid = :dhdocid","dhdocid",$id)),
            'orderby' => $order
        );
        $r = M('pepdo')->listElements($page,$number,$data);
        return $r;
	}

    public function getDocHistoryListByArgs($args,$page,$number = 20,$order = 'dhid DESC')
    {
        $data = array(
            'select' => false,
            'table' => 'dochistory',
            'query' => $args,
            'orderby' => $order
        );
        $r = M('pepdo')->listElements($page,$number,$data);
        return $r;
    }

    public function delDocHistory($id)
    {
        M('pepdo')->delElement(array('table' => 'dochistory','query' => array(array('AND',"dhid = :dhid",'dhid',$id),array('AND',"dhstatus = 2"))));
        return true;
    }

    public function modifyDocHistory($id,$args)
    {
        $data = array(
            'table' => 'dochistory',
            'value' => $args,
            'query' => array(array('AND',"dhid = :dhid",'dhid',$id))
        );
        return M('pepdo')->updateElement($data);
    }

    public function addDocHistory($args)
    {
        return M('pepdo')->insertElement(array('table' => 'dochistory','query' => $args));
    }
}

?>
