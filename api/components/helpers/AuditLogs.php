<?php
namespace api\components\helpers;

use Yii;
use api\models\Redis;
/**
 * Class AuditLogs has actions will be called from different locations
 */
trait AuditLogs
{
    /**
     * Push new Action by user
     */
    private function pushAction($key, $actionName)
    {
        $redis = new Redis(Redis::SCENARIO_ACTION_LOGS);
        $redis->setKey($key, $actionName.'-'.date("Y-m-d h:i:sa"));
    }

}
