<?php
 namespace PHPEMS;

class session
{
    public $G;
    public $sessionname = 'currentuser';
    public $sessionuser = false;
    public $sessionid;
    public $data;

    public function __construct()
    {
        $this->sessionid = $this->getSessionId();
    }

    //获取会话ID
    public function getSessionId2()
    {
        if(!$this->sessionid)
        {
            if($_SESSION['currentuser'])
            {
                $this->sessionid = $_SESSION['currentuser']['sessionid'];
                M("ev")->setCookie('psid',$this->sessionid,3600*24);
            }
            else
            {
                $cookie = M("strings")->decode(M("ev")->getCookie($this->sessionname));
                if($cookie)
                {
                    $this->sessionid = $cookie['sessionid'];
                    M("ev")->setCookie('psid',$this->sessionid,3600*24);
                }
                else
                    $this->sessionid = M("ev")->getCookie('psid');
            }
        }
        if(!$this->sessionid)
        {
            $this->sessionid = session_id();
            M("ev")->setCookie('psid',$this->sessionid,3600*24);
        }
        if(!$this->sessionid)
        {
            $this->sessionid = md5(TIME.rand(1000,9999));
            M("ev")->setCookie('psid',$this->sessionid,3600*24);
        }
        if(!$this->getSessionValue($this->sessionid))
        {
            $data = array('session',array('sessionid'=>$this->sessionid,'sessionuserid'=>0,'sessionip'=>M("ev")->getClientIp()));
            $sql = M("pepdo")->makeInsert($data);
            M("pepdo")->exec($sql);
        }
        return $this->sessionid;
    }

    private function _getOnlySessionid()
    {
        $code = uniqid(M("ev")->getClientIp().print_r($_SERVER,true).microtime()).rand(100000,999999);
        $this->sessionid = md5($code);
        if($this->getSessionValue($this->sessionid))
        {
            $this->_getOnlySessionid();
        }
    }

    public function getSessionId()
    {
        if(!$this->sessionid)
        {
            $cookie = M("strings")->decode(M("ev")->getCookie($this->sessionname));
            if($cookie)
            {
                $this->sessionid = $cookie['sessionid'];
            }
        }
        if(!$this->sessionid)
        {
            $this->_getOnlySessionid();
            $this->setSessionUser(array("sessionid" => $this->sessionid,'sessionip' => M("ev")->getClientIp()));
        }
        if(!$this->getSessionValue())
        {
            $this->setSessionUser(array("sessionid" => $this->sessionid,'sessionip' => M("ev")->getClientIp()));
        }
        return $this->sessionid;
    }

    //设置随机参数
    public function setRandCode($randCode = 0)
    {
        if(!$randCode)
        {
            $array = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','0','1','2','3','4','5','6','7','8','9');
            $randCode = '';
            for($i=0;$i<4;$i++)
            {
                $randCode .= $array[intval(rand(0,35))];
            }
        }
        if(!$this->sessionid)$this->getSessionId();
        $data = array('session',array('sessionrandcode'=>$randCode),array(array("AND","sessionid = :sessionid",'sessionid',$this->sessionid)));
        $sql = M("pepdo")->makeUpdate($data);
        $r = M("pepdo")->exec($sql);
        if($r)return $randCode;
        else
        {
            $data = array('session',array('sessionid'=>$this->sessionid,'sessionuserid'=>0,'sessionip'=>M("ev")->getClientIp()));
            $sql = M("pepdo")->makeInsert($data);
            M("pepdo")->exec($sql);
            return $this->setRandCode($randCode);
        }
    }

    //获取随机参数
    public function getRandCode()
    {
        if(!$this->sessionid)$this->getSessionId();
        $data = array('sessionrandcode','session',array(array('AND',"sessionid = :sessionid",'sessionid',$this->sessionid)));
        $sql = M("pepdo")->makeSelect($data);
        $r = M("pepdo")->fetch($sql);
        return $r['randcode'];
    }

    //获取会话内容
    public function getSessionValue($sessionid = NULL)
    {
        if(!$sessionid)
        {
            if(!$this->sessionid)$this->getSessionId();
            $sessionid = $this->sessionid;
        }
        if(!$this->data || !$this->data[$this->sessionid])
        {
            $data = array(false,'session',array(array('AND',"sessionid = :sessionid",'sessionid',$this->sessionid)));
            $sql = M("pepdo")->makeSelect($data);
            $this->data[$this->sessionid] = M("pepdo")->fetch($sql);
        }
        return $this->data[$this->sessionid];
    }

