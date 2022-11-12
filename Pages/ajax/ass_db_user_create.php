<?php

include_once(__DIR__ . '/../../__Class/ClassLoad.php');

if(isset($_GET['action'])){
    switch ($_GET['action']) {
        case 'user':

            MYPDO::$field = 'name';
            MYPDO::$table = 'ass_db_user_create_user';
            $results = MYPDO::select();

            if(count($results) > 0){
                $data['success'] = true;
                $data['data'] = $results;
            }else{
                $data['success'] = false;
                $data['msg'] = '查無資料';
            }

            echo json_encode($data);
            break;
        
        case 'submit':
            $data_arr = json_decode($_POST['data'], true);

            // 確認資料有無重複
            MYPDO::$table = 'ass_db_user_create_log';
            MYPDO::$where = [
                'name' => $data_arr[0]['name'],
                'ip' => $data_arr[0]['ip'],
                'type' => $data_arr[0]['type']
            ];
            $res = MYPDO::first();

            if(!empty($res['ip'])){
                $data['success'] = false;
                $data['msg'] = '資料已存在，不可重複執行'; 

                echo json_encode($data);
                break;
            }

            try{                
                MYPDO::$table = 'ass_db_user_create_log';
                MYPDO::$data = [
                    'name' => $data_arr[0]['name'],
                    'ip' => $data_arr[0]['ip'],
                    'type' => $data_arr[0]['type']
                ];
                MYPDO::insert();
                
                $data['success'] = true;

            }catch (Exccption $e){

                $data['success'] = false;
                $data['msg'] = $e->getMessage();
            }

            echo json_encode($data);
            break;

        case 'last_ip':

            MYPDO::$table = 'ass_db_user_create_log';
            MYPDO::$order = ['date_time_create' => 'DESC'];
            $res = MYPDO::first();

            $full_ip = explode('.dy', $res['ip'])[0];
            $ip_arr = explode('-', $full_ip);

            $data['success'] = true;
            $data['data'] = $ip_arr;
            
            echo json_encode($data);
            break;

        case 'add_user':

            MYPDO::$table = 'ass_db_user_create_user';
            MYPDO::$where = ['name' => $_POST['user']];
            $res = MYPDO::first();

            if(!empty($res['name'])){
                $data['success'] = false;
                $data['msg'] = '使用者已存在!';
            }else{
                MYPDO::$table = 'ass_db_user_create_user';
                MYPDO::$data = ['name' => $_POST['user']];
                $check_ins = MYPDO::insert();
                if($check_ins > 0){
                    $data['success'] = true;
                }else{
                    $data['success'] = false;
                    $data['msg'] = '資料新增有誤';
                }
            }

            echo json_encode($data);
            break;
    }
}

?>