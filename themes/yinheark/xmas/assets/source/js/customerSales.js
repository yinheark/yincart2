/**
 * Created by Cangzhou.Wu on 14-11-27.
 */

$(function() {
    $(' .request-sales ').click(function() {
        $data = $(this).parents('form').serialize();
        var beforeAddToCart = $(window).triggerHandler('item.beforeAddToCart', this);
        if (beforeAddToCart !== false) {
            $.post($(this).data('url'), $data, function(response) {
                if (response.message) {
                    alert(response.message);
                }
                if (response.redirect) {
                    window.location.href = response.redirect;
                }
            }, 'json');
        }
        $(window).triggerHandler('item.afterAddToCart');
    });
});