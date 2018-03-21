<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/7
 * Time: 15:26
 */
//gd库知识详解

$src='2.jpg';//图片
$font='msyhbd.ttf';//字体
$content='hello world';//文字内容
$info=getimagesize($src);//得到图片的信息，var_dump 看哈有什么属性
//var_dump($info);exit;
//根据图片的图像编号获取图片类型
$type=image_type_to_extension($info[2],false);//jpeg
//在内存中创建一个与图片类型一样的图像资源
$func='imagecreatefrom'.$type;
//把图片复制到我们的内存中
$image=$func($src);
/**
 * 给图片加文字水印
 */
$color=imagecolorallocatealpha($image,255,255,255,50);//字体颜色
//写入文字
imagettftext($image,20,10,20,80,$color,$font,$content);
//浏览器输出
//header("content-type:".$info['mime']);
$funimage='image'.$type;//imagejpeg();
//$funimage($image);//输出图片
//保存图片
$funimage($image,'./image/new'.md5(uniqid(microtime(true),true)).'.'.$type);
/**
 * 给图片添加图片水印
 */
//水印图片的路径
$image_mark='7.jpg';
$info2=getimagesize($image_mark);
$type2=image_type_to_extension($info2[2],false);
$func2='imagecreatefrom'.$type2;
$water=$func2($image_mark);//将水印图片复制到内存中
//合并图片
imagecopymerge($image,$water,20,30,0,0,$info2[0],$info2[1],30);
//销毁内存中的水印图片
imagedestroy($water);
//header("content-type:".$info2['mime']);
//$funimage2='image'.$type2;
//$funimage2($image);
/**
 * 缩略图
 */
//在内存中创建一个图片资源
$image_thumb=imagecreatetruecolor(300,200);
//将原图复制到新的资源上按照比例压缩
imagecopyresampled($image_thumb,$image,0,0,0,0,300,200,$info[0],$info[1]);
header("content-type:".$info['mime']);
$funimage='image'.$type;
$funimage($image_thumb);