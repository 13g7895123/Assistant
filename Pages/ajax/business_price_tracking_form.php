<?php

//引入
include_once(__DIR__ . '/../../__Class/ClassLoad.php'); 

$classification_blind_box_id = SYSAction::SQL_Data('classification_blind_box', 'set_name', $_POST['classification_blind_box'], 'id');
$classification_sub_id = SYSAction::SQL_Data('classification_sub_blind_box', 'set_sub_name', $_POST['classification_sub'], 'id');
$item_name_id = SYSAction::SQL_Data('classification_item_blind_box', 'item_name', $_POST['name'], 'id');
$classification_id = SYSAction::SQL_Data('classification', 'classification', $_POST['classification'], 'id');
$source_id = SYSAction::SQL_Data('source', 'source_name', $_POST['source'], 'id');

if($_POST['state'] == '預售'){
    $state = 'presell';
}elseif($_POST['state'] == '銷售中'){
    $state = 'selling';
}else{
    $state ='sold_out';
}

MYPDO::$table = 'product_tracking';
MYPDO::$data = [
    'classification_blind_box_id' => $classification_blind_box_id,
    'classification_sub_id' => $classification_sub_id,
    'item_name_id' => $item_name_id,
    'price' => $_POST['price'],
    'state' => $state,
    'classification_id' => $classification_id,
    'source_id' => $source_id,
    'web_address' => $_POST['web_address']!= ''? $_POST['web_address']: null,
    'remark' => $_POST['remark'] != ''? $_POST['remark']: null
];
MYPDO::insert();

$url = "../../index.php?PageName=business_price_tracking";
echo "<script>location.href='$url';</script>"; 

?>