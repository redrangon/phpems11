<?php
namespace PHPEMS\certificate;
use function \PHPEMS\M;
class ce
{
	public $db;

	public function __construct()
	{
		$this->db = M('pepdo');
	}

	//获取地名列表
	//参数：无
	//返回值：地区列表
	public function getCeList($args,$page,$number = 20)
	{
		$data = array(
			'select' => false,
			'table' => 'certificate',
			'query' => $args,
		);
		$r = $this->db->listElements($page,$number,$data);
		return $r;
	}

	//按页获取地名列表
	//参数：无
	//返回值：地区列表
	public function getCeQueueList($args,$page,$number = 20)
	{
		$args[] = array("AND","ceid = ceqceid");
		$data = array(
			'select' => false,
			'table' => array('cequeue','certificate'),
			'query' => $args,
			'orderby' => 'ceqid desc',
			'index' => 'ceqid',
			'serial' => 'ceqinfo'
		);
		$r = $this->db->listElements($page,$number,$data);
		return $r;
	}

	//根据ID获取地名信息
	//参数：地名ID
	//返回值：该地名信息数组
	public function getCeById($ceid)
	{
		$data = array(false,'certificate',array(array("AND","ceid = :ceid",'ceid',$ceid)));
		$sql = $this->db->makeSelect($data);
		return $this->db->fetch($sql);
	}

	//修改地名信息
	//参数：地名ID,要修改的信息
	//返回值：true
	public function modifyCe($ceid,$args)
	{
		$data = array('certificate',$args,array(array("AND","ceid = :ceid",'ceid',$ceid)));
		$sql = $this->db->makeUpdate($data);
		$this->db->exec($sql);
		return true;
	}

	public function modifyCeQueue($ceqid,$args)
	{
		$data = array('cequeue',$args,array(array("AND","ceqid = :ceqid",'ceqid',$ceqid)));
		$sql = $this->db->makeUpdate($data);
		$this->db->exec($sql);
		return true;
	}

	//增加地区
	//参数：要添加的地区的信息数组
	//返回值：地名ID
	public function addCe($args)
	{
		$data = array('certificate',$args);
		$sql = $this->db->makeInsert($data);
		$this->db->exec($sql);
		return $this->db->lastInsertId();
	}

	//删除地区
	//参数：地名ID
	//返回值：受影响的记录数
	public function delCe($ceid)
	{
		$data = array('certificate',array(array("AND","ceid = :ceid",'ceid',$ceid)));
		$sql = $this->db->makeDelete($data);
		$this->db->exec($sql);
		return $this->db->affectedRows();
	}

	public function getCeQueueById($ceqid)
	{
		$data = array(false,'cequeue',array(array("AND","ceqid = :ceqid",'ceqid',$ceqid)));
		$sql = $this->db->makeSelect($data);
		return $this->db->fetch($sql,'ceqinfo');
	}

	public function getCeQueuesByArgs($args)
	{
		$data = array(false,'cequeue',$args,false,false,false);
		$sql = $this->db->makeSelect($data);
		return $this->db->fetchAll($sql,NULL,'ceqinfo');
	}

	public function getCeQueueByArgs($args)
	{
		$args[] = array("AND","ceid = ceqceid");
		$data = array(false,array('cequeue','certificate'),$args,false,false,1);
		$sql = $this->db->makeSelect($data);
		return $this->db->fetch($sql,'ceqinfo');
	}

	public function addCeQueue($args)
	{
		$data = array('cequeue',$args);
		$sql = $this->db->makeInsert($data);
		$this->db->exec($sql);
		return $this->db->lastInsertId();
	}

	//删除地区
	//参数：地名ID
	//返回值：受影响的记录数
	public function delCeQueue($ceqid)
	{
		$data = array('cequeue',array(array("AND","ceqid = :ceqid",'ceqid',$ceqid)));
		$sql = $this->db->makeDelete($data);
		$this->db->exec($sql);
		return $this->db->affectedRows();
	}
}

?>
