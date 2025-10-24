<?php

namespace PHPEMS;

class tpl
{

	public $tpl_var = array();
	private $isCache = 1;
	private $cacheTime = 300;
	
	public $dir;
	public $cacheDir;
	public $key = '356d9abc2532ceb0945b615a922c3370';
	public $iv = '#phpems90iv*';

	public function __construct()
	{
		$this->dir = \PHPEMS\ginkgo::$app.'/tpls/'.\PHPEMS\ginkgo::$module.'/';
	}

	public function setDir($app = 'core',$module = 'app')
    {
        $this->dir = $app.'/tpls/'.$module.'/';
    }

	//设置缓存事件
	public function setCacheTime($time = false)
	{
		if($time)$this->cacheTime = $time;
		else $this->isCache = 0;
	}

	//赋值变量
	public function assign($target,$vars)
	{
		if(is_array($vars))
		{
			foreach($vars as $key => $cnt)
				$this->tpl_var[$target][$key] = $vars[$key];
		}
		else
		{
			$this->tpl_var[$target] = $vars;
		}
	}

	//初始化模板文件地址
	public function initFile()
	{
		M('files')->mdir('data/html/'.$this->dir);
		M('files')->mdir('data/compile/'.$this->dir);
	}

	//读取模板
	public function readTpl($file)
	{
		if(file_exists($file))return M('files')->readFile($file);
		else
			die('The template not fount which name is '.$file);
	}

	//判断字符值是否存在，并返回指定类型的值
	public function reBool($str,$bool = 0)
	{
		if($str)return intval($str);
		elseif($bool) return 1;
		else return 0;
	}

	//执行块
	public function exeBlock($id)
	{
		M('api','content')->parseBlock($id);
	}

	//判断是否缓存
	public function isCached($file,$par = NULL,$cachename = NULL)
	{
		$source = 'app/'.$this->dir.$file.'.tpl';
		$outfile = 'data/compile/'.$this->dir.'%%cpl%%'.$file.'.php';
		if($cachename)$outcache = 'data/html/'.$this->dir.$cachename.'.html';
		else
			$outcache = 'data/html/'.$this->dir.$file.$par.'.html';
		if(file_exists($outcache) && $this->isCache)
		{
			if(((time()-filemtime($outcache))<= $this->cacheTime) && (filemtime($outfile) > filemtime($source)))
			{
				echo M('files')->readFile($outcache);
				return true;
			}
		}
		return false;
	}

	public function isSimpleCached($cachename = NULL)
	{
		if($cachename)$outcache = 'data/html/'.$this->dir.$cachename.'.html';
		else
			return false;
		if(file_exists($outcache) && $this->isCache)
		{
			if((time()-filemtime($outcache))<= $this->cacheTime)
			{
				echo M('files')->readFile($outcache);
				return true;
			}
		}
		return false;
	}

	//编译模板
	public function compileTpl($source)
	{
		$content = $this->readTpl($source);
		$this->compileSeminar($content);
		$this->compileBlock($content);
		$this->compileTree($content);
		$this->compileLoop($content);
		$this->compileEval($content);
		$this->compileIf($content);
		$this->compileInclude($content);
		$this->compileArray($content);
		$this->compileDate($content);
		$this->compileRealSubstring($content);
		$this->compileSubstring($content);
		$this->compileRealVar($content);
		$this->compileEnter($content);
		$this->compileConst($content);
		return $content;
	}

	public function compileContentTpl($content)
	{
		$this->compileSeminar($content);
		$this->compileBlock($content);
		$this->compileTree($content);
		$this->compileLoop($content);
		$this->compileEval($content);
		$this->compileIf($content);
		$this->compileInclude($content);
		$this->compileArray($content);
		$this->compileDate($content);
		$this->compileRealSubstring($content);
		$this->compileSubstring($content);
		$this->compileRealVar($content);
		$this->compileEnter($content);
		$this->compileConst($content);
		return $content;
	}

	public function compileInclude(&$content)
	{
		$limit = '/{x2;include:(\w+)}/';
		$content = preg_replace_callback($limit,function($matches){
			return "<?php \$this->_compileInclude('{$matches[1]}'); ?>";
		},$content);
	}

	public function _compileInclude($file)
	{
		if($file)$this->fetch($file,NULL,0);
		if($this->isCache)include 'data/compile/'.$this->dir.'/%%cpl%%'.$file.'.php';
	}

