<?php
namespace api\controllers\v1;

use Yii;
use yii\web\Controller;
use api\models\LoginForm;
use api\components\helpers\Utility;

class LoginController extends Controller
{
    use Utility;
    /**
     * Login
     */
    public function actionCreate()
    {
        $model = new LoginForm();
        $model->scenario = LoginForm::SCENARIO_LOGIN;
        $model->setAttributes(Yii::$app->request->post());

        if ($model->validate()) {
            return $this->parseUserIdentityResponse(Yii::$app->user->identity);
        } else {
            return $model->errors;
        }
    }
}
