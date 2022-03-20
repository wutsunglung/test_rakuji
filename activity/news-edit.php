

<?php
require __DIR__ . '/../parts/connect_db.php';

$title = '修改資料';
$pageName = 'news-edit';

$sid = isset($_GET['sid']) ? intval($_GET['sid']) : 0;

$sql = "SELECT * FROM latest_news WHERE sid=$sid";
$row = $pdo->query($sql)->fetch();
if(empty($row)){
    header('Location: news-list.php'); // 找不到資炓轉向列表頁
    exit;
}

?>
<?php include __DIR__ . '/../parts/html-head.php'; ?>
<?php include __DIR__ . '/../parts/banner.php'; ?>
<style>
    form .mb-3 .form-text{
        color: red;
    }
    
</style>

<div class="container-fluid">
    <div class="row">
<!-- 左側選單欄 -->
<div class="col-12 col-md-2"> 
    <?php include __DIR__ . '/../parts/aside.php'; ?>
</div>
        
        
        <!-- 主要內容區 -->
        <div class="col-12 col-md-10">
    <?php include __DIR__ . '/../parts/news-navbar.php'; ?>
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">修改消息</h5>
                    <form name="form1" method="post" novalidate onsubmit="checkForm(); return false;">
                        <input type="hidden" name="sid" value="<?= $row['sid'] ?>">

                        <div class="mb-3">
                            <label for="name" class="form-label">*標題</label>
                            <input type="text" class="form-control" id="name" name="name" required 
                            value="<?= htmlentities($row['name']) ?>">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="img_id" class="form-label">*照片</label>
                            <input type="text" class="form-control" id="img_id" name="img_id" 
                            value="<?= htmlentities($row['img_id']) ?>">
                            <div class="form-text"></div>
                        </div>
                  
                        <div class="mb-3">
                            <label for="timestart" class="form-label">*開始時間</label>
                            <input type="date" class="form-control" id="timestart" name="timestart" 
                            value="<?= $row['timestart'] ?>">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="timeend" class="form-label">*結束時間</label>
                            <input type="date" class="form-control" id="timeend" name="timeend" 
                            value="<?= $row['timeend'] ?>">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="content" class="form-label">*內容</label>
                            <textarea class="form-control" name="content"
                            id="content" 
                            cols="30" 
                            rows="3"><?= $row['content'] ?></textarea>

                            <div class="form-text"></div>
                        </div>

                        <button type="submit" class="btn btn-primary">修改</button>
                    </form>

                </div>
            </div>
        </div>
    </div>





</div>
<?php include __DIR__ . '/../parts/script.php'; ?>
<?php include __DIR__ . '/../parts/html-foot.php'; ?>


<script>

    const name = document.form1.name;
    const name_msg = name.closest('.mb-3').querySelector('.form-text');

    function checkForm(){
        let isPass = true; // 有沒有通過檢查

        name_msg.innerText = '';  // 清空訊息

        // // TODO: 表單資料送出之前, 要做格式檢查

        if(name.value.length<2){
            isPass = false;
            name_msg.innerText = '請填寫正確的照片名稱'
        }

    

        if(isPass){
            const fd = new FormData(document.form1);

            fetch('news-edit-api.php', {
                method: 'POST',
                body: fd
            }).then(r => r.json())
            .then(obj => {
                console.log(obj);
                if(obj.success){
                    alert('修改成功');
                    // location.href = 'news-list.php';
                } else {
                    alert('修改失敗');
                }

            })


        }


    }


</script>


