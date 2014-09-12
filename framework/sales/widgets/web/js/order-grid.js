/**
 * @link http://www.yincart.com/
 * @copyright Copyright (c) 2014 Yincart
 * @license http://www.yincart.com/license/
 */

/**
 * @author jeremy.zhou(gao_lujie@live.cn)
 */

$(function () {

    function onSelectRow(id, checked, event) {
        $(window).triggerHandler('customerGrid.onSelectRow', [id, checked, event]);
    }

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

    $jqGridTable.jqGrid({
        subGrid: false,

        ajaxGridOptions: {type: "GET"},
        serializeGridData: function (postData) {
//                postData.categoryId = $jqGridTable.data('category-id');
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
            repeatcustomers: false,
            id: 'customer_id'
        },
        height: 'auto',
        colNames: [' ', 'ID', 'Customer ID', 'Total Price', 'Created Time', 'Remark', 'Status'],
        colModel: [
            {name: '', index: '', width: 80, fixed: true, sortable: false, resize: false,
                formatter: 'actions',
                formatoptions: {
                    delOptions: {recreateForm: true, afterSubmit: afterSubmit},
                    editformbutton: false,
                    editOptions: {recreateForm: true, afterSubmit: afterSubmit}
                }
            },
            {name: 'order_id', index: 'customer_id', width: 70, editable: false, key: true},
            {name: 'customer_id', index: 'customer_group_id', width: 70, editable: false},
            {name: 'total_price', index: 'total_price', width: 70, editable: true, edittype: "text", editrules: {integer: true, minValue: 0}},
            {name: 'created_time', index: 'created_time', width: 70, editable: true, edittype: "text", editrules: {integer: true, minValue: 0}},
            {name: 'remark', index: 'remark', width: 70, editable: true, edittype: "text", editrules: {integer: true, minValue: 0}},
            {name: 'status', index: 'status', width: 70, editable: true, edittype: "text"}
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

        caption: "Products",

        onSelectRow: onSelectRow

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

    $(window).on('customerGrid.reload', function() {
        $jqGridTable.triggerHandler('reloadGrid');
    });
});