<?php
namespace PHPEMS;

require_once(PEPATH."/lib/include/qrcode/qrcode.cls.php");

class peqr
{
    public function pngString($data,$full = 1)
	{
		ob_start();
		\QRcode::pngString($data);
		$out = base64_encode(ob_get_contents());
		ob_end_clean();
		if($full)$out = "data:image/png;base64,".$out;
		return $out;
	}
}