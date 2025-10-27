<?php
namespace PHPEMS\core;
use function \PHPEMS\M;
class apps
{
	//根据应用名获取应用信息
	public function getApp($appid)
	{
		$data = array(false,'app',array(array("AND","appid = :appid","appid",$appid)));
		$sql = M('pepdo')->makeSelect($data);
		return M('pepdo')->fetch($sql,array('appsetting',"appusersetting"));
	}

	//修改应用信息
	public function modifyApp($appid,$args)
	{
		$data = array('app',$args,array(array("AND","appid = :appid","appid",$appid)));
		$sql = M('pepdo')->makeUpdate($data);
		return M('pepdo')->exec($sql);
	}

	//添加应用信息
	public function addApp($appid,$args)
	{
		$args['appid'] = $appid;
		$data = array('app',$args);
		$sql = M('pepdo')->makeInsert($data);
		M('pepdo')->exec($sql);
		return M('pepdo')->lastInsertId();
	}

	//获取本地应用列表
	public function getLocalAppList()
	{
		return M('files')->listDir('app');
	}

	//获取数据库内应用列表
	public function getAppList($args = 1)
	{
		$data = array(false,'app',$args,false,false,false);
		$sql = M('pepdo')->makeSelect($data);
		$r = M('pepdo')->fetchAll($sql,'appid','appsetting');
		foreach($r as $key => $p)
		{
			if(!file_exists('app/'.$key))unset($r[$key]);
		}
		return $r;
	}
}

?>