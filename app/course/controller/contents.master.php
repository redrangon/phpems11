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
		$action = M('ev')->url(3);
		if(!method_exists($this,$action))
		$action = "index";
		$this->$action();
		exit;
	}

	private function struct()
	{
		$courseid = intval(M('ev')->get('courseid'));
		$lessons = M('content','course')->getCoursesByCsid($courseid)['data'];
		$tmparray = array();
		foreach($lessons as $lesson)
		{
			$tmparray[intval($lesson['coursedirid'])][] = $lesson;
		}
		$ids = array();
		$ids = M('content','course')->dgCourse(0,$tmparray,$ids);
		M('tpl')->assign('ids',$ids);
		M('tpl')->assign('lessons',$lessons);
		M('tpl')->display('content_struct');
	}

	private function movedir()
	{
		$source = M('ev')->get('source');
		$targetdir = M('ev')->get('targetdir');
		if($targetdir)
		{
			if($targetdir == 'base')$targetdir = 0;
			M('content','course')->modifyCourse($source,array('coursedirid' => $targetdir));
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
			$courseid = intval(M('ev')->get('courseid'));
			$lessons = M('content','course')->getCoursesByCsid($courseid)['data'];
			$tmparray = array();
			foreach($lessons as $lesson)
			{
				$tmparray[intval($lesson['coursedirid'])][] = $lesson;
			}
			$ids = array();
			$ids = M('content','course')->dgCourse(0,$tmparray,$ids);
			M('tpl')->assign('ids',$ids);
			M('tpl')->assign('lessons',$lessons);
			M('tpl')->assign('source',$source);
			M('tpl')->display('content_movedir');
		}
	}

    private function addpage()
    {
		$courseid = intval(M('ev')->get('courseid'));
		$dirid = intval(M('ev')->get('dirid'));
		M('tpl')->assign('dirid',$dirid);
		M('tpl')->assign('courseid',$courseid);
		M('tpl')->display('addpage');
    }

	private function add()
	{
		if(M('ev')->get('submit'))
		{
			$args = M('ev')->get('args');
			$args['courseuserid'] = $this->user['userid'];
			$args['courseusername'] = $this->_user['sessionusername'];
			$args['courseinputtime'] = TIME;
			$group = M('user','user')->getGroupById($this->_user['sessiongroupid']);
			$args = M('module')->tidyNeedFieldsPars($args,$args['coursemoduleid'],1);
			$id = M('content','course')->addCourse($args);
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
			$dirid = intval(M('ev')->get('dirid'));
			$courseid = intval(M('ev')->get('courseid'));
            $moduleid = intval(M('ev')->get('moduleid'));
			$parentcat = M('category')->getCategoriesByArgs(array(array("AND","catparent = 0"),array("AND","catapp = 'course'")));
            $modules = M('module')->getModulesByApp(\PHPEMS\ginkgo::$app);
            $fields = M('module')->getMoudleFields($moduleid,1);
            $forms = M('html')->buildHtml($fields);
			$tpls = array();
			foreach(glob("app/content/tpls/app/content_*.tpl") as $p)
			{
				$tpls[] = substr(basename($p),0,-4);
			}
			$dir = M('content','course')->getCourseById($dirid);
			M('tpl')->assign('dir',$dir);
			M('tpl')->assign('tpls',$tpls);
            M('tpl')->assign('moduleid',$moduleid);
			M('tpl')->assign('modules',$modules);
			M('tpl')->assign('parentcat',$parentcat);
			M('tpl')->assign('courseid',$courseid);
            M('tpl')->assign('forms',$forms);
			M('tpl')->display('content_add');
		}
	}

	private function edit()
	{
		$page = intval(M('ev')->get('page'));
		$contentid = intval(M('ev')->get('contentid'));
		$content = M('content','course')->getCourseById($contentid);
		if(M('ev')->get('submit'))
		{
			$args = M('ev')->get('args');
			$args['coursemodifytime'] = TIME;
			$group = M('user','user')->getGroupById($this->_user['sessiongroupid']);
			$args = M('module')->tidyNeedFieldsPars($args,$content['coursemoduleid'],1);
			M('content','course')->modifyCourse($contentid,$args);
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
			$userid = $this->user['userid'];
			$user = M('user','user')->getUserById($userid);
			$group = M('user','user')->getGroupById($user['usergroupid']);
			$fields = M('module')->getMoudleFields($content['coursemoduleid'],1);
			$forms = M('html')->buildHtml($fields,$content);
			$tpls = array();
			foreach(glob("app/content/tpls/app/content_*.tpl") as $p)
			{
				$tpls[] = substr(basename($p),0,-4);
			}
			M('tpl')->assign('tpls',$tpls);
			M('tpl')->assign('fields',$fields);
			M('tpl')->assign('contentid',$contentid);
			M('tpl')->assign('content',$content);
			M('tpl')->assign('page',$page);
			M('tpl')->assign('forms',$forms);
			M('tpl')->display('content_edit');
		}
	}

	private function del()
	{
		$page = intval(M('ev')->get('page'));
		$contentid = intval(M('ev')->get('contentid'));
		M('content','course')->delCourse($contentid);
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
		$catid = M('ev')->get('catid');
		$page = M('ev')->get('page');
		M('tpl')->assign('catid',$catid);
		M('tpl')->assign('page',$page);
		if(M('ev')->get('modifycontentsequence'))
		{
			if(M('ev')->get('action') == 'delete')
			{
				$ids = M('ev')->get('delids');
				foreach($ids as $key => $id)
				{
					M('content','course')->delCourse($key);
				}
			}
			elseif(M('ev')->get('action') == 'movecategory')
			{
				$contentids = array();
				$ids = M('ev')->get('delids');
				foreach($ids as $key => $id)
				{
					if($key)$contentids[] = $key;
				}
				$contentids = implode(',',$contentids);
				$parentcat = M('category')->getCategoriesByArgs(array(array("AND","catparent = 0")));
				M('tpl')->assign('parentcat',$parentcat);
				M('tpl')->assign('contentids',$contentids);
				M('tpl')->display('content_move');
				exit;
			}
			elseif(M('ev')->get('action') == 'copycategory')
			{
				$contentids = array();
				$ids = M('ev')->get('delids');
				foreach($ids as $key => $id)
				{
					if($key)$contentids[] = $key;
				}
				$contentids = implode(',',$contentids);
				$parentcat = M('category')->getCategoriesByArgs(array(array("AND","catparent = 0")));
				M('tpl')->assign('parentcat',$parentcat);
				M('tpl')->assign('contentids',$contentids);
				M('tpl')->display('content_copy');
				exit;
			}
			elseif(M('ev')->get('action') == 'moveposition')
			{
				$contentids = array();
				$ids = M('ev')->get('delids');
				foreach($ids as $key => $id)
				{
					if($key)$contentids[] = $key;
				}
				$contentids = implode(',',$contentids);
				$poses = $this->position->getPosList();
				M('tpl')->assign('poses',$poses);
				M('tpl')->assign('contentids',$contentids);
				M('tpl')->display('content_position');
				exit;
			}
			else
			{
				$ids = M('ev')->get('ids');
				foreach($ids as $key => $id)
				{
					M('content','course')->modifyBasciCourse($key,array('coursesequence' => $id));
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
		elseif(M('ev')->get('movecposition'))
		{
			$contentids = explode(',',M('ev')->get('contentids'));
			$position = M('ev')->get('position');
			if($position)
			{
				foreach($contentids as $key => $id)
				{
					if($id)
					{
						$basic = M('content','course')->getBasicContentById($id);
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
		elseif(M('ev')->get('movecategory'))
		{
			$contentids = explode(',',M('ev')->get('contentids'));
			$targetcatid = M('ev')->get('targetcatid');
			if($targetcatid)
			{
				foreach($contentids as $key => $id)
				{
					if($id)M('content','course')->modifyBasciContent($id,array('contentcatid' => $targetcatid));
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
		elseif(M('ev')->get('copycategory'))
		{
			$contentids = explode(',',M('ev')->get('contentids'));
			$targetcatid = M('ev')->get('targetcatid');
			if($targetcatid)
			{
				foreach($contentids as $key => $id)
				{
					if($id)
					{
						$content = M('content','course')->getBasicContentById($id);
						$args = array('contentcatid' => $targetcatid,'contenttitle' => $content['contenttitle'],'contentmoduleid' => $content['contentmoduleid'],'contentthumb' => $content['contentthumb'],'contentlink' => 'index.php?course-app-content&contentid='.$content['contentid']);
						$args['contentuserid'] = $this->user['userid'];
						$args['contentusername'] = $this->_user['sessionusername'];
						$args['contentinputtime'] = TIME;
						M('content','course')->addContent($args);
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
		$courseid = intval(M('ev')->get('courseid'));
		$dirid = intval(M('ev')->get('dirid'));
		$page = M('ev')->get('page');
		$search = M('ev')->get('search');
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
				$user = M('user','user')->getUserByUserName($search['username']);
				$args[] = array("AND","courseuserid = :courseuserid",'courseuserid',$user['userid']);
			}
		}
		if($dirid)
		{
			$dir = M('content','course')->getCourseById($dirid);
			M('tpl')->assign('dir',$dir);
		}
		$course = M('course','course')->getCourseById($courseid);
		$contents = M('content','course')->getCourseList($args,$page,10);
		$modules = M('module')->getModulesByApp(\PHPEMS\ginkgo::$app);
		M('tpl')->assign('modules',$modules);
		M('tpl')->assign('course',$course);
		M('tpl')->assign('contents',$contents);
        M('tpl')->assign('search',$search);
		M('tpl')->assign('page',$page);
		M('tpl')->display('content');
	}
}


?>
