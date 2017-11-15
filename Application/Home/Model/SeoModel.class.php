<?php
// +----------------------------------------------------------------------
// |  [ you slogan ]
// +----------------------------------------------------------------------
// | Author: you name  and you E-mail
// +----------------------------------------------------------------------
// | Date: 2017/11/10 Time: 0:05
// +----------------------------------------------------------------------
namespace Home\Model;
use Think\Model;
class SeoModel extends Model {


    // 获取 key 对应的数据
    public function getData($key){

        if (empty($key)){
            return '关键字不能为空';
        }

        $seo = D('Seo');
        $data = $seo->where(" `key`= '$key' ")->find();

        return $data;
    }


    // 获取默认的数据
    public function getDefalut(){
        $key = 'defaultSet';

        $data = $this->getData($key);
        return $data;
    }

    /**
     * 获取系统数据
     */
    public function getSystem(){

        $obj = D('system');
        $data = $obj->where(" `id`= '1' ")->find();
        return $data;
    }


}