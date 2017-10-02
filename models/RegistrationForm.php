<?php

namespace app\models;

use Yii;
use yii\base\Model;



class RegistrationForm extends Model
{

    public $username;
    public $email;
    public $password;
    public $captcha;

    public function rules()
    {
        return [
            [['username','email','password'], 'required', 'message' => '{attribute} не может быть пустым'],
            [['username', 'email', 'password'], 'filter', 'filter' => function($value) {
                return trim(htmlentities(strip_tags($value), ENT_QUOTES, 'UTF-8'));
            }],
            ['username', 'unique', 'targetClass' => '\app\models\User', 'message' => 'Это {attribute} уже занято'],
            ['username', 'string', 'min' => 2, 'max' => 20, 'tooShort' => '{attribute} должно быть от 3 до 20 символов'],
            ['email', 'email', 'message' => '{attribute} имеет неправильный формат'],
            ['email', 'string', 'max' => 50, 'tooShort' => '{attribute} должен быть до 50 символов'],
            ['email', 'unique', 'targetClass' => '\app\models\User', 'message' => 'Этот {attribute} уже занят'],
//            [['password'], 'validatePassword'],
            ['password', 'string', 'min' => 6, 'tooShort' => '{attribute} должен быть не меньше 6 символов'],
            ['captcha', 'required', 'message' => 'Код не может быть пустым'],
            ['captcha', 'captcha', 'message' => 'Введен неверный код'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'username' => 'Имя',
            'email' => 'Email',
            'password' => 'Пароль',
            'captcha' => 'Введите код с картинки',
        ];
    }

    public function registration()
    {

        if ($this->validate()) {

            $user = new User();
            $user->username = $this->username;
            $user->email = $this->email;
            $user->setPassword($this->password);
            $user->generateAuthKey();
            if(!$user->save()) {
                return false;
            }

        }
    }

}