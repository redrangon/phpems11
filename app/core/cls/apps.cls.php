<?php
namespace PHPEMS\core;
use function \PHPEMS\M;
class apps
{
	public $db;
    public $files;

	public function __construct()
	{
		$this->db = M('pepdo');
		$this->files = M('files');
	}

	//根据应用名获取应用信息
	public function getApp($appid)
	{
		$data = array(false,'app',array(array("AND","appid = :appid","appid",$appid)));
		$sql = $this->db->makeSelect($data);
		return $this->db->fetch($sql,array('appsetting',"appusersetting"));
	}

	//修改应用信息
	public function modifyApp($appid,$args)
	{
		$data = array('app',$args,array(array("AND","appid = :appid","appid",$appid)));
		$sql = $this->db->makeUpdate($data);
		return $this->db->exec($sql);
	}

	//添加应用信息
	public function addApp($appid,$args)
	{
		$args['appid'] = $appid;
		$data = array('app',$args);
		$sql = $this->db->makeInsert($data);
		$this->db->exec($sql);
		return $this->db->lastInsertId();
	}

	//获取本地应用列表
	public function getLocalAppList()
	{
		return $this->files->listDir('app');
	}

	//获取数据库内应用列表
	public function getAppList($args = 1)
	{
		$data = array(false,'app',$args,false,false,false);
		$sql = $this->db->makeSelect($data);
		$r = $this->db->fetchAll($sql,'appid','appsetting');
		foreach($r as $key => $p)
		{
			if(!file_exists('app/'.$key))unset($r[$key]);
		}
		return $r;
	}
}

?>