<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "weeks".
 *
 * @property integer $week_id
 * @property string $week_text
 * @property integer $user_id
 *
 * @property Users $user
 */
class Weeks extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'weeks';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['week_text', 'user_id'], 'required'],
            [['user_id'], 'integer'],
            [['week_text'], 'string', 'max' => 500]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'week_id' => 'Week ID',
            'week_text' => 'Week Text',
            'user_id' => 'User ID',
			'foto' => 'Foto',
			'description' => 'Description',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'user_id']);
    }
	
	 
    public function getWeeks()
    {
        return $this->hasOne(Weeks::className(), ['week_id' => 'week_id']);
    }
}