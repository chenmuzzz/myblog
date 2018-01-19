<?php
namespace Home\Controller;

use Think\Controller;


class PicController extends HomeController
{
    public function __construct()
    {
        parent::__construct();
    }
    //最大子序列和
    public function index(){
        $redis=new \Redis();
        $redis->connect('127.0.0.1',6379);
        $res=unserialize($redis->get('length'));
        $man=unserialize($redis->get('man'));
        $time=$redis->get("time");
        $len=$redis->get("len");

        echo '<pre>';
        var_dump($time);
        var_dump($len);
        var_dump($man);

        $redis->close();
        dd($res);
    }
}