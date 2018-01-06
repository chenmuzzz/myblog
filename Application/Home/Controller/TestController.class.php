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
    public function  test_life(){
        header("Content-type:text/html;charset=utf-8");
        $s = new \SphinxClient();
        $s->setServer("127.0.0.1", 9312);

        $s->setMatchMode(SPH_MATCH_ALL);
        $s->setMaxQueryTime(30);
        $key=$_GET['key'];
        $res = $s->query($key,'life'); #[宝马]关键字，[main]数据源source
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
    //redis
    public function redis_test(){
        $redis=new \Redis();
        $redis->connect('127.0.0.1',6379);
        $redis->set('a',1);
        echo $redis->get('a');
    }
    //人脸 识别
    public function face(){
        $face = D('face');
        $img=$_GET['img'];
        $res=$face->test($img);
        $this->assign('res',json_encode($res));
        $this->display('Index/face');
    }


    public function ye(){
        $im=imagecreate(670,500);
        $white = imagecolorallocate($im, 0xFF, 0xFF, 0xFF);
        $g = imagecolorallocate($im, 0x00, 0x00, 0x00);
        define("PII",M_PI/180);
        $this->drawLeaf($g,300,500,100,270);
        header("Content-type: image/png");
        imagepng($im);
    }
    function drawLeaf($g,$x,$y,$L,$a){

        global $im;
        $B = 50;
        $C =9;
        $s1 = 2;
        $s2 = 3 ;
        $s3 = 1.2;
        if($L > $s1)
        {
            $x2 = $x + $L * cos($a * PII);
            $y2 = $y + $L * sin($a * PII);
            $x2R = $x2 + $L / $s2 * cos(($a + $B) * PII);
            $y2R = $y2 + $L / $s2 * sin(($a + $B) * PII);
            $x2L = $x2 +$L / $s2 * cos(($a - $B) * PII);
            $y2L = $y2 + $L / $s2 * sin(($a - $B) * PII);

            $x1 = $x + $L / $s2 * cos($a * PII);
            $y1 = $y + $L / $s2 * sin($a * PII);
            $x1L = $x1 + $L / $s2 * cos(($a - $B) * PII);
            $y1L = $y1 + $L / $s2 * sin(($a - $B) * PII);
            $x1R = $x1 + $L / $s2 * cos(($a + $B) * PII);
            $y1R = $y1 + $L / $s2 * sin(($a + $B) * PII);

            ImageLine($im,(int)$x,  (int)$y,  (int)$x2,  (int)$y2,  $g);
            ImageLine($im,(int)$x2, (int)$y2, (int)$x2R, (int)$y2R, $g);
            ImageLine($im,(int)$x2, (int)$y2, (int)$x2L, (int)$y2L, $g);
            ImageLine($im,(int)$x1, (int)$y1, (int)$x1L, (int)$y1L, $g);
            ImageLine($im,(int)$x1, (int)$y1, (int)$x1R, (int)$y1R, $g);

            $this->drawLeaf($g, $x2,  $y2,  $L / $s3, $a + $C);
            $this->drawLeaf($g, $x2R, $y2R, $L / $s2, $a + $B);
            $this->drawLeaf($g, $x2L, $y2L, $L / $s2, $a - $B);
            $this->drawLeaf($g, $x1L, $y1L, $L / $s2, $a - $B);
            $this->drawLeaf($g, $x1R, $y1R, $L / $s2, $a + $B);
        }
    }
    function download(){

        $filename="http://zxf.ink/Public/Home/picture/images/pic1.jpg";
        $file  =  fopen($filename, "rb");
        Header( "Content-type:  application/octet-stream ");
        Header( "Accept-Ranges:  bytes ");
        Header( "Content-Disposition:  attachment;  filename= 1.jpg");
        $contents = "";
        while (!feof($file)) {
            $contents .= fread($file, 8192);
        }
        echo $contents;
        fclose($file);

    }
}