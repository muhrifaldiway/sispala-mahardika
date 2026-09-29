<?php

if (!isset($pageTitle)) {
    $pageTitle = 'Admin';
}

if (!isset($activeMenu)) {
    $activeMenu = '';
}

?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>
        <?= htmlspecialchars($pageTitle); ?>
        | SISPALA Mahardika
    </title>


    <!-- Bootstrap 5 -->

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">


    <!-- Bootstrap Icons -->

    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">


    <!-- CSS -->

    <link
        rel="stylesheet"
        href="<?= BASE_URL ?>/assets/css/style.css">

    <link
        rel="stylesheet"
        href="<?= BASE_URL ?>/assets/css/admin-atlas.css">

</head>


<body>


    <!-- SIDEBAR -->

    <?php require ROOT_PATH . '/app/Views/layouts/admin_sidebar.php'; ?>


    <!-- MOBILE OVERLAY -->

    <div
        class="sidebar-overlay"
        id="sidebarOverlay">
    </div>


    <!-- MAIN CONTENT -->

    <main class="admin-main">


        <!-- NAVBAR -->

        <?php require ROOT_PATH . '/app/Views/layouts/admin_navbar.php'; ?>


        <!-- PAGE CONTENT -->

        <div class="admin-content">

            <?= $content ?? ''; ?>

        </div>


    </main>

    

    <!-- Bootstrap -->

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
    </script>


    <!-- Main JS -->

    <script
        src="<?= BASE_URL ?>/assets/js/main.js">
    </script>

</body>

</html>