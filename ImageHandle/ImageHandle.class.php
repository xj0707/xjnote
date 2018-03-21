<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/7
 * Time: 16:38
 */
//封装一个对图片进行文字水印，图片水印，缩略图等操作。
class ImageHandle{
    private static $info;//保存图片信息
    private static $infotype;//图片的类型后缀。
    private static $image;//保存图片资源
    public function __construct($src){
        self::$info=getimagesize($src);//获取图片信息
        self::$infotype=image_type_to_extension(self::$info[2],false);//获取图片后缀
        $func='imagecreatefrom'.self::$infotype;
        //把图片复制到我们的内存中
        self::$image=$func($src);
    }
    //缩略图
    public function thumb($width,$height){
        //在内存中创建一个图片资源
        $image_thumb=imagecreatetruecolor($width,$height);
        //将原图复制到新的资源上按照比例压缩
        imagecopyresampled($image_thumb,self::$image,0,0,0,0,$width,$height,self::$info[0],self::$info[1]);
        imagedestroy(self::$image);//压缩的时候原来的图片就不需要了所以删除
        self::$image=$image_thumb;//这里把新的资源放在图片里面
    }

    /**
     * 添加文字水印
     * @param $content文字内容
     * @param int $fontsize 文字尺寸
     * @param int $angle 文字角度
     * @param array $location 文字起始位置的坐标
     * @param string $font 文字字体
     * @param array $color 文字的颜色
     * @param int $alpha 透明度
     */
    public function fontMark($content,$fontsize=20,$angle=0,$location=array(30,50),$font='msyhbd.ttf',$color=array(255,255,255),$alpha=50){
        $col=imagecolorallocatealpha(self::$image,$color[0],$color[1],$color[2],$alpha);//字体颜色
        imagettftext(self::$image,$fontsize,$angle,$location[0],$location[1],$col,$font,$content); //写入文字
    }

    /**
     * //添加图片水印
     * @param $image_mark 图片水印路径
     * @param array $location 水印的起始位置坐标
     * @param int $alpha 透明度
     */
    public function imageMark($image_mark,$location=array(20,20),$alpha=30){
        $info=getimagesize($image_mark);
        $type=image_type_to_extension($info[2],false);
        $func='imagecreatefrom'.$type;
        $water=$func($image_mark);//将水印图片复制到内存中
        //合并图片
        imagecopymerge(self::$image,$water,$location[0],$location[1],0,0,$info[0],$info[1],$alpha);
        //销毁水印图片
        imagedestroy($water);
    }
    //保存图片
    public function save($imagesrc='image'){
        $funimage='image'.self::$infotype;
        $newname=md5(uniqid(microtime(true),true)).'.'.self::$infotype;
        if(!file_exists($imagesrc)){
            mkdir($imagesrc,'0777',true);
        }
        $funimage(self::$image,$imagesrc.'/'.$newname);
    }
    //输出图片到页面
    public function show(){
        header("content-type:".self::$info['mime']);//输出在浏览器需要这个
        $funs='image'.self::$infotype;
        $funs(self::$image);
    }
    //销毁图片（操作结束都要销毁图片）
    public function __destruct()
    {
        imagedestroy(self::$image);
    }
}
$src="4.jpg";
$imageHandle=new ImageHandle($src);
$imageHandle->thumb(1000,800);
$imageHandle->fontMark('hehe');
$imageHandle->imageMark('8.jpg');
$imageHandle->show();
$imageHandle->save();