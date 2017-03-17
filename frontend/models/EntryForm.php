<?php
namespace frontend\models;
use yii\base\Model;
class EntryForm extends Model {
    public $username;
    public $pwd;
    public $status;
    public $flag;
    /*public function rules()
    {
        return [
            [['name', 'email'], 'required'],
            ['email', 'email'],
        ];
    }*/ 
}

