<?php
namespace PHPEMS\content;
use function \PHPEMS\M;

class content
{
	public $db;

	public function __construct()
	{
		$this->db = M('pepdo');
	}

	public function setViewNumber($contentid)
	{
		$data = array(false,'content',array(array('AND',"contentid = :contentid",'contentid',$contentid)));
		$sql = $this->db->makeSelect($data);
		$r = $this->db->fetch($sql);
		$number = $r['contentview'] + 1;
		$data = array(
			'table' => 'content',
			'value' => array('contentview' => $number),
			'query' => array(array('AND',"contentid = :contentid",'contentid',$contentid))
		);
		$this->db->updateElement($data);
		return $number;
	}

	public function isAllowPub($cat,$user)
	{
		if(!$cat)return false;
		$userid = $user['sessionuserid'];
		$users = ','.$cat['catmanager']['pubusers'].',';
		$groupid = $user['sessiongroupid'];
		$groups = ','.$cat['catmanager']['pubgroups'].',';
		if(strpos($users,','.$userid.',') === false)return false;
		if(strpos($groups,','.$groupid.',') === false)return false;
		return true;
	}

	public function getContentList($args,$page = 1,$number = 20,$order = 'contentsequence DESC,contentinputtime DESC,contentid DESC')
	{
		$data = array(
			'select' => false,
			'table' => 'content',
			'query' => $args,
			'orderby' => $order
		);
		$r = $this->db->listElements($page,$number,$data);
		return $r;
	}

	public function delContent($id)
	{
		return $this->db->delElement(array('table' => 'content','query' => array(array('AND',"contentid = :contentid",'contentid',$id))));
	}

	public function modifyContent($id,$args)
	{
		if(isset($args['contentmoduleid']))
		unset($args['contentmoduleid']);
		$data = array(
			'table' => 'content',
			'value' => $args,
			'query' => array(array('AND',"contentid = :contentid",'contentid',$id))
		);
		return $this->db->updateElement($data);
	}

	public function addContent($args)
	{
		return $this->db->insertElement(array('table' => 'content','query' => $args));
	}

	private function _getBasicContentById($id)
	{
		$data = array(false,'content',array(array('AND',"contentid = :contentid",'contentid',$id)));
		$sql = $this->db->makeSelect($data);
		return $this->db->fetch($sql);
	}

	private function _modifyBasicContentById($id,$args)
	{
		$data = array('content',$args,array(array('AND',"contentid = :contentid",'contentid',$id)));
		$sql = $this->db->makeUpdate($data);
		return $this->db->exec($sql);
	}

	public function modifyBasciContent($id,$args)
	{
		$this->_modifyBasicContentById($id,$args);
	}

	public function getBasicContentById($id)
	{
		return $this->_getBasicContentById($id);
	}

	public function getContentById($id)
	{
		$data = array(false,'content',array(array('AND',"contentid = :contentid",'contentid',$id)));
		$sql = $this->db->makeSelect($data);
		return $this->db->fetch($sql);
	}

	public function getNearContentById($id,$catid)
	{
		$r = array();
		$data = array(false,'content',array(array('AND',"contentid < :contentid",'contentid',$id),array('AND',"contentcatid = :catid",'catid',$catid)),false,"contentid DESC",5);
		$sql = $this->db->makeSelect($data);
		$r['pre'] = $this->db->fetchAll($sql);
		$data = array(false,'content',array(array('AND',"contentid > :contentid",'contentid',$id),array('AND',"contentcatid = :catid",'catid',$catid)),false,"contentid ASC",5);
		$sql = $this->db->makeSelect($data);
		$r['next'] = $this->db->fetchAll($sql);
		return $r;
	}

	public function addCtur($args)
	{
		return $this->db->insertElement(array('table' => 'cnttouser','query' => $args));
	}

    public function getCturByArgs($args)
    {
        $data = array(false,'cnttouser',$args);
        $sql = $this->db->makeSelect($data);
        return $this->db->fetch($sql);
    }
}

?>
