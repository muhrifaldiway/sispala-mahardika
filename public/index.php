<?php

session_start();

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/database.php';


// ==========================================
// CORE
// ==========================================

require_once ROOT_PATH . '/app/Core/Router.php';
require_once ROOT_PATH . '/app/Core/Controller.php';
require_once ROOT_PATH . '/app/Core/Model.php';
require_once ROOT_PATH . '/app/Core/Database.php';


// ==========================================
// MODELS
// ==========================================

require_once ROOT_PATH . '/app/Models/User.php';
require_once ROOT_PATH . '/app/Models/Anggota.php';
require_once ROOT_PATH . '/app/Models/Gallery.php';
require_once ROOT_PATH . '/app/Models/Berita.php';
require_once ROOT_PATH . '/app/Models/Pendaftaran.php';
require_once ROOT_PATH . '/app/Models/Profil.php';
require_once ROOT_PATH . '/app/Models/Pengaturan.php';
require_once ROOT_PATH . '/app/Models/ProfilOrganisasi.php';


// ==========================================
// CONTROLLERS
// ==========================================

require_once ROOT_PATH . '/app/Controllers/Admin/AuthController.php';
require_once ROOT_PATH . '/app/Controllers/Admin/DashboardController.php';
require_once ROOT_PATH . '/app/Controllers/Admin/AnggotaAdminController.php';
require_once ROOT_PATH . '/app/Controllers/Admin/GalleryAdminController.php';
require_once ROOT_PATH . '/app/Controllers/Admin/BeritaAdminController.php';
require_once ROOT_PATH . '/app/Controllers/Admin/PendaftaranAdminController.php';
require_once ROOT_PATH . '/app/Controllers/Admin/ProfilController.php';
require_once ROOT_PATH . '/app/Controllers/Admin/UserAdminController.php';
require_once ROOT_PATH . '/app/Controllers/Admin/PengaturanAdminController.php';
require_once ROOT_PATH . '/app/Controllers/Public/ProfilController.php';
require_once ROOT_PATH . '/app/Controllers/Public/GaleriController.php';
require_once ROOT_PATH . '/app/Controllers/Public/BeritaController.php';
require_once ROOT_PATH . '/app/Controllers/Public/PendaftaranController.php';
require_once ROOT_PATH . '/app/Controllers/Public/PublicController.php'; 


// ==========================================
// ROUTER
// ==========================================

$router = new Router();


// ==========================================
// AUTH
// ==========================================

$router->get(
    '/admin/login',
    [AuthController::class, 'login']
);

$router->post(
    '/admin/login',
    [AuthController::class, 'authenticate']
);


// ==========================================
// DASHBOARD
// ==========================================

$router->get(
    '/admin/dashboard',
    [DashboardController::class, 'index']
);


// ==========================================
// ANGGOTA
// ==========================================

// INDEX
$router->get(
    '/admin/anggota',
    [AnggotaAdminController::class, 'index']
);


// CREATE
$router->get(
    '/admin/anggota/create',
    [AnggotaAdminController::class, 'create']
);


// STORE
$router->post(
    '/admin/anggota/store',
    [AnggotaAdminController::class, 'store']
);


// EDIT
$router->get(
    '/admin/anggota/edit/{id}',
    [AnggotaAdminController::class, 'edit']
);


// UPDATE
$router->post(
    '/admin/anggota/update/{id}',
    [AnggotaAdminController::class, 'update']
);


// DELETE
$router->post(
    '/admin/anggota/delete/{id}',
    [AnggotaAdminController::class, 'delete']
);


// ==========================================
// GALLERY
// ==========================================

// ==========================================
// GALLERY
// ==========================================

$router->get(
    '/admin/gallery',
    [GalleryAdminController::class, 'index']
);

$router->get(
    '/admin/gallery/create',
    [GalleryAdminController::class, 'create']
);

$router->post(
    '/admin/gallery/store',
    [GalleryAdminController::class, 'store']
);

$router->get(
    '/admin/gallery/edit/{id}',
    [GalleryAdminController::class, 'edit']
);

