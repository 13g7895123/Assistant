// import Vue from 'vue';

// 載入DATA
show_data();

$('.input_search_item').change(function () {
    var search_text = $('.input_search_item').val();
    show_data(search_text);

});

function show_data(search_text = '') {
    var vm = new Vue({
        el: '.table_content',
        data: {
            datas: []
        }
    });

    $.ajax({
        type: "POST",
        url: "./Pages/ajax/business_price_tracking_list.php",
        data: {
            search_text: search_text
        },
        success: function (data) {
            vm.datas = JSON.parse(data);
        }, error: function () {
            alertLayer("獲取資料失敗", "error");
        }
    });
}


