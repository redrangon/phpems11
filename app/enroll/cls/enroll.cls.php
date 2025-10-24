<?php
namespace PHPEMS\enroll;
use function \PHPEMS\M;
class enroll
{
	public $db;

	public function __construct()
	{
		
		$this->db = M('pepdo');
	}

    public function getEnrollById($enrollid)
    {
        $data = array(
            'table' => 'enroll',
            'query' => array(array("AND","enrollid = :enrollid","enrollid",$enrollid))
        );
        return $this->db->getElement($data);
    }

    public function getEnrollByArgs($args)
    {
        $data = array(
            'table' => 'enroll',
            'query' => $args,
            'limit' => 1
        );
        return $this->db->getElement($data);
    }

    public function getEnrolls($args,$orderby = 'enrollid desc',$select = false)
    {
        $data = array(
            'select' => $select,
            'table' => 'enroll',
            'query' => $args,
            'limit' => false,
            'orderby' => $orderby
        );
        return $this->db->getElements($data);
    }

    public function getEnrollPlusList($args,$page = 1,$number = 20,$orderby = 'enrollid desc')
    {
        $args[] = array("AND","enrollbatid = enbid");
        $data = array(
            'table' => array('enroll','enroll_bats'),
            'query' => $args,
            'limit' => false,
            'orderby' => $orderby
        );
        return $this->db->listElements($page,$number = 20,$data);
    }

    public function getEnrollList($args,$page = 1,$number = 20,$orderby = 'enrollid desc')
    {
        $data = array(
            'table' => 'enroll',
            'query' => $args,
            'limit' => false,
            'orderby' => $orderby
        );
        return $this->db->listElements($page,$number = 20,$data);
    }

    public function addEnroll($args)
    {
        $data = array(
            'table' => 'enroll',
            'query' => $args
        );
        return $this->db->insertElement($data);
    }

    public function modifyEnroll($enrollid,$args)
    {
        $data = array(
            'table' => 'enroll',
            'value' => $args,
            'query' => array(array("AND","enrollid = :enrollid","enrollid",$enrollid))
        );
        return $this->db->updateElement($data);
    }

    public function modifyEnrollByArgs($values,$args)
    {
        $data = array(
            'table' => 'enroll',
            'value' => $values,
            'query' => $args
        );
        return $this->db->updateElement($data);
    }

    public function delEnroll($parm,$type = 'id')
    {
        if($type == 'id')$args = array(array("AND","enrollid = :enrollid","enrollid",$parm));
        else $args = $parm;
        $data = array(
            'table' => 'enroll',
            'query' => $args
        );
        return $this->db->delElement($data);
    }

    public function getEnrollBatById($enbid)
    {
        $data = array(
            'table' => 'enroll_bats',
            'query' => array(array("AND","enbid = :enbid","enbid",$enbid))
        );
        return $this->db->getElement($data);
    }

    public function getEnrollBatByArgs($args)
    {
        $data = array(
            'table' => 'enroll_bats',
            'query' => $args,
            'limit' => 1
        );
        return $this->db->getElement($data);
    }

    public function getEnrollBats($args,$orderby = 'enbid desc')
    {
        $data = array(
            'table' => 'enroll_bats',
            'query' => $args,
            'limit' => false,
            'orderby' => $orderby
        );
        return $this->db->getElements($data);
    }

    public function getEnrollBatsList($args,$page = 1,$number = 20,$orderby = 'enbid desc')
    {
        $data = array(
            'table' => 'enroll_bats',
            'query' => $args,
            'limit' => false,
            'orderby' => $orderby
        );
        return $this->db->listElements($page,$number,$data);
    }

    public function addEnrollBat($args)
    {
        $data = array(
            'table' => 'enroll_bats',
            'query' => $args
        );
        return $this->db->insertElement($data);
    }

    public function modifyEnrollBat($enbid,$args)
    {
        $data = array(
            'table' => 'enroll_bats',
            'value' => $args,
            'query' => array(array("AND","enbid = :enbid","enbid",$enbid))
        );
        return $this->db->updateElement($data);
    }

    public function delEnrollBat($parm,$type = 'id')
    {
        if($type == 'id')$args = array(array("AND","enbid = :enbid","enbid",$parm));
        else $args = $parm;
        $data = array(
            'table' => 'enroll_bats',
            'query' => $args
        );
        return $this->db->delElement($data);
    }

    public function getEnrollBatsListByUser($args,$page = 1,$number = 20,$orderby = 'enrollid desc')
    {
        $args[] = array("AND","enrollbatid = enbid");
        $data = array(
            'table' => array('enroll','enroll_bats'),
            'query' => $args,
            'limit' => false,
            'orderby' => $orderby
        );
        return $this->db->listElements($page,$number = 20,$data);
    }

}

?>