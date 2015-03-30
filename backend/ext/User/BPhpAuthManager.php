<?php
namespace backend\ext\User;

use yii\rbac\PhpManager;

class BPhpAuthManager extends PhpManager
{
    public $itemFile = "@backend/runtime/rbac/items.php";

    public $assignmentFile = '@backend/runtime/rbac/assignments.php';

    public $ruleFile = '@backend/runtime/rbac/rules.php';

    /**
     * This method is called every time rule or permission is added or revoked and 'assignements' file is regenerated.
     * We want to save only roles hierarchy (performed via console command 'backend-rbac/init')
     * not the assignements for each user. Assignments are done manually on each request.
     * @inheritdoc
     */
    protected function saveToFile($data, $file)
    {
        //file_put_contents($file, "<?php\nreturn " . VarDumper::export($data) . ";\n", LOCK_EX);
    }

}
