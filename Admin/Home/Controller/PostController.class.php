<?php
namespace Home\Controller;
use Think\Controller;
class PostController extends Controller {

    public function __construct(){

        parent::__construct();


        // login
        // 过滤LOGIN 方法
        $chckFunction = strpos($_SERVER['QUERY_STRING'],'a=login');

        if ( !$chckFunction){

            // 检查用户是否登录
            // 检查是否可以修改
            $memberObj = A('Member');
            $checkLogin = $memberObj->checkLogin();

            if (! $checkLogin){
                ajaxRes(-1,'请先登录');
            }

        }


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

        if (empty($post['key'])  || empty($post['title']) || empty($post['keywords']) || empty($post['description'])  ){
            ajaxRes(-1,'数据不完整');
        }

        $seo = D('Seo');
        // 判断是 修改还是 新增
        if (!empty( $post['id'])){

            // 修改数据
            $dataRes = $seo->seoChange($post);

            if (!empty($dataRes)){
                ajaxRes(0,'修改成功');
            }

        }else{

            // 否则 新增数据
            $dataRes = $seo->seoAdd($post);
            if (!empty($dataRes)){
                ajaxRes(0,'修改成功');
            }

        }
        ajaxRes(-1,'更新失败请重试');

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

                $userData = $obj->getData($Setdata['name']);

                // 设置cookie
                // 帐号 密码 selt
                $setCookieObj = A('member');
                $setCookieObj->setPwdCookie($userData);

                ajaxRes(0,'修改成功');
            }

        }

        ajaxRes(-1,'修改失败请重试');
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
        if (empty($Setdata['submit'])){
            ajaxRes(-1,'请通过正常渠道提交');
        }


        if (!empty($Setdata['name']) || !empty($Setdata['password'])){

            $obj = D('Member');
            // 登录
            $objRes = $obj->login($Setdata);

            if (!empty($objRes)){

                $salt = $objRes['salt'];

                $checkPassword = md5($Setdata['password'].$salt);

                if ($objRes['password'] == $checkPassword){

                    // 帐号 密码 selt
                    $setCookieObj = A('member');
                    $setCookieObj->setPwdCookie($objRes);
                    ajaxRes(0,'登录成功');
                }

                ajaxRes(-1,'登录失败,密码不正确');
            }
            ajaxRes(-1,'登录失败,用户不存在');

        }

        ajaxRes(-1,'登录失败');
    }



}