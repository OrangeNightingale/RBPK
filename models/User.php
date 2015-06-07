<?php

namespace app\models;

use Yii;


/**
 * This is the model class for table.
 *
 * @property integer $id
 * @property integer $active
 * @property string $name
 * @property string $email
 * @property string $passHash

 */
class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    /**
     * @inheritdoc
     */

    public $password;
    public $confirmation;


    public static function tableName()
    {
        return 'users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'email', 'passHash'], 'required', 'message'=>'Поле "{attribute}" не может быть пустым.'],
            [['name', 'email', 'passHash'], 'string', 'max' => 255],
            ['name', 'match', 'pattern'=>'/[a-zA-Zа-яёА-Я][a-zA-Zа-яёА-Я\\s-]+$/', 'message' => 'Пожалуйста, введите корректное имя'],
            ['email', 'email', 'message' => 'Пожалуйста, введите корректный email'],
            ['email', 'validateEmail'],
            ['confirmation', 'compare', 'compareAttribute'=>'password', 'message'=>"Подтверждение пароля не совпадает с паролем."]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Имя',
            'email' => 'Email',
            'passHash' => 'Хэш пароля',
            
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    

    /**
     * @return \yii\db\ActiveQuery
     */
   

    public static function findByEmail($email)
    {
        $user = User::find()->where(['email' => $email])->one();
        return $user;
    }

    public function checkPassword($password)
    {
        return $this->getAttribute('passHash') == md5($password);
    }

    public function updateLc()
    {
        if($this->password!='')
        {
            $this->passHash = md5($this->password);
        }
        return $this->save();
    }

    public function validateEmail($attribute, $params)
    {
        foreach (User::find()->where(['email'=>$this->email])->all() as $value) {
            if($value->id != $this->id)
            {
                $this->addError('email','Данный email уже используется.');
            }
        }

    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        $user = User::find()->where(['passHash' => $token])->one();
        return $user;
    }

    public function getId()
    {
        return $this->id + 3010;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->email;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->email === $authKey;
    }

     public static function findIdentity($id)
    {
        $user = User::find()->where(['id' => $id - 3010])->one();
        return $user;
    }
	
	public function getWeeks()
    {
        //return $this->hasOne(Weeks::className(), ['week_id' => 'week_id']);
		$weeks = Weeks::find()->orderBy('week_id');
		return $weeks;
    }
	
	public function getFriends()
    {
        return $this->hasMany(User::className(), ['id' => 'id']);
    }
	
		public function getNotes()
    {
        //return $this->hasOne(Weeks::className(), ['week_id' => 'week_id']);
		//$notes = Notes::find()->orderBy('note_id');
		return $this->hasMany(Notes::className(), ['user_id' => 'id']);
		return $notes;
    }
}
