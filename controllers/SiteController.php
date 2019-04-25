<?php

namespace app\controllers;

use app\models\SearchForm;
use Yii;
use yii\data\ArrayDataProvider;
use yii\filters\AccessControl;
use yii\httpclient\Client;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
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
     * {@inheritdoc}
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

        $searchForm = new SearchForm();

        if (\Yii::$app->request->isPost && $searchForm->load(\Yii::$app->request->post())) {
            if ($searchForm->validate())
                return $this->redirect(['site/search', 'q' => $searchForm->q]);
        }

        return $this->render('index', [
            'model' => $searchForm
        ]);
    }

    public function actionSearch($q, $start_from = 1, $size = 12) {
        $searchForm = new SearchForm();

        $searchForm->q = $q;
        $posts = $searchForm->getPosts($start_from, $size);

        return $this->render('search', [
            'start_from' => property_exists($posts, "next_from") ? $posts->next_from : 0,
            'posts' => $posts,
            'q' => $q,
        ]);

    }

    /**
     * @param $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionView($id) {

        $model = \Yii::$app->cache->get("newsfeed{$id}");

        if ($model == false) {
            throw new NotFoundHttpException("Newsfeed not found");
        }

        return $this->render('view', [
            'model' => $model,
        ]);

    }

}
