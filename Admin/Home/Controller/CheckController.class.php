<?php
/**
 * 检查用户是否登录
 *
 */
namespace Home\Controller;
use Think\Controller;
class CheckController extends Controller {

    public function __construct(){
        parent::__construct();

        $obj = A('Member');
        $chckLogin = $obj->checkLogin();

        if ( !$chckLogin ){
            $this->display('Member/login');
            die();
        }

    }


}