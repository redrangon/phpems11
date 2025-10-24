<?php

namespace PHPEMS;

class recog
{
    /**
     * @var string 身份证照片图像路径。
     */
    private $image_path;

    /**
     * @var resource 身份证处理图像资源句柄。
     */
    private $img;

    /**
     * @var array 协方差矩阵逆矩阵。
     */
    static private $pooled_cov_inv = array(
        array(0.00710845672853204, 0.0039446711283805, 0.00116497399796239, 0.00221331994831941, 0.00131940301426123, 0.00157461941628086, 0.00319800005056393, 0.00226498196158488, 0.00110922438962248, 0.00135182886257559, -0.00384480752553024, -0.00350175038073242, -0.00284470183449717, -0.00244184054418538, -0.0046703286465042),
        array(0.0039446711283805, 0.00941449553607874, -0.00156678041438081, 0.00514021650842889, 0.00117317575829987, 0.000659537873258636, 0.00327163646216167, 0.00260263349006258, 0.000803336226523026, 0.00085103599011712, -0.00348208011375717, -0.00412489047687407, -0.00358665867806154, -0.00349444355315733, -0.00408154889941768),
        array(0.00116497399796239, -0.00156678041438082, 0.0199445265460817, -0.00832546458964705, 0.00224531038062372, 0.00183773872494236, 0.00169440537533953, -0.00490795483205157, 0.00141747856551286, 0.000304442062153529, -0.00126404065000818, -0.00203083032124226, -0.00197310838038498, -0.00322238699379759, -0.002088018954331),
        array(0.00221331994831941, 0.00514021650842889, -0.00832546458964704, 0.0225448802702108, -0.00307013556528412, -0.000382540187844993, 0.000312101204709124, 0.00334047311403818, -0.00161315213556878, 0.000753379347939048, -0.00174524623795882, -0.00206802194006454, -0.0037351611351895, -0.00194125513622051, -0.00276588300177873),
        array(0.00131940301426122, 0.00117317575829987, 0.00224531038062372, -0.00307013556528413, 0.0159689117962463, -0.00149784355781548, 0.000346755378208585, 0.00170551077094237, 0.00241677990664607, 0.0018156746165767, -0.00285346285054146, -0.00364189419805494, -0.00303367801308524, -0.00283257545452448, -0.00288254849789108),
        array(0.00157461941628086, 0.000659537873258648, 0.00183773872494236, -0.00038254018784498, -0.00149784355781547, 0.0212200137877075, -0.00568659059697146, 0.000922350403276974, 0.0030194458906049, 0.000344557189141248, -0.00246199024852513, -0.00245003453136874, -0.00360268396078748, -0.0035880817445959, -0.00401352671993961),
        array(0.00319800005056392, 0.00327163646216166, 0.00169440537533953, 0.000312101204709112, 0.000346755378208579, -0.00568659059697147, 0.0213137819888336, -0.00584294827133668, 0.00214888264527886, 0.000976689675983129, -0.00280682353001263, -0.00292750177420907, -0.00329472240040449, -0.00266977074601445, -0.00322435982757423),
        array(0.00226498196158488, 0.00260263349006258, -0.00490795483205157, 0.00334047311403819, 0.00170551077094238, 0.000922350403276972, -0.00584294827133667, 0.0222397895289423, -0.00065479959464453, 0.00296404543556003, -0.00288649193719865, -0.00253915179101506, -0.00358665812129274, -0.00244322713719601, -0.00333458160257149),
        array(0.00110922438962248, 0.000803336226523022, 0.00141747856551286, -0.00161315213556878, 0.00241677990664606, 0.00301944589060489, 0.00214888264527887, -0.00065479959464453, 0.00971671675951504, 0.00278394413831865, -0.0027536516250455, -0.0034828211357343, -0.00285855387168301, -0.0029942294883606, -0.00331270782662298),
        array(0.00135182886257559, 0.000851035990117119, 0.000304442062153529, 0.000753379347939048, 0.0018156746165767, 0.000344557189141241, 0.000976689675983133, 0.00296404543556003, 0.00278394413831865, 0.0087138260201973, -0.00338791565853486, -0.00280225824296423, -0.00210533988784246, -0.00136656282124493, -0.00388098814575398),
        array(-0.00384480752553024, -0.00348208011375718, -0.00126404065000818, -0.00174524623795882, -0.00285346285054146, -0.00246199024852512, -0.00280682353001264, -0.00288649193719865, -0.0027536516250455, -0.00338791565853487, 0.00572958017723214, 0.0044486557337598, 0.00325637872134912, 0.00252256677411048, 0.00453513197852907),
        array(-0.00350175038073242, -0.00412489047687407, -0.00203083032124226, -0.00206802194006453, -0.00364189419805494, -0.00245003453136873, -0.00292750177420907, -0.00253915179101506, -0.0034828211357343, -0.00280225824296423, 0.0044486557337598, 0.00694332472854774, 0.00328322918478732, 0.00279312313862495, 0.00370520475329374),
        array(-0.00284470183449717, -0.00358665867806154, -0.00197310838038499, -0.0037351611351895, -0.00303367801308524, -0.00360268396078747, -0.0032947224004045, -0.00358665812129273, -0.00285855387168301, -0.00210533988784246, 0.00325637872134912, 0.00328322918478732, 0.00639019798613423, 0.00364943113202557, 0.00454627780146313),
        array(-0.00244184054418538, -0.00349444355315733, -0.00322238699379759, -0.00194125513622051, -0.00283257545452448, -0.00358808174459589, -0.00266977074601445, -0.002443227137196, -0.0029942294883606, -0.00136656282124493, 0.00252256677411048, 0.00279312313862495, 0.00364943113202557, 0.0056909340972842, 0.00417245977402912),
        array(-0.0046703286465042, -0.00408154889941768, -0.00208801895433101, -0.00276588300177872, -0.00288254849789108, -0.00401352671993959, -0.00322435982757424, -0.00333458160257149, -0.00331270782662298, -0.00388098814575398, 0.00453513197852907, 0.00370520475329374, 0.00454627780146313, 0.00417245977402912, 0.00757805238875424),
    );

