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

    const SCENARIO_CREATE = "SINGUP" ;
    const SCENARIO_VIEW = "GET_VERIFICATION_KEY" ;
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

            [['username', 'password', 'email'], 'safe', 'on' => self::SCENARIO_CREATE],
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
        $user->generateEmailVerificationToken();
        return $user->save() && $this->sendEmail($user);

    }

    /**
     * Sends confirmation email to user
     * @param User $user user model to with email should be send
     * @return bool whether the email was sent
     */
    protected function sendEmail($user)
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
    }
}