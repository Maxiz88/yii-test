<?php

namespace app\controllers;

use Yii;
use app\models\UsersSearch;
use yii\web\Controller;


class UsersController extends Controller
{


   
    public function actionIndex()
    {
        if(!Yii::$app->user->isGuest) {
            $users = new UsersSearch();
            $dataProvider = $users->filter(Yii::$app->request->queryParams);

            return $this->render('index', [
                'users' => $users,
                'dataProvider' => $dataProvider,
            ]);
        } else {
            return $this->goHome();
        }
    }


}