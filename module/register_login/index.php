<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>首页</title>
</head>
<body>
<?php
session_start();
if($_SESSION['id']){
    echo "<a href='#'>退出</a>";
}else{
    echo "<a href='#'>登录</a>";
}
?>
<h1>
    欢迎来到小小军的主页！！<?php echo $_SESSION['username'];?>
</h1>
</body>
</html>