    /**
     * @var array 均值向量。
     */
    static private $means = array(
        '0' => array(82.0967741935484, 94.1612903225806, 75.9032258064516, 79.258064516129, 80.6612903225806, 79.3064516129032, 78.0645161290323, 77.741935483871, 86.5322580645161, 93.5322580645161, 142.790322580645, 130.774193548387, 63.4032258064516, 88.8709677419355, 171.516129032258),
        '1' => array(50.8076923076923, 79.9102564102564, 78.5, 49.7307692307692, 41.2435897435897, 40.7051282051282, 40.7179487179487, 39.6666666666667, 38.525641025641, 34.2692307692308, 0.423076923076923, 34.6923076923077, 82.6794871794872, 225.641025641026, 9.41025641025641),
        '2' => array(82.9111111111111, 76.5111111111111, 36.7777777777778, 39.5777777777778, 50.7111111111111, 54.9111111111111, 49.2888888888889, 37.8666666666667, 53.6444444444444, 127.2, 37.8222222222222, 118.2, 100.266666666667, 110.688888888889, 71.8666666666667),
        '3' => array(137.114285714286, 85.3142857142857, 52.2571428571429, 57, 80.6571428571429, 52.1142857142857, 38.0857142857143, 39.3142857142857, 75.9142857142857, 106.485714285714, 49.2571428571429, 81.4, 133.342857142857, 157.828571428571, 103.571428571429),
        '4' => array(31.08, 37.04, 36.92, 41.36, 57.8, 78.72, 121.16, 140.16, 46.56, 32.68, 48.48, 110.24, 110.6, 117.2, 60.92),
        '5' => array(104.227272727273, 73.4090909090909, 39.7727272727273, 74.6363636363636, 89.2272727272727, 43.6363636363636, 36.1363636363636, 39.9545454545455, 56.9090909090909, 79.1363636363636, 45.4545454545455, 122.590909090909, 102.045454545455, 125.090909090909, 59.7272727272727),
        '6' => array(27.4285714285714, 39, 43.1428571428571, 70.4285714285714, 117.428571428571, 79.2857142857143, 71.7142857142857, 75.2857142857143, 86.5714285714286, 79.8571428571429, 59.7142857142857, 125, 112.857142857143, 107.857142857143, 93.1428571428571),
        '7' => array(151.75, 86.0833333333333, 43.4166666666667, 46.0833333333333, 43.9166666666667, 43.8333333333333, 42, 38.8333333333333, 44.3333333333333, 33.25, 26.75, 114.333333333333, 130.75, 88.8333333333333, 56.75),
        '8' => array(72.6538461538462, 105.615384615385, 90.2692307692308, 104.653846153846, 99.5384615384615, 109.346153846154, 94.0769230769231, 90.7692307692308, 107.461538461538, 93.8076923076923, 90.2307692307692, 182.230769230769, 131.576923076923, 175.461538461538, 116.923076923077),
        '9' => array(80.0666666666667, 96.5111111111111, 75.2222222222222, 75.4222222222222, 87.8222222222222, 117.911111111111, 76.7555555555556, 44.9555555555556, 43.4888888888889, 40.6666666666667, 72.6, 108.022222222222, 115.355555555556, 124.288888888889, 112.933333333333),
        'x' => array(55.125, 78.875, 87.5, 84.5, 67, 64.125, 86.625, 88, 81.375, 65.75, 67.125, 140.25, 116.875, 146.625, 79.2),
    );

