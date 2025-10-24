<?php
namespace PHPEMS\seminar;
use function \PHPEMS\M;
class seminar
{
	public $db;

	public function __construct()
	{
		$this->db = M('pepdo');
	}

	public function getSeminarList($args,$page,$number = 10,$orderby = 'seminarorder desc,seminarid desc')
	{
		$data = array(
			'select' => false,
			'table' => 'seminar',
			'query' => $args,
			'orderby' => $orderby
		);
		return $this->db->listElements($page,$number,$data);
	}

	public function getSeminarsByArgs($args,$orderby = 'seminarorder desc,seminarid desc')
	{
        $data = array(false,'seminar',$args,false,$orderby,false);
        $sql = $this->db->makeSelect($data);
        return $this->db->fetchAll($sql);
	}

	public function addSeminar($args)
	{
		return $this->db->insertElement(array('table' => 'seminar','query' => $args));
	}

    public function delSeminar($seminarid)
    {
        $args = array(
            array("AND","seminarid = :seminarid","seminarid",$seminarid)
        );
    	return $this->db->delElement(array('table' => 'seminar','query' => $args));
    }

    public function modifySeminar($seminarid,$args)
    {
        $data = array(
            'table' => 'seminar',
            'value' => $args,
            'query' => array(array("AND","seminarid = :seminarid","seminarid",$seminarid))
        );
        return $this->db->updateElement($data);
    }

    public function getSeminarById($seminarid)
    {
        $args = array(
        	array("AND","seminarid = :seminarid","seminarid",$seminarid)
		);
    	$data = array(false,'seminar',$args);
        $sql = $this->db->makeSelect($data);
        return $this->db->fetch($sql);
    }

    public function getSeminarLayoutList($args,$page,$number = 10,$orderby = 'slayoutorder desc,slayoutid desc')
    {
        $data = array(
            'select' => false,
            'table' => 'seminar_layout',
            'query' => $args,
            'orderby' => $orderby
        );
        return $this->db->listElements($page,$number,$data);
    }

    public function getSeminarLayoutsByArgs($args,$orderby = 'slayoutorder desc,slayoutid desc')
    {
        $data = array(false,'seminar_layout',$args,false,$orderby,false);
        $sql = $this->db->makeSelect($data);
        return $this->db->fetchAll($sql);
    }

    public function addSeminarLayout($args)
    {
        return $this->db->insertElement(array('table' => 'seminar_layout','query' => $args));
    }

    public function modifySeminarLayout($slayoutid,$args)
    {
        $data = array(
            'table' => 'seminar_layout',
            'value' => $args,
            'query' => array(array("AND","slayoutid = :slayoutid","slayoutid",$slayoutid))
        );
        return $this->db->updateElement($data);
    }

    public function delSeminarLayout($slayoutid)
    {
        $args = array(
            array("AND","slayoutid = :slayoutid","slayoutid",$slayoutid)
        );
        return $this->db->delElement(array('table' => 'seminar_layout','query' => $args));
    }

    public function getSeminarLayoutById($slayoutid)
    {
        $args = array(
            array("AND","slayoutid = :slayoutid","slayoutid",$slayoutid)
        );
        $data = array(false,'seminar_layout',$args);
        $sql = $this->db->makeSelect($data);
        return $this->db->fetch($sql);
    }

    public function getSeminarElemList($args,$page,$number = 10,$orderby = 'selorder desc,selid desc')
    {
        $data = array(
            'select' => false,
            'table' => 'seminar_elem',
            'query' => $args,
            'orderby' => $orderby
        );
        return $this->db->listElements($page,$number,$data);
    }

    public function getSeminarElemsByArgs($args,$orderby = 'selorder desc,selid desc')
    {
        $data = array(false,'seminar_elem',$args,false,$orderby,false);
        $sql = $this->db->makeSelect($data);
        return $this->db->fetchAll($sql);
    }

