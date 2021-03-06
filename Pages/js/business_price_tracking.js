// 載入商品類別
var classification_blind_box = loading_item('classification_blind_box');
$('.select_classification_blind_box').empty();
for (var i = 0; i < classification_blind_box.length; i++) {
    $(".select_classification_blind_box").append("<option value='" + classification_blind_box[i].set_name + "'>" + classification_blind_box[i].set_name + "</option>");
}

// 宣告相關變數
var select_classification_blind_box_text, classification_sub_text;
var classification_sub, item_name;

// 載入商品子類別 & 子類別member
loading_classification_sub();
loading_item_name();

// 載入商品子類別
function loading_classification_sub() {
    select_classification_blind_box_text = $('.select_classification_blind_box').find(':selected').text();
    classification_sub = loading_item('classification_sub', select_classification_blind_box_text);
    $('.select_classification_sub').empty();
    for (var i = 0; i < classification_sub.length; i++) {
        $(".select_classification_sub").append("<option value='" + classification_sub[i].set_sub_name + "'>" + classification_sub[i].set_sub_name + "</option>");
    }
}

// 載入商品子類別member
function loading_item_name() {
    classification_sub_text = $('.select_classification_sub').find(':selected').text();
    item_name = loading_item('item_name', classification_sub_text);
    $('.item_name').empty();
    for (var i = 0; i < item_name.length; i++) {
        $(".item_name").append("<option value='" + item_name[i].item_name + "'>" + item_name[i].item_name + "</option>");
    }
}

// 商品類別異動
$('.select_classification_blind_box').change(function () {
    loading_classification_sub();
    loading_item_name();
});

// 商品子類別異動
$('.select_classification_sub').change(function () {
    loading_item_name();
});

// 載入分類
var item_name = loading_item('item_name', classification_sub_text);
var classification = loading_item('classification', '');
$('.select_classification').empty();
for (var i = 0; i < classification.length; i++) {
    $(".select_classification").append("<option value='" + classification[i].classification + "'>" + classification[i].classification + "</option>");
}

// 載入來源
var source = loading_item('source');
$('.select_source').empty()
for (var i = 0; i < source.length; i++) {
    $(".select_source").append("<option value='" + source[i].source_name + "'>" + source[i].source_name + "</option>");
}



// 送出按鈕
$('.submit_btn').click(function () {
    $('.form_price_tracking').submit();
});

// 標題右側列表符號
$('.list_btn').click(function () {
    location.href = '../../index.php?PageName=business_price_tracking_list'
});

// 標題右側加號 -> 打開新增商品對話視窗
$('.plus_btn').click(function () {
    $('.plus_dialog').css('display', 'block');
    $('.mask').css('display', 'block');

    // 檢查預設有沒有值，有的話套用
    if ($('.input_default_setting').val() != '') {
        def_val = $('.input_default_setting').val();
        def_val_clf = def_val.split(',')[0];
        select_clf_sub = def_val.split(',')[1];
        $('.dia_add_item_name').focus();
    }
});

$('.add_btn').click(function () {
    var classification = $('.dia_add_classification').val();
    var classification_sub = $('.dia_add_classification_sub').val();
    var name = $('.dia_add_item_name').val();
    // 判斷是否皆有值
    if (classification != '' && classification_sub != '' && name != '') {
        $('.form_add_product').submit();
    } else {
        alert('數值有誤，請重新確認!');
    }
});

// 對話視窗右上角叉叉
$('.x').click(function () {
    if ($('.plus_dialog').hasClass('show')) {
        $('.plus_dialog').removeClass('show');
    }
    if ($('.mask').hasClass('show')) {
        $('.mask').removeClass('show');
    }

});

$('.mask').click(function () {
    $('.mask').css('display', 'none');
    $('.plus_dialog').css('display', 'none');
    $('.dia_setting').css('display', 'none');
})

// 新增商品視窗設定
$('.setting').click(function () {
    $('.plus_dialog').css('display', 'none');
    $('.dia_setting').css('display', 'block');

    // 載入select_clf
    select_clf = loading_item('classification_blind_box');
    $('.select_clf').empty();
    for (var i = 0; i < select_clf.length; i++) {
        $(".select_clf").append("<option value='" + select_clf[i].set_name + "'>" + classification_blind_box[i].set_name + "</option>");
    }

    $('.select_clf').change(function () {
        select_classification_blind_box_text = $('.select_clf').find(':selected').text();
        classification_sub = loading_item('classification_sub', select_classification_blind_box_text);
        $('.select_clf_sub').empty();
        for (var i = 0; i < classification_sub.length; i++) {
            $(".select_clf_sub").append("<option value='" + classification_sub[i].set_sub_name + "'>" + classification_sub[i].set_sub_name + "</option>");
        }
    });

    $('.btn_def_set').click(function () {
        select_clf = $(".select_clf :selected").text();
        select_clf_sub = $(".select_clf_sub :selected").text();
        $('.input_default_setting').val(select_clf + ',' + select_clf_sub);
        $('.plus_dialog').css('display', 'block');
        $('.dia_add_classification').val(select_clf);
        $('.dia_add_classification_sub').val(select_clf_sub);
        // $('.plus_dialog').css('display', 'block');
        $('.dia_setting').css('display', 'none');
        $('.dia_add_item_name').focus();
    })

    // 按下ENTER視為點擊按鈕(未作用)
    $(".dia_add_item_name").keypress(function (e) {
        code = (e.keyCode ? e.keyCode : e.which);
        if (code === 13) {
            $('.btn_def_set').click();
            return false;
        }
    });

})

function loading_item(item, sec_item = '') {

    var res;
    $.ajax({
        type: "POST",
        url: ajax_url + '?action=' + item,
        dataType: "JSON",
        async: false,
        data: {
            col: sec_item
        },
        success: function (data) {
            res = data;
        }, error: function () {
            alertLayer("獲取資料失敗", "error");
        }
    });

    return res;
}



