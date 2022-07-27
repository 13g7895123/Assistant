<?php

//引入
include_once(__DIR__ . '/../../__Class/ClassLoad.php'); 

$type = $_POST['type'];
$value = $_POST['col'];


if(isset($_GET['action'])){
    switch ($_GET['action']) {
        case 'classification_blind_box':

            MYPDO::$table = 'classification_blind_box';
            $results = MYPDO::select();
            echo json_encode($results);
            break;

        case 'classification_sub':
            
            $set_id = SYSAction::SQL_Data('classification_blind_box', 'set_name', $value, 'id');
            MYPDO::$table = 'classification_sub_blind_box';
            MYPDO::$where = ['set_id' => $set_id];
            $results = MYPDO::select();
            echo json_encode($results);
            break;

        case 'item_name':
        
            $set_sub_id = SYSAction::SQL_Data('classification_sub_blind_box', 'set_sub_name', $value, 'id');
            MYPDO::$table = 'classification_item_blind_box';
            MYPDO::$where = ['set_sub_id' => $set_sub_id];
            $results = MYPDO::select();
            echo json_encode($results);
            break;

        case 'classification':
    
            MYPDO::$table = 'classification';
            $results = MYPDO::select();
            echo json_encode($results);
            break;

        case 'source':

            MYPDO::$table = 'source';
            $results = MYPDO::select();
            echo json_encode($results);
            break;
    }
}






?>