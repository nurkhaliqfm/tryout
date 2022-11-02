<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="wrapper simulasi-wrapper">
    <div class="content-simulasi">
        <div class="container-body">
            <div class="container-no_soal">SOAL NOMOR 1</div>
            <div class="container-soal">Siapakah Nama Anda ?</div>
            <div class="container-option">
                <div>Option A</div>
                <div>Option B</div>
                <div>Option C</div>
                <div>Option D</div>
                <div>Option E</div>
            </div>
            <div class="container-navigation">
                <button class="prev-button">
                    <div class="button-text">&larr;</div>
                </button>
                <button class="next-button">
                    <div class="button-text">&rarr;</div>
                </button>
            </div>
        </div>
        <?= $this->include('layout/sidebar'); ?>
    </div>
</div>
<script src="<?= base_url('assets/js/countdown.js') ?>"></script>
<script>
    const timer = 300;
    var getSession = localStorage.getItem('session_id');
    getSession = getSession ? JSON.parse(getSession) : {};
    new Timer(
        document.querySelector(".timer__countdown"), timer, getSession
    );
</script>
<?= $this->endSection(); ?>