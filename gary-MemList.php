<?php
if (isset($_SESSION['user'])) {
    if ($_SESSION['user']['grade'] === 'low') {
        $mem_sql = $pdo->query("SELECT  * FROM `member` WHERE 1;")->fetchAll();
        foreach ($mem_sql as $member_rows => $member_r) {
            if ($member_r['mem-account'] === $_SESSION['user']['mem_account']) {
                // 取得登入中的會員id
                $memLoginID = $member_r['sid'];
                $rec_sql = $pdo->query("SELECT `orders`.member_sid, `order_details`.*, `produst`.name, `produst`.img, `orders`.order_date FROM `orders`
        JOIN `order_details`
            ON `orders`.sid=`order_details`.order_sid
        JOIN `produst`
            ON `produst`.sid=`order_details`.produst_sid
        WHERE `orders`.member_sid= $memLoginID
        ORDER BY `orders`.order_date DESC, `order_details`.sid;")->fetchAll();
            }
        }
    }
}
?>

<style>
    body {
        background: black;
        color: white;
    }

    .list-section {
        display: none;
    }

    .gary-list {
        float: left;
        padding: 30px 0 0;
        height: 100vh;
        width: 300px;
        background: black;
        border-top: 1px solid white;
        /* border-right: 1px solid white; */
    }
    .list-group>a{
        margin-bottom: 20px;
    }
    .gary-list::after {
        content: '';
        clear: both;
    }

    .list-a {
        background: black;
        color: white;
        font-weight: 600;
        font-size: 20px;
    }

    .rowbox {
        border-top: 1px solid white;
    }

    .List-Avatar {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        overflow: hidden;
        object-fit: cover;
    }

    .List-Avatar-Name {
        font-size: 26px;
    }

    .Uploaded {
        background: white;
        border-radius: 30px;
    }

    .Change {
        background: white;
        border-radius: 15px;
    }

    .scrollbar {
        width: 490px;
        height: 310px;
        overflow: auto;
    }

    .scrollbar::-webkit-scrollbar {
        width: 1em;
    }

    .scrollbar::-webkit-scrollbar-thumb {
        background-color: white;
        border: 1px solid slategrey;
    }

    .scrollbarbox {
        background-color: white;
        border-radius: 10px;
        margin-right: 5px;
        margin-bottom: 5px;
    }

    .scrollbarbox:hover {
        opacity: 0.8;
        border: 3px solid black;
    }

    .scrollbarbox_left {
        width: 35%;
        height: 150px;
    }

    .box_img {
        width: 100%;
        height: 100%;
        overflow: hidden;
        object-fit: contain;
    }

    .scrollbarbox_right {
        width: 65%;
        height: 150px;
    }

    .box-TN {
        color: red;
        font-size: 14px;
        font-weight: 600;
        line-height: 4px;
        margin-top: 20px;
        margin-bottom: 10px;
    }

    .box-word {
        font-size: 16px;
        font-weight: 600;
    }

    .box-word2 {
        font-size: 16px;
        font-weight: 600;
    }

    .box-word3 {
        font-size: 16px;
        font-weight: 600;
        margin-left: 5px;
    }

    .dsn {
        display: none;
    }

    .W-word {
        height: 100%;
        font-size: 40px;
        font-weight: 600;
    }

    .W-boder {
        position: absolute;
        width: 300px;
        height: 300px;
        border-radius: 50%;
        border-top: 10px solid white;
        border-left: 10px solid white;
        animation: circle-loop 0.8s linear infinite;
        margin-left: 120px;
    }

    @keyframes circle-loop {
        0% {
            transform: rotate(0deg);
        }

        50% {
            transform: rotate(300deg);
        }

        100% {
            transform: rotate(360deg);
            opacity: 0.3;
        }
    }
</style>

<div class="gary-list">
    <div class="list-group text-center list-left">
        <a href="gary-Member.php" class="list-a list-group-item list-group-item-action <?= $pageName === "會員資訊" ? 'active' : ''; ?>"><?= $_SESSION['user']['grade'] === 'low' ? '會員資訊' : '資訊'; ?></a>
        <?php if ($_SESSION['user']['grade'] === 'low') : ?>
            <a href="gary-MemberEdit.php" class="list-a list-group-item list-group-item-action <?= $pageName === "修改資料" ? 'active' : ''; ?>">修改資料</a>
            <a href="gary-MemPassword.php" class="list-a list-group-item list-group-item-action <?= $pageName === "密碼專區" ? 'active' : ''; ?>">密碼專區</a>
            <a href="" class="list-a list-group-item list-group-item-action">我的課程</a>
        <?php endif; ?>
    </div>
</div>

<div class="row rowbox">
        <div class="d-flex mt-5">
            <div class="col-3 d-flex justify-content-center">
                <form name="AvatarForm" onsubmit="AvatarData(); return false;" novoalidate>
                    <div>
                        <input type="hidden" name="mem_sid" value="<?= $memLoginID ?>">
                        <input type="hidden" name="mem_avatar" value="<?= $memAvatar ?>">
                        <img id="myimg" class="List-Avatar" src="<?= "gary-uploaded/$memAvatar" ?>" alt="">
                    </div>
                    <p class="text-center mt-3 List-Avatar-Name"><?= $iconName ?></p>
                    <?php if ($_SESSION['user']['grade'] === 'low') : ?>
                        <div class="d-flex justify-content-around">
                            <a id="upAvatar" onclick="uploadAvatar()" class="btn btn-link Uploaded"><i class="fa-solid fa-camera"></i></a>
                            <button type="submit" class="btn btn-link text-decoration-none Change">Change</button>
                        </div>
                </form>
                <form name="AvatarForm2" action="gary-upload-avatar-api.php" method="post" enctype="multipart/form-data" style="display: none">
                    <input type="file" name="avatar" accept="image/*" />
                </form>
            </div>
            <div class="col-4">
                <div class="W-boder"></div>
                <p class="W-word d-flex justify-content-center align-items-center">Welcome</p>
            </div>
            <div class="col-5 d-flex justify-content-center">
                <div class="scrollbar">
                    <div class="scrollbarIN">
                        <?php foreach ($rec_sql as $rec_rows => $rec_r) : ?>
                            <div class="scrollbarbox">
                                <a href="kevin-edit.php?sid=<?= $rec_r['produst_sid'] ?>" class="d-flex text-decoration-none">
                                    <div class="scrollbarbox_left">
                                        <img src="Fteam-produst_img/<?= $rec_r['img'] ?>" alt="" class="box_img">
                                    </div>
                                    <div class="scrollbarbox_right d-flex align-items-center">
                                        <div>
                                            <p class="box-TN"><?= $rec_r['order_date'] ?></p>
                                            <p class="box-TN">Oder :<?= $rec_r['order_sid'] ?></p>
                                            <p class="box-word"><?= $rec_r['name'] ?></p>
                                            <div class="d-flex">
                                                <p class="box-word2">$<?= $rec_r['price'] ?></p>
                                                <p class="box-word3">* <?= $rec_r['quantity'] ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        </div>
    </div>

<script>
    async function AvatarData() {
        // 把整個表單內容抓出來
        const fa = new FormData(document.AvatarForm);

        // 把表單送給誰
        const r = await fetch('gary-AvatarEdit-api.php', {
            method: 'POST',
            body: fa,
        });

        // 回傳的資料是JSON 轉回JS的陣列
        const result = await r.json();

        if (result.success) {
            alert('修改成功');
            location.href = 'gary-Member.php';
        }
    }

    // 上傳大頭照
    const upAvatar = document.querySelector('#upAvatar');
    const myimg = document.querySelector('#myimg');
    const avatar = document.AvatarForm2.avatar;

    // 點擊等於點擊了input
    function uploadAvatar() {
        avatar.click(); // 模擬點擊
    }

    // 監聽的事件是內容改變(change)才會觸發
    avatar.addEventListener("change", async function() {

        // 上傳表單

        // 先拿到整個表單
        const fa2 = new FormData(document.AvatarForm2);

        // r=拿到的回傳值(response)
        const r = await fetch("gary-upload-avatar-api.php", {
            // 預設是GET 這邊設定成POST
            method: "POST",
            // 我要傳的資料
            body: fa2,
        });

        // 設定一個變數是拿回來的JSON格式轉回JS格式
        const obj = await r.json();
        console.log(obj);

        // 顯示的照片路徑 uploaded這個資料夾+回傳過來的檔名
        myimg.src = "./gary-uploaded/" + obj.filename;
        document.AvatarForm.mem_avatar.value = obj.filename;
    });
</script>