    public function addSeminarElem($args)
    {
        return $this->db->insertElement(array('table' => 'seminar_elem','query' => $args));
    }

    public function modifySeminarElem($selid,$args)
    {
        $data = array(
            'table' => 'seminar_elem',
            'value' => $args,
            'query' => array(array("AND","selid = :selid","selid",$selid))
        );
        return $this->db->updateElement($data);
    }

    public function delSeminarElem($selid)
    {
        $args = array(
            array("AND","selid = :selid","selid",$selid)
        );
        return $this->db->delElement(array('table' => 'seminar_elem','query' => $args));
    }

    public function getSeminarElemById($selid)
    {
        $args = array(
            array("AND","selid = :selid","selid",$selid)
        );
        $data = array(false,'seminar_elem',$args);
        $sql = $this->db->makeSelect($data);
        return $this->db->fetch($sql,'seldata');
    }

    public function parseSeminar($seminarid)
    {
        $seminar = $this->getSeminarById($seminarid);
        if(!$seminar)return false;
        $args = array();
        $args[] = array("AND","slayoutseminar = :slayoutseminar","slayoutseminar",$seminarid);
        $layouts = $this->getSeminarLayoutsByArgs($args);
        $alltpl = '';
        foreach($layouts as $layout)
        {
            $ltpl = stripslashes(htmlspecialchars_decode($layout['slayoutcode']));
            $args = array();
            $args[] = array("AND","selseminar = :selseminar","selseminar",$seminarid);
            $args[] = array("AND","sellayout = :sellayout","sellayout",$layout['slayoutid']);
            $elems = $this->getSeminarElemsByArgs($args);
            $eltpl = '';
            $leltpl = '';
            $reltpl = '';
            foreach($elems as $elem)
            {
                $tpl = stripslashes(htmlspecialchars_decode($elem['selcode']));
                $tpl = str_replace('<!--{{datasource}}-->','{x2;seminar:'.$elem['selid'].'}',$tpl);
                if($elem['selpos'])
                {
                    if($elem['selpos'] == 1)
                    {
                        $leltpl .= $tpl;
                    }
                    else
                    {
                        $reltpl .= $tpl;
                    }
                }
                else
                {
                    $eltpl .= $tpl;
                }
            }
            $ltpl = str_replace('<!--{{childrentpls}-->',$eltpl,$ltpl);
            $ltpl = str_replace('<!--{{middlechildrentpls}-->',$eltpl,$ltpl);
            $ltpl = str_replace('<!--{{leftchildrentpls}-->',$leltpl,$ltpl);
            $ltpl = str_replace('<!--{{rightchildrentpls}-->',$reltpl,$ltpl);
            $alltpl .= $ltpl;
        }
        $stpl = str_replace('<!--{{childrentpls}-->',$alltpl,stripslashes(htmlspecialchars_decode($seminar['seminarcode'])));
        return $stpl;
    }

    public function getSeminarContentList($args,$page,$number = 10,$orderby = 'sctorder desc,contentid desc')
    {
        $args[] = array("AND","contentid = sctcontentid");
        $data = array(
            'select' => false,
            'table' => array('seminar_content','content'),
            'query' => $args,
            'orderby' => $orderby
        );
        return $this->db->listElements($page,$number,$data);
    }

    public function addSeminarContent($args)
    {
        return $this->db->insertElement(array('table' => 'seminar_content','query' => $args));
    }

    public function delSeminarContent($sctid)
    {
        $args = array(
            array("AND","sctid = :sctid","sctid",$sctid)
        );
        return $this->db->delElement(array('table' => 'seminar_content','query' => $args));
    }

    public function modifySeminarContent($sctid,$args)
    {
        $data = array(
            'table' => 'seminar_content',
            'value' => $args,
            'query' => array(array("AND","sctid = :sctid","sctid",$sctid))
        );
        return $this->db->updateElement($data);
    }
}

?>
