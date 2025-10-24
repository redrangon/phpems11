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
		$action = $this->ev->url(3);
		if(!method_exists($this,$action))
		$action = "index";
		$this->$action();
		exit;
	}

    private function buy()
    {
        $contentid = $this->ev->get('contentid');
        $content = $this->content->getContentById($contentid);
        if($this->_user['sessionuserid'])
        {
            if($content['contentcoin'])
            {
                $args = array(
                    array("AND","cturuserid = :cturuserid","cturuserid",$this->_user['sessionuserid']),
                    array("AND","cturcontentid = :cturcontentid","cturcontentid",$contentid)
                );
                $ctur = $this->content->getCturByArgs($args);
                if($ctur['cturid'])
                {
                    $message = array(
                        'statusCode' => 300,
                        "message" => "您已经购买过本内容"
                    );
                    \PHPEMS\ginkgo::R($message);
                }
                else
                {
                    $user = $this->user->getUserById($this->_user['sessionuserid']);
                    if($user['usercoin'] >= $content['contentcoin'])
                    {

                        $coin = $user['usercoin'] - $content['contentcoin'];
                        $this->user->modifyUserInfo($this->_user['sessionuserid'],array('usercoin' => $coin));
                        $this->content->addCtur(array('cturuserid' => $this->_user['sessionuserid'],'cturcontentid' => $contentid));
                        M('consume','bank')->addConsumeLog(array('conluserid' => $this->_user['sessionuserid'],'conlcost' => $content['contentcoin'],'conltype' => 1,'conltime' => TIME,'conlinfo' => '购买内容'.$content['contenttitle']));
                        $message = array(
                            'statusCode' => 200,
                            "message" => "购买成功",
                            "callbackType" => "forward",
                            "forwardUrl" => "reload"
                        );
                        \PHPEMS\ginkgo::R($message);
                    }
                    else
                    {
                        $message = array(
                            'statusCode' => 300,
                            "message" => "您积分不足，不能购买本商品"
                        );
                        \PHPEMS\ginkgo::R($message);
                    }
                }
            }
            else
            {
                $message = array(
                    'statusCode' => 300,
                    "message" => "您不需要购买本内容"
                );
                \PHPEMS\ginkgo::R($message);
            }
        }
        else
        {
            $message = array(
                'statusCode' => 301,
                "message" => "请您先登录"
            );
            \PHPEMS\ginkgo::R($message);
        }
    }

	public function setview()
	{
		$contentid = $this->ev->get('contentid');
		echo $this->content->setViewNumber($contentid);
	}

	public function index()
	{
		$page = $this->ev->get('page');
		$contentid = $this->ev->get('contentid');
		$content = $this->content->getContentById($contentid);
		if($content['contentlink'])
		{
            $message = array(
                'statusCode' => 201,
                "message" => "操作成功",
                "callbackType" => "forward",
                "forwardUrl" => html_entity_decode($content['contentlink'])
            );
            \PHPEMS\ginkgo::R($message);
		}
		else
		{
            if($this->_user['sessionuserid'] && $content['contentcoin'])
            {
                $args = array(
                    array("AND","cturuserid = :cturuserid","cturuserid",$this->_user['sessionuserid']),
                    array("AND","cturcontentid = :cturcontentid","cturcontentid",$contentid)
                );
                $ctur = $this->content->getCturByArgs($args);
                $this->tpl->assign('status',$ctur['cturid']);
            }
			$catbread = $this->category->getCategoryPos($content['contentcatid']);
			$cat = $this->category->getCategoryById($content['contentcatid']);
			$catbrother = $this->category->getCategoriesByArgs(array(array('AND',"catparent = :catparent",'catparent',$cat['catparent']),array('AND',"catinmenu = '0'")));
			if($content['contenttemplate'])$template = $content['contenttemplate'];
			else $template = 'content_default';
			$nearContent = $this->content->getNearContentById($contentid,$content['contentcatid']);
			if(!$template)$template = 'content_default';
			$this->tpl->assign('cat',$cat);
			$this->tpl->assign('nearContent',$nearContent);
			$this->tpl->assign('page',$page);
			$this->tpl->assign('catbread',$catbread);
			$this->tpl->assign('content',$content);
			$this->tpl->assign('catbrother',$catbrother);
			$this->tpl->display($template);
		}
	}
}


?>
