<?php

namespace frontend\models;
use frontend\models\Company;
use Yii;

class Position extends \yii\db\ActiveRecord
{
	public static function tableName()
    {
        return 'position';
    }

	/*public function getsearch($search)
    {
        return $this->find()->where(['like','positionName',$search])->asArray()->all();
    }*/

    public function getCompany()
    {
        return $this->hasOne(Company::className(),['id'=>'c_id'])->asArray();
    }
}