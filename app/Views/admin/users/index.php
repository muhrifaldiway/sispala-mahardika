<?php

$pageTitle = 'Users Admin';

$activeMenu = 'users';

ob_start();

?>

<div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">

    <div>

        <h4 class="fw-bold mb-1" style="color:#0a2f27;">
            Users Admin
        </h4>

        <p class="text-muted mb-0">
            Kelola akun administrator SISPALA Mahardika.
        </p>

    </div>


    <a
        href="<?= BASE_URL ?>/admin/users/create"
        class="btn btn-orange"
    >

        <i class="bi bi-person-plus me-2"></i>

        Tambah Admin

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

<div class="row g-4 mb-4">


    <!-- TOTAL -->

    <div class="col-12 col-md-4">

        <div class="card border-0 shadow-sm rounded-4">

            <div class="card-body p-4">

                <div class="d-flex justify-content-between">

                    <div>

                        <small class="text-muted">
                            Total Admin
                        </small>

                        <h3 class="fw-bold mt-2 mb-0">
                            <?= $total; ?>
                        </h3>

                    </div>


                    <div
                        class="d-flex align-items-center justify-content-center rounded-3"
                        style="
                            width:50px;
                            height:50px;
                            background:rgba(239, 108, 49,.12);
                            color:#ef6c31;
                        "
                    >

                        <i class="bi bi-people-fill fs-4"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>


    <!-- AKTIF -->

    <div class="col-12 col-md-4">

        <div class="card border-0 shadow-sm rounded-4">

            <div class="card-body p-4">

                <div class="d-flex justify-content-between">

                    <div>

                        <small class="text-muted">
                            Admin Aktif
                        </small>

                        <h3 class="fw-bold mt-2 mb-0">
                            <?= $aktif; ?>
                        </h3>

                    </div>


                    <div
                        class="d-flex align-items-center justify-content-center rounded-3"
                        style="
                            width:50px;
                            height:50px;
                            background:rgba(25,135,84,.12);
                            color:#198754;
                        "
                    >

                        <i class="bi bi-person-check-fill fs-4"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>


    <!-- NONAKTIF -->

    <div class="col-12 col-md-4">

        <div class="card border-0 shadow-sm rounded-4">

            <div class="card-body p-4">

                <div class="d-flex justify-content-between">

                    <div>

                        <small class="text-muted">
                            Admin Nonaktif
                        </small>

                        <h3 class="fw-bold mt-2 mb-0">
                            <?= $nonaktif; ?>
                        </h3>

                    </div>


                    <div
                        class="d-flex align-items-center justify-content-center rounded-3"
                        style="
                            width:50px;
                            height:50px;
                            background:rgba(220,53,69,.12);
                            color:#dc3545;
                        "
                    >

                        <i class="bi bi-person-x-fill fs-4"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>


<!-- TABEL -->

