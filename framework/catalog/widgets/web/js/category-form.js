/**
 * @link http://www.yincart.com/
 * @copyright Copyright (c) 2014 Yincart
 * @license http://www.yincart.com/license/
 */

/**
 * @author jeremy.zhou(gao_lujie@live.cn)
 */

$(function () {
    var $catForm = $('#category-form');

    $(window).on('catTree.onClick', function (event, onClickEvent, treeId, treeNode) {
        $.get($catForm.data('url'), {'id': treeNode.category_id}, function (response) {
            for (var field in response) {
                var selector = '#category-' + field;
                var $selector = $catForm.find(selector);
                if ($selector.attr('type') == 'checkbox') {
                    $selector.attr('checked', response[field] ? true : false);
                } else {
                    $selector.val(response[field]);
                }
            }
            if (response['image']) {
                $(window).triggerHandler('gallery.reload', [[response['image']]]);
            } else {
                $(window).triggerHandler('gallery.reload', [[]]);
            }
        }, 'json');
    });

    var showResponse = function (data, status, response) {
        $catForm.data('yiiActiveForm').validated = false;
        $catForm.data('yiiActiveForm').submitting = false;

        if (data['success']) {
            jQuery.gritter.add({
                title: data['message'],
                text: data['message'],
                sticky: false,
                time: 2000,
                class_name: 'gritter-success gritter-light gritter-right'
            });
            $catForm.find('[name="Category[category_id]"]').val(data['id']);
            //reload tree view
            $(window).triggerHandler('catTree.reload');
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
        beforeSubmit: checkValidation,
        success: showResponse,
        dataType: 'json',
        timeout: 3000
    };

    $catForm.ajaxForm(options);

    $('#category-new-button').click(function () {
        $catForm[0].reset();
        $catForm.find('[name^="Category"]').val('');
    });

    $('#category-delete-button').click(function () {
        $.post($catForm.data('del-url'), {id: $('#category-category_id').val()}, function (data) {
            if (data['success']) {
                jQuery.gritter.add({
                    title: data['message'],
                    text: data['message'],
                    sticky: false,
                    time: 2000,
                    class_name: 'gritter-success gritter-light gritter-right'
                });
                $('#category-new-button').click();
                //reload tree view
                $(window).triggerHandler('catTree.reload');
            } else {
                jQuery.gritter.add({
                    title: data['message'],
                    text: data['message'],
                    sticky: false,
                    time: 2000,
                    class_name: 'gritter-error gritter-light gritter-right'
                });
            }
        }, 'json');
    });
});