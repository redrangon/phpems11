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

	private function ajax()
	{
		switch($this->ev->url(4))
		{
			//添加一个收藏
			case 'addfavor':
			$questionid = $this->ev->get('questionid');
			if(!is_numeric($questionid))
			{
				$message = array(
					'statusCode' => 300,
					"message" => "即时组卷试题不能收藏！"
				);
			}
			if($this->favor->getFavorByQuestionAndUserId($questionid,$this->_user['sessionuserid']))
			{
				$message = array(
					'statusCode' => 200,
					"message" => "收藏成功！"
				);
			}
			else
			{
				$this->favor->favorQuestion($questionid,$this->_user['sessionuserid'],$this->data['currentbasic']['basicsubjectid']);
				$message = array(
					'statusCode' => 200,
					"message" => "收藏成功！"
				);
			}
			\PHPEMS\ginkgo::R($message);
			break;

			//删除一个收藏
			case 'delfavor':
			$favorid = $this->ev->get('favorid');
			$this->favor->delFavorById($favorid);
			$message = array(
				'statusCode' => 200,
				"message" => "操作成功",
				"callback" => reloadpage
			);
			\PHPEMS\ginkgo::R($message);
			break;

			case 'questions':
				$page = $this->ev->get('page');
                $page = $page > 0?$page:1;
				$args = array(
					array("AND","favorsubjectid = :favorsubjectid",'favorsubjectid',$this->data['currentbasic']['basicsubjectid']),
					array("AND","favoruserid = :favoruserid",'favoruserid',$this->_user['sessionuserid'])
				);
				$favors = $this->favor->getFavorListByUserid($args,$page,1);
				$question = $this->exam->getQuestionByArgs(array(array("AND","questionid = :questionid",'questionid',$favors['data'][0]['favorquestionid'])));
				if($question['questionparent'])
				{
					$parent = $this->exam->getQuestionRowsById($question['questionparent'],false,false);
					$this->tpl->assign('parent',$parent);
				}
				$questypes = $this->basic->getQuestypeList();
				$this->tpl->assign('favor',$favors['data'][0]);
                $this->tpl->assign('number',$page);
				$this->tpl->assign('question',$question);
				$this->tpl->assign('questype',$questypes[$question['questiontype']]);
				$this->tpl->assign('allnumber',$favors['number']);
				$this->tpl->display('favor_ajaxquestion');
				break;

			default:
			break;
		}
	}

    private function index()
    {
        $this->tpl->display('favor');
    }
}


?>
