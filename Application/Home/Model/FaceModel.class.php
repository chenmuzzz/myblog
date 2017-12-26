<?php
/**
 * Created by PhpStorm.
 * User: xf
 * Date: 2017/9/17
 * Time: 21:41
 */
namespace Home\Model;
class FaceModel{
    private $apikey="rPQPVtIaz-k2hJsSqM3Em_d6Vtz5Zqkl";
    private $apisecret="YQF5k3J1okcnqQ2CXCSVOyccDLLe8MUX";
    private $url="https://api-cn.faceplusplus.com/facepp/v3/detect";
    public function test($img=''){
        if($img){
            $image_url="http://101.132.186.27/Public/Home/picture/images/".$img.'.jpg';
        }else{
            $image_url="http://101.132.186.27/Public/Home/picture/images/pic9.jpg";
        }
//        return  "<img src=".$img.">";
        $return_landmark=0;
        $return_attributes='gender,age,smiling,headpose,facequality,blur,eyestatus,emotion,ethnicity,beauty,mouthstatus,eyegaze,skinstatus';
        $data['api_key']=$this->apikey;
        $data['api_secret']=$this->apisecret;
        $data['image_url']=$image_url;
        $data['return_landmark'] = $return_landmark;
        $data['return_attributes']=$return_attributes;
        $res=$this->curlRequest($this->url,'post',$data);
        return $res;
    }
    private function curlRequest($url, $type = 'post', $request_data = '') {

//        $header = array(
//            "Content-Type:application/x-www-form-urlencoded;charset=UTF-8",
//            "Connection:Keep-Alive",
//            'Accept:application/json',
//        );
$header = '';
        $this->ch = curl_init();
        /* cURL settings */
        curl_setopt($this->ch, CURLOPT_URL, $url);

        curl_setopt($this->ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($this->ch, CURLOPT_TIMEOUT, 10);

        curl_setopt($this->ch, CURLOPT_HEADER, 0);
        curl_setopt($this->ch, CURLOPT_HTTPHEADER, $header);

        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);
        if ($type == 'post') {
            curl_setopt($this->ch, CURLOPT_POST, true);
            curl_setopt($this->ch, CURLOPT_POSTFIELDS, $request_data);
        }
        $result = curl_exec($this->ch);
        curl_close($this->ch);

        return $data = empty($result) ? array() : json_decode($result, true);
    }
}