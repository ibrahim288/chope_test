<?php
namespace api\controllers\v1;

use Yii;
use yii\web\Controller;
use api\models\SignupForm;

class SignupController extends Controller
{
    /**
     * Signup
     */
    public function actionCreate()
    {
        $model = new SignupForm();
        $model->scenario = SignupForm::SCENARIO_CREATE;
        $model->setAttributes(Yii::$app->request->post());

        if ($model->validate()) {
            $model->signup();
        } else {
            return $model->errors;
        }
    }

    /**
     * Check validation key
     */
    public function actionView()
    {

    }

    /**
     * Validate Email
     */
    public function actionUpdate()
    {

    }
}
