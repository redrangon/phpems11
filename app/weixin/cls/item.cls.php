<?php

namespace PHPEMS\weixin;
use function \PHPEMS\M;
class item
{
	public $db;
    public function __construct($parms = 'default')
	{
		$this->db = M('pepdo');
	}

    public function addItem($args)
    {
        return $this->db->insertElement(array('table' => 'items','query' => $args));
    }
	
	public function modifyItem($itemid,$args)
    {
        return $this->db->updateElement(array(
				'table' => 'items',
				'value' => $args,
				'query' => array(array('AND',"itemid = :itemid",'itemid',$itemid))
			)
		);
    }

    public function delItem($itemid)
    {
        return $this->db->delElement(array('table' => 'items','query' => array(array('AND',"itemid = :itemid",'itemid',$itemid))));
    }

    public function getItemList($args = array(),$page = 1,$number = 20, $orderby = "itemid desc")
    {
        $data = array(
            'select' => false,
            'table' => 'items',
            'query' => $args,
            'orderby' => $orderby,
            'serial' => 'itemimages'
        );
        return $this->db->listElements($page,$number,$data);
    }

    public function getItemById($itemid)
    {
        $args  =array(
            array("AND","itemid = :itemid","itemid",$itemid)
        );
        $data = array(
            'select' => false,
            'table' => 'items',
            'query' => $args,
            'serial' => 'itemimages'
        );
        return $this->db->getElement($data);
    }

    public function getItemByCode($itemcode)
    {
        $args  =array(
            array("AND","itemcode = :itemcode","itemcode",$itemcode)
        );
        $data = array(
            'select' => false,
            'table' => 'items',
            'query' => $args,
            'serial' => 'itemimages'
        );
        return $this->db->getElement($data);
    }

    public function getItemsByArgs($args = array())
    {
        $data = array(
            'select' => false,
            'table' => 'items',
            'query' => $args,
            'serial' => 'itemimages',
            'limit' => 20
        );
        return $this->db->getElements($data);
    }
}

?>
