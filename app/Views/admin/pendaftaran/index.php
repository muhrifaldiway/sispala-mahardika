<?php

$pageTitle = 'Pendaftaran';

$activeMenu = 'pendaftaran';

ob_start();

?>

<style>

    .stat-card {
        border: 0;
        border-radius: 18px;
    }

    .stat-icon {
        width: 48px;
        height: 48px;
        border-radius: 14px;

        display: flex;
        align-items: center;
        justify-content: center;

        font-size: 21px;
    }

    .table-card {
        border: 0;
        border-radius: 18px;
        overflow: hidden;
    }

    .table thead th {
        background: #f8fafc;
        color: #64748b;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: .4px;
        white-space: nowrap;
    }

    .table tbody td {
        vertical-align: middle;
    }

    .avatar {
        width: 42px;
        height: 42px;

        border-radius: 50%;

        background: #eef2f7;
        color: #0a2f27;

        display: flex;
        align-items: center;
        justify-content: center;

        font-weight: 700;
    }

    .badge-status {
        padding: 7px 10px;
        border-radius: 8px;
        font-size: 11px;
    }

    .btn-orange {
        background: #ef6c31;
        border-color: #ef6c31;
        color: white;
        border-radius: 9px;
    }

    .btn-orange:hover {
        background: #d97816;
        border-color: #d97816;
        color: white;
    }

</style>


<!-- HEADER -->

<div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">

    <div>

        <h4
            class="fw-bold mb-1"
            style="color:#0a2f27;"
        >
            Pendaftaran
        </h4>

        <p class="text-muted mb-0">
            Kelola data pendaftaran calon anggota SISPALA Mahardika.
        </p>

    </div>


    <a
        href="<?= BASE_URL ?>/admin/pendaftaran/create"
        class="btn btn-orange"
    >

        <i class="bi bi-plus-lg me-2"></i>

        Tambah Pendaftaran

    </a>

</div>


<!-- ALERT -->

<?php if (isset($_SESSION['success'])): ?>

    <div class="alert alert-success border-0 shadow-sm rounded-3">

        <i class="bi bi-check-circle me-2"></i>

        <?= htmlspecialchars($_SESSION['success']); ?>

    </div>

    <?php unset($_SESSION['success']); ?>

<?php endif; ?>


<?php if (isset($_SESSION['error'])): ?>

    <div class="alert alert-danger border-0 shadow-sm rounded-3">

        <i class="bi bi-exclamation-circle me-2"></i>

        <?= htmlspecialchars($_SESSION['error']); ?>

    </div>

    <?php unset($_SESSION['error']); ?>

<?php endif; ?>


<!-- STATISTIK -->

<div class="row g-3 mb-4">


    <div class="col-md-3">

        <div class="card stat-card shadow-sm h-100">

            <div class="card-body d-flex align-items-center gap-3">

                <div
                    class="stat-icon"
                    style="
                        background:rgba(10, 47, 39,.08);
                        color:#0a2f27;
                    "
                >

                    <i class="bi bi-people"></i>

                </div>

                <div>

                    <div class="text-muted small">
                        Total
                    </div>

                    <h4 class="fw-bold mb-0">
                        <?= $total; ?>
                    </h4>

                </div>

            </div>

        </div>

    </div>


    <div class="col-md-3">

        <div class="card stat-card shadow-sm h-100">

            <div class="card-body d-flex align-items-center gap-3">

                <div
                    class="stat-icon"
                    style="
                        background:rgba(239, 108, 49,.12);
                        color:#ef6c31;
                    "
                >

                    <i class="bi bi-hourglass-split"></i>

                </div>

                <div>

                    <div class="text-muted small">
                        Pending
                    </div>

                    <h4 class="fw-bold mb-0">
                        <?= $pending; ?>
                    </h4>

                </div>

            </div>

        </div>

    </div>


    <div class="col-md-3">

        <div class="card stat-card shadow-sm h-100">

            <div class="card-body d-flex align-items-center gap-3">

                <div
                    class="stat-icon"
                    style="
                        background:rgba(25,135,84,.10);
                        color:#198754;
                    "
                >

                    <i class="bi bi-check-circle"></i>

                </div>

                <div>

                    <div class="text-muted small">
                        Diterima
                    </div>

                    <h4 class="fw-bold mb-0">
                        <?= $diterima; ?>
                    </h4>

                </div>

            </div>

        </div>

    </div>


    <div class="col-md-3">

        <div class="card stat-card shadow-sm h-100">

            <div class="card-body d-flex align-items-center gap-3">

                <div
                    class="stat-icon"
                    style="
                        background:rgba(220,53,69,.10);
                        color:#dc3545;
                    "
                >

                    <i class="bi bi-x-circle"></i>

                </div>

                <div>

                    <div class="text-muted small">
                        Ditolak
                    </div>

                    <h4 class="fw-bold mb-0">
                        <?= $ditolak; ?>
                    </h4>

                </div>

            </div>

        </div>

    </div>

</div>


<!-- FILTER -->

