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
            <div class="text-info">Your Score!</div>
            <div class="result-container">
                <span class="score">100</span>
            </div>
            <button class="intro-go-button" onclick="restartBtnHandle()">
                <div class="button-text-intro">Restart</div>
            </button>
        </div>
    </div>

    <!-- jQuery -->
    <script src="<?= base_url('assets/js/jquery.min.js') ?>"></script>
    <script>
        const restartBtnHandle = () => {
            var baseUrl = window.location.origin;
            window.location.replace(baseUrl)
        }
    </script>
</body>

</html>