<?php
namespace Home\Controller;
use Think\Controller;
use Think\Db\Lite;

// 获取底部参数
class SystemController extends Controller {

    public $system;

    public function __construct(){
        parent::__construct();

        // 获取系统参数
        $SystemObj = D('system');
        $data = $SystemObj->where('id = 1' )->find();
        $this->system = $data;


    }


}