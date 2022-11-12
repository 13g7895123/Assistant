// 取得該周日期 & 渲染
var week_day = get_data('week_day');
$('.mon').html(week_day.mon);
$('.tues').html(week_day.tues);
$('.wed').html(week_day.wed);
$('.thur').html(week_day.thur);
$('.fri').html(week_day.fri);

// 日期判斷
var today = new Date();
var month = today.getMonth() + 1;
var day = today.getDate();
today = month + '/' + day;

// #58FEDB

// 找出今天的 BLOCK 並改變背景顏色
var week_abbreviation = new Array('mon', 'tues', 'wed', 'thur', 'fri');
for (i = 0; i < week_abbreviation.length; i++) {
    if (today == $('.' + week_abbreviation[i]).html()) {
        $('.' + week_abbreviation[i]).css('background-color', '#F3EC78');
    }
}

var inv_trust_buy = get_data('legal_person', 'it');     // 投信
var for_int_buy = get_data('legal_person', 'fi');       // 外資
var inv_trust_for_int_buy = get_data('legal_person', 'it+fi');  // 投信 + 外資

for (i = 0; i < inv_trust_buy.length; i++) {
    $('.it_content').append(
        "<div class='col_data'>" +
        "<div  class='data id'>" + inv_trust_buy[i].sid + "</div>" +
        "<div  class='data name'>" + inv_trust_buy[i].name + "</div>" +
        "<div  class='data ratio'>" + inv_trust_buy[i].it_c + "</div>" +
        "</div>"
    );
    $('.fi_content').append(
        "<div class='col_data'>" +
        "<div  class='data id'>" + for_int_buy[i].sid + "</div>" +
        "<div  class='data name'>" + for_int_buy[i].name + "</div>" +
        "<div  class='data ratio'>" + for_int_buy[i].fi_c + "</div>" +
        "</div>"
    );
    $('.it_fi_content').append(
        "<div class='col_data'>" +
        "<div  class='data id'>" + inv_trust_for_int_buy[i].sid + "</div>" +
        "<div  class='data name'>" + inv_trust_for_int_buy[i].name + "</div>" +
        "<div  class='data ratio'>" + inv_trust_for_int_buy[i].it_fi_c + "</div>" +
        "</div>"
    );
}


function get_data(action, param, status = 'buy') {

    var res;
    $.ajax({
        type: "POST",
        url: ajax_url + '?action=' + action,
        data: {
            param: param,
            status: status
        },
        // datatype: JSON,
        async: false,
        success: function (data) {
            res = JSON.parse(data);
        }, error: function () {
            alertLayer("獲取資料失敗", "error");
        }

    });

    return res;
}

