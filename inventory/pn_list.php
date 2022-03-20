<?php
include __DIR__ . '/../parts/connect_db.php';
?>

<?php
$title = '品號維護';
include __DIR__ . '/../parts/html-head.php'; ?>

<?php include __DIR__ . '/../parts/banner.php'; ?>


<div class="container-fluid">
    <div class="row">

        <!-- 左側選單欄 -->
        <div class="col-12 col-md-2">
            <?php
            $pageName = '';
            include __DIR__ . '/../parts/aside.php'; ?>
        </div>

        <!-- 主要內容區 -->
        <div class="col-12 col-md-10">
            <!-- <h2>首頁</h2> -->
            <?php
            $systemName = '庫存管理系統';
            $systemitem = '品號維護';
            include __DIR__ . '/../parts/breadcrumb.php'; ?>

            <!-- 分頁的內容:開始 -->

            <?php
            $perPage = 5; // 每一頁有幾筆
            $page = isset($_GET['page']) ? intval($_GET['page']) : 1;  // 用戶要看的頁碼
            if ($page < 1) {
                header('Location: pn_list.php?page=1');
                exit;
            }

            $pn = isset($_GET['pn']) ? ($_GET['pn']) : '%';  // user在查詢文字方塊輸入的的品號
            $t_sql = "SELECT COUNT(*) FROM product WHERE product_id like '{$pn}'";
            // 取得總筆數
            $totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0];
            $rows = []; // 預設沒有資料
            $totalPages = 0;
            if ($totalRows) {
                // 總頁數
                $totalPages = ceil($totalRows / $perPage);
                if ($page > $totalPages) {
                    header("Location: pn_list.php?page=$totalPages");
                    exit;
                }

                $sql = sprintf("SELECT * FROM product WHERE product_id LIKE '%s' ORDER BY product_id DESC LIMIT %s, %s", $pn, ($page - 1) * $perPage, $perPage);
                $rows = $pdo->query($sql)->fetchAll(); // 拿到分頁資料
            }

            ?>

            <div class="container ">
                <div class="row">
                    <div class="col">
                        <div class="d-flex flex-row-reverse">
                            <form class="d-flex mb-3" method="$_GET" action="pn_list.php">
                                <input class="form-control me-2" name="pn" type="text" placeholder="品號(可搭配'%'字元 )" aria-label="Search" required>
                                <button class="btn btn-primary search" type="submit">Search</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">
                                        <i class="fas fa-trash-alt"></i>
                                    </th>
                                    <th scope="col">品號</th>
                                    <th scope="col">名稱</th>
                                    <th scope="col">敘述</th>
                                    <th scope="col">單價</th>
                                    <th scope="col">供應時段</th>
                                    <th scope="col">熱量-kcal</th>
                                    <th scope="col">
                                        <i class="fas fa-edit"></i>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($totalRows == 0) {
                                    echo "<tr><td colspan='8'><b>查無品號!</b></td></tr>";
                                } else { ?>
                                <?php foreach ($rows as $r) : ?>
                                    <tr>
                                        <td>
                                            <a href="pn_delete.php?pn_del=<?= $r['product_id'] ?>" onclick="return confirm(`確定要刪除品號為 <?= $r['product_id'] ?> 的記錄嗎?`)">
                                                <!-- <a href="javascript: del_it(<?= $r['product_id'] ?>)"> -->
                                                <i class="fas fa-trash-alt"></i>
                                            </a>
                                        </td>
                                        <td><?= $r['product_id'] ?></td>
                                        <td><?= $r['product_name'] ?></td>
                                        <td><?= $r['product_desc'] ?></td>
                                        <td><?= $r['product_price'] ?></td>
                                        <td><?= $r['period_id'] ?></td>
                                        <td><?= $r['product_cal'] ?></td>
                                        <td>
                                            <a href="pn_edit.php?product_id=<?= $r['product_id'] ?>">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-center">
                                <li class="page-item <?= $page == 1 ? 'disabled' : '' ?>">
                                    <a class="page-link" href="?page=<?= $page - 1 ?>&pn=<?= $pn ?>">
                                        <i class="fas fa-arrow-alt-circle-left"></i>
                                    </a>
                                </li>
                                <?php for ($i = $page - 5; $i <= $page + 5; $i++) :
                                    if ($i >= 1 and $i <= $totalPages) :
                                ?>
                                        <li class="page-item <?= $page == $i ? 'active' : '' ?>">
                                            <a class="page-link" href="?page=<?= $i ?>&pn=<?= $pn ?>"><?= $i ?></a>
                                        </li>
                                <?php endif;
                                endfor; ?>
                                <li class="page-item <?= $page == $totalPages ? 'disabled' : '' ?>">
                                    <a class="page-link" href="?page=<?= $page + 1 ?>&pn=<?= $pn ?>">
                                        <i class="fas fa-arrow-alt-circle-right"></i>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>

            </div>


        </div>

    </div>
</div>

<!-- 分頁的內容:結束 -->

<?php include __DIR__ . '/../parts/script.php'; ?>

<?php include __DIR__ . '/../parts/html-foot.php'; ?>