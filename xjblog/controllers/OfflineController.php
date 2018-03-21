<?php
namespace app\controllers;

use yii\web\Controller;

class OfflineController extends Controller{
    public function actionNotice(){
        echo '后台维护中....请稍后！！！！';
    }

}