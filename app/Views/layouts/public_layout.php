<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?= htmlspecialchars($metaDescription ?? 'SISPALA Mahardika — organisasi siswa pecinta alam.') ?>">
    <title><?= htmlspecialchars($pageTitle ?? 'SISPALA Mahardika') ?> · SISPALA Mahardika</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&family=Oswald:wght@500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="<?= BASE_URL ?>/assets/css/public.css" rel="stylesheet">
</head>
<body>
<!-- THESIS: A digital expedition atlas guides prospective members from discovery to registration, avoiding generic school-site chrome. OWN-WORLD: deep pine, terrain paper, route-line orange, and map-grid details. STORY: Visitors see what SISPALA does, verify its activity, and choose to join. FIRST VIEWPORT: a high-contrast field map holds the offer and action on the left, route checkpoints on the right. FORM: Atlas ekspedisi, seed 4514c031. FINISH: unreviewed and undocumented is unfinished; this build ends with the finish review, the verdict, DESIGN.md, and every shipping raster carrying its provenance. -->
<header class="site-header">
    <div class="site-utility d-none d-lg-block">
        <div class="container d-flex justify-content-between align-items-center">
            <span><i class="bi bi-compass me-2"></i>Organisasi Siswa Pecinta Alam</span>
            <span>Siap belajar, bergerak, dan menjaga alam.</span>
        </div>
    </div>
    <nav class="navbar navbar-expand-lg site-nav">
        <div class="container">
            <a class="site-brand" href="<?= BASE_URL ?>/" aria-label="Beranda SISPALA Mahardika">
                <span class="brand-symbol"><i class="bi bi-signpost-split-fill"></i></span>
                <span><strong>SISPALA</strong><small>MAHARDIKA</small></span>
            </a>
            <button class="navbar-toggler site-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#publicNavbar" aria-controls="publicNavbar" aria-expanded="false" aria-label="Buka navigasi">
                <i class="bi bi-list"></i>
            </button>
            <div class="collapse navbar-collapse" id="publicNavbar">
                <ul class="navbar-nav ms-auto align-items-lg-center">
                    <li class="nav-item"><a class="nav-link <?= ($activeMenu ?? '') === 'home' ? 'active' : '' ?>" href="<?= BASE_URL ?>/">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link <?= ($activeMenu ?? '') === 'profil' ? 'active' : '' ?>" href="<?= BASE_URL ?>/profil">Profil</a></li>
                    <li class="nav-item"><a class="nav-link <?= ($activeMenu ?? '') === 'galeri' ? 'active' : '' ?>" href="<?= BASE_URL ?>/galeri">Galeri</a></li>
                    <li class="nav-item"><a class="nav-link <?= ($activeMenu ?? '') === 'berita' ? 'active' : '' ?>" href="<?= BASE_URL ?>/berita">Berita</a></li>
                    <li class="nav-item ms-lg-3"><a class="route-cta" href="<?= BASE_URL ?>/pendaftaran">Daftar Anggota <i class="bi bi-arrow-up-right"></i></a></li>
                </ul>
            </div>
        </div>
    </nav>
</header>
<main><?= $content ?? '' ?></main>
<footer class="site-footer">
    <div class="container">
        <div class="footer-grid">
            <div>
                <a class="site-brand footer-brand" href="<?= BASE_URL ?>/">
                    <span class="brand-symbol"><i class="bi bi-signpost-split-fill"></i></span>
                    <span><strong>SISPALA</strong><small>MAHARDIKA</small></span>
                </a>
                <p>Ruang tumbuh bagi siswa untuk belajar memimpin, menjelajah dengan bertanggung jawab, dan menjaga alam bersama-sama.</p>
            </div>
            <div>
                <span class="footer-label">Jelajahi</span>
                <a href="<?= BASE_URL ?>/profil">Profil Organisasi</a>
                <a href="<?= BASE_URL ?>/galeri">Dokumentasi Kegiatan</a>
                <a href="<?= BASE_URL ?>/berita">Berita Terbaru</a>
            </div>
            <div>
                <span class="footer-label">Bergabung</span>
                <p>Mulai perjalanan Anda bersama SISPALA Mahardika.</p>
                <a class="footer-action" href="<?= BASE_URL ?>/pendaftaran">Formulir Pendaftaran <i class="bi bi-arrow-right"></i></a>
            </div>
        </div>
        <div class="footer-bottom"><span>© <?= date('Y') ?> SISPALA Mahardika</span><span>Belajar · Bergerak · Menjaga</span></div>
    </div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
