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
		$fn = $this->ev->get('CKEditorFuncNum');
		$upfile = $this->ev->getFile('upload');
		$path = 'files/attach/files/content/'.date('Ymd').'/';
		$args = array();
		$args['attext'] = $this->files->getFileExtName($upfile['name']);
		if(!in_array(strtolower($args['attext']),$this->allowexts) || in_array(strtolower($args['attext']),$this->forbidden))
		{
			$message = '上传失败，附件类型不符!';
			$back = array(
				'error' => array(
					'number' => 105,
					'message' => $message
				)
			);
			exit(json_encode($back));
		}
		if($upfile)
		$fileurl = $this->files->uploadFile($upfile,$path,$args['attext'],NULL);
		if($fileurl)
		{
			$osspath = false;
			if(defined('OPENOSS') && OPENOSS)
			{
				$osspath = M('oss')->upload($fileurl);
				$osspath = str_ireplace(array('http://','https://'),'//',$osspath);
			}
			$message = '上传成功!';
			$args['attpath'] = $fileurl;
			$args['atttitle'] = $upfile['name'];
			$args['attsize'] = $upfile['size'];
			$args['attuserid'] = $this->_user['sessionuserid'];
			$args['attcntype'] = $upfile['type'];
			$this->attach->addAttach($args);
			$back = array(
				'fileName' => $upfile['name'],
				'url' => $fileurl,
				'uploaded' => 1
			);
		}
		else
		{
			$message = '上传失败，附件类型不符!';
			$back = array(
				'error' => array(
					'number' => 105,
					'message' => $message
				)
			);
		}
		exit(json_encode($back));
	}
}


?>
