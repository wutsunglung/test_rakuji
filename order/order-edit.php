<?php
require '../parts/connect_db.php';

$title = '修改訂單';
$systemName = '訂餐管理系統';
$systemitem = '修改訂單';
$pageName = 'order-list';

$sid = isset($_GET['id']) ? intval($_GET['id']) : 0;

$sql = "SELECT * FROM `order` WHERE id=$sid";
$row = $pdo->query($sql)->fetch();
if (empty($row)) {
    header('Location: order-list.php'); // 找不到資料轉向列表頁
    exit;
}


?>

<?php include '../parts/html-head.php'; ?>

<?php include '../parts/banner.php'; ?>

<style>
    #booking_date {
        position: relative;
    }

    #booking_date::-webkit-calendar-picker-indicator {
        position: absolute;
        right: 0;
        padding-left: calc(100% - 40px);
        padding-right: 10px;
    }

    form {
        width: 50%;
    }

    h2 {
        color: peru;
    }

    .card {
        background-color: floralwhite;
    }
</style>

<div class="container-fluid">
    <div class="row">

        <!-- 左側選單欄 -->
        <div class="col-12 col-md-2">
            <?php include '../parts/aside.php'; ?>
        </div>

        <div class="col-12 col-md-10">

            <?php include '../parts/breadcrumb.php'; ?>

            <!-- 修改訂位區 -->
            <div class="card">
                <div class="card-body">
                    <form name="form1" method="post" novalidate onsubmit="checkForm(); return false;">

                        <h2 class="card-title mb-4">
                            <i class="fa-solid fa-pen"></i>
                            <span>修改訂單</span>
                        </h2>

                        <input type="hidden" name="id" value="<?= $row['id'] ?>">

                        <div class="mb-3">
                            <label for="member_id" class="form-label">會員編號</label>
                            <input type="number" class="form-control" id="member_id" name="member_id" required value="<?= htmlentities($row['member_id']) ?>">
                            <div class="form-text"></div>
                        </div>

                        <div class="mb-3">
                            <label for="name" class="form-label">姓名</label>
                            <input type="text" class="form-control" id="name" name="name" required value="<?= $row['name'] ?>">
                            <div class="form-text"></div>
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label">手機</label>
                            <input type="tel" class="form-control" id="phone" name="phone" pattern="09\d{2}-?\d{3}-?\d{3}" value="<?= $row['phone'] ?>">
                            <div class="form-text"></div>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">信箱</label>
                            <input type="email" class="form-control" id="email" name="email" required value="<?= $row['email'] ?>">
                            <div class="form-text"></div>
                        </div>

                        <div class="mb-3">
                            <label for="meal_method" class="form-label">取餐方式</label>
                            <select class="form-select" aria-label="Default select example" id="meal_method" name="meal_method" require>
                                <option value="外送" <?= $row['meal_method'] == "外送" ? "selected" : "" ?>>外送</option>
                                <option value="外帶" <?= $row['meal_method'] == "外帶" ? "selected" : "" ?>>外帶</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="total" class="form-label">總計</label>
                            <input type="number" class="form-control" id="total" name="total" required value="<?= $row['total'] ?>">
                            <div class="form-text"></div>
                        </div>

                        <div class="mb-3">
                            <label for="deliverfee" class="form-label">運費</label>
                            <input type="number" class="form-control" id="deliverfee" name="deliverfee" required value="<?= $row['deliverfee'] ?>">
                            <div class="form-text"></div>
                        </div>

                        <div class="mb-3">
                            <label for="grandtotal" class="form-label">含運費總計</label>
                            <input type="number" class="form-control" id="grandtotal" name="grandtotal" required value="<?= $row['grandtotal'] ?>">
                            <div class="form-text"></div>
                        </div>

                        <div class="mb-3">
                            <label for="address" class="form-label">外送地址</label>
                            <input type="text" class="form-control" id="address" name="address" required value="<?= $row['address'] ?>">
                            <div class="form-text"></div>
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label">狀態</label>
                            <select class="form-select" aria-label="Default select example" id="status" name="status" require>
                                <option value="準備中" <?= $row['status'] == "準備中" ? "selected" : "" ?>>準備中</option>
                                <option value="已完成" <?= $row['status'] == "已完成" ? "selected" : "" ?>>已完成</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-outline-danger">修改</button>
                        <a class="btn btn-outline-danger" href="order-list.php">取消</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



<?php include '../parts/script.php'; ?>
<script>
    // const mobile = document.form1.mobile; // DOM element
    // const mobile_msg = mobile.closest('.mb-3').querySelector('.form-text');

    // const name = document.form1.name; // DOM element
    // const name_msg = name.closest('.mb-3').querySelector('.form-text');


    function checkForm() {
        let isPass = true; // 有沒有通過檢查

        // name_msg.innerText = ''; // 清空資訊
        // mobile_msg.innerText = ''; // 清空資訊


        // TODO: 表單資料送出之前，要做格式檢查
        // if (name.value.length < 2) {
        //     isPass = false;
        //     name_msg.innerText = '請填寫正確的姓名';

        // }

        // const mobile_re = /^09\d{2}-?\d{3}-?\d{3}$/; // new RegExp()

        // if (mobile.value) {
        //     // 如果不是空字串就檢查格式
        //     if (!mobile_re.test(mobile.value)) {
        //         mobile_msg.innerText = '請輸入正確的手機號碼';
        //         isPass = false;
        //     }
        // }

        if (isPass) {
            const fd = new FormData(document.form1);

            fetch('order-edit-api.php', {
                    method: 'POST',
                    body: fd
                }).then(r => r.json())
                .then(obj => {
                    console.log(obj);
                    if (obj.success) {
                        alert('修改成功');
                        location.href = 'order-list.php';
                    } else {
                        alert('沒有修改');
                    }
                })
        }
    }
</script>
<?php include '../parts/html-foot.php'; ?>