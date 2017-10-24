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



}