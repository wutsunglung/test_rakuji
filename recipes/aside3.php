<div class="list-group">

<div class="">
        <a class="btn list-group-item list-group-item-action aside_btn" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
            <i class="fa-solid fa-caret-right arrow1"></i>庫存管理系統
        </a>
        <div class="collapse" id="collapseExample">
            <div class="card-body">
                <a href="#" class="list-group-item list-group-item-action">庫存查詢</a>
                <a href="#" class="list-group-item list-group-item-action">庫存維護</a>
                <a href="../inventory/pn_list.php" class="list-group-item list-group-item-action">品號維護</a>
                <a href="#" class="list-group-item list-group-item-action">食材清單維護</a>
                <a href="#" class="list-group-item list-group-item-action">統計報表</a>
            </div>
        </div>
    </div>

    <div>
        <a class="btn list-group-item list-group-item-action aside_btn" data-bs-toggle="collapse" href="#collapseExample2" role="button" aria-expanded="false" aria-controls="collapseExample">
            <i class="fa-solid fa-caret-right"></i>活動管理系統
        </a>
        <div class="collapse" id="collapseExample2">
            <div class="card-body">
                <a href="../activity/news-list.php" class="list-group-item list-group-item-action <?= $pageName == 'news-list' ? 'active' : '' ?>" class="list-group-item list-group-item-action">最新消息</a>
                <a href="#" class="list-group-item list-group-item-action">特殊節日及壽星</a>
                <a href="#" class="list-group-item list-group-item-action">最佳餐點</a>
                <a href="#" class="list-group-item list-group-item-action">餐點投票結果</a>
                <a href="#" class="list-group-item list-group-item-action">副產品專區</a>
            </div>
        </div>
    </div>
<!-- aside3.php 套用於recipes_edit.php -->
<div>
        <a class="btn list-group-item list-group-item-action aside_btn <?= ($pageName == 'recipes_list' or $pageName == 'recipes_add' ) ? 'active' : '' ?>" data-bs-toggle="collapse" href="#collapseExample3" role="button" aria-expanded="false" aria-controls="collapseExample">
            <i class="fa-solid fa-caret-right"></i>創意食譜系統
        </a>
        <div class="collapse" id="collapseExample3">
            <div class="card-body">
                <a href="recipes_list.php" class="list-group-item list-group-item-action <?= $pageName == 'recipes_edit'  ? 'active' : '' ?>">食譜查詢</a>

                <a href="recipes_add.php" target="iframe-1" class="list-group-item list-group-item-action <?= $pageName == 'recipes_add'  ? 'active' : '' ?>">新增食譜</a>

                <a href="#" class="list-group-item list-group-item-action">卡路里搜尋</a>
            </div>
        </div>
    </div>

    <div>
        <a class="btn list-group-item list-group-item-action" data-bs-toggle="collapse" href="#collapseExample4" role="button" aria-expanded="false" aria-controls="collapseExample"><i class="fa-solid fa-caret-right"></i> 會員管理系統
        </a>
        <div class="collapse" id="collapseExample4">
            <div class="card card-body">
                <a href="../FR_Joy/member-list2.php" class="list-group-item list-group-item-action">會員名單</a>
            </div>
        </div>
    </div>

    <div>
        <a class="btn list-group-item list-group-item-action">
            員工管理系統
        </a>
        <div class="collapse" id="collapseExample5">
            <div class="card card-body"></div>
        </div>
    </div>

    <div>
        <a class="btn list-group-item list-group-item-action aside_btn <?= ($pageName == 'order-list' or $pageName == 'order-add') ? 'active' : '' ?>" data-bs-toggle="collapse" href="#collapseExample6" role="button" aria-expanded="false" aria-controls="collapseExample">
            <i class="fa-solid fa-caret-right"></i>訂餐管理系統
        </a>
        <div class="collapse" id="collapseExample6">
            <div class="card-body">
                <a href="../order/order-list.php" class="list-group-item list-group-item-action <?= $pageName == 'order-list' ? 'active' : '' ?>">訂單列表</a>
                <a href="../order/order-add.php" class="list-group-item list-group-item-action <?= $pageName == 'order-add' ? 'active' : '' ?>">新增訂單</a>
            </div>
        </div>
    </div>

    <div>
        <a class="btn list-group-item list-group-item-action aside_btn <?= ($pageName == 'booking-list' or $pageName == 'booking-add') ? 'active' : '' ?>" data-bs-toggle="collapse" href="#collapseExample7" role="button" aria-expanded="false" aria-controls="collapseExample">
            <i class="fa-solid fa-caret-right"></i>訂位管理系統
        </a>
        <div class="collapse" id="collapseExample7">
            <div class="card-body">
                <a href="../booking/booking-list.php" class="list-group-item list-group-item-action <?= $pageName == 'booking-list' ? 'active' : '' ?>">訂位列表</a>
                <a href="../booking/booking-add.php" class="list-group-item list-group-item-action <?= $pageName == 'booking-add' ? 'active' : '' ?>">新增訂位</a>
            </div>
        </div>
    </div>

</div>