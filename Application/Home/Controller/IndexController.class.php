<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {

    public function index(){

        $key = __FUNCTION__;
        $data = $this->getSeo($key);

        $setData['data'] = $data;
        $this->assign($setData);

        $this->display();
    }

    /**
     * 关于我们
     */
    public function about(){

        $key = __FUNCTION__;
        $data = $this->getSeo($key);
        $setData['data'] = $data;
        $this->assign($setData);

        $this->display();
    }


    /**
     * 一对一
     */
    public function oneOnOne(){

        $key = __FUNCTION__;
        $data = $this->getSeo($key);
        $setData['data'] = $data;
        $this->assign($setData);

        $this->display();
    }

    /**
     * 一对三
     */
    public function oneOnThree(){
        $key = __FUNCTION__;
        $data = $this->getSeo($key);

        $setData['data'] = $data;
        $this->assign($setData);

        $this->display();
    }


    /**
     * 空页面
     */
    public function emptyPage(){
        $this->display('404');
    }


    public function getSeo($key ='defaultSet'){

        $getKey = D('Seo')->getData($key);

        if (empty($getKey)){
            $getKey = D('Seo')->getDefalut();
        }

        return $getKey;
    }

}