$('#sel_name').focus();

// 載入USER資料
user_data = get_data('user');
$('#sel_name').empty();
for (i = 0; i < user_data.length; i++) {
    $('#sel_name').append('<option>' + user_data[i].name + '</option>');
}

// 載入最後一次IP
var last_ip = get_data('last_ip');
for (i = 0; i < 4; i++) {
    $('#ip0' + (i + 1)).attr('value', last_ip[i]);
}

var user, user_name, ip, ip_tail, category, full_acc;
var data_list = [];

// 送出按鈕
$('#submit').click(function () {

    // 取得資料
    user_name = $('#sel_name').find(':selected').text();     // USERNAME前半
    ip = $('#ip01').val() + '-' + $('#ip02').val() +          // IP前半
        '-' + $('#ip03').val() + '-' + $('#ip04').val();
    category = $('#sel_category').find(':selected').text();  // 類別
    if (category == 'remote') {
        user = user_name + '_remote';                           // 完整USERNAME
        ip = ip + '.dynamic-ip.hinet.net';                      // 完整IP        
    } else if (category == 'local') {
        user = user_name + '_user';
        ip = 'localhost';
    }
    full_acc = "'" + user + "'@'" + ip + "'";

    // 顯示資料
    $('#show').html(
        'CREATE USER ' + full_acc + " IDENTIFIED BY '820820';" + '</br>' +
        'GRANT ALL PRIVILEGES ON db_' + user_name + ".* TO " + full_acc + ';' + '</br>' +
        'FLUSH PRIVILEGES;' + '</br>'
    );

    data_list = [];      // 寫入前先清空
    data_list.push({
        name: user_name,
        ip: ip,
        type: category
    });

    // 寫入資料庫
    update_data(data_list);

    // 顯示元件
    $('.btn_copy').css('display', 'block');
    $('#hr2').css('display', 'block');
});

$('.btn_copy').css('display', 'none');
$('#hr2').css('display', 'none');
$('#input_show').css('display', 'none');

$('#btn_copy').click(function () {
    copy_text();
});

$('#btn_add_uname').click(function () {
    var uname = $('#input_add_uname').val();
    if (uname != '') {
        add_user(uname);
    } else {
        alert('使用者名稱不可為空!');
    }
})

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
            } else {
                alert(data.msg);
            }
        }, error: function () {
            alertLayer("獲取資料失敗", "error");
        }
    });

    return res;
}

function update_data(data) {
    $.ajax({
        type: "POST",
        url: ajax_url + '?action=submit',
        data: {
            data: JSON.stringify(data)
        },
        dataType: 'JSON',
        success: function (data) {
            if (data.success == false) {
                alert(data.msg);
            } else {
                $('#show_data').removeClass('hidden');
            }
        }, error: function () {
            alert('更新資料有誤!');
        }
    });
}

function copy_text() {
    $('#input_show').css('display', 'block');          // 顯示INPUT
    $('#input_show').val($('#show').text());           // 把要複製的資料放到INPUT
    var ele = document.getElementById("input_show");
    ele.select();
    document.execCommand('copy');
    $('#input_show').css('display', 'none');
    alert('已複製到剪貼簿!');
}

const add_user = (user) => {
    $.ajax({
        type: "POST",
        url: ajax_url + '?action=add_user',
        data: {
            user: user
        },
        dataType: 'JSON',
        success: function (data) {
            if (data.success) {
                $('#input_add_uname').val('');
                location.reload();
                alert('新增成功');
            }
            else {
                alert(data.msg);
            }
        }, error: function () {
            alert('更新資料有誤!');
        }
    });
}