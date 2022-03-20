<?php
require '../parts/connect_db.php';


$title = '訂單列表';
$systemName = '訂餐管理系統';
$systemitem = '訂單列表';
$pageName = 'order-list';

$perpage = 10; //每一頁有幾筆

$page = isset($_GET['page']) ? intval($_GET['page']) : 1; // 用戶要看的頁碼

if ($page < 1) {
    header('Location: order-list.php?page=1');
    exit;
}

$t_sql = "SELECT COUNT(1) FROM `order`";

//取得總筆數
$totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0];
$rows = []; // 預設沒有資料
$totalPages = 0;

if ($totalRows) {

    //總頁數
    $totalPages = ceil($totalRows / $perpage);
    if ($page > $totalPages) {
        header("Location: order-list.php?page=$totalPages");
        exit;
    }


    $sql = sprintf("SELECT * FROM `order` order by id LIMIT %s, %s", ($page - 1) * $perpage, $perpage);

    $rows = $pdo->query($sql)->fetchAll(); //拿到分頁資料
}



?>

<?php include '../parts/html-head.php'; ?>

<?php include '../parts/banner.php'; ?>

<style>
    thead {
        background-color: chocolate;
        color: #fff;
    }

    .table-striped>tbody>tr:nth-of-type(odd) {
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

            <!-- 麵包屑 -->
            <?php include '../parts/breadcrumb.php'; ?>

            <div class="d-flex flex-row-reverse">
                <form class="d-flex mb-3">
                    <input class="form-control me-2" id="myInput" type="search" placeholder="請輸入關鍵字" aria-label="Search">
                    <button class="btn btn-outline-danger search" type="button">Search</button>
                </form>
            </div>


            <!-- 訂位查詢區 -->
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">訂單編號</th>
                        <th scope="col">會員編號</th>
                        <th scope="col">姓名</th>
                        <th scope="col">手機</th>
                        <th scope="col">信箱</th>
                        <th scope="col">取餐方式</th>
                        <th scope="col">總計</th>
                        <th scope="col">運費</th>
                        <th scope="col">含運費總計</th>
                        <th scope="col">訂購時間</th>
                        <th scope="col">外送地址</th>
                        <th scope="col">狀態</th>
                        <th scope="col">修改</th>
                        <th scope="col">刪除</th>
                    </tr>
                </thead>

                <tbody id="myBody">

                    <?php foreach ($rows as $r) : ?>

                        <tr>
                            <td><?= $r['id'] ?></td>
                            <td><?= $r['member_id'] ?></td>
                            <td><?= $r['name'] ?></td>
                            <td><?= $r['phone'] ?></td>
                            <td><?= $r['email'] ?></td>
                            <td><?= $r['meal_method'] ?></td>
                            <td><?= $r['total'] ?></td>
                            <td><?= $r['deliverfee'] ?></td>
                            <td><?= $r['grandtotal'] ?></td>
                            <td><?= $r['created_at'] ?></td>
                            <td><?= $r['address'] ?></td>
                            <td><?= $r['status'] ?></td>

                            <td>
                                <a href="order-edit.php?id=<?= $r['id'] ?>">
                                    <i class="fas fa-edit" style="color:peru"></i>
                                </a>
                            </td>

                            <td>
                                <a href="javascript:del_it(<?= $r['id'] ?>)">
                                    <i class="fa-solid fa-trash" style="color:peru"></i>
                                </a>
                            </td>
                        </tr>

                    <?php endforeach ?>
                </tbody>
            </table>

            <!-- 頁籤 -->
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                    <li class="page-item  <?= $page == 1 ? 'disabled' : '' ?>"><a class="page-link" href="?page=<?= $page - 1 ?>">&laquo;</a></li>

                    <?php for ($i = $page - 5; $i <= $page + 5; $i++) :
                        if ($i >= 1 and $i <= $totalPages) :
                    ?>
                            <li class="page-item <?= $page == $i ? 'active' : '' ?>"><a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a></li>
                    <?php endif;
                    endfor; ?>

                    <li class="page-item <?= $page == $totalPages ? 'disabled' : '' ?>"><a class="page-link" href="?page=<?= $page + 1 ?>">&raquo;</a></li>
                </ul>
            </nav>
        </div>

    </div>

</div>



<?php include '../parts/script.php'; ?>

<script>
    function del_it(id) {
        if (confirm(`確定要刪除訂單編號為${id}的資料嗎?`)) {
            location.href = 'order-delete.php?id=' + id;
        }
    }

    $(document).ready(function() {
        $("#myInput").on("keyup", function() {

            // 抓搜尋的關鍵值
            var value = $(this).val().toLowerCase();

            $(".search").on("click", function() {

                // 抓Table裡頭有沒有符合
                $("#myBody tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
                });

            });
        });

        // 點選搜尋列打叉按鈕顯示全部表格
        $('#myInput').on('search', function() {
            $("#myBody tr").filter(function() {
                $(this).show();
            });
        });
    });
</script>

<?php include '../parts/html-foot.php'; ?>