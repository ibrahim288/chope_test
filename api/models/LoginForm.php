<?php
namespace api\models;

use Yii;
use yii\base\Model;
use api\models\User;

/**
 * Login form
 */
class LoginForm extends Model
{
    public $username;
    public $password;

    const SCENARIO_LOGIN = "LOGIN";

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'password'], 'required', 'on' => self::SCENARIO_LOGIN],
            ['username', '_validateCredentials', 'on' => self::SCENARIO_LOGIN],
        ];
    }

    /**
     * validate username and password
     *
     * @return bool whether the creating new account was successful and email was sent
     */
    public function _validateCredentials($attribute, $params, $validator)
    {
        $user = User::findByUsername($this->username);

        if ($user) {
            if ($user->validatePassword($this->password)) {
                Yii::$app->user->identity = $user;
                return true;
            }
        }
        $this->addError('*', 'Invalid credentials.');
    }
}
