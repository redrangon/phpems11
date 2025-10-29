<?php
namespace PHPEMS;
define("PE_VERSION",'11');
define("PEPATH",dirname(__FILE__));
require PEPATH."/lib/system.func.php";
ginkgo::run();