<div class="card table-card shadow-sm mb-4">

    <div class="card-body">

        <form
            method="GET"
            action="<?= BASE_URL ?>/admin/pendaftaran"
        >

            <div class="row g-2">

                <div class="col-md-7">

                    <input
                        type="text"
                        name="search"
                        class="form-control"
                        placeholder="Cari nama, nomor pendaftaran, NIS, atau nomor HP..."
                        value="<?= htmlspecialchars($search); ?>"
                    >

                </div>


                <div class="col-md-3">

                    <select
                        name="status"
                        class="form-select"
                    >

                        <option value="">
                            Semua Status
                        </option>

                        <option
                            value="pending"
                            <?= $status === 'pending' ? 'selected' : ''; ?>
                        >
                            Pending
                        </option>

                        <option
                            value="diterima"
                            <?= $status === 'diterima' ? 'selected' : ''; ?>
                        >
                            Diterima
                        </option>

                        <option
                            value="ditolak"
                            <?= $status === 'ditolak' ? 'selected' : ''; ?>
                        >
                            Ditolak
                        </option>

                    </select>

                </div>


                <div class="col-md-2 d-grid">

                    <button
                        type="submit"
                        class="btn btn-dark"
                    >

                        <i class="bi bi-search me-1"></i>

                        Cari

                    </button>

                </div>

            </div>

        </form>

    </div>

</div>


<!-- TABLE -->

<div class="card table-card shadow-sm">

    <div class="card-body p-0">

        <div class="table-responsive">

            <table class="table table-hover mb-0">

                <thead>

                    <tr>

                        <th class="px-4 py-3">
                            No
                        </th>

                        <th class="py-3">
                            Pendaftar
                        </th>

                        <th class="py-3">
                            Nomor
                        </th>

                        <th class="py-3">
                            Kelas
                        </th>

                        <th class="py-3">
                            No HP
                        </th>

                        <th class="py-3">
                            Status
                        </th>

                        <th class="py-3 text-end pe-4">
                            Aksi
                        </th>

                    </tr>

                </thead>


                <tbody>

                    <?php if (empty($data)): ?>

                        <tr>

                            <td
                                colspan="7"
                                class="text-center py-5"
                            >

                                <i
                                    class="bi bi-inbox fs-1 text-muted"
                                ></i>

                                <div class="fw-semibold mt-2">
                                    Belum ada data pendaftaran
                                </div>

                                <small class="text-muted">
                                    Data pendaftaran akan muncul di sini.
                                </small>

                            </td>

                        </tr>

                    <?php else: ?>


                        <?php foreach ($data as $index => $row): ?>

                            <?php

                            $nama =
                                $row['nama_lengkap'];

                            $inisial =
                                strtoupper(
                                    substr(
                                        $nama,
                                        0,
                                        1
                                    )
                                );

                            ?>


                            <tr>

                                <td class="px-4">

                                    <?= $index + 1; ?>

                                </td>


                                <td>

                                    <div class="d-flex align-items-center gap-3">

                                        <div class="avatar">

                                            <?= htmlspecialchars($inisial); ?>

                                        </div>


                                        <div>

                                            <div class="fw-semibold">

                                                <?= htmlspecialchars($nama); ?>

                                            </div>

                                            <small class="text-muted">

                                                <?= htmlspecialchars(
                                                    $row['nis'] ?: '-'
                                                ); ?>

                                            </small>

                                        </div>

                                    </div>

                                </td>


                                <td>

                                    <span class="fw-semibold">

                                        <?= htmlspecialchars(
                                            $row['nomor_pendaftaran']
                                        ); ?>

                                    </span>

                                </td>


                                <td>

                                    <?= htmlspecialchars(
                                        $row['kelas'] ?: '-'
                                    ); ?>

                                </td>


                                <td>

                                    <?= htmlspecialchars(
                                        $row['no_hp'] ?: '-'
                                    ); ?>

                                </td>


                                <td>

                                    <?php if ($row['status'] === 'diterima'): ?>

                                        <span class="badge bg-success badge-status">
                                            Diterima
                                        </span>

                                    <?php elseif ($row['status'] === 'ditolak'): ?>

                                        <span class="badge bg-danger badge-status">
                                            Ditolak
                                        </span>

                                    <?php else: ?>

                                        <span class="badge bg-warning text-dark badge-status">
                                            Pending
                                        </span>

                                    <?php endif; ?>

                                </td>


                                <td class="text-end pe-4">

                                    <div class="dropdown">

                                        <button
                                            class="btn btn-sm btn-light border"
                                            data-bs-toggle="dropdown"
                                        >

                                            <i class="bi bi-three-dots"></i>

                                        </button>


                                        <ul class="dropdown-menu dropdown-menu-end">

                                            <li>

                                                <a
                                                    class="dropdown-item"
                                                    href="<?= BASE_URL ?>/admin/pendaftaran/show/<?= $row['id']; ?>"
                                                >

                                                    <i class="bi bi-eye me-2"></i>

                                                    Detail

                                                </a>

                                            </li>


                                            <li>

                                                <a
                                                    class="dropdown-item"
                                                    href="<?= BASE_URL ?>/admin/pendaftaran/edit/<?= $row['id']; ?>"
                                                >

                                                    <i class="bi bi-pencil me-2"></i>

                                                    Edit

                                                </a>

                                            </li>


                                            <li>
                                                <hr class="dropdown-divider">
                                            </li>


                                            <li>

                                                <a
                                                    class="dropdown-item text-danger"
                                                    href="<?= BASE_URL ?>/admin/pendaftaran/delete/<?= $row['id']; ?>"
                                                    onclick="return confirm('Yakin ingin menghapus data pendaftaran ini?')"
                                                >

                                                    <i class="bi bi-trash me-2"></i>

                                                    Hapus

                                                </a>

                                            </li>

                                        </ul>

                                    </div>

                                </td>

                            </tr>

                        <?php endforeach; ?>

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