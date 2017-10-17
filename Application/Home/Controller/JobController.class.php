<?php
namespace Home\Controller;
use Think\Controller;
class JobController extends Controller {

    /**
     * 招聘 主页面
     */
    public function index(){

        $array['nowTime'] = date('Y-m-d');

        $this->assign($array);
        $this->display();
    }


}