<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
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
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    $v = false;
    if(!Yii::$app->user->isGuest){
        if(Yii::$app->user->identity->role==1){$v=true;}else{$v=false;}
    }
    NavBar::begin([
        'brandLabel' => 'ระบบงานเอกสาร โรงพยาบาลเหล่าเสือโก้ก',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => 'หน้าแรก', 'url' => ['/site/index']],
            ['label' => 'แบบฟอร์มราชการ', 'visible' => false ,'url' => ['/site/contact']],

            ['label' => 'การจัดการ', 'visible' => $v , 'items' => [
                ['label' => 'จัดการผู้ใช้','url' => ['/user/admin/index']],
                ['label' => 'จัดการเอกสาร/หนังสือ','url' => ['/documents/admin']],                
            ]],
            Yii::$app->user->isGuest ?
                ['label' => 'เข้าสู่ระบบ', 'url' => ['/user/security/login']] :
                ['label' => 'บัญชี(' . Yii::$app->user->identity->username . ')', 'items'=>[
                    ['label' => 'ข้อมูลส่วนตัว', 'url' => ['/user/settings/profile']],
                    ['label' => 'จัดการบัญชี', 'url' => ['/user/settings/account']],
                    ['label' => 'ออกจากระบบ', 'url' => ['/user/security/logout'],'linkOptions' => ['data-method' => 'post']],
                ]],
                ['label' => 'สมัครใช้งาน', 'url' => ['/user/registration/register'], 'visible' => Yii::$app->user->isGuest],
            ],
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
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
