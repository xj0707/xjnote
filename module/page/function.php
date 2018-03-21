<?php
header("content-type:text/html;charset=utf-8");
/**
 * 公共函数
 */
//字符串处理
function unhtml($content){
    $content=htmlspecialchars($content);
    $content=str_replace(chr(13),'<br>',$content);//替换文本中的换行符
    $content=str_replace(chr(32),'&nbsp;',$content);
    $content=strip_tags($content);
    return trim($content);
}
//自定义显示多长文本
function mysubstr($str,$start,$len){
    $tmpstr='';
    $length=$start+$len;
    for ($i=0;$i<$length;$i++){
        $tmpstr.=mb_substr($str,$i,1,'utf-8');
    }
    return $tmpstr;
}
