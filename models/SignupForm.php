<?php

namespace app\models;

use yii\base\Model;

class SignupForm extends Model
{
    public $username;
    public $password;
    public $email;

    public function rules() {
        return [
            [['username', 'password'], 'required', 'message' => 'please fill in all fields'],
            [ ['password'], 'string', 'min' => 8],
            [['username', 'password', 'email'], 'safe'],
            [['email'], 'email'],
            [['username'], 'validateUsername'],
            [['email'], 'validateEmail'],
        ];
    }

    /**
     * Validates the username
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validateUsername($attribute, $params)
    {
        if (!$this->hasErrors()) {
            if (User::findByUsername($this->username)) {
                $this->addError($attribute, 'Username must be unique.');
            }
        }
    }

    /**
     * Validates the email
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validateEmail($attribute, $params)
    {
        if (!$this->hasErrors()) {
            if (User::findByEmail($this->email)) {
                $this->addError($attribute, 'Email must be unique.');
            }
        }
    }

}