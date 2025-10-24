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
        $this->layout = M('layout','seminar');
        $this->position = M('position','content');
		$search = $this->ev->get('search');
		$this->u = '';
		if($search)
		{
			$this->tpl->assign('search',$search);
			foreach($search as $key => $arg)
			{
				$this->u .= "&search[{$key}]={$arg}";
			}
		}
		$this->tpl->assign('search',$search);
		if(!method_exists($this,$action))
		$action = "index";
		$this->$action();
		exit;
	}

	private function catsmenu()
	{
        $catid = $this->ev->get('catid');
		$categories = $this->category->getAllCategory();
        $r = array();
        $this->category->selected = $catid;
        $this->category->hrefpre = 'index.php?seminar-master-seminar&catid=';
        $this->category->levelCategory($r,0,$this->category->tidycategories);
        $this->category->resetCategoryIndex($r);
        echo 'var treeData = '.json_encode($r);
        exit();
	}

    private function getstplcode()
    {
        $stplid = $this->ev->get('stplid');
        $tpl = $this->layout->getSeminarTplById($stplid);
        exit(stripslashes(htmlspecialchars_decode($tpl['stplcode'])));
    }

    private function showcode()
	{
        $seminarid = intval($this->ev->get('seminarid'));
		$stpl = $this->seminar->parseSeminar($seminarid);
        $content = $this->tpl->fetchExeSource($stpl);
        echo $content;
	}

	public function data()
	{
        $selid = intval($this->ev->get('selid'));
        $elem = $this->seminar->getSeminarElemById($selid);
        $layout = $this->seminar->getSeminarLayoutById($elem['sellayout']);
        if($this->ev->get('submit'))
        {
            $args = $this->ev->get('args');
            $id = $this->seminar->modifySeminarElem($selid,array('seldata' => $args));
            $message = array(
                'statusCode' => 200,
                "message" => "操作成功",
                "callbackType" => "forward",
                "forwardUrl" => "index.php?seminar-master-seminar-elem&slayoutid={$layout['slayoutid']}"
            );
            \PHPEMS\ginkgo::R($message);
        }
        else
        {
            $this->tpl->assign('elem',$elem);
            $this->tpl->assign('layout',$layout);
            $this->tpl->display('elem_data');
        }
	}

	private function delcontent()
    {
        $sctid = $this->ev->get('sctid');
        $this->seminar->delSeminarContent($sctid);
        $message = array(
            'statusCode' => 200,
            "message" => "操作成功",
            "callbackType" => "forward",
            "forwardUrl" => "reload"
        );
        \PHPEMS\ginkgo::R($message);
    }

	public function addcontent()
    {
        $this->content = M('content','content');
        $this->module = M('module');
        $selid = intval($this->ev->get('selid'));
        $elem = $this->seminar->getSeminarElemById($selid);
        if($this->ev->get('submit'))
		{
			$delids = $this->ev->get('delids');
			$number = 0;
			foreach($delids as $key => $id)
			{
				$args = array();
                $args['sctelid'] = $selid;
                $args['sctcontentid'] = $key;
                $args['sctusername'] = $this->_user['sessoinusername'];
                $args['scttime'] = TIME;
                $this->seminar->addSeminarContent($args);
                $number++;
			}
            $message = array(
                'statusCode' => 200,
                "message" => "操作成功,添加{$number}条数据"
            );
            \PHPEMS\ginkgo::R($message);
		}
		else
		{
			$search = $this->ev->get('search');
			$catid = intval($this->ev->get('catid'));
			$page = intval($this->ev->get('page'));
			$page = $page?$page:1;
			if(!$catid)$catid = $search['contentcatid'];
			$categories = $this->category->getAllCategory('content');
			$parentcat = $this->category->getCategoriesByArgs(array(array("AND","catparent = 0"),array("AND","catapp = 'content'")));
			if($catid)
			{
				$childstring = $this->category->getChildCategoryString($catid);
				$args = array(array("AND","find_in_set(contentcatid,:contentcatid)",'contentcatid',$childstring));
			}
			else $args = array();
			if($search['contentid'])
			{
				$args[] = array("AND","contentid = :contentid",'contentid',$search['contentid']);
			}
			else
			{
				if($search['contentcatid'])$args[] = array("AND","contentcatid = :contentcatid",'contentcatid',$search['contentcatid']);
				if($search['contentmoduleid'])$args[] = array("AND","contentmoduleid = :contentmoduleid",'contentmoduleid',$search['contentmoduleid']);
				if($search['stime'])$args[] = array("AND","contentinputtime >= :scontentinputtime",'scontentinputtime',strtotime($search['stime']));
				if($search['etime'])$args[] = array("AND","contentinputtime <= :econtentinputtime",'econtentinputtime',strtotime($search['etime']));
				if($search['keyword'])$args[] = array("AND","contenttitle LIKE :contenttitle",'contenttitle',"%{$search['keyword']}%");
				if($search['username'])
				{
					$user = $this->user->getUserByUserName($search['username']);
					$args[] = array("AND","contentuserid = :contentuserid",'contentuserid',$user['userid']);
				}
			}
			$contents = $this->content->getContentList($args,$page,10);
			$modules = $this->module->getModulesByApp('content');
            $this->tpl->assign('elem',$elem);
			$this->tpl->assign('modules',$modules);
			$this->tpl->assign('catid',$catid);
			$this->tpl->assign('contents',$contents);
			$this->tpl->assign('parentcat',$parentcat);
			$this->tpl->assign('categories',$categories);
			$this->tpl->assign('page',$page);
			$this->tpl->display('elem_selectcontent');
        }
	}

    private function contentlite()
    {
        if($this->ev->get('submit'))
        {
            if($this->ev->get('action') == 'delete')
            {
                $ids = $this->ev->get('delids');
                foreach($ids as $key => $id)
                {
                    $this->seminar->delSeminarContent($key);
                }
            }
            else
            {
                $ids = $this->ev->get('ids');
                foreach($ids as $key => $id)
                {
                    $this->seminar->modifySeminarContent($key,array('sctorder' => $id));
                }
            }
            $message = array(
                'statusCode' => 200,
                "message" => "操作成功",
                "callbackType" => "forward",
                "forwardUrl" => "reload"
            );
            \PHPEMS\ginkgo::R($message);
        }
    }

    public function contents()
    {
        $selid = intval($this->ev->get('selid'));
        $elem = $this->seminar->getSeminarElemById($selid);
        $layout = $this->seminar->getSeminarLayoutById($elem['sellayout']);
        $page = intval($this->ev->get('page'));
        $page = $page?$page:1;
        $args = array();
        $args[] = array("AND","sctelid = :sctelid","sctelid",$selid);
        $contents = $this->seminar->getSeminarContentList($args,$page);
        $this->tpl->assign('contents',$contents);
        $this->tpl->assign('elem',$elem);
        $this->tpl->assign('layout',$layout);
        $this->tpl->display('elem_content');
    }

    private function delelem()
    {
        $selid = $this->ev->get('selid');
        $tpl = $this->seminar->delSeminarElem($selid);
        $message = array(
            'statusCode' => 200,
            "message" => "操作成功",
            "callbackType" => "forward",
            "forwardUrl" => "reload"
        );
        \PHPEMS\ginkgo::R($message);
    }

    private function addelem()
    {
        $slayoutid = intval($this->ev->get('slayoutid'));
        $layout = $this->seminar->getSeminarLayoutById($slayoutid);
        $seminar = $this->seminar->getSeminarById($layout['slayoutseminar']);
        if($this->ev->get('submit'))
        {
            $args = $this->ev->get('args');
            $args['sellayout'] = $layout['slayoutid'];
            $args['selseminar'] = $layout['slayoutseminar'];
            $id = $this->seminar->addSeminarElem($args);
            $message = array(
                'statusCode' => 200,
                "message" => "操作成功",
                "callbackType" => "forward",
                "forwardUrl" => "index.php?seminar-master-seminar-elem&slayoutid={$layout['slayoutid']}"
            );
            \PHPEMS\ginkgo::R($message);
        }
        else
        {
            $args = array();
            $args[] = array("AND","stpltype in ('slider','block','lists','plugin')");
            $tpls = $this->layout->getSeminarTplsByArgs($args);
            $this->tpl->assign('tpls',$tpls);
            $this->tpl->assign('layout',$layout);
            $this->tpl->assign('seminar',$seminar);
            $this->tpl->display('elem_add');
        }
    }

    private function modifyelem()
    {
        $selid = intval($this->ev->get('selid'));
        $elem = $this->seminar->getSeminarElemById($selid);
        $layout = $this->seminar->getSeminarLayoutById($elem['sellayout']);
        if($this->ev->get('submit'))
        {
            $args = $this->ev->get('args');
            $id = $this->seminar->modifySeminarElem($selid,$args);
            $message = array(
                'statusCode' => 200,
                "message" => "操作成功",
                "callbackType" => "forward",
                "forwardUrl" => "index.php?seminar-master-seminar-elem&slayoutid={$layout['slayoutid']}"
            );
            \PHPEMS\ginkgo::R($message);
        }
        else
        {
            $args = array();
            $args[] = array("AND","stpltype in ('slider','block','lists','plugin')");
            $tpls = $this->layout->getSeminarTplsByArgs($args);
            $this->tpl->assign('tpls',$tpls);
            $this->tpl->assign('elem',$elem);
            $this->tpl->assign('layout',$layout);
            $this->tpl->display('elem_modify');
        }
    }

    private function liteelem()
    {
        if($this->ev->get('submit'))
        {
            $ids = $this->ev->get('ids');
            foreach($ids as $key => $id)
            {
                $this->seminar->modifySeminarElem($key,array('selorder' => $id));
            }
            $message = array(
                'statusCode' => 200,
                "message" => "操作成功",
                "callbackType" => "forward",
                "forwardUrl" => "reload"
            );
            \PHPEMS\ginkgo::R($message);
        }
    }

    private function elem()
    {
        $page = intval($this->ev->get('page'));
        $page = $page?$page:1;
        $slayoutid = intval($this->ev->get('slayoutid'));
        $layout = $this->seminar->getSeminarLayoutById($slayoutid);
        $seminar = $this->seminar->getSeminarById($layout['slayoutseminar']);
        $args = array();
        $args[] = array("AND","sellayout = :sellayout","sellayout",$layout['slayoutid']);
        $args[] = array("AND","selseminar = :selseminar","selseminar",$layout['slayoutseminar']);
        $elems = $this->seminar->getSeminarElemList($args,$page,10);
        $this->tpl->assign('layout',$layout);
        $this->tpl->assign('seminar',$seminar);
        $this->tpl->assign('elems',$elems);
        $this->tpl->display('seminar_elem');
    }

    private function dellayout()
    {
        $slayoutid = $this->ev->get('slayoutid');
        $this->seminar->delSeminarLayout($slayoutid);
        $message = array(
            'statusCode' => 200,
            "message" => "操作成功",
            "callbackType" => "forward",
            "forwardUrl" => "reload"
        );
        \PHPEMS\ginkgo::R($message);
    }

    private function addlayout()
	{
        $seminarid = intval($this->ev->get('seminarid'));
        $seminar = $this->seminar->getSeminarById($seminarid);
		if($this->ev->get('submit'))
        {
            $args = $this->ev->get('args');
            $args['slayoutseminar'] = $seminarid;
            $id = $this->seminar->addSeminarLayout($args);
            $message = array(
                'statusCode' => 200,
                "message" => "操作成功",
                "callbackType" => "forward",
                "forwardUrl" => "index.php?seminar-master-seminar-layout&seminarid={$seminar['seminarid']}"
            );
            \PHPEMS\ginkgo::R($message);
        }
        else
        {
            $args = array();
            $args[] = array("AND","stpltype = 'layout'");
            $tpls = $this->layout->getSeminarTplsByArgs($args);
            $this->tpl->assign('tpls',$tpls);
            $this->tpl->assign('seminar',$seminar);
            $this->tpl->display('layout_add');
        }
	}

    private function modifylayout()
    {
        $slayoutid = intval($this->ev->get('slayoutid'));
        $layout = $this->seminar->getSeminarLayoutById($slayoutid);
        if($this->ev->get('submit'))
        {
            $args = $this->ev->get('args');
            $id = $this->seminar->modifySeminarLayout($slayoutid,$args);
            $message = array(
                'statusCode' => 200,
                "message" => "操作成功",
                "callbackType" => "forward",
                "forwardUrl" => "index.php?seminar-master-seminar-layout&seminarid={$layout['slayoutseminar']}"
            );
            \PHPEMS\ginkgo::R($message);
        }
        else
        {
            $args = array();
            $args[] = array("AND","stpltype = 'layout'");
            $tpls = $this->layout->getSeminarTplsByArgs($args);
            $this->tpl->assign('tpls',$tpls);
            $this->tpl->assign('layout',$layout);
            $this->tpl->display('layout_modify');
        }
    }

    private function litelayout()
	{
		if($this->ev->get('submit'))
		{
            $ids = $this->ev->get('ids');
            foreach($ids as $key => $id)
			{
                $this->seminar->modifySeminarLayout($key,array('slayoutorder' => $id));
			}
            $message = array(
                'statusCode' => 200,
                "message" => "操作成功",
                "callbackType" => "forward",
                "forwardUrl" => "reload"
            );
            \PHPEMS\ginkgo::R($message);
		}
	}

	private function layout()
	{
        $page = intval($this->ev->get('page'));
        $seminarid = intval($this->ev->get('seminarid'));
        $page = $page?$page:1;
        $args = array();
        $args[] = array("AND","slayoutseminar = :slayoutseminar","slayoutseminar",$seminarid);
		$layouts = $this->seminar->getSeminarLayoutList($args,$page,10);
        $seminar = $this->seminar->getSeminarById($seminarid);
        $this->tpl->assign('seminar',$seminar);
        $this->tpl->assign('layouts',$layouts);
		$this->tpl->display('seminar_layout');
	}

	private function add()
	{
		if($this->ev->get('submit'))
		{
			$args = $this->ev->get('args');
			$args['seminarusername'] = $this->_user['sessionusername'];
			if(!$args['seminartime'])$args['seminartime'] = TIME;
			else
			$args['seminartime'] = strtotime($args['seminartime']);
			$id = $this->seminar->addSeminar($args);
			$message = array(
				'statusCode' => 200,
				"message" => "操作成功",
			    "callbackType" => "forward",
			    "forwardUrl" => "index.php?seminar-master-seminar&catid={$args['seminarcatid']}"
			);
			\PHPEMS\ginkgo::R($message);
		}
		else
		{
			$catid = intval($this->ev->get('catid'));
			$parentcat = $this->category->getCategoriesByArgs(array(array("AND","catparent = 0"),array("AND","catapp = 'seminar'")));
            $tpls = array();
            $args = array();
            $args[] = array("AND","stpltype = 'style'");
            $tpls = $this->layout->getSeminarTplsByArgs($args);
            $this->tpl->assign('tpls',$tpls);
			$this->tpl->assign('parentcat',$parentcat);
			$this->tpl->assign('catid',$catid);
			$this->tpl->display('seminar_add');
		}
	}

	private function modify()
	{
		$page = intval($this->ev->get('page'));
        $seminarid = intval($this->ev->get('seminarid'));
        $seminar = $this->seminar->getSeminarById($seminarid);
		if($this->ev->get('submit'))
		{

			$args = $this->ev->get('args');
			if(!$args['seminartime'])$args['seminartime'] = TIME;
			else
			$args['seminartime'] = strtotime($args['seminartime']);
			$args['seminarmodifytime'] = TIME;
            $args['seminarmodifier'] = $this->_user['sessionusername'];
			unset($args['seminarcatid']);
			$this->seminar->modifySeminar($seminarid,$args);
            $this->position->modifyPosContentByContentId($seminarid,array('pctitle' => $args['seminartitle'],'pcthumb' => $args['seminarthumb'],'pcdescribe' => $args['seminardescribe']),'content');
            $message = array(
				'statusCode' => 200,
				"message" => "操作成功",
			    "callbackType" => "forward",
			    "forwardUrl" => "index.php?seminar-master-seminar&catid={$seminar['seminarcatid']}&page={$page}{$this->u}"
			);
			\PHPEMS\ginkgo::R($message);
		}
		else
		{
            $tpls = array();
            $args = array();
            $args[] = array("AND","stpltype = 'style'");
            $tpls = $this->layout->getSeminarTplsByArgs($args);
			$this->tpl->assign('tpls',$tpls);
			$this->tpl->assign('seminar',$seminar);
			$this->tpl->assign('page',$page);
			$this->tpl->display('seminar_modify');
		}
	}

	private function del()
	{
		$page = intval($this->ev->get('page'));
        $seminarid = intval($this->ev->get('seminarid'));
		$this->seminar->delSeminar($seminarid);
		$message = array(
			'statusCode' => 200,
			"message" => "操作成功",
		    "callbackType" => "forward",
		    "forwardUrl" => "reload"
		);
		\PHPEMS\ginkgo::R($message);
	}

	private function lite()
	{
		$catid = $this->ev->get('catid');
		$page = $this->ev->get('page');
		$this->tpl->assign('catid',$catid);
		$this->tpl->assign('page',$page);
        $this->position = M('position','content');
		if($this->ev->get('submit'))
		{
			if($this->ev->get('action') == 'delete')
			{
				$ids = $this->ev->get('delids');
				foreach($ids as $key => $id)
				{
					$this->seminar->delSeminar($key);
				}
			}
			elseif($this->ev->get('action') == 'movecategory')
			{
				$contentids = array();
				$ids = $this->ev->get('delids');
				foreach($ids as $key => $id)
				{
					if($key)$contentids[] = $key;
				}
				$contentids = implode(',',$contentids);
				$parentcat = $this->category->getCategoriesByArgs(array(array("AND","catparent = 0"),array("AND","catapp = 'seminar'")));
				$this->tpl->assign('parentcat',$parentcat);
				$this->tpl->assign('contentids',$contentids);
				$this->tpl->display('seminar_move');
				exit;
			}
			elseif($this->ev->get('action') == 'moveposition')
			{
				$contentids = array();
				$ids = $this->ev->get('delids');
				foreach($ids as $key => $id)
				{
					if($key)$contentids[] = $key;
				}
				$contentids = implode(',',$contentids);
				$poses = $this->position->getPosList();
				$this->tpl->assign('poses',$poses);
				$this->tpl->assign('contentids',$contentids);
				$this->tpl->display('seminar_position');
				exit;
			}
			else
			{
				$ids = $this->ev->get('ids');
				foreach($ids as $key => $id)
				{
					$this->seminar->modifySeminar($key,array('seminarorder' => $id));
				}
			}
			$message = array(
				'statusCode' => 200,
				"message" => "操作成功",
				"callbackType" => "forward",
			    "forwardUrl" => "reload"
			);
			\PHPEMS\ginkgo::R($message);
		}
		elseif($this->ev->get('movecposition'))
		{
			$contentids = explode(',',$this->ev->get('contentids'));
			$position = $this->ev->get('position');
			if($position)
			{
				foreach($contentids as $key => $id)
				{
					if($id)
					{
						$basic = $this->seminar->getSeminarById($id);
						$args = array('pctitle' => $basic['seminartitle'],'pctime' => $basic['seminartime'],'pcposapp' => 'seminar','pccontentid' => $id,'pcthumb' => $basic['seminarthumb'],'pcdescribe' => $basic['seminardescribe'],'pcposid' => $position);
						$this->position->addPosContent($args);
					}
				}
				$message = array(
					'statusCode' => 200,
					"message" => "操作成功",
					"callbackType" => "forward",
				    "forwardUrl" => "reload"
				);
			}
			else
			$message = array(
				'statusCode' => 300,
				"message" => "操作失败"
			);
			\PHPEMS\ginkgo::R($message);
		}
		elseif($this->ev->get('movecategory'))
		{
			$contentids = explode(',',$this->ev->get('contentids'));
			$targetcatid = $this->ev->get('targetcatid');
			if($targetcatid)
			{
				foreach($contentids as $key => $id)
				{
					if($id)$this->seminar->modifySeminar($id,array('seminarcatid' => $targetcatid));
				}
				$message = array(
					'statusCode' => 200,
					"message" => "操作成功",
					"callbackType" => "forward",
				    "forwardUrl" => "reload"
				);
			}
			else
			$message = array(
				'statusCode' => 300,
				"message" => "操作失败"
			);
			\PHPEMS\ginkgo::R($message);
		}
		else
		{
			$message = array(
				'statusCode' => 300,
				"message" => "无效访问"
			);
			\PHPEMS\ginkgo::R($message);
		}
	}

	private function index()
	{
		$search = $this->ev->get('search');
		$catid = intval($this->ev->get('catid'));
		$page = intval($this->ev->get('page'));
		$page = $page?$page:1;
		if(!$catid)$catid = $search['contentcatid'];
		$categories = $this->category->getAllCategory();
		$parentcat = $this->category->getCategoriesByArgs(array(array("AND","catparent = 0"),array("AND","catapp = 'content'")));
		if($catid)
		{
			$childstring = $this->category->getChildCategoryString($catid);
			$args = array(array("AND","find_in_set(seminarcatid,:seminarcatid)",'seminarcatid',$childstring));
		}
		else $args = array();
		if($search['seminarid'])
		{
			$args[] = array("AND","seminarid = :seminarid",'seminarid',$search['seminarid']);
		}
		else
		{
			if($search['contentcatid'])$args[] = array("AND","seminarcatid = :seminarcatid",'seminarcatid',$search['seminarcatid']);
			if($search['stime'])$args[] = array("AND","seminartime >= :seminarstime",'seminarstime',strtotime($search['stime']));
			if($search['etime'])$args[] = array("AND","seminartime <= :seminaretime",'seminaretime',strtotime($search['etime']));
			if($search['keyword'])$args[] = array("AND","seminartitle LIKE :seminartitle",'seminartitle',"%{$search['keyword']}%");
			if($search['username'])$args[] = array("AND","seminarusername = :seminarusername",'seminarusername',$search['username']);
		}
		$seminars = $this->seminar->getSeminarList($args,$page,10);
		$catlevel = 1;
		if($catid)
		{
            $pos = $this->category->getCategoryPos($catid);
            if(count($pos))
            $catlevel = count($pos) + 1;
		}
        $this->tpl->assign('catlevel',$catlevel);
		$this->tpl->assign('catid',$catid);
		$this->tpl->assign('seminars',$seminars);
		$this->tpl->assign('parentcat',$parentcat);
		$this->tpl->assign('categories',$categories);
		$this->tpl->assign('page',$page);
		$this->tpl->display('seminar');
	}
}


?>
