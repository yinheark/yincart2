/**
 * @link http://www.yincart.com/
 * @copyright Copyright (c) 2014 Yincart
 * @license http://www.yincart.com/license/
 */

/**
 * @author jeremy.zhou(gao_lujie@live.cn)
 */

$(function () {

    var jqGridTable = '#grid-table';
    var jqGridPager = '#grid-pager';
    var $jqGridTable = $(jqGridTable);
    var $jqGridTablePager = $(jqGridPager);

    //resize to fit page size
    $(window).on('resize.jqGrid', function () {
        $jqGridTable.jqGrid('setGridWidth', $jqGridTable.parents('.widget-container-col').width());
    });
    //resize on sidebar collapse/expand
    var parentColumn = $jqGridTable.closest('[class*="col-"]');
    $(document).on('settings.ace.jqGrid', function (event, event_name, collapsed) {
        if (event_name === 'sidebar_collapsed' || event_name === 'main_container_fixed') {
            $jqGridTable.jqGrid('setGridWidth', parentColumn.width());
        }
    });

    var initJqGrid = function () {

        $jqGridTable.jqGrid({
            subGrid: true,
            subGridOptions: {
                plusicon: "ace-icon fa fa-plus center bigger-110 blue",
                minusicon: "ace-icon fa fa-minus center bigger-110 blue",
                openicon: "ace-icon fa fa-chevron-right center orange"
            },
            subGridRowExpanded: function (subgridDivId, rowId, a) {
                var subgridTableId = subgridDivId + "_t";
                var subgridPagerId = subgridDivId + "_p";
                $("#" + subgridDivId).html("<table id='" + subgridTableId + "'></table><div id='" + subgridPagerId + "'></div>");
                $("#" + subgridTableId).jqGrid({
                    ajaxGridOptions: {type: "GET"},
                    serializeGridData: function (postData) {
                        postData.itemPropId = $jqGridTable.find('#' + rowId).find('[aria-describedby="grid-table_item_prop_id"]').text();
                        return postData;
                    },
                    editurl: $jqGridTable.data('sub-grid-edit-url'),
                    url: $jqGridTable.data('sub-grid-url'),
                    datatype: "json",
                    jsonReader: {
                        root: "list",
                        page: "page",
                        total: "totalPage",
                        records: "totalCount",
                        repeatitems: false,
                        id: 'prop_value_id'
                    },
                    colNames: ['', 'ID', 'Name', 'Sort'],
                    colModel: [
                        {name: 'action', index: '', width: 80, fixed: true, sortable: false, resize: false,
                            formatter: 'actions',
                            formatoptions: {
                                delOptions: {recreateForm: true, afterSubmit: afterSubmit},
                                editformbutton: false,
                                editOptions: {recreateForm: true, afterSubmit: afterSubmit}
                            }
                        },
                        { name: 'prop_value_id', width: 50, editable: false, key: true},
                        { name: 'name', width: 150, editable: true, editoptions: {size: "20", maxlength: "45"}},
                        { name: 'sort', width: 50, editable: true}
                    ],
                    pager: '#' + subgridPagerId
                }).jqGrid('navGrid', '#' + subgridPagerId,
                    { 	//navbar options
                        edit: true,
                        editicon: 'ace-icon fa fa-pencil blue',
                        add: true,
                        addicon: 'ace-icon fa fa-plus-circle purple',
                        del: true,
                        delicon: 'ace-icon fa fa-trash-o red',
                        search: true,
                        searchicon: 'ace-icon fa fa-search orange',
                        refresh: true,
                        refreshicon: 'ace-icon fa fa-refresh green',
                        view: true,
                        viewicon: 'ace-icon fa fa-search-plus grey'
                    },
                    {
                        //edit record form
                        //width: 700,
                        closeAfterEdit: true,
                        recreateForm: true,
                        beforeShowForm: beforeShowEditForm,
                        afterSubmit: afterSubmit
                    },
                    {
                        //new record form
                        //width: 700,
                        closeAfterAdd: true,
                        recreateForm: true,
                        viewPagerButtons: false,
                        beforeShowForm: beforeShowEditForm,
                        beforeSubmit: function (postData, formId) {
                            postData.item_prop_id = $jqGridTable.find('#' + rowId).find('[aria-describedby="grid-table_item_prop_id"]').text();
                            return[true, ''];
                        },
                        afterSubmit: afterSubmit
                    },
                    {
                        //delete record form
                        recreateForm: true,
                        beforeShowForm: beforeShowDeleteForm,
                        afterSubmit: afterSubmit
                    },
                    {
                        //search form
                        recreateForm: true,
                        afterShowSearch: function (e) {
                            var form = $(e[0]);
                            form.closest('.ui-jqdialog').find('.ui-jqdialog-title').wrap('<div class="widget-header" />')
                            styleSearchFilters(form);
                        },
                        afterRedraw: function () {
                            styleSearchFilters($(this));
                        },
                        multipleSearch: true
                        /**
                         multipleGroup:true,
                         showQuery: true
                         */
                    },
                    {
                        //view record form
                        recreateForm: true,
                        beforeShowForm: beforeShowViewForm
                    }
                );
            },

            ajaxGridOptions: {type: "GET"},
            serializeGridData: function (postData) {
                postData.categoryId = $jqGridTable.data('category-id');
                return postData;
            },
            editurl: $jqGridTable.data('grid-edit-url'),
            url: $jqGridTable.data('grid-url'),
            datatype: "json",
            jsonReader: {
                root: "list",
                page: "page",
                total: "totalPage",
                records: "totalCount",
                repeatitems: false,
                id: 'item_prop_id'
            },
            height: 'auto',
            colNames: [' ', 'ID', 'Category ID', 'Name', 'Type', 'Is Key', 'Is Sale', 'Is Color', 'Is Search', 'Is Must', 'Sort', 'Is Enable'],
            colModel: [
                {name: '', index: '', width: 80, fixed: true, sortable: false, resize: false,
                    formatter: 'actions',
                    formatoptions: {
                        delOptions: {recreateForm: true, afterSubmit: afterSubmit},
                        editformbutton: false,
                        editOptions: {recreateForm: true, afterSubmit: afterSubmit}
                    }
                },
                {name: 'item_prop_id', index: 'item_prop_id', width: 70, editable: false, key: true},
                {name: 'category_id', index: 'category_id', width: 70, hidden: true},
                {name: 'name', index: 'name', width: 150, editable: true, editoptions: {size: "20", maxlength: "45"}, editrules: {required: true}},
                {name: 'type', index: 'type', width: 70, editable: true, edittype: "select", editoptions: {value: "1:Text;2:Select;3:Checkbox"}},
                {name: 'is_key', index: 'is_key', width: 70, editable: true, edittype: "checkbox", editoptions: {value: "Yes:No"}, unformat: aceSwitch},
                {name: 'is_sale', index: 'is_sale', width: 70, editable: true, edittype: "checkbox", editoptions: {value: "Yes:No"}, unformat: aceSwitch},
                {name: 'is_color', index: 'is_color', width: 70, editable: true, edittype: "checkbox", editoptions: {value: "Yes:No"}, unformat: aceSwitch},
                {name: 'is_search', index: 'is_search', width: 70, editable: true, edittype: "checkbox", editoptions: {value: "Yes:No"}, unformat: aceSwitch},
                {name: 'is_must', index: 'is_must', width: 70, editable: true, edittype: "checkbox", editoptions: {value: "Yes:No"}, unformat: aceSwitch},
                {name: 'sort', index: 'sort', width: 70, editable: true, edittype: "text", editrules: {integer: true, minValue: 0, maxValue: 255}},
                {name: 'status', index: 'status', width: 70, editable: true, edittype: "checkbox", editoptions: {value: "Enable:Disable"}, unformat: aceSwitch}
            ],

            viewrecords: true,
            rowNum: 10,
            rowList: [10, 20, 30],
            pager: jqGridPager,
            altRows: true,
            //toppager: true,

            multiselect: true,
            //multikey: "ctrlKey",
            multiboxonly: true,

            loadComplete: function () {
                var table = this;
                setTimeout(function () {
                    styleCheckbox(table);

                    updateActionIcons(table);
                    updatePagerIcons(table);
                    enableTooltips(table);
                }, 0);
            },

            caption: "Item Property"

            //,autowidth: true,
            /**
             grouping:true,
             groupingView : {
						 groupField : ['name'],
						 groupDataSorted : true,
						 plusicon : 'fa fa-chevron-down bigger-110',
						 minusicon : 'fa fa-chevron-up bigger-110'
					},
             caption: "Grouping"
             */
        });

        //navButtons
        $jqGridTable.jqGrid('navGrid', jqGridPager,
            { 	//navbar options
                edit: true,
                editicon: 'ace-icon fa fa-pencil blue',
                add: true,
                addicon: 'ace-icon fa fa-plus-circle purple',
                del: true,
                delicon: 'ace-icon fa fa-trash-o red',
                search: true,
                searchicon: 'ace-icon fa fa-search orange',
                refresh: true,
                refreshicon: 'ace-icon fa fa-refresh green',
                view: true,
                viewicon: 'ace-icon fa fa-search-plus grey'
            },
            {
                //edit record form
                //width: 700,
                closeAfterEdit: true,
                recreateForm: true,
                beforeShowForm: beforeShowEditForm,
                afterSubmit: afterSubmit
            },
            {
                //new record form
                //width: 700,
                closeAfterAdd: true,
                recreateForm: true,
                viewPagerButtons: false,
                beforeShowForm: beforeShowEditForm,
                beforeSubmit: function (postData, formId) {
                    postData.category_id = $jqGridTable.data('category-id');
                    return[true, ''];
                },
                afterSubmit: afterSubmit
            },
            {
                //delete record form
                recreateForm: true,
                beforeShowForm: beforeShowDeleteForm,
                afterSubmit: afterSubmit
            },
            {
                //search form
                recreateForm: true,
                afterShowSearch: function (e) {
                    var form = $(e[0]);
                    form.closest('.ui-jqdialog').find('.ui-jqdialog-title').wrap('<div class="widget-header" />');
                    styleSearchForm(form);
                },
                afterRedraw: function () {
                    styleSearchFilters($(this));
                },
                multipleSearch: true
                /**
                 multipleGroup:true,
                 showQuery: true
                 */
            },
            {
                //view record form
                recreateForm: true,
                beforeShowForm: beforeShowViewForm
            }
        );
        //var selr = $jqGridTable.jqGrid('getGridParam','selrow');
        //enable search/filter toolbar
//        $jqGridTable.jqGrid('filterToolbar', {defaultSearch: true, stringResult: true})
//        $jqGridTable.filterToolbar({});
        $(window).triggerHandler('resize.jqGrid');//trigger window resize to make the grid get the correct size
    };

    $(window).on('itemPropGrid.reload', function() {
        $jqGridTable.triggerHandler('reloadGrid');
    });

    $(window).on('catTree.onClick', function (event, onClickEvent, treeId, treeNode) {
        $jqGridTable.data('category-id', treeNode.category_id);
        if (!$jqGridTable.data('init')) {
            initJqGrid();
            $jqGridTable.data('init', true);
        } else {
            $jqGridTable.triggerHandler('reloadGrid');
        }
    });
});