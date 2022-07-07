<?php

//引入
include_once(__DIR__ . '/../../__Class/ClassLoad.php'); 

MYPDO::$table = 'classification_blind_box';
MYPDO::$data = [
    'set_name' => trim($_POST['set_name'])
];
MYPDO::insert();

$set_id = SYSAction::SQL_Data('classification_blind_box', 'set_name', trim($_POST['set_name']), 'id');
MYPDO::$table = 'classification_sub_blind_box';
MYPDO::$data = [
    'set_id' => $set_id,
    'set_sub_name' => trim($_POST['set_sub_name'])
];
MYPDO::insert();

$url = "../../index.php?PageName=business_blind_box_set_building";
echo "<script>location.href='$url';</script>"; 

?>