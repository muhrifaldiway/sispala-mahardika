<?php

$pageTitle = 'Anggota';

$activeMenu = 'anggota';

ob_start();

$totalAnggota = count($anggota);

$totalAktif = count(
    array_filter(
        $anggota,
        function ($item) {
            return $item['status'] === 'aktif';
        }
    )
);

$totalNonaktif = $totalAnggota - $totalAktif;

?>

<!-- =========================================================
     HEADER
========================================================= -->

<div class="d-flex flex-column flex-md-row
            justify-content-between align-items-md-center
            gap-3 mb-4">

    <div>

        <div class="d-flex align-items-center gap-2 mb-1">

            <div
                class="d-flex align-items-center justify-content-center rounded-3"
                style="
                    width:42px;
                    height:42px;
                    background:rgba(239, 108, 49,.12);
                    color:#ef6c31;
                ">

                <i class="bi bi-people fs-5"></i>

            </div>

            <div>

                <h4 class="fw-bold mb-0">
                    Data Anggota
                </h4>

                <small class="text-muted">
                    Kelola anggota SISPALA Mahardika
                </small>

            </div>

        </div>

    </div>


    <a
        href="<?= BASE_URL ?>/admin/anggota/create"
        class="btn text-white px-3 py-2"
        style="
            background:#ef6c31;
            border-radius:10px;
        ">

        <i class="bi bi-person-plus me-1"></i>

        Tambah Anggota

    </a>

</div>


<!-- =========================================================
     STATISTIK
========================================================= -->

<div class="row g-3 mb-4">

    <div class="col-md-4">

        <div class="card border-0 shadow-sm rounded-4 h-100">

            <div class="card-body p-4">

                <div class="d-flex align-items-center
                            justify-content-between">

                    <div>

                        <p class="text-muted mb-1 small">
                            Total Anggota
                        </p>

                        <h3 class="fw-bold mb-0">
                            <?= $totalAnggota; ?>
                        </h3>

                    </div>

                    <div
                        class="rounded-3 d-flex
                               align-items-center justify-content-center"
                        style="
                            width:48px;
                            height:48px;
                            background:rgba(10, 47, 39,.08);
                            color:#0a2f27;
                        ">

                        <i class="bi bi-people fs-4"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>


    <div class="col-md-4">

        <div class="card border-0 shadow-sm rounded-4 h-100">

            <div class="card-body p-4">

                <div class="d-flex align-items-center
                            justify-content-between">

                    <div>

                        <p class="text-muted mb-1 small">
                            Anggota Aktif
                        </p>

                        <h3 class="fw-bold text-success mb-0">
                            <?= $totalAktif; ?>
                        </h3>

                    </div>

                    <div
                        class="rounded-3 d-flex
                               align-items-center justify-content-center"
                        style="
                            width:48px;
                            height:48px;
                            background:rgba(25,135,84,.10);
                            color:#198754;
                        ">

                        <i class="bi bi-person-check fs-4"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>


    <div class="col-md-4">

        <div class="card border-0 shadow-sm rounded-4 h-100">

            <div class="card-body p-4">

                <div class="d-flex align-items-center
                            justify-content-between">

                    <div>

                        <p class="text-muted mb-1 small">
                            Nonaktif
                        </p>

                        <h3 class="fw-bold text-secondary mb-0">
                            <?= $totalNonaktif; ?>
                        </h3>

                    </div>

                    <div
                        class="rounded-3 d-flex
                               align-items-center justify-content-center"
                        style="
                            width:48px;
                            height:48px;
                            background:rgba(108,117,125,.10);
                            color:#6C757D;
                        ">

                        <i class="bi bi-person-dash fs-4"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>


<!-- =========================================================
     ALERT
========================================================= -->

<?php if (isset($_SESSION['success'])): ?>

    <div
        class="alert alert-success
               border-0 shadow-sm
               d-flex align-items-center
               rounded-4 mb-4">

        <i class="bi bi-check-circle-fill me-2"></i>

        <?= htmlspecialchars($_SESSION['success']); ?>

    </div>

    <?php unset($_SESSION['success']); ?>

<?php endif; ?>


<?php if (isset($_SESSION['error'])): ?>

    <div
        class="alert alert-danger
               border-0 shadow-sm
               d-flex align-items-center
               rounded-4 mb-4">

        <i class="bi bi-exclamation-circle-fill me-2"></i>

        <?= htmlspecialchars($_SESSION['error']); ?>

    </div>

    <?php unset($_SESSION['error']); ?>

<?php endif; ?>


<!-- =========================================================
     TABEL
========================================================= -->

