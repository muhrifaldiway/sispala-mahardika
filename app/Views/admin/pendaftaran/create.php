<?php

$pageTitle = 'Tambah Pendaftaran';

$activeMenu = 'pendaftaran';

ob_start();

?>

<style>

    .form-card {
        border: 0;
        border-radius: 20px;
        overflow: hidden;
    }

    .section-title {
        color: #0a2f27;
        font-weight: 700;
        font-size: 16px;
    }

    .section-icon {
        width: 38px;
        height: 38px;
        border-radius: 10px;

        display: inline-flex;
        align-items: center;
        justify-content: center;

        background: rgba(239, 108, 49,.12);
        color: #ef6c31;
    }

    .form-label {
        font-size: 14px;
        color: #25344d;
        margin-bottom: 7px;
    }

    .form-control,
    .form-select {
        min-height: 44px;
        border-radius: 10px;
        border: 1px solid #dee3ea;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #ef6c31;
        box-shadow: 0 0 0 .2rem rgba(239, 108, 49,.12);
    }

    .divider {
        border-top: 1px solid #edf0f4;
        margin: 30px 0;
    }

    .btn-orange {
        background: #ef6c31;
        border-color: #ef6c31;
        color: white;
        border-radius: 10px;
        padding: 10px 20px;
        font-weight: 600;
    }

    .btn-orange:hover {
        background: #d97816;
        border-color: #d97816;
        color: white;
    }

</style>


<div class="mb-4">

    <a
        href="<?= BASE_URL ?>/admin/pendaftaran"
        class="text-decoration-none text-muted"
    >

        <i class="bi bi-arrow-left me-1"></i>

        Kembali ke Pendaftaran

    </a>


    <div class="mt-3">

        <h4
            class="fw-bold mb-1"
            style="color:#0a2f27;"
        >
            Tambah Pendaftaran
        </h4>

        <p class="text-muted mb-0">
            Tambahkan data calon anggota SISPALA Mahardika.
        </p>

    </div>

</div>


<?php if (isset($_SESSION['error'])): ?>

    <div class="alert alert-danger border-0 shadow-sm rounded-3">

        <?= htmlspecialchars($_SESSION['error']); ?>

    </div>

    <?php unset($_SESSION['error']); ?>

<?php endif; ?>


