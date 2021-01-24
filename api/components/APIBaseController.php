<?php
namespace api\components;

use yii\web\Controller;

class APIBaseController extends Controller
{
  public function behaviors()
  {
      return [
          'basicAuth' => [
              'class' => \yii\filters\auth\HttpBearerAuth::className(),
          ],
      ];
  }

}
