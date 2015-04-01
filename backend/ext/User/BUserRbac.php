<?php
namespace backend\ext\User;
use common\ext\System\AppException;

/**
 * See @console/BackendRbacController/init for roles relations
 */
class BUserRbac
{
    const ROLE_ADMIN_SUPER = 2;
    const ROLE_ADMIN = 3;
    const ROLE_OPER = 4;

    //const ROLE_KASSA = 5;

    static function getRolesList()
    {
        return array(
            self::ROLE_OPER => 'operator',
            self::ROLE_ADMIN => 'admin',
            self::ROLE_ADMIN_SUPER => 'admin-super',
        );
    }

    static function getRoleName($roleInt)
    {
        $roles = self::getRolesList();
        AppException::ensure(array_key_exists($roleInt, $roles), "Role '{$roleInt}' is not found ");

        return $roles[$roleInt];
    }
}
