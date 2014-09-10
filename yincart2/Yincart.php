<?php
/**
 * @link http://www.yincart.com/
 * @copyright Copyright (c) 2014 Yincart
 * @license http://www.yincart.com/license/
 */

namespace yincart;

use yii\base\UnknownMethodException;
use yii\helpers\ArrayHelper;


/**
 * Class Yincart
 * use yincart $container to create model for rewrite
 * use controllerMap to rewrite controller
 * use view theme to rewrite view
 *
 * --- Asset class methodInstance ---
 * @method static \yincart\assets\JqueryAsset                            getJqueryAsset(array $config = [])
 * @method static \yincart\assets\AceAdminAsset                          getAceAdminAsset(array $config = [])
 * @method static \yincart\assets\ZTreeAsset                             getZTreeAsset(array $config = [])
 * @method static \yincart\assets\JqueryFormAsset                        getJqueryFormAsset(array $config = [])
 * @method static \yincart\assets\JuicerAsset                            getJuicerAsset(array $config = [])
 * @method static \yincart\assets\ElFinderAsset                          getElFinderAsset(array $config = [])
 * @method static \yincart\assets\CkEditorAsset                          getCkEditorAsset(array $config = [])
 * @method static \yincart\assets\GarbiniAsset                           getGarbiniAsset(array $config = [])
 *
 * --- widgets class methodInstance ---
 * @method static \yincart\widgets\ElFinder                              getElFinder(array $config = [])
 * @method static \yincart\widgets\Gallery                               getGallery(array $config = [])
 * @method static \yincart\catalog\widgets\CategoryTree                  getCategoryTree(array $config = [])
 * @method static \yincart\catalog\widgets\CategoryForm                  getCategoryForm(array $config = [])
 * @method static \yincart\catalog\widgets\ItemPropGrid                  getItemPropGrid(array $config = [])
 * @method static \yincart\catalog\widgets\ItemGrid                      getItemGrid(array $config = [])
 * @method static \yincart\catalog\widgets\ItemForm                      getItemForm(array $config = [])
 * @method static \yincart\catalog\widgets\ItemPropForm                  getItemPropForm(array $config = [])
 * @method static \yincart\customer\widgets\CustomerGrid                 getCustomerGrid(array $config = [])
 * @method static \yincart\sales\widgets\OrderGrid                       getOrderGrid(array $config = [])
 *
 * --- Form class methodInstance ---
 * @method static \yincart\models\ModelForm                              getModelForm(array $config = [])
 * @method static \yincart\models\JqForm                                 getJqForm(array $config = [])
 *
 * --- models class methodInstance ---
 * @method static \yincart\catalog\models\Category                       getCategory(array $config = [])
 * @method static \yincart\catalog\models\Item                           getItem(array $config = [])
 * @method static \yincart\catalog\models\ItemImg                        getItemImg(array $config = [])
 * @method static \yincart\catalog\models\ItemProp                       getItemProp(array $config = [])
 * @method static \yincart\catalog\models\ItemPropValue                  getItemPropValue(array $config = [])
 * @method static \yincart\catalog\models\PropValue                      getPropValue(array $config = [])
 * @method static \yincart\catalog\models\Sku                            getSku(array $config = [])
 * @method static \yincart\catalog\models\PropValueModel                 getPropValueModel(array $config = [])
 * @method static \yincart\customer\models\Address                       getAddress(array $config = [])
 * @method static \yincart\customer\models\AddressArea                   getAddressArea(array $config = [])
 * @method static \yincart\customer\models\Customer                      getCustomer(array $config = [])
 * @method static \yincart\customer\models\CustomerGroup                 getCustomerGroup(array $config = [])
 * @method static \yincart\customer\models\Wish                          getWish(array $config = [])
 * @method static \yincart\customer\models\Account                       getAccount(array $config = [])
 * @method static \yincart\sales\models\Order                            getOrder(array $config = [])
 * @method static \yincart\sales\models\OrderItem                        getOrderItem(array $config = [])
 * @method static \yincart\sales\models\ShippingCart                     getShippingCart(array $config = [])
 * @method static \yincart\sales\models\Cart                             getCart(array $config = [])
 *
 * ================================================================================
 *
 * --- Asset class methodClass ---
 * @method static string|\yincart\assets\JqueryAsset                     getJqueryAssetClass()
 * @method static string|\yincart\assets\AceAdminAsset                   getAceAdminAssetClass()
 * @method static string|\yincart\assets\ZTreeAsset                      getZTreeAssetClass()
 * @method static string|\yincart\assets\JqueryFormAsset                 getJqueryFormAssetClass()
 * @method static string|\yincart\assets\JuicerAsset                     getJuicerAssetClass()
 * @method static string|\yincart\assets\ElFinderAsset                   getElFinderAssetClass()
 * @method static string|\yincart\assets\CkEditorAsset                   getCkEditorAssetClass()
 * @method static string|\yincart\assets\GarbiniAsset                    getGarbiniAssetClass()
 *
 * --- widgets class methodClass ---
 * @method static string|\yincart\widgets\ElFinder                       getElFinderClass()
 * @method static string|\yincart\widgets\Gallery                        getGalleryClass()
 * @method static string|\yincart\catalog\widgets\CategoryTree           getCategoryTreeClass()
 * @method static string|\yincart\catalog\widgets\CategoryForm           getCategoryFormClass()
 * @method static string|\yincart\catalog\widgets\ItemPropGrid           getItemPropGridClass()
 * @method static string|\yincart\catalog\widgets\ItemGrid               getItemGridClass()
 * @method static string|\yincart\catalog\widgets\ItemForm               getItemFormClass()
 * @method static string|\yincart\catalog\widgets\ItemPropForm           getItemPropFormClass()
 * @method static string|\yincart\customer\widgets\CustomerGrid          getCustomerGridClass()
 * @method static string|\yincart\sales\widgets\OrderGrid                getOrderGridClass()
 *
 * --- Form class methodClass ---
 * @method static string|\yincart\models\ModelForm                       getModelFormClass()
 * @method static string|\yincart\models\JqForm                          getJqFormClass()
 *
 * --- models class methodClass ---
 * @method static string|\yincart\catalog\models\Category                getCategoryClass()
 * @method static string|\yincart\catalog\models\Item                    getItemClass()
 * @method static string|\yincart\catalog\models\ItemImg                 getItemImgClass()
 * @method static string|\yincart\catalog\models\ItemProp                getItemPropClass()
 * @method static string|\yincart\catalog\models\ItemPropValue           getItemPropValueClass()
 * @method static string|\yincart\catalog\models\PropValue               getPropValueClass()
 * @method static string|\yincart\catalog\models\Sku                     getSkuClass()
 * @method static string|\yincart\catalog\models\PropValueModel          getPropValueModelClass()
 * @method static string|\yincart\customer\models\Address                getAddressClass()
 * @method static string|\yincart\customer\models\AddressArea            getAddressAreaClass()
 * @method static string|\yincart\customer\models\Customer               getCustomerClass()
 * @method static string|\yincart\customer\models\CustomerGroup          getCustomerGroupClass()
 * @method static string|\yincart\customer\models\Wish                   getWishClass()
 * @method static string|\yincart\customer\models\Account                getAccountClass()
 * @method static string|\yincart\sales\models\Order                     getOrderClass()
 * @method static string|\yincart\sales\models\OrderItem                 getOrderItemClass()
 * @method static string|\yincart\sales\models\ShippingCart              getShippingCartClass()
 * @method static string|\yincart\sales\models\Cart                      getCartClass()
 *
 * @package yincart
 * @author jeremy.zhou(gao_lujie@live.cn)
 */
