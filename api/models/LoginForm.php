<?php
namespace api\models;

use Yii;
use yii\base\Model;
use api\models\User;
use api\components\helpers\AuditLogs;

/**
 * Login form
 */
class LoginForm extends Model
{
    use AuditLogs;

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
                $this->pushAction($user->id, self::SCENARIO_LOGIN);

                $redis = new Redis(Redis::SCENARIO_VERIFY_TOKEN);
                $redis->setKey($user->auth_key, $user->id);

                return true;
            }
        }
        $this->addError('*', 'Invalid credentials.');
    }
}
