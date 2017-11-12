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
class ArticleModel extends Model {

    protected $insertFields = 'style,title,content,status'; // 新增数据的时候允许写入name和email字段
    protected $updateFields = 'title,content,status'; // 编辑数据的时候只允许写入email字段


    // 获取 key 对应的数据
    public function getData($key = null){
        $Article = D('Article');

        if (!empty($key)){
            $data = $Article->where(" `style`= '$key' ")->find();
        }else{
            $data = $Article->select();
        }

        return $data;
    }

    /**
     * 新增SEO数据
     * @param $arr
     * @return mixed
     */
    public function ObjAdd($arr){
        $Article = D('Article');
        $data = array();

        if (!empty($arr['style']) || isset($arr['style'])){
            $data['style'] = $arr['style'];
        }

        $data['title'] = $arr['title'];
        $data['content'] = $arr['content'];
        $data['status'] = 1;

        $dataRes = $Article->data($data)->add();
        return $dataRes;
    }

    /**
     * 修改数据
     * @param $arr
     * @return bool
     */
    public function ObjChange($arr){
        $Article = D('Article');

        $id = $arr['id'];
        $data['title'] = $arr['title'];
        $data['content'] = $arr['content'];
        $data['status'] = 1;

        $dataRes = $Article->where(" `id`= '$id' ")->save($data); // 根据条件更新记录

        return $dataRes;
    }



}