<?php
namespace PHPEMS\survey;
use function \PHPEMS\M;
class survey
{
    public $db;
    public $config;

	public function __construct()
	{
		$this->db = M('pepdo');
        $this->config = M('config','survey');
	}


    //获取题型列表
    //参数：查询条件数组
    //返回值：题型列表数组
    public function getQuestypeList($args = 1)
    {
        $data = array(false,'questype',$args,false,false,false);
        $sql = $this->db->makeSelect($data);
        return $this->db->fetchAll($sql,'questid');
    }

    //根据题型名查询
    //参数：题型名称字符串
    //返回值：题型数组
    public function getQuestypeByName($questype)
    {
        $data = array(false,'questype',array(array("AND","questype = :questype",'questype',$questype)));
        $sql = $this->db->makeSelect($data);
        return $this->db->fetch($sql);
    }

    //根据题型ID查询
    //参数：题型ID
    //返回值：题型数组
    public function getQuestypeById($questid)
    {
        $data = array(false,'questype',array(array("AND","questid = :questid",'questid',$questid)));
        $sql = $this->db->makeSelect($data);
        return $this->db->fetch($sql);
    }

    //增加题型
    //参数：题型信息数组
    //返回值：插入的ID
    public function addQuestype($args)
    {
        $data = array('questype',$args);
        $sql = $this->db->makeInsert($data);
        $this->db->exec($sql);
        return $this->db->lastInsertId();
    }

    //修改题型
    //参数：题型ID，修改信息数组
    //返回值：受影响的记录数
    public function modifyQuestype($questid,$args)
    {
        $data = array('questype',$args,array(array("AND","questid = :questid",'questid',$questid)));
        $sql = $this->db->makeUpdate($data);
        return $this->db->exec($sql);
        //return $this->db->affectedRows();
    }

    //删除题型
    //参数：题型ID
    //返回值：受影响的记录数
    public function delQuestype($questid)
    {
        $data = array('questype',array(array("AND","questid = :questid",'questid',$questid)));
        $sql = $this->db->makeDelete($data);
        return $this->db->exec($sql);
        //return $this->db->affectedRows();
    }

    public function getSurveyList($args,$page,$number = 20,$order = "svyid desc")
    {
        $data = array(
            'select' => false,
            'table' => 'survey',
            'query' => $args,
            'orderby' => $order
        );
        $r = $this->db->listElements($page,$number,$data);
        return $r;
    }

    //按页获取地名列表
    //参数：无
    //返回值：地区列表


    //根据ID获取地名信息
    //参数：地名ID
    //返回值：该地名信息数组
    public function getSurveyById($svyid)
    {
        $data = array(false,'survey',array(array("AND","svyid = :svyid",'svyid',$svyid)));
        $sql = $this->db->makeSelect($data);
        return $this->db->fetch($sql);
    }

    //修改地名信息
    //参数：地名ID,要修改的信息
    //返回值：true
    public function modifySurvey($svyid,$args)
    {
        $data = array('survey',$args,array(array("AND","svyid = :svyid",'svyid',$svyid)));
        $sql = $this->db->makeUpdate($data);
        $this->db->exec($sql);
        return true;
    }



    //增加地区
    //参数：要添加的地区的信息数组
    //返回值：地名ID
    public function addSurvey($args)
    {
        $data = array('survey',$args);
        $sql = $this->db->makeInsert($data);
        $this->db->exec($sql);
        return $this->db->lastInsertId();
    }

    //删除地区
    //参数：地名ID
    //返回值：受影响的记录数
    public function delSurvey($svyid)
    {
        $data = array('survey',array(array("AND","svyid = :svyid",'svyid',$svyid)));
        $sql = $this->db->makeDelete($data);
        $this->db->exec($sql);
        return $this->db->affectedRows();
    }

    public function getSurveyNodeList($args,$page,$number = 20)
    {
        $data = array(
            'select' => false,
            'table' => 'survey_node',
            'query' => $args,
            'orderby' => 'syneid desc',
            'index' => 'syneid'
        );
        return $this->db->listElements($page,$number,$data);
    }

    public function getSurveyNodeById($syneid)
    {
        $data = array(false,'survey_node',array(array("AND","syneid = :syneid",'syneid',$syneid)));
        $sql = $this->db->makeSelect($data);
        return $this->db->fetch($sql);
    }

