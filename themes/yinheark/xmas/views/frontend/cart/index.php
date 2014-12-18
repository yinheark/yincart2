<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use kiwi\Kiwi;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
list($path, $link) = $this->getAssetManager()->publish('@themes/xmas/assets/source/css/cart');
$this->registerCssFile($link . '/core.css');
$this->registerCssFile($link . '/box.css');

list($path, $link) = $this->getAssetManager()->publish('@yincart/cart/web/js');
$this->registerJsFile($link . '/cart.js', ['depends' => [\yii\web\JqueryAsset::className()]]);

?>
<!-- Main Container Starts -->
<div id="main-container" class="container">
    <!-- Breadcrumb Starts -->
    <ol class="breadcrumb">
        <li><a href="<?= Url::to(['/'])?>">首页</a></li>
        <li class="active">购物车</li>
    </ol>
    <!-- Breadcrumb Ends -->
    <!-- Main Heading Starts -->
    <h2 class="main-heading text-center">
        我的购物车
    </h2>
    <!-- Main Heading Ends -->

    <div class=" breadcrumb">
            <?php $form = ActiveForm::begin(['id' => 'cartForm']); ?>
            <table class="table table-bordered" id="cart-table">
                <thead>
                <tr>
                    <th class="col-md-2">图片</th>
                    <th class="col-md-3">名称</th>
                    <!--                <th class="col-md-3">属性</th>-->
                    <th class="col-md-1">价格</th>
                    <th class="col-md-1">数量</th>
                    <th class="col-md-1">小计</th>
                    <th class="col-md-1">操作</th>
                </tr>
                </thead>
                <?php
                if (empty($cartItems)) {
                    ?>
                    <tr>
                        <td colspan="8" style="padding:10px">您的购物车是空的!</td>
                    </tr>
                <?php
                } else {
                foreach ($cartItems as $cartItem) {
                /** @var \yincart\item\models\Item $item */
                /** @var \yincart\cart\models\Cart $cartItem */
                $item = $cartItem->item;

                $key = $cartItem->data['key'];
                /** @var \extensions\sales\models\CustomerSales $customer_sale */
                $customerSaleClass = Kiwi::getCustomerSalesClass();
                $customer_sale = $customerSaleClass::find()->where(['key' => $key])->one();

                $pictures = explode(',',$item->pictures);
                ?>
                <tbody id="<?php echo $item->item_id; ?>">
                <tr><?php
                    $itemUrl = Yii::$app->urlManager->createUrl('item/view', array('id' => $item->item_id));
                    ?>
                    <!--                <td>-->
                    <?php //echo CHtml::checkBox('position[]', true, array('value' => $key, 'data-url' => Yii::app()->createUrl('cart/getPrice'))); ?><!--</td>-->

                    <td>
                        <a href="<?php echo $itemUrl; ?>"><?php echo Html::img( is_array($pictures)?$pictures[0]:$pictures , ['title' => $item->name, 'style' => "width : 80px; height:80px"]); ?></a>
                    </td>
                    <td><?= $item->name ?></td>
                    <!--                <td>-->
                    <?php //echo empty($item->sku) ? '' : implode(';', json_decode($item->sku->props_name, true)); ?><!--</td>-->
                    <td>
                        <div id="Singel-Price"><?php echo $customer_sale->sale_price; ?></div>
                    </td>


        <td>
            <?= Html::hiddenInput('Cart[' . $cartItem->item_id . '][item_id]', $cartItem->item_id) ?>
            <?php echo Html::textInput('Cart[' . $cartItem->item_id . '][qty]', $cartItem->qty, array('size' => '4', 'class' => 'quantity', 'maxlength' => '5', 'data-url' => Yii::$app->urlManager->createUrl('cart/update'))); ?>
            <input id="pre_quantity" class="pre_quantity" type="hidden" value="<?php echo $cartItem->qty; ?>"/>

            <div id="stock-error"></div>
            <input id="pre_quantity" type="hidden"/>
        </td>


        <td>
            <div id="SumPrice"><?php echo $cartItem->qty * $customer_sale->sale_price;; ?></div>
            元
        </td>
        <td><?= Html::button(Yii::t('app', 'Remove'),
                [
                    'class' => 'btn btn-primary remove-item',
                    'data-item' => $cartItem->item_id,
                    'data-url' => Url::to(['cart/remove'])
                ]) ?>
        </td>
        </tr></tbody>
        <!--    --><?php //$i++; $total += $item->getSumPrice();?>
        <?php
        }
        } ?>
        <tfoot>
        <tr>
            <td colspan="8" style="padding:10px;text-align:right">运费：<label
                    id="total_price"><?php echo Kiwi::getShoppingCart()->getShippingFee(); ?></label>元
            </td>
        </tr>
        <tr>
            <td colspan="8" style="padding:10px;text-align:right">总计：<label
                    id="total_price"><?php echo Kiwi::getShoppingCart()->getTotal(); ?></label>元
            </td>
        </tr>
        <tr>
            <td colspan="8" style="vertical-align:middle">
                <?= Html::button(Yii::t('app', 'Clear All'), ['style' => "margin-right:10px", 'class' => 'btn btn-danger pull-left clear-all', 'data-url' => Url::to(['cart/clear-all'])]) ?>
                <?= Html::button(Yii::t('app', 'Update Cart'), ['class' => 'btn btn-primary pull-left update-cart', 'data-url' => Url::to(['cart/update'])]) ?>
                <?= Html::a(Yii::t('app', '结账'), ['order/index'], ['style' => "float:right;line-height:2.429;", 'class' => "btn  btn-success"]) ?>

                <input class="btn btn-primary" style="float:right;padding:1px 10px;margin-right: 10px;" id="btn-primary"
                       type="button"
                       value="继续购物" onclick="javascript:history.back(-1);"/>
            </td>
        </tr>
        </tfoot>
        </table>
        <?php $form->end(); ?>
