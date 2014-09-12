/**
 * @link http://www.yincart.com/
 * @copyright Copyright (c) 2014 Yincart
 * @license http://www.yincart.com/license/
 */

/**
 * @author jeremy.zhou(gao_lujie@live.cn)
 */

$(function () {
    var $catTree = $('#category-tree');
    var zTree;

    var catTreeOnClick = function (event, treeId, treeNode) {
        $(window).triggerHandler('catTree.onClick', [event, treeId, treeNode]);
    };

    var catTreeOnCheck = function (event, treeId, treeNode) {
        $(window).triggerHandler('catTree.onCheck', [event, treeId, treeNode]);
    };

    var catTreeOnDrop = function (event, treeId, treeNodes, targetNode, moveType, isCopy) {
        $(window).triggerHandler('catTree.onDrop', [event, treeId, treeNodes, targetNode, moveType, isCopy]);
    };

    var setting = {
        view: {
            showLine: false
        },
        data: {
            simpleData: {
                enable: true,
                idKey: "category_id",
                pIdKey: "parent_id",
                rootPId: 0
            }
        },
        callback: {
            onClick: catTreeOnClick,
            onCheck: catTreeOnCheck,
            onDrop: catTreeOnDrop
        }
    };

    if ($catTree.data('type') == 'edit') {
        setting.edit = {
            enable: true,
            showRemoveBtn: false,
            showRenameBtn: false,
            drag: {
                isMove: true,
                prev: true,
                next: true,
                inner: true
            }
        };
    } else if ($catTree.data('type') == 'radio') {
        setting.check = {
            enable: true,
            chkStyle: "radio",
            radioType: "all"
        };
    }

    $(window).on('catTree.reload', function () {
        $.get($('#category-tree').data('url'), {}, function (response) {
            zTree = $.fn.zTree.init($('#category-tree'), setting, response);
        }, 'json');
    });
    $(window).triggerHandler('catTree.reload');

    $(window).on('catTree.onDrop', function (event, treeEvent, treeId, treeNodes, targetNode, moveType, isCopy) {
        console.log(treeNodes, targetNode, moveType);
        console.log(treeNodes[0].getPreNode());
        var nodes = [];
        for (var i in treeNodes) {
            var preNode = treeNodes[i].getPreNode();
            var preNodeId = preNode ? preNode.category_id : 0;
            var node = {category_id: treeNodes[i].category_id, parent_id: treeNodes[i].parent_id, pre_id: preNodeId};
            nodes.push(node);
        }

        $.post($catTree.data('save-url'), {treeNodes: nodes}, function (data) {
            if (data['success']) {
                jQuery.gritter.add({
                    title: data['message'],
                    text: data['message'],
                    sticky: false,
                    time: 2000,
                    class_name: 'gritter-success gritter-light gritter-right'
                });
            } else {
                jQuery.gritter.add({
                    title: data['message'],
                    text: data['message'],
                    sticky: false,
                    time: 2000,
                    class_name: 'gritter-error gritter-light gritter-right'
                });
                //reload tree view
                $(window).triggerHandler('catTree.reload');
            }
        }, 'json');
    });
});

