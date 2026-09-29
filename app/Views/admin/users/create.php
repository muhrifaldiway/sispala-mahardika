<?php

$pageTitle = 'Tambah Admin';

$activeMenu = 'users';

ob_start();

?>

<div class="mb-4">

    <a
        href="<?= BASE_URL ?>/admin/users"
        class="page-back"
    >

        <i class="bi bi-arrow-left me-1"></i>

        Kembali ke Users Admin

    </a>


    <div class="mt-3">

        <h4
            class="fw-bold mb-1"
            style="color:#0a2f27;"
        >

            Tambah Admin

        </h4>

        <p class="text-muted mb-0">

            Buat akun administrator baru.

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


<div class="card border-0 shadow-sm rounded-4">

    <div class="card-body p-4 p-lg-5">


        <form
            method="POST"
            action="<?= BASE_URL ?>/admin/users/store"
        >


            <!-- DATA ADMIN -->

            <div class="d-flex align-items-center gap-3 mb-4">

                <div
                    class="form-section-icon"
                >

                    <i class="bi bi-person-gear"></i>

                </div>

                <div>

                    <div class="form-section-title">
                        Informasi Admin
                    </div>

                    <small class="text-muted">
                        Data akun administrator
                    </small>

                </div>

            </div>


            <div class="row g-4">


                <!-- NAMA -->

                <div class="col-md-6">

                    <label class="form-label fw-semibold">

                        Nama Lengkap

                        <span class="required">*</span>

                    </label>

                    <input
                        type="text"
                        name="nama"
                        class="form-control"
                        placeholder="Masukkan nama lengkap"
                        required
                    >

                </div>


                <!-- USERNAME -->

                <div class="col-md-6">

                    <label class="form-label fw-semibold">

                        Username

                        <span class="required">*</span>

                    </label>

                    <input
                        type="text"
                        name="username"
                        class="form-control"
                        placeholder="Contoh: admin2"
                        autocomplete="off"
                        required
                    >

                    <div class="form-help">
                        Minimal 3 karakter.
                    </div>

                </div>


                <!-- PASSWORD -->

                <div class="col-md-6">

                    <label class="form-label fw-semibold">

                        Password

                        <span class="required">*</span>

                    </label>

                    <div class="input-group">

                        <input
                            type="password"
                            name="password"
                            id="password"
                            class="form-control"
                            placeholder="Masukkan password"
                            autocomplete="new-password"
                            required
                        >

                        <button
                            type="button"
                            class="btn btn-outline-secondary"
                            onclick="togglePassword()"
                        >

                            <i
                                id="passwordIcon"
                                class="bi bi-eye"
                            ></i>

                        </button>

                    </div>

                    <div class="form-help">
                        Minimal 6 karakter.
                    </div>

                </div>


                <!-- ROLE -->

                <div class="col-md-3">

                    <label class="form-label fw-semibold">
                        Role
                    </label>

                    <select
                        name="role"
                        class="form-select"
                    >

                        <option value="admin">
                            Admin
                        </option>

                    </select>

                </div>


                <!-- STATUS -->

                <div class="col-md-3">

                    <label class="form-label fw-semibold">
                        Status
                    </label>

                    <select
                        name="status"
                        class="form-select"
                    >

                        <option value="aktif">
                            Aktif
                        </option>

                        <option value="nonaktif">
                            Nonaktif
                        </option>

                    </select>

                </div>

            </div>


            <div class="form-divider"></div>


            <!-- ACTION -->

            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">

                <div class="small text-muted">

                    <span class="required">*</span>
                    Wajib diisi

                </div>


                <div class="d-flex gap-2">

                    <a
                        href="<?= BASE_URL ?>/admin/users"
                        class="btn btn-light border btn-cancel"
                    >

                        Batal

                    </a>


                    <button
                        type="submit"
                        class="btn btn-orange"
                    >

                        <i class="bi bi-save me-2"></i>

                        Simpan Admin

                    </button>

                </div>

            </div>


        </form>

    </div>

</div>


<style>

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
    background: rgba(239, 108, 49, 0.12);
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
    box-shadow: 0 0 0 0.2rem rgba(239, 108, 49, 0.12);
}

.form-divider {
    border-top: 1px solid #edf0f4;
    margin: 28px 0;
}

.form-help {
    font-size: 12px;
    color: #8a94a6;
    margin-top: 5px;
}

.required {
    color: #dc3545;
}

.page-back {
    color: #64748b;
    text-decoration: none;
    font-size: 14px;
}

.page-back:hover {
    color: #ef6c31;
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
    background: #D97816;
    border-color: #D97816;
    color: #fff;
}

.btn-cancel {
    border-radius: 10px;
    padding: 10px 20px;
    font-weight: 600;
}

</style>


<script>

function togglePassword()
{
    const input =
        document.getElementById('password');

    const icon =
        document.getElementById('passwordIcon');


    if (input.type === 'password') {

        input.type = 'text';

        icon.className =
            'bi bi-eye-slash';

    } else {

        input.type = 'password';

        icon.className =
            'bi bi-eye';

    }
}

</script>


<?php

$content = ob_get_clean();

require ROOT_PATH . '/app/Views/layouts/admin_layout.php';

?>