</div>
<!-- Main Container Ends -->
<!--<script type="text/javascript">-->
<!--    $(document).ready(function () {-->
<!--        $(".btn-add").on('click', function () {-->
<!--            $(this).siblings(".quantity").val(Number($(this).siblings(".quantity").val()) + 1);-->
<!--            if (!$(this).siblings("#stock-error").text()) {-->
<!--                $(this).siblings(".pre_quantity").val(Number($(this).siblings(".pre_quantity").val()) + 1);-->
<!--            }-->
<!--            update($(this).siblings(".quantity"));-->
<!--        });-->
<!--        $(".btn-reduce").on('click', function () {-->
<!--            var change_quantity = Number($(this).siblings(".quantity").val());-->
<!--            $(this).siblings("#stock-error").find("#num-error").remove();-->
<!--            if (change_quantity <= 1) {-->
<!--                $(this).siblings(".quantity").val(1);-->
<!--                $(this).siblings(".pre_quantity").val(1);-->
<!--                $(this).siblings("#stock-error").find("#error-message").remove();-->
<!--                $(this).siblings("#stock-error").append("<div id=\"num-error\" style=\"color:red\">商品数量不能小于1</div>");-->
<!--            } else {-->
<!--                $(this).siblings(".pre_quantity").val(change_quantity - 1);-->
<!--                $(this).siblings(".quantity").val(change_quantity - 1);-->
<!--                update($(this).siblings(".quantity"));-->
<!--            }-->
<!--        });-->
<!--    });-->
<!---->
<!--    $(function () {-->
<!--        $('[name="position[]"]').change(function () {-->
<!--            if ($('[name="position[]"]:checked').length == 0) {-->
<!--                $("#checkout").attr('disabled', true);-->
<!--            } else {-->
<!--                $("#checkout").removeAttr('disabled');-->
<!--            }-->
<!--        });-->
<!--        $("#checkAllPosition").change(function () {-->
<!--            if (!$("#checkAllPosition").attr('checked')) {-->
<!--                $("#checkout").attr('disabled', true);-->
<!--            } else {-->
<!--                $("#checkout").removeAttr('disabled');-->
<!--            }-->
<!--        });-->
<!--        $(".quantity").keyup(function () {-->
<!--            var tmptxt = $(this).val();-->
<!--            $(this).val(tmptxt.replace(/\D|^0/g, ''));-->
<!--        }).bind("paste", function () {-->
<!--            var tmptxt = $(this).val();-->
<!--            $(this).val(tmptxt.replace(/\D|^0/g, ''));-->
<!--        }).css("ime-mode", "disabled");-->
<!--    });//输入验证，保证只有数字。-->
<!---->
<!--    function update(quantity) {-->
<!--        var tr = quantity.closest('tr');-->
<!--        var sku_id = tr.find("#position");-->
<!--        var qty = quantity;-->
<!--        var item_id = tr.find(".item-id");-->
<!--        var props = tr.find(".props");-->
<!--        var cart = parseInt($(".shopping_car").find("span").html());-->
<!--        var sumPrice = parseFloat(tr.find("#SumPrice").html());-->
<!--        var singlePrice = parseFloat(tr.find("#Singel-Price").html());-->
<!--        var data = {'item_id': item_id.val(), 'props': props.val(), 'qty': qty.val(), 'sku_id': sku_id.val()};-->
<!--        $.post('/cart/update', data, function (response) {-->
<!--            tr.find("#error-message").remove();-->
<!--            tr.find("#num-error").remove();-->
<!--            if (!response) {-->
<!--                $(".shopping_car").find("span").html(cart - sumPrice / singlePrice + parseInt(qty.val()));-->
<!--                tr.find("#SumPrice").html(parseFloat(qty.val()) * parseFloat(singlePrice));-->
<!--                update_total_price();-->
<!--            }-->
<!--            tr.find("#stock-error").append(response);-->
<!--            if (quantity.siblings('#stock-error').find("#error-message").text()) {-->
<!--                quantity.val(Number(quantity.val()) - 1);-->
<!--            }-->
<!--        });-->
<!--    }-->
<!--    function update_total_price() {-->
<!--        var positions = [];-->
<!--        $('[name="position[]"]:checked').each(function () {-->
<!--            positions.push($(this).val());-->
<!--        });-->
<!--        $.post('/cart/getPrice', {'positions': positions}, function (data) {-->
<!--            if (!data.msg) {-->
<!--                $('#total_price').text(data.total);-->
<!--            }-->
<!--        }, 'json');-->
<!--    }-->
<!---->
<!--</script>-->