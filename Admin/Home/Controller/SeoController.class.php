<?php
namespace Home\Controller;
use Think\Controller;
class SeoController extends Controller {



    public function index(){

        if (!isset($_GET['key'])  || empty($_GET['key'])){
            echo '未找到信息';
            die();
        }

        // 查询数据库 ID 获取对应的数据
        $key = $_GET['key'];

        $Seo = D('Seo');
        // 获取 key 对应的数据
        $SeoData = $Seo->getData($key);

        $SeoData['key'] = $key;

        // 传值
        $this->assign($SeoData);
        $this->display();
    }


}