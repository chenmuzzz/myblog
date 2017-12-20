<?php
/**
 * Created by PhpStorm.
 * User: xf
 * Date: 2017/9/17
 * Time: 21:41
 */

class Wechat{
    private $AppID='wx8f36aadf9031c6c3';
    private $AppSecret='1cfc4138c3fbea3e8c015223b7f6c302';

    public function get_token(){
        $url='https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.$this->AppID.'&secret='.$this->AppSecret;
        $res=$this->curlRequest($url,'get');
        return $res;
    }

    private function curlRequest($url, $type = 'post', $request_data = '') {

        $header = array(
            "Content-Type:application/x-www-form-urlencoded;charset=UTF-8",
            "Connection:Keep-Alive",
            'Accept:application/json',
        );

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