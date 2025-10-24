<?php
namespace PHPEMS\weixin;
use function \PHPEMS\M;
class login
{
	public $db;

	public function __construct($parms = 'default')
	{
		$this->db = M('pepdo');
	}

    public function addLogin($args)
    {
        return $this->db->insertElement(array('table' => 'wxlogin','query' => $args));
    }

    public function delLogin($wxsid)
    {
        return $this->db->delElement(array('table' => 'wxlogin','query' => array(array('AND',"wxsid = :wxsid",'wxsid',$wxsid))));
    }

    public function getLogin($wxsid)
    {
        $data = array(false,'wxlogin',array(array('AND',"wxsid = :wxsid",'wxsid',$wxsid)));
        $sql = $this->db->makeSelect($data);
        return $this->db->fetch($sql,'wxinfo');
    }
}

?>
