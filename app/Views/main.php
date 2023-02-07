<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="wrapper simulasi-wrapper">
    <div class="item-timer timer__countdown">
        <div class="timer">
            <span>00</span>
            <span> : </span>
            <span>00</span>
        </div>
    </div>
    <div class="content-simulasi">
        <div class="container-body">
            <div class="container-no_soal">SOAL NOMOR <span id="question__number"></div>
            <div id="question__part" class="container-soal"></div>
            <div class="container-option">
                <div class="form-check" id="option_1" option-name='A'></div>
                <div class="form-check" id="option_2" option-name='B'></div>
                <div class="form-check" id="option_3" option-name='C'></div>
                <div class="form-check" id="option_4" option-name='D'></div>
            </div>
            <div class="container-navigation">
                <input type="hidden" id="txt_csrfname" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                <button id="item_prev" class="prev-button">
                    <div class="button-text">Prev</div>
                </button>
                <button id="item_next" class="next-button">
                    <div class="button-text">Next</div>
                </button>
                <button data-bs-toggle="modal" data-bs-target="#modelFinishTest" id="item_selesai" disabled style="display: none;" class="next-button">
                    <div class="button-text">Submit</div>
                </button>
            </div>
        </div>
        <div id="question__number_side" class="container-sidebar"></div>
    </div>
</div>

<div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="modelFinishTest" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header format-logo">
                <h5 class="modal-title">Warning !!!</h5>
            </div>
            <div class="modal-body" style="font-weight: 400;">
                Are you sure you want to finish the preliminary test.
            </div>
            <div class="modal-footer">
                <div class="button__container">
                    <button type="submit" class="modal-button" id="finish_button">
                        <div class="button-text">
                            Finish
                        </div>
                    </button>
                    <button class="modal-button" data-bs-dismiss="modal">
                        <div class="button-text">
                            Cancel
                        </div>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('visibilitychange', () => {
        if (document.visibilityState == "hidden") {
            var csrfName = document.getElementById("txt_csrfname").getAttribute("name");
            var csrfHash = document.getElementById("txt_csrfname").value;

            const data = {};
            data["key"] = "save_result";
            data[csrfName] = csrfHash;
            data["result"] = '0';

            var xhttp = new XMLHttpRequest();
            xhttp.open("POST", baseUrl + "/save-result", true);
            xhttp.onreadystatechange = () => {
                if (xhttp.readyState == 4 && xhttp.status == 200) {
                    var response = JSON.parse(xhttp.responseText);
                    document.getElementById("txt_csrfname").value = response["value"];
                    document.getElementById("txt_csrfname").name = response["name"];
                    window.location.replace(baseUrl + "/simulation-result");

                }
            };
            xhttp.setRequestHeader("X-Requested-With", "XMLHttpRequest");
            xhttp.setRequestHeader("Content-Type", "application/json");
            xhttp.send(JSON.stringify(data));
        };
    })
</script>

<script src="<?= base_url('assets/js/countdown.js?v=') . time()  ?>"></script>
<script src="<?= base_url('assets/js/main.js?v=') . time()  ?>"></script>
<script>
    var getSession = localStorage.getItem('session_id');
    getSession = getSession ? JSON.parse(getSession) : {};

    getData();
</script>
<?= $this->endSection(); ?>