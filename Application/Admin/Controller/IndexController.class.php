<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends AdminController {
    public function __construct(){
        parent::__construct();
    }
    public function index(){
        //
        header("Content-type:text/html;charset=utf-8");
//        $info = array(
//            '操作系统'=>PHP_OS,
//            '运行环境'=>$_SERVER["SERVER_SOFTWARE"],
//            'PHP运行方式'=>php_sapi_name(),
//            'ThinkPHP版本'=>THINK_VERSION.' [ <a href="http://thinkphp.cn" target="_blank">查看最新版本</a> ]',
//            '上传附件限制'=>ini_get('upload_max_filesize'),
//            '执行时间限制'=>ini_get('max_execution_time').'秒',
//            '服务器时间'=>date("Y年n月j日 H:i:s"),
//            '北京时间'=>gmdate("Y年n月j日 H:i:s",time()+8*3600),
//            '服务器域名/IP'=>$_SERVER['SERVER_NAME'].' [ '.gethostbyname($_SERVER['SERVER_NAME']).' ]',
//            '剩余空间'=>round((disk_free_space(".")/(1024*1024)),2).'M',
//            'register_globals'=>get_cfg_var("register_globals")=="1" ? "ON" : "OFF",
//            'magic_quotes_gpc'=>(1===get_magic_quotes_gpc())?'YES':'NO',
//            'magic_quotes_runtime'=>(1===get_magic_quotes_runtime())?'YES':'NO',
//        );

        $obj=D('Article');
        //文章数
        $article_num=$obj->get_num();
        $mysql_ver=M()->query('select version() as ver');

        $info = array(
            '0'=>PHP_OS,    //操作系统
            '1'=>$_SERVER["SERVER_SOFTWARE"],   //运行环境
            '2'=>php_sapi_name(),    //php运行方式
            '3'=>($_SERVER["HTTP_VIA"]) ? $_SERVER["HTTP_X_FORWARDED_FOR"] : $_SERVER["REMOTE_ADDR"],
            '4'=>ini_get('upload_max_filesize'),
            '5'=>$_SERVER['SERVER_NAME'].' [ '.gethostbyname($_SERVER['SERVER_NAME']).' ]',
            '6'=>$article_num,
            '7'=>phpversion(),
            '8'=>my_get_browser(),
            '9'=>$mysql_ver[0]['ver'],
        );
        $this->assign('info',$info);
        $this->display('index');
    }

    public function index1(){
        $this->display('index');
    }

    //执行登陆
    public function login_do(){
        $user_name=I('user_name');
        $password=I('password');
        if($user_name == 'zxf' && $password=='571524655cm'){
            $_SESSION['USER_NAME'] = 'zxf';
            $this->success('登陆成功',U('index'));
        }else{
            $this->error('登陆失败');
        }
    }
    //退出登陆
    public function logout(){
        unset($_SESSION['USER_NAME']);
        $this->success('退出登陆成功',"/");
    }
}