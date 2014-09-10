/**
 * @link http://www.yincart.com/
 * @copyright Copyright (c) 2014 Yincart
 * @license http://www.yincart.com/license/
 */

/**
 * @author jeremy.zhou(gao_lujie@live.cn)
 */

$(function() {
    var $variations = $('.variations');
    var skus = $variations.data('skus');
    var item = $variations.data('item');

    $('.item-prop-value').click(function() {
        setSelectedStyle(this);
        setDisableStyle();
        showSelectedSkuInfo();
    });

    function setSelectedStyle(selected) {
        var $selected = $(selected);
        if ($selected.hasClass('item-prop-value-selected')) {
            $selected.removeClass('item-prop-value-selected');
        } else {
            $selected.parent().find('.item-prop-value').removeClass('item-prop-value-selected');
            $selected.addClass('item-prop-value-selected');
        }
    }

    function setDisableStyle() {
        var selectedProps = [];
        $('.item-prop-value-selected').each(function() {
            selectedProps.push($(this).data('prop-value'));
        });
    }

    function showSelectedSkuInfo() {
        var selectedProps = [];
        $('.item-prop-value-selected').each(function() {
            selectedProps.push($(this).data('prop-value'));
        });
        selectedProps = selectedProps.join(';');
        var sku = skus[selectedProps];
        if (sku) {
            $('.price .amount').text(sku['price']);
            $('.item_stock').text(sku['stock_qty']);
            $('[name="sku_id"]').val(sku['sku_id']);
        } else {
            $('.price .amount').text(item['price']);
            $('.item_stock').text(item['stock_qty']);
            $('[name="sku_id"]').val(0);
        }
    }

    function checkPropSelect() {
        if ($('[name="sku_id"]').val() == 0 && skus) {
            return false;
        }
        return true;
    }

    function showResponse() {

    }

    var options = {
        beforeSubmit: checkPropSelect,
        success: showResponse,
        dataType: 'json',
        timeout: 3000
    };

    $('#cart-form').ajaxForm(options);
});