<?php

$pageTitle = 'Dashboard';

$activeMenu = 'dashboard';

ob_start();

?>


<style>

.dashboard-card{background:#fff;border:1px solid #e1e7df;border-radius:0;transition:transform .2s ease}
.dashboard-card:hover{transform:translateY(-3px)}
.dashboard-icon{width:52px;height:52px;display:flex;align-items:center;justify-content:center;border-radius:50%;background:rgba(239,108,49,.12);color:#ef6c31}
.quick-menu{border-radius:0!important;border-color:#e1e7df!important}
.quick-menu:hover{background:#fff7f1;border-color:#ef6c31!important;transform:translateY(-2px)}
.status-card{border:1px solid #e1e7df;border-radius:0}
.status-icon{width:42px;height:42px;border-radius:50%;display:flex;align-items:center;justify-content:center}
.table>:not(caption)>*>*{padding:14px 12px}
.badge-status{padding:7px 11px;border-radius:0;font-size:11px;font-weight:700;letter-spacing:.04em;text-transform:uppercase}
.admin-content h4,.admin-content h5,.admin-content h6{font-family:Oswald,sans-serif;color:#0a2f27}

</style>


<div class="mb-4">

    <h4 class="fw-bold mb-1">

        Selamat datang, <?= htmlspecialchars($_SESSION['user']['nama'] ?? 'Admin'); ?>

    </h4>

    <p class="text-muted mb-0">
        Berikut ringkasan informasi SISPALA Mahardika.
    </p>

</div>


<div class="row g-4 mb-4">

    <div class="col-12 col-sm-6 col-xl-3">
        <div class="card dashboard-card h-100">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <small class="text-muted">Total Anggota</small>
                        <h3 class="fw-bold mt-2 mb-0"><?= number_format($totalAnggota ?? 0); ?></h3>
                    </div>
                    <div class="dashboard-icon"><i class="bi bi-people-fill fs-4"></i></div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-sm-6 col-xl-3">
        <div class="card dashboard-card h-100">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <small class="text-muted">Total Berita</small>
                        <h3 class="fw-bold mt-2 mb-0"><?= number_format($totalBerita ?? 0); ?></h3>
                    </div>
                    <div class="dashboard-icon"><i class="bi bi-newspaper fs-4"></i></div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-sm-6 col-xl-3">
        <div class="card dashboard-card h-100">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <small class="text-muted">Total Galeri</small>
                        <h3 class="fw-bold mt-2 mb-0"><?= number_format($totalGaleri ?? 0); ?></h3>
                    </div>
                    <div class="dashboard-icon"><i class="bi bi-images fs-4"></i></div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-sm-6 col-xl-3">
        <div class="card dashboard-card h-100">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <small class="text-muted">Total Pendaftar</small>
                        <h3 class="fw-bold mt-2 mb-0"><?= number_format($totalPendaftaran ?? 0); ?></h3>
                    </div>
                    <div class="dashboard-icon"><i class="bi bi-person-plus-fill fs-4"></i></div>
                </div>
            </div>
        </div>
    </div>

</div>


<div class="row g-4 mb-4">

    <div class="col-12 col-md-4">
        <div class="card status-card">
            <div class="card-body p-4">
                <div class="d-flex align-items-center gap-3">
                    <div class="status-icon" style="background:#fff3cd;color:#856404;"><i class="bi bi-hourglass-split"></i></div>
                    <div>
                        <small class="text-muted">Menunggu Verifikasi</small>
                        <h4 class="fw-bold mb-0 mt-1"><?= number_format($pendaftaranPending ?? 0); ?></h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-4">
        <div class="card status-card">
            <div class="card-body p-4">
                <div class="d-flex align-items-center gap-3">
                    <div class="status-icon" style="background:#d1e7dd;color:#146c43;"><i class="bi bi-check-circle-fill"></i></div>
                    <div>
                        <small class="text-muted">Diterima</small>
                        <h4 class="fw-bold mb-0 mt-1"><?= number_format($pendaftaranDiterima ?? 0); ?></h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-4">
        <div class="card status-card">
            <div class="card-body p-4">
                <div class="d-flex align-items-center gap-3">
                    <div class="status-icon" style="background:#f8d7da;color:#b02a37;"><i class="bi bi-x-circle-fill"></i></div>
                    <div>
                        <small class="text-muted">Ditolak</small>
                        <h4 class="fw-bold mb-0 mt-1"><?= number_format($pendaftaranDitolak ?? 0); ?></h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


<div class="row g-4 mb-4">

    <div class="col-12 col-xl-8">
        <div class="card status-card h-100">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h5 class="fw-bold mb-1">Pendaftaran Terbaru</h5>
                        <small class="text-muted">Data pendaftar terakhir</small>
                    </div>
                    <a href="<?= BASE_URL ?>/admin/pendaftaran" class="btn btn-sm btn-light border">Lihat Semua <i class="bi bi-arrow-right ms-1"></i></a>
                </div>

                <?php if (!empty($pendaftaranTerbaru)): ?>

                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead>
                                <tr>
                                    <th>Pendaftar</th>
                                    <th>Kelas</th>
                                    <th>Status</th>
                                    <th>Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($pendaftaranTerbaru as $data): ?>
                                    <tr>
                                        <td>
                                            <div class="fw-semibold"><?= htmlspecialchars($data['nama_lengkap'] ?? '-'); ?></div>
                                            <small class="text-muted"><?= htmlspecialchars($data['nomor_pendaftaran'] ?? '-'); ?></small>
                                        </td>
                                        <td><?= htmlspecialchars($data['kelas'] ?? '-'); ?></td>
                                        <td>
                                            <?php $status = $data['status'] ?? 'pending'; ?>
                                            <?php if ($status === 'diterima'): ?>
                                                <span class="badge-status" style="background:#d1e7dd;color:#146c43;">Diterima</span>
                                            <?php elseif ($status === 'ditolak'): ?>
                                                <span class="badge-status" style="background:#f8d7da;color:#b02a37;">Ditolak</span>
                                            <?php else: ?>
                                                <span class="badge-status" style="background:#fff3cd;color:#856404;">Pending</span>
                                            <?php endif; ?>
                                        </td>
                                        <td><small class="text-muted"><?= htmlspecialchars($data['tanggal_daftar'] ?? '-'); ?></small></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                <?php else: ?>

                    <div class="text-center py-5">
                        <i class="bi bi-inbox fs-1 text-muted"></i>
                        <p class="text-muted mt-3 mb-0">Belum ada data pendaftaran.</p>
                    </div>

                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="col-12 col-xl-4">
        <div class="card status-card h-100">
            <div class="card-body p-4">
                <h5 class="fw-bold mb-4">Akses Cepat</h5>
                <div class="d-flex flex-column gap-3">

                    <a href="<?= BASE_URL ?>/admin/anggota" class="btn btn-light border quick-menu text-start p-3">
                        <i class="bi bi-people-fill text-warning me-2"></i>Kelola Anggota
                        <i class="bi bi-chevron-right float-end mt-1"></i>
                    </a>

                    <a href="<?= BASE_URL ?>/admin/berita" class="btn btn-light border quick-menu text-start p-3">
                        <i class="bi bi-newspaper text-warning me-2"></i>Kelola Berita
                        <i class="bi bi-chevron-right float-end mt-1"></i>
                    </a>

                    <a href="<?= BASE_URL ?>/admin/gallery" class="btn btn-light border quick-menu text-start p-3">
                        <i class="bi bi-images text-warning me-2"></i>Kelola Galeri
                        <i class="bi bi-chevron-right float-end mt-1"></i>
                    </a>

                    <a href="<?= BASE_URL ?>/admin/pendaftaran" class="btn btn-light border quick-menu text-start p-3">
                        <i class="bi bi-person-plus-fill text-warning me-2"></i>Pendaftaran
                        <i class="bi bi-chevron-right float-end mt-1"></i>
                    </a>

                </div>
            </div>
        </div>
    </div>

</div>


<div class="card status-card">
    <div class="card-body p-4">
        <div class="d-flex align-items-center gap-3">
            <div class="dashboard-icon"><i class="bi bi-info-circle-fill"></i></div>
            <div>
                <h6 class="fw-bold mb-1">SISPALA Mahardika</h6>
                <p class="text-muted mb-0 small">Sistem Informasi Pengelolaan Organisasi Siswa Pecinta Alam Mahardika.</p>
            </div>
        </div>
    </div>
</div>


<?php

$content = ob_get_clean();

require ROOT_PATH . '/app/Views/layouts/admin_layout.php';

?>
