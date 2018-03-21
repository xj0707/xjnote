<?php
header('content-type:text/html;charset=utf-8');
echo '当前时间戳：'.time();

echo "<br/>";

echo  '前一天时间戳：'.strtotime('-1 day');
