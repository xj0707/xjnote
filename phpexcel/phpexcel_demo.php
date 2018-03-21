<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/13
 * Time: 15:05
 */
require_once './PHPExcel.php';
//1.实例化PHPExecl类
$objPHPExcel=new PHPExcel();
//2.获得当前活动的sheet的操作对象
$objSheet=$objPHPExcel->getActiveSheet();
//3.给当前活动的sheet去名字
$objSheet->setTitle('demo');
//4.向sheet填充数据
$objSheet->setCellValue('A1','姓名')->setCellValue('B1','分数');
$objSheet->setCellValue('A2','张三')->setCellValue('B2','80');
//5.按照指定的格式生成excel文件
$objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');
//6.保存文件指定目录
//$objWriter->save('./demo.xlsx');
//如果要浏览器输出则注释第六步
browser_export('Excel5','browser_excel03.xls');//输出到浏览器
$objWriter->save("php://output");
//输出到浏览器的方法
function browser_export($type,$filename){
        if($type=="Excel5"){
                header('Content-Type: application/vnd.ms-excel');//告诉浏览器将要输出excel03文件
        }else{
                header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');//告诉浏览器数据excel07文件
        }
        header('Content-Disposition: attachment;filename="'.$filename.'"');//告诉浏览器将输出文件的名称
        header('Cache-Control: max-age=0');//禁止缓存
}

/**
 * 第4步中可以写成这样 但是不建议 因为内存开销大
 * $array=array(
        array(),
 *      array('','姓名','分数'),
 *      array('','张三','80'),
 *      array('','李四','90')
 * );
 * $objSheet->fromArray($array);//直接加载数据块来填充数据
 */

