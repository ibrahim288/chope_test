<?php
namespace api\components\helpers;

use Yii;
/**
 * Class Utility has generic function
 */
trait Utility
{
    /**
     * parse user identity, maily to hide hashed password from respose
     */
    private function parseUserIdentityResponse($user)
    {
        unset($user['password_hash']);
        unset($user['status']);
        unset($user['updated_at']);
        return $user;
    }

}
