<?php
/**
 * Created by PhpStorm.
 * User: xf
 * Date: 2017/10/1
 * Time: 21:25
 */
namespace Admin\Model;
class CateModel extends \Think\Model{
    //返回所有的分类信息 field:要查询的字段 数组形式
    public function get_all($field=array()){
        if($field){
            $v=implode(',',$field);
            $this->field($v);
        }
        $res=$this->select();
        return $res;
    }
    //返回所有的父级分类
    public function get_all_pid(){
        $res=$this->where('parent_id=0')->select();
//        echo $this->_sql();
        return $res;
    }
    //添加一条信息
    public function add_one($data){
        $res=$this->add($data);
        return $res;
    }
    //返回一条信息， field:要查询的字段 数组形式
    public function get_one($id,$field=array()){
        if($field){
            $v=implode(',',$field);
            $this->field($v);
        }
        $res=$this->find($id);
        return $res;
    }
}