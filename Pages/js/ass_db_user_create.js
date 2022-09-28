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
    $('#select_name').append('<option>' + user_data[i].name + '</option>');
}

var user_name, ip, ip_tail, category;
var data_list = [];
$('.btn_submit').click(function () {
    user_name = $('#select_name').find(':selected').text();     // USERNAME前半
    ip = $('.ip_01').val() + '-' + $('.ip_02').val() +          // IP前半
        '-' + $('.ip_03').val() + '-' + $('.ip_04').val();
    category = $('#select_category').find(':selected').text();  // 類別
    if (category == 'remote') {
        user = user_name + '_remote';                           // 完整USERNAME
        ip = ip + '.dynamic-ip.hinet.net';                      // 完整IP        
    } else if (category == 'local') {
        user = user_name + '_user';
        ip = 'localhost';
    }
    full_acc = "'" + user + "'@'" + ip + "'";
    $('.show01').html('CREATE USER ' + full_acc + " IDENTIFIED BY '820820';");
    $('.show02').html('GRANT ALL PRIVILEGES ON db_' + user_name + ".* TO " + full_acc + ';');
    $('.show03').html('FLUSH PRIVILEGES;');

    data_list = [];      // 寫入前先清空
    data_list.push({
        name: user_name,
        ip: ip,
        type: category
    });

    // 寫入資料庫
    $.ajax({
        type: "POST",
        url: ajax_url + '?action=submit',
        data: {
            data: JSON.stringify(data_list)
        },
        dataType: 'JSON',
        success: function (data) {
            if (data.success) {
                alert('更新成功!');
            }
        }, error: function () {
            alert('更新資料有誤!');
        }
    });
});

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