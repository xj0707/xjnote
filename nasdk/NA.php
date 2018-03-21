<?php
header('content-type:text/html;charset=utf-8');
include 'NA_Config.php';
class NA{

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
        //post方式
        $url=NA_URL.'/dev/player/register';//玩家注册请求接口地址
        $ch=curl_init();
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_HEADER,0);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch,CURLOPT_POST,true);
        curl_setopt($ch,CURLOPT_POSTFIELDS,$jsonstr);
        // 设置HTTPS支持
        date_default_timezone_set('PRC');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        $output=curl_exec($ch);
        curl_close($ch);
        if($output){
            return json_decode($output);
        }else{
            return json_encode(['code'=>-5,'msg'=>'请求失败']);
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
        //post方式
        $url=NA_URL.'/dev/player';//玩家注册请求接口地址
        $ch=curl_init();
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_HEADER,0);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch,CURLOPT_POST,true);
        curl_setopt($ch,CURLOPT_POSTFIELDS,$jsonstr);
        // 设置HTTPS支持
        date_default_timezone_set('PRC');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        $output=curl_exec($ch);
        curl_close($ch);
        if($output){
            return json_decode($output);
        }else{
            return json_encode(['code'=>-5,'msg'=>'请求失败']);
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
    public function gameUserHandle($userName='',$amount='',$action='',$token){
        if(!$token){
            return json_encode(['code'=>-6,'msg'=>'token丢失！']);
        }
        //构建json数据
        $data=[
            'amount'=>$amount,
            'buId'=>NA_BUID,
            'gamePlatform'=>'NA',
            'action'=>$action
        ];

        $jsonstr=json_encode($data);
        //post方式
        $url=NA_URL."/dev/player/{$userName}/balance";//玩家注册请求接口地址
        $ch=curl_init();
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_HEADER,0);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch,CURLOPT_POST,true);
        curl_setopt($ch,CURLOPT_POSTFIELDS,$jsonstr);
        curl_setopt($ch,CURLOPT_HTTPHEADER,array(
            'Authorization:'.$token
        ));
        // 设置HTTPS支持
        date_default_timezone_set('PRC');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        $output=curl_exec($ch);
        curl_close($ch);
        if($output){
            return json_decode($output);
        }else{
            return json_encode(['code'=>-5,'msg'=>'请求失败']);
        }
    }

    /**
     * 玩家查询余额
     * @param $userName 用户账号
     * @param $token  登录后返回的token
     * @return string 返回json对象
     */
    public function gameUserBalance($userName='',$token){
        if(!$token){
            return json_encode(['code'=>-6,'msg'=>'token丢失！']);
        }
        //构建json数据
        $data=[
            'buId'=>NA_BUID,
            'gamePlatform'=>'NA'
        ];
        $jsonstr=http_build_query($data);
        $url=NA_URL."/dev/player/{$userName}/balance?".$jsonstr;//玩家注册请求接口地址
        $ch=curl_init();
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_HEADER,0);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch,CURLOPT_HTTPHEADER,array(
            'Authorization:'.$token
        ));
        // 设置HTTPS支持
        date_default_timezone_set('PRC');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        $output=curl_exec($ch);
        curl_close($ch);
        if($output){
            return json_decode($output);
        }else{
            return json_encode(['code'=>-5,'msg'=>'请求失败']);
        }
    }

    /**
     * 玩家修改密码
     * @param $userName 用户账号
     * @param $token  登录后返回的token
     * @return string 返回json对象
     */
    public function gameUserPwd($userName='',$userPwd='',$token){
        if(!$token){
            return json_encode(['code'=>-6,'msg'=>'token丢失！']);
        }
        //构建json数据
        $data=[
            'buId'=>NA_BUID,
            'gamePlatform'=>'NA',
            'userPwd'=>$userPwd
        ];
        $jsonstr=json_encode($data);
        //post方式
        $url=NA_URL."/dev/{$userName}/password";//玩家注册请求接口地址
        $ch=curl_init();
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_HEADER,0);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch,CURLOPT_POST,true);
        curl_setopt($ch,CURLOPT_POSTFIELDS,$jsonstr);
        curl_setopt($ch,CURLOPT_HTTPHEADER,array(
            'Authorization:'.$token
        ));
        // 设置HTTPS支持
        date_default_timezone_set('PRC');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        $output=curl_exec($ch);
        curl_close($ch);
        if($output){
            return json_decode($output);
        }else{
            return json_encode(['code'=>-5,'msg'=>'请求失败']);
        }
    }








}
