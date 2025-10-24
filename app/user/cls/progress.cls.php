<?php
namespace PHPEMS\user;
use function \PHPEMS\M;
class progress
{
	public $db;
	public $ev;

	public function __construct()
	{
		$this->db = M('pepdo');
		$this->ev = M('ev');
	}

	public function addProgress($args)
	{
        $data = array('progress',$args);
        $sql = $this->db->makeInsert($data);
        $this->db->exec($sql);
        return $this->db->lastInsertId();
	}

	public function modifyProgress($prsid,$args)
	{
        $data = array('progress',$args,array(array('AND',"prsid = :prsid",'prsid',$prsid)));
        $sql = $this->db->makeUpdate($data);
        return $this->db->exec($sql);
	}

    public function modifyProgressByArgs($sargs,$args)
    {
        $data = array('progress',$args,$sargs);
        $sql = $this->db->makeUpdate($data);
        return $this->db->exec($sql);
    }

	public function delProgress($prsid)
	{
		$data = array('progress',array(array('AND',"prsid = :prsid",'prsid',$prsid)));
		$sql = $this->db->makeDelete($data);
		return $this->db->exec($sql);
	}

	public function getProgressById($prsid)
	{
        $data = array(false,'progress',array(array('AND',"prsid = :prsid",'prsid',$prsid)));
        $sql = $this->db->makeSelect($data);
        return $this->db->fetch($sql);
	}

	public function getProgressByArgs($args)
	{
        $data = array(false,'progress',$args);
        $sql = $this->db->makeSelect($data);
        return $this->db->fetch($sql);
	}

	public function getProgressesByArgs($args)
	{
        $data = array(false,'progress',$args);
        $sql = $this->db->makeSelect($data);
        return $this->db->fetchAll($sql);
	}

	public function getUserProgressesListByArgs($args,$page,$number = 10)
	{
        $args[] = array("AND",'prsuserid = userid');
		$args = array(
			'table' => array('user','progress'),
			'query' => $args,
			'index' => 'prsid'
		);
		return $this->db->listElements($page,$number,$args);
	}
}

?>