    public function getSurveyNodesByArgs($args,$orderby = "syneid asc")
    {
        $data = array(false,'survey_node',$args,false,$orderby,false);
        $sql = $this->db->makeSelect($data);
        return $this->db->fetchAll($sql,NULL);
    }

    public function getSurveyNodeByArgs($args)
    {
        $data = array(false,'survey_node',$args,false,false,1);
        $sql = $this->db->makeSelect($data);
        return $this->db->fetch($sql);
    }

    public function addSurveyNode($args)
    {
        $data = array('survey_node',$args);
        $sql = $this->db->makeInsert($data);
        $this->db->exec($sql);
        return $this->db->lastInsertId();
    }

    public function modifySurveyNode($syneid,$args)
    {
        $data = array('survey_node',$args,array(array("AND","syneid = :syneid",'syneid',$syneid)));
        $sql = $this->db->makeUpdate($data);
        $this->db->exec($sql);
        return true;
    }
    //删除地区
    //参数：地名ID
    //返回值：受影响的记录数
    public function delSurveyNode($syneid)
    {
        $data = array('survey_node',array(array("AND","syneid = :syneid",'syneid',$syneid)));
        $sql = $this->db->makeDelete($data);
        $this->db->exec($sql);
        return $this->db->affectedRows();
    }

    public function getSurveyQuestionList($args,$page,$number = 20)
    {
        $data = array(
            'select' => false,
            'table' => 'survey_questions',
            'query' => $args,
            'orderby' => 'syqnid desc',
            'index' => 'syqnid'
        );
        return $this->db->listElements($page,$number,$data);
    }

    public function getSurveyQuestionById($syqnid)
    {
        $data = array(false,'survey_questions',array(array("AND","syqnid = :syqnid",'syqnid',$syqnid)));
        $sql = $this->db->makeSelect($data);
        return $this->db->fetch($sql);
    }

    public function getSurveyQuestionsByArgs($args,$orderby = "syqnid asc")
    {
        $data = array(false,'survey_questions',$args,false,$orderby,false);
        $sql = $this->db->makeSelect($data);
        return $this->db->fetchAll($sql,NULL);
    }

    public function getSurveyQuestionByArgs($args)
    {
        $data = array(false,'survey_questions',$args,false,false,1);
        $sql = $this->db->makeSelect($data);
        return $this->db->fetch($sql);
    }

    public function addSurveyQuestion($args)
    {
        $data = array('survey_questions',$args);
        $sql = $this->db->makeInsert($data);
        $this->db->exec($sql);
        return $this->db->lastInsertId();
    }

    public function modifySurveyQuestion($syqnid,$args)
    {
        $data = array('survey_questions',$args,array(array("AND","syqnid = :syqnid",'syqnid',$syqnid)));
        $sql = $this->db->makeUpdate($data);
        $this->db->exec($sql);
        return true;
    }

    public function delSurveyQuestion($syqnid)
    {
        $data = array('survey_questions',array(array("AND","syqnid = :syqnid",'syqnid',$syqnid)));
        $sql = $this->db->makeDelete($data);
        $this->db->exec($sql);
        return $this->db->affectedRows();
    }

    public function delSurveyQuestions($args)
    {
        $data = array('survey_questions',$args);
        $sql = $this->db->makeDelete($data);
        $this->db->exec($sql);
        return $this->db->affectedRows();
    }

    public function getSurveyCaseList($args,$page,$number = 20)
    {
        $data = array(
            'select' => false,
            'table' => 'survey_case',
            'query' => $args,
            'orderby' => 'syceid desc',
            'index' => 'syceid'
        );
        return $this->db->listElements($page,$number,$data);
    }

    public function getSurveyCaseById($syceid)
    {
        $data = array(false,'survey_case',array(array("AND","syceid = :syceid",'syceid',$syceid)));
        $sql = $this->db->makeSelect($data);
        return $this->db->fetch($sql);
    }

    public function getSurveyCasesByArgs($args,$orderby = "syceid desc")
    {
        $data = array(false,'survey_case',$args,false,$orderby,false);
        $sql = $this->db->makeSelect($data);
        return $this->db->fetchAll($sql,NULL);
    }

    public function getSurveyCaseByArgs($args)
    {
        $data = array(false,'survey_case',$args,false,false,1);
        $sql = $this->db->makeSelect($data);
        return $this->db->fetch($sql);
    }

