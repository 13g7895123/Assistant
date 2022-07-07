
//定義jqGrid的預設值及Function Event
$(function () {
    $.extend($.jgrid.defaults, {
        //==========屬性處理================
        multiselect: false,//不多選
        rowNum: 10,
        rowList: [10, 20, 30],
        toppager: false,
        viewrecords: true,
        rownumbers: true,
        autowidth: true,
        altRows: true,
        altclass: 'jqgrow2',
        height: "100%",//高度隨筆數而定
        rownumWidth: 30,//RowNum寬度 default:25 http://goo.gl/y8BqR
        //==========Event處理===============
        //錯誤處理
        //loadError: Microsoft.UI.Grid.loadError,
        //serializeGridData: Microsoft.UI.Grid.serializeGridData,
        //loadComplete: Microsoft.UI.Grid.loadComplete,
        //gridComplete: gridComplete
    });
})

