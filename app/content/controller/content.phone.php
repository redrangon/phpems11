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

    private function buy()
    {
        $contentid = M('ev')->get('contentid');
        $content = M('content','content')->getContentById($contentid);
        if($this->user['userid'])
        {
            if($content['contentcoin'])
            {
                $args = array(
                    array("AND","cturuserid = :cturuserid","cturuserid",$this->user['userid']),
                    array("AND","cturcontentid = :cturcontentid","cturcontentid",$contentid)
                );
                $ctur = M('content','content')->getCturByArgs($args);
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
                    $user = M('user','user')->getUserById($this->user['userid']);
                    if($user['usercoin'] >= $content['contentcoin'])
                    {

                        $coin = $user['usercoin'] - $content['contentcoin'];
                        M('user','user')->modifyUserInfo($this->user['userid'],array('usercoin' => $coin));
                        M('content','content')->addCtur(array('cturuserid' => $this->user['userid'],'cturcontentid' => $contentid));
                        M('consume','bank')->addConsumeLog(array('conluserid' => $this->user['userid'],'conlcost' => $content['contentcoin'],'conltype' => 1,'conltime' => TIME,'conlinfo' => '购买内容'.$content['contenttitle']));
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
		$contentid = M('ev')->get('contentid');
		echo M('content','content')->setViewNumber($contentid);
	}

	public function index()
	{
		$page = M('ev')->get('page');
		$contentid = M('ev')->get('contentid');
		$content = M('content','content')->getContentById($contentid);
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
            if($this->user['userid'] && $content['contentcoin'])
            {
                $args = array(
                    array("AND","cturuserid = :cturuserid","cturuserid",$this->user['userid']),
                    array("AND","cturcontentid = :cturcontentid","cturcontentid",$contentid)
                );
                $ctur = M('content','content')->getCturByArgs($args);
                M('tpl')->assign('status',$ctur['cturid']);
            }
			$catbread = M('category')->getCategoryPos($content['contentcatid']);
			$cat = M('category')->getCategoryById($content['contentcatid']);
			$catbrother = M('category')->getCategoriesByArgs(array(array('AND',"catparent = :catparent",'catparent',$cat['catparent']),array('AND',"catinmenu = '0'")));
			if($content['contenttemplate'])$template = $content['contenttemplate'];
			else $template = 'content_default';
			$nearContent = M('content','content')->getNearContentById($contentid,$content['contentcatid']);
			if(!$template)$template = 'content_default';
			M('tpl')->assign('cat',$cat);
			M('tpl')->assign('nearContent',$nearContent);
			M('tpl')->assign('page',$page);
			M('tpl')->assign('catbread',$catbread);
			M('tpl')->assign('content',$content);
			M('tpl')->assign('catbrother',$catbrother);
			M('tpl')->display($template);
		}
	}
}


?>
