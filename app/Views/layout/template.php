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
    <div class="loader-container">
        <div class="loader"></div>
    </div>
    <?= $this->include('layout/navbar'); ?>
    <?= $this->renderSection('content'); ?>

    <!-- MD5 Script -->
    <script src="<?= base_url('assets/js/md5.js') ?>"></script>
    <!-- PreventAccess -->
    <script src="<?= base_url('assets/js/prevent-access.js') ?>"></script>
</body>

</html>