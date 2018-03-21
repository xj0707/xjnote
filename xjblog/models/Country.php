<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Country".
 *
 * @property string $code
 * @property string $name
 * @property integer $population
 */
class Country extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Country';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['code', 'name'], 'required'],
            [['population'], 'integer'],
            [['code'], 'string', 'max' => 2],
            [['name'], 'string', 'max' => 52],
        ];
    }

    /**
     * @inheritdoc这是自动生成的标签，你可以自己定义
     */
    public function attributeLabels()
    {
        return [
            'code' => '代号',
            'name' => '名字',
            'population' => \Yii::t('app','人口'),
        ];
    }


}
