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
    }
}

?>