
<?php
/**
 * 慕课网视频教学
 * 代码实例-PHP-cURL实战
 * 实例描述：登录慕课网并下载个人空间页面
 */
$data=array('username' => 'supamdinxj',
    'password' => 'admin',
    'merchantId'=>0,
    'islogin'=>1,
    'dosubmit'=>1);
$data=http_build_query($data);
$curlobj = curl_init();			// 初始化
curl_setopt($curlobj, CURLOPT_URL, "http://a.cn/admin/login/index.html");		// 设置访问网页的URL
curl_setopt($curlobj, CURLOPT_RETURNTRANSFER, true);			// 执行之后不直接打印出来

// Cookie相关设置，这部分设置需要在所有会话开始之前设置
date_default_timezone_set('PRC'); // 使用Cookie时，必须先设置时区
curl_setopt($curlobj, CURLOPT_COOKIESESSION, TRUE);
curl_setopt($curlobj, CURLOPT_HEADER, 0);
curl_setopt($curlobj, CURLOPT_FOLLOWLOCATION, 1); // 这样能够让cURL支持页面链接跳转

curl_setopt($curlobj, CURLOPT_POST, 1);
curl_setopt($curlobj, CURLOPT_POSTFIELDS, $data);
curl_setopt($curlobj, CURLOPT_HTTPHEADER, array("application/x-www-form-urlencoded; charset=utf-8",
    "Content-length: ".strlen($data)
));
curl_exec($curlobj);	// 执行
curl_setopt($curlobj, CURLOPT_URL, "http://a.cn/admin/index/index.html");
curl_setopt($curlobj, CURLOPT_POST, 0);
curl_setopt($curlobj, CURLOPT_HTTPHEADER, array("Content-type: text/xml"
));
$output=curl_exec($curlobj);	// 执行
curl_close($curlobj);			// 关闭cURL
echo $output;
?>