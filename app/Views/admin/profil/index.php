<?php

$pageTitle = 'Profil Organisasi';

$activeMenu = 'profil';

ob_start();

?>

<style>

    .profil-card {
        border: 0;
        border-radius: 20px;
        overflow: hidden;
    }

    .section-title {
        font-weight: 700;
        color: #0a2f27;
        font-size: 17px;
    }

    .section-icon {
        width: 42px;
        height: 42px;
        border-radius: 12px;

        display: flex;
        align-items: center;
        justify-content: center;

        background:
            rgba(239, 108, 49, .12);

        color: #ef6c31;
    }

    .form-control,
    .form-select {
        border-radius: 10px;
        padding: 10px 13px;
        border-color: #dee3ea;
    }

    .form-control:focus {
        border-color: #ef6c31;

        box-shadow:
            0 0 0 .2rem
            rgba(239, 108, 49, .12);
    }

    .form-label {
        font-weight: 600;
        color: #25344d;
    }

    .form-divider {
        border-top:
            1px solid #edf0f4;

        margin:
            30px 0;
    }

    .logo-preview {
        width: 130px;
        height: 130px;

        object-fit: contain;

        border-radius: 20px;

        border:
            1px solid #e5e7eb;

        padding: 10px;

        background: #fff;
    }

    .btn-orange {
        background: #ef6c31;
        border-color: #ef6c31;
        color: #fff;

        border-radius: 10px;

        padding:
            10px 22px;

        font-weight: 600;
    }

    .btn-orange:hover {
        background: #d97816;
        border-color: #d97816;
        color: #fff;
    }

</style>


<!-- ========================================================= -->
<!-- HEADER -->
<!-- ========================================================= -->

<div class="mb-4">

    <h4 class="fw-bold mb-1">

        Profil Organisasi

    </h4>


    <p class="text-muted mb-0">

        Kelola informasi utama
        SISPALA Mahardika.

    </p>

</div>


<!-- ========================================================= -->
<!-- ALERT -->
<!-- ========================================================= -->

<?php if (isset($_SESSION['success'])): ?>

    <div
        class="
            alert
            alert-success
            border-0
            shadow-sm
            rounded-3
        "
    >

        <i
            class="
                bi
                bi-check-circle
                me-2
            "
        ></i>

        <?= htmlspecialchars(
            $_SESSION['success']
        ); ?>

    </div>

    <?php unset($_SESSION['success']); ?>

<?php endif; ?>


<?php if (isset($_SESSION['error'])): ?>

    <div
        class="
            alert
            alert-danger
            border-0
            shadow-sm
            rounded-3
        "
    >

        <i
            class="
                bi
                bi-exclamation-circle
                me-2
            "
        ></i>

        <?= htmlspecialchars(
            $_SESSION['error']
        ); ?>

    </div>

    <?php unset($_SESSION['error']); ?>

<?php endif; ?>


<!-- ========================================================= -->
<!-- FORM -->
<!-- ========================================================= -->

<div
    class="
        card
        profil-card
        shadow-sm
    "
