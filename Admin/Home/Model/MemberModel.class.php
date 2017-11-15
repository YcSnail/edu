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

    // 获取 对应的数据
    public function getData($name){

        if (empty($name)){
            return '用户名不能为空';
        }

        $obj = D('member');
        $data = $obj->where(" `name`= '$name' ")->find();

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
        $obj = D('member');

        $data['key'] = $arr['key'];
        $data['title'] = $arr['title'];
        $data['keywords'] = $arr['keywords'];
        $data['description'] = $arr['description'];

        $dataRes = $obj->data($data)->add();
        return $dataRes;
    }

    /**
     * 修改数据
     * @param $arr
     * @return bool
     */
    public function ObjChange($arr){

        if (empty($arr['password'])){
            return false;
        }

        $obj = D('member');

        $dataRes = false;
        // 查询数据是否一致
        $checkRes = $this->getData($arr['name']);

        // 若相等 则进行更改
        if ($checkRes['id'] == $arr['id']){
            $salt = $checkRes['salt'];
            $password = md5($arr['password'].$salt);

            $id = $arr['id'];
            $data['password'] = $password;
            $dataRes = $obj->where(" `id`= '$id' ")->save($data); // 根据条件更新记录
        }

        return $dataRes;
    }

    public function login($arr){
        $obj = D('member');
        $name = $arr['name'];

        $dataRes = $obj->where(" `name`= '$name' ")->find(); // 根据条件更新记录
        return $dataRes;
    }


}