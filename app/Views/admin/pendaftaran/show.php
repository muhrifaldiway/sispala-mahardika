<?php

$pageTitle = 'Detail Pendaftaran';

$activeMenu = 'pendaftaran';

ob_start();

?>

<div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">

    <div>

        <a
            href="<?= BASE_URL ?>/admin/pendaftaran"
            class="text-muted text-decoration-none"
        >

            <i class="bi bi-arrow-left me-1"></i>

            Kembali

        </a>


        <h4
            class="fw-bold mt-3 mb-1"
            style="color:#0a2f27;"
        >

            Detail Pendaftaran

        </h4>

    </div>


    <a
        href="<?= BASE_URL ?>/admin/pendaftaran/edit/<?= $data['id']; ?>"
        class="btn btn-warning"
    >

        <i class="bi bi-pencil me-1"></i>

        Edit

    </a>

</div>


<div class="card border-0 shadow-sm rounded-4">

    <div class="card-body p-4 p-lg-5">


        <div class="text-center mb-4">

            <div
                class="mx-auto mb-3 rounded-circle d-flex align-items-center justify-content-center"
                style="
                    width:90px;
                    height:90px;
                    background:#eef2f7;
                    color:#0a2f27;
                    font-size:35px;
                    font-weight:700;
                "
            >

                <?= strtoupper(
                    substr(
                        $data['nama_lengkap'],
                        0,
                        1
                    )
                ); ?>

            </div>


            <h4 class="fw-bold mb-1">

                <?= htmlspecialchars(
                    $data['nama_lengkap']
                ); ?>

            </h4>


            <div class="text-muted">

                <?= htmlspecialchars(
                    $data['nomor_pendaftaran']
                ); ?>

            </div>


            <div class="mt-2">

                <?php if ($data['status'] === 'diterima'): ?>

                    <span class="badge bg-success">
                        Diterima
                    </span>

                <?php elseif ($data['status'] === 'ditolak'): ?>

                    <span class="badge bg-danger">
                        Ditolak
                    </span>

                <?php else: ?>

                    <span class="badge bg-warning text-dark">
                        Pending
                    </span>

                <?php endif; ?>

            </div>

        </div>


        <hr>


        <div class="row g-4 mt-1">


            <div class="col-md-6">

                <small class="text-muted">
                    NIS
                </small>

                <div class="fw-semibold">
                    <?= htmlspecialchars(
                        $data['nis'] ?: '-'
                    ); ?>
                </div>

            </div>


            <div class="col-md-6">

                <small class="text-muted">
                    Jenis Kelamin
                </small>

                <div class="fw-semibold">

                    <?= $data['jenis_kelamin'] === 'L'
                        ? 'Laki-laki'
                        : 'Perempuan';
                    ?>

                </div>

            </div>


            <div class="col-md-6">

                <small class="text-muted">
                    Kelas
                </small>

                <div class="fw-semibold">
                    <?= htmlspecialchars(
                        $data['kelas'] ?: '-'
                    ); ?>
                </div>

            </div>


            <div class="col-md-6">

                <small class="text-muted">
                    Angkatan
                </small>

                <div class="fw-semibold">
                    <?= htmlspecialchars(
                        $data['angkatan'] ?: '-'
                    ); ?>
                </div>

            </div>


            <div class="col-md-6">

                <small class="text-muted">
                    Tempat, Tanggal Lahir
                </small>

                <div class="fw-semibold">

                    <?= htmlspecialchars(
                        $data['tempat_lahir'] ?: '-'
                    ); ?>

                    <?= !empty($data['tanggal_lahir'])
                        ? ', ' . date(
                            'd-m-Y',
                            strtotime(
                                $data['tanggal_lahir']
                            )
                        )
                        : '';
                    ?>

                </div>

            </div>


            <div class="col-md-6">

                <small class="text-muted">
                    Nomor HP
                </small>

                <div class="fw-semibold">
                    <?= htmlspecialchars(
                        $data['no_hp'] ?: '-'
                    ); ?>
                </div>

            </div>


            <div class="col-12">

                <small class="text-muted">
                    Alamat
                </small>

                <div class="fw-semibold">
                    <?= nl2br(
                        htmlspecialchars(
                            $data['alamat'] ?: '-'
                        )
                    ); ?>
                </div>

            </div>


            <div class="col-12">

                <small class="text-muted">
                    Alasan Bergabung
                </small>

                <div class="fw-semibold">
                    <?= nl2br(
                        htmlspecialchars(
                            $data['alasan'] ?: '-'
                        )
                    ); ?>
                </div>

            </div>


            <div class="col-12">

                <small class="text-muted">
                    Pengalaman
                </small>

                <div class="fw-semibold">
                    <?= nl2br(
                        htmlspecialchars(
                            $data['pengalaman'] ?: '-'
                        )
                    ); ?>
                </div>

            </div>


            <div class="col-12">

                <small class="text-muted">
                    Catatan Admin
                </small>

                <div class="fw-semibold">
                    <?= nl2br(
                        htmlspecialchars(
                            $data['catatan'] ?: '-'
                        )
                    ); ?>
                </div>

            </div>


        </div>

    </div>

</div>


<?php

$content = ob_get_clean();

require ROOT_PATH . '/app/Views/layouts/admin_layout.php';

?>