    /**
     * @var bool 是否输出消息。
     */
    static private $show_message = true;

    /**
     * @var int 紧缩图像时认为是前景部分的阈值（百分比，例如 3 代表该行／列前景色超过 3% 则被认为是前景部分）。
     */
    static private $screening_threshold = 1;

    /**
     * @var int 霍夫参数空间大小（粒度）。100 表示 PI 被分成 100 等分。
     */
    static private $hough_space_size = 314;

    /**
     * 构造函数。
     *
     * @param $img_path string 身份证照片图像路径。
     */
    public function __construct() {
        //
    }

    public function loadImg($img_path)
    {
        $this->image_path = $img_path;
    }

    /**
     * 输出消息。
     *
     * @param $message string 消息。
     */
    private function show_message($message) {

        if (self::$show_message) {
            echo "{$message}\n";
        }
    }

    /**
     * 识别身份证照片中的身份证号。
     *
     * @return string 身份证号。
     *
     * @throws Exception
     */
    public function recognize_id_number() {

        $this->show_message('Start processing. Image: ' . $this->image_path . '.');

        $this->get_image();
        $this->show_message('Image got. ' . imagesx($this->img) . ' x ' . imagesy($this->img) . '.');

        $tmp = $this->sobel_edge();
        $this->show_message('Find edge by SOBEL filter.');
        $this->output("sobel", $tmp);
        list($left, $right, $top, $bottom) = $this->hough($tmp);
        $this->show_message("Find card by Hough Transform. Left: {$left} Right: {$right} Top: {$top} Bottom: {$bottom}.");

        $this->cut_card($left, $right, $top, $bottom);
        $this->show_message("Cut card.");
        $this->output("cut", $this->img);

        $this->cut_id_number();
        $this->show_message("Cut id number.");
        $this->output("id", $this->img);

        $this->black_and_white();
        $this->show_message("Black & White id number.");
        $this->output("id_bw", $this->img);

        $this->img = $this->screening($this->img);
        $this->show_message("Screening id number.");
        $this->output("id_screen", $this->img);

        $c_arr = $this->split();
        $this->show_message("Split numbers.");
        for ($i = 0; $i < count($c_arr); $i++) {
            $this->output("{$i}", $c_arr[$i]);
        }

        $id_number = '';
        foreach ($c_arr as $c) {
            $id_number .= $this->recognize($c);
        }

        $this->show_message("The result is {$id_number}.");
        return $id_number;
    }

    /**
     * 从原始图像中切割出身份证部分。
     *
     * @param $left   int 身份证左边缘。
     * @param $right  int 身份证右边缘。
     * @param $top    int 身份证上边缘。
     * @param $bottom int 身份证下边缘。
     *
     * @throws Exception
     */
    private function cut_card($left, $right, $top, $bottom) {

        if ($right <= $left || $bottom <= $top) {
            return;
        }

        $dst_width = $right - $left;
        $dst_height = $bottom - $top;

        if (!$tmp = imagecreatetruecolor($dst_width, $dst_height)) {
            throw new \Exception('cut_card: Allocate temp image failed');
        }

        if (!imagecopy($tmp, $this->img, 0, 0, $left, $top, $dst_width, $dst_height)) {
            throw new \Exception('cut_card: Copy image failed');
        }

        $gabbage = $this->img;
        $this->img = $tmp;
        imagedestroy($gabbage);
    }

    /**
     * 将身份证号部分切割出来。
     *
     * @throws Exception
     */
    private function cut_id_number() {

        $width = imagesx($this->img);
        $height = imagesy($this->img);

        $left = 0.31 * $width;
        $top = 0.83 * $height;

        $dst_width = 2.0 / 3.3 * $width;
        $dst_height = 0.15 * $height;

        if (!$tmp = imagecreatetruecolor($dst_width, $dst_height)) {
            throw new \Exception('cut: Allocate temp image failed');
        }

        if (!imagecopy($tmp, $this->img, 0, 0, $left, $top, $dst_width, $dst_height)) {
            throw new \Exception('screening: Copy image failed');
        }

        $gabbage = $this->img;
        $this->img = $tmp;
        imagedestroy($gabbage);
    }

