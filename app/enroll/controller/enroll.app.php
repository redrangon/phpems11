<?php
/*
 * Created on 2016-5-19
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
namespace PHPEMS;
class action extends app
{
	public function display()
	{
        $this->search = $this->ev->get('search');
        if($this->search)
        {
            $this->u = '';
            $this->tpl->assign('search',$this->search);
            foreach($this->search as $key => $arg)
            {
                $this->u .= "&search[{$key}]={$arg}";
            }
            $this->tpl->assign('u',$this->u);
        }
	    $this->enroll = M('enroll','enroll');
        $this->order = M('orders','bank');
        $this->module = M('module');
        $this->html = M('html');
		$action = $this->ev->url(3);
		if(!method_exists($this,$action))
		$action = "index";
		$this->$action();
		exit;
	}

    public function detail()
    {
        $enrollid = $this->ev->get('enrollid');
        $enroll = $this->enroll->getEnrollById($enrollid);
        $enbat = $this->enroll->getEnrollBatById($enroll['enrollbatid']);
        $args = array();
        $args[] = array("AND","enbstarttime <= :stime","stime",TIME);
        $args[] = array("AND","enbendtime >= :etime","etime",TIME);
        $enbats = $this->enroll->getEnrollBatsList($args,1,10);
		$fields = $this->module->getMoudleFields($enbat['enbmoduleid'],1);
		$forms = $this->html->buildInfo($fields,$enroll);
		$this->tpl->assign('forms',$forms);
        $this->tpl->assign("enroll",$enroll);
        $this->tpl->assign("enbat",$enbat);
        $this->tpl->assign("enbats",$enbats);
        $this->tpl->display('enroll_detail');
    }

    public function modify()
    {
        $enrollid = $this->ev->get('enrollid');
        $enroll = $this->enroll->getEnrollById($enrollid);
        $enbat = $this->enroll->getEnrollBatById($enroll['enrollbatid']);
        if($this->ev->get('submit'))
        {
            $args = $this->ev->get('args');
            $args['enrollverify'] = 1;
            $this->enroll->modifyEnroll($enrollid,$args);
            $message = array(
                'statusCode' => 200,
                "message" => "操作成功",
                "callbackType" => "forward",
                "forwardUrl" => "index.php?enroll-app-enroll&enbid=".$enbat['enbid']
            );
            ginkgo::R($message);
        }
        else
        {
            $fields = $this->module->getMoudleFields($enbat['enbmoduleid'],1);
            $forms = $this->html->buildHtml($fields,$enroll);
            $this->tpl->assign('forms',$forms);
            $this->tpl->assign('enroll',$enroll);
            $this->tpl->assign('enbat',$enbat);
            $this->tpl->display('enroll_modify');
        }
    }

    public function add()
    {
        $enbid = $this->ev->get('enbid');
        $enbat = $this->enroll->getEnrollBatById($enbid);
        $args = array(
            array("AND","enrolluserid = :enrolluserid","enrolluserid",$this->_user['sessionuserid']),
            array("AND","enrollbatid = :enrollbatid","enrollbatid",$enbid)
        );
        $enroll = $this->enroll->getEnrollByArgs($args);
        if($enroll['enrollid'])
        {
            $message = array(
                'statusCode' => 200,
                "callbackType" => "forward",
                "forwardUrl" => "index.php?enroll-app-enroll&enbid=".$enbat['enbid']
            );
            ginkgo::R($message);
        }
        if(($enbat['enbstarttime'] > TIME) || ($enbat['enbendtime'] < TIME))
        {
            $message = array(
                'statusCode' => 300,
                "callbackType" => "forward",
                "message" => "未在报名时间内",
                "forwardUrl" => "index.php?enroll-app"
            );
            ginkgo::R($message);
        }
        if($this->ev->get('submit'))
        {
            $args = $this->ev->get('args');
            $args['enrollbatid'] = $enbid;
            $args['enrolluserid'] = $this->_user['sessionuserid'];
            $args['enrolltime'] = TIME;
            $args['enrollverify'] = 1;
            $enrollid = $this->enroll->addEnroll($args);
            $message = array(
                'statusCode' => 200,
                "message" => "操作成功",
                "callbackType" => "forward",
                "forwardUrl" => "index.php?enroll-app-enroll&enbid=".$enbat['enbid']
            );
            ginkgo::R($message);
        }
        else
        {
            $fields = $this->module->getMoudleFields($enbat['enbmoduleid'],1);
            $forms = $this->html->buildHtml($fields);
            $this->tpl->assign('forms',$forms);
            $this->tpl->assign('enbat',$enbat);
            $this->tpl->display('enroll_add');
        }
    }

    public function search()
    {
        $search = $this->ev->get('search');
        $args = array();
        if($search['keyword'])$args[] = array("AND","enbname LIKE :enbname",'enbname',"%{$search['keyword']}%");
        $enbats = $this->enroll->getEnrollBatsList($args,1,10);
        $this->tpl->assign("enbats",$enbats);
        $this->tpl->assign("search",$search);
        $this->tpl->display('search');
    }

    public function index()
    {
        $page = $this->ev->get('page');
        $enbid = $this->ev->get('enbid');
        $enbat = $this->enroll->getEnrollBatById($enbid);
        $args = array(
            array("AND","enrolluserid = :enrolluserid","enrolluserid",$this->_user['sessionuserid']),
            array("AND","enrollbatid = :enrollbatid","enrollbatid",$enbid)
        );
        $enroll = $this->enroll->getEnrollByArgs($args);
        $args = array();
        //$args[] = array("AND","enbstarttime <= :stime","stime",TIME);
        //$args[] = array("AND","enbendtime >= :etime","etime",TIME);
        $enbats = $this->enroll->getEnrollBatsList($args,$page,9);
        $this->tpl->assign("enroll",$enroll);
        $this->tpl->assign("enbat",$enbat);
        $this->tpl->assign("enbats",$enbats);
        $this->tpl->display('enroll');
    }
}


?>
