$('.submit_btn').click(function () {
    $('.form_business_blind_box_set_building').submit();
});

$('.show_list_btn').click(function () {
    var url = "../index.php?PageName=business_blind_box_set_list";
    location.href = url;

});

function action_list() {
    $('.action_list').empty();
    $.ajax({
        type: "POST",
        url: "./Pages/ajax/business_blind_box_set_building.php",
        dataType: "JSON",
        data: {},
        success: function (data) {
            for (var i = 0; i < data.length; i++) {
                $('.action_list').append('<div>' + data[i].set_name + ' - ' + data[i].set_sub_name + '</div>');
            }

        }, error: function () {
            alertLayer("獲取資料失敗", "error");
        }
    });
}