<div class="card border-0 shadow-sm rounded-4 overflow-hidden">

    <!-- TOOLBAR -->

    <div
        class="card-header
               bg-white
               border-0
               p-4">

        <div
            class="row
                   align-items-center
                   g-3">


            <!-- SEARCH -->

            <div class="col-md-6">

                <div class="position-relative">

                    <i
                        class="bi bi-search
                               position-absolute
                               top-50
                               translate-middle-y
                               ms-3
                               text-muted">
                    </i>

                    <input
                        type="text"
                        id="searchAnggota"
                        class="form-control ps-5"
                        placeholder="Cari nama, NIS, kelas atau jabatan...">

                </div>

            </div>


            <!-- FILTER -->

            <div class="col-md-3">

                <select
                    id="filterStatus"
                    class="form-select">

                    <option value="">
                        Semua Status
                    </option>

                    <option value="aktif">
                        Aktif
                    </option>

                    <option value="nonaktif">
                        Nonaktif
                    </option>

                </select>

            </div>


            <!-- INFO -->

            <div class="col-md-3 text-md-end">

                <span class="text-muted small">

                    Total:
                    <strong id="totalData">
                        <?= $totalAnggota; ?>
                    </strong>
                    anggota

                </span>

            </div>

        </div>

    </div>


    <div class="table-responsive">

        <table
            class="table
                   table-hover
                   align-middle
                   mb-0"
            id="anggotaTable">


            <thead
                style="
                    background:#F8FAFC;
                ">

                <tr>

                    <th class="px-4 py-3">
                        Anggota
                    </th>

                    <th>
                        Kelas
                    </th>

                    <th>
                        Angkatan
                    </th>

                    <th>
                        Jabatan
                    </th>

                    <th>
                        Kontak
                    </th>

                    <th>
                        Status
                    </th>

                    <th class="text-end px-4">
                        Aksi
                    </th>

                </tr>

            </thead>


            <tbody
                id="anggotaTableBody">


            <?php if (!empty($anggota)): ?>

                <?php foreach ($anggota as $item): ?>


                    <tr
                        data-status="<?= htmlspecialchars($item['status']); ?>">


                        <!-- FOTO + NAMA -->

                        <td class="px-4">

                            <div
                                class="d-flex
                                       align-items-center
                                       gap-3">


                                <!-- FOTO -->

                                <div
                                    class="flex-shrink-0">

                                    <?php if (!empty($item['foto'])): ?>

                                        <img
                                            src="<?= BASE_URL ?>/uploads/anggota/<?= htmlspecialchars($item['foto']); ?>"
                                            alt="<?= htmlspecialchars($item['nama']); ?>"
                                            class="rounded-circle"
                                            style="
                                                width:46px;
                                                height:46px;
                                                object-fit:cover;
                                            ">

                                    <?php else: ?>

                                        <div
                                            class="rounded-circle
                                                   d-flex
                                                   align-items-center
                                                   justify-content-center"
                                            style="
                                                width:46px;
                                                height:46px;
                                                background:rgba(10, 47, 39,.08);
                                                color:#0a2f27;
                                            ">

                                            <i class="bi bi-person fs-5"></i>

                                        </div>

                                    <?php endif; ?>

                                </div>


                                <!-- IDENTITAS -->

                                <div>

                                    <div class="fw-semibold">

                                        <?= htmlspecialchars(
                                            $item['nama']
                                        ); ?>

                                    </div>


                                    <small class="text-muted">

                                        NIS:

                                        <?= htmlspecialchars(
                                            $item['nis'] ?: '-'
                                        ); ?>

                                    </small>

                                </div>

                            </div>

                        </td>


                        <!-- KELAS -->

                        <td>

                            <?= htmlspecialchars(
                                $item['kelas'] ?: '-'
                            ); ?>

                        </td>


                        <!-- ANGKATAN -->

                        <td>

                            <span
                                class="badge
                                       rounded-pill
                                       text-dark"
                                style="
                                    background:#FFF0E6;
                                ">

                                <?= htmlspecialchars(
                                    $item['angkatan'] ?: '-'
                                ); ?>

                            </span>

                        </td>


                        <!-- JABATAN -->

                        <td>

                            <?= htmlspecialchars(
                                $item['jabatan'] ?: '-'
                            ); ?>

                        </td>


                        <!-- KONTAK -->

                        <td>

                            <?php if (!empty($item['no_hp'])): ?>

                                <small>

                                    <i
                                        class="bi bi-whatsapp
                                               text-success me-1">
                                    </i>

                                    <?= htmlspecialchars(
                                        $item['no_hp']
                                    ); ?>

                                </small>

                            <?php else: ?>

                                <span class="text-muted">
                                    -
                                </span>

                            <?php endif; ?>

                        </td>


                        <!-- STATUS -->

                        <td>

                            <?php if (
                                $item['status'] === 'aktif'
                            ): ?>

                                <span
                                    class="badge
                                           rounded-pill
                                           text-success"
                                    style="
                                        background:rgba(25,135,84,.12);
                                    ">

                                    <i
                                        class="bi bi-check-circle-fill
                                               me-1">
                                    </i>

                                    Aktif

                                </span>

                            <?php else: ?>

                                <span
                                    class="badge
                                           rounded-pill
                                           text-secondary"
                                    style="
                                        background:rgba(108,117,125,.12);
                                    ">

                                    <i
                                        class="bi bi-pause-circle-fill
                                               me-1">
                                    </i>

                                    Nonaktif

                                </span>

                            <?php endif; ?>

                        </td>


                        <!-- AKSI -->

                        <td
                            class="text-end px-4">

                            <div
                                class="btn-group">

                                <a
                                    href="<?= BASE_URL ?>/admin/anggota/edit/<?= $item['id']; ?>"
                                    class="btn
                                           btn-sm
                                           btn-light
                                           border"
                                    title="Edit Anggota">

                                    <i
                                        class="bi bi-pencil
                                               text-primary">
                                    </i>

                                </a>


                                <form
                                    method="POST"
                                    action="<?= BASE_URL ?>/admin/anggota/delete/<?= $item['id']; ?>"
                                    class="d-inline"
                                    onsubmit="return confirm('Yakin ingin menghapus <?= htmlspecialchars($item['nama'], ENT_QUOTES); ?>?');">


                                    <button
                                        type="submit"
                                        class="btn
                                               btn-sm
                                               btn-light
                                               border"
                                        title="Hapus Anggota">

                                        <i
                                            class="bi bi-trash
                                                   text-danger">
                                        </i>

                                    </button>

                                </form>

                            </div>

                        </td>


                    </tr>


                <?php endforeach; ?>


            <?php else: ?>


                <tr>

                    <td
                        colspan="7"
                        class="text-center py-5">

                        <div
                            class="d-flex
                                   flex-column
                                   align-items-center">

                            <div
                                class="rounded-circle
                                       d-flex
                                       align-items-center
                                       justify-content-center
                                       mb-3"
                                style="
                                    width:70px;
                                    height:70px;
                                    background:#F4F6F9;
                                ">

                                <i
                                    class="bi bi-people
                                           fs-2
                                           text-muted">
                                </i>

                            </div>


                            <h6 class="fw-semibold">
                                Belum ada anggota
                            </h6>


                            <p
                                class="text-muted
                                       small
                                       mb-3">

                                Tambahkan anggota pertama
                                SISPALA Mahardika.

                            </p>


                            <a
                                href="<?= BASE_URL ?>/admin/anggota/create"
                                class="btn btn-sm text-white"
                                style="
                                    background:#ef6c31;
                                ">

                                <i class="bi bi-plus-lg me-1"></i>

                                Tambah Anggota

                            </a>

                        </div>

                    </td>

                </tr>


            <?php endif; ?>


            </tbody>

        </table>

    </div>

