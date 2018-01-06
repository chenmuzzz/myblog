<?php
namespace Home\Controller;

use Think\Controller;


class MyController extends HomeController
{
    public function __construct()
    {
        parent::__construct();
    }
    //最大子序列和
    function test(){
        $arr = array(1,2,-3,4,-6,2,9,-8,4,-3,8);
        $arr1 = array(1,12,-13,14,-2,6,2,-2,14,3,1);
        for($i=0;$i<80000;$i++){
            $arr[]=mt_rand(-14,12);
        }
        echo count($arr).'<br>';
        $res = $this->get1($arr);
        $res1 = $this->get($arr);
        var_dump($res);
        dd($res1);
    }
    function get($arr){
        if(count($arr) == 1){
            if($arr[0] > 0){
                return $arr[0];
            }else{
                return 0;
            }
        }
        $left = array_slice($arr,0,floor(count($arr)/2));
        $right =array_slice($arr,floor(count($arr)/2));
        //求中间数最大
        $max_left = 0;
        $temp_max_left=0;
        for($i=floor(count($arr)/2)-1;$i>=  0;$i--){
            $max_left+=$arr[$i];
            if($max_left>$temp_max_left){
                $temp_max_left=$max_left;
            }
        }
        $max_right = 0;
        $temp_max_right=0;
        for($i=floor(count($arr)/2);$i<count($arr);$i++){
            $max_right+=$arr[$i];
            if($max_right>$temp_max_right){
                $temp_max_right = $max_right;
            }
        }
        return $this->max($this->get($left),$this->get($right),$temp_max_right+$temp_max_left);
    }
    function max($a,$b,$c){
        return $a > $b ? ($a > $c ? $a :$c) : ( $b > $c ? $b : $c);
    }
    //更好的求解子序列最大值问题
    function get1($arr){
        $max = 0;
        $now=0;
        for($i=0;$i<count($arr);$i++){
            $now += $arr[$i];
            if($now>$max){
                $max=$now;
            }
            if($now < 0){
                $now =0;
            }
        }
        return $max;
    }
}