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
		M('tpl')->assign('modules',M('module')->getModulesByApp('enroll'));
		$action = M('ev')->url(3);
		if(!method_exists($this,$action))
		$action = "index";
		$this->$action();
		exit;
	}

	public function bulk()
	{
		$enbid = M('ev')->get('enbid');
		$enbat = M('enroll','enroll')->getEnrollBatById($enbid);
		if(M('ev')->get('batopen'))
		{
			if(M('ev')->get('days') < 1)
			{
				$message = array(
					'statusCode' => 300,
					"message" => "开通时间不能少于1天"
				);
				ginkgo::R($message);
			}
			$items = M('ev')->get('items');
			$items = explode(',',$items);
			$time = M('ev')->get('days') * 3600 * 24;
			if($items)
			{
				$args = array();
				$args[] = array("AND","enrollbatid = :enrollbatid","enrollbatid",$enbid);
				if(M('ev')->get('opentype'))
				{
					$args[] = array("AND","enrollverify = 2");
				}
				$enrolls = M('enroll','enroll')->getEnrolls($args,'enrollid desc','enrolluserid');
				if(M('ev')->type == 'course')
				{
					foreach($items as $item)
					{
						foreach($enrolls as $enroll)
						{
							$args = array('ocuserid' => $enroll['enrolluserid'],'occourseid'=>$item, 'ocendtime' => TIME + $time);
							M('course','course')->openCourse($args);
						}
					}
				}
				elseif(M('ev')->type == 'exam')
				{
					foreach($items as $item)
					{
						foreach($enrolls as $enroll) {
							$args = array('obuserid' => $enroll['enrolluserid'], 'obbasicid' => $item, 'obendtime' => TIME + $time);
							M('basic', 'exam')->openBasic($args);
						}
					}
				}
				else
				{}
			}
			$message = array(
				'statusCode' => 200,
				"message" => "操作成功",
				"callbackType" => 'forward',
				"forwardUrl" => "reload"
			);
			ginkgo::R($message);
		}
		else
		{
			M('tpl')->assign('enbat',$enbat);
			M('tpl')->display('enroll_bulk');
		}
	}

	public function mlite()
	{
		switch (M('ev')->get('action'))
		{
			case 'delete':
				$delids = M('ev')->get('delids');
				foreach($delids as $id => $p)
				{
					$enroll = M('enroll','enroll')->getEnrollById($id);
					if(!$enroll['enrollverify'])
					{
						M('enroll','enroll')->delEnroll($id);
					}
				}
				break;

			case 'verify':
				$delids = M('ev')->get('delids');
				foreach($delids as $id => $p)
				{
					M('enroll','enroll')->modifyEnroll($id,array('enrollverify' => 2));
				}
				break;

			case 'unverify':
				$delids = M('ev')->get('delids');
				foreach($delids as $id => $p)
				{
					M('enroll','enroll')->modifyEnroll($id,array('enrollverify' => 1));
				}
				break;
			
			case 'passverify':
				$delids = M('ev')->get('delids');
				foreach($delids as $id => $p)
				{
					M('enroll','enroll')->modifyEnroll($id,array('enrollverify' => 0));
				}
				break;

			case 'offline':
				$this->order = M('orders','bank');
				$delids = M('ev')->get('delids');
				foreach($delids as $id => $p)
				{
					$enroll = M('enroll','enroll')->getEnrollById($id);
					if(!$enroll['enrollstatus'] && $enroll['enrollverify'])
					{
						$this->order->payforOrder($enroll['enrollordersn'],'handle');
						M('enroll','enroll')->modifyEnroll($id,array('enrollstatus' => 1));
					}
				}
				break;

			default:
				break;
		}
		$message = array(
			'statusCode' => 200,
			"message" => "操作成功",
			"callbackType" => 'forward',
			"forwardUrl" => "reload"
		);
		R($message);
	}

	public function delenroll()
	{
		$enrollid = M('ev')->get('enrollid');
		M('enroll','enroll')->delEnroll($enrollid);
		$message = array(
			'statusCode' => 200,
			"message" => "操作成功",
			"callbackType" => 'forward',
			"forwardUrl" => "reload"
		);
		ginkgo::R($message);
	}

	public function outmember()
	{
		$enbid = M('ev')->get('enbid');
		$enbat = M('enroll','enroll')->getEnrollBatById($enbid);
		$args = array();
		$args[] = array("AND","enrollbatid = :enrollbatid","enrollbatid",$enbid);
		if($this->search['enrolltruename'])$args[] = array("AND","enrolltruename = :enrolltruename","enrolltruename",$this->search['enrolltruename']);
		if($this->search['enrollpassport'])$args[] = array("AND","enrollpassport = :enrollpassport","enrollpassport",$this->search['enrollpassport']);
		if($this->search['enrollphone'])$args[] = array("AND","enrollphone = :enrollphone","enrollphone",$this->search['enrollphone']);
		$enrolls = M('enroll','enroll')->getEnrolls($args);
		$rs = array();
		$fields = M('module')->getMoudleFields($enbat['enbmoduleid'],1);
		$rt = array('报名批次','姓名','身份证号','手机号');
		$rtmp = array();
		foreach ($fields as $field)
		{
			$rtmp[] = $field['fieldtitle'];
		}
		$rs[] = array_merge($rt,$rtmp);
		foreach ($enrolls as $key => $enroll)
		{
			$r = array(
				(string) $enbat['enbname'],
				(string) $enroll['enrolltruename'],
				(string) $enroll['enrollpassport'],
				(string) $enroll['enrollphone']
			);
			$tmp = array();
			foreach ($fields as $field)
			{
				$tmp[] = (string) $enroll[$field['field']];
			}
			$rs[] = array_merge($r,$tmp);
		}
		$fname = 'data/enroll/'.TIME.'-'.$enbid.'-enroll.xlsx';
		M('files')->mdir(PEPATH.'/data/enroll/');
		if(M('xlsx')->putExcelContent(PEPATH.'/'.$fname,$rs))
		{
			$message = array(
				'statusCode' => 200,
				"message" => "导出成功，转入下载页面，如果浏览器没有相应，请<a href=\"{$fname}\">点此下载</a>",
				"callbackType" => 'forward',
				"forwardUrl" => "{$fname}"
			);
		}
		else
		{
			$message = array(
				'statusCode' => 300,
				"message" => "导出失败,请重试"
			);
		}
		ginkgo::R($message);
	}

	public function member()
	{
		$enbid = M('ev')->get('enbid');
		$page = intval(M('ev')->get('page'));
		$page = $page >=1?$page:1;
		$enbat = M('enroll','enroll')->getEnrollBatById($enbid);
		$args = array();
		$args[] = array("AND","enrollbatid = :enrollbatid","enrollbatid",$enbid);
		if($this->search['enrolltruename'])$args[] = array("AND","enrolltruename = :enrolltruename","enrolltruename",$this->search['enrolltruename']);
		if($this->search['enrollpassport'])$args[] = array("AND","enrollpassport = :enrollpassport","enrollpassport",$this->search['enrollpassport']);
		if($this->search['enrollphone'])$args[] = array("AND","enrollphone = :enrollphone","enrollphone",$this->search['enrollphone']);
		$enrolls = M('enroll','enroll')->getEnrollList($args,$page);
		M('tpl')->assign('enbat',$enbat);
		M('tpl')->assign('enrolls',$enrolls);
		M('tpl')->display('enroll_members');
	}

	public function lite()
	{
		switch (M('ev')->get('action'))
		{
			case 'delete':
				$delids = M('ev')->get('delids');
				foreach($delids as $id => $p)
				{
					M('enroll','enroll')->delEnrollBat($id);
				}
				break;

			default:
				break;
		}
		$message = array(
			'statusCode' => 200,
			"message" => "操作成功",
			"callbackType" => 'forward',
			"forwardUrl" => "reload"
		);
		R($message);
	}

	public function del()
	{
		$enbid = M('ev')->get('enbid');
		M('enroll','enroll')->delEnrollBat($enbid);
		$message = array(
			'statusCode' => 200,
			"message" => "操作成功",
			"callbackType" => 'forward',
			"forwardUrl" => "reload"
		);
		ginkgo::R($message);
	}

	public function modify()
	{
		$enbid = M('ev')->get('enbid');
		$enbat = M('enroll','enroll')->getEnrollBatById($enbid);
		if(M('ev')->get('submit'))
		{
			$args = M('ev')->get('args');
			$args['enbstarttime'] = strtotime($args['enbstarttime']);
			$args['enbendtime'] = strtotime($args['enbendtime']);
			M('enroll','enroll')->modifyEnrollBat($enbid,$args);
			$message = array(
				'statusCode' => 200,
				"message" => "操作成功",
				"callbackType" => 'forward',
				"forwardUrl" => "index.php?enroll-master-enroll"
			);
			ginkgo::R($message);
		}
		else
		{
			M('tpl')->assign('enbat',$enbat);
			M('tpl')->display('enroll_modify');
		}
	}

	public function add()
	{
		if(M('ev')->get('submit'))
		{
			$args = M('ev')->get('args');
			$args['enbstarttime'] = strtotime($args['enbstarttime']);
			$args['enbendtime'] = strtotime($args['enbendtime']);
			$args['enbtime'] = TIME;
			M('enroll','enroll')->addEnrollBat($args);
			$message = array(
				'statusCode' => 200,
				"message" => "操作成功",
				"callbackType" => 'forward',
				"forwardUrl" => "index.php?enroll-master-enroll"
			);
			ginkgo::R($message);
		}
		else
		{
			M('tpl')->display('enroll_add');
		}
	}

	public function index()
	{
		$page = intval(M('ev')->get('page'));
		$page = $page >=1?$page:1;
		$args = array();
		if($this->search['enbid'])$args[] = array("AND","enbid = :enbid","enbid",$this->search['enbid']);
		if($this->search['keyword'])$args[] = array("AND","enbname like :enbname","enbname","%{$this->search['keyword']}%");
		if($this->search['stime'])$args[] = array("AND","enbstarttime >= :stime","stime",strtotime($this->search['stime']));
		if($this->search['etime'])$args[] = array("AND","enbstarttime <= :etime","etime",strtotime($this->search['etime']));
		$enbats = M('enroll','enroll')->getEnrollBatsList($args,$page);
		M('tpl')->assign('enbats',$enbats);
		M('tpl')->display('enroll');
	}
}


?>
