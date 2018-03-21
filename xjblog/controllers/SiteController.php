<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

//语音播报
    public function actionYy(){
        $token='abc';
        echo Json::encode(['code' => 1 , 'msg' => '发送失败','url'=>"http://localhost/tigergame/public/index.php/admin/login/apilogin/token/2933ndsWDu5fDkCaXo2kAaG4z3W0quTaTE9vjtjTslnWiuFZ17bEWDhRp6UaAiQOD5MoqDVnhPJGRg1NRoHOqh0lJT5xboqFsRcLg2qy9NyFE69B2Eo9FNrQ2SIW6WeeJsJhgdt3zaU-qCHF86cyD6HdULwpu4KFiz0YnWOe1PyzTAWKKZUHzZNBb64QzSPwAvbjtVcdFCD4N5fAOD8QuYwROOQfm0WGK5j-VqQtUECWJUoxZv0XtVepeJXNcIW5-PiUI6ULMhurmTBZ26Iyqlq1fadbF8gstFYzZM9pisvVlUh8YmV2xQ.html"]);
        yii::$app->end();
    }


}
