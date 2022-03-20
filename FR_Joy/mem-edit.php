<?php
require __DIR__ . '/parts/connect_db.php';

$title = '修改資料';
$pageName = 'mem-edit';

$mid = isset($_GET['MID']) ? intval($_GET['MID']) : 0;

$sql = "SELECT * FROM member WHERE MID=$mid";

$row = $pdo->query($sql)->fetch();

if(empty($row)){
    header('Location:member-list2.php '); // 找不到資炓轉向列表頁
    exit;
}
?>
<?php include __DIR__ . '/parts/html-head.php'; ?>

<style>
    form .mb-3 .form-text {
        color: red;
    }
</style>
<div class="container">
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">修改資料</h5>
                    <form name="form1" method="post" novalidate onsubmit="checkForm(); return false;">
                        <input type="hidden" name="mid" value="<?= $row['MID'] ?>">

                        <div class="mb-3">
                            <label class="form-label">上傳圖片</label>
                            <input class="form-control form-control-lg" type="text" name="Mpic" />
                            <label class="form-label">姓名</label>
                            <input class="form-control form-control-lg" type="text" name="Mname" />
                            <label for="identity">身分證</label>
                            <input class="form-control form-control-lg" type="text" id="identity" name="Midentity">

                            <label class="form-label">性別</label>
                            <br>
                            <input type="radio" id="male" name="Msex" value="男">
                            <label for="male">男</label>
                            <input type="radio" id="female" name="Msex" value="女">
                            <label for="female">女</label>
                            <br>

                            <br>
                            <div class="mb-3">
                                <label class="form-label">職業</label>
                                <input class="form-control form-control-lg" type="text" name="Mvocation" />
                                <label for="birthday">出生年月日</label>
                                <input type="date" id="birthday" name="Mbirthday">
                                <br>
                                <br>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">居住城市</label>
                                <input class="form-control form-control-lg" type="text" name="Mcity" />
                            </div>
                            <div class="mb-3">
                                <label class="form-label">居住地址</label>
                                <input class="form-control form-control-lg" type="text" name="Maddress" />
                            </div>

                            <label class="form-label">婚姻狀況</label>
                            <input type="radio" id="marry" name="Mmarry" value="已婚">
                            <label for="marry">已婚</label>
                            <input type="radio" id="marry" name="Mmarry" value="未婚">
                            <label for="marry">未婚</label>
                            <br>

                            <label class="form-label">有無子嗣</label>
                            <input type="radio" id="Mchild" name="Mchild" value="有小孩">
                            <label for="Mchild">有小孩</label>
                            <input type="radio" id="Mchild" name="Mchild" value="無小孩">
                            <label for="Mchild">無小孩</label>
                            <br>

                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input class="form-control form-control-lg" type="email" name="Memail" />
                            </div>
                            <div class="mb-3">
                                <label class="form-label">手機號碼</label>
                                <input class="form-control form-control-lg" type="number" name="Mphone" />
                            </div>

                            <div class="mb-3">
                                <label class="form-label">密碼</label>
                                <input class="form-control form-control-lg" type="text" name="Mpassword" />
                            </div>
                            <button type="submit" class="btn btn-primary">修改</button>
                    </form>

                </div>
            </div>
        </div>
    </div>





</div>
<?php include __DIR__ . '/parts/script.php'; ?>
<script>
    // const mobile = document.form1.mobile; // DOM element
    // const mobile_msg = mobile.closest('.mb-3').querySelector('.form-text');

    // const name = document.form1.name;
    // const name_msg = name.closest('.mb-3').querySelector('.form-text');

    function checkForm() {
        let isPass = true; // 有沒有通過檢查

        name_msg.innerText = ''; // 清空訊息
        mobile_msg.innerText = ''; // 清空訊息

        // TODO: 表單資料送出之前, 要做格式檢查

        if (name.value.length < 2) {
            isPass = false;
            name_msg.innerText = '請填寫正確的姓名'
        }

        const mobile_re = /^09\d{2}-?\d{3}-?\d{3}$/; // new RegExp()
        if (mobile.value) {
            // 如果不是空字串就檢查格式
            if (!mobile_re.test(mobile.value)) {
                mobile_msg.innerText = '請輸入正確的手機號碼';
                isPass = false;
            }
        }

        if (isPass) {
            const fd = new FormData(document.form1);

            fetch('ab-edit-api.php', {
                    method: 'POST',
                    body: fd
                }).then(r => r.json())
                .then(obj => {
                    console.log(obj);
                    if (obj.success) {
                        alert('修改成功');
                        // location.href = 'member-list.php';
                    } else {
                        alert('沒有修改');
                    }

                })


        }


    }
</script>
<?php include __DIR__ . '/parts/html-foot.php'; ?>