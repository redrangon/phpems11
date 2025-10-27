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

	private function ajax()
	{
		switch(M('ev')->url(4))
		{
			//添加一个收藏
			case 'addfavor':
			$questionid = M('ev')->get('questionid');
			if(!is_numeric($questionid))
			{
				$message = array(
					'statusCode' => 300,
					"message" => "即时组卷试题不能收藏！"
				);
			}
			if(M('favor','exam')->getFavorByQuestionAndUserId($questionid,$this->user['userid']))
			{
				$message = array(
					'statusCode' => 200,
					"message" => "收藏成功！"
				);
			}
			else
			{
				M('favor','exam')->favorQuestion($questionid,$this->user['userid'],$this->data['currentbasic']['basicsubjectid']);
				$message = array(
					'statusCode' => 200,
					"message" => "收藏成功！"
				);
			}
			\PHPEMS\ginkgo::R($message);
			break;

			//删除一个收藏
			case 'delfavor':
			$favorid = M('ev')->get('favorid');
			M('favor','exam')->delFavorById($favorid);
			$message = array(
				'statusCode' => 200,
				"message" => "操作成功",
				"callback" => reloadpage
			);
			\PHPEMS\ginkgo::R($message);
			break;

			case 'questions':
				$page = M('ev')->get('page');
                $page = $page > 0?$page:1;
				$args = array(
					array("AND","favorsubjectid = :favorsubjectid",'favorsubjectid',$this->data['currentbasic']['basicsubjectid']),
					array("AND","favoruserid = :favoruserid",'favoruserid',$this->user['userid'])
				);
				$favors = M('favor','exam')->getFavorListByUserid($args,$page,1);
				$question = M('exam','exam')->getQuestionByArgs(array(array("AND","questionid = :questionid",'questionid',$favors['data'][0]['favorquestionid'])));
				if($question['questionparent'])
				{
					$parent = M('exam','exam')->getQuestionRowsById($question['questionparent'],false,false);
					M('tpl')->assign('parent',$parent);
				}
				$questypes = M('basic','exam')->getQuestypeList();
				M('tpl')->assign('favor',$favors['data'][0]);
                M('tpl')->assign('number',$page);
				M('tpl')->assign('question',$question);
				M('tpl')->assign('questype',$questypes[$question['questiontype']]);
				M('tpl')->assign('allnumber',$favors['number']);
				M('tpl')->display('favor_ajaxquestion');
				break;

			default:
			break;
		}
	}

    private function index()
    {
        M('tpl')->display('favor');
    }
}


?>
