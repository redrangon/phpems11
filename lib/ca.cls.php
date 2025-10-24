<?php
namespace PHPEMS;

class ca
{
	public $path = 'data/cache/';

    public function readCache($cache,$dir = 'system')
    {
		$f = $this->path.$dir.'/'.$cache.'.cache';
    	if(file_exists($f))return unserialize(M('files')->readFile($f));
    	else return false;
    }

    public function writeCache($cache,$content,$dir = 'system')
    {
    	if(is_dir($this->path.$dir))M('files')->mdir($this->path.$dir);
		$f = $this->path.$dir.'/'.$cache.'.cache';
		return M('files')->writeFile($f,serialize($content));
    }

	public function isTimeOut($cache,$time = 300,$dir = 'system')
	{
		if(!$time)return true;
		$f = $this->path.$dir.'/'.$cache.'.cache';
		if((!file_exists($f)) || (time() - filemtime($f) > $time))return true;
		else return false;
	}

	public function removeCache($cache,$dir = 'system')
	{
		$f = $this->path.$dir.'/'.$cache.'.cache';
		if((file_exists($f)))unlink($f);
	}

	public function removeCacheByDir($dir = 'system')
	{
		M('files')->delDir( $this->path.$dir.'/');
		return true;
	}
}
?>