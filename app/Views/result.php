<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Preliminary Test Constrain 2023</title>

    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('assets/css/theme.css?v=') . time() ?>">
    <!-- Fav Icon -->
    <link rel="icon" type="image/x-icon" href="">
</head>

<body>
    <div class="loader-container">
        <div class="loader"></div>
    </div>
    <div class="wrapper intro-wraper">
        <div class="content-intro">
            <div class="text-info" style="margin-bottom: 40px;">Thanks! I hope your prelimmiinary test results are good.</div>
            <input type="hidden" id="txt_csrfname" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
            <button class="intro-go-button" onclick="restartBtnHandle()">
                <div class="button-text-intro">HOME</div>
            </button>
        </div>
    </div>

    <!-- MD5 Script -->
    <script src="<?= base_url('assets/js/md5.js') ?>"></script>
    <!-- Calculate Result -->
    <script src="<?= base_url('assets/js/calculate-result.js?v=') . time()  ?>"></script>
    <!-- PreventAccess -->
    <script src="<?= base_url('assets/js/prevent-access.js') ?>"></script>
    <!-- Result Script -->
    <script src="<?= base_url('assets/js/result.js?v=') . time()  ?>"></script>
    <script>
        var getSession = localStorage.getItem('session_id');
        getSession = getSession ? JSON.parse(getSession) : {};

        var getSimulationResult = localStorage.getItem(getSession);
        getSimulationResult = JSON.parse(getSimulationResult)
        if (getSimulationResult) {
            getData(getSimulationResult);
        } else {
            window.location.href = window.location.origin + '/';
        }
    </script>
</body>

</html>