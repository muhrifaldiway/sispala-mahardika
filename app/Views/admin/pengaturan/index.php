<?php

$pageTitle = 'Pengaturan Website';

$activeMenu = 'pengaturan';

ob_start();

?>


<style>

    .setting-card {
        border: 0;
        border-radius: 20px;
        overflow: hidden;
    }


    .setting-section {
        color: #0a2f27;
        font-weight: 700;
        font-size: 16px;
    }


    .setting-icon {
        width: 40px;
        height: 40px;

        display: inline-flex;

        align-items: center;
        justify-content: center;

        border-radius: 11px;

        background: rgba(239, 108, 49, .12);

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


    textarea.form-control {
        min-height: 110px;
    }


    .form-control:focus,
    .form-select:focus {

        border-color: #ef6c31;

        box-shadow:
            0 0 0 .2rem
            rgba(239, 108, 49, .12);
    }


    .logo-upload {

        border: 2px dashed #d9dee7;

        border-radius: 16px;

        padding: 30px;

        text-align: center;

        background: #fafbfc;
    }


    .logo-preview {

        width: 130px;
        height: 130px;

        object-fit: contain;

        border-radius: 18px;

        background: #fff;

        border: 1px solid #e5e7eb;

        padding: 10px;

        margin-bottom: 18px;

        box-shadow:
            0 5px 20px
            rgba(0,0,0,.08);
    }


    .logo-placeholder {

        width: 130px;
        height: 130px;

        display: flex;

        align-items: center;
        justify-content: center;

        margin: 0 auto 18px;

        border-radius: 18px;

        background: rgba(10, 47, 39,.06);

        color: #0a2f27;

        font-size: 45px;
    }


    .form-divider {

        border-top: 1px solid #edf0f4;

        margin: 30px 0;
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


    .social-prefix {

        background: #f8fafc;

        border-color: #dee3ea;

        color: #64748b;
    }

</style>


<!-- HEADER -->

<div class="mb-4">

    <h4
        class="fw-bold mb-1"
        style="color:#0a2f27;"
    >

        Pengaturan Website

    </h4>


    <p class="text-muted mb-0">

        Kelola informasi utama website
        SISPALA Mahardika.

    </p>

</div>


<!-- SUCCESS -->

<?php if (isset($_SESSION['success'])): ?>

    <div
        class="alert alert-success border-0 shadow-sm rounded-3"
    >

        <i class="bi bi-check-circle me-2"></i>

        <?= htmlspecialchars($_SESSION['success']); ?>

    </div>


    <?php unset($_SESSION['success']); ?>

<?php endif; ?>


<!-- ERROR -->

<?php if (isset($_SESSION['error'])): ?>

    <div
        class="alert alert-danger border-0 shadow-sm rounded-3"
    >

        <i class="bi bi-exclamation-circle me-2"></i>

        <?= htmlspecialchars($_SESSION['error']); ?>

    </div>


    <?php unset($_SESSION['error']); ?>

<?php endif; ?>


<!-- CARD -->

<div class="card setting-card shadow-sm">

    <div class="card-body p-4 p-lg-5">


        <form
            method="POST"
            action="<?= BASE_URL ?>/admin/pengaturan/update"
            enctype="multipart/form-data"
        >


            <input
                type="hidden"
                name="id"
                value="<?= htmlspecialchars($pengaturan['id']); ?>"
            >


            <!-- ================================================= -->
            <!-- INFORMASI WEBSITE -->
            <!-- ================================================= -->

            <div
                class="d-flex align-items-center gap-3 mb-4"
            >

                <div class="setting-icon">

                    <i class="bi bi-globe2"></i>

                </div>


                <div>

                    <div class="setting-section">

                        Informasi Website

                    </div>


                    <small class="text-muted">

                        Informasi utama website

                    </small>

                </div>

            </div>


            <div class="row g-4">


                <!-- NAMA WEBSITE -->

                <div class="col-md-6">

                    <label
                        class="form-label fw-semibold"
                    >

                        Nama Website

                        <span class="text-danger">
                            *
                        </span>

                    </label>


                    <input
                        type="text"
                        name="nama_website"
                        class="form-control"
                        value="<?= htmlspecialchars($pengaturan['nama_website'] ?? ''); ?>"
                        placeholder="Contoh: SISPALA Mahardika"
                        required
                    >

                </div>


                <!-- EMAIL -->

                <div class="col-md-6">

                    <label
                        class="form-label fw-semibold"
                    >

                        Email Website

                    </label>


                    <input
                        type="email"
                        name="email"
                        class="form-control"
                        value="<?= htmlspecialchars($pengaturan['email'] ?? ''); ?>"
                        placeholder="contoh@email.com"
                    >

                </div>


                <!-- DESKRIPSI -->

                <div class="col-12">

                    <label
                        class="form-label fw-semibold"
                    >

                        Deskripsi Website

                    </label>


                    <textarea
                        name="deskripsi"
                        class="form-control"
                        placeholder="Tuliskan deskripsi singkat website..."
                    ><?= htmlspecialchars($pengaturan['deskripsi'] ?? ''); ?></textarea>

                </div>


            </div>


            <div class="form-divider"></div>


            <!-- ================================================= -->
            <!-- LOGO -->
            <!-- ================================================= -->

            <div
                class="d-flex align-items-center gap-3 mb-4"
            >

                <div class="setting-icon">

                    <i class="bi bi-image"></i>

                </div>


                <div>

                    <div class="setting-section">

                        Logo Website

                    </div>


                    <small class="text-muted">

                        Logo yang digunakan pada website

                    </small>

                </div>

            </div>


            <div class="logo-upload">


                <?php if (!empty($pengaturan['logo'])): ?>

                    <img
                        id="logoPreview"
                        src="<?= BASE_URL ?>/uploads/logo/<?= htmlspecialchars($pengaturan['logo']); ?>"
                        alt="Logo Website"
                        class="logo-preview"
                    >

                <?php else: ?>

                    <img
                        id="logoPreview"
                        class="logo-preview"
                        alt="Preview Logo"
                        style="display:none;"
                    >

                <?php endif; ?>


                <?php if (empty($pengaturan['logo'])): ?>

                    <div
                        id="logoPlaceholder"
                        class="logo-placeholder"
                    >

                        <i class="bi bi-image"></i>

                    </div>

                <?php else: ?>

                    <div
                        id="logoPlaceholder"
                        class="logo-placeholder"
                        style="display:none;"
                    >

                        <i class="bi bi-image"></i>

                    </div>

                <?php endif; ?>


                <h6 class="fw-bold mb-1">

                    Upload Logo

                </h6>


                <p class="text-muted small mb-3">

                    JPG, PNG, atau WEBP maksimal 2 MB.

                </p>


                <input
                    type="file"
                    name="logo"
                    id="logo"
                    class="form-control mx-auto"
                    style="max-width:400px;"
                    accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp"
                >

            </div>


            <div class="form-divider"></div>


            <!-- ================================================= -->
            <!-- KONTAK -->
            <!-- ================================================= -->

            <div
                class="d-flex align-items-center gap-3 mb-4"
            >

                <div class="setting-icon">

                    <i class="bi bi-telephone"></i>

                </div>


                <div>

                    <div class="setting-section">

                        Informasi Kontak

                    </div>


                    <small class="text-muted">

                        Informasi yang dapat dihubungi pengunjung

                    </small>

                </div>

            </div>


            <div class="row g-4">


                <!-- NO HP -->

                <div class="col-md-6">

                    <label
                        class="form-label fw-semibold"
                    >

                        Nomor WhatsApp / HP

                    </label>


                    <input
                        type="text"
                        name="no_hp"
                        class="form-control"
                        value="<?= htmlspecialchars($pengaturan['no_hp'] ?? ''); ?>"
                        placeholder="081234567890"
                    >

                </div>


                <!-- ALAMAT -->

                <div class="col-12">

                    <label
                        class="form-label fw-semibold"
                    >

                        Alamat

                    </label>


                    <textarea
                        name="alamat"
                        class="form-control"
                        placeholder="Alamat organisasi..."
                    ><?= htmlspecialchars($pengaturan['alamat'] ?? ''); ?></textarea>

                </div>


            </div>


            <div class="form-divider"></div>


            <!-- ================================================= -->
            <!-- MEDIA SOSIAL -->
            <!-- ================================================= -->

            <div
                class="d-flex align-items-center gap-3 mb-4"
            >

                <div class="setting-icon">

                    <i class="bi bi-share"></i>

                </div>


                <div>

                    <div class="setting-section">

                        Media Sosial

                    </div>


                    <small class="text-muted">

                        Link media sosial organisasi

                    </small>

                </div>

            </div>


            <div class="row g-4">


                <!-- INSTAGRAM -->

                <div class="col-md-4">

                    <label
                        class="form-label fw-semibold"
                    >

                        Instagram

                    </label>


                    <input
                        type="url"
                        name="instagram"
                        class="form-control"
                        value="<?= htmlspecialchars($pengaturan['instagram'] ?? ''); ?>"
                        placeholder="https://instagram.com/..."
                    >

                </div>


                <!-- FACEBOOK -->

                <div class="col-md-4">

                    <label
                        class="form-label fw-semibold"
                    >

                        Facebook

                    </label>


                    <input
                        type="url"
                        name="facebook"
                        class="form-control"
                        value="<?= htmlspecialchars($pengaturan['facebook'] ?? ''); ?>"
                        placeholder="https://facebook.com/..."
                    >

                </div>


                <!-- YOUTUBE -->

                <div class="col-md-4">

                    <label
                        class="form-label fw-semibold"
                    >

                        YouTube

                    </label>


                    <input
                        type="url"
                        name="youtube"
                        class="form-control"
                        value="<?= htmlspecialchars($pengaturan['youtube'] ?? ''); ?>"
                        placeholder="https://youtube.com/..."
                    >

                </div>


            </div>


            <div class="form-divider"></div>


            <!-- ================================================= -->
            <!-- FOOTER -->
            <!-- ================================================= -->

            <div
                class="d-flex align-items-center gap-3 mb-4"
            >

                <div class="setting-icon">

                    <i class="bi bi-layout-text-window"></i>

                </div>


                <div>

                    <div class="setting-section">

                        Footer Website

                    </div>


                    <small class="text-muted">

                        Teks yang ditampilkan pada bagian footer

                    </small>

                </div>

            </div>


            <div>

                <label
                    class="form-label fw-semibold"
                >

                    Teks Footer

                </label>


                <input
                    type="text"
                    name="footer_text"
                    class="form-control"
                    value="<?= htmlspecialchars($pengaturan['footer_text'] ?? ''); ?>"
                    placeholder="© 2026 SISPALA Mahardika"
                >

            </div>


            <!-- ================================================= -->
            <!-- ACTION -->
            <!-- ================================================= -->

            <div class="form-divider"></div>


            <div
                class="d-flex justify-content-end"
            >

                <button
                    type="submit"
                    class="btn btn-orange"
                >

                    <i class="bi bi-save me-2"></i>

                    Simpan Pengaturan

                </button>

            </div>


        </form>

    </div>

</div>


<script>

document.addEventListener(
    'DOMContentLoaded',
    function () {


        const input =
            document.getElementById('logo');


        const preview =
            document.getElementById('logoPreview');


        const placeholder =
            document.getElementById('logoPlaceholder');


        if (!input) {

            return;

        }


        input.addEventListener(
            'change',
            function (event) {


                const file =
                    event.target.files[0];


                if (!file) {

                    return;

                }


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
                        'Logo harus JPG, PNG, atau WEBP.'
                    );


                    input.value = '';

                    return;

                }


                const maxSize =
                    2 * 1024 * 1024;


                if (
                    file.size > maxSize
                ) {

                    alert(
                        'Ukuran logo maksimal 2 MB.'
                    );


                    input.value = '';

                    return;

                }


                const reader =
                    new FileReader();


                reader.onload =
                    function (e) {


                        preview.src =
                            e.target.result;


                        preview.style.display =
                            'inline-block';


                        if (placeholder) {

                            placeholder.style.display =
                                'none';

                        }

                    };


                reader.readAsDataURL(file);

            }
        );

    }
);

</script>


<?php

$content = ob_get_clean();

require ROOT_PATH .
    '/app/Views/layouts/admin_layout.php';

?>