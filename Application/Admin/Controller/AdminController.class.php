<?php
namespace Admin\Controller;
use Think\Controller;
class AdminController extends Controller{
	 public function __construct(){
	 	parent::__construct();
        $cate_res=D('Cate')->get_all();
        $this->assign('cate_res',$cate_res);
        if($_SESSION['USER_NAME'] != 'zxf' && ACTION_NAME != "login_do"){
            $this->login();
            exit;
        }
     }
    function login(){
        $this->display('Index/login');
    }

}