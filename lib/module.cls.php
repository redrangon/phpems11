<?php
 namespace PHPEMS;
/*
 * Created on 2011-12-19
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
class module
{
	private $cache = array();

	//查询模型
	public function searchModules($args)
	{
		$data = array(false,'module',$args);
		$sql = M('pepdo')->makeSelect($data);
		return M('pepdo')->fetchAll($sql,'moduleid');
	}

	//根据应用获取模型
	public function getModulesByApp($app)
	{
		$data = array(false,'module',array(array("AND","moduleapp = :app",'app',$app)),false,'moduleid DESC',false);
		$sql = M('pepdo')->makeSelect($data);
		return M('pepdo')->fetchAll($sql,'moduleid');
	}

    public function getModulesList($args,$page,$number = PN,$order = "moduleid desc")
    {
        $data = array(
            'select' => false,
            'table' => 'module',
            'query' => $args,
            'orderby' => $order,
			'serial' => 'modulelockfields'
        );
        $r = M('pepdo')->listElements($page,$number,$data);
        return $r;
    }

	//根据ID获取模型
	public function getModuleById($moduleid)
	{
		if(!$this->cache['module'][$moduleid])
		{
			$data = array(false,'module',array(array('AND',"moduleid = :moduleid",'moduleid',$moduleid)));
			$sql = M('pepdo')->makeSelect($data);
			$this->cache['module'][$moduleid] = M('pepdo')->fetch($sql,'modulelockfields');
		}
		return $this->cache['module'][$moduleid];
	}

	//插入模型
	public function insertModule($args)
	{
		if(!$args['moduleapp'])$args['moduleapp'] = \PHPEMS\ginkgo::$app;
		if($args['moduleapp'] == 'autoform')
		{
            $args['moduletable'] = 'autoform_'.$args['modulecode'];
            $this->_insertDefaultTable($args['moduletable'],$args['modulecode'].'id');
		}
		$data = array('module',$args);
		$sql = M('pepdo')->makeInsert($data);
		M('pepdo')->exec($sql);
		return M('pepdo')->lastInsertId();
	}

    //插入独立表模型
	public function insertTableModule($args)
    {
        if(!$args['moduleapp'])$args['moduleapp'] = \PHPEMS\ginkgo::$app;
        $args['moduletable'] = $args['moduleapp'].'_'.$args['modulecode'];
        $this->_insertDefaultTable($args['moduletable'],$args['modulecode'].'id');
        $data = array('module',$args);
        $sql = M('pepdo')->makeInsert($data);
        M('pepdo')->exec($sql);
        return M('pepdo')->lastInsertId();
    }

	//插入默认的表，$primary为主键字段名，必须为INT 11
	private function _insertDefaultTable($table,$primary)
	{
		$fields = array(array('name'=>$primary,'type'=>'INT','length'=>11,'auto' => true));
		$indexs = array(array('type'=>'PRIMARY KEY','field'=>$primary));
		$sql = M('pepdo')->createTable($table,$fields,$indexs);
		return M('pepdo')->query($sql);
	}

	//根据用户获取模型所有字段
	public function getMoudleFields($moduleid,$userinfo = 1,$uselock = false,$app = null)
	{
		if(!$app)$app = \PHPEMS\ginkgo::$app;
		$module = $this->getModuleById($moduleid);
		$data = array(false,'module_fields',array(array('AND',"fieldmoduleid = :moduleid",'moduleid',$moduleid), array('OR'," (fieldpublic = 1 AND fieldappid = :app)",'app',$app)),false,'fieldsequence DESC,fieldid DESC');
		$sql = M('pepdo')->makeSelect($data);
		$r = M('pepdo')->fetchAll($sql);
		if($uselock)
		{
			return $r;
        }
		foreach($r as $key => $p)
		{
			if($module['modulelockfields'][$p['field']])
			{
                unset($r[$key]);
			}
			else
			{
                if($userinfo == 1)
                {
                    if(strpos($p['fieldforbidactors'],',1,') !== false)
					{
						unset($r[$key]);
					}
                }
                else
                {
                    if(strpos($p['fieldforbidactors'],',-1,') !== false)
					{
						unset($r[$key]);
					}
                }
			}
		}
		return $r;
	}

	public function getTableMoudleFields($moduleid,$userinfo = 1,$uselock = false,$app = null)
    {
        if(!$app)$app = \PHPEMS\ginkgo::$app;
        $module = $this->getModuleById($moduleid);
        $data = array(false,'module_fields',array(array('AND',"fieldmoduleid = :moduleid",'moduleid',$moduleid), array('AND',"fieldappid = :app",'app',$app)),false,'fieldsequence DESC,fieldid DESC');
        $sql = M('pepdo')->makeSelect($data);
        $r = M('pepdo')->fetchAll($sql);
        if($uselock)
        {
            return $r;
        }
        foreach($r as $key => $p)
        {
            if($module['modulelockfields'][$p['field']])
            {
                unset($r[$key]);
            }
            else
            {
                if($userinfo == 1)
                {
                    if(strpos($p['fieldforbidactors'],',1,') !== false)
                    {
                        unset($r[$key]);
                    }
                }
                else
                {
                    if(strpos($p['fieldforbidactors'],',-1,') !== false)
                    {
                        unset($r[$key]);
                    }
                }
            }
        }
        return $r;
    }

	//获取模型直属字段
	public function getPrivateMoudleFields($moduleid)
	{
		$data = array(false,'module_fields',array(array('AND',"fieldmoduleid = :moduleid",'moduleid',$moduleid),array("AND","fieldpublic = 0")),false,'fieldsequence DESC,fieldid DESC');
		$sql = M('pepdo')->makeSelect($data);
		return M('pepdo')->fetchAll($sql);
	}

	//删除模型
	public function delModule($moduleid)
	{
		$data = array('module',array(array('AND',"moduleid = :moduleid",'moduleid',$moduleid)));
		$sql = M('pepdo')->makeDelete($data);
        return M('pepdo')->exec($sql);
	}

	//删除模型字段
	public function delField($fieldid)
	{
		$field = $this->getFieldById($fieldid);
		$sql = M('pepdo')->delField($field['field'],\PHPEMS\ginkgo::$app);
		M('pepdo')->exec($sql);
		$data = array('module_fields',array(array('AND',"fieldid = :fieldid",'fieldid',$fieldid)));
		$sql = M('pepdo')->makeDelete($data);
		return M('pepdo')->exec($sql);
	}

	//整理模型所需的参数，除去多余参数
	public function tidyNeedFieldsPars($args,$moduleid,$userinfo = -1)
	{
		$tmp = array();
		foreach(M('config',\PHPEMS\ginkgo::$app)->fields as $p)
		{
			if(isset($args[$p]))$tmp[$p] = $args[$p];
		}
		$r = $this->getMoudleFields($moduleid,$userinfo);
		foreach($r as $key => $data)
		{

			if($data['fieldhtmltype'] == 'htmltime')
			$tmp[$data['field']] = strtotime($args[$data['field']]);
			else
			$tmp[$data['field']] = $args[$data['field']];
		}
		return $tmp;
	}

	//根据字段名称和模型ID查找字段
	public function getFieldByNameAndModuleid($field,$moduleid = false)
	{
		if($moduleid)
		$data = array(false,'module_fields',array(array('AND',"fieldmoduleid = :moduleid",'moduleid',$moduleid),array('AND',"field = :field",'field',$field)));
		else
		$data = array(false,'module_fields',array(array('AND',"field = :field",'field',$field)));
		$sql = M('pepdo')->makeSelect($data);
		return M('pepdo')->fetch($sql);
	}

	//根据ID获取字段
	public function getFieldById($fieldid)
	{
		if(!$this->cache['field'][$fieldid])
		{
			$data = array(false,'module_fields',array(array('AND',"fieldid = :fieldid",'fieldid',$fieldid)));
			$sql = M('pepdo')->makeSelect($data);
			$this->cache['field'][$fieldid] = M('pepdo')->fetch($sql);
		}
		return $this->cache['field'][$fieldid];
	}

	//插入模型字段
	public function insertModuleField($args)
	{
		$args['fieldappid'] = \PHPEMS\ginkgo::$app;
		$this->insertModuleFieldData($args);
		$data = array('module_fields',$args);
		$sql = M('pepdo')->makeInsert($data);
		M('pepdo')->exec($sql);
		return M('pepdo')->lastInsertId();
	}

	//编辑字段的HTML属性
	public function modifyFieldHtmlType($fieldid,$args)
	{
		$data = array('module_fields',$args,array(array('AND',"fieldid = :fieldid",'fieldid',$fieldid)));
		$sql = M('pepdo')->makeUpdate($data);
		return M('pepdo')->exec($sql);
	}

	//编辑字段的数据库属性
	public function modifyFieldDataType($fieldid,$args)
	{
		$this->modifyModuleField($args,$fieldid);
		$data = array('module_fields',$args,array(array('AND',"fieldid = :fieldid",'fieldid',$fieldid)));
		$sql = M('pepdo')->makeUpdate($data);
		return M('pepdo')->exec($sql);
	}

	//插入模型字段
	public function insertModuleFieldData($args)
	{
		$args['fieldcharset'] = 'utf8';
		$r = $this->getModuleById($args['fieldmoduleid']);
		if($r['moduletable'])
		$table = $r['moduletable'];
		else
		$table = \PHPEMS\ginkgo::$app;
		$sql = $this->sql->addField($args,$table);
		return M('pepdo')->query($sql);
	}

	//修改模型字段
	public function modifyModuleField($fieldid,$args)
	{
		$args['fieldcharset'] = 'utf8';
		$field = $this->getFieldById($fieldid);
		$args['field'] = $field['field'];
		$r = $this->getModuleById($field['fieldmoduleid']);
		if($r['moduletable'])
		$table = $r['moduletable'];
		else
		$table = \PHPEMS\ginkgo::$app;
		$sql = $this->sql->modifyField($args,$table);
		return M('pepdo')->query($sql);
	}

	//修改模型
	public function modifyModule($moduleid,$args)
	{
		$data = array("module",$args,array(array('AND',"moduleid = :moduleid",'moduleid',$moduleid)));
		$sql = M('pepdo')->makeUpdate($data);
		return M('pepdo')->exec($sql);
	}
}
?>
