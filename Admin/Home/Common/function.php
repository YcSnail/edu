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


/**
 * 生成随机字符串
 * @param int $length
 * @return string
 */
function make_password( $length = 8 ) {
    // 密码字符集，可任意添加你需要的字符
    $chars = array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h',
        'i', 'j', 'k', 'l','m', 'n', 'o', 'p', 'q', 'r', 's',
        't', 'u', 'v', 'w', 'x', 'y','z', 'A', 'B', 'C', 'D',
        'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L','M', 'N', 'O',
        'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y','Z',
        '0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '!',
        '@','#', '$', '%', '^', '&', '*',);

    // 在 $chars 中随机取 $length 个数组元素键名
    $keys = array_rand($chars, $length);

    $password = '';
    for($i = 0; $i < $length; $i++) {
        // 将 $length 个数组元素连接成字符串
        $password .= $chars[$keys[$i]];
    }

    return $password;
}

/**
 * 设置COOKIE信息
 */
function setCookieData($data){
    $returRes = false;
    // 自助 保存cookie
    if (empty($data) || empty($data['code'])){
        return $returRes;
    }

    $setCookieArr = $data;
    if (empty($setCookieArr)) {
        return $returRes;
    }

    // 保存为JSON 格式
    $setCookieJson = json_encode($setCookieArr);
    $cookieName = $data['code'] . 'Cookie';
    setcookie($cookieName, $setCookieJson, time() + 3600 * 24 * 30);
    return true;
}

// 获取cookie 信息
function getCookie($data){

    $code = $data['code'];
    if (empty($code)) {
        ajaxRes(-1, '');
    }

    $cookieDataRes = '';

    $cookieName = $code . 'Cookie';
    // cookie 不存在
    if (!empty($_COOKIE[$cookieName])) {
        $cookieData = $_COOKIE[$cookieName];
        $cookieDataRes = json_decode($cookieData, true);

    }
    return $cookieDataRes;
}


/**
 * 删除cookie
 */
function unsetCookie($data){

    $code = $data['code'];
    if (empty($code)) {
        ajaxRes(-1, '');
    }

    $cookieName = $code . 'Cookie';
    $cookieData = $_COOKIE[$cookieName];

    $returRes = false;
    // cookie 不存在
    if (!empty($cookieData)) {
        setcookie($cookieName, '', time() - 3600);
        $returRes = true;
    }
    return $returRes;
}





