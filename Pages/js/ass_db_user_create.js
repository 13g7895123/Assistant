// $('#select_name').editableSelect()
//     .on('select.editable-select', function (e, li) {
//         $('#last-selected').html(
//             li.val() + '. ' + li.text()
//         );
//     });

// 載入USER資料
user_data = get_data('user');
$('#select_name').empty();
for (i = 0; i < user_data.length; i++) {
    $('#select_name').append(
        '<option>' + user_data[i].name + '</option>'
    );
}

function get_data(action) {

    var res;
    $.ajax({
        type: "POST",
        url: ajax_url + '?action=' + action,
        dataType: "JSON",
        async: false,
        success: function (data) {
            if (data.success) {
                res = data.data;
                console.log(res);
            } else {
                alert(data.msg);
            }
        }, error: function () {
            alertLayer("獲取資料失敗", "error");
        }
    });

    return res;
}