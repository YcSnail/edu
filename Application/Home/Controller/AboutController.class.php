<?php
namespace Home\Controller;
use Think\Controller;
class AboutController extends SystemController {

    public $data;
    public $systemData;

    public function __construct(){
        parent::__construct();
        $this->systemData = $this->system;

        $this->assign($this->systemData);

        $key = 'about';
        $this->data = A('Index')->getSeo($key);

    }

    /**
     * 关于我们主页面
     */
    public function index(){

        $setData['data'] = $this->data;

        $this->assign($setData);

        $this->display();
    }

    /**
     * 最新资讯
     */
    public function news(){
        $this->display();
    }

    /**
     * 书味文化
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

    /**
     * 补习班介绍
     */
    public function cramSchool(){
        $this->display();
    }

}