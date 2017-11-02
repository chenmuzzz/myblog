<?php
namespace Home\Controller;
use Think\Controller;
use Admin\Model;
class HomeController extends Controller{
	 public function __construct(){
	 	parent::__construct();
        $obj=new \Admin\Model\CateModel();
        $cate_res=$obj->get_all();
        $this->assign('cate_res',$cate_res);
     }

}