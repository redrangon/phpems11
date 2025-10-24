<?php
namespace PHPEMS\seminar;
use function \PHPEMS\M;
class api
{
	public $db;
    public $seminar;

	public function __construct()
	{
		$this->db = M('pepdo');
        $this->seminar = M('seminar','seminar');
	}

    public function parseSeminar($id)
    {
        $elem = $this->seminar->getSeminarElemById($id);
        $data['id'] = $elem['selid'];
        $data['title'] = $elem['seltitle'];
        $data['data'] = $elem['seldata'];
        if($elem['seldata']['number'])
        {
            $args = array();
            $args[] = array("AND","sctelid = :sctelid","sctelid",$id);
            $r = $this->seminar->getSeminarContentList($args,1,$elem['seldata']['number']);
            $data['list'] = $r['data'];
        }
        return $data;
    }
}

?>
