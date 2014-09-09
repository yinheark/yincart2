/**
 * @link http://www.yincart.com/
 * @copyright Copyright (c) 2014 Yincart
 * @license http://www.yincart.com/license/
 */

/**
 * @author jeremy.zhou(gao_lujie@live.cn)
 */

$(function () {
    var $addImageButton = $('#add-image-button');
    var $galleryList = $('#gallery-list');

    function addImageView(file) {
        var json = { url: file };
        var tpl = $('#gallery-item').html();
        var html = juicer(tpl, json);
        var $html = $(html);
        if ($galleryList.data('is-one')) {
            $galleryList.html($html);
        } else {
            $galleryList.append($html);
        }
        $html.find('[data-rel="colorbox"]').colorbox(colorboxParams);
    }

    $(window).on('gallery.reload', function(event, files) {
        $galleryList.html('');
        for (var i in files) {
            if (files[i].indexOf('http') == -1) {
                files[i] = $galleryList.data('image-domain') + files[i];
            }
            addImageView(files[i]);
        }
    });

    $addImageButton.click(function () {
        $(window).triggerHandler('elfinder.dialog');
    });

    $(window).on('elfinder.getFile', function (event, file) {
        addImageView(file);
    });

    var $overflow = '';
    var colorboxParams = {
        rel: 'colorbox',
        reposition: true,
        scalePhotos: true,
        scrolling: false,
        previous: '<i class="ace-icon fa fa-arrow-left"></i>',
        next: '<i class="ace-icon fa fa-arrow-right"></i>',
        close: '&times;',
        current: '{current} of {total}',
        maxWidth: '100%',
        maxHeight: '100%',
        onOpen: function () {
            $overflow = document.body.style.overflow;
            document.body.style.overflow = 'hidden';
        },
        onClosed: function () {
            document.body.style.overflow = $overflow;
        },
        onComplete: function () {
            $.colorbox.resize();
        }
    };

    $("#cboxLoadingGraphic").append("<i class='ace-icon fa fa-spinner orange'></i>");//let's add a custom loading icon

    $galleryList.on('click', '[data-action=remove]',function () {
        $(this).parents('li').remove();
    }).on('click', '[data-action=left]',function () {
        var li = $(this).parents('li');
        var prevLi = li.prev();
        prevLi.before(li);
    }).on('click', '[data-action=right]', function () {
        var li = $(this).parents('li');
        var nextLi = li.next();
        nextLi.after(li);
    });
});