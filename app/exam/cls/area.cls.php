<?php
namespace PHPEMS\exam;
use function \PHPEMS\M;
class area
{
	//获取地名列表
	//参数：无
	//返回值：地区列表
	public function getAreaList()
	{
		$data = array(false,'area',array(),false,'areaid ASC');
		$sql = M('pepdo')->makeSelect($data);
		return M('pepdo')->fetchAll($sql,'areaid');
	}

	//按页获取地名列表
	//参数：无
	//返回值：地区列表
	public function getAreaListByPage($page,$number = 20)
	{
		$data = array(
			'select' => false,
			'table' => 'area',
			'query' => 1,
			'index' => 'areaid'
		);
		return M('pepdo')->listElements($page,$number,$data);
	}

	//根据地名查询
	//参数：地名字符串
	//返回值：该地名信息数组
	public function getAreaByName($area)
	{
		$data = array(false,'area',array(array("AND","area = :area",'area',$area)),false,false,false);
		$sql = M('pepdo')->makeSelect($data);
		return M('pepdo')->fetch($sql);
	}

	//根据ID获取地名信息
	//参数：地名ID
	//返回值：该地名信息数组
	public function getAreaById($areaid)
	{
		$data = array(false,'area',array(array("AND","areaid = :areaid",'areaid',$areaid)));
		$sql = M('pepdo')->makeSelect($data);
		return M('pepdo')->fetch($sql);
	}

	//修改地名信息
	//参数：地名ID,要修改的信息
	//返回值：true
	public function modifyArea($areaid,$args)
	{
		$data = array('area',$args,array(array("AND","areaid = :areaid",'areaid',$areaid)));
		$sql = M('pepdo')->makeUpdate($data);
		M('pepdo')->exec($sql);
		return true;
	}

	//增加地区
	//参数：要添加的地区的信息数组
	//返回值：地名ID
	public function addArea($args)
	{
		$data = array(false,'area',array(array("AND","areaid = :areaid",'areaid',$args['areacode'])));
		$sql = M('pepdo')->makeSelect($data);
		if(M('pepdo')->fetch($sql))return false;
		$data = array('area',$args);
		$sql = M('pepdo')->makeInsert($data);
		M('pepdo')->exec($sql);
		return M('pepdo')->lastInsertId();
	}

	//删除地区
	//参数：地名ID
	//返回值：受影响的记录数
	public function delArea($id)
	{
		$data = array('area',array(array("AND","areaid = :areaid",'areaid',$id)));
		$sql = M('pepdo')->makeDelete($data);
		M('pepdo')->exec($sql);
		return M('pepdo')->affectedRows();
	}
}

?>
