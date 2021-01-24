<?php
namespace api\models;

use Yii;
use yii\base\Model;
use api\models\User;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $validation_token;

    const verification_token_duration = 86400; // 1 day of expiration

    const SCENARIO_CREATE = "SINGUP" ;
    const SCENARIO_UPDATE = "VERIFY_EMAIL" ;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'trim', 'on' => [self::SCENARIO_CREATE]],
            ['username', 'required', 'on' => [self::SCENARIO_CREATE]],
            ['username', 'unique', 'targetClass' => 'api\models\User', 'message' => 'This username has already been taken.', 'on' => [self::SCENARIO_CREATE]],
            ['username', 'string', 'min' => 2, 'max' => 255, 'on' => [self::SCENARIO_CREATE]],

            ['email', 'trim', 'on' => [self::SCENARIO_CREATE]],
            ['email', 'required', 'on' => [self::SCENARIO_CREATE]],
            ['email', 'email', 'on' => [self::SCENARIO_CREATE]],
            ['email', 'string', 'max' => 255, 'on' => [self::SCENARIO_CREATE]],
            ['email', 'unique', 'targetClass' => 'api\models\User', 'message' => 'This email address has already been taken.', 'on' => [self::SCENARIO_CREATE]],

            ['password', 'required', 'on' => [self::SCENARIO_CREATE]],
            ['password', 'string', 'min' => 8, 'on' => [self::SCENARIO_CREATE]],

            ['validation_token', 'required', 'on' => [self::SCENARIO_UPDATE]],
            ['validation_token', '_validateToken', 'on' => [self::SCENARIO_UPDATE]],
        ];
    }

    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */
    public function signup()
    {
        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        if ($user->save()) {
            $VerificationToken = $this->generateEmailVerificationToken($user->id);
            return $this->sendEmail($user, $VerificationToken);
        }
        return false;
    }

    /**
     * Sends confirmation email to user
     * @param User $user user model to with email should be send
     * @return bool whether the email was sent
     */
    protected function sendEmail($user, $VerificationToken)
    {
        // assume we sent an email.

        // return Yii::$app
        //     ->mailer
        //     ->compose(
        //         ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
        //         ['user' => $user]
        //     )
        //     ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
        //     ->setTo($this->email)
        //     ->setSubject('Account registration at ' . Yii::$app->name)
        //     ->send();
        return true;
    }

    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */
    public function _validateToken($attribute, $params, $validator)
    {
        //get user id
        $redis = new Redis(Redis::SCENARIO_VERIFY_EMAIL);
        $user_id = $redis->getKey($this->$attribute);

        if ($user = User::findIdentity($user_id)) {
            // Change user status to active
            $user->status = User::STATUS_ACTIVE;
            $user->save();

            Yii::$app->user->identity = $user;

            $redis->removeKey($this->$attribute);

            return true;
        } else {
            $this->addError('validation_token', 'Invalid token.');
        }
    }


    /**
     * Generates new token for email verification
     */
    private function generateEmailVerificationToken($user_id)
    {
        $verificationToken = Yii::$app->security->generateRandomString() . '_' . time();

        $redis = new Redis(Redis::SCENARIO_VERIFY_EMAIL);
        $redis->setKey($verificationToken, $user_id, self::verification_token_duration);

        return $verificationToken;
    }
}
