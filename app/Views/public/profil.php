<?php

$pageTitle = 'Profil Organisasi';

$activeMenu = 'profil';

ob_start();

$namaOrganisasi = $profil['nama_organisasi']
    ?? 'SISPALA MAHARDIKA';

$deskripsi = $profil['deskripsi']
    ?? 'Siswa Pecinta Alam Mahardika';

$sejarah = $profil['sejarah']
    ?? '';

$visi = $profil['visi']
    ?? '';

$misi = $profil['misi']
    ?? '';

?>

<style>
    .public-section {
        padding: 80px 0;
    }

    .profile-card {
        border: 0;
        border-radius: 20px;
        box-shadow: 0 10px 35px rgba(0,0,0,.07);
        overflow: hidden;
    }

    .profile-title {
        color: #0B1F3A;
        font-weight: 800;
    }

    .profile-accent {
        width: 55px;
        height: 4px;
        border-radius: 10px;
        background: #F28C28;
        margin-bottom: 25px;
    }

    .vision-card {
        height: 100%;
        padding: 30px;
        border-radius: 18px;
        background: #0B1F3A;
        color: white;
    }

    .mission-card {
        height: 100%;
        padding: 30px;
        border-radius: 18px;
        background: #fff;
        border: 1px solid #edf0f4;
        box-shadow: 0 8px 25px rgba(0,0,0,.05);
    }

    .section-icon {
        width: 48px;
        height: 48px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(242,140,40,.12);
        color: #F28C28;
        font-size: 21px;
        margin-bottom: 18px;
    }

    .mission-list {
        padding-left: 20px;
    }

    .mission-list li {
        margin-bottom: 10px;
    }
</style>


<div class="public-section">

    <div class="container">

        <!-- HEADER -->

        <div class="text-center mb-5">

            <span
                class="badge rounded-pill px-3 py-2 mb-3"
                style="background:#FFF0E6;color:#F28C28;"
            >
                Tentang Kami
            </span>

            <h1 class="profile-title mb-3">
                <?= htmlspecialchars($namaOrganisasi) ?>
            </h1>

            <p class="text-muted mx-auto" style="max-width:700px;">
                <?= htmlspecialchars($deskripsi) ?>
            </p>

        </div>


        <!-- SEJARAH -->

        <div class="card profile-card mb-5">

            <div class="card-body p-4 p-lg-5">

                <div class="section-icon">
                    <i class="bi bi-book"></i>
                </div>

                <h3 class="profile-title mb-2">
                    Sejarah Organisasi
                </h3>

                <div class="profile-accent"></div>

                <?php if ($sejarah): ?>

                    <div class="text-muted lh-lg">
                        <?= nl2br(htmlspecialchars($sejarah)) ?>
                    </div>

                <?php else: ?>

                    <p class="text-muted">
                        Informasi sejarah organisasi belum tersedia.
                    </p>

                <?php endif; ?>

            </div>

        </div>


        <!-- VISI MISI -->

        <div class="row g-4">

            <!-- VISI -->

            <div class="col-lg-6">

                <div class="vision-card">

                    <div class="section-icon">
                        <i class="bi bi-eye"></i>
                    </div>

                    <h3 class="fw-bold mb-3">
                        Visi
                    </h3>

                    <?php if ($visi): ?>

                        <p class="mb-0 lh-lg">
                            <?= nl2br(htmlspecialchars($visi)) ?>
                        </p>

                    <?php else: ?>

                        <p class="mb-0 opacity-75">
                            Visi organisasi belum tersedia.
                        </p>

                    <?php endif; ?>

                </div>

            </div>


            <!-- MISI -->

            <div class="col-lg-6">

                <div class="mission-card">

                    <div class="section-icon">
                        <i class="bi bi-bullseye"></i>
                    </div>

                    <h3
                        class="profile-title mb-3"
                    >
                        Misi
                    </h3>

                    <?php if ($misi): ?>

                        <div class="text-muted lh-lg">
                            <?= nl2br(htmlspecialchars($misi)) ?>
                        </div>

                    <?php else: ?>

                        <p class="text-muted mb-0">
                            Misi organisasi belum tersedia.
                        </p>

                    <?php endif; ?>

                </div>

            </div>

        </div>

    </div>

</div>


<?php

$content = ob_get_clean();

require ROOT_PATH . '/app/Views/layouts/public_layout.php';