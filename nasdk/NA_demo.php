<?php
/**
 * 返回结果状态说明
 * 状态码    说明
 * 0       操作成功
 * 500     服务器错误
 * 10000   数据错误
 * 10001   商家不存在
 * 10002   apiKey错误
 * 10003   用户已注册
 * 10004   用户不存在
 * 10005   密码错误
 * 10006   账号被禁止登录
 * 10007   商家点数不足
 * 10008   玩家点数不足
 * 11000   token错误
 */
//用法示例说明
// 在NA_Config.php配置 配置参数后
//1.加载NA.php文件
include 'NA.php';
//2.实例类
$naObj=new NA();
//3.调用方法，如：注册接口
//$jsonObj=$naObj->gameUserRegister('test456','test123');//第一参数账号，第二参数密码，返回的结果是json对象
//4.调用方法，登录接口
$jsonObj=$naObj->gameUserLogin('test456','1234567');//第一参数账号，第二参数密码，返回的结果是json对象 包含token 和商家线路号
var_dump($jsonObj);
//5.玩家充值或提现
//注意：这里需要登录后返回的token 所以要确定是否返回了token
if(isset($jsonObj->data->token)){
    $responseJsonObj=$naObj->gameUserHandle('test456','1','1',$jsonObj->data->token);//第一参数账号，第二参数金额，第二参数充值还是提现，第三参数是登录后返回的token,最后响应结果是json对象 包含余额
}
//6.查询余额
//注意：这里需要登录后返回的token 所以要确定是否返回了token
if(isset($jsonObj->data->token)){
    $responseJsonObj=$naObj->gameUserBalance('test456',$jsonObj->data->token);//第一参数账号，第二参数登录后返回的token，返回的结果是json对象 返回提款余额
}
//7.修改密码
//注意：这里需要登录后返回的token 所以要确定是否返回了token
//if(isset($jsonObj->data->token)){
//    $responseJsonObj=$naObj->gameUserPwd('test456','1234567',$jsonObj->data->token);//第一参数账号，第二参数新密码，第三参数登录后返回的token，返回的结果是json对象
//}