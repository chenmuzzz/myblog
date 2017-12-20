<?php
namespace Home\Controller;

use Think\Controller;


class TestController extends HomeController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function  coreseek_test(){
        header("Content-type:text/html;charset=utf-8");
        $s = new \SphinxClient();
        $s->setServer("127.0.0.1", 9312);

        $s->setMatchMode(SPH_MATCH_ANY);
        $s->setMaxQueryTime(30);
        $key=$_GET['key'];
        $res = $s->query($key,'music'); #[宝马]关键字，[main]数据源source
        $err = $s->GetLastError();
        $ress=array_keys($res['matches']);
        $a=implode(',',$ress);

        var_dump($a);
        echo "<br>"."通过获取的ID来读取数据库中的值即可。"."<br>";

        echo '<pre>';
        var_dump($res);
        var_dump($err);
        echo '</pre>';
    }


}