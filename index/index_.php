<?php
$title = '樂食町';
$pageName = 'home';
?>

<?php include __DIR__ . '/../parts/html-head.php'; ?>

<?php include __DIR__ . '/../parts/banner.php'; ?>


<div class="container-fluid">
    <div class="row">

        <!-- 左側選單欄 -->
        <div class="col-12 col-md-2"> 
        <?php include __DIR__ . '/../parts/aside.php'; ?>
        </div>

        <!-- 主要內容區 -->
        <div class="col-12 col-md-10">
            <!-- <h2>首頁</h2> -->
            <?php include __DIR__ . '/../parts/breadcrumb.php'; ?>
        </div>

    </div>
</div>



<?php include __DIR__ . '/../parts/script.php'; ?>

<?php include __DIR__ . '/../parts/html-foot.php'; ?>