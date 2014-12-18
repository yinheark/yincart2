<?php
/**
 * @author Cangzhou Wu<wucang.zhou@jago-ag.cn>
 * @Date: 14-11-28
 * @Time: 下午4:45
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model extensions\sales\models\customerSeller */
/* @var $form yii\widgets\ActiveForm */

$this->title = '申请成为销售';
?>
<h1><?= Html::encode($this->title) ?></h1>
<?php

if (!$model->isNewRecord) {
    if($model->status == 2){
        echo "审核未通过，请联系客服";
    }else{
        echo '已经申请，请耐心等待审核';
    }
}
?>
<div class="customer-seller-form">

    <?php $form = ActiveForm::begin(); ?>

<!--    --><?//= $form->field($model, 'pin_password')->passwordInput(['maxlength' => 255]) ?>
<!---->
<!--    --><?//= $form->field($model, 'referrer')->textInput(['maxlength' => 255]) ?>

    <div class="form-group">
        <?= Html::submitButton('申请', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>