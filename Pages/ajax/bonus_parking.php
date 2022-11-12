<?php

include_once(__DIR__ . '/../../__Class/ClassLoad.php');

if(isset($_GET['action'])){
    switch ($_GET['action']) {
        case 'car_inf':

            MYPDO::$user = 'parking_user';
            MYPDO::$pwd = '820820';
            MYPDO::$db = 'db_parking';
            MYPDO::$table = 'parking_inf';
            MYPDO::$where = ['car_number' => $_POST['param']];  // 待確認是否需要新增當天日期選項
            MYPDO::$field = [
                'car_in_date',
                'car_in_time'
            ];
            $results = MYPDO::select();

            if(count($results) == 1){   // 只有一筆資料才是正確的
                foreach ($results as $row) {
                    $dataArr['value']['date'] = $row['car_in_date'];
                    $dataArr['value']['time'] = $row['car_in_time'];
                    $dataArr['success'] = true;
                }                
            }elseif(count($results) > 1){
                $dataArr['success'] = false;
                $dataArr['msg'] = '查詢到兩筆以上資料';
            }else{
                // 更新狀態
                MYPDO::$user = 'parking_user';
                MYPDO::$pwd = '820820';
                MYPDO::$db = 'db_parking';
                MYPDO::$table = 'parking_update';
                MYPDO::$data = ['need_update' => 1];
                MYPDO::$where = ['name' => 'car_in_data'];
                MYPDO::save();

                $dataArr['success'] = false;
                $dataArr['msg'] = '資料不存在，請稍後再試';
            }

            echo json_encode($dataArr);
            break;
        case 'discount_res':

            $data_arr = json_decode($_POST['param'], true);
            
            // 確認折扣碼存在
            MYPDO::$user = 'parking_user';
            MYPDO::$pwd = '820820';
            MYPDO::$db = 'db_parking';
            MYPDO::$table = 'parking_discount_code';
            MYPDO::$where = [
                'discount_code' => $data_arr[0]['discount_code'],
                'discount_number' => [0, '>', 'AND']
            ];
            $result = MYPDO::first();

            if(!empty($result)){    // 折扣碼存在
                $discount_time = $result['discount_time'];
                $car_in_date = $data_arr[0]['car_in_date'];
                $car_in_time = $data_arr[0]['car_in_time'];
                $car_in = $car_in_date . ' ' . $car_in_time;
                $now = date('Y-m-d H:i:s');

                if((strtotime($now) - strtotime($car_in)) <= $discount_time){    // 可全部折抵，回傳緩衝時間

                    // 計算緩衝時間
                    $buffer_time = date('Y-m-d H:i', (strtotime($car_in) + $discount_time));

                    // 把資料傳到資料庫
MYPDO::$user = 'parking_user';
                MYPDO::$pwd = '820820';
                MYPDO::$db = 'db_parking';
                    MYPDO::$table = 'parking_update_to_mdb';
                    MYPDO::$data = [
                        'car_num' => $data_arr[0]['car_num'],
                        'buffer_time' => $buffer_time
                    ];
                    MYPDO::insert();

                    // 更新狀態
                    MYPDO::$user = 'parking_user';
                MYPDO::$pwd = '820820';
                MYPDO::$db = 'db_parking';
                    MYPDO::$table = 'parking_update';
                    MYPDO::$data = ['need_update' => 1];
                    MYPDO::$where = ['name' => 'write_to_mdb'];
                    MYPDO::save();

                    $dataArr['success'] = true;
                    $dataArr['value']['status'] = 1;                             // 全額折抵
                    $dataArr['value']['buffer_time'] = $buffer_time;
                }else{                                                           // 回傳剩餘時數

                    $time_diff_unit_s = strtotime($now) - strtotime($car_in) - $discount_time;

                    $time_diff_hour = floor(($time_diff_unit_s % (3600*24)) / 3600);
                    $time_diff_min = floor((($time_diff_unit_s % (3600*24)) % 3600) / 60);
                    $time_diff_s = $time_diff_unit_s - ($time_diff_hour*3600) - ($time_diff_min*60);

                    if($time_diff_hour != 0){
                        $time_diff = $time_diff_hour . ':' . $time_diff_min . ':' . $time_diff_s;
                    }else{
                        $time_diff = $time_diff_min . ':' . $time_diff_s;
                    }

                    $dataArr['success'] = true;  
                    $dataArr['value']['status'] = 2;                                      // 非全額折抵
                    $dataArr['value']['time_diff'] = strtotime($now) - strtotime($car_in);
                    $dataArr['value']['time_left_ori'] = (strtotime($now) - strtotime($car_in) - $discount_time);
                    $dataArr['value']['time_left'] = $time_diff;
                }

                // 折抵完成後更新資料庫(折扣碼 & 紀錄)
                MYPDO::$user = 'parking_user';
                MYPDO::$pwd = '820820';
                MYPDO::$db = 'db_parking';
                MYPDO::$table = 'parking_discount_code';
                MYPDO::$data = ['discount_number' => ($result['discount_number'] - 1)];
                MYPDO::$where = ['discount_code' => $result['discount_code']];
                MYPDO::save();

                MYPDO::$user = 'parking_user';
                MYPDO::$pwd = '820820';
                MYPDO::$db = 'db_parking';
                MYPDO::$table = 'parking_discount_log';
                MYPDO::$data = [
                    'discount_code' => $result['discount_code'],
                    'car_number' => $data_arr[0]['car_num']
                ];
                $ins_code = MYPDO::insert();

            }else{
                $dataArr['success'] = false;
                $dataArr['msg'] = '折扣碼不存在';
            }

            echo json_encode($dataArr);
            break;
    }
}

?>