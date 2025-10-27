<?php
namespace PHPEMS\content;
use function \PHPEMS\M;
class api
{
	public function parseBlock($blockid)
	{
		$block = M('block','content')->getBlockById($blockid);
		echo html_entity_decode($block['blockcontent']['content']);
	}
}

?>
