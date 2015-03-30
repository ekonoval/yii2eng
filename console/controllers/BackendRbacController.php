<?php
namespace console\controllers;

use backend\ext\User\BPhpAuthManager;
use backend\ext\User\BUserRbac;
use console\ext\ConsoleBackendPhpAuthManager;
use Yii;
use yii\console\Controller;

class BackendRbacController extends Controller
{
    public function actionInit()
    {
        //$auth = new BPhpAuthManager();
        $auth = new ConsoleBackendPhpAuthManager();

        $auth->removeAll();

        $adminSuperRole = $auth->createRole(BUserRbac::ROLE_ADMIN_SUPER);
        $adminRole = $auth->createRole(BUserRbac::ROLE_ADMIN);
        $operRole = $auth->createRole(BUserRbac::ROLE_OPER);

        $auth->add($adminSuperRole);

        $auth->add($adminRole);
        $auth->addChild($adminSuperRole, $adminRole);

        $auth->add($operRole);
        $auth->addChild($adminRole, $operRole);

//        //<editor-fold desc="perms">
//        // add "createPost" permission
//        $createPost = $auth->createPermission('createPost');
//        $createPost->description = 'Create a post';
//        $auth->add($createPost);
//
//        // add "updatePost" permission
//        $updatePost = $auth->createPermission('updatePost');
//        $updatePost->description = 'Update post';
//        $auth->add($updatePost);
//        //</editor-fold>

//        // add "author" role and give this role the "createPost" permission
//        $author = $auth->createRole('author');
//        $auth->add($author);
//        $auth->addChild($author, $createPost);
//
//        // add "admin" role and give this role the "updatePost" permission
//        // as well as the permissions of the "author" role
//        $admin = $auth->createRole('admin');
//        $auth->add($admin);
//        $auth->addChild($admin, $updatePost);
//        $auth->addChild($admin, $author);
//
//        //--- assigning ---//
//        $auth->assign($author, 2);
//        $auth->assign($admin, 1);

    }
}
