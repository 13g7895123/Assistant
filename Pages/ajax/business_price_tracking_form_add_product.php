<?php

//引入
include_once(__DIR__ . '/../../__Class/ClassLoad.php'); 

// 確認類別是否存在
MYPDO::$table = 'classification_blind_box';
MYPDO::$where = [
    'set_name' => $_POST['dia_add_classification']
];
$res = MYPDO::first();

// 查詢結果為空，新增該類別
if(empty($res)){

    MYPDO::$table = 'classification_blind_box';
    MYPDO::$data = [
        'set_name' => $_POST['dia_add_classification']
    ];
    MYPDO::insert();
    $set_name = $_POST['dia_add_classification'];
}

// 確認子類別是否存在
MYPDO::$table = 'classification_sub_blind_box';
MYPDO::$where = [
    'set_sub_name' => $_POST['dia_add_classification_sub']
];
$res = MYPDO::first();

// 查詢結果為空，新增該子類別
if(empty($res)){

    $set_id = SYSAction::SQL_Data('classification_blind_box', 'set_name', $_POST['dia_add_classification'], 'id');

    MYPDO::$table = 'classification_sub_blind_box';
    MYPDO::$data = [
        'set_id' => $set_id,
        'set_sub_name' => $_POST['dia_add_classification_sub']
    ];
    MYPDO::insert();
}

// 確認項目是否存在
MYPDO::$table = 'classification_item_blind_box';
MYPDO::$where = [
    'item_name' => $_POST['dia_add_item_name']
];
$res = MYPDO::first();

// 查詢結果為空，新增該項目
if(empty($res)){

    $set_sub_id = SYSAction::SQL_Data('classification_sub_blind_box', 'set_sub_name', $_POST['dia_add_classification_sub'], 'id');

    MYPDO::$table = 'classification_item_blind_box';
    MYPDO::$data = [
        'set_sub_id' => $set_sub_id,
        'item_name' => $_POST['dia_add_item_name']
    ];
    MYPDO::insert();
}

$url = "../../index.php?PageName=business_price_tracking";
echo "<script>alert('資料新增成功!');</script>"; 
echo "<script>location.href='$url';</script>"; 

?>