<?php

namespace PHPEMS\weixin;
use function \PHPEMS\M;
class item
{

    public function addItem($args)
    {
        return M('pepdo')->insertElement(array('table' => 'items','query' => $args));
    }
	
	public function modifyItem($itemid,$args)
    {
        return M('pepdo')->updateElement(array(
				'table' => 'items',
				'value' => $args,
				'query' => array(array('AND',"itemid = :itemid",'itemid',$itemid))
			)
		);
    }

    public function delItem($itemid)
    {
        return M('pepdo')->delElement(array('table' => 'items','query' => array(array('AND',"itemid = :itemid",'itemid',$itemid))));
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
        return M('pepdo')->listElements($page,$number,$data);
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
        return M('pepdo')->getElement($data);
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
        return M('pepdo')->getElement($data);
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
        return M('pepdo')->getElements($data);
    }
}

?>
