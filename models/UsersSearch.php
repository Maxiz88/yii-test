<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\User;


class UsersSearch extends Model
{

    public function scenarios()
    {

        return Model::scenarios();
    }

    public function filter($params)
    {
        $query = User::find();
        $DataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 2,
            ],
        ]);
        $this->load($params);

        return $DataProvider;
    }
}