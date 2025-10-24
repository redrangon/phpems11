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

	private function struct()
	{
		$courseid = intval($this->ev->get('courseid'));
		$lessons = $this->content->getCoursesByCsid($courseid)['data'];
		$tmparray = array();
		foreach($lessons as $lesson)
		{
			$tmparray[intval($lesson['coursedirid'])][] = $lesson;
		}
		$ids = array();
		$ids = $this->content->dgCourse(0,$tmparray,$ids);
		$this->tpl->assign('ids',$ids);
		$this->tpl->assign('lessons',$lessons);
		$this->tpl->display('content_struct');
	}

	private function movedir()
	{
		$source = $this->ev->get('source');
		$targetdir = $this->ev->get('targetdir');
		if($targetdir)
		{
			if($targetdir == 'base')$targetdir = 0;
			$this->content->modifyCourse($source,array('coursedirid' => $targetdir));
			$message = array(
				'statusCode' => 200,
				"message" => "操作成功",
				"callbackType" => "forward",
				"forwardUrl" => "reload"
			);
			\PHPEMS\ginkgo::R($message);
		}
		else
		{
			$courseid = intval($this->ev->get('courseid'));
			$lessons = $this->content->getCoursesByCsid($courseid)['data'];
			$tmparray = array();
			foreach($lessons as $lesson)
			{
				$tmparray[intval($lesson['coursedirid'])][] = $lesson;
			}
			$ids = array();
			$ids = $this->content->dgCourse(0,$tmparray,$ids);
			$this->tpl->assign('ids',$ids);
			$this->tpl->assign('lessons',$lessons);
			$this->tpl->assign('source',$source);
			$this->tpl->display('content_movedir');
		}
	}

    private function addpage()
    {
		$courseid = intval($this->ev->get('courseid'));
		$dirid = intval($this->ev->get('dirid'));
		$this->tpl->assign('dirid',$dirid);
		$this->tpl->assign('courseid',$courseid);
		$this->tpl->display('addpage');
    }

	private function add()
	{
		if($this->ev->get('submit'))
		{
			$args = $this->ev->get('args');
			$args['courseuserid'] = $this->_user['sessionuserid'];
			$args['courseusername'] = $this->_user['sessionusername'];
			$args['courseinputtime'] = TIME;
			$group = $this->user->getGroupById($this->_user['sessiongroupid']);
			$args = $this->module->tidyNeedFieldsPars($args,$args['coursemoduleid'],1);
			$id = $this->content->addCourse($args);
			$message = array(
				'statusCode' => 200,
				"message" => "操作成功",
			    "callbackType" => "forward",
			    "forwardUrl" => "index.php?course-master-contents&courseid={$args['coursecsid']}&dirid={$args['coursedirid']}"
			);
			\PHPEMS\ginkgo::R($message);
		}
		else
		{
			$dirid = intval($this->ev->get('dirid'));
			$courseid = intval($this->ev->get('courseid'));
            $moduleid = intval($this->ev->get('moduleid'));
			$parentcat = $this->category->getCategoriesByArgs(array(array("AND","catparent = 0"),array("AND","catapp = 'course'")));
            $modules = $this->module->getModulesByApp(\PHPEMS\ginkgo::$app);
            $fields = $this->module->getMoudleFields($moduleid,1);
            $forms = $this->html->buildHtml($fields);
			$tpls = array();
			foreach(glob("app/content/tpls/app/content_*.tpl") as $p)
			{
				$tpls[] = substr(basename($p),0,-4);
			}
			$dir = $this->content->getCourseById($dirid);
			$this->tpl->assign('dir',$dir);
			$this->tpl->assign('tpls',$tpls);
            $this->tpl->assign('moduleid',$moduleid);
			$this->tpl->assign('modules',$modules);
			$this->tpl->assign('parentcat',$parentcat);
			$this->tpl->assign('courseid',$courseid);
            $this->tpl->assign('forms',$forms);
			$this->tpl->display('content_add');
		}
	}

	private function edit()
	{
		$page = intval($this->ev->get('page'));
		$contentid = intval($this->ev->get('contentid'));
		$content = $this->content->getCourseById($contentid);
		if($this->ev->get('submit'))
		{
			$args = $this->ev->get('args');
			$args['coursemodifytime'] = TIME;
			$group = $this->user->getGroupById($this->_user['sessiongroupid']);
			$args = $this->module->tidyNeedFieldsPars($args,$content['coursemoduleid'],1);
			$this->content->modifyCourse($contentid,$args);
			$message = array(
				'statusCode' => 200,
				"message" => "操作成功",
			    "callbackType" => "forward",
			    "forwardUrl" => "index.php?course-master-contents&courseid={$content['coursecsid']}&page={$page}{$u}"
			);
			\PHPEMS\ginkgo::R($message);
		}
		else
		{
			$userid = $this->_user['sessionuserid'];
			$user = $this->user->getUserById($userid);
			$group = $this->user->getGroupById($user['usergroupid']);
			$fields = $this->module->getMoudleFields($content['coursemoduleid'],1);
			$forms = $this->html->buildHtml($fields,$content);
			$tpls = array();
			foreach(glob("app/content/tpls/app/content_*.tpl") as $p)
			{
				$tpls[] = substr(basename($p),0,-4);
			}
			$this->tpl->assign('tpls',$tpls);
			$this->tpl->assign('fields',$fields);
			$this->tpl->assign('contentid',$contentid);
			$this->tpl->assign('content',$content);
			$this->tpl->assign('page',$page);
			$this->tpl->assign('forms',$forms);
			$this->tpl->display('content_edit');
		}
	}

	private function del()
	{
		$page = intval($this->ev->get('page'));
		$contentid = intval($this->ev->get('contentid'));
		$this->content->delCourse($contentid);
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
		if($this->ev->get('modifycontentsequence'))
		{
			if($this->ev->get('action') == 'delete')
			{
				$ids = $this->ev->get('delids');
				foreach($ids as $key => $id)
				{
					$this->content->delCourse($key);
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
				$parentcat = $this->category->getCategoriesByArgs(array(array("AND","catparent = 0")));
				$this->tpl->assign('parentcat',$parentcat);
				$this->tpl->assign('contentids',$contentids);
				$this->tpl->display('content_move');
				exit;
			}
			elseif($this->ev->get('action') == 'copycategory')
			{
				$contentids = array();
				$ids = $this->ev->get('delids');
				foreach($ids as $key => $id)
				{
					if($key)$contentids[] = $key;
				}
				$contentids = implode(',',$contentids);
				$parentcat = $this->category->getCategoriesByArgs(array(array("AND","catparent = 0")));
				$this->tpl->assign('parentcat',$parentcat);
				$this->tpl->assign('contentids',$contentids);
				$this->tpl->display('content_copy');
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
				$this->tpl->display('content_position');
				exit;
			}
			else
			{
				$ids = $this->ev->get('ids');
				foreach($ids as $key => $id)
				{
					$this->content->modifyBasciCourse($key,array('coursesequence' => $id));
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
						$basic = $this->content->getBasicContentById($id);
						$args = array('pctitle' => $basic['contenttitle'],'pctime' => $basic['contentinputtime'],'pccontentid' => $id,'pcthumb' => $basic['contentthumb'],'pcposid' => $position);
						$this->position->addPosContent($args);
					}
				}
				$message = array(
					'statusCode' => 200,
					"message" => "操作成功",
					"callbackType" => "forward",
				    "forwardUrl" => "index.php?course-master-contents&catid={$catid}&page={$page}{$u}"
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
					if($id)$this->content->modifyBasciContent($id,array('contentcatid' => $targetcatid));
				}
				$message = array(
					'statusCode' => 200,
					"message" => "操作成功",
					"callbackType" => "forward",
				    "forwardUrl" => "?course-master-contents&catid={$catid}&page={$page}{$u}"
				);
			}
			else
			$message = array(
				'statusCode' => 300,
				"message" => "操作失败"
			);
			\PHPEMS\ginkgo::R($message);
		}
		elseif($this->ev->get('copycategory'))
		{
			$contentids = explode(',',$this->ev->get('contentids'));
			$targetcatid = $this->ev->get('targetcatid');
			if($targetcatid)
			{
				foreach($contentids as $key => $id)
				{
					if($id)
					{
						$content = $this->content->getBasicContentById($id);
						$args = array('contentcatid' => $targetcatid,'contenttitle' => $content['contenttitle'],'contentmoduleid' => $content['contentmoduleid'],'contentthumb' => $content['contentthumb'],'contentlink' => 'index.php?course-app-content&contentid='.$content['contentid']);
						$args['contentuserid'] = $this->_user['sessionuserid'];
						$args['contentusername'] = $this->_user['sessionusername'];
						$args['contentinputtime'] = TIME;
						$this->content->addContent($args);
					}
				}
				$message = array(
					'statusCode' => 200,
					"message" => "操作成功",
					"callbackType" => "forward",
				    "forwardUrl" => "index.php?course-master-contents&catid={$catid}&page={$page}{$u}"
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
		$courseid = intval($this->ev->get('courseid'));
		$dirid = intval($this->ev->get('dirid'));
		$page = $this->ev->get('page');
		$search = $this->ev->get('search');
		if(!$courseid)
		{
			header("location:index.php?course-master-course");
			exit;
		}
		$args = array();
		$args[] = array("AND","coursedirid = :coursedirid",'coursedirid',$dirid);
		$args[] = array("AND","coursecsid = :coursecsid",'coursecsid',$courseid);
		if($search['courseid'])
		{
			$args[] = array("AND","courseid = :courseid",'courseid',$search['courseid']);
		}
		else
		{
			if($search['coursemoduleid'])$args[] = array("AND","coursemoduleid = :coursemoduleid",'coursemoduleid',$search['coursemoduleid']);
			if($search['stime'])$args[] = array("AND","courseinputtime >= :scourseinputtime",'scourseinputtime',strtotime($search['stime']));
			if($search['etime'])$args[] = array("AND","courseinputtime <= :ecourseinputtime",'ecourseinputtime',strtotime($search['etime']));
			if($search['keyword'])$args[] = array("AND","coursetitle LIKE :coursetitle",'coursetitle',"%{$search['keyword']}%");
			if($search['username'])
			{
				$user = $this->user->getUserByUserName($search['username']);
				$args[] = array("AND","courseuserid = :courseuserid",'courseuserid',$user['userid']);
			}
		}
		if($dirid)
		{
			$dir = $this->content->getCourseById($dirid);
			$this->tpl->assign('dir',$dir);
		}
		$course = $this->course->getCourseById($courseid);
		$contents = $this->content->getCourseList($args,$page,10);
		$modules = $this->module->getModulesByApp(\PHPEMS\ginkgo::$app);
		$this->tpl->assign('modules',$modules);
		$this->tpl->assign('course',$course);
		$this->tpl->assign('contents',$contents);
        $this->tpl->assign('search',$search);
		$this->tpl->assign('page',$page);
		$this->tpl->display('content');
	}
}


?>
