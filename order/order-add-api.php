<?php
require '../parts/connect_db.php';

header('Content-Type: application/json');

// 輸出的資料格式
$output = [
    'success' => false,
    'error' => '沒有表單資料',
    'code' => 0,
    'postData' => [],
    'insertId' => 0,
    'rowCount' => 0,

];

if (empty($_POST['member_id'])) {

    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}

$output['postData'] = $_POST; // 讓前端做資料查看，資料是否一致

// TODO: 欄位檢查

$sql = "INSERT INTO `order`(`member_id`,`name`,`phone`,`email`,`meal_method`,`total`,`deliverfee`,`grandtotal`,`created_at`,`address`,`status`) VALUES (?,?,?,?,?,?,?,?,NOW(),?,?)" ;

$stmt = $pdo -> prepare($sql);

$stmt -> execute([
    $_POST['member_id'] ?? '',
    $_POST['name'] ?? '',
    $_POST['phone'] ?? '',
    $_POST['email'] ?? '',
    $_POST['meal_method'] ?? '',
    $_POST['total'] ?? '',
    $_POST['deliverfee'] ?? '',
    $_POST['grandtotal'] ?? '',
    $_POST['address'] ?? '',
    $_POST['status'] ?? '',

]);

$output['insertId'] = $pdo -> lastInsertId(); // 取得最近加入資料的PK

$output['rowCount'] = $stmt -> rowCount(); // 取得資料的筆數

if($stmt -> rowCount()){
    $output['error'] = '';
    $output['success'] = true ;
}else{
    $output['error'] = '資料沒有新增成功' ;
}


echo json_encode($output, JSON_UNESCAPED_UNICODE);

