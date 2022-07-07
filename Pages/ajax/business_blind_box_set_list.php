<?php

//引入
include_once(__DIR__ . '/../../__Class/ClassLoad.php'); 

MYPDO::$field = [
    'set_name',
    'set_sub_name'
];
MYPDO::$table = 'classification_sub_blind_box';
MYPDO::$join = [
    'classification_blind_box' => ['classification_sub_blind_box.set_id', 'classification_blind_box.id']
];
$results = MYPDO::select();


echo json_encode($results);

?>