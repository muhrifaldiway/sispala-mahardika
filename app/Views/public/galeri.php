<?php
$pageTitle = 'Galeri Kegiatan';
$activeMenu = 'galeri';
ob_start();
?>
<section class="page-banner"><div class="container"><span class="section-kicker">Dokumentasi lapangan</span><h1>Jejak yang kami bawa pulang.</h1><p>Potongan aktivitas, pembelajaran, dan kebersamaan dalam perjalanan SISPALA Mahardika.</p></div></section>
<section class="atlas-section"><div class="container">
    <form class="gallery-filter" method="GET" action="<?= BASE_URL ?>/galeri"><div class="filter-search"><i class="bi bi-search"></i><input type="search" name="q" value="<?= htmlspecialchars($keyword) ?>" placeholder="Cari dokumentasi"></div><select name="kategori"><option value="">Semua kategori</option><?php foreach ($categories as $category): $name = is_array($category) ? ($category['kategori'] ?? '') : $category; ?><option value="<?= htmlspecialchars($name) ?>" <?= $kategori === $name ? 'selected' : '' ?>><?= htmlspecialchars($name) ?></option><?php endforeach; ?></select><button type="submit">Terapkan <i class="bi bi-arrow-right"></i></button></form>
    <?php if (!empty($galeri)): ?><div class="gallery-grid-full"><?php foreach ($galeri as $index => $item): $foto = $item['foto'] ?? ''; ?><article class="gallery-card"><div class="gallery-image"><?php if ($foto): ?><img src="<?= BASE_URL ?>/uploads/gallery/<?= htmlspecialchars($foto) ?>" alt="<?= htmlspecialchars($item['judul'] ?? 'Dokumentasi kegiatan') ?>" loading="lazy"><?php else: ?><span class="photo-placeholder"><i class="bi bi-image"></i></span><?php endif; ?></div><div class="gallery-card-body"><span><?= htmlspecialchars($item['kategori'] ?? 'Kegiatan') ?></span><h2><?= htmlspecialchars($item['judul'] ?? 'Dokumentasi kegiatan') ?></h2><?php if (!empty($item['deskripsi'])): ?><p><?= htmlspecialchars($item['deskripsi']) ?></p><?php endif; ?></div></article><?php endforeach; ?></div><?php else: ?><div class="empty-route"><i class="bi bi-images"></i><h2>Belum ada dokumentasi</h2><p>Coba gunakan kata kunci atau kategori lain.</p></div><?php endif; ?>
</div></section>
<?php
$content = ob_get_clean();
require ROOT_PATH . '/app/Views/layouts/public_layout.php';
