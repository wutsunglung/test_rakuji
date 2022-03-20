<?php
include __DIR__ . '/../parts/connect_db.php';
include __DIR__ . '/../parts/html-head.php';

$product_id = isset($_GET['product_id']) ? $_GET['product_id'] : "" ;
$sql = "SELECT * FROM product WHERE product_id = $product_id";
$row = $pdo->query($sql)->fetch();
if(empty($row)){
    header('Location: pn_list.php'); // 找不到資炓轉向品號列表頁
    exit;
}
?>

<div class="container">
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">修改品號資料</h5>
                    <form name="form1" method="post" novalidate onsubmit="checkForm(); return false;">
                        <input type="hidden" name="sid" value="<?= $row['sid'] ?>">

                        <div class="mb-3">
                            <label for="name" class="form-label">* name</label>
                            <input type="text" class="form-control" id="name" name="name" required
                            value="<?= htmlentities($row['name']) ?>">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">email</label>
                            <input type="email" class="form-control" id="email" name="email"
                            value="<?= htmlentities($row['email']) ?>">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="mobile" class="form-label">mobile</label>
                            <input type="tel" class="form-control" id="mobile" name="mobile"
                                value="<?= htmlentities($row['mobile']) ?>"
                                pattern="09\d{2}-?\d{3}-?\d{3}">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="birthday" class="form-label">birthday</label>
                            <input type="date" class="form-control" id="birthday" name="birthday"
                            value="<?= $row['birthday'] ?>">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">address</label>
                            <textarea class="form-control" name="address"
                            id="address" 
                            cols="30" 
                            rows="3"><?= $row['address'] ?></textarea>

                            <div class="form-text"></div>
                        </div>

















?>