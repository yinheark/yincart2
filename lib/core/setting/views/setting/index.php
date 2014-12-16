<?php
/**
 * @author Lujie.Zhou(gao_lujie@live.cn)
 * @Date 10/20/2014
 * @Time 2:20 PM
 */

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/** @var \core\setting\models\SettingKVModel $settingKVModel */

$this->title = Yii::t('app', '网站配置');
$this->params['breadcrumbs'][] = $this->title;
$this->params['topMenuKey'] = 'system';
$this->params['leftMenuKey'] = 'setting';
?>
<div class="setting-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php
    $form = ActiveForm::begin(['options' => ['class' => 'form-horizontal']]);
    echo $settingKVModel->formFields($form);
    echo Html::submitButton(Yii::t('kiwi', 'Save Config'), ['class' => 'btn btn-primary']);
    $form->end();
    ?>
</div>

