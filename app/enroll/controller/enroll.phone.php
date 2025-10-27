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
        $this->search = M('ev')->get('search');
        if($this->search)
        {
            $this->u = '';
            M('tpl')->assign('search',$this->search);
            foreach($this->search as $key => $arg)
            {
                $this->u .= "&search[{$key}]={$arg}";
            }
            M('tpl')->assign('u',$this->u);
        }
	    M('enroll','enroll') = M('enroll','enroll');
        $this->order = M('orders','bank');
        M('module') = M('module');
        M('html') = M('html');
		$action = M('ev')->url(3);
		if(!method_exists($this,$action))
		$action = "index";
		$this->$action();
		exit;
	}

    public function detail()
    {
        $enrollid = M('ev')->get('enrollid');
        $enroll = M('enroll','enroll')->getEnrollById($enrollid);
        $enbat = M('enroll','enroll')->getEnrollBatById($enroll['enrollbatid']);
        $args = array();
        $args[] = array("AND","enbstarttime <= :stime","stime",TIME);
        $args[] = array("AND","enbendtime >= :etime","etime",TIME);
        $enbats = M('enroll','enroll')->getEnrollBatsList($args,1,10);
		$fields = M('module')->getMoudleFields($enbat['enbmoduleid'],1);
		$forms = M('html')->buildInfo($fields,$enroll);
		M('tpl')->assign('forms',$forms);
        M('tpl')->assign("enroll",$enroll);
        M('tpl')->assign("enbat",$enbat);
        M('tpl')->assign("enbats",$enbats);
        M('tpl')->display('enroll_detail');
    }

    public function modify()
    {
        $enrollid = M('ev')->get('enrollid');
        $enroll = M('enroll','enroll')->getEnrollById($enrollid);
        $enbat = M('enroll','enroll')->getEnrollBatById($enroll['enrollbatid']);
        if(M('ev')->get('submit'))
        {
            $args = M('ev')->get('args');
            $args['enrollverify'] = 1;
            M('enroll','enroll')->modifyEnroll($enrollid,$args);
            $message = array(
                'statusCode' => 200,
                "message" => "操作成功",
                "callbackType" => "forward",
                "forwardUrl" => "index.php?enroll-phone-enroll&enbid=".$enbat['enbid']
            );
            ginkgo::R($message);
        }
        else
        {
            $fields = M('module')->getMoudleFields($enbat['enbmoduleid'],1);
            $forms = M('html')->buildHtml($fields,$enroll);
            M('tpl')->assign('forms',$forms);
            M('tpl')->assign('enroll',$enroll);
            M('tpl')->assign('enbat',$enbat);
            M('tpl')->display('enroll_modify');
        }
    }

    public function add()
    {
        $enbid = M('ev')->get('enbid');
        $enbat = M('enroll','enroll')->getEnrollBatById($enbid);
        $args = array(
            array("AND","enrolluserid = :enrolluserid","enrolluserid",$this->user['userid']),
            array("AND","enrollbatid = :enrollbatid","enrollbatid",$enbid)
        );
        $enroll = M('enroll','enroll')->getEnrollByArgs($args);
        if($enroll['enrollid'])
        {
            $message = array(
                'statusCode' => 200,
                "callbackType" => "forward",
                "forwardUrl" => "index.php?enroll-phone-enroll&enbid=".$enbat['enbid']
            );
            ginkgo::R($message);
        }
        if(($enbat['enbstarttime'] > TIME) || ($enbat['enbendtime'] < TIME))
        {
            $message = array(
                'statusCode' => 300,
                "callbackType" => "forward",
                "message" => "未在报名时间内",
                "forwardUrl" => "index.php?enroll-phone"
            );
            ginkgo::R($message);
        }
        if(M('ev')->get('submit'))
        {
            $args = M('ev')->get('args');
            $args['enrollbatid'] = $enbid;
            $args['enrolluserid'] = $this->user['userid'];
            $args['enrolltime'] = TIME;
            $args['enrollverify'] = 1;
            $enrollid = M('enroll','enroll')->addEnroll($args);
            $message = array(
                'statusCode' => 200,
                "message" => "操作成功",
                "callbackType" => "forward",
                "forwardUrl" => "index.php?enroll-phone-enroll&enbid=".$enbat['enbid']
            );
            ginkgo::R($message);
        }
        else
        {
            $fields = M('module')->getMoudleFields($enbat['enbmoduleid'],1);
            $forms = M('html')->buildHtml($fields);
            M('tpl')->assign('forms',$forms);
            M('tpl')->assign('enbat',$enbat);
            M('tpl')->display('enroll_add');
        }
    }

    public function index()
    {
        $enbid = M('ev')->get('enbid');
        $enbat = M('enroll','enroll')->getEnrollBatById($enbid);
        $args = array(
            array("AND","enrolluserid = :enrolluserid","enrolluserid",$this->user['userid']),
            array("AND","enrollbatid = :enrollbatid","enrollbatid",$enbid)
        );
        $enroll = M('enroll','enroll')->getEnrollByArgs($args);
        $args = array();
        //$args[] = array("AND","enbstarttime <= :stime","stime",TIME);
        //$args[] = array("AND","enbendtime >= :etime","etime",TIME);
        $enbats = M('enroll','enroll')->getEnrollBatsList($args,1,10);
        M('tpl')->assign("enroll",$enroll);
        M('tpl')->assign("enbat",$enbat);
        M('tpl')->assign("enbats",$enbats);
        M('tpl')->display('enroll');
    }
}


?>
