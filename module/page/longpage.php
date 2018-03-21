<?php
/**
 * 长分页
 *
 */

require_once './function.php';
$content=file_get_contents('file.txt');
$page=isset($_GET['page'])?$_GET['page']:1;
$size=1000;
$content=unhtml($content);
$length=mb_strlen($content,'utf-8');
$count_page=ceil($length/$size);
$current=mysubstr($content,0,$page*$size);//当前页
$prev=mysubstr($content,0,($page-1)*$size);//上一页
$oupt=mb_substr($content,mb_strlen($prev,'utf-8'),mb_strlen($current,'utf-8')-mb_strlen($prev,'utf-8'),'utf-8');
?>
<div>
    <a href="page.html">返回</a>
</div>
<div>
    <?php echo $oupt?>
</div>
<a href="longpage.php?page=1">首页</a>
<?php
if($page-1!=0){
    $a=$page-1;
   echo "<a href='longpage.php?page= $a'>上一页</a>" ;
}
?>
<?php
if($page+1 <=$count_page){
    $b=$page+1;
    echo "<a href='longpage.php?page=$b'>下一页</a>";
}
?>
<a href="longpage.php?page=<?php echo $count_page?>">尾页</a>


