<?php

$pageTitle =
    $berita['judul']
    ?? 'Detail Berita';

$activeMenu = 'berita';

ob_start();

$foto =
    $berita['foto']
    ?? $berita['gambar']
    ?? '';

?>

<style>
    .article-wrapper {
        max-width: 900px;
        margin: auto;
    }

    .article-image {
        width: 100%;
        max-height: 520px;
        object-fit: cover;
        border-radius: 20px;
    }

    .article-title {
        color: #0B1F3A;
        font-weight: 800;
        line-height: 1.25;
    }

    .article-content {
        color: #475569;
        font-size: 16px;
        line-height: 1.9;
    }

    .article-content img {
        max-width: 100%;
        height: auto;
        border-radius: 12px;
    }

    .latest-card {
        border: 0;
        border-radius: 15px;
        box-shadow: 0 5px 20px rgba(0,0,0,.06);
    }
</style>


<div class="py-5">

    <div class="container">

        <div class="article-wrapper">

            <!-- BACK -->

            <a
                href="<?= BASE_URL ?>/berita"
                class="text-decoration-none"
                style="color:#F28C28;"
            >

                <i class="bi bi-arrow-left me-1"></i>

                Kembali ke Berita

            </a>


            <!-- TITLE -->

            <div class="mt-4 mb-4">

                <?php if (!empty($berita['kategori'])): ?>

                    <span
                        class="badge mb-3"
                        style="background:#FFF0E6;color:#F28C28;"
                    >
                        <?= htmlspecialchars(
                            $berita['kategori']
                        ) ?>
                    </span>

                <?php endif; ?>


                <h1 class="article-title">

                    <?= htmlspecialchars(
                        $berita['judul']
                    ) ?>

                </h1>


                <div class="text-muted small mt-3">

                    <i class="bi bi-calendar3 me-1"></i>

                    <?= htmlspecialchars(
                        $berita['tanggal']
                        ?? $berita['created_at']
                        ?? ''
                    ) ?>

                </div>

            </div>


            <!-- IMAGE -->

            <?php if ($foto): ?>

                <img
                    src="<?= BASE_URL ?>/uploads/berita/<?= htmlspecialchars($foto) ?>"
                    alt="<?= htmlspecialchars($berita['judul']) ?>"
                    class="article-image mb-5"
                >

            <?php endif; ?>


            <!-- CONTENT -->

            <div class="article-content">

                <?php

                /*
                 * Isi berita biasanya berasal dari editor HTML.
                 * Karena itu tidak menggunakan htmlspecialchars()
                 * agar formatting HTML tetap tampil.
                 */

                echo $berita['isi']
                    ?? '<p>Isi berita belum tersedia.</p>';

                ?>

            </div>


            <!-- LATEST -->

            <?php if (!empty($latest)): ?>

                <hr class="my-5">

                <h4
                    class="fw-bold mb-4"
                    style="color:#0B1F3A;"
                >
                    Berita Terbaru
                </h4>


                <div class="row g-3">

                    <?php foreach ($latest as $item): ?>

                        <?php

                        $latestSlug =
                            $item['slug']
                            ?? $item['id'];

                        ?>

                        <div class="col-md-4">

                            <div class="card latest-card h-100">

                                <div class="card-body">

                                    <h6 class="fw-bold">

                                        <?= htmlspecialchars(
                                            $item['judul']
                                        ) ?>

                                    </h6>


                                    <a
                                        href="<?= BASE_URL ?>/berita/<?= urlencode($latestSlug) ?>"
                                        class="small text-decoration-none"
                                        style="color:#F28C28;"
                                    >

                                        Baca berita

                                        <i class="bi bi-arrow-right"></i>

                                    </a>

                                </div>

                            </div>

                        </div>

                    <?php endforeach; ?>

                </div>

            <?php endif; ?>

        </div>

    </div>

</div>


<?php

$content = ob_get_clean();

require ROOT_PATH . '/app/Views/layouts/public_layout.php';