<?php
/**
 * @link http://www.yincart.com/
 * @copyright Copyright (c) 2014 Yincart
 * @license http://www.yincart.com/license/
 *
 * Yincart core class map.
 */

return [
    'singleton' => [
        //system class
        'yii\web\JqueryAsset' => 'yincart\assets\JqueryAsset',
        //asset class
        'jqueryAsset'       => 'yincart\assets\JqueryAsset',
        'aceAdminAsset'     => 'yincart\assets\AceAdminAsset',
        'zTreeAsset'        => 'yincart\assets\ZTreeAsset',
        'jqueryFormAsset'   => 'yincart\assets\JqueryFormAsset',
        'juicerAsset'       => 'yincart\assets\JuicerAsset',
        'elFinderAsset'     => 'yincart\assets\ElFinderAsset',
        'ckEditorAsset'     => 'yincart\assets\CkEditorAsset',
        'garbiniAsset'      => 'yincart\assets\GarbiniAsset',
    ],
    'class' => [
        //system class
        //widget class
        'elFinder'          => 'yincart\widgets\ElFinder',
        'gallery'           => 'yincart\widgets\Gallery',
        'categoryTree'      => 'yincart\catalog\widgets\CategoryTree',
        'categoryForm'      => 'yincart\catalog\widgets\CategoryForm',
        'itemPropGrid'      => 'yincart\catalog\widgets\ItemPropGrid',
        'itemGrid'          => 'yincart\catalog\widgets\ItemGrid',
        'itemForm'          => 'yincart\catalog\widgets\ItemForm',
        'itemPropForm'      => 'yincart\catalog\widgets\ItemPropForm',
        'customerGrid'      => 'yincart\customer\widgets\CustomerGrid',
        'orderGrid'         => 'yincart\sales\widgets\OrderGrid',
        //form models class
        'modelForm'         => 'yincart\models\ModelForm',
        'jqForm'            => 'yincart\models\JqForm',
        //catalog models class
        'category'          => 'yincart\catalog\models\Category',
        'item'              => 'yincart\catalog\models\Item',
        'itemImg'           => 'yincart\catalog\models\ItemImg',
        'itemProp'          => 'yincart\catalog\models\ItemProp',
        'itemPropValue'     => 'yincart\catalog\models\ItemPropValue',
        'propValue'         => 'yincart\catalog\models\PropValue',
        'sku'               => 'yincart\catalog\models\Sku',
        'propValueModel'    => 'yincart\catalog\models\PropValueModel',
        //customer models class
        'address'           => 'yincart\customer\models\Address',
        'addressArea'       => 'yincart\customer\models\AddressArea',
        'customer'          => 'yincart\customer\models\Customer',
        'customerGroup'     => 'yincart\customer\models\CustomerGroup',
        'wish'              => 'yincart\customer\models\Wish',
        'account'           => 'yincart\customer\models\Account',
        //sales models class
        'order'             => 'yincart\sales\models\Order',
        'orderItem'         => 'yincart\sales\models\OrderItem',
        'shippingCart'      => 'yincart\sales\models\ShippingCart',
        'cart'              => 'yincart\sales\models\Cart',
    ]
];