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
//$jsonObj=$naObj->gameUserRegister('xxx1001','a123456');//第一参数账号，第二参数密码，返回的结果是json对象

//4.调用方法，登录接口
//$jsonObj=$naObj->gameUserLogin('xxx1001','b123456');//第一参数账号，第二参数密码，返回的结果是json对象 包含token 和商家线路号
//var_dump($jsonObj);

//5.玩家充值或提现(先调用登录 在调用充值提现接口)
//注意：这里需要登录后返回的token 所以要确定是否返回了token
//if(isset($jsonObj->data->token)){
//    $responseJsonObj=$naObj->gameUserHandle('xxx1001','1000','-1',$jsonObj->data->token);//第一参数账号，第二参数金额，第三参数充值还是提现，第四参数是登录后返回的token,最后响应结果是json对象 包含余额
//}

//6.查询余额（需先调用登录接口在调用查询余额接口）
//注意：这里需要登录后返回的token 所以要确定是否返回了token
//if(isset($jsonObj->data->token)){
//    $responseJsonObj=$naObj->gameUserBalance('xxx1001',$jsonObj->data->token);//第一参数账号，第二参数登录后返回的token，返回的结果是json对象 返回提款余额
//}

//7.修改密码（需先调用登录接口在调用修改密码接口）
//注意：这里需要登录后返回的token 所以要确定是否返回了token
//if(isset($jsonObj->data->token)){
//    $responseJsonObj=$naObj->gameUserPwd('xxx1001','b123456',$jsonObj->data->token);//第一参数账号，第二参数新密码，第三参数登录后返回的token，返回的结果是json对象
//}
//var_dump($responseJsonObj);
//8.玩家投注记录
/**
 * 参数说明 $pageSize 为每页显示数量
 * $startTime 开始查询时间戳 毫秒
 * $endTime  结束时间戳 毫秒
 * $lastTime 最新一条记录的betTime（上一页的page.lastTime），如果为第一页默认传0
 * $userName 用户名可选参数
 * $gameId  游戏ID 可选参数
 */
//$startTime=strtotime('-1 day')*1000;//转换成毫秒数
//$endTime=time()*1000;//转换成毫秒数
//$lastTime=0;
//$pageSzie=5;
//$responseJsonObj=$naObj->recordList($pageSzie,$startTime,$endTime,$lastTime);
////打印json对象里面的list的数组
//var_dump($responseJsonObj->page->list);


























