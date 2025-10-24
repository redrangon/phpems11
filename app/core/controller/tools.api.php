<?php
/*
 * Created on 2016-5-19
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 
set_time_limit(0);
class action extends app
{
	public function display()
	{
        $this->area = M('area');
	    $action = $this->ev->url(3);
		if(!method_exists($this,$action))
		$action = "index";
		$this->$action();
		exit;
	}

    private function getAjaxProvince()
    {
        $provinces = $this->area->getProvinces();
        echo "<option value=\"\">请选择省</option>\n";
        $current = $this->ev->get('current');
        foreach($provinces as $province)
        {
            if($province['provinceid'] == $current)
                echo '<option value="'.$province['provinceid'].'" selected>'.$province['province']."</option>\n";
            else
                echo '<option value="'.$province['provinceid'].'">'.$province['province']."</option>\n";
        }
    }

    private function getAjaxCity()
    {
        $pid = $this->ev->get('pid');
        $current = $this->ev->get('current');
        if($current && !$pid)
        {
            $ccity = $this->area->getCityById($current);
            $cities = $this->area->getCitiesByProvince($ccity['father']);
        }
        else
        {
            $cities = $this->area->getCitiesByProvince($pid);
        }
        echo "<option value=\"\">请选择城市</option>\n";
        foreach($cities as $city)
        {
            if($city['cityid'] == $current)
                echo '<option value="'.$city['cityid'].'" selected>'.$city['city']."</option>\n";
            else
                echo '<option value="'.$city['cityid'].'">'.$city['city']."</option>\n";
        }
    }

    private function getAjaxCityArea()
    {
        $cid = $this->ev->get('cid');
        $current = $this->ev->get('current');
        if($current && !$cid)
        {
            $ccity = $this->area->getCityAreaById($current);
            $areas = $this->area->getAreasByCity($ccity['father']);
        }
        else
            $areas = $this->area->getAreasByCity($cid);
        echo "<option value=\"\">请选择区县</option>\n";
        foreach($areas as $area)
        {
            if($area['areaid'] == $current)
                echo '<option value="'.$area['areaid'].'" selected>'.$area['area']."</option>\n";
            else
                echo '<option value="'.$area['areaid'].'">'.$area['area']."</option>\n";
        }
    }

	public function index()
	{
		exit;
	}
}


?>
