<?php
/**
 * Created by PhpStorm.
 * User: xf
 * Date: 2017/9/17
 * Time: 21:41
 */
namespace Home\Model;
class DnfModel extends \Think\Model{

    public function add_one($data){
        $this->add($data);
//        echo $this->_sql();
        return $this->getLastInsID();
    }

    public function get($where){

       $res=$this->where($where)->find();
//        echo $this->_sql();
       return $res;
    }

}