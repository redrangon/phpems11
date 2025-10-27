<?php
namespace PHPEMS\document;
use function \PHPEMS\M;
class attach
{
	//按页获取附件列表
	//参数：无
	//返回值：附件列表
	public function getAttachList($args,$page,$number = PN)
	{
		$data = array(
			'select' => false,
			'table' => 'attach',
			'query' => $args,
			'index' => 'attid'
		);
		$r = M('pepdo')->listElements($page,$number,$data);
		return $r;
	}

	//根据ID获取附件信息
	//参数：附件ID
	//返回值：该附件信息数组
	public function getAttachById($attid)
	{
		$data = array(false,'attach',array(array('AND',"attid = :attid",'attid',$attid)));
		$sql = M('pepdo')->makeSelect($data);
		return M('pepdo')->fetch($sql);
	}

	public function addAttach($args)
	{
		$args['attinputtime'] = TIME;
		$data = array('attach',$args);
		$sql = M('pepdo')->makeInsert($data);
		M('pepdo')->exec($sql);
		return M('pepdo')->lastInsertId();
	}

	//修改附件信息
	//参数：附件ID,要修改的信息
	//返回值：true
	public function modifyAttach($attid,$args)
	{
		$data = array('attach',$args,array(array('AND',"attid = :attid",'attid',$attid)));
		$sql = M('pepdo')->makeUpdate($data);
		M('pepdo')->exec($sql);
		return true;
	}

	//删除附件
	//参数：附件ID
	//返回值：受影响的记录数
	public function delAttach($attid)
	{
		$data = array('attach',array(array('AND',"attid = :attid",'attid',$attid)));
		$sql = M('pepdo')->makeDelete($data);
		M('pepdo')->exec($sql);
		return M('pepdo')->affectedRows();
	}

	public function addAttachtype($args)
	{
		$data = array('attachtype',$args);
		$sql = M('pepdo')->makeInsert($data);
		M('pepdo')->exec($sql);
		return M('pepdo')->lastInsertId();
	}

	public function getAllowAttachExts()
	{
		$exts = array();
		$r = $this->getAttachtypeList();
		foreach($r as $p)
		{
			$tmp = explode(',',$p['attachexts']);
			if(count($tmp))
			{
				foreach($tmp as $tp)
				{
					if($tp)
					$exts[] = $tp;
				}
			}
		}
		return $exts;
	}

	public function getAttachtypeList()
	{
		$data = array(false,'attachtype',1);
		$sql = M('pepdo')->makeSelect($data);
		return M('pepdo')->fetchAll($sql,'atid');
	}

	public function getAttachtypeByName($attachtype)
	{
		$data = array(false,'attachtype',array(array('AND',"attachtype = :attachtype",'attachtype',$attachtype)));
		$sql = M('pepdo')->makeSelect($data);
		return M('pepdo')->fetch($sql);
	}

	public function getAttachtypeById($atid)
	{
		$data = array(false,'attachtype',array(array('AND',"atid = :atid",'atid',$atid)));
		$sql = M('pepdo')->makeSelect($data);
		return M('pepdo')->fetch($sql);
	}

	public function modifyAttachtypeById($args,$atid)
	{
		$data = array('attachtype',$args,array(array('AND',"atid = :atid",'atid',$atid)));
		$sql = M('pepdo')->makeUpdate($data);
		M('pepdo')->exec($sql);
		return true;
	}

	public function delAttachtypeById($atid)
	{
		$data = array('attachtype',array(array('AND',"atid = :atid",'atid',$atid)));
		$sql = M('pepdo')->makeDelete($data);
		M('pepdo')->exec($sql);
		return M('pepdo')->affectedRows();
	}
}

?>
