<?php
namespace PHPEMS\exam;
use function \PHPEMS\M;
/*
 * Created on 2015-10-29
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */

class exercise
{

	//根据参数查询
	public function getExerciseProcessByUser($userid,$basicid,$knowsid = null)
	{
		if($knowsid)
		{
			$data = array(false,'exercise',array(array("AND","exeruserid = :exeruserid",'exeruserid',$userid),array("AND","exerbasicid = :exerbasicid",'exerbasicid',$basicid),array("AND","exerknowsid = :exerknowsid",'exerknowsid',$knowsid)));
			$sql = M('pepdo')->makeSelect($data);
			return M('pepdo')->fetch($sql);
        }
        else
		{
            $data = array(false,'exercise',array(array("AND","exeruserid = :exeruserid",'exeruserid',$userid),array("AND","exerbasicid = :exerbasicid",'exerbasicid',$basicid)),false,false,false);
            $sql = M('pepdo')->makeSelect($data);
            return M('pepdo')->fetchAll($sql,'exerknowsid');
		}
	}

	public function setExercise($args)
	{
		$userid = $args['exeruserid'];
		$basicid = $args['exerbasicid'];
        $knowsid = $args['exerknowsid'];
		$r = $this->getExerciseProcessByUser($userid,$basicid,$knowsid);
		if($r)
		{
			$data = array('exercise',$args,array(array("AND","exerid = :exerid",'exerid',$r['exerid'])));
			$sql = M('pepdo')->makeUpdate($data);
			M('pepdo')->exec($sql);
		}
		else
		{
			$data = array('exercise',$args);
			$sql = M('pepdo')->makeInsert($data);
			M('pepdo')->exec($sql);
		}
		return true;
	}
}


?>