$router->post(
    '/admin/gallery/update/{id}',
    [GalleryAdminController::class, 'update']
);

$router->get(
    '/admin/gallery/delete/{id}',
    [GalleryAdminController::class, 'delete']
);

// ==========================================
// BERITA
// ==========================================

$router->get(
    '/admin/berita',
    [BeritaAdminController::class, 'index']
);

$router->get(
    '/admin/berita/create',
    [BeritaAdminController::class, 'create']
);

$router->post(
    '/admin/berita/store',
    [BeritaAdminController::class, 'store']
);

$router->get(
    '/admin/berita/edit/{id}',
    [BeritaAdminController::class, 'edit']
);

$router->post(
    '/admin/berita/update/{id}',
    [BeritaAdminController::class, 'update']
);

$router->get(
    '/admin/berita/delete/{id}',
    [BeritaAdminController::class, 'delete']
);

// ==========================================
// PENDAFTARAN
// ==========================================

$router->get(
    '/admin/pendaftaran',
    [PendaftaranAdminController::class, 'index']
);

$router->get(
    '/admin/pendaftaran/create',
    [PendaftaranAdminController::class, 'create']
);

$router->post(
    '/admin/pendaftaran/store',
    [PendaftaranAdminController::class, 'store']
);

$router->get(
    '/admin/pendaftaran/edit/{id}',
    [PendaftaranAdminController::class, 'edit']
);

$router->post(
    '/admin/pendaftaran/update/{id}',
    [PendaftaranAdminController::class, 'update']
);

$router->get(
    '/admin/pendaftaran/delete/{id}',
    [PendaftaranAdminController::class, 'delete']
);

$router->get(
    '/admin/pendaftaran/show/{id}',
    [PendaftaranAdminController::class, 'show']
);

// ==========================================
// PROFIL
// ==========================================
$router->get(
    '/admin/profil',
    [ProfilController::class, 'index']
);

$router->post(
    '/admin/profil/update',
    [ProfilController::class, 'update']
);

$router->post(
    '/admin/logout',
    [AuthController::class, 'logout']
);

// ==========================================
// USERS ADMIN
// ==========================================

$router->get(
    '/admin/users',
    [UsersAdminController::class, 'index']
);

$router->get(
    '/admin/users/create',
    [UsersAdminController::class, 'create']
);

$router->post(
    '/admin/users/store',
    [UsersAdminController::class, 'store']
);

$router->get(
    '/admin/users/edit/{id}',
    [UsersAdminController::class, 'edit']
);

$router->post(
    '/admin/users/update/{id}',
    [UsersAdminController::class, 'update']
);

$router->get(
    '/admin/users/delete/{id}',
    [UsersAdminController::class, 'delete']
);

// ==========================================
// PENGATURAN WEBSITE
// ==========================================

$router->get(
    '/admin/pengaturan',
    [PengaturanAdminController::class, 'index']
);

$router->post(
    '/admin/pengaturan/update',
    [PengaturanAdminController::class, 'update']
);


// ==========================================
// PUBLIC WEBSITE
// ==========================================

// BERANDA

$router->get(
    '/',
    [PublicController::class, 'index']
);


// PROFIL

$router->get(
    '/profil',
    [PublicProfilController::class, 'index']
);


// GALERI

$router->get(
    '/galeri',
    [PublicGaleriController::class, 'index']
);


// BERITA

$router->get(
    '/berita',
    [PublicBeritaController::class, 'index']
);


// DETAIL BERITA

$router->get(
    '/berita/{slug}',
    [PublicBeritaController::class, 'detail']
);


// PENDAFTARAN

$router->get(
    '/pendaftaran',
    [PublicPendaftaranController::class, 'index']
);

$router->post(
    '/pendaftaran',
    [PublicPendaftaranController::class, 'store']
);


// ==========================================
// DISPATCH
// ==========================================

$router->dispatch(
    $_SERVER['REQUEST_URI'],
    $_SERVER['REQUEST_METHOD']
);