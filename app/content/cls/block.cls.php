<?php
namespace PHPEMS\content;
use function \PHPEMS\M;
class block
{
	public $db;

	public function __construct()
	{
		$this->db = M('pepdo');
	}

	public function getBlockList($args,$page,$number = 20)
	{
		$data = array(
			'select' => false,
			'table' => 'block',
			'query' => $args,
			'orderby' => 'blockid DESC'
		);
		return $this->db->listElements($page,$number,$data);
	}

	public function addBlock($args)
	{
		$data = array('block',$args);
		$sql = $this->db->makeInsert($data);
		$this->db->exec($sql);
		return $this->db->lastInsertId();
	}

	public function delBlock($id)
	{
		return $this->db->delElement(array('table' => 'block','query' => array(array("AND","blockid = :blockid",'blockid',$id))));
	}

	public function getBlockById($id)
	{
		$data = array(false,'block',array(array("AND","blockid = :blockid",'blockid',$id)));
		$sql = $this->db->makeSelect($data);
		return $this->db->fetch($sql,'blockcontent');
	}

	public function modifyBlock($id,$args)
	{
		$data = array('block',$args,array(array("AND","blockid = :blockid",'blockid',$id)));
		$sql = $this->db->makeUpdate($data);
		return $this->db->exec($sql);
	}
}

?>
