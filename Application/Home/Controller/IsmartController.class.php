<?php
namespace Home\Controller;
use Think\Controller;
class IsmartController extends Controller {

    /**
     * 教学理念 主页面
     */
    public function index(){
        $this->display('Index/404');
        die();
        $this->display();
    }

    /**
     * 学霸导师
     */
    public function teachers(){
        $this->display();
    }



}