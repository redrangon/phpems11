<?php
namespace PHPEMS\content;
use function \PHPEMS\M;
class block
{

	public function getBlockList($args,$page,$number = 20)
	{
		$data = array(
			'select' => false,
			'table' => 'block',
			'query' => $args,
			'orderby' => 'blockid DESC'
		);
		return M('pepdo')->listElements($page,$number,$data);
	}

	public function addBlock($args)
	{
		$data = array('block',$args);
		$sql = M('pepdo')->makeInsert($data);
		M('pepdo')->exec($sql);
		return M('pepdo')->lastInsertId();
	}

	public function delBlock($id)
	{
		return M('pepdo')->delElement(array('table' => 'block','query' => array(array("AND","blockid = :blockid",'blockid',$id))));
	}

	public function getBlockById($id)
	{
		$data = array(false,'block',array(array("AND","blockid = :blockid",'blockid',$id)));
		$sql = M('pepdo')->makeSelect($data);
		return M('pepdo')->fetch($sql,'blockcontent');
	}

	public function modifyBlock($id,$args)
	{
		$data = array('block',$args,array(array("AND","blockid = :blockid",'blockid',$id)));
		$sql = M('pepdo')->makeUpdate($data);
		return M('pepdo')->exec($sql);
	}
}

?>