    //设置会话用户信息
    public function setSessionUser($args = NULL)
    {
        if(!$args)return false;
        else
        {
            if(!$args['sessiontimelimit'])$args['sessiontimelimit'] = TIME;
            if(!$this->sessionid)$this->getSessionId();
            $args['sessionid'] = $this->sessionid;
            $args['sessiontimelimit'] = TIME;
            $data = array('session',array(array('AND',"sessionid = :sessionid",'sessionid',$this->sessionid)));
            $sql = M("pepdo")->makeDelete($data);
            M("pepdo")->exec($sql);
            $data = array('session',$args);
            $sql = M("pepdo")->makeInsert($data);
            M("pepdo")->exec($sql);
            $ck = array('sessionid'=>$this->sessionid,'sessionuserid'=>$args['sessionuserid'],'sessionpassword'=>$args['sessionpassword'],'sessionip'=>$args['sessionip']);
            M("ev")->setCookie($this->sessionname,M("strings")->encode($args),3600*24);
            return true;
        }
    }

    //设置会话中其他信息
    public function setSessionValue($args = NULL)
    {
        if(!$args)return false;
        else
        {
            if(!$this->sessionid)$this->getSessionId();
            $data = array('session',$args,array(array('AND',"sessionid = :sessionid",'sessionid',$this->sessionid)));
            $sql = M("pepdo")->makeUpdate($data);
            M("pepdo")->exec($sql);
            return true;
        }
    }

    //获取会话用户
    public function getSessionUser()
    {
        if($this->sessionuser)return $this->sessionuser;
        $cookie = M("strings")->decode(M("ev")->getCookie($this->sessionname));
        if(isset($cookie['sessionuserid']) && $cookie['sessionuserid'])
        {
            $user = $this->getSessionValue();
            if($cookie['sessionuserid'] == $user['sessionuserid'] && $cookie['sessionpassword'] == $user['sessionpassword'] && $cookie['sessionip'] == $user['sessionip'])
            {
                $this->sessionuser = $user;
                return $user;
            }
        }
        return false;
    }

    //清除会话用户
    public function clearSessionUser()
    {
        if(!$this->sessionid)$this->getSessionId();
        M("ev")->setCookie($this->sessionname,NULL);
        $data = array('session',array(array('AND',"sessionid = :sessionid",'sessionid',$this->sessionid)));
        $sql = M("pepdo")->makeDelete($data);
        M("pepdo")->exec($sql);
        return true;
    }

    public function offOnlineUser($userid)
    {
        $data = array('session',array(array('AND',"sessionuserid = :sessionuserid",'sessionuserid',$userid)));
        $sql = M("pepdo")->makeDelete($data);
        M("pepdo")->exec($sql);
        return true;
    }

    //清除所有会话
    public function clearSession()
    {
        $data = array('session',array(array('AND',1)));
        $sql = M("pepdo")->makeDelete($data);
        M("pepdo")->exec($sql);
        return true;
    }

    //清除超时用户
    public function clearOutTimeUser($time)
    {
        if($time)
            $date = $time;
        else
            $date = TIME-24*3600;
        $data = array('session',array(array('AND',"sessionlogintime < :sessionlogintime",'sessionlogintime',$date)));
        $sql = M("pepdo")->makeDelete($data);
        M("pepdo")->exec($sql);
        return true;
    }

    //获取所有会话用户列表
    public function getSessionUserList($page,$number = 20)
    {
        $data = array(
            'select' => false,
            'table' => 'session',
            'index' => false,
            'serial' => false,
            'query' => array(array('AND',"sessionuserid > 0")),
            'orderby' => 'sessionlogintime DESC',
            'groupby' => false
        );
        return M("pepdo")->listElements($page,$number,$data);
    }

    public function __destruct()
    {
    	$data = array('session',array('sessionlasttime' => TIME),array(array('AND',"sessionid = :sessionid",'sessionid',$this->sessionid)));
    	$sql = M("pepdo")->makeUpdate($data);
    	M("pepdo")->exec($sql);
    	if(rand(0,5) > 4)
    	{
    		$data = array('session',array(array('AND',"sessionlasttime <= :sessionlasttime","sessionlasttime",intval((TIME - 3600*24*3)))));
	    	$sql = M("pepdo")->makeDelete($data);
	    	M("pepdo")->exec($sql);
    	}
    }
}
?>