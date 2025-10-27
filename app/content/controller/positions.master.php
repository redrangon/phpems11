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

	private function add()
	{
		if(M('ev')->get('addpos'))
		{
			$args = M('ev')->get('args');
			M('position','content')->addPos($args);
			$message = array(
				'statusCode' => 200,
				"message" => "操作成功",
			    "callbackType" => "forward",
			    "forwardUrl" => "index.php?content-master-positions"
			);
			\PHPEMS\ginkgo::R($message);
		}
		else
		{
			M('tpl')->display('positions_add');
		}
	}

    private function modify()
    {
        $posid = M('ev')->get('posid');
        $pos = M('position','content')->getPosById($posid);
    	if(M('ev')->get('modifypos'))
        {
            $args = M('ev')->get('args');
            M('position','content')->modifyPos($posid,$args);
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
            $apps = M('apps','core')->getAppList();
            foreach($apps as $id => $app)
            {
                $tmp = M('api',$app['appid']);
                if($tmp && method_exists($tmp,'parseBlock'))
                    continue;
                else
                    unset($apps[$id]);
            }
            M('tpl')->assign('pos',$pos);
            M('tpl')->display('positions_modify');
        }
    }

    private function del()
    {
        $posid = M('ev')->get('posid');
        if(M('position','content')->getPosContentNumber($posid))
		{
            $message = array(
                'statusCode' => 300,
                "message" => "请先删除本推荐位下的内容"
            );
		}
		else
		{
			M('position','content')->delPos($posid);
			$message = array(
				'statusCode' => 200,
				"message" => "操作成功",
				"callbackType" => "forward",
				"forwardUrl" => "reload"
			);
        }
        \PHPEMS\ginkgo::R($message);
    }

	private function delcontent()
	{
		$pcid = M('ev')->get('pcid');
		$page = M('ev')->get('page');
		M('position','content')->delPosContent($pcid);
		$message = array(
			'statusCode' => 200,
			"message" => "操作成功",
		    "callbackType" => "forward",
		    "forwardUrl" => "reload"
		);
		\PHPEMS\ginkgo::R($message);
	}

	private function poscontent()
	{
        $page = M('ev')->get('page');
	    $posid = M('ev')->get('posid');
        $pos = M('position','content')->getPosById($posid);
        $args = array();
        $args[] = array("AND","pcposid = :pcposid","pcposid",$posid);
        $contents = M('position','content')->getPosContentList($args,$page,20);
        M('tpl')->assign('contents',$contents);
        M('tpl')->assign('pos',$pos);
        M('tpl')->display('position_content');
	}

	private function lite()
	{
		if(M('ev')->get('modifycontentsequence'))
		{
			$page = M('ev')->get('page');
			if(M('ev')->get('action') == 'delete')
			{
				$ids = M('ev')->get('delids');
				foreach($ids as $key => $id)
				{
					M('position','content')->delPosContent($key);
				}
			}
			else
			{
				$ids = M('ev')->get('ids');
				foreach($ids as $key => $id)
				{
					M('position','content')->modifyPosContent($key,array('pcsequence' => $id));
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
		$page = M('ev')->get('page');
		$poses = M('position','content')->getPosList();
		M('tpl')->assign('poses',$poses);
		M('tpl')->display('positions');
	}
}


?>
