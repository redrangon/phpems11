<?php
namespace PHPEMS;
session_start();
define("PE_VERSION",'11');
define("PEPATH",dirname(__FILE__));
require PEPATH."/lib/init.cls.php";
ginkgo::loadMoudle();
ginkgo::run();