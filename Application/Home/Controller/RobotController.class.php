<?php
namespace Home\Controller;
use Think\Controller;
class RobotController extends Controller{
	 public function __construct(){
	 	parent::__construct();
     }
    public function test(){
        header("Content-type:text/html;charset=utf-8");
        $robot=D('robot');
        $info=$_GET['info'];
        $user_id='1a25';
//        $encode = mb_detect_encoding($info,array("ASCII","UTF-8","GB2312","GBK","BIG5"));
//        dd($encode);

        $res=$robot->sendMsg($info,$user_id);
        dd($res);
    }
    public function send_msg(){
        $info=I('info');
        header("Content-type:text/html;charset=utf-8");
        $robot=D('robot');
        if ($_SESSION['ROBOT_ID']){
            $user_id=$_SESSION['ROBOT_ID'];
        }else{
            $user_id=date('mdhis').rand(11,99);
            $_SESSION['ROBOT_ID']=$user_id;
        }

        $res=$robot->sendMsg($info,$user_id);
        $data=array(
            'time'=>date('Y-m-d H:i:s',time()),
            'code'=>$res['code'],
            'text'=>$res['text']
        );
        switch ($res['code']){
            case 100000;    //文本
                break;
            case 200000;    //链接类
                $data['img'] = $res['url'];
                break;
            case 302000;    //新闻类
                $data['list'] = $res['list'];
                break;
            case 308000;    //菜谱类
                $data['list']=$res['list'];
                break;
        }
        echo json_encode($data);
    }
}