class Yincart
{
    /**
     * @var array class map used for class create
     */
    public static $classMap;

    /**
     * @var Container create object by call [[createObject()]].
     */
    public static $container;

    /**
     * @param $name
     * @param $arguments
     * @return mixed
     */
    public static function __callStatic($name, $arguments)
    {
        return call_user_func_array([self::$container, $name], $arguments);
    }
}


/**
 * Class Container
 *
 * --- Asset class propertyInstance ---
 * @property \yincart\assets\JqueryAsset                          $jqueryAsset
 * @property \yincart\assets\AceAdminAsset                        $aceAdminAsset
 * @property \yincart\assets\ZTreeAsset                           $zTreeAsset
 * @property \yincart\assets\JqueryFormAsset                      $jqueryFormAsset
 * @property \yincart\assets\JuicerAsset                          $juicerAsset
 * @property \yincart\assets\ElFinderAsset                        $elFinderAsset
 * @property \yincart\assets\CkEditorAsset                        $ckEditorAsset
 * @property \yincart\assets\GarbiniAsset                         $garbiniAsset
 *
 * --- widgets class propertyInstance ---
 * @property \yincart\widgets\ElFinder                            $elFinder
 * @property \yincart\widgets\Gallery                             $gallery
 * @property \yincart\catalog\widgets\CategoryTree                $categoryTree
 * @property \yincart\catalog\widgets\CategoryForm                $categoryForm
 * @property \yincart\catalog\widgets\ItemPropGrid                $itemPropGrid
 * @property \yincart\catalog\widgets\ItemGrid                    $itemGrid
 * @property \yincart\catalog\widgets\ItemForm                    $itemForm
 * @property \yincart\catalog\widgets\ItemPropForm                $itemPropForm
 * @property \yincart\customer\widgets\CustomerGrid               $customerGrid
 * @property \yincart\sales\widgets\OrderGrid                     $orderGrid
 *
 * --- Form class propertyInstance ---
 * @property \yincart\models\ModelForm                            $modelForm
 * @property \yincart\models\JqForm                               $jqForm
 *
 * --- models class propertyInstance ---
 * @property \yincart\catalog\models\Category                     $category
 * @property \yincart\catalog\models\Item                         $item
 * @property \yincart\catalog\models\ItemImg                      $itemImg
 * @property \yincart\catalog\models\ItemProp                     $itemProp
 * @property \yincart\catalog\models\ItemPropValue                $itemPropValue
 * @property \yincart\catalog\models\PropValue                    $propValue
 * @property \yincart\catalog\models\Sku                          $sku
 * @property \yincart\catalog\models\PropValueModel               $propValueModel
 * @property \yincart\customer\models\Address                     $address
 * @property \yincart\customer\models\AddressArea                 $addressArea
 * @property \yincart\customer\models\Customer                    $customer
 * @property \yincart\customer\models\CustomerGroup               $customerGroup
 * @property \yincart\customer\models\Wish                        $wish
 * @property \yincart\customer\models\Account                     $account
 * @property \yincart\sales\models\Order                          $order
 * @property \yincart\sales\models\OrderItem                      $orderItem
 * @property \yincart\sales\models\ShippingCart                   $shippingCart
 * @property \yincart\sales\models\Cart                           $cart
 *
 * ================================================================================
 *
 * --- Asset class propertyClass ---
 * @property string|\yincart\assets\JqueryAsset                   $jqueryAssetClass
 * @property string|\yincart\assets\AceAdminAsset                 $aceAdminAssetClass
 * @property string|\yincart\assets\ZTreeAsset                    $zTreeAssetClass
 * @property string|\yincart\assets\JqueryFormAsset               $jqueryFormAssetClass
 * @property string|\yincart\assets\JuicerAsset                   $juicerAssetClass
 * @property string|\yincart\assets\ElFinderAsset                 $elFinderAssetClass
 * @property string|\yincart\assets\CkEditorAsset                 $ckEditorAssetClass
 * @property string|\yincart\assets\GarbiniAsset                  $garbiniAssetClass
 *
 * --- widgets class propertyClass ---
 * @property string|\yincart\widgets\ElFinder                     $elFinderClass
 * @property string|\yincart\widgets\Gallery                      $galleryClass
 * @property string|\yincart\catalog\widgets\CategoryTree         $categoryTreeClass
 * @property string|\yincart\catalog\widgets\CategoryForm         $categoryFormClass
 * @property string|\yincart\catalog\widgets\ItemPropGrid         $itemPropGridClass
 * @property string|\yincart\catalog\widgets\ItemGrid             $itemGridClass
 * @property string|\yincart\catalog\widgets\ItemForm             $itemFormClass
 * @property string|\yincart\catalog\widgets\ItemPropForm         $itemPropFormClass
 * @property string|\yincart\customer\widgets\CustomerGrid        $customerGridClass
 * @property string|\yincart\sales\widgets\OrderGrid              $orderGridClass
 *
 * --- Form class propertyClass ---
 * @property string|\yincart\models\ModelForm                     $modelFormClass
 * @property string|\yincart\models\JqForm                        $jqFormClass
 *
 * --- models class propertyClass ---
 * @property string|\yincart\catalog\models\Category              $categoryClass
 * @property string|\yincart\catalog\models\Item                  $itemClass
 * @property string|\yincart\catalog\models\ItemImg               $itemImgClass
 * @property string|\yincart\catalog\models\ItemProp              $itemPropClass
 * @property string|\yincart\catalog\models\ItemPropValue         $itemPropValueClass
 * @property string|\yincart\catalog\models\PropValue             $propValueClass
 * @property string|\yincart\catalog\models\Sku                   $skuClass
 * @property string|\yincart\catalog\models\PropValueModel        $propValueModelClass
 * @property string|\yincart\customer\models\Address              $addressClass
 * @property string|\yincart\customer\models\AddressArea          $addressAreaClass
 * @property string|\yincart\customer\models\Customer             $customerClass
 * @property string|\yincart\customer\models\CustomerGroup        $customerGroupClass
 * @property string|\yincart\customer\models\Wish                 $wishClass
 * @property string|\yincart\customer\models\Account              $accountClass
 * @property string|\yincart\sales\models\Order                   $orderClass
 * @property string|\yincart\sales\models\OrderItem               $orderItemClass
 * @property string|\yincart\sales\models\ShippingCart            $shippingCartClass
 * @property string|\yincart\sales\models\Cart                    $cartClass
 *
 * ================================================================================
 *
 * --- Asset class methodInstance ---
 * @method \yincart\assets\JqueryAsset                            getJqueryAsset(array $config = [])
 * @method \yincart\assets\AceAdminAsset                          getAceAdminAsset(array $config = [])
 * @method \yincart\assets\ZTreeAsset                             getZTreeAsset(array $config = [])
 * @method \yincart\assets\JqueryFormAsset                        getJqueryFormAsset(array $config = [])
 * @method \yincart\assets\JuicerAsset                            getJuicerAsset(array $config = [])
 * @method \yincart\assets\ElFinderAsset                          getElFinderAsset(array $config = [])
 * @method \yincart\assets\CkEditorAsset                          getCkEditorAsset(array $config = [])
 * @method \yincart\assets\GarbiniAsset                           getGarbiniAsset(array $config = [])
 *
 * --- widgets class methodInstance ---
 * @method \yincart\widgets\ElFinder                              getElFinder(array $config = [])
 * @method \yincart\widgets\Gallery                               getGallery(array $config = [])
 * @method \yincart\catalog\widgets\CategoryTree                  getCategoryTree(array $config = [])
 * @method \yincart\catalog\widgets\CategoryForm                  getCategoryForm(array $config = [])
 * @method \yincart\catalog\widgets\ItemPropGrid                  getItemPropGrid(array $config = [])
 * @method \yincart\catalog\widgets\ItemGrid                      getItemGrid(array $config = [])
 * @method \yincart\catalog\widgets\ItemForm                      getItemForm(array $config = [])
 * @method \yincart\catalog\widgets\ItemPropForm                  getItemPropForm(array $config = [])
 * @method \yincart\customer\widgets\CustomerGrid                 getCustomerGrid(array $config = [])
 * @method \yincart\sales\widgets\OrderGrid                       getOrderGrid(array $config = [])
 *
 * --- Form class methodInstance ---
 * @method \yincart\models\ModelForm                              getModelForm(array $config = [])
 * @method \yincart\models\JqForm                                 getJqForm(array $config = [])
 *
 * --- models class methodInstance ---
 * @method \yincart\catalog\models\Category                       getCategory(array $config = [])
 * @method \yincart\catalog\models\Item                           getItem(array $config = [])
 * @method \yincart\catalog\models\ItemImg                        getItemImg(array $config = [])
 * @method \yincart\catalog\models\ItemProp                       getItemProp(array $config = [])
 * @method \yincart\catalog\models\ItemPropValue                  getItemPropValue(array $config = [])
 * @method \yincart\catalog\models\PropValue                      getPropValue(array $config = [])
 * @method \yincart\catalog\models\Sku                            getSku(array $config = [])
 * @method \yincart\catalog\models\PropValueModel                 getPropValueModel(array $config = [])
 * @method \yincart\customer\models\Address                       getAddress(array $config = [])
 * @method \yincart\customer\models\AddressArea                   getAddressArea(array $config = [])
 * @method \yincart\customer\models\Customer                      getCustomer(array $config = [])
 * @method \yincart\customer\models\CustomerGroup                 getCustomerGroup(array $config = [])
 * @method \yincart\customer\models\Wish                          getWish(array $config = [])
 * @method \yincart\customer\models\Account                       getAccount(array $config = [])
 * @method \yincart\sales\models\Order                            getOrder(array $config = [])
 * @method \yincart\sales\models\OrderItem                        getOrderItem(array $config = [])
 * @method \yincart\sales\models\ShippingCart                     getShippingCart(array $config = [])
 * @method \yincart\sales\models\Cart                             getCart(array $config = [])
 *
 * ================================================================================
 *
 * --- Asset class methodClass ---
 * @method string|\yincart\assets\JqueryAsset                     getJqueryAssetClass()
 * @method string|\yincart\assets\AceAdminAsset                   getAceAdminAssetClass()
 * @method string|\yincart\assets\ZTreeAsset                      getZTreeAssetClass()
 * @method string|\yincart\assets\JqueryFormAsset                 getJqueryFormAssetClass()
 * @method string|\yincart\assets\JuicerAsset                     getJuicerAssetClass()
 * @method string|\yincart\assets\ElFinderAsset                   getElFinderAssetClass()
 * @method string|\yincart\assets\CkEditorAsset                   getCkEditorAssetClass()
 * @method string|\yincart\assets\GarbiniAsset                    getGarbiniAssetClass()
 *
 * --- widgets class methodClass ---
 * @method string|\yincart\widgets\ElFinder                       getElFinderClass()
 * @method string|\yincart\widgets\Gallery                        getGalleryClass()
 * @method string|\yincart\catalog\widgets\CategoryTree           getCategoryTreeClass()
 * @method string|\yincart\catalog\widgets\CategoryForm           getCategoryFormClass()
 * @method string|\yincart\catalog\widgets\ItemPropGrid           getItemPropGridClass()
 * @method string|\yincart\catalog\widgets\ItemGrid               getItemGridClass()
 * @method string|\yincart\catalog\widgets\ItemForm               getItemFormClass()
 * @method string|\yincart\catalog\widgets\ItemPropForm           getItemPropFormClass()
 * @method string|\yincart\customer\widgets\CustomerGrid          getCustomerGridClass()
 * @method string|\yincart\sales\widgets\OrderGrid                getOrderGridClass()
 *
 * --- Form class methodClass ---
 * @method string|\yincart\models\ModelForm                       getModelFormClass()
 * @method string|\yincart\models\JqForm                          getJqFormClass()
 *
 * --- models class methodClass ---
 * @method string|\yincart\catalog\models\Category                getCategoryClass()
 * @method string|\yincart\catalog\models\Item                    getItemClass()
 * @method string|\yincart\catalog\models\ItemImg                 getItemImgClass()
 * @method string|\yincart\catalog\models\ItemProp                getItemPropClass()
 * @method string|\yincart\catalog\models\ItemPropValue           getItemPropValueClass()
 * @method string|\yincart\catalog\models\PropValue               getPropValueClass()
 * @method string|\yincart\catalog\models\Sku                     getSkuClass()
 * @method string|\yincart\catalog\models\PropValueModel          getPropValueModelClass()
 * @method string|\yincart\customer\models\Address                getAddressClass()
 * @method string|\yincart\customer\models\AddressArea            getAddressAreaClass()
 * @method string|\yincart\customer\models\Customer               getCustomerClass()
 * @method string|\yincart\customer\models\CustomerGroup          getCustomerGroupClass()
 * @method string|\yincart\customer\models\Wish                   getWishClass()
 * @method string|\yincart\customer\models\Account                getAccountClass()
 * @method string|\yincart\sales\models\Order                     getOrderClass()
 * @method string|\yincart\sales\models\OrderItem                 getOrderItemClass()
 * @method string|\yincart\sales\models\ShippingCart              getShippingCartClass()
 * @method string|\yincart\sales\models\Cart                      getCartClass()
 *
 * @package yincart
 * @author jeremy.zhou(gao_lujie@live.cn)
 */
