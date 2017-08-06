<?php
namespace Wechat\Controller;
use Think\Controller;
class WechatController extends Controller{
    // public function __construct(){
    //     parent::__construct();
    //     $this->WechatConnect();
    //     echo 111;
    // }
    public function WechatConnect(){

        $echoStr = $_GET["echostr"];

        //valid signature , option
        if($this->checkSignature()){
            echo $echoStr;
            exit;
        }
    }
    private function checkSignature()
    {
        // you must define TOKEN by yourself
        // if (!defined("TOKEN")) {
        //     throw new Exception('TOKEN is not defined!');
        // }

        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];
        $token = C('TOKEN');
        $tmpArr = array($token, $timestamp, $nonce);
        // use SORT_STRING rule
        sort($tmpArr, SORT_STRING);
        $tmpStr = implode( $tmpArr );
        $tmpStr = sha1( $tmpStr );

        if( $tmpStr == $signature ){
            return true;
        }else{
            return false;
        }
    }
}
