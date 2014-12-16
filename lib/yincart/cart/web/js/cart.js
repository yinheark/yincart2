/**
 * Created by LCH on 2014/11/22.
 */

$(function() {
    $(' .update-cart ').click(function() {
        $data = $(this).parents('form').serialize();
        var beforeUpdate = $(window).triggerHandler('item.beforeUpdate', this);
        if (beforeUpdate !== false) {
            $.post($(this).data('url'), $data, function(response) {
                if (response.message) {
                    alert(response.message);
                }
                if (response.redirect) {
                    window.location.href = response.redirect;
                }
            }, 'json');
        }
        $(window).triggerHandler('item.afterUpdate');
    });

    $(' .remove-item , .clear-all ').click(function() {
        $data = $(this).data('item');
        var beforeRemove = $(window).triggerHandler('item.beforeRemove', this);
        if (beforeRemove !== false) {
            $.post($(this).data('url'), {'item_id':$data}, function(response) {
                if (response.message) {
                    alert(response.message);
                }
                if (response.redirect) {
                    window.location.href = response.redirect;
                }
            }, 'json');
        }
        $(window).triggerHandler('item.afterRemove');
    });
});
