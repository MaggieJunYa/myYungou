<?php
/**
 * created by zhang
 */
namespace Wechat\Controller;

use Think\Controller;

class WechatController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->valid();
//        $this->responseMsg();
    }

    //获取accesstoken值
    function getAccessToken()
    {
        $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=" . C('appID') . "&secret=" . C('appsecret');
        $res = $this->request($url);
        $accesstoken = json_decode($res)->access_token;
        return $accesstoken;
    }

    //curl请求
    function request($url, $data = null)
    {
        //初始化curl
        $ch = curl_init($url);
        //设置curl参数
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        if (!empty($data)) {
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        }
        //发送curl请求
        $access_token = curl_exec($ch);
        //关闭curl资源
        curl_close($ch);
        return $access_token;
    }

    //创建菜单
    function createMenu()
    {
        $access_token = $this->getAccessToken();
        $urls = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token={$access_token}";
        $data = " {
     \"button\":[
     {
          \"type\":\"click\",
          \"name\":\"今日歌曲\",
          \"key\":\"V1001_TODAY_MUSIC\"
      },
      {
           \"name\":\"菜单\",
           \"sub_button\":[
           {
               \"type\":\"view\",
               \"name\":\"搜索\",
               \"url\":\"http://www.soso.com/\"
            },
            {
               \"type\":\"click\",
               \"name\":\"赞一下我们\",
               \"key\":\"V1001_GOOD\"
            }]
       }]
 }";
        $res = $this->request($urls, $data);
        $json = json_decode($res);
        if ($json->errmsg == 'ok') {
            echo "自定义菜单创建成功";
        } else {
            var_dump($json->errmsg);
        }
    }

    //获取所有关注用户信息
    public function getuser()
    {
        $accesstoken = $this->getAccessToken();
        $url = "https://api.weixin.qq.com/cgi-bin/user/tag/get?access_token={$accesstoken}";
        $res = $this->request($url);
        dump(json_decode($accesstoken));
    }

    public function valid()
    {
        $echoStr = $_GET["echostr"];

        //valid signature , option
        if ($this->checkSignature()) {
            echo $echoStr;
            exit;
        }
    }

    public function responseMsg()
    {
        //get post data, May be due to the different environments
//        $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
        $postStr = file_get_contents("php://input", 'r');

        //extract post data
        if (!empty($postStr)) {
            /* libxml_disable_entity_loader is to prevent XML eXternal Entity Injection,
               the best way is to check the validity of xml by yourself */
            libxml_disable_entity_loader(true);
            $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
            $fromUsername = $postObj->FromUserName;
            $toUsername = $postObj->ToUserName;
            $keyword = trim($postObj->Content);
//            echo $keyword;die;
            $time = time();
//            $textTpl = "<xml>
//                          <ToUserName><![CDATA[%s]]></ToUserName>
//                          <FromUserName><![CDATA[%s]]></FromUserName>
//                          <CreateTime>%s</CreateTime>
//                          <MsgType><![CDATA[%s]]></MsgType>
//                          <Content><![CDATA[%s]]></Content>
//                          <FuncFlag>0</FuncFlag>
//                          </xml>";
            $type = $postObj->MsgType;
            $type = strval($type);
//            if (!empty($keyword)) {
//                $msgType = "text";
//                $contentStr = $postObj->MsgType;
//                $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
//                echo $resultStr;
            switch ($type) {
                case 'text':
                    if ($keyword == '图片') {
                        $tpl = C('tmp_arr')['image'];
                        $mediaid = 'ugfNTZx2wvRg5OEswctn0n4qOrFiRWoIl5dbEfA275et_uyJmJ4tBSMi7da6n7BN';
                        $resultStr = sprintf($tpl, $fromUsername, $toUsername, $time, 'image', $mediaid);
                        file_put_contents('wx.log', $resultStr, FILE_APPEND);
                        //返回格式化后的XML数据
                        echo $resultStr;
                    } elseif ($keyword == '音乐') {
                        $tpl = C('tmp_arr')['music'];
                        //定义与音乐相关的变量信息
                        $title = '傻瓜都一样';
                        $description = '描述个毛线';
                        $url = 'http://zhangshuxian.top/music.mp3';
                        $hqurl = 'http://zhangshuxian.top/music.mp3';
                        //使用sprintf函数对music模板进行格式化
                        $resultStr = sprintf($tpl, $fromUsername, $toUsername, $time, 'music', $title, $description, $url, $hqurl);
                        file_put_contents('wx.log', $resultStr, FILE_APPEND);
                        //返回格式化后的XML数据到客户端
                        echo $resultStr;
                    } elseif ($keyword == '单图文') {
                        $tpl = C('tmp_arr')['news'];
                        $count = 1;
                        $str = '<item>
                                    <Title><![CDATA[新垣结衣]]></Title>
                                    <Description><![CDATA[啦啦啦德玛西亚]]></Description>
                                    <PicUrl><![CDATA[http://zhangshuxian.top/1.jpg]]></PicUrl>
                                    <Url><![CDATA[http://zhangshuxian.top/]]></Url>
                                    </item>';
                        //使用sprintf函数对XML模板进行格式化
                        $resultStr = sprintf($tpl, $fromUsername, $toUsername, $time, 'news', $count, $str);
                        //使用file_put_contents把格式化后的XML代码写入到日志中
                        file_put_contents('wx.log', $resultStr, FILE_APPEND);
                        //返回格式化后的XML数据到客户端
                        echo $resultStr;
                    } elseif ($keyword == '文本') {
                        $accesstoken = $this->getAccessToken();
                        $url = "https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token={$accesstoken}";
                        $contentStr = urlencode("客服消息");
                        $content_arr = array('content' => $contentStr);
                        $reply_arr = array('touser' => "{$fromUsername}", 'msgtype' => 'text', 'text' => $content_arr);
                        $data = json_encode($reply_arr);
                        $data = urldecode($data);
                        $this->request($url, $data);
                    } elseif ($keyword == '图文') {
                        $accesstoken = $this->getAccessToken();
                        $url = "https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token={$accesstoken}";
                        //定义要发送的图文信息
                        $content_arr2 = array(
                            'title' => urlencode("人生必看的18部小说"),
                            'url' => 'http://zhangshuxian.top',
                            'picurl' => 'http://zhangshxuian.top/2.jpg'
                        );
                        $content_arr1 = array(
                            'title' => urlencode('看我大女神新垣结衣'),
                            'url' => 'http://zhangshuxian.top',
                            'picurl' => 'http://zhangshuxian.top/1.jpg'
                        );
                        $content_arr = array($content_arr1, $content_arr2);
                        $content_arr = array('articles' => $content_arr);
                        $reply_arr = array('touser' => "{$fromUsername}", 'msgtype' => 'news', 'news' => $content_arr);
                        $data = json_encode($reply_arr);
                        $data = urldecode($data);
                        $this->request($url, $data);
                    }
                    break;
                case 'image':
                    $contentStr = "您发送的是图片消息";
                    $tpl = C('tmp_arr')['text'];
                    $resultStr = sprintf($tpl, $fromUsername, $toUsername, $time, 'text', $contentStr);
                    echo $resultStr;
                    break;
                case 'voice':
                    $contentStr = "您发送的是语音消息";
//                    $contentStr = $this->getAccessToken();
                    $tpl = C('tmp_arr')['text'];
                    $resultStr = sprintf($tpl, $fromUsername, $toUsername, $time, 'text', $contentStr);
                    echo $resultStr;
                    break;
                case 'event':
                    if ($postObj->Event == "subscribe") {
                        $contentStr = "感谢您关注php学院";
                        $tpl = C('tmp_arr')['text'];
                        $resultStr = sprintf($tpl, $fromUsername, $toUsername, $time, 'text', $contentStr);
                    }
                    if ($postObj->Event == 'CLICK' && $postObj->EventKey == 'V1001_TODAY_MUSIC') {
                        $tpl = C('tmp_arr')['music'];
                        //定义与音乐相关的变量信息
                        $title = '傻瓜都一样';
                        $description = '描述个毛线';
                        $url = 'http://zhangshuxian.top/music.mp3';
                        $hqurl = 'http://zhangshuxian.top/music.mp3';
                        //使用sprintf函数对music模板进行格式化
                        $resultStr = sprintf($tpl, $fromUsername, $toUsername, $time, 'music', $title, $description, $url, $hqurl);
                    }
                    file_put_contents('wx.log', $resultStr, FILE_APPEND);
                    echo $resultStr;
                    break;
            }
        } else {
            echo "";
            exit;
        }
    }

    private function checkSignature()
    {
        // you must define TOKEN by yourself
//        if (!defined("TOKEN")) {
//            throw new Exception('TOKEN is not defined!');
//        }

        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];

        $token = C('TOKEN');
        $tmpArr = array($token, $timestamp, $nonce);
        // use SORT_STRING rule
        sort($tmpArr, SORT_STRING);
        $tmpStr = implode($tmpArr);
        $tmpStr = sha1($tmpStr);

        if ($tmpStr == $signature) {
            return true;
        } else {
            return false;
        }
    }
}
