<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\User;


/**
 * LoginForm is the model behind the login form.
 */
class RegistrationForm extends Model
{
    public $name;
    public $second_name;
    public $email;
    public $password;
    public $confirmation;


    private $_user = false;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['name','second_name','email', 'password','confirmation'], 'required', 'message' => 'Пожалуйста, заполните это поле'],
            ['email', 'email', 'message' => 'Пожалуйста, введите корректный email'],
            // password is validated by validatePassword()
            ['name', 'validateString'],
            ['second_name', 'validateString'],
            ['password', 'validatePassword'],
            ['email', 'validateEmail'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Ваше имя',
            'second_name' => 'Ваша фамилия',
            'email' => 'Ваш Email',
            'password' => 'Пароль',
            'confirmation' => 'Повторите пароль',
        ];
    }

    /**
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */

    public function validatePassword($attribute, $params)
    {
        if ($this->confirmation!=$this->password)
            $this->addError('confirmation','Подтверждение пароля не совпадает с паролем.');
    }

    public function validateEmail($attribute, $params)
    {
        $user = User::find()->where(['email'=>$this->email])->count();

        if ($user!=0)
            $this->addError('email','Данный email уже используется.');
    }

    public function validateString($attribute, $params)
    {
        if(!(preg_match('/[^a-z]/i', $this->name) xor preg_match('/[^а-яё]/i', $this->name)))
        {
          $this->addError('name','Имя может содержать только буквы.');
        }

        if(!(preg_match('/[^a-z\-]/i', $this->second_name) xor preg_match('/[^а-яё\-]/i', $this->second_name)))
        {
          $this->addError('second_name','Фамилия может содержать только буквы и символ "-".');
        }
    }

    /**
     * Logs in a user using the provided username and password.
     * @return boolean whether the user is logged in successfully
     */
    public function register()
    {
        
            $user = new User();
            $user->name = $this->second_name." ".$this->name;
            $user->email = $this->email;
            $user->passHash = md5($this->password);
            return $user->save();
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = User::findByUsername($this->email);
        }

        return $this->_user;
    }
}
