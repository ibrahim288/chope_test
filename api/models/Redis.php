<?php

namespace api\models;

use Yii;

class Redis
{
    const SCENARIO_VERIFY_EMAIL = "VERIFY_EMAIL";
    const SCENARIO_VERIFY_TOKEN = "VERIFY_TOKEN";
    const SCENARIO_LOGIN_LOGS = "LOGIN_LOGS";

    private $redisObject;
    private $redisDB;
    private $dataType;

    const limit = 20;

    /**
     * Redis constructor.
     * @param $redisDB
     */
    public function __construct($scenatrio)
    {
        $this->redisObject = Yii::$app->redis;
        switch ($scenario) {
            case self::SCENARIO_VERIFY_EMAIL:
                $this->database = 0;
                $this->dataType = "String";
                break;
            case self::SCENARIO_VERIFY_TOKEN:
                $this->database = 1;
                $this->dataType = "String";
                break;
            case self::SCENARIO_LOGIN_LOGS:
                $this->dataType = "List";
                $this->database = 2;
                break;
        }
    }

    /**
     * Set Redis Values
     * @param $key  - Redis key
     * @param $value    - Value to set in redis
     * @param int $expiry - Expiry time
     * @return bool
     */
    public function setKey($redisKey, $value, $expiry = 0)
    {
        if ($this->dataType == 'List') {
            $this->redisObject->lpush($redisKey, $value);
        } else { //String
            $this->redisObject->set($redisKey, $value);
        }

        if ($expiry > 0) {
            return $this->redisExpireKey($key, $expiry, $prefix);
        }

        return false;
    }

    /**
     * Get value from redis based on key
     * @param $key  - Redis key
     * @param $key  - applicable for list type only, indicate range start from value
     * @return mixed
     */
    public function getKey($key, $start_from = 0)
    {
        if ($this->dataType == 'List') {
            $to = $start_from + $this->limit;
            return $this->redisObject->lrange($redisKey, $start_from , $to);
        } else { //String
            return $this->redisObject->get($redisKey);
        }

        return $val;
    }

    /**
     * Delete key from redis
     * @param $key  - Redis key
     * @return mixed
     */
    public function removeKey($key)
    {
        return $this->redisObject->del($redisKey);
    }
}
