<?php
namespace PHPEMS\content;
use function \PHPEMS\M;
class api
{
	public $db;
	public $block;

	public function __construct()
	{
		$this->db = M('pepdo');
		$this->block = M('block','content');
	}

	public function parseBlock($blockid)
	{
		$block = $this->block->getBlockById($blockid);
		echo html_entity_decode($block['blockcontent']['content']);
	}
}

?>
