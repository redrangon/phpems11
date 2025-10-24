<?php
 namespace PHPEMS;
/*
 * Created on 2016-5-19
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
class action extends app
{
	public function display()
	{
		$action = $this->ev->url(3);
		if(!method_exists($this,$action))
		$action = "index";
		$this->$action();
		exit;
	}

	private function elem()
	{
        $this->position = M('position','content');
		$page = $this->ev->get('page');
		$elemid = $this->ev->get('elemid');
		$elem = $this->seminar->getSeminarElemById($elemid);
        $args = array();
        $args[] = array("AND","sctelid = :sctelid","sctelid",$elemid);
        $contents = $this->seminar->getSeminarContentList($args,$page,20);
        $topseminars = $this->position->getPosSeminarList(array(array("AND","pcposid = 3")),1,10);
        $this->tpl->assign('topseminars',$topseminars);
        $this->tpl->assign("elem",$elem);
        $this->tpl->assign("contents",$contents);
        $this->tpl->display('seminar_elem');
	}

	private function index()
	{
		$seminarid = $this->ev->get('seminarid');
        $seminarid = intval($this->ev->get('seminarid'));
        $stpl = $this->seminar->parseSeminar($seminarid);
        if($stpl)
		{
            $content = $this->tpl->fetchExeSource($stpl);
            echo $content;
		}
		else
		{
			header("location:index.php?seminar");
			exit;
		}
	}
}


?>
