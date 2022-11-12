// 輸入車牌號碼
var car_num, car_inf;

$('#btn_car_num').click(function () {

    // 查詢車牌入場時間
    car_num = $('#inp_car_num').val();
    car_inf = get_data('car_inf', car_num);

    if (typeof (car_inf) != 'undefined') {
        // 隱藏原有欄位
        $('#lab_car_num').addClass('hidden');
        $('#inp_car_num').addClass('hidden');
        $('#btn_car_num').addClass('hidden');

        // 顯示查詢資料
        $('#show_num').removeClass('hidden')
            .css('display', 'block')
            .html('您的車牌為: ' + car_num);
        $('#show_in_time').removeClass('hidden')
            .css('display', 'block')
            .html('入場時間為: ' + car_inf['date'] + ' ' + car_inf['time'].substr(0, 5));

        // 顯示折扣碼欄位
        $('#div_input_code').removeClass('hidden')
            .css('display', 'block')
        $('#input_code').removeClass('hidden')
            .css('display', 'block')
        $('#btn_code').removeClass('hidden')
            .css('display', 'block')
    }

});

$('#btn_code').click(function () {

    // 取得使用折扣碼後結果
    var discount_code = $('#input_code').val();

    data_list = [];      // 寫入前先清空
    data_list.push({
        car_num: car_num,
        car_in_date: car_inf['date'],
        car_in_time: car_inf['time'],
        discount_code: discount_code
    });

    var discount_res = get_data_json('discount_res', data_list);
    if (typeof (discount_res) != 'undefined') {
        if (discount_res.status == 1) {
            buffer_time = discount_res.buffer_time.split(' ')[1].substr(0, 5);
            alert('已折抵完畢，請於時限內離場\n(貼心提醒，最後離場時間為' + buffer_time + ')');
            window.location.reload();
        } else {
            alert('已折抵完畢，尚餘' + discount_res.time_left + '需繳納，請至繳費區繳費');
        }
    }
});

function get_data(action, param) {

    var res;
    $.ajax({
        type: "POST",
        url: ajax_url + '?action=' + action,
        data: { param: param },
        dataType: "JSON",
        async: false,
        success: function (data) {
            if (data.success) {
                res = data.value;
            } else {
                alert(data.msg);
                return;
            }
        }, error: function () {
            alert("獲取資料失敗", "error");
        }
    });

    return res;
}

function get_data_json(action, param) {

    var res;
    $.ajax({
        type: "POST",
        url: ajax_url + '?action=' + action,
        data: { param: JSON.stringify(param) },
        dataType: "JSON",
        async: false,
        success: function (data) {
            if (data.success) {
                res = data.value;
            } else {
                alert(data.msg);
                return;
            }
        }, error: function () {
            alert("獲取資料失敗", "error");
        }
    });

    return res;
}