</div>


<!-- =========================================================
     JAVASCRIPT SEARCH + FILTER
========================================================= -->

<script>

document.addEventListener(
    'DOMContentLoaded',
    function () {


        const searchInput =
            document.getElementById(
                'searchAnggota'
            );


        const statusFilter =
            document.getElementById(
                'filterStatus'
            );


        const rows =
            document.querySelectorAll(
                '#anggotaTableBody tr[data-status]'
            );


        const totalData =
            document.getElementById(
                'totalData'
            );


        function filterData()
        {

            const keyword =
                searchInput.value
                    .toLowerCase()
                    .trim();


            const status =
                statusFilter.value;


            let visible =
                0;


            rows.forEach(
                function (row)
                {

                    const text =
                        row.innerText
                            .toLowerCase();


                    const rowStatus =
                        row.dataset.status;


                    const matchKeyword =
                        text.includes(keyword);


                    const matchStatus =
                        status === ''
                        ||
                        rowStatus === status;


                    if (
                        matchKeyword
                        &&
                        matchStatus
                    ) {

                        row.style.display =
                            '';

                        visible++;

                    } else {

                        row.style.display =
                            'none';

                    }

                }
            );


            totalData.textContent =
                visible;

        }


        searchInput.addEventListener(
            'input',
            filterData
        );


        statusFilter.addEventListener(
            'change',
            filterData
        );

    }
);

</script>


<?php

$content = ob_get_clean();

require ROOT_PATH .
    '/app/Views/layouts/admin_layout.php';

?>