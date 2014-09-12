/**
 * @link http://www.yincart.com/
 * @copyright Copyright (c) 2014 Yincart
 * @license http://www.yincart.com/license/
 */

/**
 * @author jeremy.zhou(gao_lujie@live.cn)
 */

$(function () {
    var csrfParam = $('[name=csrf-param]').attr('content');
    var csrfToken = $('[name=csrf-token]').attr('content');
    var customData = {};
    customData[csrfParam] = csrfToken;
    var $elfinder = $('#elfinder');

    if ($elfinder.data('dialog')) {
        $(window).on('elfinder.dialog', function () {
            var dialog = $('<div/>').dialogelfinder({
                url: $elfinder.data('url'),
                customData: customData,
                lang: 'en',
                width: 840,
                destroyOnClose: true,
                getFileCallback: function (file) {
                    $(window).triggerHandler('elfinder.getFile', [file]);
                },
                commandsOptions: {
                    getfile: {
                        oncomplete: 'close',
                        folders: false
                    }
                }
            }).dialogelfinder('instance')
        });
    } else if ($elfinder.data('iframe')) {
        var getUrlParam = function (paramName) {
            var reParam = new RegExp('(?:[\?&]|&amp;)' + paramName + '=([^&]+)', 'i');
            var match = window.location.search.match(reParam);
            return (match && match.length > 1) ? match[1] : '';
        };

        var funcNum = getUrlParam('CKEditorFuncNum');
        $elfinder.elfinder({
            url: $elfinder.data('url'),
            customData: customData,
            getFileCallback: function (file) {
                window.opener.CKEDITOR.tools.callFunction(funcNum, file);
                window.close();
            }
        }).elfinder('instance');
    } else {
        $elfinder.elfinder({
            url: $elfinder.data('url'),
            customData: customData
        }).elfinder('instance');
    }
});