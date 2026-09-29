<?php

$pageTitle = 'Edit Berita';

$activeMenu = 'berita';

ob_start();

?>

<style>

    .berita-form-card {
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
        background: rgba(239, 108, 49,.12);
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
        box-shadow: 0 0 0 .2rem rgba(239, 108, 49,.12);
    }

    textarea.form-control {
        min-height: 150px;
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

    .current-image {
        width: 100%;
        max-width: 500px;
        height: 250px;
        object-fit: cover;
        border-radius: 14px;
        margin-top: 10px;
    }

    .image-preview {
        width: 100%;
        max-width: 500px;
        height: 250px;
        object-fit: cover;
        border-radius: 14px;
        display: none;
        margin-top: 15px;
    }

</style>


<!-- HEADER -->

<div class="mb-4">

    <a
        href="<?= BASE_URL ?>/admin/berita"
        class="page-back"
    >

        <i class="bi bi-arrow-left me-1"></i>

        Kembali ke Berita

    </a>


    <div class="mt-3">

        <h4
            class="fw-bold mb-1"
            style="color:#0a2f27;"
        >
            Edit Berita
        </h4>

        <p class="text-muted mb-0">
            Perbarui informasi berita.
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

<div class="card berita-form-card shadow-sm">

    <div class="card-body p-4 p-lg-5">

        <form
            method="POST"
            action="<?= BASE_URL ?>/admin/berita/update/<?= $berita['id'] ?>"
            enctype="multipart/form-data"
        >

            <div class="d-flex align-items-center gap-3 mb-4">

                <div class="form-section-icon">

                    <i class="bi bi-newspaper"></i>

                </div>

                <div>

                    <div class="form-section-title">
                        Informasi Berita
                    </div>

                    <small class="text-muted">
                        Data utama berita
                    </small>

                </div>

            </div>


            <div class="row g-4">

                <!-- JUDUL -->

                <div class="col-12">

                    <label class="form-label fw-semibold">

                        Judul Berita
                        <span class="text-danger">*</span>

                    </label>

                    <input
                        type="text"
                        name="judul"
                        class="form-control"
                        value="<?= htmlspecialchars($berita['judul']) ?>"
                        required
                    >

                </div>


                <!-- KATEGORI -->

                <div class="col-md-6">

                    <label class="form-label fw-semibold">
                        Kategori
                    </label>

                    <select
                        name="kategori"
                        class="form-select"
                    >

                        <option value="">
                            Pilih kategori
                        </option>

                        <?php

                        $kategoriList = [
                            'Kegiatan',
                            'Prestasi',
                            'Informasi',
                            'Pengumuman',
                            'Lainnya'
                        ];

                        ?>

                        <?php foreach ($kategoriList as $kategori): ?>

                            <option
                                value="<?= $kategori ?>"
                                <?= $berita['kategori'] === $kategori ? 'selected' : '' ?>
                            >

                                <?= $kategori ?>

                            </option>

                        <?php endforeach; ?>

                    </select>

                </div>


                <!-- STATUS -->

                <div class="col-md-6">

                    <label class="form-label fw-semibold">
                        Status
                    </label>

                    <select
                        name="status"
                        class="form-select"
                    >

                        <option
                            value="draft"
                            <?= $berita['status'] === 'draft' ? 'selected' : '' ?>
                        >
                            Draft
                        </option>

                        <option
                            value="publish"
                            <?= $berita['status'] === 'publish' ? 'selected' : '' ?>
                        >
                            Publish
                        </option>

                    </select>

                </div>


                <!-- RINGKASAN -->

                <div class="col-12">

                    <label class="form-label fw-semibold">
                        Ringkasan
                    </label>

                    <textarea
                        name="ringkasan"
                        class="form-control"
                        rows="3"
                    ><?= htmlspecialchars($berita['ringkasan'] ?? '') ?></textarea>

                </div>


                <!-- ISI -->

                <div class="col-12">

                    <label class="form-label fw-semibold">

                        Isi Berita
                        <span class="text-danger">*</span>

                    </label>

                    <textarea
                        name="isi"
                        class="form-control"
                        rows="12"
                        required
                    ><?= htmlspecialchars($berita['isi']) ?></textarea>

                </div>

            </div>


            <div class="form-divider"></div>


            <!-- GAMBAR -->

            <div class="d-flex align-items-center gap-3 mb-4">

                <div class="form-section-icon">

                    <i class="bi bi-image"></i>

                </div>

                <div>

                    <div class="form-section-title">
                        Gambar Berita
                    </div>

                    <small class="text-muted">
                        Ganti gambar jika diperlukan
                    </small>

                </div>

            </div>


            <?php if (!empty($berita['gambar'])): ?>

                <div class="mb-3">

                    <div class="small text-muted mb-2">
                        Gambar saat ini
                    </div>

                    <img
                        src="<?= BASE_URL ?>/uploads/berita/<?= htmlspecialchars($berita['gambar']) ?>"
                        class="current-image"
                        alt="Gambar berita"
                    >

                </div>

            <?php endif; ?>


            <label class="form-label fw-semibold">

                Gambar Baru

            </label>


            <input
                type="file"
                name="gambar"
                id="gambar"
                class="form-control"
                accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp"
            >


            <small class="text-muted">

                Kosongkan jika tidak ingin mengganti gambar.

                Maksimal 2 MB.

            </small>


            <img
                id="previewGambar"
                class="image-preview"
                alt="Preview"
            >


            <div class="form-divider"></div>


            <!-- ACTION -->

            <div class="d-flex justify-content-end gap-2">

                <a
                    href="<?= BASE_URL ?>/admin/berita"
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

        </form>

    </div>

</div>


<script>

document.getElementById('gambar')
.addEventListener('change', function(event) {

    const file =
        event.target.files[0];

    const preview =
        document.getElementById('previewGambar');


    if (!file) {

        preview.style.display = 'none';

        preview.removeAttribute('src');

        return;
    }


    const allowedTypes = [
        'image/jpeg',
        'image/png',
        'image/webp'
    ];


    if (!allowedTypes.includes(file.type)) {

        alert(
            'Format gambar harus JPG, JPEG, PNG, atau WEBP.'
        );

        event.target.value = '';

        preview.style.display = 'none';

        return;
    }


    if (file.size > 2 * 1024 * 1024) {

        alert(
            'Ukuran gambar maksimal 2 MB.'
        );

        event.target.value = '';

        preview.style.display = 'none';

        return;
    }


    const reader =
        new FileReader();


    reader.onload =
        function(e) {

            preview.src =
                e.target.result;

            preview.style.display =
                'block';

        };


    reader.readAsDataURL(file);

});

</script>


<?php

$content = ob_get_clean();

require ROOT_PATH . '/app/Views/layouts/admin_layout.php';

?>