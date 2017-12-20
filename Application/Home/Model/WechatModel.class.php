<?php
/**
 * Created by PhpStorm.
 * User: xf
 * Date: 2017/9/17
 * Time: 21:41
 */
namespace Home\Model;
class WechatModel{
    //测试服务号
    private $AppID='wx8f36aadf9031c6c3';
    private $AppSecret='1cfc4138c3fbea3e8c015223b7f6c302';

    public function get_token(){
        $url='https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.$this->AppID.'&secret='.$this->AppSecret;
        $res=$this->curlRequest($url,'get');
        return $res['access_token'];
    }

    //moban xiaoxi
    public function send_temp($openid,$product,$price){
        //获取全局token
        $token = $this->get_token();
        $url="https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=".$token;//模板信息请求地址
        //发送的模板信息(微信要求json格式，这里为数组（方便添加变量）格式，然后转为json)
        $post_data = array(
                "touser"=>$openid,
                "template_id"=>"d7-o1EVAPmtlfVbTskmwOyhx03Gl7FPuKqYbxUEZtpE",
                "url"=>"http://www.baidu.com",
                "data"=> array(
                    "first" => array(
                        "value"=>"您有新客户，请及时查看！",
                        "color"=>"#173177"
                    ),
                    "product"=>array(
                        "value"=>$product,
                        "color"=>"#173177"
                    ),
                    "price"=>array(
                        "value"=>$price,
                        "color"=>"#173177"
                    ),
                    "remark"=> array(
                        "value"=>"请及时联系客户哦！",
                        "color"=>"#173177"
                    ),
                )
        );

        return $this->curlRequest($url,'post',json_encode($post_data));
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