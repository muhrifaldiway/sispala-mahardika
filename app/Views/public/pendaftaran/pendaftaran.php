<?php

$pageTitle = 'Pendaftaran';

$activeMenu = 'pendaftaran';

ob_start();

$old =
    $_SESSION['old']
    ?? [];

?>

<style>
    .registration-wrapper {
        max-width: 1000px;
        margin: auto;
    }

    .registration-card {
        border: 0;
        border-radius: 22px;
        box-shadow: 0 10px 40px rgba(0,0,0,.08);
        overflow: hidden;
    }

    .registration-header {
        background: #0B1F3A;
        color: white;
        padding: 35px;
    }

    .registration-header h2 {
        font-weight: 800;
    }

    .form-label {
        font-weight: 600;
        color: #25344d;
    }

    .form-control,
    .form-select {
        border-radius: 10px;
        min-height: 46px;
        border-color: #dee3ea;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #F28C28;
        box-shadow: 0 0 0 .2rem rgba(242,140,40,.12);
    }

    textarea.form-control {
        min-height: 120px;
    }

    .btn-register {
        background: #F28C28;
        color: white;
        border-color: #F28C28;
        border-radius: 10px;
        padding: 12px 25px;
        font-weight: 700;
    }

    .btn-register:hover {
        background: #D97816;
        color: white;
    }
</style>


