<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="wrapper simulasi-wrapper">
    <div class="content-simulasi">
        <div class="container-body">
            <div class="container-no_soal">SOAL NOMOR <span id="question__number"></div>
            <div id="question__part" class="container-soal"></div>
            <div class="container-option">
                <div class="form-check" id="option_1" option-name='A'></div>
                <div class="form-check" id="option_2" option-name='B'></div>
                <div class="form-check" id="option_3" option-name='C'></div>
                <div class="form-check" id="option_4" option-name='D'></div>
                <div class="form-check" id="option_5" option-name='E'></div>
            </div>
            <div class="container-navigation">
                <input type="hidden" id="txt_csrfname" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                <button id="item_prev" class="prev-button">
                    <div class="button-text">Prev</div>
                </button>
                <button id="item_next" class="next-button">
                    <div class="button-text">Next</div>
                </button>
                <button id="item_selesai" disabled style="display: none;" id="item_next" class="next-button">
                    <div class="button-text">Submit</div>
                </button>
            </div>
        </div>
        <div id="question__number_side" class="container-sidebar"></div>
    </div>
</div>

<script src="<?= base_url('assets/js/countdown.js?v=') . time()  ?>"></script>
<script src="<?= base_url('assets/js/main.js?v=') . time()  ?>"></script>
<script>
    var getSession = localStorage.getItem('session_id');
    getSession = getSession ? JSON.parse(getSession) : {};

    getData();
</script>
<?= $this->endSection(); ?>