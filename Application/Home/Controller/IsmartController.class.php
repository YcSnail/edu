<?php
namespace Home\Controller;
use Think\Controller;
class IsmartController extends SystemController {
    public $seo;
    public $systemData;

    public function __construct(){
        parent::__construct();
        $this->systemData = $this->system;

        $key = 'ismart';
        $this->seo = A('Index')->getSeo($key);
        $setData['data'] = $this->seo;
        $this->assign($setData);

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