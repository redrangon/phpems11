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
        $this->_user = $this->session->getSessionUser();
        if(!$this->user['userid'])
        {
            if(M('ev')->get('userhash'))
                exit(json_encode(array(
                    'statusCode' => 301,
                    "message" => "请您重新登录",
                    "callbackType" => 'forward',
                    "forwardUrl" => "index.php?user-app-login"
                )));
            else
            {
                header("location:index.php?user-app-login");
                exit;
            }
        }
		$action = M('ev')->url(3);
		if(!method_exists($this,$action))
		$action = "index";
		$this->$action();
		exit;
	}

    private function history()
	{
        $docid = M('ev')->get('docid');
        $page = M('ev')->get('page');
        $doc = M('doc','docs')->getDocById($docid,false);
        $args = array();
        $args[] = array("AND","dhdocid = :dhdocid","dhdocid",$docid);
        $args[] = array("AND","dhusername = :dhusername","dhusername",$this->_user['sessionusername']);
        $histories = M('doc','docs')->getDocHistoryListByArgs($args,$page);
        M('tpl')->assign('doc',$doc);
        M('tpl')->assign('histories',$histories);
		M('tpl')->display('mydoc_history');
	}

    private function edit()
	{
        $docid = M('ev')->get('docid');
        $args = array();
        $args[] = array("AND","dhstatus = 0");
        $args[] = array("AND","dhdocid = :dhdocid","dhdocid",$docid);
        $args[] = array("AND","dhusername = :dhusername","dhusername",$this->_user['sessionusername']);
        $history = M('doc','docs')->getDocHistoryByArgs($args);
        if(M('ev')->get('submit'))
		{
			$args = M('ev')->get('args');
			$args['dhcontent'] = M('safe')->tidyHtml($args['dhcontent']);
			if($history)
			{
				$args['dhtime'] = TIME;
                M('doc','docs')->modifyDocHistory($history['dhid'],$args);
			}
			else
			{
				$args['dhdocid'] = $docid;
                $args['dhtime'] = TIME;
                $args['dhusername'] = $this->_user['sessionusername'];
                M('doc','docs')->addDocHistory($args);
			}
            $message = array(
                'statusCode' => 200,
                "message" => "操作成功,请等待管理员审核",
                "callbackType" => "forward",
                "forwardUrl" => "index.php?docs-app-docs&docid={$docid}"
            );
            \PHPEMS\ginkgo::R($message);
		}
		else
		{
			if($history)
			{
				$doc = M('doc','docs')->getDocById($docid,false);
				$doc['content'] = $history;
			}
			else
			{
				$doc = M('doc','docs')->getDocById($docid);
				$doc['content']['dhtitle'] = '';
			}
			M('tpl')->assign('history',$history);
			M('tpl')->assign('doc',$doc);
			M('tpl')->display('mydoc_edit');
        }
    }

	private function index()
	{
		$docid = M('ev')->get('docid');
		$doc = M('doc','docs')->getDocById($docid);
		$catbread = M('category')->getCategoryPos($doc['doccatid']);
		$cat = M('category')->getCategoryById($doc['doccatid']);
		M('tpl')->assign('cat',$cat);
		M('tpl')->assign('catbread',$catbread);
		M('tpl')->assign('doc',$doc);
		M('tpl')->display('mydoc');
	}
}


?>
