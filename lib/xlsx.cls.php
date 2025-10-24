<?php
namespace PHPEMS;

class xlsx
{
    public function getExcelContent($path,$sheet = 'Sheet1')
    {
        require_once(PEPATH . '/lib/include/xlsx/reader.cls.php');
        $reader = new xlsx\reader($path);
        if($reader)return $reader->getSheetData($sheet);
        return false;
    }

    public function putExcelContent($path,$content,$sheet = 'Sheet1')
    {
        if(empty($content))return false;
        require_once PEPATH."/lib/include/xlsx/writer.cls.php";
        $writer = new xlsx\writer();
        foreach($content as $row)
        {
            $writer->writeSheetRow($sheet, $row);
        }
        //$writer->writeToStdOut();
        //echo $writer->writeToString();
        $writer->writeToFile($path);
        return $path;
    }

    public function tounixtime($data)
    {
        return ($data - 25569)*24*3600 + 8* 3600;
    }
}
?>