<?php
namespace Home\Controller;
use Think\Controller;
class AboutController extends Controller {

    /**
     * 关于我们主页面
     */
    public function index(){
        $this->display();
    }

    /**
     * 最新资讯
     */
    public function news(){
        $this->display();
    }

    /**
     * 精锐文化
     */
    public function culture(){
        $this->display();
    }

    /**
     * 荣获奖项
     */
    public function honorprice(){
        $this->display();
    }


}