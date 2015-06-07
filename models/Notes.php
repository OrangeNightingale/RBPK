<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "notice".
 *
 * @property string $id
 * @property string $google_id
 * @property string $name
 * @property string $note
 */
class Notes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'notice';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'note'], 'string'],
            [['google_id'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'google_id' => 'Google ID',
            'name' => 'Name',
            'note' => 'Note',
        ];
    }
}
