<?php

$pageTitle = 'Edit Anggota';

$activeMenu = 'anggota';

ob_start();

?>

<style>

    .anggota-form-card {
        border: 0;
        border-radius: 20px;
        overflow: hidden;
    }

    .form-section-title {
        color: #0a2f27;
        font-weight: 700;
        font-size: 16px;
    }

    .form-section-icon {
        width: 38px;
        height: 38px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        background: rgba(239, 108, 49, 0.12);
        color: #ef6c31;
    }

    .form-label {
        color: #25344d;
        font-size: 14px;
        margin-bottom: 7px;
    }

    .form-control,
    .form-select {
        border-radius: 10px;
        border: 1px solid #dee3ea;
        padding: 10px 13px;
        min-height: 44px;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #ef6c31;
        box-shadow: 0 0 0 0.2rem rgba(239, 108, 49, 0.12);
    }

    .photo-upload {
        border: 2px dashed #d9dee7;
        border-radius: 16px;
        padding: 25px;
        text-align: center;
        background: #fafbfc;
        transition: all .2s ease;
    }

    .photo-upload:hover {
        border-color: #ef6c31;
        background: #fffaf5;
    }

    .photo-preview {
        width: 130px;
        height: 130px;
        object-fit: cover;
        border-radius: 50%;
        border: 4px solid #ffffff;
        box-shadow: 0 5px 20px rgba(0, 0, 0, .12);
        display: block;
        margin: 0 auto 15px;
    }

    .photo-icon {
        width: 65px;
        height: 65px;
        border-radius: 50%;
        background: rgba(10, 47, 39, .08);
        color: #0a2f27;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 15px;
        font-size: 27px;
    }

    .photo-upload input[type="file"] {
        max-width: 100%;
        font-size: 13px;
    }

    .required {
        color: #dc3545;
    }

    .form-divider {
        border-top: 1px solid #edf0f4;
        margin: 28px 0;
    }

    .btn-orange {
        background: #ef6c31;
        border-color: #ef6c31;
        color: #fff;
        border-radius: 10px;
        padding: 10px 20px;
        font-weight: 600;
    }

    .btn-orange:hover {
        background: #d97816;
        border-color: #d97816;
        color: #fff;
    }

    .btn-cancel {
        border-radius: 10px;
        padding: 10px 20px;
        font-weight: 600;
    }

    .page-back {
        color: #64748b;
        text-decoration: none;
        font-size: 14px;
    }

    .page-back:hover {
        color: #ef6c31;
    }

    .form-help {
        font-size: 12px;
        color: #8a94a6;
        margin-top: 5px;
    }

</style>


<!-- =========================================================
     HEADER
========================================================= -->

<div class="mb-4">

    <a
        href="<?= BASE_URL ?>/admin/anggota"
        class="page-back">

        <i class="bi bi-arrow-left me-1"></i>

        Kembali ke Anggota

    </a>


    <div class="mt-3">

        <h4
            class="fw-bold mb-1"
            style="color:#0a2f27;"
        >

            Edit Anggota

        </h4>

        <p class="text-muted mb-0">

            Perbarui data anggota SISPALA Mahardika.

        </p>

    </div>

</div>


<!-- =========================================================
     ALERT ERROR
========================================================= -->

<?php if (isset($_SESSION['error'])): ?>

    <div
        class="alert alert-danger
               border-0
               shadow-sm
               rounded-3"
    >

        <i class="bi bi-exclamation-circle me-2"></i>

        <?= htmlspecialchars($_SESSION['error']); ?>

    </div>

    <?php unset($_SESSION['error']); ?>

<?php endif; ?>


<!-- =========================================================
     FORM
========================================================= -->

