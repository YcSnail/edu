<?php
namespace Home\Controller;
use Think\Controller;
class InstituteController extends Controller {

    /**
     *师资力量 主页面
     */
    public function index(){

        $this->display();
    }

    /**
     * 学霸导师
     */
    public function teachers(){
        $this->display();
    }



}