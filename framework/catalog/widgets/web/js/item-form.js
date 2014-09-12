/**
 * @link http://www.yincart.com/
 * @copyright Copyright (c) 2014 Yincart
 * @license http://www.yincart.com/license/
 */

/**
 * @author jeremy.zhou(gao_lujie@live.cn)
 */

$(function () {

    var $itemForm = $('#item-form');

    $(window).on('itemGrid.onSelectRow', function (event, id, checked, onSelectRowEvent) {
        $.get($itemForm.data('url'), {'id': id}, function (response) {
            var oldCategoryId = $itemForm.find('#item-category_id').val();

            for (var field in response) {
                var selector = '#item-' + field;
                var $selector = $itemForm.find(selector);
                if ($selector.attr('type') == 'checkbox') {
                    $selector.attr('checked', response[field] ? true : false);
                } else {
                    $selector.val(response[field]);
                }
            }

            var zTreeObj = $.fn.zTree.getZTreeObj('category-tree');
            var treeNode = zTreeObj.getNodeByParam('category_id', response.category_id);
            if (treeNode) {
                zTreeObj.checkNode(treeNode, true, true, true);
            } else {
                treeNode = zTreeObj.getNodeByParam('category_id', oldCategoryId);
                if (treeNode) {
                    zTreeObj.checkNode(treeNode, false, true, true);
                }
            }

            var itemImgs = [];
            for (var i in response.itemImgs) {
                itemImgs.push(response.itemImgs[i].url)
            }
            $(window).triggerHandler('gallery.reload', [itemImgs])
        }, 'json');
    });

    $(window).on('catTree.onClick', function (event, onClickEvent, treeId, treeNode) {
        var zTreeObj = $.fn.zTree.getZTreeObj(treeId);
        zTreeObj.checkNode(treeNode, !treeNode.checked, true, true);
    });

    $(window).on('catTree.onCheck', function (event, onClickEvent, treeId, treeNode) {
        if (treeNode.checked) {
            $('#item-category_id').val(treeNode.category_id);
            $.get($itemForm.data('prop-url'), {'categoryId': treeNode.category_id, 'itemId': $('#item-item_id').val()}, function (response) {
                $('#item-prop-form').parent().html(response);
                $(window).triggerHandler('skuTable.init');
            }, 'html');
        } else {
            $('#item-category_id').val('');
            $('#item-prop-form').html('');
        }
    });

    var showResponse = function (data, status, response) {
        $itemForm.data('yiiActiveForm').validated = false;
        $itemForm.data('yiiActiveForm').submitting = false;

        if (data['success']) {
            if ($itemForm.data('trigger-prop-save')) {
                $(window).triggerHandler('itemForm.afterSave', [data]);
            } else {
                jQuery.gritter.add({
                    title: data['message'],
                    text: data['message'],
                    sticky: false,
                    time: 2000,
                    class_name: 'gritter-success gritter-light gritter-right'
                });
            }
            $itemForm.find('[name="Item[item_id]"]').val(data['id']);
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
                var $formGroup = $itemForm.find('.field-category-' + field);
                $formGroup.removeClass('has-success').addClass('has-error');
                $formGroup.find('.help-block').text(errors[field]);
            }
        }
    };

    var checkValidation = function (fields, $form, options) {
        return $form.data('yiiActiveForm').validated;
    };

    var options = {
        beforeSubmit: checkValidation,
        success: showResponse,
        dataType: 'json',
        timeout: 3000
    };

    $itemForm.ajaxForm(options);

    $itemForm.find('textarea').ckeditor({filebrowserBrowseUrl: $itemForm.data('file-browser-url')});
});