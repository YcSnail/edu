<?php
namespace Home\Controller;
use Think\Controller;
class IsmartController extends SystemController {


    public $systemData;

    public function __construct(){
        parent::__construct();
        $this->systemData = $this->system;

        $this->assign($this->systemData);
    }

    /**
     * 教学理念 主页面
     */
    public function index(){
        $this->display('Institute/index');
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