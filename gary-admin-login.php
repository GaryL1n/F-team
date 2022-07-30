<?php
require __DIR__ . '/parts/connect_db.php';
$title = 'Gary-Login';
$pageName = 'Login';
?>
<?php include __DIR__ . '/parts/html-head.php' ?>
<?php include __DIR__ . '/parts/product-list.php' ?>

<style>
    body {
        background: url('./gary-img/1e684d15ad21997f1a92adfae922cfe5.gif')center center/cover;
        background-attachment: fixed;
    }

    .list-section {
        display: none;
    }

    .card {
        margin-top: 40%;
        width: 100%;
        border: 3px solid black;
    }

    .register-title {
        text-align: center;
        font-weight: 700;
        font-size: 2rem;
        width: 100%;
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

    .btn {
        width: 50%;
        background: white;
        color: black;
    }

    .red {
        color: red;
    }

    #info-bar {
        text-align: center;
    }
</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <form name="form1" onsubmit="sendData(); return false;" novoalidate>
                    <div class="card-body">
                        <h5 class="register-title mb-5 mt-3">LOGIN</h5>
                        <div class="mb-5">
                            <input type="text" class="form-control" name="ad_account" placeholder="Admin Username" require>
                            <div class="form-text red accword-red"></div>
                        </div>
                        <div class="mb-5">
                            <div class="form-control d-flex justify-content-between">
                                <input type="password" class="form-control eyes-input" name="ad_password" placeholder="Admin Password" require>
                                <a class="eyes d-flex align-items-center" onclick="togglePwd()">
                                    <img src="./gary-img/eyes_off.png" alt="" id="eyes">
                                </a>
                            </div>
                            <div class="form-text red password-red"></div>
                        </div>
                        <p id="info-bar" class="red" style="display:none;"></p>
                        <div class="mb-3 d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary btn-lg">登入</button>
                        </div>
                        <div class="d-flex justify-content-end">
                            <a href="gary-member-login.php" class="text-decoration-none">
                                <p>切換至一般會員</p>
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/parts/scripts.php' ?>

<script>
    const password_f = document.form1.ad_password;
    const account_f = document.form1.ad_account;

    // 查看密碼的眼睛
    const eyes = document.querySelector('#eyes');
    const pwd = () => {
        password_f.setAttribute('type', 'password');
    };
    const seePwd = () => {
        password_f.setAttribute('type', 'text');
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

    async function sendData() {

        let isPass = true;
        if (account_f.value === '') {
            const accred = document.querySelector('.accword-red');
            // 寫入
            accred.innerText = '請輸入帳號';
            // 沒通過檢查
            isPass = false;
        }

        if (password_f.value === '') {
            const passred = document.querySelector('.password-red');
            // 寫入
            passred.innerText = '請輸入密碼';
            // 沒通過檢查
            isPass = false;
        }

        // 如果isPass是false 程式碼就不要繼續往下走
        if (!isPass) {
            return; // 結束函式
        }

        // 把整個表單內容抓出來
        const fd = new FormData(document.form1);

        // 把表單送給誰
        const r = await fetch('gary-ad-login-api.php', {
            method: 'POST',
            body: fd,
        });
        // .then(d=>d.json())
        // .then(d=>{
        //     console.log(d);
        // })

        // 回傳的資料是JSON 轉回JS的陣列
        const result = await r.json();

        console.log(result);

        const info_bar = document.querySelector('#info-bar');


        // 如果成功 success=true
        if (result.success) {
            setTimeout(() => {
                location.href = 'gary-mem-list-true.php'; //跳轉到列表頁
            }, 1000);
            // 如果失敗 success=false
        } else {
            info_bar.style.display = 'block'; //顯示提示訊息
            info_bar.innerText = result.error || '帳號或密碼錯誤';
        }
    }
</script>

<?php include __DIR__ . '/parts/html-foot.php' ?>