<div class="py-5">

    <div class="container">

        <div class="registration-wrapper">


            <!-- HEADER -->

            <div class="text-center mb-5">

                <span
                    class="badge rounded-pill px-3 py-2 mb-3"
                    style="background:#FFF0E6;color:#F28C28;"
                >
                    Bergabung Bersama Kami
                </span>

                <h1
                    class="fw-bold"
                    style="color:#0B1F3A;"
                >
                    Formulir Pendaftaran
                </h1>

                <p class="text-muted">
                    Daftarkan diri Anda untuk menjadi anggota
                    SISPALA Mahardika.
                </p>

            </div>


            <!-- SUCCESS -->

            <?php if (!empty($_SESSION['success'])): ?>

                <div class="alert alert-success border-0 shadow-sm rounded-3">

                    <i class="bi bi-check-circle me-2"></i>

                    <?= htmlspecialchars(
                        $_SESSION['success']
                    ) ?>

                </div>

                <?php unset(
                    $_SESSION['success']
                ); ?>

            <?php endif; ?>


            <!-- ERROR -->

            <?php if (!empty($_SESSION['error'])): ?>

                <div class="alert alert-danger border-0 shadow-sm rounded-3">

                    <i class="bi bi-exclamation-circle me-2"></i>

                    <?= htmlspecialchars(
                        $_SESSION['error']
                    ) ?>

                </div>

                <?php unset(
                    $_SESSION['error']
                ); ?>

            <?php endif; ?>


            <!-- FORM -->

            <div class="card registration-card">

                <div class="registration-header">

                    <h2 class="mb-2">
                        Data Calon Anggota
                    </h2>

                    <p class="mb-0 opacity-75">
                        Isi data dengan benar dan lengkap.
                    </p>

                </div>


                <div class="card-body p-4 p-lg-5">

                    <form
                        method="POST"
                        action="<?= BASE_URL ?>/pendaftaran"
                    >


                        <!-- DATA PRIBADI -->

                        <h5
                            class="fw-bold mb-4"
                            style="color:#0B1F3A;"
                        >
                            Data Pribadi
                        </h5>


                        <div class="row g-4">


                            <!-- NAMA -->

                            <div class="col-md-6">

                                <label class="form-label">

                                    Nama Lengkap
                                    <span class="text-danger">*</span>

                                </label>

                                <input
                                    type="text"
                                    name="nama_lengkap"
                                    class="form-control"
                                    value="<?= htmlspecialchars(
                                        $old['nama_lengkap'] ?? ''
                                    ) ?>"
                                    required
                                >

                            </div>


                            <!-- NIS -->

                            <div class="col-md-6">

                                <label class="form-label">
                                    NIS
                                </label>

                                <input
                                    type="text"
                                    name="nis"
                                    class="form-control"
                                    value="<?= htmlspecialchars(
                                        $old['nis'] ?? ''
                                    ) ?>"
                                >

                            </div>


                            <!-- JENIS KELAMIN -->

                            <div class="col-md-4">

                                <label class="form-label">

                                    Jenis Kelamin
                                    <span class="text-danger">*</span>

                                </label>

                                <select
                                    name="jenis_kelamin"
                                    class="form-select"
                                    required
                                >

                                    <option value="">
                                        Pilih
                                    </option>

                                    <option
                                        value="L"
                                        <?= ($old['jenis_kelamin'] ?? '') === 'L'
                                            ? 'selected'
                                            : '' ?>
                                    >
                                        Laki-laki
                                    </option>

                                    <option
                                        value="P"
                                        <?= ($old['jenis_kelamin'] ?? '') === 'P'
                                            ? 'selected'
                                            : '' ?>
                                    >
                                        Perempuan
                                    </option>

                                </select>

                            </div>


                            <!-- KELAS -->

                            <div class="col-md-4">

                                <label class="form-label">
                                    Kelas
                                </label>

                                <input
                                    type="text"
                                    name="kelas"
                                    class="form-control"
                                    value="<?= htmlspecialchars(
                                        $old['kelas'] ?? ''
                                    ) ?>"
                                    placeholder="Contoh: XI RPL"
                                >

                            </div>


                            <!-- ANGKATAN -->

                            <div class="col-md-4">

                                <label class="form-label">
                                    Angkatan
                                </label>

                                <input
                                    type="text"
                                    name="angkatan"
                                    class="form-control"
                                    value="<?= htmlspecialchars(
                                        $old['angkatan'] ?? ''
                                    ) ?>"
                                    placeholder="Contoh: 2026"
                                >

                            </div>


                            <!-- TEMPAT LAHIR -->

                            <div class="col-md-6">

                                <label class="form-label">
                                    Tempat Lahir
                                </label>

                                <input
                                    type="text"
                                    name="tempat_lahir"
                                    class="form-control"
                                    value="<?= htmlspecialchars(
                                        $old['tempat_lahir'] ?? ''
                                    ) ?>"
                                >

                            </div>


                            <!-- TANGGAL LAHIR -->

                            <div class="col-md-6">

                                <label class="form-label">
                                    Tanggal Lahir
                                </label>

                                <input
                                    type="date"
                                    name="tanggal_lahir"
                                    class="form-control"
                                    value="<?= htmlspecialchars(
                                        $old['tanggal_lahir'] ?? ''
                                    ) ?>"
                                >

                            </div>


                            <!-- HP -->

                            <div class="col-md-6">

                                <label class="form-label">
                                    Nomor HP / WhatsApp
                                </label>

                                <input
                                    type="tel"
                                    name="no_hp"
                                    class="form-control"
                                    value="<?= htmlspecialchars(
                                        $old['no_hp'] ?? ''
                                    ) ?>"
                                >

                            </div>


                            <!-- ALAMAT -->

                            <div class="col-12">

                                <label class="form-label">
                                    Alamat
                                </label>

                                <textarea
                                    name="alamat"
                                    class="form-control"
                                ><?= htmlspecialchars(
                                    $old['alamat'] ?? ''
                                ) ?></textarea>

                            </div>

                        </div>


                        <hr class="my-5">


                        <!-- MOTIVASI -->

                        <h5
                            class="fw-bold mb-4"
                            style="color:#0B1F3A;"
                        >
                            Tentang Diri Anda
                        </h5>


                        <div class="row g-4">


                            <div class="col-12">

                                <label class="form-label">
                                    Alasan Bergabung
                                </label>

                                <textarea
                                    name="alasan"
                                    class="form-control"
                                    placeholder="Ceritakan alasan Anda ingin bergabung..."
                                ><?= htmlspecialchars(
                                    $old['alasan'] ?? ''
                                ) ?></textarea>

                            </div>


                            <div class="col-12">

                                <label class="form-label">
                                    Pengalaman
                                </label>

                                <textarea
                                    name="pengalaman"
                                    class="form-control"
                                    placeholder="Ceritakan pengalaman organisasi, kegiatan alam, atau pengalaman lainnya..."
                                ><?= htmlspecialchars(
                                    $old['pengalaman'] ?? ''
                                ) ?></textarea>

                            </div>

                        </div>


                        <hr class="my-5">


                        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">

                            <div class="small text-muted">

                                <span class="text-danger">*</span>

                                Wajib diisi

                            </div>


                            <button
                                type="submit"
                                class="btn btn-register"
                            >

                                <i class="bi bi-send me-2"></i>

                                Kirim Pendaftaran

                            </button>

                        </div>


                    </form>

                </div>

            </div>

        </div>

    </div>

</div>


<?php

unset(
    $_SESSION['old']
);

$content = ob_get_clean();

require ROOT_PATH . '/app/Views/layouts/public_layout.php';