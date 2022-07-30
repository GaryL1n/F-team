<?php
require __DIR__ . '/parts/connect_db.php';

$pageName = "密碼專區";
$title = "Gary-MemPassword";

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
    body {
        position: relative;
    }

    .passForm {
        margin-top: 160px;
        width: 30%;
        height: 300px;
        background-color: black;
    }

    .eyes-input {
        width: 90%;
    }

    .eyes {
        cursor: pointer;
    }

    .eyes img {
        width: 1.2rem;
    }

    .red {
        color: white;
    }

    .passBtn {
        margin-left: 40%;
    }

    .error {
        width: 60px;
        height: 60px;
        overflow: hidden;
        object-fit: contain;
        position: absolute;
        top: 70%;
        left: 90%;
        animation: error 0.8s linear;
        animation-fill-mode: forwards;
        display: none;
    }

    @keyframes error {
        0% {
            transform: translate(0px, 0px);
        }

        25% {
            transform: translate(-250px, -200px);
            width: 100px;
            height: 100px;
        }

        50% {
            transform: translate(-400px, -100px);
            width: 440px;
            height: 440px;
        }

        75% {
            transform: translate(-700px, -500px);
            width: 150px;
            height: 150px;
        }

        100% {
            transform: translate(-1300px, -200px);
            width: 450px;
            height: 450px;
        }
    }
</style>

<div>
        <img class="error" src="./gary-img/ebee6628b9bddb6fe101666410a58bb3.png" alt="">
    </div>
    <div class="row d-flex justify-content-center">
        <form class="passForm" name="form" onsubmit="sendPass(); return false;" novoalidate>
            <input type="hidden" name="mem_sid" value="<?= $memLogin['sid'] ?>">
            <input type="hidden" class="form-control" id="hidden_password" value="<?= htmlentities($memLogin['mem-password']) ?>">
            <div class="form-control d-flex justify-content-between mb-5">
                <input type="password" class="form-control eyes-input" id="your_password" name="your_password" require placeholder="Your Password">
                <a class="eyes d-flex align-items-center" onclick="togglePwd()">
                    <img src="./gary-img/eyes_off.png" alt="" id="eyes">
                </a>
            </div>
            <div class="form-control d-flex justify-content-between mb-5">
                <input type="password" class="form-control eyes-input" id="new_password" name="new_password" require placeholder="New Password">
                <a class="eyes d-flex align-items-center" onclick="togglePwd2()">
                    <img src="./gary-img/eyes_off.png" alt="" id="eyes2">
                </a>
            </div>
            <div class="form-text red text-center mb-3"></div>
            <button type="submit" class="btn btn-primary passBtn">更新密碼</button>
        </form>
    </div>

<?php include __DIR__ . '/parts/scripts.php' ?>

<script>
    const your_password = document.form.your_password;
    // 查看密碼的眼睛
    const eyes = document.querySelector('#eyes');
    const pwd = () => {
        your_password.setAttribute('type', 'password');
    };
    const seePwd = () => {
        your_password.setAttribute('type', 'text');
    };
    let isPwd = false;
    const togglePwd = () => {
        isPwd = !isPwd;
        if (isPwd) {
            eyes.src = './gary-img/eyes_off.png';
            pwd();
        } else {
            eyes.src = './gary-img/eyes_on.png';
            seePwd();
        }
    };

    const new_password = document.form.new_password;
    // 查看密碼的眼睛
    const eyes2 = document.querySelector('#eyes2');
    const pwd2 = () => {
        new_password.setAttribute('type', 'password');
    };
    const seePwd2 = () => {
        new_password.setAttribute('type', 'text');
    };

    const togglePwd2 = () => {
        isPwd = !isPwd;
        if (isPwd) {
            eyes2.src = './gary-img/eyes_off.png';
            pwd2();
        } else {
            eyes2.src = './gary-img/eyes_on.png';
            seePwd2();
        }
    };

    // 修改密碼專區
    async function sendPass() {

        const hidden_password = document.querySelector('#hidden_password');
        const your_password = document.querySelector('#your_password');
        const new_password = document.querySelector('#new_password');
        const passred = document.querySelector('.red');

        if (hidden_password.value === your_password.value) {
            // 把整個表單內容抓出來
            const fd = new FormData(document.form);

            // 把表單送給誰
            const r = await fetch('gary-mem-editPass-api.php', {
                method: 'POST',
                body: fd,
            });
            const result = await r.json();
            if (result.success) {
                alert('密碼已更新');
                location.href = 'gary-Member.php';
            } else {
                passred.innerText = '密碼更新失敗';
            }
        } else {
            passred.innerText = '密碼更新失敗';
            const error = document.querySelector('.error');
            error.style.display = 'block';
        }
    }
</script>

<?php include __DIR__ . '/parts/html-foot.php' ?>