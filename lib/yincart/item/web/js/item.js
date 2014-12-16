/**
 * Created by LCH on 2014/11/22.
 */

$(function() {
    $('.add-to-cart, .buy-now').click(function() {
        $data = $(this).parents('form').serialize();
        var beforeAddToCart = $(window).triggerHandler('item.beforeAddToCart', this);
        if (beforeAddToCart !== false) {
            $.post($(this).data('url'), $data, function(response) {
                if (response.message) {
                    $('.shopping_car').text(parseInt($('#qty').val())+parseInt($('.shopping_car').text()));
                    alert(response.message);
                }
                if (response.redirect) {
                    window.location.href = response.redirect;
                }
            }, 'json');
        }
        $(window).triggerHandler('item.afterAddToCart');
    });

    var validateQty = function(qty) {
        if (qty > $('#qty').data('max')) {
            qty = $('#qty').data('max');
        }
        if (qty > $('#qty').data('stock')) {
            qty = $('#qty').data('stock');
        }
        if (qty < $('#qty').data('min')) {
            qty = $('#qty').data('min');
        }
        if (qty < 1) {
            qty = 1;
        }
        return qty;
    };

    $('.add, .minus').click(function () {
        var qty = parseInt($('#qty').val());
        if ($(this).hasClass('add')) {
            qty++;
        } else {
            qty--;
        }
        $('#qty').val(validateQty(qty));
    });

    $('#qty').keyup(function () {
        var qty = $('#qty').val().replace(/\D/g,'');
        $('#qty').val(validateQty(qty));
    });
});
