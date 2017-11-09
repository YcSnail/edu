<?php
namespace Home\Controller;
use Think\Controller;
class SeoController extends Controller {



    public function index(){

        if (!isset($_GET['key'])  || empty($_GET['key'])){
            echo 'error';

            die();
        }

        // 查询数据库 ID 获取对应的数据
        $key = $_GET['key'];

        $Seo = D('Seo');
        // 获取 key 对应的数据
        $SeoData = $Seo->getData($key);

        // 说明数据不存在
        if (empty($SeoData)){
            $this->SeoAdd($key);
            return false;
        }

        // 传值
        $this->assign($SeoData);
        $this->display();
    }

    // 添加页面SEO信息
    public function SeoAdd($key){

        if (empty($key)){
            return false;
        }

        $SetData['key'] = $key;
        $this->assign($SetData);
        // 进入添加页面
        $this->display('seoAdd');
    }





}