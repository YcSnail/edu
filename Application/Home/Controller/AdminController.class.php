<?php

namespace Home\Controller;
use Think\Controller;
class AdminController extends Controller {

    public function index(){

        // 跳转
        $http = $_SERVER['REQUEST_SCHEME'];
        $host = $_SERVER['SERVER_NAME'];
        $href = $http.'://'.$host.'/admin.php';
        header("Location: $href");


    }

}