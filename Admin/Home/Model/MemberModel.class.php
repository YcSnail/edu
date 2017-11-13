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
class MemberModel extends Model {

    // 获取 key 对应的数据
    public function getData($name){

        if (empty($name)){
            return '用户名不能为空';
        }

        $ojb = D('member');
        $data = $ojb->where(" `name`= '$name' ")->find();

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
    public function ObjAdd($arr){
        $ojb = D('member');

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
        $ojb = D('member');

        $id = $arr['id'];
        $data['name'] = $arr['name'];
        $data['password'] = $arr['password'];
        $dataRes = $ojb->where(" `id`= '$id' ")->save($data); // 根据条件更新记录

        return $dataRes;
    }

    public function login($arr){
        $ojb = D('member');
        $name = $arr['name'];

        $dataRes = $ojb->where(" `name`= '$name' ")->find(); // 根据条件更新记录
        return $dataRes;
    }


}