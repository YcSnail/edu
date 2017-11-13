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

        if (empty($Setdata['key'])  || empty($Setdata['title']) || empty($Setdata['keywords']) || empty($Setdata['description'])  ){
            ajaxRes(-1,'数据不完整');
        }

        $seo = D('Seo');

        // 判断是 修改还是 新增
        if (!empty( $post['id'])){

            // 修改数据
            $dataRes = $seo->seoChange($Setdata);

            if (empty($dataRes)){
                ajaxRes(-1,'更新失败请重试');
            }

        }else{

            // 否则 新增数据
            $dataRes = $seo->seoAdd($Setdata);
            if (empty($dataRes)){
                ajaxRes(-1,'更新失败请重试');
            }

        }

        ajaxRes(0,'修改成功');
    }

    /**
     * 文章控制器
     */
    public function Article(){

        $post = I('post.');

        if (empty($post['dataStr'])){
            ajaxRes(-1,'数据不能为空');
        }

        $dataStr = $post['dataStr'];

        $Setdata = explodeData($dataStr);
        $Setdata['content'] = $post['content'];

        $obj = D('Article');
        if (empty($Setdata['id'])){
            // 文章添加

            $objRes = $obj->ObjAdd($Setdata);

            if (empty($objRes)){
                ajaxRes(-1,'添加失败请重试');
            }

        }else{

            // 文章修改
            $objRes = $obj->ObjChange($Setdata);
            if (empty($objRes)){
                ajaxRes(-1,'更新失败请重试');
            }

        }

        ajaxRes(0,'保存成功');
    }

    /**
     * 修改密码
     */
    public function changePassword(){

        $post = I('post.');

        if (empty($post['dataStr'])){
            ajaxRes(-1,'数据不能为空');
        }

        $dataStr = $post['dataStr'];

        $Setdata = explodeData($dataStr);

        //安全验证

        $obj = D('Member');
        if (!empty($Setdata['password'])){

            // 修改
            $objRes = $obj->ObjChange($Setdata);
            if (!empty($objRes)){
                ajaxRes(0,'修改成功');
            }

        }

        ajaxRes(-1,'更新失败请重试');
    }


    /**
     * 修改系统参数
     */
    public function system(){

        $post = I('post.');

        if (empty($post['dataStr'])){
            ajaxRes(-1,'数据不能为空');
        }

        $dataStr = $post['dataStr'];

        $Setdata = explodeData($dataStr);

        //安全验证

        $obj = D('system');
        if (!empty($Setdata['id'])){

            // 修改
            $objRes = $obj->ObjChange($Setdata);
            if (!empty($objRes)){
                ajaxRes(0,'修改成功');
            }

        }

        ajaxRes(-1,'更新失败请重试');

    }

    /**
     * 用户登录
     */
    public function login(){

        $post = I('post.');

        if (empty($post['dataStr'])){
            ajaxRes(-1,'数据不能为空');
        }

        $dataStr = $post['dataStr'];

        $Setdata = explodeData($dataStr);

        //安全验证

        $obj = D('Member');
        if (!empty($Setdata['name'])){

            // 修改
            $objRes = $obj->login($Setdata);

            if (!empty($objRes)){

                $salt = $objRes['salt'];

                $checkPassword = md5($Setdata['password'].$salt);

                if ($objRes['password'] == $checkPassword){

                    $time = time();

                    $cookiePdw = md5($checkPassword.$time);
                    // 登录成功 设置 COOKIE
                    $data['name'] = $Setdata['name'];
                    $data['time'] = $time;
                    $data['password'] = $cookiePdw;
                    $data['code'] ='member';

                    setCookieData($data);
                    ajaxRes(0,'登录成功');
                }

                ajaxRes(-1,'登录失败,密码不正确');
            }
            ajaxRes(-1,'登录失败,用户不存在');

        }

        ajaxRes(-1,'登录失败');
    }



}