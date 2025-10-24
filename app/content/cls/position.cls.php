<?php
namespace PHPEMS\content;
use function \PHPEMS\M;

class position
{
	public $G;

	public function __construct()
	{
		$this->db = M('pepdo');
	}

	public function getPosList($app = null)
	{
		if(!$app)$app = \PHPEMS\ginkgo::$app;
		$data = array(false,'position',array(array("AND","posapp = :posapp","posapp",$app)));
		$sql = $this->db->makeSelect($data);
		return $this->db->fetchAll($sql,'posid');
	}

	public function addPos($args)
	{
		$data = array('position',$args);
		$args['posapp'] = 'content';
		$sql = $this->db->makeInsert($data);
		$this->db->exec($sql);
		return $this->db->lastInsertId();
	}

	public function delPos($id)
	{
		return $this->db->delElement(array('table' => 'position','query' => array(array("AND","posid = :posid",'posid',$id))));
	}

	public function getPosById($id)
	{
		$data = array(false,'position',array(array("AND","posid = :posid",'posid',$id)));
		$sql = $this->db->makeSelect($data);
		return $this->db->fetch($sql);
	}

	public function modifyPos($id,$args)
	{
		$data = array('position',$args,array(array("AND","posid = :posid",'posid',$id)));
		$sql = $this->db->makeUpdate($data);
        return $this->db->exec($sql);
	}

	public function getPosContentList($args,$page,$number = 20)
	{
		$data = array(
			'select' => false,
			'table' => 'poscontent',
			'query' => $args,
			'orderby' => 'pcsequence DESC, pcid DESC'
		);
		return $this->db->listElements($page,$number,$data);
	}

    public function getPosFullList($args,$page,$number = 20)
    {
        $args[] = array("AND","pccontentid = contentid");
    	$data = array(
            'select' => false,
            'table' => array('poscontent','content'),
            'query' => $args,
            'orderby' => 'pcsequence DESC, pcid DESC'
        );
        return $this->db->listElements($page,$number,$data);
    }

	public function getPosContentById($id)
	{
		$data = array(false,'poscontent',array(array("AND","pcid = :pcid",'pcid',$id)));
		$sql = $this->db->makeSelect($data);
		return $this->db->fetch($sql);
	}

	public function getPosContentByArgs($args)
	{
		$data = array(false,'poscontent',$args,false,"pcid DESC");
		$sql = $this->db->makeSelect($data);
		return $this->db->fetch($sql);
	}

	public function getPosContentNumber($posid)
	{
        $data = array('count(*) as number','poscontent',array(array("AND","pcposid = :pcposid","pcposid",$posid)));
        $sql = $this->db->makeSelect($data);
        $r = $this->db->fetch($sql);
        return $r['number'];
	}

	public function addPosContent($args)
	{
		$data = array('poscontent',$args);
		$sql = $this->db->makeInsert($data);
		$this->db->exec($sql);
		return $this->db->lastInsertId();
	}

	public function modifyPosContentByContentId($id,$args,$app = null)
	{
		if(!$app)$app = \PHPEMS\ginkgo::$app;
		$data = array('poscontent',$args,array(array("AND","pccontentid = :pccontentid",'pccontentid',$id),array("AND","pcposapp = :pcposapp",'pcposapp',$app)));
		$sql = $this->db->makeUpdate($data);
		$this->db->exec($sql);
		return $this->db->affectedRows();
	}

	public function modifyPosContent($id,$args)
	{
		$data = array('poscontent',$args,array(array("AND","pcid = :pcid",'pcid',$id)));
		$sql = $this->db->makeUpdate($data);
        return $this->db->exec($sql);
	}

	public function delPosContent($id)
	{
		return $this->db->delElement(array('table' => 'poscontent','query' => array(array("AND","pcid = :pcid",'pcid',$id))));
	}
}

?>
