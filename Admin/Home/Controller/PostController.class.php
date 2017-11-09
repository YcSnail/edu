<?php
namespace Home\Controller;
use Think\Controller;
class PostController extends Controller {

    public function __construct(){

        parent::__construct();

        // 检查用户是否登录
        // 检查是否可以修改

    }


    /**
     * 修改手机号
     */
    public function phone(){

        $post = I('post.');

        $phone = intval($post['phone']);
        $phoneTwo = intval($post['phoneTwo']);

        // 判断是否为手机号 11位
        if ( empty($phone) || empty($phoneTwo) ){
            ajaxRes(-1,'手机号码不能为空');
        }

        if (  strlen($phone) !=11  || strlen($phoneTwo)!=11 ){
            ajaxRes(-1,'请输入正确的手机号');
        }

        ajaxRes(0,'OK');
    }

    public function Seo(){

        $post = I('post.');

        if (empty($post['dataStr'])){
            ajaxRes(-1,'数据不能为空');
        }

        $dataStr = $post['dataStr'];

        $Setdata = explodeData($dataStr);

        if (empty($Setdata['key'])  || empty($Setdata['name']) || empty($Setdata['title']) || empty($Setdata['keywords']) || empty($Setdata['description'])  ){
            ajaxRes(-1,'数据不完整');
        }

        // 判断是 修改还是 新增
        if (isset( $post['id'])){

            // 修改数据
            if (intval($post['id'])){


            }

        }

        // 否则 新增数据



    }



}