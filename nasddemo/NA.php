<?php
header('content-type:text/html;charset=utf-8');
include 'NA_Config.php';
class NA{
    /**
     * http post请求
     * @param $url  请求URL
     * @param $post_data  请求post的参数
     */
    public function httpPost($url,$post_data,$token=''){
        $ch=curl_init();
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_HEADER,0);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch,CURLOPT_POST,true);
        curl_setopt($ch,CURLOPT_POSTFIELDS,$post_data);
        if($token){
            curl_setopt($ch,CURLOPT_HTTPHEADER,array(
                'Authorization:'.$token
            ));
        }
        $output=curl_exec($ch);
        curl_close($ch);
        if($output){
            return json_decode($output);
        }else{
            return json_encode(['code'=>-5,'msg'=>'请求超时']);
        }
    }

    /**
     * http get 请求
     * @param $url  请求URL
     * @param string $token 根据需求加的一个token
     */
    public function httpGet($url,$token=''){
        $ch=curl_init();
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_HEADER,0);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        if($token){
            curl_setopt($ch,CURLOPT_HTTPHEADER,array(
                'Authorization:'.$token
            ));
        }
        $output=curl_exec($ch);
        curl_close($ch);
        if($output){
            return json_decode($output);
        }else{
            return json_encode(['code'=>-5,'msg'=>'请求超时']);
        }
    }

    /**
     * https post 请求
     * @param $url  请求URL
     * @param $post_data 请求数据
     * @param string $token 是否需要附加token信息
     */
    public function httpsPost($url,$post_data,$token=''){
        $ch=curl_init();
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_HEADER,0);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch,CURLOPT_POST,true);
        curl_setopt($ch,CURLOPT_POSTFIELDS,$post_data);
        if($token){
            curl_setopt($ch,CURLOPT_HTTPHEADER,array(
                'Authorization:'.$token
            ));
        }
        // 设置HTTPS支持
        date_default_timezone_set('PRC');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        $output=curl_exec($ch);
        curl_close($ch);
        if($output){
            return json_decode($output);
        }else{
            return json_encode(['code'=>-5,'msg'=>'请求超时']);
        }
    }

    /**
     * https get请求
     * @param $url 请求URL
     * @param string $token 是否需要token验证
     */
    public function httpsGet($url,$token=''){
        $ch=curl_init();
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_HEADER,0);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        if($token){
            curl_setopt($ch,CURLOPT_HTTPHEADER,array(
                'Authorization:'.$token
            ));
        }
        // 设置HTTPS支持
        date_default_timezone_set('PRC');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        $output=curl_exec($ch);
        curl_close($ch);
        if($output){
            return json_decode($output);
        }else{
            return json_encode(['code'=>-5,'msg'=>'请求超时']);
        }
    }

    /**
     * 根据配置的URL 来确定是http 请求还是https请求
     * @param string $url
     * @return string
     */
    public function changeMethod($url=''){
        if($url){
            preg_match('/https/',$url,$parr);
        }else{
            preg_match('/https/',NA_URL,$parr);
        }
        if(empty($parr)){
            return  'http';
        }else{
            return 'https';
        }
    }

    /**
     * 玩家注册方法
     * @param $userName 玩家账号6-12字母、数字、下划线组成
     * @param $userPwd 玩家密码6-16个字符，数字、字母组成
     * @return string 返回json对象
     */
    public function gameUserRegister($userName='',$userPwd=''){
        //构建json数据
        $data=[
            'userName'=>$userName,
            'userPwd'=>$userPwd,
            'apiKey'=>NA_APIKEY,
            'buId'=>NA_BUID,
            'userType'=>1,
            'gamePlatform'=>'NA'
        ];
        $jsonstr=json_encode($data);
        $url=NA_URL.'/dev/player/register';//玩家注册请求接口地址
        if($this->changeMethod($url)=='http'){
            return $this->httpPost($url,$jsonstr);
        }else{
            return $this->httpsPost($url,$jsonstr);
        }
    }

    /**
     * 玩家登录
     * @param $userName 用户名
     * @param $userPwd 密码
     * @return string 返回json对象
     */
    public function gameUserLogin($userName='',$userPwd=''){
        //构建json数据
        $data=[
            'userName'=>$userName,
            'userPwd'=>$userPwd,
            'apiKey'=>NA_APIKEY,
            'buId'=>NA_BUID,
            'gamePlatform'=>'NA'
        ];
        $jsonstr=json_encode($data);
        $url=NA_URL.'/dev/player';//玩家注册请求接口地址
        if($this->changeMethod($url)=='http'){
            return $this->httpPost($url,$jsonstr);
        }else{
           return  $this->httpsPost($url,$jsonstr);
        }
    }

    /**
     * 玩家充值/提现操作
     * @param $userName 玩家账号
     * @param $amount 玩家充值金额
     * @param $action 1为充值操作 -1为提现操作
     * @param $token 登录后有返回token
     * @return string 方法json对象 内含余额
     */
    public function gameUserHandle($userName='',$amount='',$action='',$token=''){
        //构建json数据
        $data=[
            'amount'=>$amount,
            'buId'=>NA_BUID,
            'gamePlatform'=>'NA',
            'action'=>$action
        ];
        $jsonstr=json_encode($data);
        $url=NA_URL."/dev/player/{$userName}/balance";//玩家注册请求接口地址
        if($this->changeMethod($url)=='http'){
            return $this->httpPost($url,$jsonstr,$token);
        }else{
            return $this->httpsPost($url,$jsonstr,$token);
        }
    }

    /**
     * 玩家查询余额
     * @param $userName 用户账号
     * @param $token  登录后返回的token
     * @return string 返回json对象
     */
    public function gameUserBalance($userName='',$token=''){
        //构建json数据
        $data=[
            'buId'=>NA_BUID,
            'gamePlatform'=>'NA'
        ];
        $jsonstr=http_build_query($data);
        $url=NA_URL."/dev/player/{$userName}/balance?".$jsonstr;//玩家注册请求接口地址
        if($this->changeMethod($url)=='http'){
            return $this->httpGet($url,$token);
        }else{
            return $this->httpsGet($url,$token);
        }
    }

    /**
     * 玩家修改密码
     * @param $userName 用户账号
     * @param $token  登录后返回的token
     * @return string 返回json对象
     */
    public function gameUserPwd($userName='',$userPwd='',$token=''){
        //构建json数据
        $data=[
            'buId'=>NA_BUID,
            'gamePlatform'=>'NA',
            'userPwd'=>$userPwd
        ];
        $jsonstr=json_encode($data);
        $url=NA_URL."/dev/{$userName}/password";//玩家注册请求接口地址
        if($this->changeMethod($url)=='http'){
            return $this->httpPost($url,$jsonstr,$token);
        }else{
            return $this->httpsPost($url,$jsonstr,$token);
        }
    }

    /**
     * 玩家投注记录
     * @param string $pageSzie  每页显示数
     * @param int $startTime 开始时间
     * @param int $endTime 结束时间
     * @param int $lastTime 最新一条记录的betTime（上一页的page.lastTime），如果为第一页填当前时间
     */
    public function recordList($pageSzie='',$startTime='',$endTime='',$lastTime=0,$userName='',$gameId=''){
        if($lastTime==0){
            $lastTime=time()*1000;//转换为毫秒
        }
        //构建json数据
        $data=[
            'buId'=>NA_BUID,
            'userName'=>$userName,
            'gameId'=>$gameId,
            'apiKey'=>NA_APIKEY,
            'pageSize'=>$pageSzie,
            'startTime'=>$startTime,
            'endTime'=>$endTime,
            'lastTime'=>$lastTime
        ];
        $jsonstr=json_encode($data);
        $url=NA_URL."/dev/game/player/record/list";//玩家注册请求接口地址
        if($this->changeMethod($url)=='http'){
            return $this->httpPost($url,$jsonstr);
        }else{
            return $this->httpsPost($url,$jsonstr);
        }
    }






}
