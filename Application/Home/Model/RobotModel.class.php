<?php
/**
 * Created by PhpStorm.
 * User: xf
 * Date: 2017/12/23
 * Time: 22:35
 * 图灵机器人 api
 */
namespace Home\Model;
class RobotModel{
    private $apikey="0ec66f0498414fb3988f8a034ec076be";
    private $apiurl="http://www.tuling123.com/openapi/api";

    public function sendMsg($info,$user_id){
        $data=array(
            'key'=>$this->apikey,
            'info'=>$info,
            'userid'=>$user_id,
        );
        $res=curlRequest($this->apiurl,'post',json_encode($data));
        return $res;
    }
}