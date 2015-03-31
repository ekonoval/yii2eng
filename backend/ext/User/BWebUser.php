<?php
namespace backend\ext\User;

use Yii;
use yii\web\User;

class BWebUser extends User
{
    /**
     * Avoid duplication of roles/premissions assignments
     */
    private $permissionsAlreadyApplied = false;

    public $loginUrl = "auth/login";

    public function getIdentity($autoRenew = true)
    {
        $parentIdentity = parent::getIdentity($autoRenew);

        if (
            !is_null($parentIdentity)
            && $this->permissionsAlreadyApplied == false
        ) {
            $this->permissionsAlreadyApplied = true;

            $authManager = Yii::$app->authManager;

            /**
             * Assign roles2user dynamically on each request,
             * take role from identity
             */
            $roleInt = BUserRbac::ROLE_OPER;
            //$roleInt = UserRbac::ROLE_ADMIN;
            //$roleInt = UserRbac::ROLE_ADMIN_SUPER;
            $role = $authManager->createRole($roleInt);
            $authManager->assign($role, $parentIdentity->getId());
        }

        return $parentIdentity;
    }

}
