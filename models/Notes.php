<?php

namespace app\models;

use Yii;


class Notes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'notes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['note_text', 'user_id'], 'required'],
            [['user_id'], 'integer'],
            [['note_text'], 'string', 'max' => 500]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'note_id' => 'Note ID',
            'note_text' => 'Note Text',
            'user_id' => 'User ID',
			'foto' => 'Foto',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'user_id']);
    }
	
	 
    public function getNotes()
    {
        return $this->hasOne(Notes::className(), ['note_id' => 'note_id']);
    }
}