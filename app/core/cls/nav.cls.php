<?php
namespace PHPEMS\core;
use function \PHPEMS\M;
class nav
{
	public $db;

	public function __construct()
	{
		
		$this->db = M('pepdo');
	}

	public function getNav($navid)
	{
		$data = array(false,'navs',array(array("AND","navid = :navid","navid",$navid)));
		$sql = $this->db->makeSelect($data);
		return $this->db->fetch($sql);
	}

    public function getNavs($args,$order = 'navsequence desc,navid desc')
    {
        $data = array(false,'navs',$args,false,$order,false);
        $sql = $this->db->makeSelect($data);
        return $this->db->fetchAll($sql);
    }

    public function getWebNavs()
    {
        return $this->getNavs(array(array("AND","navstatus = 1")));
    }

	public function addNav($args)
	{
		$data = array('navs',$args);
		$sql = $this->db->makeInsert($data);
		$this->db->exec($sql);
		return $this->db->lastInsertId();
	}

	public function modifyNav($navid,$args)
	{
        $data = array('navs',$args,array(array("AND","navid = :navid","navid",$navid)));
        $sql = $this->db->makeUpdate($data);
        return $this->db->exec($sql);
	}

    public function delNav($navid)
    {
        return $this->db->delElement(array('table' => 'navs','query' => array(array('AND',"navid = :navid",'navid',$navid))));
    }

	public function getNavList($args = 1,$page = 1,$number = 10,$order = 'navsequence desc,navid desc')
	{
        $data = array(
            'select' => false,
            'table' => 'navs',
            'query' => $args,
            'orderby' => $order
        );
        return $this->db->listElements($page,$number,$data);
	}
}

?>