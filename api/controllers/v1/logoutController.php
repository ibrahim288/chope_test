<?php
namespace api\controllers\v1;

use Yii;
use api\components\APIBaseController;
use api\components\helpers\AuditLogs;
use api\models\Redis;

/**
 * The main goal of this class or endpoint is to track Logout action.
 */
class LogoutController extends APIBaseController
{
    use AuditLogs;
    /**
     * Logout
     */
    public function actionCreate()
    {
        $user = Yii::$app->user->identity;
        $token = Yii::$app->user->identity->auth_key;
        $redis = new Redis(Redis::SCENARIO_VERIFY_TOKEN);
        $redis->removeKey($user->auth_key);

        $this->pushAction($user->id, 'LOGOUT');
    }
}
