<?php
/**
 * Created by PhpStorm.
 * User: xf
 * Date: 2017/10/1
 * Time: 21:17
 */
namespace Admin\Controller;
use Think\Controller;
class LifeController extends AdminController{
    public function __construct(){
        parent::__construct();
    }
    public function life(){

        $this->display('life');
    }
    public function add_life(){
        $content=I('content');
        $life=D('life');
        $data['content']=$content;
        $data['add_time']=time();
        $res=$life->add_one($data);
        if($res){
            $this->life();
        }
    }
}