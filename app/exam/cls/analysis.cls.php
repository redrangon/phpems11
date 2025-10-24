<?php
namespace PHPEMS\exam;
use function \PHPEMS\M;
/*
 * Created on 2011-11-21
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 * 对答疑进行操作
 */
class analysis
{
	public $db;

	public function __construct()
	{
		$this->db = M('pepdo');
	}

	public function insertAnalysis($args)
	{
		$data = array('answer',$args);
		$sql = $this->sql->makeInsert($data);
		$this->db->exec($sql);
		return $this->db->lastInsertId();
	}

	public function getAnalysisList($page,$number = 20,$args)
	{
		$data = array(
			'select' => false,
			'table' => array('questionanalysis','questions'),
			'index' => false,
			'serial' => false,
			'query' => $args,
			'orderby' => 'qaid DESC',
			'groupby' => false
		);
		return $this->db->listElements($page,20,$data);
	}

	public function modifyAnalysis($qaid,$args)
	{
		$data = array('questionanalysis',$args,array(array("AND","qaid = :qaid",'qaid',$qaid)));
		$sql = $this->sql->makeUpdate($data);
        return $this->db->exec($sql);
	}

	public function getAnalysisByArgs($args)
	{
        $data = array(false,'questionanalysis',$args);
        $sql = $this->sql->makeSelect($data);
        return $this->db->fetch($sql);
	}

	public function getAnalysisById($qaid)
	{
		$data = array(false,'questionanalysis',array(array("AND","qaid = :qaid",'qaid',$qaid)));
		$sql = $this->sql->makeSelect($data);
		return $this->db->fetch($sql);
	}
}

?>