	public function compileRealVar(&$content)
	{
		$limit = '/{x2;realhtml:([^}]+)}/';
		$content = preg_replace_callback($limit,function($matches){
			return "<?php echo html_entity_decode(\\PHPEMS\\M('ev')->stripSlashes(".$this->_compileArray($matches[1]).")); ?>";
		},$content);
	}

	public function compileVar(&$content)
	{
		$limit = '/{x2;\$(\w+)}/';
		$content = preg_replace_callback($limit,function($matches){
			return "<?php echo \$this->tpl_var['{$matches[1]}']; ?>";
		},$content);
	}

	public function _compileVar($str)
	{
		$limit = '/\$([\w|\']+)/';
		$str = preg_replace_callback($limit,function($matches){
			return "\$this->tpl_var['{$matches[1]}']";
		},$str);
		return $str;
	}

	public function compileTvar(&$content)
	{
		$limit = '/{x2;v:([\w|\']+)}/';
		$content = preg_replace_callback($limit,function($matches){
			return "<?php echo \${$matches[1]}; ?>";
		},$content);
	}

	public function _compileTvar($str)
	{
		$limit = '/v:([\w|\']+)/';
		$str = preg_replace_callback($limit,function($matches){
			return "\${$matches[1]}";
		},$str);
		return $str;
	}

	public function compileConst(&$content)
	{
		$limit = '/{x2;c:(\w+)}/';
		$content = preg_replace_callback($limit,function($matches){
			return "<?php echo {$matches[1]}; ?>";
		},$content);
	}

	public function compileArray(&$content)
	{
		$limit = '/{x2;([\$|v][\$|:|\[|\w|\]|\s|\']+)}/';
		$content = preg_replace_callback($limit,function($matches){
			return "<?php echo ".$this->_compileArray($matches[1])."; ?>";
		},$content);
	}

	public function _compileArray($str)
	{
		$str = $this->_compileVar($str);
		$str = $this->_compileTvar($str);
		return $str;
	}

	public function compileDate(&$content)
	{
		$limit = '/{x2;date:([^,]+),([^}]+)}/';
		$content = preg_replace_callback($limit,function($matches){
			return "<?php echo date({$matches[2]},".$this->_compileArray($matches[1])."); ?>";
		},$content);
	}

	public function compileSubstring(&$content)
	{
		$limit = '/{x2;substring:([^,]+),([^}]+)}/';
		$content = preg_replace_callback($limit,function($matches){
			return "<?php echo \\PHPEMS\\M('strings')->subString(".$this->_compileArray($matches[1]).",$matches[2]); ?>";
		},$content);
	}

	public function compileRealSubstring(&$content)
	{
		$limit = '/{x2;realsubstring:([^,]+),([^}]+)}/';
		$content = preg_replace_callback($limit,function($matches){
			return "<?php echo \\PHPEMS\\M('strings')->subString(strip_tags(html_entity_decode(\\PHPEMS\\M('ev')->stripSlashes(".$this->_compileArray($matches[1])."))),$matches[2]); ?>";
		},$content);
	}

	public function compileEval(&$content)
	{
		$limit = '/{x2;eval:([^}]+)}/';
		$content = preg_replace_callback($limit,function($matches){
			return "<?php ".$this->_compileArray(M('ev')->stripSlashes($matches[1]))."; ?>";
		},$content);
	}

	public function compileIf(&$content)
	{
		$limit = '/{x2;if:([^}]+)}/';
		$content = preg_replace_callback($limit,function($matches){
			return "<?php if(".$this->_compileArray($matches[1])."){ ?>";
		},$content);

		$limit = '/{x2;elseif:([^}]+)}/';
		$content = preg_replace_callback($limit,function($matches){
			return "<?php } elseif(".$this->_compileArray($matches[1])."){ ?>";
		},$content);

		$limit = '/{x2;else}/';
		$replace = "<?php } else { ?>";
		$content = preg_replace($limit,$replace,$content);

		$limit = '/{x2;endif}/';
		$replace = "<?php } ?>";
		$content = preg_replace($limit,$replace,$content);
	}

