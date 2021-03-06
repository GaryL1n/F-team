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
                            <button type="submit" class="btn btn-primary btn-lg">??????</button>
                        </div>
                        <div class="d-flex justify-content-end">
                            <a href="gary-member-login.php" class="text-decoration-none">
                                <p>?????????????????????</p>
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

    // ?????????????????????
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
            // ??????
            accred.innerText = '???????????????';
            // ???????????????
            isPass = false;
        }

        if (password_f.value === '') {
            const passred = document.querySelector('.password-red');
            // ??????
            passred.innerText = '???????????????';
            // ???????????????
            isPass = false;
        }

        // ??????isPass???false ?????????????????????????????????
        if (!isPass) {
            return; // ????????????
        }

        // ??????????????????????????????
        const fd = new FormData(document.form1);

        // ??????????????????
        const r = await fetch('gary-ad-login-api.php', {
            method: 'POST',
            body: fd,
        });
        // .then(d=>d.json())
        // .then(d=>{
        //     console.log(d);
        // })

        // ??????????????????JSON ??????JS?????????
        const result = await r.json();

        console.log(result);

        const info_bar = document.querySelector('#info-bar');


        // ???????????? success=true
        if (result.success) {
            setTimeout(() => {
                location.href = 'gary-mem-list-true.php'; //??????????????????
            }, 1000);
            // ???????????? success=false
        } else {
            info_bar.style.display = 'block'; //??????????????????
            info_bar.innerText = result.error || '?????????????????????';
        }
    }
</script>

<?php include __DIR__ . '/parts/html-foot.php' ?>