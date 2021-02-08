<?php


function jsonErr($e)
{
    $debug = !app()->environment('production');
    return response()->json($debug ? ['code' => 1001, 'msg' => $e->getMessage(), 'line' => $e->getLine(),
        'file' => $e->getFile(), 'trace' => $e->getTrace(),] : ['code' => 1001, 'msg' => '系统错误',]);
}

function imgSrcToRealUrl($value)
{
    //替换img src路径
    $http = \Illuminate\Support\Facades\Request::server('HTTP_HOST');
    $regex = "/src=[\'|\"](.*?(?:[\.jpg|\.jpeg|\.png|\.gif|\.bmp]))[\'|\"].*?[\/]?/";
    $src = "src='".$http.'${1}\'';
    return $content =  preg_replace($regex, $src, $value);
}

/**
 * 生成随机字符串，数字，大小写字母随机组合
 *
 * @param int $length  长度
 * @param int $type    类型，1 纯数字，2 纯小写字母，3 纯大写字母，4 数字和小写字母，5 数字和大写字母，6 大小写字母，7 数字和大小写字母
 */
function generateRandomStr(int $length=6,int $type = 1){
        // 取字符集数组
        $number = range(0, 9);
        $lowerLetter = range('a', 'z');
        $upperLetter = range('A', 'Z');
        // 根据type合并字符集
        if ($type == 1) {
            $charset = $number;
        } elseif ($type == 2) {
            $charset = $lowerLetter;
        } elseif ($type == 3) {
            $charset = $upperLetter;
        } elseif ($type == 4) {
            $charset = array_merge($number, $lowerLetter);
        } elseif ($type == 5) {
            $charset = array_merge($number, $upperLetter);
        } elseif ($type == 6) {
            $charset = array_merge($lowerLetter, $upperLetter);
        } elseif ($type == 7) {
            $charset = array_merge($number, $lowerLetter, $upperLetter);
        } else {
            $charset = $number;
        }
        $str = '';
        // 生成字符串
        for ($i = 0; $i < $length; $i++) {
            $str .= $charset[mt_rand(0, count($charset) - 1)];
            // 验证规则
            if ($type == 4 && strlen($str) >= 2) {
                if (!preg_match('/\d+/', $str) || !preg_match('/[a-z]+/', $str)) {
                    $str = substr($str, 0, -1);
                    $i = $i - 1;
                }
            }
            if ($type == 5 && strlen($str) >= 2) {
                if (!preg_match('/\d+/', $str) || !preg_match('/[A-Z]+/', $str)) {
                    $str = substr($str, 0, -1);
                    $i = $i - 1;
                }
            }
            if ($type == 6 && strlen($str) >= 2) {
                if (!preg_match('/[a-z]+/', $str) || !preg_match('/[A-Z]+/', $str)) {
                    $str = substr($str, 0, -1);
                    $i = $i - 1;
                }
            }
            if ($type == 7 && strlen($str) >= 3) {
                if (!preg_match('/\d+/', $str) || !preg_match('/[a-z]+/', $str) || !preg_match('/[A-Z]+/', $str)) {
                    $str = substr($str, 0, -2);
                    $i = $i - 2;
                }
            }
        }
        return $str;
}


/**
 * 拼接批量更新的sql语句
 *
 * @array $result 数据更新数组
 * @string $whenField 本次更新数据中不重复的数据库字段
 * @array $hierarchys 本次更新数据中需要加减的数组  ['num'=>'-']
 *
 * @return array
 */
function batchUpdate(array $result = [], $whenField = 'id', $hierarchys = [])
{
    $when = [];
    $update = collect($result);
    foreach ($update->all() as $sets) {
        $whenValue = $sets[$whenField];
        foreach ($sets as $fieldName => $value) {
            if ($fieldName == $whenField) {
                continue;
            }
            if (is_null($value)) {
                $value = ' ';
            }
            if (isset($hierarchys[$fieldName])) {
                $value = $fieldName . $hierarchys[$fieldName] . $value;
            } else {
                $value = "'" . $value . "'";
            }
            $when[$fieldName][] =
                "when {$whenField} = '{$whenValue}' then " . $value;
        }
    }
    foreach ($when as $fieldName => &$item) {
        $item = DB::raw("case " . implode(' ', $item) . ' end ');
    }
    return $when;
}