	public function compileLoop(&$content)
	{
		$limit = '/{x2;loop:([^,]+),(\w+),*(\d*),*(\d*),*(\d*)}/';
		$content = preg_replace_callback($limit,function($matches){
			return "<?php \n\$".$matches[2]."All = count(".$this->_compileArray($matches[1]).");\nfor(\${$matches[2]}= ".$this->reBool($matches[3]).";\${$matches[2]}< \${$matches[2]}All;\${$matches[2]}+=".$this->reBool($matches[5],1).")\n{\nif(".$this->reBool($matches[4])." && \${$matches[2]}>=".$this->reBool($matches[4]).")break;\n?>";
		},$content);

		$limit = '/{x2;endloop}/';
		$content = preg_replace_callback($limit,function($matches){
			return "<?php } ?>";
		},$content);
	}

	public function compileTree(&$content)
	{
		$limit = '/{x2;tree:([^,]+),(\w+),(\w+)}/';
		$content = preg_replace_callback($limit,function($matches){
			return "<?php \${$matches[3]} = 0;\n foreach(".$this->_compileArray($matches[1])." as \$key => \${$matches[2]}){ \n \${$matches[3]}++; ?>";
		},$content);

		$limit = '/{x2;endtree}/';
		$content = preg_replace_callback($limit,function($matches){
			return "<?php } ?>";
		},$content);
	}

	public function compileBlock(&$content)
	{
		$limit = '/{x2;block:(\d+)}/';
		$content = preg_replace_callback($limit,function($matches){
			return "<?php echo \$this->exeBlock('{$matches[1]}'); ?>\n";
		},$content);
	}

	public function compileSeminar(&$content)
	{
		$limit = '/{x2;seminar:(\d+)}/';
		$content = preg_replace_callback($limit,function($matches){
			return "<?php \$data = M('api','seminar')->parseSeminar('{$matches[1]}'); ?>'\n";
		},$content);
	}

	public function compileEnter(&$content)
	{
		$limit = '/{x2;enter}/';
		$content = preg_replace_callback($limit,function($matches){
			return "<?php echo \"\n\"; ?>\n";
		},$content);
	}

	public function compileCode(&$content)
	{
		$limit = '/{x2;code:(.+)}/e';
		$replace = "'<?php '.'\$this->_compileArray('\${1}').'; ?>'\n";
		$content = preg_replace($limit,$replace,$content);
	}

	//解析模板
	public function fetch($file,$par='',$type = 0,$cachename = NULL)
	{
		$this->initFile();
		$source = 'app/'.$this->dir.$file.'.tpl';
		$outfile = 'data/compile/'.$this->dir.'%%cpl%%'.$file.'.php';
		if($cachename)$outcache = 'data/html/'.$this->dir.$cachename.'.html';
		else
			$outcache = 'data/html/'.$this->dir.$file.$par.'.html';
		if((!file_exists($outfile)) || (filemtime($outfile) < filemtime($source)))
		{
			$content = $this->compileTpl($source);
			M('files')->writeFile($outfile,$content);
			if($type)
			{
				include $outfile;
				M('files')->delFile($outcache);
			}
		}
		else
		{
			if($this->isCache && (!file_exists($outcache) || (time() - filemtime($outcache)) > $this->cacheTime))
			{
				if($type)
				{
					ob_start();
					include $outfile;
					$cachecontent = ob_get_contents();
					ob_flush();
					M('files')->writeFile($outcache,$cachecontent);
					ob_clean();
				}
			}
			else
			{
				include $outfile;
			}
		}
	}

	public function fetchContent($content)
	{
		return $this->compileContentTpl($content);
	}

	public function fetchExeCnt($file)
	{
		$source = 'app/'.$this->dir.$file.'.tpl';
		$content = $this->compileTpl($source);
		ob_start();
		eval(' ?>'.$content.'<?php ');
		$cachecontent = ob_get_contents();
		ob_clean();
		return $cachecontent;
	}

	public function fetchExeSource($source)
	{
		$source = $this->compileContentTpl($source);
		ob_start();
		eval(' ?>'.$source.'<?php ');
		$cachecontent = ob_get_contents();
		ob_clean();
		return $cachecontent;
	}

	//展示模板
	public function display($file,$par=NULL,$cachename = NULL)
	{
		if(M('ev')->isApp())
		{
			$message = array(
				"statusCode" => 200,
				"encrypt" => 'yes',
				"data" => openssl_encrypt(json_encode($this->tpl_var),'DES-ECB',$this->key,0,$this->iv)
			);
			\PHPEMS\ginkgo::R($message);
		}
		else
		{
			$this->fetch($file,$par,1,$cachename);
		}
	}
}

?>