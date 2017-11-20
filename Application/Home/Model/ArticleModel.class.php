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
        $data = '';
        if (!empty($key)){
            $data = $Article->where(" `style`= '$key' ")->find();
        }

        if (!empty($data)){
            $this->ObjChange($key);
        }

        return $data;
    }

    /**
     * 修改数据
     * 增加阅读量
     * @param $arr
     */
    public function ObjChange($style){
        $Article = D('Article');
        $Article->where(" `style`= '$style' ")->setInc('count');
    }



}