<?php

namespace app\extensions\provider\abstracts;

use Yii;
use yii\base\Model;

abstract class FormAbstracts extends Model
{
    public $providerName;
    public $grant_type;
    public $username;
    public $password;
    public $client_id;
    public $client_secret;

    public function rules()
    {
        return [
            [['grant_type', 'username', 'password'], 'required'],
            [['client_id', 'client_secret'], 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'username' => 'Login',
            'password' => 'Password',
        ];
    }
}