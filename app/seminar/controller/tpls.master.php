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
		$this->layout = M('layout','seminar');
		$action = $this->ev->url(3);
		$this->types = array(
			'style' => '风格',
			'layout' => '通栏',
			'slider' => '轮播',
			'lists' => '列表',
			'block' => '图文',
			'plugin' => '插件'
		);
		$search = $this->ev->get('search');
		$this->u = '';
		if($search)
		{
			$this->tpl->assign('search',$search);
			foreach($search as $key => $arg)
			{
				$this->u .= "&search[{$key}]={$arg}";
			}
		}
		$this->tpl->assign('search',$search);
		if(!method_exists($this,$action))
		$action = "index";
		$this->$action();
		exit;
	}

    private function del()
    {
        $stplid = $this->ev->get('stplid');
        $tpl = $this->layout->delSeminarTpl($stplid);
        $message = array(
            'statusCode' => 200,
            "message" => "操作成功",
            "callbackType" => "forward",
            "forwardUrl" => "reload"
        );
        \PHPEMS\ginkgo::R($message);
    }

    private function modify()
    {
        $stplid = $this->ev->get('stplid');
        $tpl = $this->layout->getSeminarTplById($stplid);
        if($this->ev->get('submit'))
		{
			$args = $this->ev->get('args');
            $this->layout->modifySeminarTpl($stplid,$args);
            $message = array(
                'statusCode' => 200,
                "message" => "操作成功",
                "callbackType" => "forward",
                "forwardUrl" => "index.php?seminar-master-tpls-{$tpl['stpltype']}"
            );
            \PHPEMS\ginkgo::R($message);
		}
		else
        {
            $this->tpl->assign('tpl',$tpl);
            $this->tpl->assign('types',$this->types);
            $this->tpl->display('tpls_modify');
        }
    }

    private function add()
    {
        if($this->ev->get('submit'))
		{
			$args = $this->ev->get('args');
            $this->layout->addSeminarTpl($args);
            $message = array(
                'statusCode' => 200,
                "message" => "操作成功",
                "callbackType" => "forward",
                "forwardUrl" => "index.php?seminar-master-tpls-{$args['stpltype']}"
            );
            \PHPEMS\ginkgo::R($message);
		}
		else
		{
			$type = $this->ev->get('type');
			if(!$this->types[$type])$type = 'style';
			$this->tpl->assign('type',$type);
			$this->tpl->assign('types',$this->types);
			$this->tpl->display('tpls_add');
        }
    }

    private function plugin()
    {
        $page = $this->ev->get('page');
        $page = $page > 1?$page:1;
        $args = array();
        $args[] = array("AND","stpltype = 'plugin'");
        $tpls = $this->layout->getSeminarTplsList($args,$page);
        $this->tpl->assign('tpls',$tpls);
        $this->tpl->display('tpls_plugin');
    }

    private function block()
    {
        $page = $this->ev->get('page');
        $page = $page > 1?$page:1;
        $args = array();
        $args[] = array("AND","stpltype = 'block'");
        $tpls = $this->layout->getSeminarTplsList($args,$page);
        $this->tpl->assign('tpls',$tpls);
        $this->tpl->display('tpls_block');
    }

    private function lists()
    {
        $page = $this->ev->get('page');
        $page = $page > 1?$page:1;
        $args = array();
        $args[] = array("AND","stpltype = 'lists'");
        $tpls = $this->layout->getSeminarTplsList($args,$page);
        $this->tpl->assign('tpls',$tpls);
        $this->tpl->display('tpls_lists');
    }

    private function slider()
    {
        $page = $this->ev->get('page');
        $page = $page > 1?$page:1;
        $args = array();
        $args[] = array("AND","stpltype = 'slider'");
        $tpls = $this->layout->getSeminarTplsList($args,$page);
        $this->tpl->assign('tpls',$tpls);
        $this->tpl->display('tpls_slider');
    }

    private function layout()
    {
        $page = $this->ev->get('page');
        $page = $page > 1?$page:1;
        $args = array();
        $args[] = array("AND","stpltype = 'layout'");
        $tpls = $this->layout->getSeminarTplsList($args,$page);
        $this->tpl->assign('tpls',$tpls);
        $this->tpl->display('tpls_layout');
    }

	private function index()
	{
		$page = $this->ev->get('page');
		$page = $page > 1?$page:1;
        $args = array();
        $args[] = array("AND","stpltype = 'style'");
		$tpls = $this->layout->getSeminarTplsList($args,$page);
        $this->tpl->assign('tpls',$tpls);
		$this->tpl->display('tpls');
	}
}


?>