    public function addSurveyCase($args)
    {
        $data = array('survey_case',$args);
        $sql = $this->db->makeInsert($data);
        $this->db->exec($sql);
        return $this->db->lastInsertId();
    }

    public function modifySurveyCase($syceid,$args)
    {
        $data = array('survey_case',$args,array(array("AND","syceid = :syceid",'syceid',$syceid)));
        $sql = $this->db->makeUpdate($data);
        $this->db->exec($sql);
        return true;
    }

    public function delSurveyCase($syceid)
    {
        $data = array('survey_case',array(array("AND","syceid = :syceid",'syceid',$syceid)));
        $sql = $this->db->makeDelete($data);
        $this->db->exec($sql);
        return $this->db->affectedRows();
    }

    public function getSurveyReportNumbers()
    {
        $numbers = array();

        foreach($this->config->syrtsorts as $sort)
        {
            $data = array("count(*) as number",'survey_report',array(
                array("AND","syrtsort = :syrtsort","syrtsort",$sort)
            ),false,false,1);
            $sql = $this->db->makeSelect($data);
            $rs = $this->db->fetch($sql);
            $numbers['sort'][$sort] = $rs['number'];
        }

        $data = array("count(*) as number",'survey_report',array(),false,false,1);
        $sql = $this->db->makeSelect($data);
        $rs = $this->db->fetch($sql);
        $numbers['all']['number'] = $rs['number'];

        $data = array("count(*) as number",'survey_report',array(),"syrtcorporsn",false,1);
        $sql = $this->db->makeSelect($data);
        $rs = $this->db->fetch($sql);
        $numbers['all']['corpor'] = $rs['number'];

        $data = array("count(*) as number",'survey_report',array(
            array("AND","syrtfrom = :syrtfrom","syrtfrom","自填报")
        ),false,false,1);
        $sql = $this->db->makeSelect($data);
        $rs = $this->db->fetch($sql);
        $numbers['all']['from0'] = $rs['number'];

        $data = array("count(*) as number",'survey_report',array(
            array("AND","syrtfrom = :syrtfrom","syrtfrom","网站收集")
        ),false,false,1);
        $sql = $this->db->makeSelect($data);
        $rs = $this->db->fetch($sql);
        $numbers['all']['from1'] = $rs['number'];

        $data = array("count(*) as number",'survey_report',array(
            array("AND","syrtfrom = :syrtfrom","syrtfrom","专属链接")
        ),false,false,1);
        $sql = $this->db->makeSelect($data);
        $rs = $this->db->fetch($sql);
        $numbers['all']['from2'] = $rs['number'];

        foreach($this->config->statussteps as $key => $step)
        {
            $data = array("count(*) as number",'survey_report',array(
                array("AND","syrtstatus = :syrtstatus","syrtstatus",$key)
            ),false,false,1);
            $sql = $this->db->makeSelect($data);
            $rs = $this->db->fetch($sql);
            $numbers['all']['status'][$key] = $rs['number'];
        }

        foreach($this->config->cities as $key => $city)
        {
            $data = array("count(*) as number",'survey_report',array(array("AND","syrtcity = :syrtcity","syrtcity",$city)),false,false,1);
            $sql = $this->db->makeSelect($data);
            $rs = $this->db->fetch($sql);
            $numbers[$city]['number'] = $rs['number'];

            $data = array("count(*) as number",'survey_report',array(array("AND","syrtcity = :syrtcity","syrtcity",$city)),"syrtcorporsn",false,1);
            $sql = $this->db->makeSelect($data);
            $rs = $this->db->fetch($sql);
            $numbers[$city]['corpor'] = $rs['number'];

            $data = array("count(*) as number",'survey_report',array(
                array("AND","syrtfrom = :syrtfrom","syrtfrom","自填报"),
                array("AND","syrtcity = :syrtcity","syrtcity",$city)
            ),false,false,1);
            $sql = $this->db->makeSelect($data);
            $rs = $this->db->fetch($sql);
            $numbers[$city]['from0'] = $rs['number'];

            $data = array("count(*) as number",'survey_report',array(
                array("AND","syrtfrom = :syrtfrom","syrtfrom","网站收集"),
                array("AND","syrtcity = :syrtcity","syrtcity",$city)
            ),false,false,1);
            $sql = $this->db->makeSelect($data);
            $rs = $this->db->fetch($sql);
            $numbers[$city]['from1'] = $rs['number'];

            $data = array("count(*) as number",'survey_report',array(
                array("AND","syrtfrom = :syrtfrom","syrtfrom","专属链接"),
                array("AND","syrtcity = :syrtcity","syrtcity",$city)
            ),false,false,1);
            $sql = $this->db->makeSelect($data);
            $rs = $this->db->fetch($sql);
            $numbers[$city]['from2'] = $rs['number'];

            foreach($this->config->statussteps as $key => $step)
            {
                $data = array("count(*) as number",'survey_report',array(
                    array("AND","syrtstatus = :syrtstatus","syrtstatus",$key),
                    array("AND","syrtcity = :syrtcity","syrtcity",$city)
                ),false,false,1);
                $sql = $this->db->makeSelect($data);
                $rs = $this->db->fetch($sql);
                $numbers[$city]['status'][$key] = $rs['number'];
            }
        }

        return $numbers;
    }

