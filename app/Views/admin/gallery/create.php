<?php

$pageTitle = 'Tambah Gallery';

$activeMenu = 'gallery';

ob_start();

?>

<style>

    .gallery-form-card {
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
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #ef6c31;
        box-shadow: 0 0 0 .2rem rgba(239, 108, 49,.12);
    }

    .photo-upload {
        border: 2px dashed #d9dee7;
        border-radius: 16px;
        padding: 25px;
        text-align: center;
        background: #fafbfc;
    }

    .photo-preview {
        width: 100%;
        max-width: 500px;
        max-height: 300px;
        object-fit: cover;
        border-radius: 14px;
        display: none;
        margin: 0 auto 20px;
    }

    .photo-icon {
        width: 70px;
        height: 70px;
        border-radius: 50%;
        background: rgba(10, 47, 39,.08);
        color: #0a2f27;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 15px;
        font-size: 28px;
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

    .page-back {
        color: #64748b;
        text-decoration: none;
        font-size: 14px;
    }

    .page-back:hover {
        color: #ef6c31;
    }

</style>


<!-- HEADER -->

<div class="mb-4">

    <a
        href="<?= BASE_URL ?>/admin/gallery"
        class="page-back"
    >

        <i class="bi bi-arrow-left me-1"></i>

        Kembali ke Gallery

    </a>


    <div class="mt-3">

        <h4
            class="fw-bold mb-1"
            style="color:#0a2f27;"
        >

            Tambah Gallery

        </h4>

        <p class="text-muted mb-0">

            Tambahkan dokumentasi kegiatan SISPALA Mahardika.

        </p>

    </div>

</div>


<!-- ERROR -->

<?php if (isset($_SESSION['error'])): ?>

    <div class="alert alert-danger border-0 shadow-sm rounded-3">

        <i class="bi bi-exclamation-circle me-2"></i>

        <?= htmlspecialchars($_SESSION['error']); ?>

    </div>

    <?php unset($_SESSION['error']); ?>

<?php endif; ?>


<!-- FORM -->

<div class="card gallery-form-card shadow-sm">

    <div class="card-body p-4 p-lg-5">

        <form
            method="POST"
            action="<?= BASE_URL ?>/admin/gallery/store"
            enctype="multipart/form-data"
        >


            <!-- DATA GALLERY -->

            <div class="d-flex align-items-center gap-3 mb-4">

                <div class="form-section-icon">

                    <i class="bi bi-images"></i>

                </div>

                <div>

                    <div class="form-section-title">

                        Informasi Gallery

                    </div>

                    <small class="text-muted">

                        Informasi dokumentasi kegiatan

                    </small>

                </div>

            </div>


            <div class="row g-4">

                <div class="col-md-8">

                    <label class="form-label fw-semibold">

                        Judul Gallery

                        <span class="text-danger">*</span>

                    </label>

                    <input
                        type="text"
                        name="judul"
                        class="form-control"
                        placeholder="Contoh: Kegiatan Pendakian Gunung"
                        maxlength="150"
                        required
                    >

                </div>


                <div class="col-md-4">

                    <label class="form-label fw-semibold">

                        Status

                    </label>

                    <select
                        name="status"
                        class="form-select"
                    >

                        <option value="aktif">

                            Aktif

                        </option>

                        <option value="nonaktif">

                            Nonaktif

                        </option>

                    </select>

                </div>


                <div class="col-12">

                    <label class="form-label fw-semibold">

                        Deskripsi

                    </label>

                    <textarea
                        name="deskripsi"
                        class="form-control"
                        rows="5"
                        placeholder="Masukkan deskripsi kegiatan..."
                    ></textarea>

                </div>

            </div>


            <hr class="my-4">


            <!-- FOTO -->

            <div class="d-flex align-items-center gap-3 mb-4">

                <div class="form-section-icon">

                    <i class="bi bi-camera"></i>

                </div>

                <div>

                    <div class="form-section-title">

                        Foto Gallery

                    </div>

                    <small class="text-muted">

                        Upload dokumentasi kegiatan

                    </small>

                </div>

            </div>


            <div class="photo-upload">

                <img
                    id="photoPreview"
                    class="photo-preview"
                    alt="Preview"
                >


                <div
                    id="photoIcon"
                    class="photo-icon"
                >

                    <i class="bi bi-image"></i>

                </div>


                <h6 class="fw-bold">

                    Upload Foto

                </h6>


                <p class="text-muted small">

                    JPG, JPEG, PNG, atau WEBP maksimal 2 MB

                </p>


                <input
                    type="file"
                    name="foto"
                    id="foto"
                    class="form-control"
                    accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp"
                    required
                >

            </div>


            <hr class="my-4">


            <!-- ACTION -->

            <div class="d-flex justify-content-end gap-2">

                <a
                    href="<?= BASE_URL ?>/admin/gallery"
                    class="btn btn-light border"
                >

                    Batal

                </a>


                <button
                    type="submit"
                    class="btn btn-orange"
                >

                    <i class="bi bi-save me-2"></i>

                    Simpan Gallery

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
            document.getElementById('foto');

        const preview =
            document.getElementById('photoPreview');

        const icon =
            document.getElementById('photoIcon');


        input.addEventListener(
            'change',
            function (event) {

                const file =
                    event.target.files[0];


                if (!file) {

                    preview.style.display = 'none';

                    icon.style.display = 'flex';

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
                        'Format foto harus JPG, JPEG, PNG, atau WEBP.'
                    );

                    input.value = '';

                    preview.style.display = 'none';

                    icon.style.display = 'flex';

                    return;
                }


                const maxSize =
                    2 * 1024 * 1024;


                if (
                    file.size > maxSize
                ) {

                    alert(
                        'Ukuran foto maksimal 2 MB.'
                    );

                    input.value = '';

                    preview.style.display = 'none';

                    icon.style.display = 'flex';

                    return;
                }


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