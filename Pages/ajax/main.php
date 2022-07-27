<?php

//引入class
include_once(__DIR__ . '../../../__Class/ClassLoad.php');

// //ajax安全性驗證:驗證token
if (!isset($_POST['token']) || Form_token_Core::URIAuthcode($_POST['token'], 'DECODE', date("Ymd")) != $_SESSION['Server_token']) {
    exit();
}

//當前登入的user
if (isset($_SESSION['COM_UserID']))
    $UserID = $_SESSION['COM_UserID'];

//若存在父帳號則置換成父帳號
if (isset($_SESSION['COM_MasterID']))
    $UserID = $_SESSION['COM_MasterID'];

$type = $_POST['type'];
$now = $_POST['now'];
$last = $_POST['last'];

if($type == 'banner'){

    if (isset($_SESSION['COM_Username']) && SYSAction::SQL_Data('com_temple', 'temple_account', $_SESSION['COM_Username'], 'temple_index_banner') != "")
        echo '<img src="' . SYSAction::SQL_Data('com_temple', 'temple_account', $_SESSION['COM_Username'], 'temple_index_banner') . '" width="100%" alt="banner"/>';
    else
        echo '<img src="assets/images/index_banner.png" width="100%" alt="banner"/>';
}elseif($type == 'show_report'){

    if(isset($_SESSION['COM_Username'])){
        echo 'yes';
    }else{
        echo 'no';
    }
}elseif($type == 'revenue'){

    echo Revenue($now, $last);
}else{

    if(substr($type, 0, 11) == 'machine_sr_'){
        MYPDO::$field = [
            'sum(history_light_type_money) as sum_history_light_type_money',
            'history_believer_device_sn',
        ];
    }elseif(substr($type, 0, 11) == 'product_sr_'){
        MYPDO::$field = [
            'history_light_type_name',
            'COUNT(history_light_type_name) as count_history_light_type_name',
        ];  
    }
    MYPDO::$table = 'com_history_light';
    MYPDO::$join = [
        'com_history_believer_sub' => ['com_history_light.history_light_believer_sub_id', 'com_history_believer_sub.history_believer_sub_id'],
        'com_history_believer' => ['com_history_believer_sub.history_believer_sub_believer_id', 'com_history_believer.history_believer_id']
    ];
    if($type == 'sum_tday' or $type == 'machine_sr_day' or $type == 'product_sr_day'){
        $where_query = "history_believer_temple_id = $UserID AND date(history_believer_date_time_create) = CURDATE()";
    }elseif($type == 'sum_yday'){
        $where_query = "history_believer_temple_id = $UserID AND date(history_believer_date_time_create) = DATE_SUB(CURDATE(),INTERVAL 1 DAY)";
    }elseif($type == 'sum_tmonth' or $type == 'machine_sr_month' or $type == 'product_sr_month'){
        $where_query = "history_believer_temple_id = $UserID AND MONTH(history_believer_date_time_create) = MONTH(CURDATE())";
    }elseif($type == 'sum_lmonth'){
        $where_query = "history_believer_temple_id = $UserID AND MONTH(history_believer_date_time_create) = MONTH(CURDATE())-1";
    }elseif($type == 'sum_tyear' or $type == 'machine_sr_year' or $type == 'product_sr_year'){
        $where_query = "history_believer_temple_id = $UserID AND YEAR(history_believer_date_time_create) = YEAR(CURDATE())";
    }elseif($type == 'sum_lyear'){
        $where_query = "history_believer_temple_id = $UserID AND YEAR(history_believer_date_time_create) = YEAR(CURDATE())-1";
    }
    MYPDO::$where = $where_query;

    if(substr($type, 0, 11) == 'machine_sr_'){
        MYPDO::$group = ['history_believer_device_sn'];
        MYPDO::$order = ['sum_history_light_type_money' => 'DESC'];
    }elseif(substr($type, 0, 11) == 'product_sr_'){
        MYPDO::$group = ['history_light_type_name'];
        MYPDO::$order = ['count_history_light_type_name' => 'DESC'];
    }
    $results = MYPDO::select();

    if(substr($type, 0, 4) == 'sum_'){
        $res = 0;
        foreach ($results as $row) {
            $res += $row['history_light_type_money'];
        }
        echo $res;
    }elseif(substr($type, 0, 11) == 'machine_sr_'){
        $first = null; //prev 用來存第一個陣列的log_sell值
        foreach ($results as $row) {
            echo $row['history_believer_device_sn'] . ' NT$ ' . $row['sum_history_light_type_money'] . '<br><br>';
            if ($first) {
                echo '<div class="progress progress-mini">
                <div class="progress-bar progress-bar-pink" style="width:' . intval($row['sum_history_light_type_money']) / intval($first) * 100 . '%;"></div></div>';
            } else {
                $first = $row['sum_history_light_type_money'];
                echo '<div class="progress progress-mini">
                <div class="progress-bar progress-bar-pink" style="width:100%;"></div></div>';
            }
        }
    }elseif(substr($type, 0, 11) == 'product_sr_'){
        $first = null;
        foreach ($results as $row) {
            echo $row['history_light_type_name'] . '：' . $row['count_history_light_type_name'] . '<br><br>';
            if ($first) {
                echo '<div class="progress progress-mini">
                <div class="progress-bar progress-bar-pink" style="width:' . intval($row['count_history_light_type_name']) / intval($first) * 100 . '%;"></div></div>';
            } else {
                $first = $row['count_history_light_type_name'];
                echo '<div class="progress progress-mini">
                <div class="progress-bar progress-bar-pink" style="width: 100%;"></div></div>';
            }
        }
    }

}

//計算銷售額成長率
function Revenue($now, $last)
{
    $revenue = "";
    if ($last > 0) {
        $count_num = round(($now - $last) / $last * 100);
        if ($count_num > 0)
            $revenue = '<div class="badge badge-success" style="float:right">' . round(($now - $last) / $last * 100) . '％<i class="ace-icon fa fa-arrow-up"></i></div>';
        elseif ($count_num < 0)
            $revenue = '<div class="badge badge-warning" style="float:right">' . abs(round(($now - $last) / $last * 100)) . '％<i class="ace-icon fa fa-arrow-down"></i></div>';
    }
    return $revenue;
}

?>