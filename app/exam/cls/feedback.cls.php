<?php
namespace PHPEMS\exam;
use function \PHPEMS\M;
class feedback
{
	//获取试题反馈列表
	//参数：
	//返回值：地区列表
	public function getFeedBackList($args = array(),$page = 1,$number = 20)
	{
		$data = array(
			'select' => false,
			'table' => 'feedback',
			'query' => $args,
			'orderby' => 'fbid desc'
		);
		return M('pepdo')->listElements($page,$number,$data);
	}

	public function addFeedBack($args)
	{
		$args['fbtime'] = TIME;
		$data = array('feedback',$args);
		$sql = M('pepdo')->makeInsert($data);
		M('pepdo')->exec($sql);
		return M('pepdo')->lastInsertId();
	}

	//根据地名查询
	//参数：地名字符串
	//返回值：该地名信息数组
	public function getFeedBackById($id)
	{
		$data = array(false,'feedback',array(array("AND","fbid = :fbid",'fbid',$id)),false,false,false);
		$sql = M('pepdo')->makeSelect($data);
		return M('pepdo')->fetch($sql);
	}

	//根据ID获取地名信息
	//参数：地名ID
	//返回值：该地名信息数组
	public function modifyFeedBackById($id,$args)
	{
		$data = array('feedback',$args,array(array("AND","fbid = :fbid",'fbid',$id)));
		$sql = M('pepdo')->makeUpdate($data);
		return M('pepdo')->exec($sql);
	}

	//修改地名信息
	//参数：地名ID,要修改的信息
	//返回值：true
	public function delFeedBack($id)
	{
		$data = array('feedback',array(array("AND","fbid = :fbid",'fbid',$id)));
		$sql = M('pepdo')->makeDelete($data);
		return M('pepdo')->exec($sql);
	}
}

?>
