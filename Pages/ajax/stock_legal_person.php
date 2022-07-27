<?php

include_once(__DIR__ . '/../../__Class/ClassLoad.php'); 

if(isset($_GET['action'])){
    switch ($_GET['action']) {
        case 'week_day':
            
            $today = date('Y/m/d');

            $weekday = date("w", strtotime($today));                                //轉換成星期幾(0~6)
            $week_fday = date("Y-m-d", strtotime("$today -" . $weekday . " days")); //求出該周首日日期
            $week_monday = date("n/d", strtotime("$week_fday +1 days"));            //求出該周星期一
            $week_tuesday = date("n/d", strtotime("$week_fday +2 days"));           //求出該周星期二
            $week_wednesday = date("n/d", strtotime("$week_fday +3 days"));         //求出該周星期三
            $week_thursday = date("n/d", strtotime("$week_fday +4 days"));          //求出該周星期四
            $week_friday = date("n/d", strtotime("$week_fday +5 days"));            //求出該周星期五


            $week_arr = [];
            for($i = 0; $i < 5; $i++){
                $week_day = date("n/d", strtotime("$week_fday +" . ($i + 1) . " days"));  
                array_push($week_arr, $week_day);
            }

            $week_abbreviation = ['mon', 'tues', 'wed', 'thur', 'fri'];
            $res = array_combine($week_abbreviation, $week_arr);

            echo json_encode($res);
            break;

        case 'legal_person':

            MYPDO::$user = 'stock_user';
            MYPDO::$pwd = '820820';
            MYPDO::$db = 'db_stock';

            MYPDO::$table = 'legal_buy_sell_ratio';
            MYPDO::$where = ['date' => '2022-07-20'];
            MYPDO::$join = [
                'stock_list' => ['legal_buy_sell_ratio.sid', 'stock_list.sid']
            ];

            $type = $_POST['param'];    // 購買人別
            $status= $_POST['status'];  // 買賣別

            if($type == 'it'){
                MYPDO::$order = ['it_c' => 'DESC'];
            }elseif ($type == 'fi') {
                MYPDO::$order = ['fi_c' => 'DESC'];
            }elseif ($type == 'it+fi'){
                MYPDO::$order = ['it_fi_c' => 'DESC'];
            }
            elseif ($type == 'it' && $status == 'SELL'){
                MYPDO::$order = ['it_c'];
            }
            elseif ($type == 'fi' && $status == 'SELL'){
                MYPDO::$order = ['fi_c'];
            }
            elseif ($type == 'it_fi' && $status == 'SELL'){
                MYPDO::$order = ['it_fi_c'];
            }
            MYPDO::$limit = [30];
            $res = MYPDO::select();

            echo json_encode($res);
            break;
    }
}



?>