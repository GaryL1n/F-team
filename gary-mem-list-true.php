<?php
require __DIR__ . '/parts/connect_db.php';
$title = 'Gary-Ture-Member';
$pageName = "會員管理";
$perPage = 15; //每一頁有幾筆

//頁碼 用戶要看第幾頁
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;

// 如果頁碼小於1 轉頁面到第一頁
if ($page < 1) {
    header('Location: ?page=1');
    exit;
}

$t_sql = "SELECT COUNT(1) FROM member WHERE `mem-bollen` = 1";
$totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0]; //總筆數 索引式陣列

// echo $totalRows; exit; 

//總頁數
$totalPages = ceil($totalRows / $perPage); //總筆數除以每一頁有幾筆 ceil是無條件進位

$rows = [];

//有資料再執行
if ($totalRows > 0) {
    //頁碼若超過總頁數 轉到最後一個頁面
    if ($page > $totalPages) {
        header("Location: ?page=$totalPages");
        exit;
    }

    //索引值 資料筆數 ORDER BY sid DESC LIMIT降冪排序
    $sql = sprintf("SELECT * FROM `member` WHERE `mem-bollen` = 1 ORDER BY sid DESC LIMIT %s, %s", ($page - 1) * $perPage, $perPage);

    $rows = $pdo->query($sql)->fetchAll();
}

?>
<?php include __DIR__ . '/parts/html-head.php' ?>
<?php include __DIR__ . '/parts/product-list.php' ?>

<style>
    .mgtp10 {
        margin-top: 3%;
    }

    #bollen {
        display: none;
    }

    .word19{
        font-weight: 600;
        font-size: 40px;
    }
</style>