<div class="card anggota-form-card shadow-sm">

    <div class="card-body p-4 p-lg-5">

        <form
            method="POST"
            action="<?= BASE_URL ?>/admin/anggota/update/<?= (int) $anggota['id']; ?>"
            enctype="multipart/form-data"
        >


            <!-- =================================================
                 DATA PRIBADI
            ================================================= -->

            <div class="d-flex align-items-center gap-3 mb-4">

                <div class="form-section-icon">

                    <i class="bi bi-person"></i>

                </div>

                <div>

                    <div class="form-section-title">
                        Data Pribadi
                    </div>

                    <small class="text-muted">
                        Informasi dasar anggota
                    </small>

                </div>

            </div>


            <div class="row g-4">


                <!-- NAMA -->

                <div class="col-md-6">

                    <label class="form-label fw-semibold">

                        Nama Lengkap

                        <span class="required">*</span>

                    </label>

                    <input
                        type="text"
                        name="nama"
                        class="form-control"
                        value="<?= htmlspecialchars($anggota['nama'] ?? ''); ?>"
                        placeholder="Masukkan nama lengkap"
                        autocomplete="off"
                        required
                    >

                </div>


                <!-- NIS -->

                <div class="col-md-6">

                    <label class="form-label fw-semibold">

                        NIS

                    </label>

                    <input
                        type="text"
                        name="nis"
                        class="form-control"
                        value="<?= htmlspecialchars($anggota['nis'] ?? ''); ?>"
                        placeholder="Masukkan nomor induk siswa"
                        autocomplete="off"
                    >

                </div>


                <!-- JENIS KELAMIN -->

                <div class="col-md-4">

                    <label class="form-label fw-semibold">

                        Jenis Kelamin

                        <span class="required">*</span>

                    </label>

                    <select
                        name="jenis_kelamin"
                        class="form-select"
                        required
                    >

                        <option value="">
                            Pilih jenis kelamin
                        </option>

                        <option
                            value="L"
                            <?= ($anggota['jenis_kelamin'] ?? '') === 'L'
                                ? 'selected'
                                : ''; ?>
                        >

                            Laki-laki

                        </option>

                        <option
                            value="P"
                            <?= ($anggota['jenis_kelamin'] ?? '') === 'P'
                                ? 'selected'
                                : ''; ?>
                        >

                            Perempuan

                        </option>

                    </select>

                </div>


                <!-- KELAS -->

                <div class="col-md-4">

                    <label class="form-label fw-semibold">

                        Kelas

                    </label>

                    <input
                        type="text"
                        name="kelas"
                        class="form-control"
                        value="<?= htmlspecialchars($anggota['kelas'] ?? ''); ?>"
                        placeholder="Contoh: XI RPL"
                    >

                </div>


                <!-- ANGKATAN -->

                <div class="col-md-4">

                    <label class="form-label fw-semibold">

                        Angkatan

                    </label>

                    <input
                        type="text"
                        name="angkatan"
                        class="form-control"
                        value="<?= htmlspecialchars($anggota['angkatan'] ?? ''); ?>"
                        placeholder="Contoh: 2026"
                    >

                </div>

            </div>


            <div class="form-divider"></div>


            <!-- =================================================
                 DATA ORGANISASI
            ================================================= -->

            <div class="d-flex align-items-center gap-3 mb-4">

                <div class="form-section-icon">

                    <i class="bi bi-people"></i>

                </div>

                <div>

                    <div class="form-section-title">
                        Data Organisasi
                    </div>

                    <small class="text-muted">
                        Informasi keanggotaan SISPALA
                    </small>

                </div>

            </div>


            <div class="row g-4">


                <!-- JABATAN -->

                <div class="col-md-6">

                    <label class="form-label fw-semibold">

                        Jabatan

                    </label>

                    <select
                        name="jabatan"
                        class="form-select"
                    >

                        <option value="">
                            Pilih jabatan
                        </option>

                        <option
                            value="Ketua"
                            <?= ($anggota['jabatan'] ?? '') === 'Ketua'
                                ? 'selected'
                                : ''; ?>
                        >
                            Ketua
                        </option>

                        <option
                            value="Wakil Ketua"
                            <?= ($anggota['jabatan'] ?? '') === 'Wakil Ketua'
                                ? 'selected'
                                : ''; ?>
                        >
                            Wakil Ketua
                        </option>

                        <option
                            value="Sekretaris"
                            <?= ($anggota['jabatan'] ?? '') === 'Sekretaris'
                                ? 'selected'
                                : ''; ?>
                        >
                            Sekretaris
                        </option>

                        <option
                            value="Bendahara"
                            <?= ($anggota['jabatan'] ?? '') === 'Bendahara'
                                ? 'selected'
                                : ''; ?>
                        >
                            Bendahara
                        </option>

                        <option
                            value="Koordinator"
                            <?= ($anggota['jabatan'] ?? '') === 'Koordinator'
                                ? 'selected'
                                : ''; ?>
                        >
                            Koordinator
                        </option>

                        <option
                            value="Anggota"
                            <?= ($anggota['jabatan'] ?? '') === 'Anggota'
                                ? 'selected'
                                : ''; ?>
                        >
                            Anggota
                        </option>

                    </select>

                </div>


                <!-- STATUS -->

                <div class="col-md-6">

                    <label class="form-label fw-semibold">

                        Status Keanggotaan

                    </label>

                    <select
                        name="status"
                        class="form-select"
                    >

                        <option
                            value="aktif"
                            <?= ($anggota['status'] ?? '') === 'aktif'
                                ? 'selected'
                                : ''; ?>
                        >
                            Aktif
                        </option>

                        <option
                            value="nonaktif"
                            <?= ($anggota['status'] ?? '') === 'nonaktif'
                                ? 'selected'
                                : ''; ?>
                        >
                            Nonaktif
                        </option>

                    </select>

                </div>


                <!-- NO HP -->

                <div class="col-md-6">

                    <label class="form-label fw-semibold">

                        Nomor HP / WhatsApp

                    </label>

                    <input
                        type="tel"
                        name="no_hp"
                        class="form-control"
                        value="<?= htmlspecialchars($anggota['no_hp'] ?? ''); ?>"
                        placeholder="Contoh: 081234567890"
                        autocomplete="off"
                    >

                </div>


                <!-- ALAMAT -->

                <div class="col-12">

                    <label class="form-label fw-semibold">

                        Alamat

                    </label>

                    <textarea
                        name="alamat"
                        class="form-control"
                        rows="4"
                        placeholder="Masukkan alamat lengkap anggota"
                    ><?= htmlspecialchars($anggota['alamat'] ?? ''); ?></textarea>

                </div>

            </div>


            <div class="form-divider"></div>


            <!-- =================================================
                 FOTO
            ================================================= -->

            <div class="d-flex align-items-center gap-3 mb-4">

                <div class="form-section-icon">

                    <i class="bi bi-camera"></i>

                </div>

                <div>

                    <div class="form-section-title">
                        Foto Anggota
                    </div>

                    <small class="text-muted">
                        Perbarui foto jika diperlukan
                    </small>

                </div>

            </div>


            <div class="photo-upload">


                <?php if (!empty($anggota['foto'])): ?>

                    <img
                        id="photoPreview"
                        src="<?= BASE_URL ?>/uploads/anggota/<?= htmlspecialchars($anggota['foto']); ?>"
                        class="photo-preview"
                        alt="<?= htmlspecialchars($anggota['nama']); ?>"
                    >

                <?php else: ?>

                    <img
                        id="photoPreview"
                        class="photo-preview"
                        alt="Preview Foto"
                        style="display:none;"
                    >

                <?php endif; ?>


                <div
                    id="photoIcon"
                    class="photo-icon"
                    style="<?= !empty($anggota['foto'])
                        ? 'display:none;'
                        : ''; ?>"
                >

                    <i class="bi bi-person"></i>

                </div>


                <h6 class="fw-bold mb-1">

                    Ganti Foto Anggota

                </h6>


                <p class="text-muted small mb-3">

                    JPG, JPEG, PNG, atau WEBP maksimal 2 MB

                </p>


                <input
                    type="file"
                    name="foto"
                    id="foto"
                    class="form-control"
                    accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp"
                >


                <div class="form-help">

                    Kosongkan jika ingin mempertahankan foto lama.

                </div>

            </div>


            <!-- =================================================
                 ACTION
            ================================================= -->

            <div class="form-divider"></div>


            <div
                class="d-flex
                       justify-content-between
                       align-items-center
                       flex-wrap
                       gap-3"
            >

                <div class="small text-muted">

                    <span class="required">*</span>

                    Wajib diisi

                </div>


                <div class="d-flex gap-2">

                    <a
                        href="<?= BASE_URL ?>/admin/anggota"
                        class="btn btn-light border btn-cancel"
                    >

                        Batal

                    </a>


                    <button
                        type="submit"
                        class="btn btn-orange"
                    >

                        <i class="bi bi-save me-2"></i>

                        Simpan Perubahan

                    </button>

                </div>

            </div>


        </form>

    </div>

