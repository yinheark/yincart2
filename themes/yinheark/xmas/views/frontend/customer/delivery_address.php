<?php
use kiwi\Kiwi;
use kartik\widgets\DepDrop;
use \yii\helpers\Url;
use \yii\helpers\Html;
use yii\grid\GridView;

$dataList = Kiwi::getDataList();
$this->params['breadcrumbs'] = [
    'title' => '收货地址'
];
?>
<span id="item" style="margin-left: 0px">已保存有效的地址:</span>
<?=  GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

        'name',
        'provinceArea.name:text:省',
        'cityArea.name:text:市',
        'districtArea.name:text:区',
        'address',
        'zip_code',
        'phone',
        [
            'class' => 'yii\grid\ActionColumn',
            "buttons"   =>
                [
                    'view' => function ($url,$model){
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', ['customer/delivery-address','view_id'=>$model->customer_address_id]);
                    },
                    'update' => function ($url,$model){
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['customer/delivery-address','view_id'=>$model->customer_address_id]);
                    }
                ]
        ],
    ],
]);

//index view
$viewId = Yii::$app->request->get('view_id');
if(!isset($viewId)){
    ?>
    <button type="button" class="btn btn-primary btn-lg" onclick="javascript: $('#address').toggle()">新建收货地址</button>
<?php } ?>


<div id="address"  style="display: <?=  isset($viewId) ? 'block': 'none';  ?>">
    <?php
    $form = \kartik\form\ActiveForm::begin();

    /* @var \yincart\customer\models\CustomerAddress $model */
    echo $form->field($model, 'province')->dropDownList($catList, ['id'=>'cat-id']);

    // Child # 1
    echo $form->field($model, 'city')->widget(DepDrop::classname(), [
        'data'=>[$model->city=>isset($model->cityArea)?$model->cityArea->name:''],
        'options'=>['id'=>'subcat-id'],
        'pluginOptions'=>[
            'depends'=>['cat-id'],
            'placeholder'=>'Select...',
            'url'=>Url::to(['/customer/get-cities'])
        ]
    ]);
    // Child # 2
    echo $form->field($model, 'district')->widget(DepDrop::classname(), [
        'data'=>[$model->district=>isset($model->districtArea)?$model->districtArea->name:''],
        'pluginOptions'=>[
            'depends'=>['cat-id', 'subcat-id'],
            'placeholder'=>'Select...',
            'url'=>Url::to(['/customer/get-district'])
        ]
    ]);

    ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'zip_code')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'is_default')->dropDownList($dataList->boolean) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php $form->end();  ?>
</div>