<div class="row">

    <div class="mgtp10">
        <div class="col d-flex justify-content-between">
            <nav aria-label="Page navigation example">
                <ul class="pagination">


                    <!-- disabled讓按鈕不能按 第一頁 -->
                    <li class="page-item <?= $page == 1 ? 'disabled' : '' ?>">
                        <a class="page-link" href="?page= 1 ?>">
                            <i class="fa-solid fa-angles-left"></i>
                        </a>
                    </li>


                    <!-- 上一頁 -->
                    <li class="page-item <?= $page == 1 ? 'disabled' : '' ?>">
                        <a class="page-link" href="?page=<?= $page - 1 ?>">
                            <i class="fa-solid fa-angle-left"></i>
                        </a>
                    </li>


                    <!-- 控制頁碼範圍 -->
                    <?php for ($i = $page - 5; $i <= $page + 5; $i++) :
                        // 不會顯示超過範圍的
                        if ($i >= 1 and $i <= $totalPages) :
                    ?>
                            <!-- 反白 -->
                            <li class="page-item <?= $page == $i ? 'active' : '' ?>">
                                <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                            </li>
                    <?php endif;
                    endfor; ?>


                    <!-- 下一頁 -->
                    <li class="page-item <?= $page == $totalPages ? 'disabled' : '' ?>">
                        <a class="page-link" href="?page=<?= $page + 1 ?>">
                            <i class="fa-solid fa-angle-right"></i>
                        </a>
                    </li>

                    <!-- 最後一頁 -->
                    <li class="page-item <?= $page == $totalPages ? 'disabled' : '' ?>">
                        <a class="page-link" href="?page=<?= $totalPages ?>">
                            <i class="fa-solid fa-angles-right"></i>
                        </a>
                    </li>


                </ul>
            </nav>
            <p class="word19">上班想睡覺嗎?不妨研究一下6/2(1+2)=是1?還是9?</p>
            <div>
                <a href="gary-mem-list-false.php"><button type="submit" class="btn btn-primary btn-lg">查看停用會員</button></a>
            </div>
        </div>

        <button onclick="delete_select()" class="btn btn-danger">Delete</button>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>
                        <div class="form-check">
                            <input class="form-check-input totalCheck" type="checkbox" value="" id="flexCheckDefault" name="all" onclick="check_all(this,'delALL')">
                        </div>
                    </th>
                    <th scope="col"><i class="fa-solid fa-trash-can"></i></th>
                    <th scope="col">#</th>
                    <th scope="col">狀態</th>
                    <th scope="col">姓名</th>
                    <th scope="col">暱稱</th>
                    <th scope="col">會員等級</th>
                    <th scope="col">手機</th>
                    <th scope="col">Email</th>
                    <!-- <th scope="col">生日</th> -->
                    <th scope="col">創建時間</th>
                    <th scope="col"><i class="fa-solid fa-heart"></i></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($rows as $r) : ?>

                    <?php //設定布林值名稱
                    $r['mem-bollen'] = '正常'; ?>

                    <tr>
                        <!-- 多選刪除 -->
                        <td>
                            <div class="form-check">
                                <input class="form-check-input singleCheck" type="checkbox" value="<?= $r['sid'] ?>" id="singleSelect" name="delALL">
                            </div>
                        </td>

                        <!-- 刪除 -->
                        <td>

                            <?php /*
                        <a href="ab-delete.php?sid=<?= $r['sid'] ?>" onclick="return confirm('確定要刪除編號為 <?= $r['sid'] ?> 的資料嗎?')">
                        */ ?>


                            <a href="javascript: delete_it(<?= $r['sid'] ?>)">
                                <i class="fa-solid fa-trash-can"></i>
                            </a>


                        </td>

                        <!-- htmlentities裡面內容跳脫成一般文字 -->
                        <td><?= $r['sid'] ?></td>
                        <td>
                            <?= $r['mem-bollen'] ?>
                            <a href="javascript: bollen_it(<?= $r['sid'] ?>)">
                                <i class="fa-solid fa-rotate"></i>
                            </a>
                        </td>
                        <td><?= htmlentities($r['mem-name']) ?></td>
                        <td><?= htmlentities($r['mem-nickname']) ?></td>
                        <td><?= htmlentities($r['mem-level']) ?></td>
                        <td><?= $r['mem-mobile'] ?></td>
                        <td><?= $r['mem-email'] ?></td>
                        <!-- <td><?= $r['mem-birthday'] ?></td> -->
                        <!--
                    <td><?= htmlentities($r['mem-address']) ?></td>
                    -->
                        <!-- strip_tags 有出現tag的就直接去掉tag -->
                        <!-- <td><?= strip_tags($r['mem-address']) ?></td> -->
                        <td><?= $r['mem-created_at'] ?></td>
                        <td>
                            <a href="javascript: collect_it(<?= $r['sid'] ?>)">
                                <i class="fa-solid fa-heart"></i>
                            </a>
                        </td>

                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</div>

<?php include __DIR__ . '/parts/scripts.php' ?>

<script>
    function delete_it(sid) {
        // 跳詢問視窗
        if (confirm(`確定要刪除編號為 ${sid} 的資料嗎?`)) {
            // 如館按確定 轉到刪除檔
            location.href = `gary-member-delete.php?sid=${sid}`;
        }
    }

    function bollen_it(sid) {
        if (confirm(`確定要停用編號為 ${sid} 的資料嗎?`)) {
            location.href = `gary-list-0-api.php?sid=${sid}`;
        }
    }

    function collect_it(sid) {
            location.href = `gary-collect.php?sid=${sid}`;
    }

    // 全選checkbox同步設定
    function check_all(obj, delALL) {
        const allCheck = document.getElementsByName(delALL);
        for (let i = 0; i < allCheck.length; i++) {
            allCheck[i].checked = obj.checked;
        }
    }
    const singleSelect = document.querySelectorAll('#singleSelect');

    async function delete_select() {
        const select_ar = [];
        for (let i of singleSelect) {
            if (i.checked) {
                select_ar.push(Number(i.value));
            }
        }
        // console.log(select_ar);
        if(confirm(`確定要刪除編號為${select_ar}的資料嗎`)){
            location.href = `gary-member-delete.php?sid=${select_ar}`;
        }
    }
</script>

<?php include __DIR__ . '/parts/html-foot.php' ?>