    public function getSurveyReportList($args,$page,$number = 20)
    {
        $data = array(
            'select' => false,
            'table' => 'survey_report',
            'query' => $args,
            'orderby' => 'syrtid desc',
            'index' => 'syrtid'
        );
        return $this->db->listElements($page,$number,$data);
    }

    public function getSurveyReportById($syrtid)
    {
        $data = array(false,'survey_report',array(array("AND","syrtid = :syrtid",'syrtid',$syrtid)));
        $sql = $this->db->makeSelect($data);
        return $this->db->fetch($sql);
    }

    public function getSurveyReportsByArgs($args,$orderby = "syrtid desc")
    {
        $data = array(false,'survey_report',$args,false,$orderby,false);
        $sql = $this->db->makeSelect($data);
        return $this->db->fetchAll($sql,NULL);
    }

    public function getSurveyReportByArgs($args)
    {
        $data = array(false,'survey_report',$args,false,false,1);
        $sql = $this->db->makeSelect($data);
        return $this->db->fetch($sql);
    }

    public function addSurveyReport($args)
    {
        $data = array('survey_report',$args);
        $sql = $this->db->makeInsert($data);
        $this->db->exec($sql);
        return $this->db->lastInsertId();
    }

    public function modifySurveyReport($syrtid,$args)
    {
        $data = array('survey_report',$args,array(array("AND","syrtid = :syrtid",'syrtid',$syrtid)));
        $sql = $this->db->makeUpdate($data);
        $this->db->exec($sql);
        return true;
    }

    public function delSurveyReport($syrtid)
    {
        $data = array('survey_report',array(array("AND","syrtid = :syrtid",'syrtid',$syrtid)));
        $sql = $this->db->makeDelete($data);
        $this->db->exec($sql);
        return $this->db->affectedRows();
    }

    public function getSurveyResponseList($args,$page,$number = 20)
    {
        $data = array(
            'select' => false,
            'table' => 'survey_response',
            'query' => $args,
            'orderby' => 'syrpeid desc',
            'index' => 'syrpeid'
        );
        return $this->db->listElements($page,$number,$data);
    }

    public function getSurveyResponseById($syrpeid)
    {
        $data = array(false,'survey_response',array(array("AND","syrpeid = :syrpeid",'syrpeid',$syrpeid)));
        $sql = $this->db->makeSelect($data);
        return $this->db->fetch($sql);
    }

    public function getSurveyResponsesByArgs($args,$orderby = "syrpeid desc")
    {
        $data = array(false,'survey_response',$args,false,$orderby,false);
        $sql = $this->db->makeSelect($data);
        return $this->db->fetchAll($sql,NULL);
    }

    public function getSurveyResponseByArgs($args)
    {
        $data = array(false,'survey_response',$args,false,false,1);
        $sql = $this->db->makeSelect($data);
        return $this->db->fetch($sql);
    }

    public function addSurveyResponse($args)
    {
        $data = array('survey_response',$args);
        $sql = $this->db->makeInsert($data);
        $this->db->exec($sql);
        return $this->db->lastInsertId();
    }

    public function modifySurveyResponse($syrpeid,$args)
    {
        $data = array('survey_response',$args,array(array("AND","syrpeid = :syrpeid",'syrpeid',$syrpeid)));
        $sql = $this->db->makeUpdate($data);
        $this->db->exec($sql);
        return true;
    }

