<?php
namespace Home\Controller;
use Think\Controller;

class WechatController extends Controller{
    private $wechat;

    public function __construct(){
	 	parent::__construct();
        $this->wechat = get_wechat_obj();
    }
    public function phpinfo(){
        phpinfo();
    }

    public function get_token(){
        $res=$this->wechat->get_token();
        dd($res);
    }

    //订阅号
    public function check(){
        //get post data, May be due to the different environments
        //get post data, May be due to the different environments
        $postStr = file_get_contents("php://input");

        //extract post data
        if (!empty($postStr)){
            /* libxml_disable_entity_loader is to prevent XML eXternal Entity Injection,
             the best way is to check the validity of xml by yourself */
            libxml_disable_entity_loader(true);
            $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
            $fromUsername = $postObj->FromUserName;
            $toUsername = $postObj->ToUserName;
            $time = time();
            $textTpl = "<xml>
                        <ToUserName><![CDATA[%s]]></ToUserName>
                        <FromUserName><![CDATA[%s]]></FromUserName>
                        <CreateTime>%s</CreateTime>
                        <MsgType><![CDATA[%s]]></MsgType>
                        <Content><![CDATA[%s]]></Content>
                        <FuncFlag>0</FuncFlag>
                        </xml>";
            if(true)
            {
                $msgType = "text";
                $contentStr = "Welcome to wechat world!";
                $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, 'text', $contentStr);
                echo $resultStr;
            }else{
                echo "Input something...";
            }

        }

    }
    public function test_1(){
        $obj=D('wechat');
        $res=$obj->get_token();
        dd($res);
    }
//测试服务号
    public function test()
    {
        //get post data, May be due to the different environments
        $postStr = file_get_contents("php://input");

        //extract post data
        if (!empty($postStr)){
            /* libxml_disable_entity_loader is to prevent XML eXternal Entity Injection,
             the best way is to check the validity of xml by yourself */
            libxml_disable_entity_loader(true);
            $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
            $fromUsername = $postObj->FromUserName;
            $toUsername = $postObj->ToUserName;
            $time = time();
            $textTpl = "<xml>
                        <ToUserName><![CDATA[%s]]></ToUserName>
                        <FromUserName><![CDATA[%s]]></FromUserName>
                        <CreateTime>%s</CreateTime>
                        <MsgType><![CDATA[%s]]></MsgType>
                        <Content><![CDATA[%s]]></Content>
                        <FuncFlag>0</FuncFlag>
                        </xml>";
            if(true)
            {
                $msgType = "text";
                $contentStr = $fromUsername;
                $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, 'text', $contentStr);
                echo $resultStr;
            }else{
                echo "Input something...";
            }

        }
    }
    public function send_temp(){
        $obj=D('wechat');
        $openid='op7qy0VWvpGezBKWJNah5EwrbWfo';
        $product='哈哈哈';
        $price='800元';
        $res=$obj->send_temp($openid,$product,$price);
        dd($res);
    }
//	public function test(){
//		$signature=$_GET["signature"];
//		$timestamp=$_GET["timestamp"];
//		$nonce=$_GET["nonce"];
//        $echoStr = $_GET["echostr"];
//		$token = 'zhouxun';
//		$tmpArr = array($token,$timestamp, $nonce);
//		sort($tmpArr,SORT_STRING);
//		$tmpStr = implode('',$tmpArr );
//		$tmpStr = sha1( $tmpStr);
////		echo $tmpStr.'<br>';
////		echo $signature;
//		if( $signature == $tmpStr){
//			echo $echoStr;
//		}else{
//			return false;
//		}
//	}

}