<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap\Tabs;
use kiwi\Kiwi;
use yii\data\ActiveDataProvider;

/* @var $this yii\web\View */
/* @var $model yincart\itemprop\models\ItemProp */
/* @var $form yii\widgets\ActiveForm */
$dataList = Kiwi::getDataList();
?>

<div class="item-prop-form">

    <?php
    $form = ActiveForm::begin();
    $items = [];
    $fieldGroup = [];
    $fieldGroup[] = $form->field($model, 'name')->textInput(['maxlength' => 255]);
    $fieldGroup[] = $form->field($model, 'type')->dropDownList($dataList->itemPropType);
    $fieldGroup[] = $form->field($model, 'is_key')->dropDownList($dataList->boolean);
    $fieldGroup[] = $form->field($model, 'is_sale')->dropDownList($dataList->boolean);
    $fieldGroup[] = $form->field($model, 'is_color')->dropDownList($dataList->boolean);
    $fieldGroup[] = $form->field($model, 'is_search')->dropDownList($dataList->boolean);
    $fieldGroup[] = $form->field($model, 'is_must')->dropDownList($dataList->boolean);
    $fieldGroup[] = $form->field($model, 'sort')->textInput();
    $fieldGroup[] = $form->field($model, 'status')->dropDownList($dataList->boolean);
    $items[] = [
        'label' => Yii::t('app', 'Item Prop Info'),
        'content' => implode('', $fieldGroup),
    ];

    if (!$model->isNewRecord && $model->type > 1) {
        $dataProvider = new ActiveDataProvider([
            'query' => Kiwi::getPropValue()->find()->where(['item_prop_id' => $model->item_prop_id])
        ]);

        $items[] = [
            'label' => Yii::t('app', 'Prop Values'),
            'content' => $this->render('..//prop-value/index', [
                'dataProvider' => $dataProvider,
                'itemProp' => $model,
            ])
        ];
    }

    echo Tabs::widget(['items' => $items]);
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
