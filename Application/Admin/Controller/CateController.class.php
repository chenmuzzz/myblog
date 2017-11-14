<?php
/**
 * Created by PhpStorm.
 * User: xf
 * Date: 2017/10/1
 * Time: 21:17
 */
namespace Admin\Controller;
use Think\Controller;
class CateController extends AdminController{
    public function __construct(){
        parent::__construct();
    }
    public function cate(){
        //所有的父级分类
        $cate=D('cate');
        $p_cate=$cate->get_all_pid();
        $cate_res=$cate->get_all();
        $this->assign('cate_res',$cate_res);
        $this->assign('p_cate',$p_cate);
        $this->display('category');
    }
    public function add_cate(){
        $data=I('post.');
        $cate=D('cate');
        $res=$cate->add_one($data);
        if($res){
            $this->cate();
        }
    }
    public function del_cate(){
        $id=I('id');
        $res=D('cate')->delete_one($id);
        if($res){
            echo json_encode('1');
        }
    }
}