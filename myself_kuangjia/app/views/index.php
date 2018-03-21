<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<h1>视图文件</h1>
<h3>
    <?php
    foreach($res as $v){
        echo '用户名：'.$v['username'].'<br/>';
    }
?></h3>

</body>
</html>