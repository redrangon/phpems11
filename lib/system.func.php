<?php
namespace PHPEMS;
session_start();
ini_set("display_errors","on");
error_reporting(E_ERROR || E_PARSE);
require PEPATH."/lib/init.cls.php";
function M($G,$app = NULL,$param = 'default'){
    if($G == 'db')$G = 'pepdo';
    return ginkgo::make($G,$app,$param);
}
function R($message){
	ginkgo::R($message);
}
ginkgo::loadMoudle();
ginkgo::run();