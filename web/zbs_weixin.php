<?php
define("TOKEN", "zhenbianshu");
header("content-type:text/html;charset=gb2312");
$wechatObj = new WechatCallbackapiTest();
//$wechatObj->valid();
$wechatObj->responseMsg();

class WechatCallbackapiTest{
    private $postStr;//客户端发来的信息
    private $postObj;//对客户端信息解码生成的SIMPLEXML对象
    private $fromUser;//信息客户端ID，也是返回的目录ID
    private $toUser;//本微信平台ID
    private $msgType;//客户端发来信息的类型
    private $keyword;//客户端TEXT信息内容
    private $weather_pos;//TEXT信息内容中的“天气@”的位置，没有则正常聊天
    private $translate_pos;//TEXT信息内容中的“翻译@”的位置，没有则正常聊天
    private $textTpl = "<xml>
            <ToUserName><![CDATA[%s]]></ToUserName>
            <FromUserName><![CDATA[%s]]></FromUserName>
            <CreateTime>%s</CreateTime>
            <MsgType><![CDATA[%s]]></MsgType>
            <Content><![CDATA[%s]]></Content>
            <FuncFlag>0</FuncFlag>
            </xml>";    
    //主回复函数
    public function responseMsg()
    {
        //$this->postStr=$_POST['msg'];
        $this->postStr=file_get_contents('php://input');
        //$this->postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
        libxml_disable_entity_loader(true);
        $this->postObj = simplexml_load_string($this->postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
        $this->fromUsername = $this->postObj->FromUserName;
        $this->toUsername = $this->postObj->ToUserName;   
        echo self::control();       
    }
    //数据类型控制中心
    private function control(){
        $this->msgType=$this->postObj->MsgType;
        switch ($this->msgType) {
            case 'event':
                return self::check_event(); 
            case 'text':
                return self::check_text();
            case 'image':
                return self::check_event(); 
            default:
                break;
        }
    }
    //文字信息处理函数，处理有查询天气和翻译时的逻辑
    private function check_text(){
        $this->keyword = trim($this->postObj->Content);
        echo $this->keyword;
        $this->weather_pos=strpos($this->keyword,"天气@");
        $this->translate_pos=strpos($this->keyword,"翻译@");
        if($this->weather_pos!==false){
            return self::reply_weather();
        }elseif($this->translate_pos!==false){
            return self::reply_translate();
        }else{
            return self::reply_chat();
        }
    }
    //事件处理函数
    private function check_event(){
        if($this->postObj->Event=='subscribe') {
            $reply_content= "感谢关注枕边书，您可以直接回复与小书聊天了哦~";
        }else{
            $reply_content = "待处理命令";
        }
        $sendType="text";
        $resultStr = sprintf($this->textTpl, $this->fromUsername, $this->toUsername, time(), $sendType, $reply_content);
        return $resultStr;
    }
    //回复机器人微信聊天
    private function reply_chat(){
        $url="http://www.tuling123.com/openapi/api?key=276bf9a37d5e884e0860a298bcbeeeaa&info=".$this->keyword;
        $reply_message=file_get_contents($url);
        $reply_json=json_decode($reply_message);
        $reply_content=$reply_json->text;
        $sendType = "text";
        $resultStr = sprintf($this->textTpl, $this->fromUsername, $this->toUsername, time(), $sendType, $reply_content);
        return $resultStr;
    }
    //处理天气请求
    private function reply_weather(){
        $city=trim(substr($this->keyword, $this->weather_pos+7));
        $city=urlencode($city);
        $code_url="http://apistore.baidu.com/microservice/cityinfo?cityname=".$city;
        $city_code_info=json_decode(file_get_contents($code_url));
        if($city_code_info->errNum==0){
            $city_code=$city_code_info->retData->cityCode;
            $weather_url="http://api.k780.com:88/?app=weather.today&weaid=".$city_code."&&appkey=16104&sign=e891ce6d65498cf6454e079b5f2a458d&format=json";
            $succ_res=json_decode(file_get_contents($weather_url))->success;
            if($succ_res==1){
                $weObj=json_decode(file_get_contents($weather_url))->result;
                $reply_content=$weObj->citynm."：天气".$weObj->weather."，\n温度：".$weObj->temperature."，\n现在温度：".$weObj->temperature_curr."\n".$weObj->wind.$weObj->winp; 
            }else{
                $reply_content="无法查询到具体的天气信息，请稍候再试。";
            }    
        }else{
            $reply_content="找不到您输入的城市信息";
        }
        $sendType = "text";
        $resultStr = sprintf($this->textTpl, $this->fromUsername, $this->toUsername, time(), $sendType, $reply_content);
        return $resultStr;
    }
    //处理翻译请求
    private function reply_translate(){
        $words=trim(substr($this->keyword, $this->translate_pos+7));
        $words=urlencode($words);
        $translate_url="http://fanyi.youdao.com/openapi.do?keyfrom=aweixinapi&key=56024777&type=data&doctype=json&version=1.1&q=".$words;
        $translate_info=json_decode(file_get_contents($translate_url));
        if($translate_info->errorCode==0){
            $explains=implode("\n",$translate_info->basic->explains);
            $reply_content="译为：".$explains;
        }else{
            $reply_content="无法翻译您的输入内容";
        }
        $sendType = "text";
        $resultStr = sprintf($this->textTpl, $this->fromUsername, $this->toUsername, time(), $sendType, $reply_content);
        return $resultStr;
    }








    //以下两个函数用来验证服务器的有效性
    /*public function valid(){
        $echoStr = $_GET["echostr"];
        if($this->checkSignature()){
            echo $echoStr;
        }
    }    
    private function checkSignature(){
        if (!defined("TOKEN")) {
            throw new Exception('TOKEN is not defined!');
        }
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];         
        $token = TOKEN;
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
    }*/
}
?>