>

    <div class="card-body p-4 p-lg-5">


        <?php if ($profil): ?>


        <form
            method="POST"
            action="<?= BASE_URL ?>/admin/profil/update"
            enctype="multipart/form-data"
        >


            <input
                type="hidden"
                name="id"
                value="<?= $profil['id']; ?>"
            >


            <!-- ================================================= -->
            <!-- INFORMASI ORGANISASI -->
            <!-- ================================================= -->

            <div
                class="
                    d-flex
                    align-items-center
                    gap-3
                    mb-4
                "
            >

                <div class="section-icon">

                    <i
                        class="
                            bi
                            bi-building
                        "
                    ></i>

                </div>


                <div>

                    <div class="section-title">

                        Informasi Organisasi

                    </div>


                    <small class="text-muted">

                        Data utama organisasi

                    </small>

                </div>

            </div>


            <div class="row g-4">


                <!-- NAMA -->

                <div class="col-md-8">

                    <label class="form-label">

                        Nama Organisasi

                    </label>


                    <input
                        type="text"
                        name="nama_organisasi"
                        class="form-control"
                        required
                        value="<?= htmlspecialchars(
                            $profil['nama_organisasi']
                        ); ?>"
                    >

                </div>


                <!-- SINGKATAN -->

                <div class="col-md-4">

                    <label class="form-label">

                        Singkatan

                    </label>


                    <input
                        type="text"
                        name="singkatan"
                        class="form-control"
                        value="<?= htmlspecialchars(
                            $profil['singkatan']
                            ?? ''
                        ); ?>"
                    >

                </div>


                <!-- PERIODE -->

                <div class="col-md-6">

                    <label class="form-label">

                        Periode Kepengurusan

                    </label>


                    <input
                        type="text"
                        name="periode_kepengurusan"
                        class="form-control"
                        placeholder="Contoh: 2026 - 2027"
                        value="<?= htmlspecialchars(
                            $profil['periode_kepengurusan']
                            ?? ''
                        ); ?>"
                    >

                </div>


                <!-- EMAIL -->

                <div class="col-md-6">

                    <label class="form-label">

                        Email

                    </label>


                    <input
                        type="email"
                        name="email"
                        class="form-control"
                        value="<?= htmlspecialchars(
                            $profil['email']
                            ?? ''
                        ); ?>"
                    >

                </div>


                <!-- NO HP -->

                <div class="col-md-6">

                    <label class="form-label">

                        Nomor WhatsApp

                    </label>


                    <input
                        type="text"
                        name="no_hp"
                        class="form-control"
                        value="<?= htmlspecialchars(
                            $profil['no_hp']
                            ?? ''
                        ); ?>"
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
                        rows="3"
                    ><?= htmlspecialchars(
                        $profil['alamat']
                        ?? ''
                    ); ?></textarea>

                </div>

            </div>


            <div class="form-divider"></div>


            <!-- ================================================= -->
            <!-- LOGO -->
            <!-- ================================================= -->

            <div
                class="
                    d-flex
                    align-items-center
                    gap-3
                    mb-4
                "
            >

                <div class="section-icon">

                    <i
                        class="
                            bi
                            bi-image
                        "
                    ></i>

                </div>


                <div>

                    <div class="section-title">

                        Logo Organisasi

                    </div>


                    <small class="text-muted">

                        Upload logo resmi organisasi

                    </small>

                </div>

            </div>


            <div class="row g-4 align-items-center">


                <div class="col-md-3 text-center">


                    <?php if (
                        !empty(
                            $profil['logo']
                        )
                    ): ?>

                        <img
                            src="<?= BASE_URL ?>/uploads/logo/<?= htmlspecialchars(
                                $profil['logo']
                            ); ?>"
                            class="logo-preview"
                            alt="Logo Organisasi"
                        >

                    <?php else: ?>

                        <div
                            class="
                                logo-preview
                                d-flex
                                align-items-center
                                justify-content-center
                                mx-auto
                            "
                        >

                            <i
                                class="
                                    bi
                                    bi-building
                                    fs-1
                                    text-muted
                                "
                            ></i>

                        </div>

                    <?php endif; ?>


                </div>


                <div class="col-md-9">


                    <label class="form-label">

                        Upload Logo Baru

                    </label>


                    <input
                        type="file"
                        name="logo"
                        class="form-control"
                        accept=".jpg,.jpeg,.png,.webp"
                    >


                    <small class="text-muted">

                        Format JPG, PNG, WEBP.
                        Maksimal 2 MB.

                    </small>

                </div>

            </div>


            <div class="form-divider"></div>


            <!-- ================================================= -->
            <!-- SEJARAH -->
            <!-- ================================================= -->

            <div class="mb-4">

                <div
                    class="
                        d-flex
                        align-items-center
                        gap-3
                        mb-3
                    "
                >

                    <div class="section-icon">

                        <i
                            class="
                                bi
                                bi-clock-history
                            "
                        ></i>

                    </div>


                    <div class="section-title">

                        Sejarah Organisasi

                    </div>

                </div>


                <textarea
                    name="sejarah"
                    class="form-control"
                    rows="7"
                    placeholder="Tuliskan sejarah organisasi..."
                ><?= htmlspecialchars(
                    $profil['sejarah']
                    ?? ''
                ); ?></textarea>

            </div>


            <div class="form-divider"></div>


            <!-- ================================================= -->
            <!-- VISI MISI -->
            <!-- ================================================= -->

            <div class="row g-4">


                <!-- VISI -->

                <div class="col-md-6">

                    <div
                        class="
                            d-flex
                            align-items-center
                            gap-3
                            mb-3
                        "
                    >

                        <div class="section-icon">

                            <i
                                class="
                                    bi
                                    bi-eye
                                "
                            ></i>

                        </div>


                        <div class="section-title">

                            Visi

                        </div>

                    </div>


                    <textarea
                        name="visi"
                        class="form-control"
                        rows="8"
                        placeholder="Tuliskan visi organisasi..."
                    ><?= htmlspecialchars(
                        $profil['visi']
                        ?? ''
                    ); ?></textarea>

                </div>


                <!-- MISI -->

                <div class="col-md-6">

                    <div
                        class="
                            d-flex
                            align-items-center
                            gap-3
                            mb-3
                        "
                    >

                        <div class="section-icon">

                            <i
                                class="
                                    bi
                                    bi-bullseye
                                "
                            ></i>

                        </div>


                        <div class="section-title">

                            Misi

                        </div>

                    </div>


                    <textarea
                        name="misi"
                        class="form-control"
                        rows="8"
                        placeholder="Tuliskan misi organisasi..."
                    ><?= htmlspecialchars(
                        $profil['misi']
                        ?? ''
                    ); ?></textarea>

                </div>

            </div>


            <div class="form-divider"></div>


            <!-- ================================================= -->
            <!-- SOSIAL MEDIA -->
            <!-- ================================================= -->

            <div
                class="
                    d-flex
                    align-items-center
                    gap-3
                    mb-4
                "
            >

                <div class="section-icon">

                    <i
                        class="
                            bi
                            bi-share
                        "
                    ></i>

                </div>


                <div>

                    <div class="section-title">

                        Sosial Media

                    </div>


                    <small class="text-muted">

                        Akun resmi organisasi

                    </small>

                </div>

            </div>


            <div class="row g-4">


                <!-- INSTAGRAM -->

                <div class="col-md-4">

                    <label class="form-label">

                        Instagram

                    </label>


                    <input
                        type="text"
                        name="instagram"
                        class="form-control"
                        placeholder="@username"
                        value="<?= htmlspecialchars(
                            $profil['instagram']
                            ?? ''
                        ); ?>"
                    >

                </div>


                <!-- FACEBOOK -->

                <div class="col-md-4">

                    <label class="form-label">

                        Facebook

                    </label>


                    <input
                        type="text"
                        name="facebook"
                        class="form-control"
                        value="<?= htmlspecialchars(
                            $profil['facebook']
                            ?? ''
                        ); ?>"
                    >

                </div>


                <!-- YOUTUBE -->

                <div class="col-md-4">

                    <label class="form-label">

                        YouTube

                    </label>


                    <input
                        type="text"
                        name="youtube"
                        class="form-control"
                        value="<?= htmlspecialchars(
                            $profil['youtube']
                            ?? ''
                        ); ?>"
                    >

                </div>

            </div>


            <!-- ================================================= -->
            <!-- BUTTON -->
            <!-- ================================================= -->

            <div class="form-divider"></div>


            <div class="text-end">

                <button
                    type="submit"
                    class="btn btn-orange"
                >

                    <i
                        class="
                            bi
                            bi-save
                            me-2
                        "
                    ></i>

                    Simpan Perubahan

                </button>

            </div>


        </form>


        <?php else: ?>


            <div
                class="
                    alert
                    alert-warning
                    border-0
                "
            >

                Data profil organisasi belum tersedia.

            </div>


        <?php endif; ?>


    </div>

</div>


<?php

$content = ob_get_clean();

require ROOT_PATH .
    '/app/Views/layouts/admin_layout.php';