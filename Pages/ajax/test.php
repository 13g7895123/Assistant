<?php

include_once(__DIR__ . '../../../__Class/ClassLoad.php');

MYPDO::$table = 'test_use';
MYPDO::$data = [
    // 'id' => 1,
    'col2' => 777
];
// MYPDO::$where = ['col3' => 4];
$judgement = MYPDO::insert();

for($i = 0; $i < 2; $i++){

    MYPDO::$table = 'test_use';
    MYPDO::$data = [
        // 'id' => 1,
        'col2' => 777,
    ];
    // MYPDO::$where = ['col3' => 4];
    $judgement2 = MYPDO::insert();
}

echo $judgement;

?>