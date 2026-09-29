<?php

$pageTitle = 'Berita';

$activeMenu = 'berita';

ob_start();

?>

<style>
    .news-card {
        border: 0;
        border-radius: 18px;
        overflow: hidden;
        height: 100%;
        box-shadow: 0 8px 30px rgba(0,0,0,.07);
        transition: .25s ease;
        background: #fff;
    }

    .news-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(0,0,0,.11);
    }

    .news-image {
        width: 100%;
        height: 220px;
        object-fit: cover;
    }

    .news-placeholder {
        height: 220px;
        background: #f3f5f8;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #94a3b8;
        font-size: 40px;
    }

    .news-title {
        color: #0B1F3A;
        font-weight: 700;
    }

    .pagination .page-link {
        color: #0B1F3A;
        border-radius: 8px;
        margin: 0 3px;
    }

    .pagination .active .page-link {
        background: #F28C28;
        border-color: #F28C28;
        color: white;
    }
</style>


<div class="py-5">

    <div class="container">

        <div class="text-center mb-5">

            <span
                class="badge rounded-pill px-3 py-2 mb-3"
                style="background:#FFF0E6;color:#F28C28;"
            >
                Informasi
            </span>

            <h1 class="fw-bold" style="color:#0B1F3A;">
                Berita & Kegiatan
            </h1>

            <p class="text-muted">
                Informasi terbaru seputar SISPALA Mahardika.
            </p>

        </div>


        <!-- SEARCH -->

        <form
            method="GET"
            action="<?= BASE_URL ?>/berita"
            class="mb-5"
        >

            <div class="row justify-content-center g-2">

                <div class="col-md-7">

                    <input
                        type="search"
                        name="q"
                        value="<?= htmlspecialchars($keyword) ?>"
                        class="form-control form-control-lg rounded-pill"
                        placeholder="Cari berita..."
                    >

                </div>

                <div class="col-auto">

                    <button
                        class="btn btn-lg rounded-pill px-4"
                        style="background:#F28C28;color:white;"
                    >

                        <i class="bi bi-search me-1"></i>

                        Cari

                    </button>

                </div>

            </div>

        </form>


        <?php if (!empty($berita)): ?>

            <div class="row g-4">

                <?php foreach ($berita as $item): ?>

                    <?php

                    $slug =
                        $item['slug']
                        ?? $item['id'];

                    $foto =
                        $item['foto']
                        ?? $item['gambar']
                        ?? '';

                    ?>

                    <div class="col-12 col-md-6 col-lg-4">

                        <article class="news-card">

                            <?php if ($foto): ?>

                                <img
                                    src="<?= BASE_URL ?>/uploads/berita/<?= htmlspecialchars($foto) ?>"
                                    alt="<?= htmlspecialchars($item['judul']) ?>"
                                    class="news-image"
                                    loading="lazy"
                                >

                            <?php else: ?>

                                <div class="news-placeholder">

                                    <i class="bi bi-newspaper"></i>

                                </div>

                            <?php endif; ?>


                            <div class="p-4">

                                <div class="small text-muted mb-2">

                                    <i class="bi bi-calendar3 me-1"></i>

                                    <?= htmlspecialchars(
                                        $item['tanggal']
                                        ?? $item['created_at']
                                        ?? ''
                                    ) ?>

                                </div>


                                <?php if (!empty($item['kategori'])): ?>

                                    <span
                                        class="badge mb-2"
                                        style="background:#FFF0E6;color:#F28C28;"
                                    >
                                        <?= htmlspecialchars(
                                            $item['kategori']
                                        ) ?>
                                    </span>

                                <?php endif; ?>


                                <h5 class="news-title mb-3">

                                    <?= htmlspecialchars(
                                        $item['judul']
                                    ) ?>

                                </h5>


                                <?php if (!empty($item['ringkasan'])): ?>

                                    <p class="text-muted small">

                                        <?= htmlspecialchars(
                                            mb_strimwidth(
                                                $item['ringkasan'],
                                                0,
                                                120,
                                                '...'
                                            )
                                        ) ?>

                                    </p>

                                <?php elseif (!empty($item['isi'])): ?>

                                    <p class="text-muted small">

                                        <?= htmlspecialchars(
                                            mb_strimwidth(
                                                strip_tags(
                                                    $item['isi']
                                                ),
                                                0,
                                                120,
                                                '...'
                                            )
                                        ) ?>

                                    </p>

                                <?php endif; ?>


                                <a
                                    href="<?= BASE_URL ?>/berita/<?= urlencode($slug) ?>"
                                    class="text-decoration-none fw-semibold"
                                    style="color:#F28C28;"
                                >

                                    Baca Selengkapnya

                                    <i class="bi bi-arrow-right ms-1"></i>

                                </a>

                            </div>

                        </article>

                    </div>

                <?php endforeach; ?>

            </div>


            <!-- PAGINATION -->

            <?php if ($totalPages > 1): ?>

                <nav class="mt-5">

                    <ul class="pagination justify-content-center">

                        <?php for ($i = 1; $i <= $totalPages; $i++): ?>

                            <li
                                class="page-item <?= $i === $page ? 'active' : '' ?>"
                            >

                                <a
                                    class="page-link"
                                    href="<?= BASE_URL ?>/berita?page=<?= $i ?>&q=<?= urlencode($keyword) ?>"
                                >
                                    <?= $i ?>
                                </a>

                            </li>

                        <?php endfor; ?>

                    </ul>

                </nav>

            <?php endif; ?>

        <?php else: ?>

            <div class="text-center py-5">

                <i
                    class="bi bi-newspaper"
                    style="font-size:50px;color:#cbd5e1;"
                ></i>

                <h5 class="fw-bold mt-3">
                    Berita belum tersedia
                </h5>

                <p class="text-muted">
                    Belum ada berita yang dapat ditampilkan.
                </p>

            </div>

        <?php endif; ?>

    </div>

</div>


<?php

$content = ob_get_clean();

require ROOT_PATH . '/app/Views/layouts/public_layout.php';