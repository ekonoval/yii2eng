<?php
namespace backend\ext\User;

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
}
