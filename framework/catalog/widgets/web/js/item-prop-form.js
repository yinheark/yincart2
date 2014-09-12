/**
 * @link http://www.yincart.com/
 * @copyright Copyright (c) 2014 Yincart
 * @license http://www.yincart.com/license/
 */

/**
 * @author jeremy.zhou(gao_lujie@live.cn)
 */

$(function () {

    function descartes(arrayA, arrayB) {
        var result = [];
        for (var i in arrayA) {
            for (var j in arrayB) {
                result.push(arrayA[i] + ';' + arrayB[j]);
            }
        }
        return result;
    }

    function descartesMulti(arrays) {
        var array = arrays[arrays.length - 1];
        for (var i = arrays.length - 2; i >= 0; i--) {
            array = descartes(arrays[i], array);
        }
        return array;
    }

    function initSkuTable() {
        var $itemPropValueForm = $('#item-prop-form');
        var $itemSkuTable = $('#item-sku-table');

        function generateSkuTable(skuData) {
            var propNames = [];
            var skus = [];
            $itemPropValueForm.find('div[data-is-sale=Yes]').each(function () {
                var $this = $(this);
                propNames.push($this.data('name'));
                var propsInfo = [];
                $this.find('input[type=checkbox][data-is-sale=Yes]:checked').each(function () {
                    var $this = $(this);
                    var propInfo = $this.data('item-prop-id') + ':' + $this.val() + ',' + $this.parent().text().trim();
                    propsInfo.push(propInfo);
                });
                skus.push(propsInfo);
            });

            skus = descartesMulti(skus);

            if (!skus || skus.length == 0) {
                $itemSkuTable.html('');
                return;
            }

            var tbody = '<tbody>';
            for (var i in skus) {
                tbody += '<tr>';
                var sku = skus[i];
                var propsInfo = sku.split(';');
                var props = [];
                var pNames = [];
                for (var j in propsInfo) {
                    var propInfo = propsInfo[j];
                    var values = propInfo.split(',');
                    tbody += '<td>' + values[1] + '</td>';
                    props.push(values[0]);
                    pNames.push(values[1]);
                }
                props = props.join(';');
                pNames = pNames.join(';');
                var skuInfo = skuData[props];
                if (skuInfo) {
                    tbody += '<td class="col-xs-2"><input type="text" class="col-xs-12" name="Sku[' + props + '][price]" value="' + skuInfo.price + '" /></td>';
                    tbody += '<td class="col-xs-2"><input type="text" class="col-xs-12" name="Sku[' + props + '][stock_qty]" value="' + skuInfo.stock_qty + '" /></td>';
                    tbody += '<td class="col-xs-3"><input type="text" class="col-xs-12" name="Sku[' + props + '][sku]" value="' + skuInfo.sku + '" /></td>';
                    tbody += '<input type="hidden" name="Sku[' + props + '][properties]" value="' + props + '" />';
                    tbody += '<input type="hidden" name="Sku[' + props + '][property_names]" value="' + pNames + '" />';
                } else {
                    tbody += '<td class="col-xs-2"><input type="text" class="col-xs-12" name="Sku[' + props + '][price]" /></td>';
                    tbody += '<td class="col-xs-2"><input type="text" class="col-xs-12" name="Sku[' + props + '][stock_qty]" /></td>';
                    tbody += '<td class="col-xs-3"><input type="text" class="col-xs-12" name="Sku[' + props + '][sku]" /></td>';
                    tbody += '<input type="hidden" name="Sku[' + props + '][properties]" value="' + props + '" />';
                    tbody += '<input type="hidden" name="Sku[' + props + '][property_names]" value="' + pNames + '" />';
                }
                tbody += '</tr>'
            }
            tbody += '</tbody>';

            var thead = '<thead><tr>';
            propNames.push('Price');
            propNames.push('Stock Qty');
            propNames.push('Sku');
            for (var p in propNames) {
                thead += '<th>' + propNames[p] + '</th>';
            }
            thead += '</tr></thead>';

            $itemSkuTable.html(thead + tbody);
        }

        function showSkuTable() {
            if ($itemSkuTable.data('skus')) {
                generateSkuTable($itemSkuTable.data('skus'));
            } else if ($itemSkuTable.data('sku-url')) {
                $.get($itemSkuTable.data('sku-url'), {}, function (response) {
                    $itemSkuTable.data('skus', response);
                    generateSkuTable($itemSkuTable.data('skus'));
                }, 'json')
            } else {
                generateSkuTable({});
            }
        }

        $itemPropValueForm.on('change', 'input[type=checkbox][data-is-sale=Yes]', function () {
            showSkuTable();
        });

        showSkuTable();

        var showResponse = function (data, status, response) {
//            $itemPropValueForm.data('yiiActiveForm').validated = false;
//            $itemPropValueForm.data('yiiActiveForm').submitting = false;

            if (data['success']) {
                jQuery.gritter.add({
                    title: data['message'],
                    text: data['message'],
                    sticky: false,
                    time: 2000,
                    class_name: 'gritter-success gritter-light gritter-right'
                });
                $itemPropValueForm.find('[name="Item[item_id]"]').val(data['id']);
                $(window).triggerHandler('itemGrid.reload');
            } else {
                jQuery.gritter.add({
                    title: data['message'],
                    text: data['message'],
                    sticky: false,
                    time: 2000,
                    class_name: 'gritter-error gritter-light gritter-right'
                });

                var errors = data['errors'];
                for (var field in errors) {
                    var $formGroup = $catForm.find('.field-category-' + field);
                    $formGroup.removeClass('has-success').addClass('has-error');
                    $formGroup.find('.help-block').text(errors[field]);
                }
            }
        };

        var checkValidation = function (fields, $form, options) {
            return $form.data('yiiActiveForm').validated;
        };

        var options = {
//            beforeSubmit: checkValidation,
            success: showResponse,
            dataType: 'json',
            timeout: 3000
        };

        $itemPropValueForm.submit(function () {
            $(this).ajaxSubmit(options);
            return false;
        });
    }

    $(window).on('skuTable.init', function () {
        initSkuTable();
    });

    $(window).triggerHandler('skuTable.init');

    $(window).on('itemForm.afterSave', function (event, data) {
        if (data['success']) {
            var $itemPropValueForm = $('#item-prop-form');
            $itemPropValueForm.find('[name="PropValueModel[itemId]"]').val(data['id']);
            $itemPropValueForm.submit();
        }
    });
});
