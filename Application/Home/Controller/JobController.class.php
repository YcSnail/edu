<?php
namespace Home\Controller;
use Think\Controller;
class JobController extends SystemController {


    public $systemData;

    public function __construct(){
        parent::__construct();
        $this->systemData = $this->system;
        $this->assign($this->systemData);

        $key = 'job';
        $this->seo = A('Index')->getSeo($key);
        $setData['data'] = $this->seo;
        $this->assign($setData);
    }

    /**
     * 招聘 主页面
     */
    public function index(){
        // 获取招聘信息

        // 查询是否存在数据

        // 查询数据库 ID 获取对应的数据
        $key = 'job';

        $obj = D('Article');
        // 获取 key 对应的数据
        $getData = $obj->getData($key);

        $setData['title'] = $getData['title'];
        $setData['content'] = htmlspecialchars_decode($getData['content']);
        $setData['nowTime'] = date('Y-m-d');
        $setData['count'] = $getData['count'];

        // 传值
        $this->assign($setData);
        $this->display();
    }


}