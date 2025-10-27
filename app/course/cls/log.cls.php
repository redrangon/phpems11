<?php
namespace PHPEMS\course;
use function \PHPEMS\M;
class log
{
	public function getPassedLogsNumberByCsid($csid,$userid)
	{
        $data = array('count(*) as number',array('log','course'),array(array('AND','loguserid = :loguserid','loguserid',$userid),array('AND','logstatus = 1'),array('AND','courseid = logcourseid'),array('AND','coursecsid = :coursecsid','coursecsid',$csid)));
        $sql = M('pepdo')->makeSelect($data);
        $r = M('pepdo')->fetch($sql);
        return $r['number'];
	}

    public function getLogsByCsid($csid,$userid)
    {
        $data = array('logid,loguserid,logcourseid,logstatus,logtime,logendtime,logprogress,coursetitle',array('log','course'),array(array('AND','loguserid = :loguserid','loguserid',$userid),array('AND','courseid = logcourseid'),array('AND','coursecsid = :coursecsid','coursecsid',$csid)));
        $sql = M('pepdo')->makeSelect($data);
        return M('pepdo')->fetchAll($sql,'logcourseid');
    }

	public function getLogByArgs($args)
	{
		$data = array(false,'log',$args);
		$sql = M('pepdo')->makeSelect($data);
		return M('pepdo')->fetch($sql);
	}

	public function addLog($args)
	{
		$args['logtime'] = TIME;
		return M('pepdo')->insertElement(array('table' => 'log','query' => $args));
	}

	public function modifyLog($id,$args)
    {
        $data = array('log',$args,array(array("and","logid = :logid","logid",$id)));
        $sql = M('pepdo')->makeUpdate($data);
        return M('pepdo')->exec($sql);
    }
}

?>
