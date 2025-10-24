<?php
namespace PHPEMS\ask;
use function \PHPEMS\M;
class ask
{
	public $db;

	public function __construct()
	{
		$this->db = M('pepdo');
	}

	//获取试题反馈列表
	//参数：
	//返回值：地区列表
	public function getAskList($args = 1,$page,$number = 20,$orderby = "askorder desc,askid desc")
	{
		$data = array(
			'select' => false,
			'table' => 'ask',
			'query' => $args,
			'orderby' => $orderby
		);
		return $this->db->listElements($page,$number,$data);
	}

	public function addAsk($args)
	{
		$args['asktime'] = TIME;
		$data = array('ask',$args);
		$sql = $this->db->makeInsert($data);
		$this->db->exec($sql);
		return $this->db->lastInsertId();
	}

	//根据地名查询
	//参数：地名字符串
	//返回值：该地名信息数组
	public function getAskById($id)
	{
		$data = array(false,'ask',array(array("AND","askid = :askid",'askid',$id)),false,false,false);
		$sql = $this->db->makeSelect($data);
		return $this->db->fetch($sql);
	}

	//根据ID获取地名信息
	//参数：地名ID
	//返回值：该地名信息数组
	public function modifyAsk($id,$args)
	{
		$data = array('ask',$args,array(array("AND","askid = :askid",'askid',$id)));
		$sql = $this->db->makeUpdate($data);
		return $this->db->exec($sql);
	}

	//修改地名信息
	//参数：地名ID,要修改的信息
	//返回值：true
	public function delAsk($id)
	{
		$data = array('answer',array(array("AND","asraskid = :asraskid",'asraskid',$id)));
		$sql = $this->db->makeDelete($data);
		$this->db->exec($sql);
		$data = array('ask',array(array("AND","askid = :askid",'askid',$id)));
		$sql = $this->db->makeDelete($data);
		return $this->db->exec($sql);
	}

	public function getAnswerList($args = 1,$page,$number = 20,$orderby = "asrid desc")
	{
		$data = array(
			'select' => false,
			'table' => 'answer',
			'query' => $args,
			'orderby' => $orderby
		);
		return $this->db->listElements($page,$number,$data);
	}

	public function modifyAnswer($id,$args)
	{
		$data = array('answer',$args,array(array("AND","asrid = :asrid",'asrid',$id)));
		$sql = $this->db->makeUpdate($data);
		return $this->db->exec($sql);
	}

	public function addAnswer($args)
	{
		$args['asrtime'] = TIME;
		$data = array('answer',$args);
		$sql = $this->db->makeInsert($data);
		$this->db->exec($sql);
		return $this->db->lastInsertId();
	}

	//根据地名查询
	//参数：地名字符串
	//返回值：该地名信息数组
	public function getAnswerById($id)
	{
		$data = array(false,'answer',array(array("AND","asrid = :asrid",'asrid',$id)),false,false,false);
		$sql = $this->db->makeSelect($data);
		return $this->db->fetch($sql);
	}

	public function getAnswerByArgs($args = array(),$orderby = "asrid desc")
	{
		$data = array(false,'answer',$args,false,$orderby,1);
		$sql = $this->db->makeSelect($data);
		return $this->db->fetch($sql);
	}

	public function delAnswer($id)
	{
		$data = array('answer',array(array("AND","asrid = :asrid",'asrid',$id)));
		$sql = $this->db->makeDelete($data);
		return $this->db->exec($sql);
	}
}

?>