<div class="card border-0 shadow-sm rounded-4">

    <div class="card-body p-4">


        <!-- SEARCH -->

        <form
            method="GET"
            action="<?= BASE_URL ?>/admin/users"
            class="mb-4"
        >

            <div class="input-group">

                <span class="input-group-text bg-white">

                    <i class="bi bi-search"></i>

                </span>


                <input
                    type="text"
                    name="search"
                    class="form-control"
                    placeholder="Cari nama, username, atau role..."
                    value="<?= htmlspecialchars($search); ?>"
                >


                <button
                    type="submit"
                    class="btn btn-dark"
                >

                    Cari

                </button>


                <?php if ($search !== ''): ?>

                    <a
                        href="<?= BASE_URL ?>/admin/users"
                        class="btn btn-light border"
                    >

                        Reset

                    </a>

                <?php endif; ?>

            </div>

        </form>


        <div class="table-responsive">

            <table class="table align-middle mb-0">

                <thead>

                    <tr>

                        <th width="60">
                            #
                        </th>

                        <th>
                            Admin
                        </th>

                        <th>
                            Username
                        </th>

                        <th>
                            Role
                        </th>

                        <th>
                            Status
                        </th>

                        <th>
                            Dibuat
                        </th>

                        <th
                            class="text-end"
                            width="160"
                        >
                            Aksi
                        </th>

                    </tr>

                </thead>


                <tbody>

                <?php if (!empty($users)): ?>

                    <?php foreach ($users as $index => $user): ?>

                        <tr>


                            <!-- NO -->

                            <td>

                                <?= $index + 1; ?>

                            </td>


                            <!-- ADMIN -->

                            <td>

                                <div class="d-flex align-items-center gap-3">

                                    <div
                                        class="d-flex align-items-center justify-content-center rounded-circle"
                                        style="
                                            width:42px;
                                            height:42px;
                                            background:rgba(10, 47, 39,.08);
                                            color:#0a2f27;
                                        "
                                    >

                                        <i class="bi bi-person-fill"></i>

                                    </div>


                                    <div>

                                        <div class="fw-semibold">

                                            <?= htmlspecialchars(
                                                $user['nama']
                                            ); ?>

                                        </div>

                                        <small class="text-muted">

                                            Administrator

                                        </small>

                                    </div>

                                </div>

                            </td>


                            <!-- USERNAME -->

                            <td>

                                <code>
                                    <?= htmlspecialchars(
                                        $user['username']
                                    ); ?>
                                </code>

                            </td>


                            <!-- ROLE -->

                            <td>

                                <span class="badge bg-dark">

                                    <?= htmlspecialchars(
                                        ucfirst($user['role'])
                                    ); ?>

                                </span>

                            </td>


                            <!-- STATUS -->

                            <td>

                                <?php if (
                                    $user['status'] === 'aktif'
                                ): ?>

                                    <span class="badge bg-success-subtle text-success">

                                        <i class="bi bi-check-circle me-1"></i>

                                        Aktif

                                    </span>

                                <?php else: ?>

                                    <span class="badge bg-danger-subtle text-danger">

                                        <i class="bi bi-x-circle me-1"></i>

                                        Nonaktif

                                    </span>

                                <?php endif; ?>

                            </td>


                            <!-- TANGGAL -->

                            <td>

                                <?php
                                if (!empty($user['created_at'])):

                                    echo date(
                                        'd/m/Y',
                                        strtotime(
                                            $user['created_at']
                                        )
                                    );

                                else:

                                    echo '-';

                                endif;
                                ?>

                            </td>


                            <!-- AKSI -->

                            <td class="text-end">

                                <div class="d-flex justify-content-end gap-1">


                                    <a
                                        href="<?= BASE_URL ?>/admin/users/edit/<?= $user['id']; ?>"
                                        class="btn btn-sm btn-light border"
                                        title="Edit"
                                    >

                                        <i class="bi bi-pencil"></i>

                                    </a>


                                    <?php
                                    $isCurrentUser =
                                        isset($_SESSION['user']['id']) &&
                                        (int) $_SESSION['user']['id'] ===
                                        (int) $user['id'];
                                    ?>


                                    <?php if (!$isCurrentUser): ?>

                                        <a
                                            href="<?= BASE_URL ?>/admin/users/delete/<?= $user['id']; ?>"
                                            class="btn btn-sm btn-light border text-danger"
                                            title="Hapus"
                                            onclick="return confirm('Yakin ingin menghapus admin ini?');"
                                        >

                                            <i class="bi bi-trash"></i>

                                        </a>

                                    <?php else: ?>

                                        <button
                                            type="button"
                                            class="btn btn-sm btn-light border text-muted"
                                            title="Akun yang sedang digunakan"
                                            disabled
                                        >

                                            <i class="bi bi-lock"></i>

                                        </button>

                                    <?php endif; ?>


                                </div>

                            </td>

                        </tr>

                    <?php endforeach; ?>

                <?php else: ?>

                    <tr>

                        <td
                            colspan="7"
                            class="text-center py-5"
                        >

                            <div class="text-muted">

                                <i class="bi bi-people fs-1 d-block mb-3"></i>

                                <?php if ($search !== ''): ?>

                                    Data admin dengan kata
                                    "<strong><?= htmlspecialchars($search); ?></strong>"
                                    tidak ditemukan.

                                <?php else: ?>

                                    Belum ada data admin.

                                <?php endif; ?>

                            </div>

                        </td>

                    </tr>

                <?php endif; ?>

                </tbody>

            </table>

        </div>

    </div>

</div>


<style>

.btn-orange {
    background: #ef6c31;
    border-color: #ef6c31;
    color: #fff;
    border-radius: 10px;
    padding: 10px 18px;
    font-weight: 600;
}

.btn-orange:hover {
    background: #D97816;
    border-color: #D97816;
    color: #fff;
}

.table thead th {
    color: #64748b;
    font-size: 13px;
    font-weight: 600;
    border-bottom: 1px solid #edf0f4;
}

.table tbody td {
    border-bottom: 1px solid #f0f2f5;
}

.table tbody tr:last-child td {
    border-bottom: 0;
}

</style>


<?php

$content = ob_get_clean();

require ROOT_PATH . '/app/Views/layouts/admin_layout.php';

?>