<div class="card form-card shadow-sm">

    <div class="card-body p-4 p-lg-5">

        <form
            method="POST"
            action="<?= BASE_URL ?>/admin/pendaftaran/store"
        >


            <!-- DATA PENDAFTAR -->

            <div class="d-flex align-items-center gap-3 mb-4">

                <div class="section-icon">

                    <i class="bi bi-person"></i>

                </div>

                <div>

                    <div class="section-title">
                        Data Pendaftar
                    </div>

                    <small class="text-muted">
                        Informasi dasar calon anggota
                    </small>

                </div>

            </div>


            <div class="row g-4">


                <div class="col-md-6">

                    <label class="form-label fw-semibold">
                        Nomor Pendaftaran
                    </label>

                    <input
                        type="text"
                        class="form-control"
                        value="<?= htmlspecialchars($nomor); ?>"
                        readonly
                    >

                    <small class="text-muted">
                        Nomor dibuat otomatis oleh sistem.
                    </small>

                </div>


                <div class="col-md-6">

                    <label class="form-label fw-semibold">
                        Nama Lengkap <span class="text-danger">*</span>
                    </label>

                    <input
                        type="text"
                        name="nama_lengkap"
                        class="form-control"
                        placeholder="Masukkan nama lengkap"
                        required
                    >

                </div>


                <div class="col-md-4">

                    <label class="form-label fw-semibold">
                        NIS
                    </label>

                    <input
                        type="text"
                        name="nis"
                        class="form-control"
                        placeholder="Nomor induk siswa"
                    >

                </div>


                <div class="col-md-4">

                    <label class="form-label fw-semibold">
                        Jenis Kelamin <span class="text-danger">*</span>
                    </label>

                    <select
                        name="jenis_kelamin"
                        class="form-select"
                        required
                    >

                        <option value="">
                            Pilih
                        </option>

                        <option value="L">
                            Laki-laki
                        </option>

                        <option value="P">
                            Perempuan
                        </option>

                    </select>

                </div>


                <div class="col-md-4">

                    <label class="form-label fw-semibold">
                        Kelas
                    </label>

                    <input
                        type="text"
                        name="kelas"
                        class="form-control"
                        placeholder="Contoh: X RPL"
                    >

                </div>


                <div class="col-md-6">

                    <label class="form-label fw-semibold">
                        Angkatan
                    </label>

                    <input
                        type="text"
                        name="angkatan"
                        class="form-control"
                        placeholder="Contoh: 2026"
                    >

                </div>


                <div class="col-md-6">

                    <label class="form-label fw-semibold">
                        Nomor HP / WhatsApp
                    </label>

                    <input
                        type="tel"
                        name="no_hp"
                        class="form-control"
                        placeholder="081234567890"
                    >

                </div>

            </div>


            <div class="divider"></div>


            <!-- DATA KELAHIRAN -->

            <div class="d-flex align-items-center gap-3 mb-4">

                <div class="section-icon">

                    <i class="bi bi-calendar"></i>

                </div>

                <div>

                    <div class="section-title">
                        Data Kelahiran
                    </div>

                    <small class="text-muted">
                        Informasi tempat dan tanggal lahir
                    </small>

                </div>

            </div>


            <div class="row g-4">


                <div class="col-md-6">

                    <label class="form-label fw-semibold">
                        Tempat Lahir
                    </label>

                    <input
                        type="text"
                        name="tempat_lahir"
                        class="form-control"
                        placeholder="Contoh: Ampana"
                    >

                </div>


                <div class="col-md-6">

                    <label class="form-label fw-semibold">
                        Tanggal Lahir
                    </label>

                    <input
                        type="date"
                        name="tanggal_lahir"
                        class="form-control"
                    >

                </div>


                <div class="col-12">

                    <label class="form-label fw-semibold">
                        Alamat
                    </label>

                    <textarea
                        name="alamat"
                        class="form-control"
                        rows="4"
                        placeholder="Masukkan alamat lengkap"
                    ></textarea>

                </div>

            </div>


            <div class="divider"></div>


            <!-- INFORMASI ORGANISASI -->

            <div class="d-flex align-items-center gap-3 mb-4">

                <div class="section-icon">

                    <i class="bi bi-mountain"></i>

                </div>

                <div>

                    <div class="section-title">
                        Informasi Keanggotaan
                    </div>

                    <small class="text-muted">
                        Alasan dan pengalaman organisasi
                    </small>

                </div>

            </div>


            <div class="row g-4">


                <div class="col-12">

                    <label class="form-label fw-semibold">
                        Alasan Ingin Bergabung
                    </label>

                    <textarea
                        name="alasan"
                        class="form-control"
                        rows="4"
                        placeholder="Tuliskan alasan ingin bergabung..."
                    ></textarea>

                </div>


                <div class="col-12">

                    <label class="form-label fw-semibold">
                        Pengalaman Organisasi / Kegiatan
                    </label>

                    <textarea
                        name="pengalaman"
                        class="form-control"
                        rows="4"
                        placeholder="Tuliskan pengalaman yang pernah dimiliki..."
                    ></textarea>

                </div>

            </div>


            <div class="divider"></div>


            <!-- ACTION -->

            <div class="d-flex justify-content-end gap-2">

                <a
                    href="<?= BASE_URL ?>/admin/pendaftaran"
                    class="btn btn-light border"
                >
                    Batal
                </a>


                <button
                    type="submit"
                    class="btn btn-orange"
                >

                    <i class="bi bi-save me-2"></i>

                    Simpan Pendaftaran

                </button>

            </div>


        </form>

    </div>

</div>


<?php

$content = ob_get_clean();

require ROOT_PATH . '/app/Views/layouts/admin_layout.php';

?>