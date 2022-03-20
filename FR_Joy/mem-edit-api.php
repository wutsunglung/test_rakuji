<?php
require __DIR__ . '/parts/connect_db.php';

header('Content-Type: application/json');
// 輸出的資料格式
$output = [
    'success' => false,
    'error' => '沒有表單資料',
    'code' => 0,
    'postData' => [],
    'rowCount' => 0,
];

$output['postData'] = $_POST;  // 讓前端做資料查看,資料是否一致

if (empty($_POST['mid']) or empty($_POST['name'])) {
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}



// TODO: 欄位檢查


$sql = "UPDATE `member` SET  
        `Mpic`=?,
        `Mname`=?,
        `Midentity`=?,
        `Msex`=?,
        `Mvocation`=?,
        `Mbirthday`=?,
        `Mcity`=?,
        `Maddress`=?,
        `Mmarry`=?,
        `Mchild`=?,
        `Memail`=?,
        `Mphone`=?,
        `Mpassword`=?,
        WHERE `MID`=?";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    $_POST['Mpic']?? '',
    $_POST['Mname'] ?? '',
    $_POST['Midentity'] ?? '',
    $_POST['Msex'] ?? '' ,
    $_POST['Mvocation'] ?? '',
    $_POST['Mbirthday'] ?? '',
    $_POST['Mcity'] ?? '',
    $_POST['Maddress'] ?? '',
    $_POST['Mmarry'] ?? '',
    $_POST['Mchild'] ?? '',
    $_POST['Memail'] ?? '',
    $_POST['Mphone'] ?? '',
    $_POST['Mpassword'] ?? '',
    $_POST['sid'],
]);


$output['rowCount'] = $stmt->rowCount(); // 修改資料的筆數
if ($stmt->rowCount()) {
    $output['error'] = '';
    $output['success'] = true;
} else {
    $output['error'] = '資料沒有修改';
}


echo json_encode($output, JSON_UNESCAPED_UNICODE);
