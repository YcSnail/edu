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
class SystemModel extends Model {

    // 获取 key 对应的数据
    public function getData($id){

        if (empty($id)){
            return 'id不能为空';
        }

        $ojb = D('system');
        $data = $ojb->where(" `id`= '$id' ")->find();

        return $data;
    }

    /**
     * 新增SEO数据
     * @param $arr
     * @return mixed
     */
    public function ObjAdd($arr){
        $ojb = D('system');

        $data['key'] = $arr['key'];
        $data['title'] = $arr['title'];
        $data['keywords'] = $arr['keywords'];
        $data['description'] = $arr['description'];

        $dataRes = $ojb->data($data)->add();
        return $dataRes;
    }

    /**
     * 修改数据
     * @param $arr
     * @return bool
     */
    public function ObjChange($arr){
        $ojb = D('system');

        $id = $arr['id'];

        $data['phone'] = $arr['phone'];
        $data['phoneTwo'] = $arr['phoneTwo'];
        $data['qq'] = $arr['qq'];
        $data['icp'] = $arr['icp'];
        $data['policeIcp'] = $arr['policeIcp'];
        $data['copyright'] = $arr['copyright'];

        $dataRes = $ojb->where(" `id`= '$id' ")->save($data); // 根据条件更新记录

        return $dataRes;
    }



}