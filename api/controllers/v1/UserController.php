<?php
namespace api\controllers\v1;

use api\components\APIBaseController;

class UserController extends APIBaseController
{
    public $modelClass = 'api\models\User';

    public function actionView($id)
    {
      return ["1"];
    }
}
