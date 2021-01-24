<?php
namespace api\controllers\v1;

use Yii;
use api\components\APIBaseController;
use api\models\Redis;

class AuditlogsController extends APIBaseController
{
    /**
     * Get Action logs for authrnticated users
     */
    public function actionRead()
    {
        $user_id = Yii::$app->user->identity->id;

        // for pagination , each set is 20 .
        $request = Yii::$app->request;
        $page_number = $request->get('page_number',1);
        $startFrom = ($page_number - 1) * Redis::limit;

        $redis = new Redis(Redis::SCENARIO_ACTION_LOGS);
        return $redis->getKey($user_id, $startFrom);
    }
}
