<?php
 namespace PHPEMS;
/*
 * Created on 2016-5-19
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
class action extends app
{
	public function display()
	{
		$action = M('ev')->url(3);
		if(!method_exists($this,$action))
		$action = "index";
		$this->$action();
		exit;
	}

	private function fields()
	{
		$moduleid = M('ev')->get('moduleid');
		$page = M('ev')->post('page');
		if(M('ev')->get('modifyfieldsequence'))
		{
			$ids = M('ev')->post('ids');
			if($ids)
			{
				foreach($ids as $key => $value)
				{
					$args = array('fieldsequence'=>$value);
					M('module')->modifyFieldHtmlType($key,$args);
				}
			}
			$message = array(
				'statusCode' => 200,
				"message" => "操作成功",
				"callbackType" => "forward",
			    "forwardUrl" => "index.php?autoform-master-module-fields&moduleid={$moduleid}"
			);
			R($message);
		}
		else
		{
			$module = M('module')->getModuleById($moduleid);
			$fields = M('module')->getTableMoudleFields($moduleid,1,true);
			M('tpl')->assign('moduleid',$moduleid);
			M('tpl')->assign('module',$module);
			M('tpl')->assign('fields',$fields);
			M('tpl')->display('fields');
		}
	}

	private function addfield()
	{
		$moduleid = M('ev')->get('moduleid');
		$fieldpublic = M('ev')->get('fieldpublic');
		$page = M('ev')->post('page');
		if(M('ev')->get('insertfield'))
		{
			$args = M('ev')->post('args');
			$moduleid = $args['fieldmoduleid'];
			$module = M('module')->getModuleById($moduleid);
			if(!$args['fieldpublic'])
			$args['field'] = $module['modulecode'].'_'.$args['field'];
			if(is_array($args['fieldforbidactors']))$args['fieldforbidactors'] = ','.implode(',',$args['fieldforbidactors']).',';
			$id = M('module')->insertModuleField($args);
			if($id)
			{
				$message = array(
					'statusCode' => 200,
					"message" => "操作成功",
					"callbackType" => "forward",
				    "forwardUrl" => "index.php?autoform-master-module-fields&moduleid={$moduleid}&page={$page}"
				);
			}
			else
			{
				$message = array(
					'statusCode' => 300,
					"message" => "操作失败"
				);
			}
			R($message);
		}
		else
		{
			$module = M('module')->getModuleById($moduleid);
			M('tpl')->assign('moduleid',$moduleid);
			M('tpl')->assign('fieldpublic',$fieldpublic);
			M('tpl')->assign('module',$module);
			M('tpl')->display('addfield');
		}
	}

	private function preview()
	{
		$moduleid = M('ev')->get('moduleid');
		$module = M('module')->getModuleById($moduleid);
		$fields = M('module')->getMoudleFields($moduleid,1);
		$forms = M('html')->buildHtml($fields);
		M('tpl')->assign('moduleid',$moduleid);
		M('tpl')->assign('module',$module);
		M('tpl')->assign('fields',$fields);
		M('tpl')->assign('forms',$forms);
		M('tpl')->display('preview');
	}

	private function modifyfield()
	{
		if(M('ev')->get('modifyfieldhtml'))
		{
			$args = M('ev')->post('args');
			$args['fieldforbidactors'] = is_array($args['fieldforbidactors'])?','.implode(',',$args['fieldforbidactors']).',':'';
			$fieldid = M('ev')->post('fieldid');
			$field = M('module')->getFieldById($fieldid);
			M('module')->modifyFieldHtmlType($fieldid,$args);
			$message = array(
				'statusCode' => 200,
				"message" => "操作成功",
			    "callbackType" => "forward",
			    "forwardUrl" => "index.php?autoform-master-module-fields&moduleid={$field['fieldmoduleid']}"
			);
			R($message);
		}
		elseif(M('ev')->get('modifyfielddata'))
		{
			$args = M('ev')->post('args');
			$fieldid = M('ev')->post('fieldid');
			$field = M('module')->getFieldById($fieldid);
			M('module')->modifyFieldDataType($fieldid,$args);
			$message = array(
				'statusCode' => 200,
				"message" => "操作成功",
			    "callbackType" => "forward",
			    "forwardUrl" => "index.php?autoform-master-module-fields&moduleid={$field['fieldmoduleid']}"
			);
			R($message);
		}
		else
		{
			$fieldid = M('ev')->get('fieldid');
			$field = M('module')->getFieldById($fieldid);
			$module = M('module')->getModuleById($field['fieldmoduleid']);
			M('tpl')->assign('module',$module);
			M('tpl')->assign('fieldid',$fieldid);
			M('tpl')->assign('field',$field);
			M('tpl')->display('modifyfield');
		}
	}

	private function delfield()
	{
		$fieldid = M('ev')->get('fieldid');
		$moduleid = M('ev')->get('moduleid');
		$r = M('module')->delField($fieldid);
		$message = array(
			'statusCode' => 200,
			"message" => "操作成功",
		    "callbackType" => "forward",
		    "forwardUrl" => "index.php?autoform-master-module-fields&moduleid={$moduleid}"
		);
		R($message);
	}

	private function modify()
	{
		$page = M('ev')->get('page');
		if(M('ev')->get('modifymodule'))
		{
			$args = M('ev')->get('args');
			$moduleid = M('ev')->get('moduleid');
			M('module')->modifyModule($moduleid,$args);
			$message = array(
				'statusCode' => 200,
				"message" => "操作成功",
			    "callbackType" => "forward",
			    "forwardUrl" => "index.php?autoform-master-module"
			);
			R($message);
		}
		else
		{
			$moduleid = M('ev')->get('moduleid');
			$module = M('module')->getModuleById($moduleid);
			M('tpl')->assign('module',$module);
			M('tpl')->display('modifymodule');
		}
	}

	private function forbiddenfield()
	{
        $fieldid = M('ev')->get('fieldid');
        $moduleid = M('ev')->get('moduleid');
        $field = M('module')->getFieldById($fieldid);
        if(!$moduleid)$moduleid = $field['fieldmoduleid'];
        $module = M('module')->getModuleById($moduleid);
        if($module['modulelockfields'][$field['field']])
        {
            unset($module['modulelockfields'][$field['field']]);
        }
        else
        {
            $module['modulelockfields'][$field['field']] = 1;
        }
        M('module')->modifyModule($moduleid,array('modulelockfields' => $module['modulelockfields']));
        $message = array(
            'statusCode' => 200,
            "message" => "操作成功",
            "callbackType" => "forward",
            "forwardUrl" => "reload"
        );
        R($message);
	}

	private function moduleforms()
	{
		$moduleid = M('ev')->get('moduleid');
		$fields = M('module')->getMoudleFields($moduleid,1);
		$forms = M('html')->buildHtml($fields);
		M('tpl')->assign('fields',$fields);
		M('tpl')->assign('forms',$forms);
		M('tpl')->display('preview_ajax');
	}

	private function add()
	{
		$page = intval(M('ev')->get('page'));
		if(M('ev')->post('insertmodule'))
		{
			$args = M('ev')->post('args');
			$errmsg = false;
			if(M('module')->searchModules(array(array("AND","modulecode = :modulecode",'modulecode',$args['modulecode']))))
			{
				$message = array(
					'statusCode' => 300,
					"message" => "操作失败，存在同名（代码）模型"
				);
				R($message);
			}
			$id = M('module')->insertTableModule($args);
			if(!$id)$errmsg = '模型添加出错';
			if(!$errmsg)
			{
				$message = array(
					'statusCode' => 200,
					"message" => "操作成功",
					"callbackType" => "forward",
				    "forwardUrl" => "index.php?autoform-master-module&page={$page}"
				);
				R($message);
			}
			else
			{
				$message = array(
					'statusCode' => 300,
					"message" => "操作失败，{$errmsg}"
				);
			}
			R($message);
		}
		else
		M('tpl')->display('addmodule');
	}

	private function del()
	{
		$moduleid = M('ev')->get('moduleid');
		$fileds = M('module')->getPrivateMoudleFields($moduleid);
		$groups = M('user','user')->getGroupsByModuleid($moduleid);
		if($fileds || $groups)
		$message = array(
			'statusCode' => 300,
			"message" => "操作失败，请先删除该模型下所有模型字段和用户组"
		);
		else
		{
			M('module')->delModule($moduleid);
			$message = array(
				'statusCode' => 200,
				"message" => "操作成功",
				"callbackType" => "forward",
				"forwardUrl" => "reload"
			);
		}
		R($message);
	}

	private function index()
	{
        $page = M('ev')->get('page');
        $page = $page > 1?$page:1;
        $args = array();
        $args[] = array("AND","moduleapp = 'autoform'");
        $modules = M('module')->getModulesList($args);
        M('tpl')->assign('modules',$modules);
		M('tpl')->display('module');
	}
}


?>
