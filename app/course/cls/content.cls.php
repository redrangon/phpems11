<?php
namespace PHPEMS\course;
use function \PHPEMS\M;
class content
{
	public $G;
	public $dirmoduleid = 40;

	public function __construct()
	{
		$this->db = M('pepdo');
	}

	public function dgCourse($dirid = 0,&$sources,&$ids)
	{
		if($sources[$dirid])
		{
			if($dirid)$ids[] = 'start';
			foreach($sources[$dirid] as $source)
			{
				if($source['coursemoduleid'] == $this->dirmoduleid)
				{
					$ids[] = $source['courseid'];
					$this->dgCourse($source['courseid'],$sources,$ids);
				}
				else
				{
					$ids[] = $source['courseid'];
				}
			}
			if($dirid)$ids[] = 'end';
		}
		return $ids;
	}

	public function getCourseContentNumber($courseid)
	{
		$data = array("count(*) AS number",'course',array(array('AND',"coursecsid = :coursecsid",'coursecsid',$courseid)));
		$sql = $this->db->makeSelect($data);
		$r = $this->db->fetch($sql);
		return $r['number'];
	}

	public function getCoursesByCsid($csid,$order = 'coursesequence DESC,courseinputtime ASC,courseid ASC')
	{
        $data = array(false,'course',array(array('AND',"coursecsid = :coursecsid",'coursecsid',$csid)),false,$order,false);
        $sql = $this->db->makeSelect($data);
        $r = $this->db->fetchAll($sql,'courseid');
        return array('data' => $r);
	}

	public function getCourseList($args = array(),$page = 1,$number = 20,$order = 'coursesequence DESC,courseinputtime ASC,courseid ASC')
	{
		$data = array(
			'select' => false,
			'table' => 'course',
			'query' => $args,
			'orderby' => $order
		);
		$r = $this->db->listElements($page,$number,$data);
		return $r;
	}

	public function delCourse($id)
	{
		return $this->db->delElement(array('table' => 'course','query' => array(array('AND',"courseid = :courseid",'courseid',$id))));
	}

	public function modifyCourse($id,$args)
	{
		if(isset($args['coursemoduleid']))
		unset($args['coursemoduleid']);
		$data = array(
			'table' => 'course',
			'value' => $args,
			'query' => array(array('AND',"courseid = :courseid",'courseid',$id))
		);
		return $this->db->updateElement($data);
	}

	public function addCourse($args)
	{
		return $this->db->insertElement(array('table' => 'course','query' => $args));
	}

	private function _getBasicCourseById($id)
	{
		$data = array(false,'course',array(array('AND',"courseid = :courseid",'courseid',$id)));
		$sql = $this->db->makeSelect($data);
		return $this->db->fetch($sql);
	}

	private function _modifyBasicCourseById($id,$args)
	{
		$data = array('course',$args,array(array('AND',"courseid = :courseid",'courseid',$id)));
		$sql = $this->db->makeUpdate($data);
		return $this->db->exec($sql);
	}

	public function modifyBasciCourse($id,$args)
	{
		$this->_modifyBasiccourseById($id,$args);
	}

	public function getBasicCourseById($id)
	{
		return $this->_getBasiccourseById($id);
	}

	public function getCourseById($id)
	{
		$data = array(false,'course',array(array('AND',"courseid = :courseid",'courseid',$id)));
		$sql = $this->db->makeSelect($data);
		return $this->db->fetch($sql);
	}

	public function getNearCourseById($id,$catid)
	{
		$r = array();
		$data = array(false,'course',array(array('AND',"courseid < :courseid",'courseid',$id),array('AND',"coursecatid = :catid",'catid',$catid)),false,"courseid DESC",5);
		$sql = $this->db->makeSelect($data);
		$r['pre'] = $this->db->fetchAll($sql);
		$data = array(false,'course',array(array('AND',"courseid > :courseid",'courseid',$id),array('AND',"coursecatid = :catid",'catid',$catid)),false,"courseid ASC",5);
		$sql = $this->db->makeSelect($data);
		$r['next'] = $this->db->fetchAll($sql);
		return $r;
	}
}

?>
