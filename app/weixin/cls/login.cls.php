<?php
namespace PHPEMS\weixin;
use function \PHPEMS\M;
class login
{
    public function addLogin($args)
    {
        return M('pepdo')->insertElement(array('table' => 'wxlogin','query' => $args));
    }

    public function delLogin($wxsid)
    {
        return M('pepdo')->delElement(array('table' => 'wxlogin','query' => array(array('AND',"wxsid = :wxsid",'wxsid',$wxsid))));
    }

    public function getLogin($wxsid)
    {
        $data = array(false,'wxlogin',array(array('AND',"wxsid = :wxsid",'wxsid',$wxsid)));
        $sql = M('pepdo')->makeSelect($data);
        return M('pepdo')->fetch($sql,'wxinfo');
    }
}

?>
