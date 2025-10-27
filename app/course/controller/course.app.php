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

	private function pdfview()
	{
		M('tpl')->display('viewer');
	}

	private function opencourse()
	{
		$csid = M('ev')->get('csid');
		$course = M('course','course')->getCourseById($csid);
		if(M('ev')->get('opencs'))
		{
			$userid = $this->user['userid'];
			if(M('course','course')->getOpenCourseByUseridAndCsid($userid,$csid))
			{
				$message = array(
					'statusCode' => 300,
					"message" => "您已经开通了本课程"
				);
			}
			if($course['csdemo'])
			{
				$time = 365*24*3600;
			}
			else
			{
				$opentype = intval(M('ev')->get('opentype'));
				$price = 0;
				if(trim($course['csprice']))
				{
					$price = array();
					$course['csprice'] = explode("\n",$course['csprice']);
					foreach($course['csprice'] as $p)
					{
						if($p)
						{
							$p = explode(":",$p);
							$price[] = array('time'=>intval($p[0]),'price'=>intval($p[1]));
						}
					}
				}
				if(!$price[$opentype])$t = $price[0];
				else
				$t = $price[$opentype];
				$time = $t['time']*24*3600;
				$score = $t['price'];
				$user = M('user','user')->getUserById($this->user['userid']);
				if($user['usercoin'] < $score)
				{
					$message = array(
						'statusCode' => 300,
						"message" => "开通失败，您的积分不够"
					);
					\PHPEMS\ginkgo::R($message);
				}
				else
				{
					$args = array("usercoin" => $user['usercoin'] - $score);
					M('user','user')->modifyUserInfo($this->user['userid'],$args);
				}
			}
			$args = array('ocuserid'=>$userid,'occourseid'=>$csid,'ocendtime'=>TIME + $time);
			M('course','course')->openCourse($args);
			$message = array(
				'statusCode' => 200,
				"message" => "开通成功!",
				"callbackType" => "forward",
			    "forwardUrl" => "index.php?course-app-course&csid=".$csid
			);
			\PHPEMS\ginkgo::R($message);
		}
		else
		{
			$price = 0;
			if(trim($course['csprice']))
			{
				$price = array();
				$course['csprice'] = explode("\n",$course['csprice']);
				foreach($course['csprice'] as $p)
				{
					if($p)
					{
						$p = explode(":",$p);
						$price[] = array('time'=>$p[0],'price'=>$p[1]);
					}
				}
				M('tpl')->assign('price',$price);
			}
			$isopen = M('course','course')->getOpenCourseByUseridAndCsid($this->user['userid'],$csid);
			M('tpl')->assign('isopen',$isopen);
			M('tpl')->assign('course',$course);
			M('tpl')->display('opencourse');
		}
	}

	private function recordtime()
	{
		$courseid = M('ev')->get('courseid');
		$time = intval(M('ev')->get('time'));
		$r = M('log','course')->getLogByArgs(array(array('AND',"loguserid = :loguserid",'loguserid',$this->user['userid']),array('AND',"logcourseid = :logcourseid",'logcourseid',$courseid)));
		if($r)
        {
            M('log','course')->modifyLog($r['logid'],array('logprogress' => $time));
		}
        exit('1');
	}

	private function endstatus()
    {
        $courseid = M('ev')->get('courseid');
        $r = M('log','course')->getLogByArgs(array(array('AND',"loguserid = :loguserid",'loguserid',$this->user['userid']),array('AND',"logcourseid = :logcourseid",'logcourseid',$courseid)));
        if($r)
        {
            M('log','course')->modifyLog($r['logid'],array('logstatus' => 1,'logendtime' => TIME, 'logprogress' => 0));
        }
        exit('1');
    }

	private function index()
	{
		$page = M('ev')->get('page');
		$csid = M('ev')->get('csid');
		$contentid = M('ev')->get('contentid');
		$course = M('course','course')->getCourseById($csid);
		$catbread = M('category')->getCategoryPos($course['cscatid']);
		$cat = M('category')->getCategoryById($course['cscatid']);
		$oc = M('course','course')->getOpenCourseByUseridAndCsid($this->user['userid'],$csid);
		if(!$oc)
		{
			header("location:index.php?course-app-course-opencourse&csid=".$csid);
			exit;
		}
		else
		{
            M('tpl')->assign('oc',$oc);
		}
		$courseid = $course['csid'];
		$lessons = M('content','course')->getCoursesByCsid($courseid)['data'];
		if($contentid)$content = $lessons[$contentid];
		$tmparray = array();
		$defaultlesson = 0;
		foreach($lessons as $lesson)
		{
			$tmparray[intval($lesson['coursedirid'])][] = $lesson;
		}
		$ids = array();
		$ids = M('content','course')->dgCourse(0,$tmparray,$ids);
		foreach($ids as $id)
		{
			if($lessons[$id]['coursemoduleid'] != 40)
			{
				if(!$defaultlesson)$defaultlesson = $lessons[$id];
			}
		}
		if(!$contentid)
		{
			$content = $defaultlesson;
		}
		if($content['courseid'])
        {
            $r = M('log','course')->getLogByArgs(array(array('AND',"loguserid = :loguserid",'loguserid',$this->user['userid']),array('AND',"logcourseid = :logcourseid",'logcourseid',$content['courseid'])));
            if(!$r)M('log','course')->addLog(array('loguserid' => $this->user['userid'],'logcourseid' => $content['courseid']));
        }
		$module = M('module')->getModuleById($content['coursemoduleid']);
		switch($module['modulecode'])
		{
			case 'pdf':
			$template = 'course_pdf';
			break;

			default:
			$template = 'course_default';
			break;
		}
		$logs = M('log','course')->getLogsByCsid($course['csid'],$this->user['userid']);
		M('tpl')->assign('logs',$logs);
		M('tpl')->assign('cat',$cat);
		M('tpl')->assign('page',$page);
		M('tpl')->assign('catbread',$catbread);
		M('tpl')->assign('course',$course);
		M('tpl')->assign('lessons',$lessons);
		M('tpl')->assign('ids',$ids);
		M('tpl')->assign('content',$content);
		M('tpl')->display($template);
	}
}


?>