    /**
     * 获取分割的身份证数字。
     *
     * @return array 身份证数字图像对象资源句柄数组。
     *
     * @throws Exception
     */
    private function split() {

        $width = imagesx($this->img);
        $height = imagesy($this->img);

        $histgram = array();
        for ($i = 0; $i < $width; $i++) {
            $number = 0;
            for ($j = 0; $j < $height; $j++) {
                $rgb = imagecolorat($this->img, $i, $j);
                $r = ($rgb >> 16) & 0xFF;
                if ($r === 0) {
                    $number++;
                }
            }

            $histgram[$i] = round((float)$number / $height * 100);
        }

        /**原来部分**
        $in = false;
        $left = 0;

        $c_arr = array();
        $w = ceil($width / 18);
        foreach ($histgram as $i => $n) {
            if ($n > 10 && !$in) {
                $in = true;
                $left = $i;
            }

            if ($in && $n < 10) {
                $in = false;
                $c_width = $i - $left;

                if (!$tmp = imagecreatetruecolor($w, $height)) {
                    throw new \Exception('split: Allocate image failed');
                }
                if (!imagefill($tmp, 0, 0, imagecolorallocate($tmp, 255, 255, 255))) {
                    throw new \Exception('split: Fill image failed');
                }
                if (!imagecopy($tmp, $this->img, ($w - $c_width) / 2, 0, $left, 0, $c_width, $height)) {
                    throw new \Exception('split: Copy image failed');
                }

                $tmp = $this->screening($tmp);
                $c_arr[] = $tmp;
            }
        }

        // 最后一个字符。
        if ($in) {
            $c_width = $width - $left;
            if (!$tmp = imagecreatetruecolor($w, $height)) {
                throw new \Exception('split: Allocate image failed');
            }
            if (!imagefill($tmp, 0, 0, imagecolorallocate($tmp, 255, 255, 255))) {
                throw new \Exception('split: Fill image failed');
            }
            if (!imagecopy($tmp, $this->img, ($w - $c_width) / 2, 0, $left, 0, $c_width, $height)) {
                throw new \Exception('split: Copy image failed');
            }

            $tmp = $this->screening($tmp);
            $c_arr[] = $tmp;
        }
        ** * **/

        /****我自己写的部分***/
        $w = ceil($width / 18);
        $c_arr = [];
        $oldtype = 0;
        $pics = [];
        $oldi = 0;
        $tw = 0;
        $number = 0;
        foreach($histgram as $i => $n)
        {
            if($n > 1)
            {
                $type = 1;
            }
            else $type = 0;
            if($oldtype != $type)
            {
                if($i > 0)
                {
                    $tmp = array('type' => $oldtype,'width' => $i - $oldi,'left' => $oldi);
                    $pics[] = $tmp;
                    $oldi = $i;
                    if($oldtype)$tw += $tmp['width'];
                    $number++;
                }
                $oldtype = $type;
            }
        }
        $tmp = array('type' => $oldtype,'width' => $i - $oldi,'left' => $oldi);
        $pics[] = $tmp;
        $npics = [];
        $avgw = intval($tw/$number);
        foreach($pics as $id => $pic)
        {
            if(!$pic['type'] && $pic['width'] > 3*$avgw)
            {
                $npics = [];
            }
            if($pic['type'])$npics[] = $pic;
            if(count($npics) >= 18)break;
        }
        foreach($npics as $pic)
        {
            if (!$tmp = imagecreatetruecolor($w, $height)) {
                throw new \Exception('split: Allocate image failed');
            }
            if (!imagefill($tmp, 0, 0, imagecolorallocate($tmp, 255, 255, 255))) {
                throw new \Exception('split: Fill image failed');
            }
            if (!imagecopy($tmp, $this->img, ($w - $pic['width']) / 2, 0, $pic['left'], 0, $pic['width'], $height)) {
                throw new \Exception('split: Copy image failed');
            }
            $tmp = $this->screening($tmp);
            $c_arr[] = $tmp;
        }
        /****/

        foreach ($c_arr as $key => $i) {
            $width = imagesx($i);
            $height = imagesy($i);

            $w = 0.7 * $height;
            $h = $height;

            if (!$t = imagecreatetruecolor($w, $h)) {
                throw new \Exception('split: Allocate image failed');
            }
            if (!imagefill($t, 0, 0, imagecolorallocate($tmp, 255, 255, 255))) {
                throw new \Exception('split: Fill image failed');
            }
            if (!imagecopy($t, $i, ($w - $width) / 2, ($h - $height) / 2, 0, 0, $width, $height)) {
                throw new \Exception('split: Copy image failed');
            }

            $t = $this->resize($t);

            $c_arr[$key] = $t;

        }

        return $c_arr;
    }