class Container
{
    /**
     * @var array class map used for class create
     */
    public static $classMap;

    public function __construct($classMap = [])
    {
        if (isset(\Yii::$app->params['classMap'])) {
            $customClassMap = \Yii::$app->params['classMap'];
            self::$classMap = ArrayHelper::merge($classMap, $customClassMap);
        } else {
            self::$classMap = $classMap;
        }

        foreach ($classMap['singleton'] as $name => $class) {
            \Yii::$container->setSingleton($name, $class);
        }
        foreach ($classMap['class'] as $name => $class) {
            \Yii::$container->set($name, $class);
        }
    }

    public function __get($name)
    {
        if (strlen($name) > 5 && substr($name, -5) === 'Class') {
            $className = substr($name, 0, -5);
            foreach (['singleton', 'class'] as $key) {
                if (isset(self::$classMap[$key][$className])) {
                    return self::$classMap[$key][$className];
                }
            }
        }
        return \Yii::createObject($name);
    }

    public function __call($name, $arguments)
    {
        if (strlen($name) > 3 && substr($name, 0, 3) === 'get') {
            $className = lcfirst(substr($name, 3));
            if (strlen($name) > 8 && substr($name, -5) === 'Class') {
                $className = lcfirst(substr($name, 3, -5));
                foreach (['singleton', 'class'] as $key) {
                    if (isset(self::$classMap[$key][$className])) {
                        return self::$classMap[$key][$className];
                    }
                }
            }
            $class = ['class' => $className];
            if (count($arguments) == 1 && is_array($arguments[0])) {
                $class = ArrayHelper::merge($class, $arguments[0]);
            }
            return \Yii::createObject($class);
        }
        throw new UnknownMethodException('Calling unknown method: ' . get_class($this) . "::$name()");
    }
}

Yincart::$classMap = include(__DIR__ . '/classes.php');
Yincart::$container = new Container(Yincart::$classMap);