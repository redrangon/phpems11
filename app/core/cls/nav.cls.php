<?php
namespace PHPEMS\core;
use function \PHPEMS\M;
class nav
{
	public function getNav($navid)
	{
		$data = array(false,'navs',array(array("AND","navid = :navid","navid",$navid)));
		$sql = M('pepdo')->makeSelect($data);
		return M('pepdo')->fetch($sql);
	}

    public function getNavs($args,$order = 'navsequence desc,navid desc')
    {
        $data = array(false,'navs',$args,false,$order,false);
        $sql = M('pepdo')->makeSelect($data);
        return M('pepdo')->fetchAll($sql);
    }

    public function getWebNavs()
    {
        return $this->getNavs(array(array("AND","navstatus = 1")));
    }

	public function addNav($args)
	{
		$data = array('navs',$args);
		$sql = M('pepdo')->makeInsert($data);
		M('pepdo')->exec($sql);
		return M('pepdo')->lastInsertId();
	}

	public function modifyNav($navid,$args)
	{
        $data = array('navs',$args,array(array("AND","navid = :navid","navid",$navid)));
        $sql = M('pepdo')->makeUpdate($data);
        return M('pepdo')->exec($sql);
	}

    public function delNav($navid)
    {
        return M('pepdo')->delElement(array('table' => 'navs','query' => array(array('AND',"navid = :navid",'navid',$navid))));
    }

	public function getNavList($args = 1,$page = 1,$number = 10,$order = 'navsequence desc,navid desc')
	{
        $data = array(
            'select' => false,
            'table' => 'navs',
            'query' => $args,
            'orderby' => $order
        );
        return M('pepdo')->listElements($page,$number,$data);
	}
}

?>