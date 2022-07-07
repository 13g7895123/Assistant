// 判定顯示報表
var show_report;
show_report = get_data('show_report');
if(show_report == 'no'){
    $('.report').addClass('no_show');
}else{
    $('.report').removeClass('no_show');
}

// 顯示 banner
var banner;
banner = get_data('banner');
$(".banner").append(banner);

//顯示捐獻額
var today = new Date();
$(".donate_today").html('本日捐獻額 (' + today.getFullYear() + '-'
                                    + (today.getMonth() + 1) + '-'
                                    + today.getDate() + ')');
$(".donate_this_month").html('本月捐獻額 (' + today.getFullYear() + '-'
                                    + (today.getMonth() + 1) + ')');
$(".donate_this_month").html('本年度捐獻額 (' + today.getFullYear() + ')');

// 銷售總額
var sum_tday, sum_yday, day_revenue;
var sum_tmonth, sum_lmonth, month_revenue;
var sum_tyear, sum_lyear, year_revenue;

sum_tday = get_data('sum_tday');
sum_yday = get_data('sum_yday');
day_revenue = revenue(sum_tday, sum_yday);
sum_tmonth = get_data('sum_tmonth');
sum_lmonth = get_data('sum_lmonth');
month_revenue = revenue(sum_tmonth, sum_lmonth);
sum_tyear = get_data('sum_tyear');
sum_lyear = get_data('sum_lyear');
year_revenue = revenue(sum_tyear, sum_lyear);


$(".sum_tday").html('NT$' + sum_tday);
$(".sum_yday").html('<center>昨日: NT$' + sum_yday + day_revenue + '</center>');
$(".sum_tmonth").html('NT$' + sum_tmonth);
$(".sum_lmonth").html('<center>上個月: NT$' + sum_lmonth + month_revenue + '</center>');
$(".sum_tyear").html('NT$' + sum_tyear);
$(".sum_lyear").html('<center>去年: NT$' + sum_lyear + year_revenue + '</center>');

// 機台銷售排行 machine_sales_rank
var machine_sr_day, machine_sr_month, machine_sr_year;
machine_sr_day = get_data('machine_sr_day');
machine_sr_month = get_data('machine_sr_month');
machine_sr_year = get_data('machine_sr_year');

$(".machine_sr_day").html(machine_sr_day);
$(".machine_sr_month").html(machine_sr_month);
$(".machine_sr_year").html(machine_sr_year);


// 商品銷售排行 product_sales_rank
var product_sr_day, product_sr_month, product_sr_year;
product_sr_day = get_data('product_sr_day');
product_sr_month = get_data('product_sr_month');
product_sr_year = get_data('product_sr_year');

$(".product_sr_day").html(product_sr_day);
$(".product_sr_month").html(product_sr_month);
$(".product_sr_year").html(product_sr_year);

function get_data(type){
    var res;
    $.ajax({
        type : "POST",
        url : "./Pages/ajax/main.php",
        dataType : "HTML",
        async: false,
        data : {
            type: type,
            token: token
        },
        success : function(data){
            res = data;
        },error:function(){
            alertLayer("獲取資料失敗","error");
        }
    });
    return res;
}
function revenue(now, last){
    var res;
    $.ajax({
        type : "POST",
        url : "./Pages/ajax/main.php",
        dataType : "HTML",
        async: false,
        data : {
            type: 'revenue',
            token: token,
            now: now,
            last: last
        },
        success : function(data){
            res = data;
        },error:function(){
            alertLayer("獲取資料失敗","error");
        }
    });
    return res;
}