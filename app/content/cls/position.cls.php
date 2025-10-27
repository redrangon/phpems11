<?php
namespace PHPEMS\content;
use function \PHPEMS\M;

class position
{

	public function getPosList($app = null)
	{
		if(!$app)$app = \PHPEMS\ginkgo::$app;
		$data = array(false,'position',array(array("AND","posapp = :posapp","posapp",$app)));
		$sql = M('pepdo')->makeSelect($data);
		return M('pepdo')->fetchAll($sql,'posid');
	}

	public function addPos($args)
	{
		$data = array('position',$args);
		$args['posapp'] = 'content';
		$sql = M('pepdo')->makeInsert($data);
		M('pepdo')->exec($sql);
		return M('pepdo')->lastInsertId();
	}

	public function delPos($id)
	{
		return M('pepdo')->delElement(array('table' => 'position','query' => array(array("AND","posid = :posid",'posid',$id))));
	}

	public function getPosById($id)
	{
		$data = array(false,'position',array(array("AND","posid = :posid",'posid',$id)));
		$sql = M('pepdo')->makeSelect($data);
		return M('pepdo')->fetch($sql);
	}

	public function modifyPos($id,$args)
	{
		$data = array('position',$args,array(array("AND","posid = :posid",'posid',$id)));
		$sql = M('pepdo')->makeUpdate($data);
        return M('pepdo')->exec($sql);
	}

	public function getPosContentList($args,$page,$number = 20)
	{
		$data = array(
			'select' => false,
			'table' => 'poscontent',
			'query' => $args,
			'orderby' => 'pcsequence DESC, pcid DESC'
		);
		return M('pepdo')->listElements($page,$number,$data);
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
        return M('pepdo')->listElements($page,$number,$data);
    }

	public function getPosContentById($id)
	{
		$data = array(false,'poscontent',array(array("AND","pcid = :pcid",'pcid',$id)));
		$sql = M('pepdo')->makeSelect($data);
		return M('pepdo')->fetch($sql);
	}

	public function getPosContentByArgs($args)
	{
		$data = array(false,'poscontent',$args,false,"pcid DESC");
		$sql = M('pepdo')->makeSelect($data);
		return M('pepdo')->fetch($sql);
	}

	public function getPosContentNumber($posid)
	{
        $data = array('count(*) as number','poscontent',array(array("AND","pcposid = :pcposid","pcposid",$posid)));
        $sql = M('pepdo')->makeSelect($data);
        $r = M('pepdo')->fetch($sql);
        return $r['number'];
	}

	public function addPosContent($args)
	{
		$data = array('poscontent',$args);
		$sql = M('pepdo')->makeInsert($data);
		M('pepdo')->exec($sql);
		return M('pepdo')->lastInsertId();
	}

	public function modifyPosContentByContentId($id,$args,$app = null)
	{
		if(!$app)$app = \PHPEMS\ginkgo::$app;
		$data = array('poscontent',$args,array(array("AND","pccontentid = :pccontentid",'pccontentid',$id),array("AND","pcposapp = :pcposapp",'pcposapp',$app)));
		$sql = M('pepdo')->makeUpdate($data);
		M('pepdo')->exec($sql);
		return M('pepdo')->affectedRows();
	}

	public function modifyPosContent($id,$args)
	{
		$data = array('poscontent',$args,array(array("AND","pcid = :pcid",'pcid',$id)));
		$sql = M('pepdo')->makeUpdate($data);
        return M('pepdo')->exec($sql);
	}

	public function delPosContent($id)
	{
		return M('pepdo')->delElement(array('table' => 'poscontent','query' => array(array("AND","pcid = :pcid",'pcid',$id))));
	}
}

?>
