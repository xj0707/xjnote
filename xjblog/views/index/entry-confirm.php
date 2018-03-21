<?php
use yii\helpers\Html;
?>
<p>你输入的信息</p>
<ul>
    <li><label>Name</label>:<?= Html::encode($model->name)?></li>
    <li><label>Email</label>:<?= Html::encode($model->email)?></li>
</ul>
