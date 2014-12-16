<?php
/**
 * @author Cangzhou Wu<wucang.zhou@jago-ag.cn>
 * @Date: 14-11-24
 * @Time: 下午1:28
 */
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model yincart\shipment\models\Shipment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="shipment-form">

    <?php $form = ActiveForm::begin(['action'=>Url::to(['/shipment/create'])]); ?>

    <?= $form->field($model, 'order_id')->hiddenInput(['value'=>$model->order_id]) ?>

    <?= $form->field($model, 'shipment_method')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'trace_no')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'create_at')->hiddenInput(['value'=>time()]) ?>

    <?= $form->field($model, 'status')->hiddenInput(['value'=>1]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>