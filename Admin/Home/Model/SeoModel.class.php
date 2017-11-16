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

    protected $insertFields = 'key,title,keywords,description'; // 新增数据的时候允许写入name和email字段
    protected $updateFields = 'title,keywords,description'; // 编辑数据的时候只允许写入email字段


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
     * 新增SEO数据
     * @param $arr
     * @return mixed
     */
    public function seoAdd($arr){
        $seo = D('Seo');

        $data['key'] = $arr['key'];
        $data['title'] = $arr['title'];
        $data['keywords'] = $arr['keywords'];
        $data['description'] = $arr['description'];

        $dataRes = $seo->data($data)->add();
        return $dataRes;
    }

    /**
     * 修改数据
     * @param $arr
     * @return bool
     */
    public function seoChange($arr){
        $seo = D('Seo');
        $id = $arr['id'];

        $data['title'] = $arr['title'];
        $data['keywords'] = $arr['keywords'];
        $data['description'] = $arr['description'];

        $dataRes = $seo->where(" `id`= '$id' ")->save($data); // 根据条件更新记录

        return $dataRes;
    }



}