/**
 *计算某个经纬度的周围某段距离的正方形的四个点
 *
 *@param float lng float 经度
 *@param float lat float 纬度
 *@param float distance float 该点所在圆的半径，该圆与此正方形内切，默认值为0.5千米
 *@return array 正方形的四个点的经纬度坐标
 */
function distance($lng, $lat, $distance=0.5) {
    $earth_radius = 6371;//地球半径，平均半径为6371km
    $dlng =  2 * asin(sin($distance / (2 * $earth_radius)) / cos(deg2rad($lat)));
    $dlng = rad2deg($dlng);

    $dlat = $distance/$earth_radius;
    $dlat = rad2deg($dlat);

    return array(
        'left-top'=>array('lat'=>$lat + $dlat,'lng'=>$lng-$dlng),
        'right-top'=>array('lat'=>$lat + $dlat, 'lng'=>$lng + $dlng),
        'left-bottom'=>array('lat'=>$lat - $dlat, 'lng'=>$lng - $dlng),
        'right-bottom'=>array('lat'=>$lat - $dlat, 'lng'=>$lng + $dlng)
    );
}

/**
 * 格式化时间显示  n分钟前 n天前
 * @param $time
 * @return string
 */
function format_date($time){

    $time = ctype_digit($time)?$time:strtotime($time);
    $t=time()-$time;
    $f=array(
        '31536000'=>'年',
        '2592000'=>'个月',
        '604800'=>'星期',
        '86400'=>'天',
        '3600'=>'小时',
        '60'=>'分钟',
        '1'=>'秒'
    );
    foreach ($f as $k=>$v)    {
        if (0 !=$c=floor($t/(int)$k)) {
            return $c.$v.'前';
        }
    }
}

/**
 * 二维数组排序
 * @param $arrays
 * @param $sort_key
 * @param int $sort_order
 * @param int $sort_type
 * @return bool
 */
function sortArr($arrays,$sort_key,$sort_order=SORT_ASC,$sort_type=SORT_NUMERIC ){
    $key_arrays =array();
    if(is_array($arrays)){
        foreach ($arrays as $array){
            if(is_array($array)){
                $key_arrays[] = $array[$sort_key];
            }else{
                return false;
            }
        }
    }else{
        return false;
    }
    array_multisort($key_arrays,$sort_order,$sort_type,$arrays);
    return is_array($arrays)?$arrays:[];
}

/**
 * 随机生成6位字符
 * @return string
 * @throws Exception
 */
function generateInvitation_code(){
    $code = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $rand = $code[random_int(0,25)]
        .strtoupper(dechex(date('m')))
        .date('d')
        .substr(time(),-5)
        .substr(microtime(),2,5)
        .sprintf('%02d',rand(0,99));
    for(
        $a = md5( $rand, true ),
        $s = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ',
        $d = '',
        $f = 0;
        $f < 6;
        $g = ord( $a[ $f ] ),
        $d .= $s[ ( $g ^ ord( $a[ $f + 8 ] ) ) - $g & 0x1F ],
        $f++
    );

    return $d;
}

/**
<<<<<<< HEAD
 * 判断二维数组内是否有某个数组
 * @param $parents
 * @param $searched
 * @return bool|int|string
 */
function multidimensional_search($parents, $searched) {
    if (empty($searched) || empty($parents)) {
        return false;
    }

    foreach ($parents as $key => $value) {
        $exists = true;
        foreach ($searched as $skey => $svalue) {
            $exists = ($exists && IsSet($parents[$key][$skey]) && $parents[$key][$skey] == $svalue);
        }
        if($exists){ return $key; }
    }


    return false;
}


function getWideHeight($url)
{
    $getSize = $url . '?spm=qipa250&x-oss-process=video/snapshot,t_7000,f_jpg';
    $getSize = getimagesize($getSize);
    return $getSize;
}
