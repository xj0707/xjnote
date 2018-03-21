<?php
namespace app\controllers;

use app\models\EntryForm;
use yii\helpers\Json;
use yii\web\Controller;

class IndexController extends Controller{
    public function actionIndex(){
        $message="Hello World!";
        return $this->render('index',['message'=>$message]);
    }

    public function actionSay($message='hello'){
        return $this->render('say',['message'=>$message]);
    }
    public function actionEntry(){
        $model=new EntryForm();
        if($model->load(\Yii::$app->request->post()) && $model->validate()){
            return $this->render('entry-confirm',['model'=>$model]);
        }else{
            return $this->render('entry',['model'=>$model]);
        }
    }







}