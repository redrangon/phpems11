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
		$search = M('ev')->get('search');
		$this->u = '';
		if($search)
		{
			M('tpl')->assign('search',$search);
			foreach($search as $key => $arg)
			{
				$this->u .= "&search[{$key}]={$arg}";
			}
		}
		M('tpl')->assign('search',$search);
		if(!method_exists($this,$action))
		$action = "index";
		$this->$action();
		exit;
	}

    private function setdochistory()
    {
        if(M('ev')->get('setdochistory'))
        {
        	if(M('ev')->get('action') == 'delete')
            {
                $ids = M('ev')->get('delids');
                foreach($ids as $key => $id)
                {
                    M('doc','docs')->delDocHistory($key);
                }
            }
			elseif(M('ev')->get('action') == 'pass')
            {
                $ids = M('ev')->get('delids');
                foreach($ids as $key => $id)
                {
                    M('doc','docs')->modifyDocHistory($key,array('dhstatus' => 1));
                }
            }
			elseif(M('ev')->get('action') == 'unpass')
            {
                $ids = M('ev')->get('delids');
                foreach($ids as $key => $id)
                {
                    M('doc','docs')->modifyDocHistory($key,array('dhstatus' => 2));
                }
            }
			elseif(M('ev')->get('action') == 'waitpass')
            {
                $ids = M('ev')->get('delids');
                foreach($ids as $key => $id)
                {
                    M('doc','docs')->modifyDocHistory($key,array('dhstatus' => 0));
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
		elseif(M('ev')->get('action') == 'nowuse')
        {
            $dhid = M('ev')->get('dhid');
            $history = M('doc','docs')->getDocHistroyById($dhid);
            M('doc','docs')->modifyDoc($history['dhdocid'],array('doccontentid' => $dhid));
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
            $message = array(
                'statusCode' => 300,
                "message" => "无效访问"
            );
            \PHPEMS\ginkgo::R($message);
        }
    }

	private function history()
	{
		$docid = M('ev')->get('docid');
        $page = M('ev')->get('page');
        $doc = M('doc','docs')->getDocById($docid,false);
        $args = array();
        $args[] = array("AND","dhdocid = :dhdocid","dhdocid",$docid);
        $histories = M('doc','docs')->getDocHistoryListByArgs($args,$page);
        M('tpl')->assign('doc',$doc);
        M('tpl')->assign('histories',$histories);
        M('tpl')->display('docs_history');
	}

    private function catsmenu()
    {
        $catid = M('ev')->get('catid');
        $categories = M('category')->getAllCategory();
        $r = array();
        M('category')->selected = $catid;
        M('category')->hrefpre = 'index.php?docs-master-docs&catid=';
        M('category')->levelCategory($r,0,M('category')->tidycategories);
        M('category')->resetCategoryIndex($r);
        echo json_encode($r);
        exit();
    }

	private function add()
	{
		if(M('ev')->get('submit'))
		{
			$args = M('ev')->get('args');
			$args['docusername'] = $this->_user['sessionusername'];
			$args['docinputtime'] = TIME;
            $args['docneedmore'] = 1;
			$id = M('doc','docs')->addDoc($args);
			$message = array(
				'statusCode' => 200,
				"message" => "操作成功",
			    "callbackType" => "forward",
			    "forwardUrl" => "index.php?docs-master-docs&catid={$args['doccatid']}"
			);
			\PHPEMS\ginkgo::R($message);
		}
		else
		{
			$catid = intval(M('ev')->get('catid'));
			$parentcat = M('category')->getCategoriesByArgs(array(array("AND","catparent = 0")));
			M('tpl')->assign('parentcat',$parentcat);
			M('tpl')->assign('catid',$catid);
			M('tpl')->display('docs_add');
		}
	}

	private function edit()
	{
		$page = intval(M('ev')->get('page'));
        $docid = intval(M('ev')->get('docid'));
        $doc = M('doc','docs')->getDocById($docid,false);
		if(M('ev')->get('submit'))
		{

			$args = M('ev')->get('args');
			$args['docmodifytime'] = TIME;
			unset($args['doccatid']);
			M('doc','docs')->modifyDoc($docid,$args);
			$message = array(
				'statusCode' => 200,
				"message" => "操作成功",
			    "callbackType" => "forward",
			    "forwardUrl" => "index.php?docs-master-docs&catid={$doc['doccatid']}&page={$page}{$this->u}"
			);
			\PHPEMS\ginkgo::R($message);
		}
		else
		{
			$catid = intval(M('ev')->get('catid'));
			$cat = M('category')->getCategoryById($catid);
			M('tpl')->assign('catid',$catid);
			M('tpl')->assign('cat',$cat);
			M('tpl')->assign('docid',$docid);
			M('tpl')->assign('doc',$doc);
			M('tpl')->assign('page',$page);
			M('tpl')->display('docs_edit');
		}
	}

	private function del()
	{
		$page = intval(M('ev')->get('page'));
        $docid = intval(M('ev')->get('docid'));
		$doc = M('doc','docs')->getDocById($docid);
		if($doc)
		M('doc','docs')->delDoc($docid);
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
					M('doc','docs')->delDoc($key);
				}
			}
			elseif(M('ev')->get('action') == 'move')
			{
				$docids = array();
				$ids = M('ev')->get('delids');
				foreach($ids as $key => $id)
				{
					if($key)$docids[] = $key;
				}
                $docids = implode(',',$docids);
				$parentcat = M('category')->getCategoriesByArgs(array(array("AND","catparent = 0")));
				M('tpl')->assign('parentcat',$parentcat);
				M('tpl')->assign('docids',$docids);
				M('tpl')->display('docs_move');
				exit;
			}
            elseif(M('ev')->get('action') == 'more')
            {
                $ids = M('ev')->get('delids');
                foreach($ids as $key => $id)
                {
                    M('doc','docs')->modifyDoc($key,array('docneedmore' => 1));
                }
            }
            elseif(M('ev')->get('action') == 'unmore')
            {
                $ids = M('ev')->get('delids');
                foreach($ids as $key => $id)
                {
                    M('doc','docs')->modifyDoc($key,array('docneedmore' => 0));
                }
            }
            elseif(M('ev')->get('action') == 'top')
            {
                $ids = M('ev')->get('delids');
                foreach($ids as $key => $id)
                {
                    M('doc','docs')->modifyDoc($key,array('docistop' => 1));
                }
            }
            elseif(M('ev')->get('action') == 'untop')
            {
                $ids = M('ev')->get('delids');
                foreach($ids as $key => $id)
                {
                    M('doc','docs')->modifyDoc($key,array('docistop' => 0));
                }
            }
            elseif(M('ev')->get('action') == 'lock')
            {
                $ids = M('ev')->get('delids');
                foreach($ids as $key => $id)
                {
                    M('doc','docs')->modifyDoc($key,array('docsyslock' => 1));
                }
            }
            elseif(M('ev')->get('action') == 'unlock')
            {
                $ids = M('ev')->get('delids');
                foreach($ids as $key => $id)
                {
                    M('doc','docs')->modifyDoc($key,array('docsyslock' => 0));
                }
            }
			else
			{
				$ids = M('ev')->get('ids');
				foreach($ids as $key => $id)
				{
					M('doc','docs')->modifyDoc($key,array('docsequence' => $id));
				}
			}
			$message = array(
				'statusCode' => 200,
				"message" => "操作成功",
				"callbackType" => "forward",
			    "forwardUrl" => "index.php?docs-master-docs&catid={$catid}&page={$page}{$u}"
			);
			\PHPEMS\ginkgo::R($message);
		}
		elseif(M('ev')->get('movecategory'))
		{
			$docids = explode(',',M('ev')->get('docids'));
			$targetcatid = M('ev')->get('targetcatid');
			if($targetcatid)
			{
				foreach($docids as $key => $id)
				{
					if($id)M('doc','docs')->modifyDoc($id,array('doccatid' => $targetcatid));
				}
				$message = array(
					'statusCode' => 200,
					"message" => "操作成功",
					"callbackType" => "forward",
				    "forwardUrl" => "index.php?docs-master-docs&catid={$catid}&page={$page}{$u}"
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
		$page = intval(M('ev')->get('page'));
		$page = $page?$page:1;
		if(!$catid)$catid = $search['doccatid'];
		$categories = M('category')->getAllCategory();
		$parentcat = M('category')->getCategoriesByArgs(array(array("AND","catparent = 0"),array("AND","catapp = 'docs'")));
		if($catid)
		{
			$childstring = M('category')->getChildCategoryString($catid);
			$args = array(array("AND","find_in_set(doccatid,:doccatid)",'doccatid',$childstring));
		}
		else $args = array();
		if($search['docid'])
		{
			$args[] = array("AND","docid = :docid",'docid',$search['docid']);
		}
		else
		{
			if($search['doccatid'])$args[] = array("AND","doccatid = :doccatid",'doccatid',$search['doccatid']);
			if($search['stime'])$args[] = array("AND","docinputtime >= :sdocinputtime",'sdocinputtime',strtotime($search['stime']));
			if($search['etime'])$args[] = array("AND","docinputtime <= :edocinputtime",'edocinputtime',strtotime($search['etime']));
			if($search['keyword'])$args[] = array("AND","doctitle LIKE :doctitle",'doctitle',"%{$search['keyword']}%");
            if($search['docneedmore'])
            {
                if($search['docneedmore'] == '-1')$nm = 0;
                else $nm = 1;
                $args[] = array("AND","docneedmore = :docneedmore",'docneedmore',$nm);
            }
            if($search['docistop'])
            {
                if($search['docistop'] == '-1')$top = 0;
                else $top = 1;
                $args[] = array("AND","docistop = :docistop",'docistop',$top);
            }
            if($search['docsyslock'])
            {
                if($search['docsyslock'] == '-1')$lock = 0;
                else $lock = 1;
                $args[] = array("AND","docsyslock = :docsyslock",'docsyslock',$lock);
            }
		}
        $catlevel = 1;
        if($catid)
        {
            $pos = M('category')->getCategoryPos($catid);
            if(count($pos))
                $catlevel = count($pos) + 1;
        }
        M('tpl')->assign('catlevel',$catlevel);
		$docs = M('doc','docs')->getDocList($args,$page,10);
		M('tpl')->assign('catid',$catid);
		M('tpl')->assign('docs',$docs);
		M('tpl')->assign('parentcat',$parentcat);
		M('tpl')->assign('categories',$categories);
		M('tpl')->assign('page',$page);
		M('tpl')->display('docs');
	}
}


?>