</div>


<script>

document.addEventListener(
    'DOMContentLoaded',
    function () {

        const fotoInput =
            document.getElementById('foto');

        const preview =
            document.getElementById('photoPreview');

        const icon =
            document.getElementById('photoIcon');


        if (!fotoInput) {
            return;
        }


        fotoInput.addEventListener(
            'change',
            function (event) {

                const file =
                    event.target.files[0];


                if (!file) {
                    return;
                }


                /*
                |------------------------------------------
                | Validasi format
                |------------------------------------------
                */

                const allowedTypes = [
                    'image/jpeg',
                    'image/png',
                    'image/webp'
                ];


                if (
                    !allowedTypes.includes(
                        file.type
                    )
                ) {

                    alert(
                        'Format foto harus JPG, JPEG, PNG, atau WEBP.'
                    );

                    event.target.value = '';

                    return;
                }


                /*
                |------------------------------------------
                | Validasi ukuran
                |------------------------------------------
                */

                const maxSize =
                    2 * 1024 * 1024;


                if (
                    file.size > maxSize
                ) {

                    alert(
                        'Ukuran foto maksimal 2 MB.'
                    );

                    event.target.value = '';

                    return;
                }


                /*
                |------------------------------------------
                | Preview
                |------------------------------------------
                */

                const reader =
                    new FileReader();


                reader.onload =
                    function (e) {

                        preview.src =
                            e.target.result;

                        preview.style.display =
                            'block';

                        icon.style.display =
                            'none';

                    };


                reader.readAsDataURL(file);

            }
        );

    }
);

</script>


<?php

$content = ob_get_clean();

require ROOT_PATH . '/app/Views/layouts/admin_layout.php';

?>