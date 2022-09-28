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

            try{                
                MYPDO::$table = 'ass_db_user_create_log';
                MYPDO::$data = [
                    'name' => $data_arr[0]['name'],
                    'ip' => $data_arr[0]['ip'],
                    'type' => $data_arr[0]['type']
                ];
                MYPDO::insert();
                
                $data['success'] = true;
                // $data['update_count'] = count($data_arr);

            }catch (Exccption $e){

                $data['success'] = false;
                $data['msg'] = $e->getMessage();
            }

            echo json_encode($data);
            break;
    }
}

?>