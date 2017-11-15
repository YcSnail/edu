<?php
namespace Home\Controller;
use Think\Controller;
class MemberController extends Controller {

    public function index(){
        $this->login();
    }

    /**
     * 修改密码
     */
    public function changePwd(){

        // 查询数据库 ID 获取对应的数据
        $name = 'admin';
        $obj = D('Member');
        // 获取 key 对应的数据
        $SeoData = $obj->getData($name);
        // 传值
        $this->assign($SeoData);
        $this->display();
    }

    // 用户登录
    public function login(){

        // 判断是否存在 cookie 已经登录
        if ( $this->checkLogin()){

            $url = U('index/index');
            // 跳转
            header("Location:$url");
            die();
        }

        $this->display('Member/login');
    }

    public function checkLogin(){

        $data['code'] ='member';

        $cookie = getCookie($data);

        if (empty($cookie)){
            return false;
        }

        $obj = D('Member');
        // 获取 对应的数据
        $objRes = $obj->login($cookie);

        if (!empty($objRes)){

            // 判断密码是否一致
            $sqlPwd = md5($objRes['password'].$cookie['time'].$objRes['salt']);

            if ($sqlPwd == $cookie['password']){

                $this->setPwdCookie($objRes);
                return true;
            }
        }

        return false;
    }


    /*
     * 设置 密码cookie
     */
    public function setPwdCookie($objRes){

        $time = time();

        $cookiePdw = md5($objRes['password'].$time.$objRes['salt']);
        // 登录成功 设置 COOKIE
        $data['name'] = $objRes['name'];
        $data['time'] = $time;
        $data['password'] = $cookiePdw;
        $data['code'] ='member';

        // 设置用户名
        setcookie('userName', $objRes['name'], time() + 3600 * 24 * 30);
        setCookieData($data);
        return true;
    }

    /**
     * 删除cookie
     * @param $code
     */
    public function unsetLogin(){

        $data['code'] ='member';
        $res = unsetCookie($data);
        if ($res){
            $url = U('index/index');
            // 跳转
            header("Location:$url");
        }

    }

}