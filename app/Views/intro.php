<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Preliminary Test Constrain 2023</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/fontawesome/css/all.min.css') ?>">
    <!-- Bootstrap 5 -->
    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('assets/css/theme.css?v=') . time() ?>">
    <!-- Fav Icon -->
    <link rel="icon" type="image/x-icon" href="<?= base_url('assets/img/logo.png?v=') . time() ?>">
</head>

<body>
    <div class="wrapper intro-wraper">
        <div class="toast">
            <div class="toast-content">
                <i class="fas fa-solid fa-times times"></i>
                <div class="message">
                    <span class="text text-1"></span>
                    <span class="text text-2"></span>
                </div>
            </div>
            <i class="fa-solid fa-xmark close"></i>
            <div class="progress"></div>
        </div>
        <div class="content-intro">
            <div class="text-info">Innovation for Sustainability of Manufacturing Industry to Accelerate National Economic Recovery</div>
            <div class="img-container">
                <img class="logo-intro" src="<?= base_url('assets/img/intro-logo.svg') ?>" alt="Logo" />
            </div>
            <div class="event-img">
                <img class="logo-event" src="<?= base_url('assets/img/UNHAS.png') ?>" alt="Logo" />
                <img class="logo-event" src="<?= base_url('assets/img/OKFT.png') ?>" alt="Logo" />
                <img class="logo-event" src="<?= base_url('assets/img/HMTI.png') ?>" alt="Logo" />
                <img class="logo-event" src="<?= base_url('assets/img/CONSTRAIN.png') ?>" alt="Logo" />
            </div>
            <div class="text-highlight-info">CONSTRAIN 2023 Preliminary Test!</div>
            <input type="hidden" id="txt_csrfname" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
            <button class="intro-go-button" type="button" data-bs-toggle="modal" data-bs-target="#modelLoginPeserta">
                <div class="button-text-intro">LOGIN</div>
            </button>
        </div>
    </div>

    <div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="modelLoginPeserta" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header format-logo">
                    <h5 class="modal-title">Preliminary Test Access Verification</h5>
                </div>
                <form>
                    <div class="modal-body">
                        <div class="form-floating mb-3">
                            <input name="email" type="email" class="form-control email" id="floatingInput" required placeholder="Masukkan Email">
                            <label for="floatingInput">Email</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input name="password" type="password" class="form-control password" id="floatingInput" required placeholder="Masukkan Password">
                            <label for="floatingInput">Password</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="button__container">
                            <button type="submit" class="modal-button">
                                <div class="button-text">
                                    Submit
                                </div>
                            </button>
                            <button class="modal-button" data-bs-dismiss="modal">
                                <div class="button-text">
                                    Cancel
                                </div>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="modelInfoPreliminaryTest" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header format-logo">
                    <h5 class="modal-title">Preliminary Test Information</h5>
                </div>
                <div class="modal-body" style="font-weight: 400;">
                    <ul>
                        <li>Preliminary test hanya dapat dikerjakan 1x. Jadi pastikan jaringan anda stabil saat mengerjakan test</li>
                        <li>Preliminary test terdiri dari 100 Soal yang dikerjakan selama 120 menit.</li>
                        <li>Terdapat 3 Jenis Soal yaitu Easy, Medium dan Hard dengan poin masing-masing soal Easy (Benar = +6, Salah = -4, Kosong = 0), Medium (Benar = +10, Salah = -7, Kosong = 0), dan Hard (Benar = +15, Salah = -10, Kosong = 0)</li>
                    </ul>
                </div>
                <div class="modal-footer">
                    <div class="button__container">
                        <button type="submit" class="modal-button" onclick="goBtnHandle()">
                            <div class="button-text">
                                Start Preliminary Test
                            </div>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.querySelector('form').addEventListener('submit', e => {
            e.preventDefault();
            loginBtnHandle();
        })
    </script>

    <!-- jQuery -->
    <script src="<?= base_url('assets/js/jquery.min.js') ?>"></script>
    <!-- Bootstrap 5 -->
    <script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>
    <!-- My Script -->
    <script src="<?= base_url('assets/js/intro.js?v=') . time()  ?>"></script>
</body>

</html>