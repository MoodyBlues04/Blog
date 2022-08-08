<?php

namespace app\models;

use Yii;
use yii\base\Model;

class LoginForm extends Model
{
    public $username;
    public $password;
    public $rememberMe = true;

    private $_user = false;

    public function rules() {
        return [
            [['username', 'password'], 'required', 'message' => 'please fill in all fields'],
            [['username', 'password'], 'safe'],
            [['rememberMe'], 'boolean'],
            [['password'], 'validatePassword', 'message' => 'Incorrect username or password.'],
        ];
    }

    /**
     * Log in user
     * 
     * @return bool
     * @throws Exception 
     */
    public function login()
    {
        if ($this->validate()) {
    
            $user = $this->getUser();
            if($user->status === User::STATUS_ACTIVE){
                return Yii::$app->user->login($user, $this->rememberMe ? 3600 * 24 * 30 : 0);
            }

            if($user->status === User::STATUS_WAIT){
                throw new \Exception('To complete the registration, confirm your email. Check your email.');
            }
    
        } else {
            return false;
        }
    }

    /**
     * Validates the password
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }

    /**
     * Finds user by username
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = User::findByUsername($this->username);
        }

        return $this->_user;
    }
}