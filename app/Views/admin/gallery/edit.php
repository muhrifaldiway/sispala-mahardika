<?php

$pageTitle = 'Edit Gallery';

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

    .current-photo {
        width: 100%;
        max-width: 500px;
        max-height: 300px;
        object-fit: cover;
        border-radius: 14px;
        display: block;
        margin: 0 auto 20px;
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

    .photo-upload {
        border: 2px dashed #d9dee7;
        border-radius: 16px;
        padding: 25px;
        text-align: center;
        background: #fafbfc;
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

            Edit Gallery

        </h4>

        <p class="text-muted mb-0">

            Perbarui informasi dokumentasi kegiatan.

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
            action="<?= BASE_URL ?>/admin/gallery/update/<?= $gallery['id']; ?>"
            enctype="multipart/form-data"
        >


            <div class="d-flex align-items-center gap-3 mb-4">

                <div class="form-section-icon">

                    <i class="bi bi-images"></i>

                </div>

                <div>

                    <div class="form-section-title">

                        Informasi Gallery

                    </div>

                    <small class="text-muted">

                        Perbarui informasi gallery

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
                        maxlength="150"
                        value="<?= htmlspecialchars($gallery['judul']); ?>"
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

                        <option
                            value="aktif"
                            <?= $gallery['status'] === 'aktif' ? 'selected' : ''; ?>
                        >

                            Aktif

                        </option>

                        <option
                            value="nonaktif"
                            <?= $gallery['status'] === 'nonaktif' ? 'selected' : ''; ?>
                        >

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
                    ><?= htmlspecialchars($gallery['deskripsi'] ?? ''); ?></textarea>

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

                        Ganti foto jika diperlukan

                    </small>

                </div>

            </div>


            <div class="photo-upload">

                <img
                    id="currentPhoto"
                    src="<?= BASE_URL ?>/uploads/gallery/<?= htmlspecialchars($gallery['foto']); ?>"
                    class="current-photo"
                    alt="Foto Gallery"
                >


                <img
                    id="photoPreview"
                    class="photo-preview"
                    alt="Preview Foto Baru"
                >


                <p class="text-muted small">

                    Foto saat ini

                </p>


                <input
                    type="file"
                    name="foto"
                    id="foto"
                    class="form-control"
                    accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp"
                >


                <div class="text-muted small mt-2">

                    Kosongkan jika tidak ingin mengganti foto.

                    Maksimal 2 MB.

                </div>

            </div>


            <hr class="my-4">


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

                    Update Gallery

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

        const current =
            document.getElementById('currentPhoto');


        input.addEventListener(
            'change',
            function (event) {

                const file =
                    event.target.files[0];


                if (!file) {

                    preview.style.display =
                        'none';

                    current.style.display =
                        'block';

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
                        'Format foto harus JPG, JPEG, atau WEBP.'
                    );

                    input.value = '';

                    preview.style.display =
                        'none';

                    current.style.display =
                        'block';

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

                    preview.style.display =
                        'none';

                    current.style.display =
                        'block';

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

                        current.style.display =
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