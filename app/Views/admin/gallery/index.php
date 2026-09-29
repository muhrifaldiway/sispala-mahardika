<?php

$pageTitle = 'Gallery';

$activeMenu = 'gallery';

ob_start();

?>

<style>

    .gallery-card {
        border: 0;
        border-radius: 18px;
        overflow: hidden;
    }

    .gallery-image {
        width: 100%;
        height: 220px;
        object-fit: cover;
        background: #f1f3f5;
    }

    .gallery-item {
        border: 1px solid #edf0f4;
        border-radius: 16px;
        overflow: hidden;
        background: #fff;
        transition: .2s ease;
        height: 100%;
    }

    .gallery-item:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(0,0,0,.08);
    }

    .gallery-content {
        padding: 18px;
    }

    .gallery-title {
        color: #0a2f27;
        font-weight: 700;
        margin-bottom: 6px;
    }

    .gallery-description {
        font-size: 13px;
        color: #7b8798;
    }

    .btn-orange {
        background: #ef6c31;
        border-color: #ef6c31;
        color: #fff;
        border-radius: 10px;
        font-weight: 600;
    }

    .btn-orange:hover {
        background: #d97816;
        border-color: #d97816;
        color: #fff;
    }

    .empty-gallery {
        padding: 70px 20px;
        text-align: center;
        color: #7b8798;
    }

</style>


<!-- HEADER -->

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>

        <h4
            class="fw-bold mb-1"
            style="color:#0a2f27;"
        >
            Gallery
        </h4>

        <p class="text-muted mb-0">

            Kelola dokumentasi kegiatan SISPALA Mahardika.

        </p>

    </div>


    <a
        href="<?= BASE_URL ?>/admin/gallery/create"
        class="btn btn-orange"
    >

        <i class="bi bi-plus-lg me-2"></i>

        Tambah Gallery

    </a>

</div>


<!-- ALERT SUCCESS -->

<?php if (isset($_SESSION['success'])): ?>

    <div class="alert alert-success border-0 shadow-sm rounded-3">

        <i class="bi bi-check-circle me-2"></i>

        <?= htmlspecialchars($_SESSION['success']); ?>

    </div>

    <?php unset($_SESSION['success']); ?>

<?php endif; ?>


<!-- ALERT ERROR -->

<?php if (isset($_SESSION['error'])): ?>

    <div class="alert alert-danger border-0 shadow-sm rounded-3">

        <i class="bi bi-exclamation-circle me-2"></i>

        <?= htmlspecialchars($_SESSION['error']); ?>

    </div>

    <?php unset($_SESSION['error']); ?>

<?php endif; ?>


<!-- GALLERY -->

<div class="card gallery-card shadow-sm">

    <div class="card-body p-4">

        <?php if (!empty($gallery)): ?>

            <div class="row g-4">

                <?php foreach ($gallery as $item): ?>

                    <div class="col-xl-4 col-lg-4 col-md-6">

                        <div class="gallery-item">

                            <img
                                src="<?= BASE_URL ?>/uploads/gallery/<?= htmlspecialchars($item['foto']); ?>"
                                alt="<?= htmlspecialchars($item['judul']); ?>"
                                class="gallery-image"
                            >


                            <div class="gallery-content">

                                <div class="d-flex justify-content-between align-items-start gap-2">

                                    <h6 class="gallery-title mb-0">

                                        <?= htmlspecialchars($item['judul']); ?>

                                    </h6>


                                    <?php if ($item['status'] === 'aktif'): ?>

                                        <span class="badge text-bg-success">

                                            Aktif

                                        </span>

                                    <?php else: ?>

                                        <span class="badge text-bg-secondary">

                                            Nonaktif

                                        </span>

                                    <?php endif; ?>

                                </div>


                                <?php if (!empty($item['deskripsi'])): ?>

                                    <p class="gallery-description mt-2 mb-3">

                                        <?= nl2br(
                                            htmlspecialchars(
                                                $item['deskripsi']
                                            )
                                        ); ?>

                                    </p>

                                <?php else: ?>

                                    <p class="gallery-description mt-2 mb-3">

                                        Tidak ada deskripsi.

                                    </p>

                                <?php endif; ?>


                                <div class="d-flex gap-2">

                                    <a
                                        href="<?= BASE_URL ?>/admin/gallery/edit/<?= $item['id']; ?>"
                                        class="btn btn-sm btn-outline-primary"
                                    >

                                        <i class="bi bi-pencil me-1"></i>

                                        Edit

                                    </a>


                                    <a
                                        href="<?= BASE_URL ?>/admin/gallery/delete/<?= $item['id']; ?>"
                                        class="btn btn-sm btn-outline-danger"
                                        onclick="return confirm('Yakin ingin menghapus gallery ini?')"
                                    >

                                        <i class="bi bi-trash me-1"></i>

                                        Hapus

                                    </a>

                                </div>

                            </div>

                        </div>

                    </div>

                <?php endforeach; ?>

            </div>

        <?php else: ?>

            <div class="empty-gallery">

                <i
                    class="bi bi-images"
                    style="font-size:55px;"
                ></i>

                <h5 class="fw-bold mt-3">

                    Belum Ada Gallery

                </h5>

                <p class="mb-4">

                    Belum ada dokumentasi kegiatan yang ditambahkan.

                </p>


                <a
                    href="<?= BASE_URL ?>/admin/gallery/create"
                    class="btn btn-orange"
                >

                    <i class="bi bi-plus-lg me-2"></i>

                    Tambah Gallery

                </a>

            </div>

        <?php endif; ?>

    </div>

</div>


<?php

$content = ob_get_clean();

require ROOT_PATH . '/app/Views/layouts/admin_layout.php';

?>