    /**
     * 将图像二值化。
     *
     * @throws Exception
     */
    private function black_and_white() {

        $width = imagesx($this->img);
        $height = imagesy($this->img);

        for ($i = 0; $i < $width; $i++) {
            for ($j = 0; $j < $height; $j++) {
                $rgb = imagecolorat($this->img, $i, $j);
                $r = ($rgb >> 16) & 0xFF;
                $g = ($rgb >> 8) & 0xFF;
                $b = $rgb & 0xFF;

                $m = ($r + $g + $b) / 3;

                $grey = $m < 100 ? 0 : 255;
                if (!imagesetpixel($this->img, $i, $j, imagecolorallocate($this->img, $grey, $grey, $grey))) {
                    throw new \Exception("Black and white. Set pixcel failed. x={$i}, y={$j}");
                }
            }
        }
    }

    /**
     * hough 算法检测直线。
     *
     * @param $img resource sobel 算子查找边缘之后的二值图像对象。
     *
     * @return array 身份真边缘，分别是左、右、上、下。
     *
     * @throws Exception
     */
    private function hough($img) {

        $width = imagesx($img);
        $height = imagesy($img);

        $centerX = $width / 2;
        $centerY = $height / 2;
        $hough_interval = (M_PI / 2.0) / (float)self::$hough_space_size;

        $hough_2d = array();
        for ($i = 0; $i < $width; $i++) {
            for ($j = 0; $j < $height; $j++) {
                $rgb = imagecolorat($img, $i, $j);
                if (!$grey = ($rgb >> 16) & 0xFF) {
                    continue;
                }

                for ($cell = 0; $cell < self::$hough_space_size; $cell++) {
                    $r = (int)(($i - $centerX) * cos($cell * $hough_interval) + ($j - $centerY) * sin($cell * $hough_interval));
                    $hough_2d["{$cell}_{$r}"] += 1;
                    //$r = intval($i * cos($cell * $hough_interval) + $j * sin($cell * $hough_interval));
                    //$hough_2d["{$cell}_{$r}"] += 1;
                }
            }
        }


        arsort($hough_2d);
        $max_freq = 0;

        $lines = array();
        foreach ($hough_2d as $param => $freq) {

            // 如果频数小于最大频数的 20% ，忽略之。
            if ($max_freq === 0) {
                $max_freq = $freq;
            } elseif ($freq < $max_freq * 0.2) {
                break;
            }

            list($cell, $r) = explode('_', $param);
            $theta = $cell * $hough_interval / (M_PI / 2.0) * 90.0;

            if (count($lines)) {
                $has_neighbor = false;
                foreach ($lines as $idx => $l) {
                    $ptheta = $l['t'];
                    $pr = $l['r'];
                    $pc = $l['c'];

                    if (abs($theta - $ptheta) < 2 && abs($r - $pr) < 2) {
                        $lines[$idx]['t'] = ($ptheta * $pc + $theta) / ($pc + 1);
                        $lines[$idx]['r'] = ($pr * $pc + $r) / ($pc + 1);
                        $lines[$idx]['c']++;
                        $has_neighbor = true;
                        break;
                    }
                }

                if (!$has_neighbor) {
                    $lines[] = array('t' => $theta, 'r' => $r, 'c' => 1);
                }
            } else {
                $lines[] = array('t' => $theta, 'r' => $r, 'c' => 1);
            }


        }


        $horizental = array();
        $vertical = array();
        foreach ($lines as $line) {
            if($line['t'] <= 3) {
                if(abs($line['r']) <= ($width / 2.0))$horizental[] = $line['r'];//超出范围的截取无意义
            }

            if($line['t'] >= 87.5) {
                if(abs($line['r']) <= ($height / 2.0))$vertical[] = $line['r'];//超出范围的截取无意义
            }
        }

        if(count($horizental) < 2 || count($vertical) < 2) {
            throw new \Exception('Failed to find edges');
        }

        $left = round(min($horizental) + $width / 2.0);
        $right = round(max($horizental) + $width / 2.0);

        $top = round(min($vertical) + $height / 2.0);
        $bottom = round(max($vertical) + $height / 2.0);

        /**
        $left = round(min($horizental));
        $right = round(max($horizental));

        $top = round(min($vertical));
        $bottom = round(max($vertical)); * **/
        return array($left, $right, $top, $bottom);
    }

