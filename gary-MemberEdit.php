<?php
require __DIR__ . '/parts/connect_db.php';

$pageName = "修改資料";
$title = "Gary-MemberEdit";

$sql = "SELECT  * FROM `member` WHERE 1;";
$mem_sql = $pdo->query($sql)->fetchAll();
if (isset($_SESSION['user'])) {
    foreach ($mem_sql as $rows => $r) {
        if ($r['mem-account'] === $_SESSION['user']['mem_account']) {
            // 取得登入中的會員資料
            $memLogin = $r;
        }
    }
}
?>
<?php include __DIR__ . '/parts/html-head.php' ?>
<?php include __DIR__ . '/parts/product-list.php' ?>
<?php include __DIR__ . '/gary-MemList.php' ?>

<style>
    /* .memberEdit {
        border-top: 1px solid gray;
    } */

    .card {
        margin-top: 10px;
        width: 70%;
        background: black;
    }

    .error {
        width: 60px;
        height: 60px;
        overflow: hidden;
        object-fit: contain;
        position: absolute;
        top: 85%;
        left: 80%;
        animation: error 0.8s linear;
        animation-fill-mode: forwards;
        display: none;
    }

    .red {
        color: white;
    }

    @keyframes error {
        0% {
            transform: translate(0px, 0px);
        }

        25% {
            transform: translate(-150px, -200px);
            width: 100px;
            height: 100px;
        }

        50% {
            transform: translate(-700px, -300px);
            width: 440px;
            height: 440px;
        }

        75% {
            transform: translate(-40px, -700px);
            width: 150px;
            height: 150px;
        }

        100% {
            transform: translate(-120px, -700px);
            width: 350px;
            height: 350px;
        }
    }
</style>

<div class="row memberEdit mt-3">
        <div class="d-flex justify-content-center">
            <div class="card">
                <form name="form" onsubmit="sendData(); return false;" novoalidate>
                    <input type="hidden" name="mem_sid" value="<?= $memLogin['sid'] ?>">
                    <div class="card-body">
                        <div class="d-flex justify-content-center">
                            <div class="mb-3">
                                <label for="mem_account" class="form-label">帳號</label>
                                <!-- require 表示必填 -->
                                <input type="text" class="form-control" id="mem_account" name="mem_account" require value="<?= htmlentities($memLogin['mem-account']) ?>">
                                <div class="form-text red"></div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-around">
                            <!-- novoalidate 不要用HTML5的檢查方式 -->
                            <div class="col-3">
                                <div class="mb-3">
                                    <label for="mem_name" class="form-label">姓名</label>
                                    <!-- require 表示必填 -->
                                    <input type="text" class="form-control" id="mem_name" name="mem_name" require value="<?= htmlentities($memLogin['mem-name']) ?>">
                                    <div class="form-text red"></div>
                                </div>
                                <div class="mb-3">
                                    <label for="mem_mobile" class="form-label">手機</label>
                                    <!-- pattern 設定輸入格式 -->
                                    <input type="text" class="form-control" id="mem_mobile" name="mem_mobile" pattern="09\d{2}-?\d{3}-?\d{3}" value="<?= htmlentities($memLogin['mem-mobile']) ?>">
                                    <div class="form-text red"></div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="mb-3">
                                    <label for="mem_nickname" class="form-label">暱稱</label>
                                    <input type="text" class="form-control" id="mem_nickname" name="mem_nickname" value="<?= htmlentities($memLogin['mem-nickname']) ?>">
                                    <div class="form-text red"></div>
                                </div>
                                <div class="mb-3">
                                    <label for="mem_birthday" class="form-label">生日</label>
                                    <input type="date" class="form-control" id="mem_birthday" name="mem_birthday" value="<?= ($memLogin['mem-birthday']) ?>">
                                    <div class="form-text"></div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center">
                            <div class="mb-3 col-6">
                                <label for="mem_email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="mem_email" name="mem_email" value="<?= htmlentities($memLogin['mem-email']) ?>">
                                <div class="form-text red"></div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center">
                            <div class="mb-3 col-6">
                                <label for="mem_address" class="form-label">地址</label>
                                <textarea class="form-control" name="mem_address" id="mem_address" cols="30" rows="1"><?= htmlentities($memLogin['mem-address']) ?></textarea>
                                <div class="form-text"></div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="javascript: delete_it(<?= $memLogin['sid'] ?>)" class="btn btn-primary login">刪除帳號</a>
                            <button type="submit" class="btn btn-primary">確認修改</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


<?php include __DIR__ . '/parts/scripts.php' ?>

<script>
    function delete_it(sid) {
        // 跳詢問視窗
        if (confirm(`確定要刪除此帳號嗎?`)) {
            // 如館按確定 轉到刪除檔
            location.href = `gary-memself-del.php?sid=${sid}`;
        }
    }

    // 設定eamil格式
    const email_re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zAZ]{2,}))$/;
    // 設定手機格式
    const mobile_re = /^09\d{2}-?\d{3}-?\d{3}$/;

    // 取得該欄位的參照
    const name_f = document.form.mem_name;
    const account_f = document.form.mem_account;
    const email_f = document.form.mem_email;
    const mobile_f = document.form.mem_mobile;

    // 檢查的
    // 把這些欄位放進一個陣列裡面
    const fields = [name_f, account_f, email_f, mobile_f];
    // 建立一個空陣列
    const fieldTexts = [];
    // 把fields這些欄位的下一個Element放進上面的空陣列
    for (let f of fields) {
        fieldTexts.push(f.nextElementSibling);
    }


    async function sendData() {
        //如果符合格式讓欄位的外觀回復原來的狀態
        for (let i in fields) {
            // 讓文字內容變回空值
            fieldTexts[i].innerText = '';
        }

        // TODO: 欄位檢查, 前端的檢查
        // 這個變數是來判斷欄位有沒有通過檢查
        let isPass = true; // 預設是通過檢查的

        // 如果這個欄位的值的長度小於2
        if (name_f.value.length < 2) {
            // 寫入
            fieldTexts[0].innerText = '姓名至少兩個字';
            // 沒通過檢查
            isPass = false;
        }

        if (account_f.value === '') {
            // 寫入
            fieldTexts[1].innerText = '請輸入帳號';
            // 沒通過檢查
            isPass = false;
        }

        // 有填內容但不符合格式 裡面的值符不符合設定的格式
        if (email_f.value && !email_re.test(email_f.value)) {
            // alert('email 格式錯誤');
            fieldTexts[2].innerText = 'email 格式錯誤';
            isPass = false;
        }
        // 有填內容但不符合格式
        if (mobile_f.value && !mobile_re.test(mobile_f.value)) {
            // alert('手機號碼格式錯誤');
            fieldTexts[3].innerText = '手機號碼格式錯誤';
            isPass = false;
        }

        // 如果isPass是false 程式碼就不要繼續往下走
        if (!isPass) {
            return; // 結束函式
        }

        // 把整個表單內容抓出來
        const fd = new FormData(document.form);

        // 把表單送給誰
        const r = await fetch('gary-MemEdit-api.php', {
            method: 'POST',
            body: fd,
        });

        // 回傳的資料是JSON 轉回JS的陣列
        const result = await r.json();

        console.log(result);


        // 如果新增成功 success=true
        if (result.success) {
            alert('修改成功');
            location.href = 'gary-Member.php';
        }

    }
</script>

<?php include __DIR__ . '/parts/html-foot.php' ?>