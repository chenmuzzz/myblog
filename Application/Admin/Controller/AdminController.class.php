<?php
namespace Admin\Controller;
use Think\Controller;
class AdminController extends Controller{
	 public function __construct(){
	 	parent::__construct();
        $cate_res=D('Cate')->get_all();

        $this->assign('cate_res',$cate_res);
     }

}