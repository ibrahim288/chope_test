<?php
namespace api\controllers\v1;

use Yii;
use yii\web\Controller;
use api\models\LoginForm;

class LoginController extends Controller
{
    /**
     * Login
     */
    public function actionCreate()
    {
        $model = new LoginForm();
        $model->scenario = LoginForm::SCENARIO_LOGIN;
        $model->setAttributes(Yii::$app->request->post());

        if ($model->validate()) {
            return Yii::$app->user->identity;
        } else {
            return $model->errors;
        }
    }
}
