<?php

namespace frontend\models;
use frontend\models\Position;
use Yii;

/**
 * This is the model class for table "company".
 *
 * @property string $id
 * @property string $full_name
 * @property string $abbreviation
 * @property string $logo
 * @property string $url
 * @property string $citya
 * @property string $domain_id
 * @property string $scale_id
 * @property string $phase_id
 * @property string $investment
 * @property string $label_id
 * @property string $desc_c
 * @property integer $u_id
 * @property string $tel
 * @property string $email
 * @property string $stageorg
 * @property string $company_desc
 */
class Company extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'company';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['full_name', 'citya', 'u_id'], 'required'],
            [['u_id'], 'integer'],
            [['full_name', 'citya', 'domain_id', 'scale_id', 'phase_id', 'label_id', 'desc_c'], 'string', 'max' => 200],
            [['abbreviation', 'logo', 'url', 'investment'], 'string', 'max' => 45],
            [['tel'], 'string', 'max' => 15],
            [['email'], 'string', 'max' => 40],
            [['stageorg', 'company_desc'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'full_name' => 'Full Name',
            'abbreviation' => 'Abbreviation',
            'logo' => 'Logo',
            'url' => 'Url',
            'citya' => 'Citya',
            'domain_id' => 'Domain ID',
            'scale_id' => 'Scale ID',
            'phase_id' => 'Phase ID',
            'investment' => 'Investment',
            'label_id' => 'Label ID',
            'desc_c' => 'Desc C',
            'u_id' => 'U ID',
            'tel' => 'Tel',
            'email' => 'Email',
            'stageorg' => 'Stageorg',
            'company_desc' => 'Company Desc',
        ];
    }

    //查询公司数据
    public function getAll()
    {
        return $this->find()->asArray()->all();
    }
}
