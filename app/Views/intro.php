<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistem Tryout</title>

    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('assets/css/theme.css?v=') . time() ?>">
    <!-- Fav Icon -->
    <link rel="icon" type="image/x-icon" href="">
</head>

<body>
    <div class="wrapper intro-wraper">
        <div class="content-intro">
            <div class="text-info">Prepare yourself before the real exam.</div>
            <div class="img-container">
                <img class="logo-intro" src="<?= base_url('assets/img/intro-logo.svg') ?>" alt="Logo" />
            </div>
            <div class="text-highlight-info">Start Simulation!</div>
            <input type="hidden" id="txt_csrfname" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
            <button class="intro-go-button" onclick="goBtnHandle()">
                <div class="button-text-intro">GO &rarr;</div>
            </button>
        </div>
    </div>

    <script src="<?= base_url('assets/js/intro.js?v=') . time()  ?>"></script>
</body>

</html>