    /**
     * sobel 算子边缘检测。
     *
     *
     * @return resource Sobel 算子检测边缘后的黑白而至图像资源句柄。
     */
    private function sobel_edge() {

        $width = imagesx($this->img);//获取图像宽度
        $height = imagesy($this->img);//获取图像高度

        if (!$tmp = imagecreatetruecolor($width, $height)) {
            throw new \Exception('sobel_edge: Allocate image failed');//创建同宽高图像
        }

        if (!imagefill($tmp, 0, 0, imagecolorallocate($tmp, 255, 255, 255))) {
            throw new \Exception('sobel_edge: Fill image failed');//图像填充为白色
        }

        // 首先将图像灰度化，存副本。
        $sdata = array();
        for ($i = 0; $i < $width; $i++) {
            for ($j = 0; $j < $height; $j++) {
                $rgb = imagecolorat($this->img, $i, $j);//获取图像所有像素点的索引值
                $r = ($rgb >> 16) & 0xFF;//获取R值
                $g = ($rgb >> 8) & 0xFF;//获取G值
                $b = $rgb & 0xFF;//获取B值
                $grey = ($r + $g + $b) / 3;//平均值法
                $grey = 0.299*$r + 0.587*$g + 0.114*$b;//加权平均法
                $grey = $r;//只使用红色通道

                $sdata[$i][$j] = $grey;
            }
        }

        /** 下文至注释前为自己写
         * sobel算子是用灰度乘以水平方向的算子的每个值，并将其相加，得到X
         * 灰度乘以垂直方向的算子的每个值，并将其相加，得到Y
         * 计算X^2+Y^2之和的平方根，得到梯度值
         **/
        /****/
        $operatorX = [[-1, 0, 1], [-2, 0, 2], [-1, 0, 1]];//sobel算子法水平方向算子
        $operatorY = [[-1, -2, -1], [0, 0, 0], [1, 2, 1]];
        $maxgradient = 0;
        $allgradient = 0;
        $gradientMatrix = [];
        for($i = 0;$i < $width;$i++)
        {
            for ($j = 0; $j < $height; $j++) {
                // 进行Sobel算子运算
                $xp = 0;
                $yp = 0;

                //生成原图矩阵,以i,j处像素为中心的9个像素形成的矩阵
                $martix = array(
                    array($sdata[$i-1][$j-1]?$sdata[$i-1][$j-1]:0,$sdata[$i][$j-1]?$sdata[$i][$j-1]:0,$sdata[$i+1][$j-1]?$sdata[$i+1][$j-1]:0),
                    array($sdata[$i-1][$j]?$sdata[$i-1][$j]:0,$sdata[$i][$j]?$sdata[$i][$j]:0,$sdata[$i+1][$j]?$sdata[$i+1][$j]:0),
                    array($sdata[$i-1][$j+1]?$sdata[$i-1][$j+1]:0,$sdata[$i][$j+1]?$sdata[$i][$j+1]:0,$sdata[$i+1][$j+1]?$sdata[$i+1][$j+1]:0)
                );
                for ($x = 0; $x < 3; $x++) {
                    for ($y = 0; $y < 3; $y++) {
                        $xp += $martix[$x][$y] * $operatorX[$x][$y];
                        $yp += $martix[$x][$y] * $operatorY[$x][$y];
                    }
                }
                //echo "{$grey}:{$xp}:{$yp}\n";
                //$gradient = sqrt($xp^2 + $yp^2);//标准计算
                $gradient = abs($xp)+abs($yp);//近似计算
                $gradient = min(255, max(0, $gradient));
                $gradientMatrix[$i][$j] = $gradient;
                $allgradient += $gradient;
                if($gradient > $maxgradient)$maxgradient = $gradient;
                /**
                $gradient = $gradient > 32?255:0;//不考虑差别过大的情况下，直接区分
                if (!imagesetpixel($tmp, $i, $j, imagecolorallocate($tmp, $gradient, $gradient, $gradient))) {
                    throw new \Exception("find_card. Set pixcel failed. x={$i}, y={$j}");
                }
                 * **/
            }
        }
        $avggradient = intval($allgradient/$width/$height);
        for($i = 0;$i < $width;$i++) {
            for ($j = 0; $j < $height; $j++) {
                //$grey = intval(255 * $gradientMatrix[$i][$j]/$maxgradient);//考虑差别的情况下，用每个像素的梯度除以最大梯度，得出比值乘以255
                //$grey = $grey > 63?255:0;//以63为基准区分，我这里想到了，是不是可以找到平均梯度来区分呢
                $grey = $gradientMatrix[$i][$j] > $avggradient?255:0;
                if (!imagesetpixel($tmp, $i, $j, imagecolorallocate($tmp, $grey, $grey, $grey))) {
                    throw new \Exception("find_card. Set pixcel failed. x={$i}, y={$j}");
                }
            }
        }
        /** * **/
        /****
        for ($i = 0; $i < $width; $i++) {
            for ($j = 0; $j < $height; $j++) {
                if ($i > 0 && $j > 0) {
                    $n0 = $sdata[$i - 1][$j - 1];
                } else {
                    $n0 = 0;
                }

                if ($j > 0) {
                    $n1 = $sdata[$i][$j - 1];
                } else {
                    $n1 = 0;
                }

                if ($j > 0 && $i < $width - 1) {
                    $n2 = $sdata[$i + 1][$j - 1];
                } else {
                    $n2 = 0;
                }

                if ($i > 0) {
                    $n3 = $sdata[$i - 1][$j];
                } else {
                    $n3 = 0;
                }

                if ($i < $width - 1) {
                    $n5 = $sdata[$i + 1][$j];
                } else {
                    $n5 = 0;
                }

                if ($j < $height - 1 && $i > 0) {
                    $n6 = $sdata[$i - 1][$j - 1];
                } else {
                    $n6 = 0;
                }

                if ($j < $height - 1) {
                    $n7 = $sdata[$i][$j + 1];
                } else {
                    $n7 = 0;
                }

                if ($j < $height - 1 && $i < $width - 1) {
                    $n8 = $sdata[$i + 1][$j + 1];
                } else {
                    $n8 = 0;
                }

                $g0 = $n0 + 2 * $n1 + $n2 - $n6 - 2 * $n7 - $n8;
                $g1 = $n1 + 2 * $n2 - $n3 + $n5 - 2 * $n6 - $n7;

                $g2 = -$n0 + $n2 - 2 * $n3 + 2 * $n5 - $n6 + $n8;
                $g3 = -2 * $n0 - $n1 - $n3 - $n5 + $n7 + 2 * $n8;

                $g4 = -$n0 - 2 * $n1 - $n2 + $n6 + 2 * $n7 + $n8;
                $g5 = -$n1 - 2 * $n2 + $n3 - $n5 + 2 * $n6 + $n7;

                $g6 = $n0 - $n2 + 2 * $n3 - 2 * $n5 + $n6 - $n8;
                $g7 = 2 * $n0 + $n1 + $n3 - $n5 - $n7 - 2 * $n8;

                $g = max($g0, $g1, $g2, $g3, $g4, $g5, $g6, $g7);

                $grey = $g > 177 ? 255 : 0;
                if (!imagesetpixel($tmp, $i, $j, imagecolorallocate($tmp, $grey, $grey, $grey))) {
                    throw new \Exception("find_card. Set pixcel failed. x={$i}, y={$j}");
                }
            }
        }
        /** **/

        return $tmp;
    }

