
$('.return_building_btn').click(function () {
    var url = "../index.php?PageName=business_blind_box_set_building";
    location.href = url;
});

// $('.action_list').empty();
$.ajax({
    type: "POST",
    url: "./Pages/ajax/business_blind_box_set_list.php",
    dataType: "JSON",
    data: {},
    success: function (data) {
        for (var i = 0; i < data.length; i++) {
            $('.action_list').append("<div class='list_item'>" + data[i].set_name + ' - ' + data[i].set_sub_name + '</div>');
        }
    }, error: function () {
        alertLayer("獲取資料失敗", "error");
    }
});