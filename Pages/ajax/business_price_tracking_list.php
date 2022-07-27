<?php

//引入
include_once(__DIR__ . '/../../__Class/ClassLoad.php');

$search_text = $_POST['search_text'];

MYPDO::$field = [
    'set_name',
    'set_sub_name',
    'item_name',
    'price',
    'state',
    'source_name',
    'web_address'
];
MYPDO::$table = 'product_tracking';
MYPDO::$join = [
    'classification_blind_box' => ['product_tracking.classification_blind_box_id', 'classification_blind_box.id'],
    'classification_sub_blind_box' => ['product_tracking.classification_sub_id', 'classification_sub_blind_box.id'],
    'classification_item_blind_box' => ['product_tracking.item_name_id', 'classification_item_blind_box.id'],
    'source' => ['product_tracking.source_id', 'source.id']

];

if($search_text != ''){
    MYPDO::$where = "item_name LIKE '%$search_text%'";
}

$results = MYPDO::select();

echo json_encode($results);

?>