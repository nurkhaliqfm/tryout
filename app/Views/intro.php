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

    <!-- jQuery -->
    <script src="<?= base_url('assets/js/jquery.min.js') ?>"></script>
    <script>
        var baseUrl = window.location.origin;
        const XhttpSession = () => {
            var csrfName = document.getElementById('txt_csrfname').getAttribute('name');
            var csrfHash = document.getElementById('txt_csrfname').value;

            const data = {};
            data["key"] = 'session';
            data[csrfName] = csrfHash;

            var xhttp = new XMLHttpRequest();
            xhttp.open("POST", baseUrl + '/session-create', true);
            xhttp.onreadystatechange = () => {
                if (xhttp.readyState == 4 && xhttp.status == 200) {
                    var response = JSON.parse(xhttp.responseText);
                    document.getElementById("txt_csrfname").value = response["value"];
                    document.getElementById("txt_csrfname").name = response["name"];

                    let session = response["session_id"];
                    localStorage.setItem('session_id', JSON.stringify(session));
                    window.location.replace(baseUrl + '/online-simulation');
                }
            };
            xhttp.setRequestHeader("X-Requested-With", "XMLHttpRequest");
            xhttp.setRequestHeader("Content-Type", "application/json");
            xhttp.send(JSON.stringify(data));
        }
        const goBtnHandle = () => {
            XhttpSession();
        }
    </script>
</body>

</html>