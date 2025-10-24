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
		$action = $this->ev->url(3);
		if(!method_exists($this,$action))
		$action = "index";
		$this->$action();
		exit;
	}

	public function index()
	{
		$args = array();
		$path = 'files/attach/images/content/'.date('Ymd').'/';
		$upfile = $this->ev->getFile('qqfile');
		$args['attext'] = $this->files->getFileExtName($upfile['name']);
		if(!in_array(strtolower($args['attext']),$this->allowexts) || in_array(strtolower($args['attext']),$this->forbidden))
		exit(json_encode(array('status' => 'fail','message' => '上传失败，附件类型不符!')));
		if($upfile)
		$fileurl = $this->files->uploadFile($upfile,$path,NULL,NULL,$this->allowexts);
		if($fileurl)
		{
			$osspath = false;
			if(defined('OPENOSS') && OPENOSS)
			{
				$osspath = M('oss')->upload($fileurl);
				$osspath = str_ireplace(array('http://','https://'),'//',$osspath);
			}
			$args['attpath'] = $fileurl;
			$args['atttitle'] = $upfile['name'];

			$args['attsize'] = $upfile['size'];
			$args['attuserid'] = $this->_user['sessionuserid'];
			//$args['attcntype'] = $upfile['type'];
			$this->attach->addAttach($args);
			if($this->ev->get('imgwidth') || $this->ev->get('imgheight'))
			{
				if($this->files->thumb($fileurl,$fileurl.'.png',$this->ev->get('imgwidth'),$this->ev->get('imgheight')))
				$thumb = $fileurl.'.png';
				else
				$thumb = $fileurl;
			}
			else
			$thumb = $fileurl;
			if($osspath)
			exit(json_encode(array('success' => true,'thumb' => $osspath,'title' => $upfile['name'])));
			else
			exit(json_encode(array('success' => true,'thumb' => $thumb,'title' => $upfile['name'])));
		}
		else
		{
			exit(json_encode(array('status' => 'fail')));
		}
	}
}


?>