    public function delSurveyResponse($syrpeid)
    {
        $data = array('survey_response',array(array("AND","syrpeid = :syrpeid",'syrpeid',$syrpeid)));
        $sql = $this->db->makeDelete($data);
        $this->db->exec($sql);
        return $this->db->affectedRows();
    }
	
	public function getSurveyHistoryList($args,$page,$number = 20)
    {
        $data = array(
            'select' => false,
            'table' => 'survey_history',
            'query' => $args,
            'orderby' => 'syhyid desc',
            'index' => 'syhyid'
        );
        return $this->db->listElements($page,$number,$data);
    }

    public function getSurveyHistoryAndUsersList($args,$page,$number = 20)
    {
        $args[] = array("AND","userid = syhyuserid");
        $data = array(
            'select' => false,
            'table' => array('survey_history','user'),
            'query' => $args,
            'orderby' => 'syhyid desc',
            'index' => 'syhyid'
        );
        return $this->db->listElements($page,$number,$data);
    }

    public function getSurveyHistoryById($syhyid)
    {
        $data = array(false,'survey_history',array(array("AND","syhyid = :syhyid",'syhyid',$syhyid)));
        $sql = $this->db->makeSelect($data);
        return $this->db->fetch($sql,'syhyanswers');
    }

    public function getSurveyHistoriesByArgs($args,$orderby = "syhyid desc")
    {
        $data = array(false,'survey_history',$args,false,$orderby,false);
        $sql = $this->db->makeSelect($data);
        return $this->db->fetchAll($sql,NULL,'syhyanswers');
    }

    public function getSurveyHistoryByArgs($args)
    {
        $data = array(false,'survey_history',$args,false,false,1);
        $sql = $this->db->makeSelect($data);
        return $this->db->fetch($sql,'syhyanswers');
    }

    public function addSurveyHistory($args)
    {
        $data = array('survey_history',$args);
        $sql = $this->db->makeInsert($data);
        $this->db->exec($sql);
        return $this->db->lastInsertId();
    }

    public function modifySurveyHistory($syhyid,$args)
    {
        $data = array('survey_history',$args,array(array("AND","syhyid = :syhyid",'syhyid',$syhyid)));
        $sql = $this->db->makeUpdate($data);
        $this->db->exec($sql);
        return true;
    }

    public function delSurveyHistory($syhyid)
    {
        $data = array('survey_history',array(array("AND","syhyid = :syhyid",'syhyid',$syhyid)));
        $sql = $this->db->makeDelete($data);
        $this->db->exec($sql);
        return $this->db->affectedRows();
    }

    public function getSurveyLogList($args,$page,$number = 20)
    {
        $data = array(
            'select' => false,
            'table' => 'survey_log',
            'query' => $args,
            'orderby' => 'sylogid desc',
            'index' => 'sylogid'
        );
        return $this->db->listElements($page,$number,$data);
    }

    public function getSurveyLogById($sylogid)
    {
        $data = array(false,'survey_log',array(array("AND","sylogid = :sylogid",'sylogid',$sylogid)));
        $sql = $this->db->makeSelect($data);
        return $this->db->fetch($sql);
    }

    public function getSurveyLogsByArgs($args,$orderby = "sylogid desc")
    {
        $data = array(false,'survey_log',$args,false,$orderby,false);
        $sql = $this->db->makeSelect($data);
        return $this->db->fetchAll($sql,NULL);
    }

    public function getSurveyLogByArgs($args)
    {
        $data = array(false,'survey_log',$args,false,false,1);
        $sql = $this->db->makeSelect($data);
        return $this->db->fetch($sql);
    }

    public function addSurveyLog($args)
    {
        $data = array('survey_log',$args);
        $sql = $this->db->makeInsert($data);
        $this->db->exec($sql);
        return $this->db->lastInsertId();
    }

    public function modifySurveyLog($sylogid,$args)
    {
        $data = array('survey_log',$args,array(array("AND","sylogid = :sylogid",'sylogid',$sylogid)));
        $sql = $this->db->makeUpdate($data);
        $this->db->exec($sql);
        return true;
    }

    public function delSurveyLog($sylogid)
    {
        $data = array('survey_log',array(array("AND","sylogid = :sylogid",'sylogid',$sylogid)));
        $sql = $this->db->makeDelete($data);
        $this->db->exec($sql);
        return $this->db->affectedRows();
    }
}

?>