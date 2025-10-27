<?php
 namespace PHPEMS;
/*
 * Created on 2014-12-10
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 class pepdo
 {
 	private $queryid = 0;
	private $linkid = 0;
	private $log = SQLDEBUG;
	private $tablepre = DTH;
	private $mostlimits = 512;
	public $affectedRows;

	public function createTable($table,$fields,$indexs = false)
	{
		$sql = "CREATE TABLE IF NOT EXISTS `".$this->tablepre."{$table}` (";
		foreach($fields as $field)
		{
			$sql .= "\n`{$field['name']}` ";
			if($field['type'])
			{
				$sql .= "{$field['type']} ";
			}
			if($field['length'])
			{
				$sql .= "( {$field['length']} ) ";
			}
			if($field['fieldtype'] == 'VARCHAR' || $field['fieldtype'] == 'TEXT')
			{
				$sql .= "CHARACTER SET {$field['charset']} COLLATE utf8_general_ci ";
			}
			$sql .= "NOT NULL ";
			if($field['auto'])
			{
				$sql .= 'AUTO_INCREMENT ';
			}
			if($field['comment'])
			{
				$sql .= "COMMENT '{$field['comment']}' ";
			}
			$sql .= ",";
		}
		if($indexs)
		{
			foreach($indexs as $index)
			{
				$sql .= "\n";
				$sql .= $index['type']."( `{$index['field']}` ) ";
				$sql .= ",";
			}
		}
		$sql = trim($sql,", ");
		$sql .= "\n)";
		return $sql;
	}

	//清空表内数据
	public function clearTableData($table)
	{
		if(is_array($table))
		{
			$tsql = "TRUNCATE TABLE ";
			foreach($table as $t)
			{
			$tsql .= "`$this->tablepre`.`$t`,";
			}
			return trim($tsql,",");
		}
		else
		{
			return "TRUNCATE TABLE `{$table}`";
		}
	}

	//删除表
	public function delTable($table)
	{
		if(is_array($table))
		{
			$tsql = "TRUNCATE TABLE ";
			foreach($table as $t)
			{
				$tsql .= "`$this->tablepre`.`$t`,";
			}
			return trim($tsql,",");
		}
		else
		{
			return "DROP TABLE `{$table}`";
		}
	}

	//修改字段
	public function modifyField($field,$table)
	{
		if($table)
		{
			if(is_array($field))
			{
				$sql = "ALTER TABLE `".$this->tablepre."{$table}` ";
				if($field['field'])
				{
					$sql .= "CHANGE `{$field['field']}` `{$field['field']}`";
					if($field['fieldtype'])
					{
						$sql .= "{$field['fieldtype']} ";
					}
					if($field['fieldlength'])
					{
					$sql .= "( {$field['fieldlength']} )";
					}
					else
					{
					if($field['fieldtype'] == 'VARCHAR')$sql .= "( 120 )";
					elseif($field['fieldtype'] == 'DECIMAL')$sql .= "( 10,2 )";
					}
					if(strtoupper($field['fieldtype']) == 'VARCHAR' || strtoupper($field['fieldtype']) == 'TEXT')
					{
					if($field['fieldcharset'] == 'gbk')
					$sql .= "CHARACTER SET {$field['fieldcharset']} COLLATE gbk_chinese_ci ";
					else
					$sql .= "CHARACTER SET {$field['fieldcharset']} COLLATE utf8_general_ci ";
					}
					$sql .= "NOT NULL ";

					if($field['fieldindextype'])
					{
					$sql .= ", ADD {$field['fieldindextype']} ( `{$field['field']}` ) ";
					}

					return $sql;
				}
				else return false;
			}
			else return false;
		}
		else return false;
	}

	//添加字段
	public function addField($field,$table)
	{
		if($table)
		{
			if(is_array($field))
			{
				$sql = "ALTER TABLE `".$this->tablepre."{$table}` ";
				if($field['field'])
				{
					$sql .= "ADD `{$field['field']}` ";
					$field['fieldtype'] = strtoupper($field['fieldtype']);
					if($field['fieldtype'])
					{
						$sql .= "{$field['fieldtype']} ";
					}
					if($field['fieldlength'])
					{
						$sql .= "( {$field['fieldlength']} )";
					}
					else
					{
						if($field['fieldtype'] == 'VARCHAR')$sql .= "( 120 )";
						elseif($field['fieldtype'] == 'DECIMAL')$sql .= "( 10,2 )";
					}
					if($field['fieldtype'] == 'VARCHAR' || $field['fieldtype'] == 'TEXT')
					{
						$sql .= "CHARACTER SET {$field['fieldcharset']} COLLATE utf8_general_ci ";
					}
					$sql .= "NOT NULL ";
					if($field['fieldindextype'])
					{
						$sql .= ", ADD {$field['fieldindextype']} ( `{$field['field']}` )";
					}
					return $sql;
				}
				else return false;
			}
			else return false;
		}
		else return false;
	}

	//删除字段
	public function delField($field,$table)
	{
		$sql = "ALTER TABLE `".$this->tablepre."{$table}` DROP `{$field}`";
		return array('sql' => $sql);
	}

	private function _makeDefaultInsertArgs($tables,$args = [])
	{
		$newargs = array();
		if(!is_array($tables))
		{
			$tables = array($tables);
		}
		foreach($tables as $table)
		{
			$sql = "SHOW FULL COLUMNS FROM  `".$this->tablepre.$table."`";
			$r = $this->fetchAll(array('sql' => $sql));
			foreach($r as $p)
			{
				if($p['Extra'] != 'auto_increment')
				{
					if($args[$p['Field']])$newargs[$p['Field']] = $args[$p['Field']];
					else
					{
						if(array_key_exists($p['Field'],$args))
						{
							$newargs[$p['Field']] = $this->_setDefaultInsetValue($p['Type']);
						}
						else
						{
							$newargs[$p['Field']] = $this->_setDefaultInsetValue($p['Type'],$p['Default']);
						}
					}
				}
			}
		}
		return $newargs;
	}

	private function _makeDefaultUpdateArgs($tables,$args)
	{
		$newargs = array();
		if(!is_array($tables))
		{
			$tables = array($tables);
		}
		foreach($tables as $table)
		{
			$sql = "SHOW FULL COLUMNS FROM  `".$this->tablepre.$table."`";
			$r = $this->fetchAll(array('sql' => $sql));
			foreach($r as $p)
			{
				if($p['Extra'] != 'auto_increment')
				{
					if(array_key_exists($p['Field'],$args))
					{
						if($args[$p['Field']])$newargs[$p['Field']] = $args[$p['Field']];
						else
						{
							$newargs[$p['Field']] = $this->_setDefaultInsetValue($p['Type']);
						}
					}
				}
			}
		}
		return $newargs;
	}

	private function _setDefaultInsetValue($type,$def = false)
	{
		$type = explode('(',$type);
		$type = $type[0];
		switch($type)
		{
			case 'char':
			case 'varchar':
			case 'tinytext':
			case 'longtext':
			case 'mediumtext':
			case 'text':
				if($def)return (string)$def;
				else return '';
				break;

			case 'int':
				if($def)return intval($def);
				else return 0;
				break;

			default:
				if($def)return floatval($def);
				else return 0;
				break;
		}
	}

	//生成select sql
	//$args = array('*',array('user','user_group'),array(array('AND','user.usergroupid = user_group.groupid'),array('AND','userid >= :userid','userid',$userid),array('OR','usergroupid >= :usergroupid','usergroupid',$usergroupid)));
	//$data = $this->makeSelect($args,$dbh);
	public function makeSelect($args, $rows = false)
	{
		$tb_pre = $this->tablepre;
		//if($args[0] === false)$args[0] = '*';
		if(!$args[0])$args[0] = '*';
		$db_fields = is_array($args[0])?implode(',',$args[0]):$args[0];
		$db_fields = $rows?'SQL_CALC_FOUND_ROWS '.$db_fields:$db_fields;
		$tables = $args[1];
		if(is_array($tables))
		{
			$db_tables = array();
			foreach($tables as $p)
			{
			$db_tables[] = "{$tb_pre}{$p} AS $p";
			}
			$db_tables = implode(',',$db_tables);
		}
		else
		{
			$db_tables = $tb_pre.$tables;
		}
		$query = $args[2];
		if(!is_array($query) || empty($query))$db_query = 1;
		else
		{
			$q = array();
			$v = array();
			foreach($query as $key => $p)
			{
				if(isset($p[2]))
				{
					if(is_array($p[3]))
					{
						$i = 0;
						$tkey = array();
						foreach($p[3] as $tp)
						{
							$tkey[] = ':'.$p[2].'_'.$i;
							$v[$p[2].'_'.$i] = $tp;
							$i++;
						}
						$p[1] = str_replace(':'.$p[2],implode(',',$tkey),$p[1]);
					}
					else
					{
						$v[$p[2]] = $p[3];
					}
				}
				if($key)
				{
					$q[] = $p[0].' '.$p[1].' ';
				}
				else
				{
					$q[] = $p[1].' ';
				}
			}
			$db_query = ' '.implode(' ',$q);
		}
		if(isset($args[3]))
		{
			$db_groups = is_array($args[3])?implode(',',$args[3]):$args[3];
		}
		else
		{
			$db_groups = '';
		}
		if(isset($args[4]))
		{
			$db_orders = is_array($args[4])?implode(',',$args[4]):$args[4];
		}
		else
		{
			$db_orders = '';
		}
		if(isset($args[5]))
		{
			$db_limits = is_array($args[5])?implode(',',$args[5]):$args[5];
		}
		else
		{
			$db_limits = '';
		}
		if($db_limits == false && $db_limits !== false)$db_limits = $this->mostlimits;
		$db_groups = $db_groups?' GROUP BY '.$db_groups:'';
		$db_orders = $db_orders?' ORDER BY '.$db_orders:'';
		if($db_limits === false)
		{
			$sql = 'SELECT '.$db_fields.' FROM '.$db_tables.' WHERE '.$db_query.$db_groups.$db_orders;
		}
		else
		{
			$sql = 'SELECT '.$db_fields.' FROM '.$db_tables.' WHERE '.$db_query.$db_groups.$db_orders.' LIMIT '.$db_limits;
		}
		return array('sql' => $sql, 'v' => isset($v)?$v:[]);
	}

	//生成update sql
	public function makeUpdate($args)
	{
		if(!is_array($args))return false;
		$tb_pre = $this->tablepre;
		$tables = $args[0];
		$args[1] = $this->_makeDefaultUpdateArgs($tables,$args[1]);
		if(is_array($tables))
		{
			$db_tables = array();
			foreach($tables as $p)
			{
				$db_tables[] = "{$tb_pre}{$p} AS $p";
			}
			$db_tables = implode(',',$db_tables);
		}
		else
		{
			$db_tables = $tb_pre.$tables;
		}
		$v = array();

		$pars = $args[1];
		if(!is_array($pars))return false;
		$parsql = array();
		foreach($pars as $key => $value)
		{
			$parsql[] = $key.' = '.':'.$key;
			if(is_array($value))$value = serialize($value);
			$v[$key] = $value;
		}
		$parsql = implode(',',$parsql);

		$query = $args[2];
		if(!is_array($query))$db_query = 1;
		else
		{
			$q = array();
			foreach($query as $p)
			{
				$q[] = $p[0].' '.$p[1].' ';
				if(isset($p[2]))
				{
					$v[$p[2]] = $p[3];
				}
			}
			$db_query = '1 '.implode(' ',$q);
		}
		if(isset($args[3]))
		{
			$db_groups = is_array($args[3])?implode(',',$args[3]):$args[3];
		}
		else
		{
			$db_groups = '';
		}
		if(isset($args[4]))
		{
			$db_orders = is_array($args[4])?implode(',',$args[4]):$args[4];
		}
		else
		{
			$db_orders = '';
		}
		if(isset($args[5]))
		{
			$db_limits = is_array($args[5])?implode(',',$args[5]):$args[5];
		}
		else
		{
			$db_limits = '';
		}
		if($db_limits == false && $db_limits !== false)$db_limits = $this->mostlimits;
		$db_groups = $db_groups?' GROUP BY '.$db_groups:'';
		$db_orders = $db_orders?' ORDER BY '.$db_orders:'';
		$sql = 'UPDATE '.$db_tables.' SET '.$parsql.' WHERE '.$db_query.$db_groups.$db_orders.' LIMIT '.$db_limits;
		return array('sql' => $sql, 'v' => $v);
	}

	//生成delete sql
	public function makeDelete($args)
	{
		if(!is_array($args))return false;
		$tb_pre = $this->tablepre;
		$tables = $args[0];
		if(is_array($tables))
		{
			$db_tables = array();
			foreach($tables as $p)
			{
				$db_tables[] = "{$tb_pre}{$p}";
			}
			$db_tables = implode(',',$db_tables);
		}
		else
		{
			$db_tables = $tb_pre.$tables;
		}
		$query = $args[1];
		if(!is_array($query))$db_query = 1;
		else
		{
			$q = array();
			$v = array();
			foreach($query as $p)
			{
				$q[] = $p[0].' '.$p[1].' ';
				if(isset($p[2]))
					$v[$p[2]] = $p[3];
			}
			$db_query = '1 '.implode(' ',$q);
		}
		if(isset($args[2]))
		{
			$db_groups = is_array($args[2])?implode(',',$args[2]):$args[2];
		}
		else
		{
			$db_groups = '';
		}
		if(isset($args[3]))
		{
			$db_orders = is_array($args[3])?implode(',',$args[3]):$args[3];
		}
		else
		{
			$db_orders = '';
		}
		if(isset($args[4]))
		{
			$db_limits = is_array($args[4])?implode(',',$args[4]):$args[4];
		}
		else
		{
			$db_limits = '';
		}
		if($db_limits)$db_limits = ' LIMIT '.$db_limits;
		//if($db_limits == false && $db_limits !== false)$db_limits = $this->mostlimits;
		$db_groups = $db_groups?' GROUP BY '.$db_groups:'';
		$db_orders = $db_orders?' ORDER BY '.$db_orders:'';
		if(is_array($tables))
		{
			$sql = 'DELETE '.$db_tables.' FROM '.$db_tables.' WHERE '.$db_query.$db_groups.$db_orders.$db_limits;
		}
		else
		{
			$sql = 'DELETE FROM '.$db_tables.' WHERE '.$db_query.$db_groups.$db_orders.$db_limits;
		}
		return array('sql' => $sql, 'v' => $v);
	}

	/**
	* 生成insert sql
	* $args = array('user',array('username' => 'ttt1','useremail' => 'ttt11@166.com','userpassword' => '122s5a1s4sdfs5as5ax4a5sd5s','usergroupid' => '8'));
	* $data = $this->makeInsert($args);
	*/

	public function makeInsert($args,$dim = 0,$tb_pre = NULL)
	{
		if($tb_pre === NULL)$tb_pre = $this->tablepre;
		else $tb_pre = '';
		$tables = $args[0];
		$args[1] = $this->_makeDefaultInsertArgs($tables,is_array($args[1])?$args[1]:array());
		if(is_array($tables))
		{
			$db_tables = array();
			foreach($tables as $p)
			{
				$db_tables[] = "{$tb_pre}{$p} AS $p";
			}
			$db_tables = implode(',',$db_tables);
		}
		else
			$db_tables = $tb_pre.$tables;
		$v = array();
		if($dim == 0)
		{
			$query = $args[1];

			foreach($args[1] as $key => $value)
			{
				if(is_array($value))
					$value = serialize($value);
				$v[$key] = $value;
			}
		}
		else
		{
			$query = current($args[1]);
			foreach($args[1] as $pkey => $p)
			{
				$tn = array();
				foreach($p as $key => $value)
				{
					if(is_array($value))
						$value = serialize($value);
					$tn[$key] = $value;
				}
				$v[] = $tn;
			}
		}
		if(!is_array($query))return false;
		$db_field = array();
		$db_value = array();
		foreach($query as $key => $value)
		{
			$db_field[] = $key;
			$db_value[] = ':'.$key;
		}
		$sql = 'INSERT INTO '.$db_tables.' ('.implode(',',$db_field).') VALUES ('.implode(',',$db_value).')';
		return array('sql' => $sql, 'v' => $v,'dim' => $dim);
	}

	private function _log($sql,$query)
	{
		if($this->log)
		{
			$fp = fopen(PEPATH.'/data/error.log','a');
			fputs($fp,print_r($sql,true).print_r($query->errorInfo(),true));
			fclose($fp);
		}
	}

	public function connect($host = DH,$dbuser = DU,$password = DP,$dbname = DB)
	{
		$dsn="mysql:host={$host};dbname={$dbname};";
		$this->linkid = new \PDO($dsn,$dbuser,$password);
		$this->linkid->query("set names utf8");
	}

	public function commit()
	{
		if(!$this->linkid)$this->connect();
		$this->linkid->commit();
	}

	public function beginTransaction()
	{
		if(!$this->linkid)$this->connect();
		$this->linkid->beginTransaction();
	}

	public function rollback()
	{
		if(!$this->linkid)$this->connect();
		$this->linkid->rollback();
	}

	public function fetchAll($sql,$index = false,$unserialize = false)
	{
		if(!is_array($sql))return false;
		if(!$this->linkid)$this->connect();
		$query = $this->linkid->prepare($sql['sql']);
		$rs = $query->execute($sql['v']);
		$this->_log($sql,$query);
		if ($rs) {
			$query->setFetchMode(\PDO::FETCH_ASSOC);
			//return $query->fetchAll();
			$r = array();
			while($tmp = $query->fetch())
			{
				if($unserialize)
				{
					if(is_array($unserialize))
					{
						foreach($unserialize as $value)
						{
							$tmp[$value] = unserialize($tmp[$value]);
						}
					}
					else $tmp[$unserialize] = unserialize($tmp[$unserialize]);
				}
				if($index)
				{
					$r[$tmp[$index]] = $tmp;
				}
				else
				$r[] = $tmp;
			}
			return $r;
		}
		else
		return false;
	}

	public function fetch($sql,$unserialize = false)
	{
		if(!is_array($sql))return false;
		if(!$this->linkid)$this->connect();
		$query = $this->linkid->prepare($sql['sql']);
		$rs = $query->execute($sql['v']);
		$this->_log($sql,$query);
		if ($rs) {
			$query->setFetchMode(\PDO::FETCH_ASSOC);
			$tmp = $query->fetch();
			if($tmp)
			{
				if($unserialize)
				{
					if(is_array($unserialize))
					{
						foreach($unserialize as $value)
						{
							$tmp[$value] = isset($tmp[$value])?unserialize($tmp[$value]):'';
						}
					}
					else $tmp[$unserialize] = unserialize($tmp[$unserialize]);
				}
			}
			return $tmp;
		}
		else
		return false;
	}

	public function query($sql)
	{
		if(!$sql)return false;
		if(!$this->linkid)$this->connect();
		return $this->linkid->query($sql);
	}

	public function exec($sql)
	{
		$this->affectedRows = 0;
		if(!is_array($sql))return false;
		if(!$this->linkid)$this->connect();
		if(isset($sql['dim']) && $sql['dim'])
		return $this->dimexec($sql);
		else
		$query = $this->linkid->prepare($sql['sql']);
		$rs = $query->execute($sql['v']);
		$this->_log($sql,$query);
		$this->affectedRows = $rs;
		return $rs;
	}

	public function dimexec($sql)
	{
		if(!is_array($sql))return false;
		if(!$this->linkid)$this->connect();
		$query = $this->linkid->prepare($sql['sql']);
		foreach($sql['v'] as $p)
		$rs = $query->execute($p);
		//if($stmt->errorInfo())print_r($stmt->errorInfo());
		//else
		return $rs;
	}

	public function lastInsertId()
	{
		return $this->linkid->lastInsertId();
	}

	public function insertElement($args)
	{
		$data = array($args['table'],$args['query']);
		$sql = $this->makeInsert($data);
		$this->exec($sql);
		return $this->lastInsertId();
	}

	public function getElement($args)
	{
		$data = array($args['select'],$args['table'],$args['query'],$args['groupby'],$args['orderby'],1);
		$sql = $this->makeSelect($data);
		return $this->fetch($sql);
	}

	public function getElements($args)
	{
		$data = array($args['select'],$args['table'],$args['query'],$args['groupby'],$args['orderby'],$args['limit']);
		$sql = $this->makeSelect($data);
		return $this->fetchAll($sql,$args['index'],$args['serial']);
	}

	public function listElements2($page = 1,$number = 20,$args = [],$tablepre = DTH)
	{
		if(!is_array($args))return false;
		$pg = M('pg');
		$page = $page > 0?$page:1;
		$r = array();
		$data = array($args['select'],$args['table'],$args['query'],$args['groupby'],$args['orderby'],array(intval($page-1)*$number,$number));
		$sql = $this->makeSelect($data,$tablepre);
		$r['data'] = $this->fetchAll($sql,$args['index'],$args['serial']);
		$data = array('count(*) AS number',$args['table'],$args['query']);
		$sql = $this->makeSelect($data,$tablepre);
		$t = $this->fetch($sql);
		$pages = $pg->outPage($pg->getPagesNumber($t['number'],$number),$page);
		$r['pages'] = $pages;
		$r['number'] = $t['number'];
		return $r;
	}

	public function listElements($page = 1,$number = 20,$args = [])
	{
		if(!is_array($args))return false;
		$pg = M('pg');
		$page = $page > 0?$page:1;
		$r = array();
		$data = array($args['select'],$args['table'],$args['query'],isset($args['groupby'])?$args['groupby']:false,isset($args['orderby'])?$args['orderby']:false,array(intval($page-1)*$number,$number));
		$sql = $this->makeSelect($data,true);
		$r['data'] = $this->fetchAll($sql,isset($args['index'])?$args['index']:false,isset($args['serial'])?$args['serial']:false);
		$total = $this->query('SELECT FOUND_ROWS()')->fetchColumn();
		$pages = $pg->outPage($pg->getPagesNumber($total,$number),$page);
		$r['pages'] = $pages;
		$r['number'] = $total;
		return $r;
	}

	public function delElement($args)
	{
		$data = array($args['table'],$args['query'],$args['orderby'],$args['limit']);
		$sql = $this->makeDelete($data);
		return $this->exec($sql);
		//return $this->affectedRows();
	}

	public function updateElement($args)
	{
		$data = array($args['table'],$args['value'],$args['query'],$args['limit']);
		$sql = $this->makeUpdate($data);
		return $this->exec($sql);
		//$this->affectedRows();
	}

	public function affectedRows()
	{
		return $this->affectedRows;
	}
}
?>
