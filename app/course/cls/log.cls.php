<?php
namespace PHPEMS\course;
use function \PHPEMS\M;
class log
{
	public $db;

	public function __construct()
	{
		$this->db = M('pepdo');
	}

	public function getPassedLogsNumberByCsid($csid,$userid)
	{
        $data = array('count(*) as number',array('log','course'),array(array('AND','loguserid = :loguserid','loguserid',$userid),array('AND','logstatus = 1'),array('AND','courseid = logcourseid'),array('AND','coursecsid = :coursecsid','coursecsid',$csid)));
        $sql = $this->db->makeSelect($data);
        $r = $this->db->fetch($sql);
        return $r['number'];
	}

    public function getLogsByCsid($csid,$userid)
    {
        $data = array('logid,loguserid,logcourseid,logstatus,logtime,logendtime,logprogress,coursetitle',array('log','course'),array(array('AND','loguserid = :loguserid','loguserid',$userid),array('AND','courseid = logcourseid'),array('AND','coursecsid = :coursecsid','coursecsid',$csid)));
        $sql = $this->db->makeSelect($data);
        return $this->db->fetchAll($sql,'logcourseid');
    }

	public function getLogByArgs($args)
	{
		$data = array(false,'log',$args);
		$sql = $this->db->makeSelect($data);
		return $this->db->fetch($sql);
	}

	public function addLog($args)
	{
		$args['logtime'] = TIME;
		return $this->db->insertElement(array('table' => 'log','query' => $args));
	}

	public function modifyLog($id,$args)
    {
        $data = array('log',$args,array(array("and","logid = :logid","logid",$id)));
        $sql = $this->db->makeUpdate($data);
        return $this->db->exec($sql);
    }
}

?>