    /**
     * 紧缩图像。
     *
     * @param $img resource 图像句柄。
     *
     * @return resource 紧缩完成后的图像资源句柄。
     *
     * @throws Exception
     */
    private function screening($img) {

        $width = imagesx($img);
        $height = imagesy($img);

        $target = 0;
        $histgram = array();
        for ($i = 0; $i < $width; $i++) {
            $number = 0;
            for ($j = 0; $j < $height; $j++) {
                $rgb = imagecolorat($img, $i, $j);
                $r = ($rgb >> 16) & 0xFF;
                if ($r === $target) {
                    $number++;
                }
            }
            $histgram[$i] = round((float)$number / $height * 100);
        }

        $left = 0;
        foreach ($histgram as $key => $n) {
            if ($n > self::$screening_threshold) {
                $left = $key;
                break;
            }
        }

        $right = $width;
        foreach (array_reverse($histgram, true) as $key => $n) {
            if ($n > self::$screening_threshold) {
                $right = $key;
                break;
            }
        }

        $histgram = array();
        for ($j = 0; $j < $height; $j++) {
            $number = 0;
            for ($i = 0; $i < $width; $i++) {
                $rgb = imagecolorat($img, $i, $j);
                $r = ($rgb >> 16) & 0xFF;
                if ($r === $target) {
                    $number++;
                }
            }
            $histgram[$j] = round((float)$number / $width * 100);

        }

        $top = 0;
        foreach ($histgram as $key => $n) {
            if ($n > self::$screening_threshold) {
                $top = $key;
                break;
            }
        }

        $bottom = $height;
        foreach (array_reverse($histgram, true) as $key => $n) {
            if ($n > self::$screening_threshold) {
                $bottom = $key;
                break;
            }
        }

        $dst_width = $right + 1 - $left > 0 ? $right + 1 - $left : 1;
        $dst_height = $bottom + 1 - $top > 0 ? $bottom + 1 - $top : 1;

        if (!$tmp = imagecreatetruecolor($dst_width, $dst_height)) {
            throw new \Exception("screening: Allocate temp image failed. [{$dst_width}/{$dst_height}]");
        }

        if (!imagefill($tmp, 0, 0, imagecolorallocate($tmp, 255, 255, 255))) {
            throw new \Exception("screening: Fill image failed");
        }

        if (!imagecopy($tmp, $img, 0, 0, $left, $top, $dst_width, $dst_height)) {
            throw new \Exception('screening: Copy image failed');
        }

        imagedestroy($img);
        return $tmp;
    }

