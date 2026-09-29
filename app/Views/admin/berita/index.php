<?php

$pageTitle = 'Berita';

$activeMenu = 'berita';

ob_start();

?>

<style>

    .berita-card {
        border: 0;
        border-radius: 18px;
        overflow: hidden;
    }

    .berita-image {
        width: 90px;
        height: 65px;
        object-fit: cover;
        border-radius: 10px;
        background: #f1f3f5;
    }

    .berita-placeholder {
        width: 90px;
        height: 65px;
        border-radius: 10px;
        background: #f1f3f5;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #9aa4b2;
        font-size: 22px;
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

    .table th {
        color: #64748b;
        font-size: 13px;
        font-weight: 700;
        white-space: nowrap;
    }

    .table td {
        vertical-align: middle;
    }

</style>


<!-- HEADER -->

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>

        <h4
            class="fw-bold mb-1"
            style="color:#0a2f27;"
        >
            Berita
        </h4>

        <p class="text-muted mb-0">
            Kelola berita dan informasi SISPALA Mahardika.
        </p>

    </div>


    <a
        href="<?= BASE_URL ?>/admin/berita/create"
        class="btn btn-orange"
    >

        <i class="bi bi-plus-lg me-2"></i>

        Tambah Berita

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


<!-- TABLE -->

<div class="card berita-card shadow-sm">

    <div class="card-body p-0">

        <div class="table-responsive">

            <table class="table table-hover mb-0">

                <thead>

                    <tr>

                        <th class="ps-4">
                            #
                        </th>

                        <th>
                            Berita
                        </th>

                        <th>
                            Kategori
                        </th>

                        <th>
                            Status
                        </th>

                        <th>
                            Tanggal
                        </th>

                        <th class="text-end pe-4">
                            Aksi
                        </th>

                    </tr>

                </thead>


                <tbody>

                <?php if (!empty($berita)): ?>

                    <?php foreach ($berita as $index => $item): ?>

                        <tr>

                            <td class="ps-4">

                                <?= $index + 1 ?>

                            </td>


                            <!-- BERITA -->

                            <td>

                                <div class="d-flex align-items-center gap-3">

                                    <?php if (!empty($item['gambar'])): ?>

                                        <img
                                            src="<?= BASE_URL ?>/uploads/berita/<?= htmlspecialchars($item['gambar']) ?>"
                                            class="berita-image"
                                            alt="<?= htmlspecialchars($item['judul']) ?>"
                                        >

                                    <?php else: ?>

                                        <div class="berita-placeholder">

                                            <i class="bi bi-image"></i>

                                        </div>

                                    <?php endif; ?>


                                    <div>

                                        <div
                                            class="fw-semibold"
                                            style="color:#0a2f27;"
                                        >

                                            <?= htmlspecialchars($item['judul']) ?>

                                        </div>


                                        <?php if (!empty($item['ringkasan'])): ?>

                                            <small class="text-muted">

                                                <?= htmlspecialchars(
                                                    mb_substr(
                                                        $item['ringkasan'],
                                                        0,
                                                        70
                                                    )
                                                ) ?>

                                                <?php if (mb_strlen($item['ringkasan']) > 70): ?>
                                                    ...
                                                <?php endif; ?>

                                            </small>

                                        <?php endif; ?>

                                    </div>

                                </div>

                            </td>


                            <!-- KATEGORI -->

                            <td>

                                <?php if (!empty($item['kategori'])): ?>

                                    <span class="badge bg-light text-dark border">

                                        <?= htmlspecialchars($item['kategori']) ?>

                                    </span>

                                <?php else: ?>

                                    <span class="text-muted">
                                        -
                                    </span>

                                <?php endif; ?>

                            </td>


                            <!-- STATUS -->

                            <td>

                                <?php if ($item['status'] === 'publish'): ?>

                                    <span class="badge bg-success-subtle text-success">

                                        <i class="bi bi-check-circle me-1"></i>

                                        Publish

                                    </span>

                                <?php else: ?>

                                    <span class="badge bg-secondary-subtle text-secondary">

                                        <i class="bi bi-file-earmark me-1"></i>

                                        Draft

                                    </span>

                                <?php endif; ?>

                            </td>


                            <!-- TANGGAL -->

                            <td>

                                <small class="text-muted">

                                    <?php

                                    if (!empty($item['tanggal_publish'])) {

                                        echo date(
                                            'd M Y H:i',
                                            strtotime(
                                                $item['tanggal_publish']
                                            )
                                        );

                                    } else {

                                        echo '-';
                                    }

                                    ?>

                                </small>

                            </td>


                            <!-- AKSI -->

                            <td class="text-end pe-4">

                                <div class="d-flex justify-content-end gap-2">

                                    <a
                                        href="<?= BASE_URL ?>/admin/berita/edit/<?= $item['id'] ?>"
                                        class="btn btn-sm btn-light border"
                                        title="Edit"
                                    >

                                        <i class="bi bi-pencil"></i>

                                    </a>


                                    <a
                                        href="<?= BASE_URL ?>/admin/berita/delete/<?= $item['id'] ?>"
                                        class="btn btn-sm btn-light border text-danger"
                                        title="Hapus"
                                        onclick="return confirm('Yakin ingin menghapus berita ini?')"
                                    >

                                        <i class="bi bi-trash"></i>

                                    </a>

                                </div>

                            </td>

                        </tr>

                    <?php endforeach; ?>

                <?php else: ?>

                    <tr>

                        <td
                            colspan="6"
                            class="text-center py-5"
                        >

                            <div class="text-muted">

                                <i
                                    class="bi bi-newspaper"
                                    style="font-size:40px;"
                                ></i>

                                <div class="mt-3 fw-semibold">

                                    Belum ada berita.

                                </div>

                                <small>

                                    Silakan tambahkan berita pertama.

                                </small>

                            </div>

                        </td>

                    </tr>

                <?php endif; ?>

                </tbody>

            </table>

        </div>

    </div>

</div>


<?php

$content = ob_get_clean();

require ROOT_PATH . '/app/Views/layouts/admin_layout.php';

?>