<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){

        $this->display();
    }

    /**
     *
     */
    public function webIndex(){
        $this->display();
    }


    /**
     * 招聘信息
     */
    public function job(){

        // 查询是否存在数据
        // 查询数据库 ID 获取对应的数据
        $key = 'job';

        $obj = D('Article');
        // 获取 key 对应的数据
        $getData = $obj->getData($key);

        $getData['style'] = $key;

        $getData['content'] = htmlspecialchars_decode($getData['content']);

        // 传值
        $this->assign($getData);
        $this->display();
    }

    public function system(){
        $this->display();
    }

}