<?php
namespace Home\Controller;
use Think\Controller;
class JobController extends SystemController {


    public $systemData;

    public function __construct(){
        parent::__construct();
        $this->systemData = $this->system;

        $this->assign($this->systemData);
    }

    /**
     * 招聘 主页面
     */
    public function index(){

        $array['nowTime'] = date('Y-m-d');

        $this->assign($array);
        $this->display();
    }


}