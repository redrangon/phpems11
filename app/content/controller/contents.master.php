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
	public $search;
	public $u;
	
	public function display()
	{
		$action = M('ev')->url(3);
		$this->search = M('ev')->get('search');
		$this->u = '';
		if($this->search)
		{
			M('tpl')->assign('search',$this->search);
			foreach($this->search as $key => $arg)
			{
				$this->u .= "&search[{$key}]={$arg}";
			}
			M('tpl')->assign('u',$this->u);
		}
		if(!method_exists($this,$action))
		$action = "index";
		$this->$action();
		exit;
	}

	private function catsmenu()
	{
        $catid = M('ev')->get('catid');
		$categories = M('category')->getAllCategory();
        $r = array();
        M('category')->selected = $catid;
        M('category')->hrefpre = 'index.php?content-master-contents&catid=';
        M('category')->levelCategory($r,0,M('category')->tidycategories);
        M('category')->resetCategoryIndex($r);
        echo json_encode($r,JSON_UNESCAPED_UNICODE);
        exit();
	}

	private function add()
	{
		if(M('ev')->get('submit'))
		{
			$args = M('ev')->get('args');
			$args['contentuserid'] = $this->user['userid'];
			$args['contentusername'] = $this->_user['sessionusername'];
			if(!$args['contentinputtime'])$args['contentinputtime'] = TIME;
			else
			$args['contentinputtime'] = strtotime($args['contentinputtime']);
			$group = M('user','user')->getGroupById($this->_user['sessiongroupid']);
			$args = M('module')->tidyNeedFieldsPars($args,$args['contentmoduleid'],1);
			$id = M('content','content')->addContent($args);
			$message = array(
				'statusCode' => 200,
				"message" => "操作成功",
			    "callbackType" => "forward",
			    "forwardUrl" => "index.php?content-master-contents&catid={$args['contentcatid']}"
			);
			\PHPEMS\ginkgo::R($message);
		}
		else
		{
			$catid = intval(M('ev')->get('catid'));
            $moduleid = intval(M('ev')->get('moduleid'));
			$parentcat = M('category')->getCategoriesByArgs(array(array("AND","catparent = 0"),array("AND","catapp = 'content'")));
			$modules = M('module')->getModulesByApp(\PHPEMS\ginkgo::$app);
            $fields = M('module')->getMoudleFields($moduleid,1);
            $forms = M('html')->buildHtml($fields);
			$tpls = array();
			foreach(glob("app/content/tpls/app/content_*.tpl") as $p)
			{
				$tpls[] = substr(basename($p),0,-4);
			}
			M('tpl')->assign('moduleid',$moduleid);
            M('tpl')->assign('forms',$forms);
            M('tpl')->assign('tpls',$tpls);
			M('tpl')->assign('modules',$modules);
			M('tpl')->assign('parentcat',$parentcat);
			M('tpl')->assign('catid',$catid);
			M('tpl')->display('content_add');
		}
	}

	private function edit()
	{
		$page = intval(M('ev')->get('page'));
		if(M('ev')->get('submit'))
		{
			$contentid = intval(M('ev')->get('contentid'));
			$content = M('content','content')->getContentById($contentid);
			$args = M('ev')->get('args');
			if(!$args['contentinputtime'])$args['contentinputtime'] = TIME;
			else
			$args['contentinputtime'] = strtotime($args['contentinputtime']);
			$args['contentmodifytime'] = TIME;
			unset($args['contentcatid']);
			$group = M('user','user')->getGroupById($this->_user['sessiongroupid']);
			$args = M('module')->tidyNeedFieldsPars($args,$content['contentmoduleid'],1);
			M('content','content')->modifyContent($contentid,$args);
            M('position','content')->modifyPosContentByContentId($contentid,array('pctitle' => $args['contenttitle'],'pcthumb' => $args['contentthumb'],'pcdescribe' => $args['contentdescribe']),'content');
			$message = array(
				'statusCode' => 200,
				"message" => "操作成功",
			    "callbackType" => "forward",
			    "forwardUrl" => "index.php?content-master-contents&catid={$content['contentcatid']}&page={$page}{$u}"
			);
			\PHPEMS\ginkgo::R($message);
		}
		else
		{
			$catid = intval(M('ev')->get('catid'));
			$cat = M('category')->getCategoryById($catid);
			$contentid = intval(M('ev')->get('contentid'));
			$content = M('content','content')->getContentById($contentid);
			$userid = $this->user['userid'];
			$user = M('user','user')->getUserById($userid);
			$group = M('user','user')->getGroupById($user['usergroupid']);
			$fields = M('module')->getMoudleFields($content['contentmoduleid'],1);
			$forms = M('html')->buildHtml($fields,$content);
			$tpls = array();
			foreach(glob("app/content/tpls/app/content_*.tpl") as $p)
			{
				$tpls[] = substr(basename($p),0,-4);
			}
			M('tpl')->assign('tpls',$tpls);
			M('tpl')->assign('fields',$fields);
			M('tpl')->assign('catid',$catid);
			M('tpl')->assign('cat',$cat);
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
		$content = M('content','content')->getContentById($contentid);
		M('content','content')->delContent($contentid);
		$message = array(
			'statusCode' => 200,
			"message" => "操作成功",
		    "target" => "",
		    "rel" => "",
		    "callbackType" => "forward",
		    "forwardUrl" => "index.php?content-master-contents&catid={$content['contentcatid']}&page={$page}"
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
					M('content','content')->delContent($key);
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
				$parentcat = M('category')->getCategoriesByArgs(array(array("AND","catparent = 0"),array("AND","catapp = 'content'")));
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
				$parentcat = M('category')->getCategoriesByArgs(array(array("AND","catparent = 0"),array("AND","catapp = 'content'")));
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
				$poses = M('position','content')->getPosList();
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
					M('content','content')->modifyBasciContent($key,array('contentsequence' => $id));
				}
			}
			$message = array(
				'statusCode' => 200,
				"message" => "操作成功",
				"callbackType" => "forward",
			    "forwardUrl" => "index.php?content-master-contents&catid={$catid}&page={$page}{$u}"
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
						$basic = M('content','content')->getBasicContentById($id);
						$args = array('pctitle' => $basic['contenttitle'],'pctime' => $basic['contentinputtime'],'pcposapp' => 'content','pccontentid' => $id,'pcthumb' => $basic['contentthumb'],'pcdescribe' => $basic['contentdescribe'],'pcposid' => $position);
						M('position','content')->addPosContent($args);
					}
				}
				$message = array(
					'statusCode' => 200,
					"message" => "操作成功",
					"callbackType" => "forward",
				    "forwardUrl" => "index.php?content-master-contents&catid={$catid}&page={$page}{$u}"
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
					if($id)M('content','content')->modifyBasciContent($id,array('contentcatid' => $targetcatid));
				}
				$message = array(
					'statusCode' => 200,
					"message" => "操作成功",
					"callbackType" => "forward",
				    "forwardUrl" => "?content-master-contents&catid={$catid}&page={$page}{$u}"
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
						$content = M('content','content')->getBasicContentById($id);
						$args = array('contentcatid' => $targetcatid,'contenttitle' => $content['contenttitle'],'contentmoduleid' => $content['contentmoduleid'],'contentthumb' => $content['contentthumb'],'contentlink' => 'index.php?content-app-content&contentid='.$content['contentid']);
						$args['contentuserid'] = $this->user['userid'];
						$args['contentusername'] = $this->_user['sessionusername'];
						$args['contentinputtime'] = TIME;
						M('content','content')->addContent($args);
					}
				}
				$message = array(
					'statusCode' => 200,
					"message" => "操作成功",
					"callbackType" => "forward",
				    "forwardUrl" => "index.php?content-master-contents&catid={$catid}&page={$page}{$u}"
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

	private function addpage()
	{
        $modules = M('module')->getModulesByApp(\PHPEMS\ginkgo::$app);
        M('tpl')->assign('modules',$modules);
		M('tpl')->display('addpage');
	}

	private function index()
	{
		$catid = intval(M('ev')->get('catid'));
		$page = intval(M('ev')->get('page'));
		if(!$catid)$catid = $this->search['contentcatid'];
		$categories = M('category')->getAllCategory();
		$parentcat = M('category')->getCategoriesByArgs(array(array("AND","catparent = 0"),array("AND","catapp = 'content'")));
		if($catid)
		{
			$childstring = M('category')->getChildCategoryString($catid);
			$args = array(array("AND","find_in_set(contentcatid,:contentcatid)",'contentcatid',$childstring));
		}
		else $args = array();
		if($this->search['contentid'])
		{
			$args[] = array("AND","contentid = :contentid",'contentid',$this->search['contentid']);
		}
		else
		{
			if($this->search['contentcatid'])$args[] = array("AND","contentcatid = :contentcatid",'contentcatid',$this->search['contentcatid']);
			if($this->search['contentmoduleid'])$args[] = array("AND","contentmoduleid = :contentmoduleid",'contentmoduleid',$this->search['contentmoduleid']);
			if($this->search['stime'])$args[] = array("AND","contentinputtime >= :scontentinputtime",'scontentinputtime',strtotime($this->search['stime']));
			if($this->search['etime'])$args[] = array("AND","contentinputtime <= :econtentinputtime",'econtentinputtime',strtotime($this->search['etime']));
			if($this->search['keyword'])$args[] = array("AND","contenttitle LIKE :contenttitle",'contenttitle',"%{$this->search['keyword']}%");
			if($this->search['username'])
			{
				$user = M('user','user')->getUserByUserName($this->search['username']);
				$args[] = array("AND","contentuserid = :contentuserid",'contentuserid',$user['userid']);
			}
		}
		$contents = M('content','content')->getContentList($args,$page,10);
		$modules = M('module')->getModulesByApp(\PHPEMS\ginkgo::$app);
		$catlevel = 1;
		if($catid)
		{
            $pos = M('category')->getCategoryPos($catid);
            if(count($pos))
			{
				$catlevel = count($pos) + 1;
			}
		}
        M('tpl')->assign('catlevel',$catlevel);
		M('tpl')->assign('modules',$modules);
		M('tpl')->assign('catid',$catid);
		M('tpl')->assign('contents',$contents);
		M('tpl')->assign('parentcat',$parentcat);
		M('tpl')->assign('categories',$categories);
		M('tpl')->assign('page',$page);
		M('tpl')->display('content');
	}
}


?>
