<?php
// +----------------------------------------------------------------------
// |  [ you slogan ]
// +----------------------------------------------------------------------
// | Author: you name  and you E-mail
// +----------------------------------------------------------------------
// | Date: 2017/10/25 Time: 2:03
// +----------------------------------------------------------------------

/**
 * 自定义函数
 */


/**
 * ajax 返回数据
 * @param $code
 * @param string $msg
 */
function ajaxRes($code, $msg = ''){
    $arr = array( 'code' => $code, 'message' => $msg );
    die(json_encode($arr));
}

/**
 * 处理字符串 获取指定数据
 * @param $data
 * @param bool $checkArr
 * @return bool
 */
function explodeData($data,$checkArr = false){

    $params = false;

    if (!empty($data)){
        $explodeData = explode(';',$data);
        foreach ($explodeData as $key=>$value){
            $tmpArr = explode(',',$value);

            // 获取指定字段
            if ($checkArr ){
                if (in_array_case($tmpArr[0],$checkArr)){
                    $params[$tmpArr[0]] = $tmpArr[1];
                }
            }else{
                $params[$tmpArr[0]] = $tmpArr[1];
            }
            $tmpArr = [];
        }

    }

    return $params;
}



