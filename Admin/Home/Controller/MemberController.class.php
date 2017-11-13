<?php
namespace Home\Controller;
use Think\Controller;
class MemberController extends Controller {



    public function index(){


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
        if ( !$this->checkLogin()){
            // 跳转
            //header("Location: http://bbs.lampbrother.net");
            echo 'ok';
            die();
        }

        $this->display();
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
            $sqlPwd = md5($objRes['password'].$cookie['time']);


            if ($sqlPwd == $cookie['password']){

                $time = time();

                $cookiePdw = md5($objRes['password'].$time);
                // 登录成功 设置 COOKIE
                $data['name'] = $objRes['name'];
                $data['time'] = $time;
                $data['password'] = $cookiePdw;
                $data['code'] ='member';
                setCookieData($data);
                return true;
            }


        }

        return false;

    }

}