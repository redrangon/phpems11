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
		$subjects = M('basic','exam')->getSubjectList();
		M('tpl')->assign('subjects',$subjects);
		if(!method_exists($this,$action))
		$action = "index";
		$this->$action();
		exit;
	}

	private function selectmember()
	{
		$page = intval(M('ev')->get('page'));
		$courseid = intval(M('ev')->get('courseid'));
		$course = M('course','course')->getCourseById($courseid);
		$search = M('ev')->get('search');
		$u = '';
		if($search)
		{
			foreach($search as $key => $arg)
			{
				$u .= "&search[{$key}]={$arg}";
			}
		}
		if(M('ev')->get('submit'))
		{
			$userids = M('ev')->get('delids');
			$days = M('ev')->get('days');
			if($userids && $days)
			{
				foreach($userids as $userid => $p)
				{
					M('course','course')->openCourse(array('ocuserid'=>$userid,'occourseid'=>$courseid,'ocendtime' => TIME + $days*24*3600));
				}
				$message = array(
					'statusCode' => 200,
					"message" => "操作成功",
					"callbackType" => "forward",
			    	"forwardUrl" => "index.php?course-teach-course-members&courseid=".$courseid
				);
			}
			else
			{
				$message = array(
					'statusCode' => 300,
					"message" => "操作失败"
				);
			}
			\PHPEMS\ginkgo::R($message);
		}
		else
		{
			$args = array();
			if($search['userid'])$args[] = array('AND',"userid = :userid",'userid',$search['userid']);
			if($search['username'])$args[] = array('AND',"username LIKE :username",'username','%'.$search['username'].'%');
			if($search['useremail'])$args[] = array('AND',"useremail  LIKE :useremail",'useremail','%'.$search['useremail'].'%');
			if($search['groupid'])$args[] = array('AND',"usergroupid = :usergroupid",'usergroupid',$search['groupid']);
			if($search['stime'] || $search['etime'])
			{
				if(!is_array($args))$args = array();
				if($search['stime']){
					$stime = strtotime($search['stime']);
					$args[] = array('AND',"userregtime >= :userregtime",'userregtime',$stime);
				}
				if($search['etime']){
					$etime = strtotime($search['etime']);
					$args[] = array('AND',"userregtime <= :userregtime",'userregtime',$etime);
				}
			}
			$users = M('user','user')->getUserList($args,$page,10);
			M('tpl')->assign('course',$course);
			M('tpl')->assign('users',$users);
			M('tpl')->assign('search',$search);
			M('tpl')->assign('u',$u);
			M('tpl')->assign('page',$page);
			M('tpl')->display('course_selectmember');
		}
	}

	private function add()
	{
		if(M('ev')->get('submit'))
		{
			$args = M('ev')->get('args');
			$args['csuserid'] = $this->user['userid'];
			$args['cstime'] = TIME;
			$id = M('course','course')->addCourse($args);
			$message = array(
				'statusCode' => 200,
				"message" => "操作成功",
			    "callbackType" => "forward",
			    "forwardUrl" => "index.php?course-master-course&catid={$args['cscatid']}"
			);
			\PHPEMS\ginkgo::R($message);
		}
		else
		{
			$catid = intval(M('ev')->get('catid'));
			$parentcat = M('category')->getCategoriesByArgs(array(array("AND","catparent = 0")));
			M('tpl')->assign('parentcat',$parentcat);
			M('tpl')->assign('catid',$catid);
			M('tpl')->display('course_add');
		}
	}

	private function edit()
	{
		$page = intval(M('ev')->get('page'));
		$courseid = intval(M('ev')->get('courseid'));
		$course = M('course','course')->getCourseById($courseid);
		if(M('ev')->get('submit'))
		{
			$args = M('ev')->get('args');
			M('course','course')->modifyCourse($courseid,$args);
			$message = array(
				'statusCode' => 200,
				"message" => "操作成功",
			    "callbackType" => "forward",
			    "forwardUrl" => "index.php?course-master-course&catid={$course['cscatid']}&page={$page}{$u}"
			);
			\PHPEMS\ginkgo::R($message);
		}
		else
		{
			$catid = intval(M('ev')->get('catid'));
			$cat = M('category')->getCategoryById($catid);
			$parentcat = M('category')->getCategoriesByArgs(array(array("AND","catparent = 0")));
			$teachers = M('user','user')->getUsersByArgs(array(array("AND","groupmoduleid = 12"),array("AND","usergroupid = groupid")));
            M('tpl')->assign('teachers',$teachers);
			M('tpl')->assign('parentcat',$parentcat);
			M('tpl')->assign('catid',$catid);
			M('tpl')->assign('cat',$cat);
			M('tpl')->assign('courseid',$courseid);
			M('tpl')->assign('course',$course);
			M('tpl')->assign('page',$page);
			M('tpl')->display('course_edit');
		}
	}

	private function del()
	{
		$page = intval(M('ev')->get('page'));
		$courseid = intval(M('ev')->get('courseid'));
		$number = M('content','course')->getCourseContentNumber($courseid);
		if(!$number)
		{
			M('course','course')->delCourse($courseid);
			$message = array(
				'statusCode' => 200,
				"message" => "操作成功",
			    "callbackType" => "forward",
			    "forwardUrl" => "reload"
			);
		}
		else
		{
			$message = array(
				'statusCode' => 300,
				"message" => "操作失败，请先删除本课程下所有课件"
			);
		}
		\PHPEMS\ginkgo::R($message);
	}

	private function addmember()
	{
		$courseid = M('ev')->get('courseid');
		M('tpl')->assign('courseid',$courseid);
		if(M('ev')->get('addmember'))
		{
			$userids = M('ev')->get('userids');
			$usernames = M('ev')->get('usernames');
			$usergroupids = M('ev')->get('usergroupids');
			$days = M('ev')->get('days');
			if($userids && $days)
			{
				$userids = explode(",",$userids);
				foreach($userids as $userid)
				{
					M('course','course')->openCourse(array('ocuserid'=>$userid,'occourseid'=>$courseid,'ocendtime' => TIME + $days*24*3600));
				}
				$message = array(
					'statusCode' => 200,
					"message" => "操作成功",
					"callbackType" => "forward",
			    	"forwardUrl" => "index.php?course-master-course-members&courseid=".$courseid
				);
			}
			elseif($usernames && $days)
			{
				$usernames = implode(",",array_unique(explode(",",$usernames)));
				$userids = M('user','user')->getUsersByArgs(array(array("AND","find_in_set(username,:username)",'username',$usernames),array("AND","user.usergroupid = user_group.groupid")),false,false,false);
				foreach($userids as $user)
				{
					M('course','course')->openCourse(array('ocuserid'=>$user['userid'],'occourseid'=>$courseid,'ocendtime' => TIME + $days*24*3600));
				}
				$message = array(
					'statusCode' => 200,
					"message" => "操作成功",
					"callbackType" => "forward",
			    	"forwardUrl" => "index.php?course-master-course-members&courseid=".$courseid
				);
			}
			elseif($usergroupids && $days)
			{
				$usergroupids = implode(",",array_unique(explode(",",$usergroupids)));
				$userids = M('user','user')->getUsersByArgs(array(array("AND","find_in_set(usergroupid,:usergroupid)",'usergroupid',$usergroupids),array("AND","user.usergroupid = user_group.groupid")),false,false,false);
				foreach($userids as $user)
				{
					M('course','course')->openCourse(array('ocuserid'=>$user['userid'],'occourseid'=>$courseid,'ocendtime' => TIME + $days*24*3600));
				}
				$message = array(
					'statusCode' => 200,
					"message" => "操作成功",
					"callbackType" => "forward",
			    	"forwardUrl" => "index.php?course-master-course-members&courseid=".$courseid
				);
			}
			else
			{
				$message = array(
					'statusCode' => 300,
					"message" => "参数错误"
				);
			}
			\PHPEMS\ginkgo::R($message);
		}
		else
		{
			M('tpl')->display('course_addmember');
		}
	}

	private function getcoursemembernumber()
	{
		$courseid = M('ev')->get('courseid');
		$number = M('course','course')->getOpenCourseNumber($courseid);
		echo intval($number);
	}

	private function members()
	{
		$courseid = M('ev')->get('courseid');
		$search = M('ev')->get('search');
		$page = M('ev')->get('page');
		$args = array();
		$args[] = array("AND",'opencourse.occourseid = :occourseid','occourseid',$courseid);
		$args[] = array("AND",'opencourse.ocendtime >= :ocendtime','ocendtime',TIME);
		if($search['userid'])
		{
			$args[] = array("AND",'user.userid = :userid','userid',$search['userid']);
		}
		if($search['username'])
		{
			$args[] = array("AND",'user.username LIKE :username','username','%'.$search['username'].'%');
		}
		$members = M('course','course')->getOpenCourseMember($args,$page);
		$course = M('course','course')->getCourseById($courseid);
		M('tpl')->assign('search',$search);
		M('tpl')->assign('courseid',$courseid);
		M('tpl')->assign('course',$course);
		M('tpl')->assign('members',$members);
		M('tpl')->assign('page',$page);
		M('tpl')->display('course_members');
	}

	private function lite()
	{
		$catid = M('ev')->get('catid');
		$page = M('ev')->get('page');
		M('tpl')->assign('catid',$catid);
		M('tpl')->assign('page',$page);
		if(M('ev')->get('modifycoursesequence'))
		{
			if(M('ev')->get('action') == 'delete')
			{
				$ids = M('ev')->get('delids');
				foreach($ids as $key => $id)
				{
					$number = M('content','course')->getCourseContentNumber($key);
					if(!$number)
					M('course','course')->delCourse($key);
				}
			}
			elseif(M('ev')->get('action') == 'movecategory')
			{
				$courseids = array();
				$ids = M('ev')->get('delids');
				foreach($ids as $key => $id)
				{
					if($key)$courseids[] = $key;
				}
				$courseids = implode(',',$courseids);
				$parentcat = M('category')->getCategoriesByArgs(array(array("AND","catparent = 0")));
				M('tpl')->assign('parentcat',$parentcat);
				M('tpl')->assign('courseids',$courseids);
				M('tpl')->display('course_move');
				exit;
			}
			else
			{
				$ids = M('ev')->get('ids');
				foreach($ids as $key => $id)
				{
					M('course','course')->modifyBasciCourse($key,array('cssequence' => $id));
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
		elseif(M('ev')->get('movecategory'))
		{
			$courseids = explode(',',M('ev')->get('courseids'));
			$targetcatid = M('ev')->get('targetcatid');
			if($targetcatid)
			{
				foreach($courseids as $key => $id)
				{
					if($id)M('course','course')->modifyBasciCourse($id,array('cscatid' => $targetcatid));
				}
				$message = array(
					'statusCode' => 200,
					"message" => "操作成功",
					"callbackType" => "forward",
				    "forwardUrl" => "index.php?course-master-course&catid={$catid}&page={$page}{$u}"
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
		$search = M('ev')->get('search');
		$catid = intval(M('ev')->get('catid'));
		if(!$catid)$catid = $search['cscatid'];
		$page = M('ev')->get('page');
		$page = $page?$page:1;
		$categories = M('category')->getAllCategory();
		$parentcat = M('category')->getCategoriesByArgs(array(array("AND","catparent = 0"),array("AND","catapp = 'course'")));
		if($catid)
		{
			$childstring = M('category')->getChildCategoryString($catid);
			$args = array(array("AND","find_in_set(cscatid,:cscatid)",'cscatid',$childstring));
		}
		else $args = array();
        //$args[] = array("AND","csteacher = :csteacher","csteacher",$this->_user['username']);
        $args[] = array("AND","find_in_set(cssubjectid,:cssubjectid)","cssubjectid",$this->teachsubjects);
		if($search['courseid'])
		{
			$args[] = array("AND","csid = :csid",'csid',$search['courseid']);
		}
		else
		{
			if($search['stime'])$args[] = array("AND","cstime >= :csstime",'csstime',strtotime($search['stime']));
			if($search['etime'])$args[] = array("AND","cstime <= :csetime",'csetime',strtotime($search['etime']));
			if($search['keyword'])$args[] = array("AND","cstitle LIKE :cstitle",'cstitle',"%{$search['keyword']}%");
			if($search['username'])
			{
				$user = M('user','user')->getUserByUserName($search['username']);
				$args[] = array("AND","csuserid = :csuserid",'csuserid',$user['userid']);
			}
		}
		$courses = M('course','course')->getCourseList($args,$page,10);
		M('tpl')->assign('page',$page);
		M('tpl')->assign('catid',$catid);
		M('tpl')->assign('courses',$courses);
		M('tpl')->assign('categories',$categories);
		M('tpl')->assign('parentcat',$parentcat);
		M('tpl')->display('course');
	}
}


?>