    /**
     * 获取输入图片，转成 GD 对象。只支持 jpg 。
     *
     * @throws Exception
     */
    private function get_image() {

        if (!file_exists($this->image_path)) {
            throw new \Exception('image file dosen\'t exist. path: ' . $this->image_path);
        }

        if (!$this->img = imagecreatefromjpeg($this->image_path)) {
            throw new \Exception('get image failed. path: ' . $this->image_path);
        }
    }

    /**
     * 缩放图像。
     *
     * @param     $img    resource   图像对象
     * @param     $width  int 缩放后的宽度。
     * @param     $height int 缩放后的高度。
     *
     * @return resource 缩放后的图像对象。
     *
     * @throws Exception
     */
    private function resize($img, $width = 35, $height = 50) {

        if (!$tmp = imagecreatetruecolor($width, $height)) {
            throw new \Exception("resize: Allocate image failed");
        }
        if (!imagefill($tmp, 0, 0, imagecolorallocate($tmp, 255, 255, 255))) {
            throw new \Exception("resize: Fill image failed");
        }

        $src_width = imagesx($img);
        $src_height = imagesy($img);

        for ($i = 0; $i < $width; $i++) {
            for ($j = 0; $j < $height; $j++) {
                $rgb = imagecolorat($img, floor($i * $src_width / $width), floor($j * $src_height / $height));
                $r = ($rgb >> 16) & 0xFF;
                $grey = $r < 50 ? 0 : 255;
                imagesetpixel($tmp, $i, $j, imagecolorallocate($tmp, $grey, $grey, $grey));
            }
        }

        return $tmp;
    }

    /**
     * 识别图像中的数字。
     *
     * @param $img resource 包含一个数字的图像对象。
     *
     * @return string
     *
     * @throws Exception
     */
    public function recognize($img) {

        $width = imagesx($img);
        $height = imagesy($img);

        $v = array();
        for ($j = 0; $j < $height; $j += 5) {

            $b_count = 0;
            for ($k = 0; $k < 5; $k++) {
                for ($i = 0; $i < $width; $i++) {
                    $rgb = imagecolorat($img, $i, $j + $k);
                    $r = ($rgb >> 16) & 0xFF;

                    if ($r < 10) {
                        $b_count++;
                    }
                }
            }

            $v[] = $b_count;
        }

        for ($i = 0; $i < $width; $i += 7) {

            $b_count = 0;
            for ($k = 0; $k < 5; $k++) {
                for ($j = 0; $j < $height; $j++) {
                    $rgb = imagecolorat($img, $i + $k, $j);
                    $r = ($rgb >> 16) & 0xFF;

                    if ($r < 10) {
                        $b_count++;
                    }
                }
            }

            $v[] = $b_count;
        }

        $result = null;
        $min_dis = 10000000;
        foreach (self::$means as $c => $mean) {
            $dis = self::distance($v, $mean);//计算马氏距离
            if ($dis <= $min_dis) {
                $min_dis = $dis;
                $result = $c;
            }
        }

        return $result;

    }

    /**
     * 计算 Mahalanobis 距离。
     *
     * @param $v    array 向量 1
     * @param $mean array 向量 2
     *
     * @return float
     */
    private static function distance($v, $mean) {

        $cov_inv = self::$pooled_cov_inv;

        $md = array();
        for ($i = 0; $i < count($mean); $i++) {
            $md[] = $v[$i] - $mean[$i];
        }

        $tmp = array();
        for ($i = 0; $i < count($cov_inv); $i++) {
            $tmp[$i] = 0;
            for ($j = 0; $j < count($cov_inv[$i]); $j++) {
                $tmp[$i] += $md[$j] * $cov_inv[$i][$j];
            }
        }

        $distance = 0;
        for ($i = 0; $i < count($tmp); $i++) {
            $distance += $tmp[$i] * $md[$i];
        }

        return $distance;
    }

    /**
     * 输出图像。
     *
     * @param $name string 图像文件名。
     * @param $img  resource 图像资源句柄。
     */
    private function output($name, $img) {

        $this->show_message('Image Save: ' . "{$name}.jpg");
        imagejpeg($img, PEPATH."/data/ocr/{$name}.jpg");

    }
}