<?php
use yii\helpers\Html;
use app\components\HelloWidget;
?>
<?=Html::encode($message) ?>
<hr/>
<?=HelloWidget::widget(['message'=>'Good morning'])?>
