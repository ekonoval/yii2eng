<?php
use backend\assets\AppAsset;
use backend\ext\System\BackendController;
use backend\ext\User\BUserRbac;
use kartik\growl\Growl;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);

/** @var BackendController $ctrl */
$ctrl = $this->context;
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>

<?php
//Get all flash messages and loop through them
foreach (Yii::$app->session->getAllFlashes() as $message){
    echo Growl::widget([
        'type' => (!empty($message['type'])) ? $message['type'] : 'danger',
        //'title' => (!empty($message['title'])) ? Html::encode($message['title']) : 'Title Not Set!',
        'icon' => (!empty($message['icon'])) ? $message['icon'] : 'fa fa-info',
        'body' => (!empty($message['message'])) ? Html::encode($message['message']) : 'Message Not Set!',
        //'showSeparator' => true,
        //'delay' => 1, //This delay is how long before the message shows
        'pluginOptions' => [
            'delay' => (!empty($message['duration'])) ? $message['duration'] : 3000, //This delay is how long the message shows for
            'placement' => [
                'from' => (!empty($message['positonY'])) ? $message['positonY'] : 'top',
                'align' => (!empty($message['positonX'])) ? $message['positonX'] : 'right',
            ]
        ]
    ]);
 } ?>

<?php $this->beginBody() ?>
<div class="wrap">
    <?php
        NavBar::begin([
            'brandLabel' => 'Series Translator',
            'brandUrl' => Yii::$app->homeUrl,
            'options' => [
                'class' => 'navbar-inverse navbar-fixed-top',
            ],
        ]);

        //$menuItems = [['label' => 'Home', 'url' => ['/site/index']],];

        if (Yii::$app->user->isGuest) {
            $menuItems[] = ['label' => 'Login', 'url' => ['/auth/login']];
        } else {
            $roleName = BUserRbac::getRoleName(Yii::$app->user->identity->role);

            $menuItems[] = [
                'label' => 'Movies',
                'url' => Url::to(['/translate/movie/index'])
            ];

            $menuItems[] = [
                'label' => 'Logout (' . Yii::$app->user->identity->username . " - {$roleName}". ')',
                'url' => ['/auth/logout'],
                'linkOptions' => ['data-method' => 'post']
            ];
        }

        echo Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-right'],
            'items' => $menuItems,
        ]);
        NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            //'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            'links' => $ctrl->bc,
        ]) ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
    <p class="pull-left">&copy; My Company <?= date('Y') ?></p>
    <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>

</body>
</html>
<?php $this->endPage() ?>
