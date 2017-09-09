<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {

    public function index(){
        $this->display();
    }

    /**
     * 关于我们
     */
    public function about(){
        $this->display();
    }

    /**
     * 最新资讯
     */
    public function news(){
        $this->display();
    }


    /**
     * 一对一
     */
    public function oneOnOne(){
        $this->display();
    }

    /**
     * 一对三
     */
    public function oneOnThree(){
        $this->display();
    }

}