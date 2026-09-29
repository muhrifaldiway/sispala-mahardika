<?php

$pageTitle = 'Edit Pendaftaran';

$activeMenu = 'pendaftaran';

ob_start();

?>

<div class="mb-4">

    <a
        href="<?= BASE_URL ?>/admin/pendaftaran"
        class="text-muted text-decoration-none"
    >

        <i class="bi bi-arrow-left me-1"></i>

        Kembali ke Pendaftaran

    </a>


    <h4
        class="fw-bold mt-3 mb-1"
        style="color:#0a2f27;"
    >

        Edit Pendaftaran

    </h4>

    <p class="text-muted mb-0">

        <?= htmlspecialchars(
            $data['nomor_pendaftaran']
        ); ?>

    </p>

</div>


<?php if (isset($_SESSION['error'])): ?>

    <div class="alert alert-danger">

        <?= htmlspecialchars(
            $_SESSION['error']
        ); ?>

    </div>

    <?php unset($_SESSION['error']); ?>

<?php endif; ?>


<div class="card border-0 shadow-sm rounded-4">

    <div class="card-body p-4 p-lg-5">

        <form
            method="POST"
            action="<?= BASE_URL ?>/admin/pendaftaran/update/<?= $data['id']; ?>"
        >


            <div class="row g-4">


                <div class="col-md-6">

                    <label class="form-label fw-semibold">
                        Nomor Pendaftaran
                    </label>

                    <input
                        type="text"
                        class="form-control"
                        value="<?= htmlspecialchars(
                            $data['nomor_pendaftaran']
                        ); ?>"
                        readonly
                    >

                </div>


                <div class="col-md-6">

                    <label class="form-label fw-semibold">
                        Nama Lengkap *
                    </label>

                    <input
                        type="text"
                        name="nama_lengkap"
                        class="form-control"
                        value="<?= htmlspecialchars(
                            $data['nama_lengkap']
                        ); ?>"
                        required
                    >

                </div>


                <div class="col-md-4">

                    <label class="form-label fw-semibold">
                        NIS
                    </label>

                    <input
                        type="text"
                        name="nis"
                        class="form-control"
                        value="<?= htmlspecialchars(
                            $data['nis']
                        ); ?>"
                    >

                </div>


                <div class="col-md-4">

                    <label class="form-label fw-semibold">
                        Jenis Kelamin *
                    </label>

                    <select
                        name="jenis_kelamin"
                        class="form-select"
                        required
                    >

                        <option
                            value="L"
                            <?= $data['jenis_kelamin'] === 'L'
                                ? 'selected'
                                : ''; ?>
                        >
                            Laki-laki
                        </option>

                        <option
                            value="P"
                            <?= $data['jenis_kelamin'] === 'P'
                                ? 'selected'
                                : ''; ?>
                        >
                            Perempuan
                        </option>

                    </select>

                </div>


                <div class="col-md-4">

                    <label class="form-label fw-semibold">
                        Kelas
                    </label>

                    <input
                        type="text"
                        name="kelas"
                        class="form-control"
                        value="<?= htmlspecialchars(
                            $data['kelas']
                        ); ?>"
                    >

                </div>


                <div class="col-md-4">

                    <label class="form-label fw-semibold">
                        Angkatan
                    </label>

                    <input
                        type="text"
                        name="angkatan"
                        class="form-control"
                        value="<?= htmlspecialchars(
                            $data['angkatan']
                        ); ?>"
                    >

                </div>


                <div class="col-md-4">

                    <label class="form-label fw-semibold">
                        Tempat Lahir
                    </label>

                    <input
                        type="text"
                        name="tempat_lahir"
                        class="form-control"
                        value="<?= htmlspecialchars(
                            $data['tempat_lahir']
                        ); ?>"
                    >

                </div>


                <div class="col-md-4">

                    <label class="form-label fw-semibold">
                        Tanggal Lahir
                    </label>

                    <input
                        type="date"
                        name="tanggal_lahir"
                        class="form-control"
                        value="<?= htmlspecialchars(
                            $data['tanggal_lahir']
                        ); ?>"
                    >

                </div>


                <div class="col-md-6">

                    <label class="form-label fw-semibold">
                        Nomor HP
                    </label>

                    <input
                        type="text"
                        name="no_hp"
                        class="form-control"
                        value="<?= htmlspecialchars(
                            $data['no_hp']
                        ); ?>"
                    >

                </div>


                <div class="col-md-6">

                    <label class="form-label fw-semibold">
                        Status
                    </label>

                    <select
                        name="status"
                        class="form-select"
                    >

                        <option
                            value="pending"
                            <?= $data['status'] === 'pending'
                                ? 'selected'
                                : ''; ?>
                        >
                            Pending
                        </option>

                        <option
                            value="diterima"
                            <?= $data['status'] === 'diterima'
                                ? 'selected'
                                : ''; ?>
                        >
                            Diterima
                        </option>

                        <option
                            value="ditolak"
                            <?= $data['status'] === 'ditolak'
                                ? 'selected'
                                : ''; ?>
                        >
                            Ditolak
                        </option>

                    </select>

                </div>


                <div class="col-12">

                    <label class="form-label fw-semibold">
                        Alamat
                    </label>

                    <textarea
                        name="alamat"
                        class="form-control"
                        rows="4"
                    ><?= htmlspecialchars(
                        $data['alamat']
                    ); ?></textarea>

                </div>


                <div class="col-12">

                    <label class="form-label fw-semibold">
                        Alasan Bergabung
                    </label>

                    <textarea
                        name="alasan"
                        class="form-control"
                        rows="4"
                    ><?= htmlspecialchars(
                        $data['alasan']
                    ); ?></textarea>

                </div>


                <div class="col-12">

                    <label class="form-label fw-semibold">
                        Pengalaman
                    </label>

                    <textarea
                        name="pengalaman"
                        class="form-control"
                        rows="4"
                    ><?= htmlspecialchars(
                        $data['pengalaman']
                    ); ?></textarea>

                </div>


                <div class="col-12">

                    <label class="form-label fw-semibold">
                        Catatan Admin
                    </label>

                    <textarea
                        name="catatan"
                        class="form-control"
                        rows="4"
                        placeholder="Catatan untuk pendaftar..."
                    ><?= htmlspecialchars(
                        $data['catatan']
                    ); ?></textarea>

                </div>


            </div>


            <div class="d-flex justify-content-end gap-2 mt-4">

                <a
                    href="<?= BASE_URL ?>/admin/pendaftaran"
                    class="btn btn-light border"
                >
                    Batal
                </a>


                <button
                    type="submit"
                    class="btn btn-warning"
                >

                    <i class="bi bi-save me-2"></i>

                    Simpan Perubahan

                </button>

            </div>


        </form>

    </div>

</div>


<?php

$content = ob_get_clean();

require ROOT_PATH . '/app/Views/layouts/admin_layout.php';

?>