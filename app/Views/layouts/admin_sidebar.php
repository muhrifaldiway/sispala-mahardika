<aside
    class="admin-sidebar"
    id="adminSidebar">


    <!-- HEADER -->

    <div class="sidebar-header">


    <img
        src="../../../../../public/uploads/logo/logo_1787900640_6a9132e0c4240.png"
        alt="Logo SISPALA MAHARDIKA"
        class="sidebar-logo-img"
    >

        


        <div class="sidebar-brand">

            <strong>SISPALA</strong>

            <small>MAHARDIKA</small>

        </div>

    </div>


    <!-- MENU -->

    <nav class="sidebar-menu">


        <div class="sidebar-label">
            MENU UTAMA
        </div>


        <a
            href="<?= BASE_URL ?>/"
            class="sidebar-link"
        >

            <i class="bi bi-box-arrow-up-right"></i>

            <span>
                Lihat Website
            </span>

        </a>


        <a
            href="<?= BASE_URL ?>/admin/dashboard"
            class="sidebar-link <?= $activeMenu === 'dashboard' ? 'active' : ''; ?>">

            <i class="bi bi-grid-1x2-fill"></i>

            <span>
                Dashboard
            </span>

        </a>


        <div class="sidebar-label">
            MANAJEMEN
        </div>


        <a
            href="<?= BASE_URL ?>/admin/berita"
            class="sidebar-link <?= $activeMenu === 'berita' ? 'active' : ''; ?>">

            <i class="bi bi-newspaper"></i>

            <span>
                Berita
            </span>

        </a>


        <a
            href="<?= BASE_URL ?>/admin/gallery"
            class="sidebar-link <?= $activeMenu === 'gallery' ? 'active' : ''; ?>">

            <i class="bi bi-images"></i>

            <span>
                Galeri
            </span>

        </a>


        <a
            href="<?= BASE_URL ?>/admin/anggota"
            class="sidebar-link <?= $activeMenu === 'anggota' ? 'active' : ''; ?>">

            <i class="bi bi-people-fill"></i>

            <span>
                Anggota
            </span>

        </a>


        <a
            href="<?= BASE_URL ?>/admin/pendaftaran"
            class="sidebar-link <?= $activeMenu === 'pendaftaran' ? 'active' : ''; ?>">

            <i class="bi bi-person-plus-fill"></i>

            <span>
                Pendaftaran
            </span>

        </a>
        
        <a
            href="<?= BASE_URL ?>/admin/profil"
            class="sidebar-link <?= $activeMenu === 'profil' ? 'active' : ''; ?>">

            <i class="bi bi-building"></i>

            <span>
                Profil Organisasi
            </span>

        </a>

        <a
            href="<?= BASE_URL ?>/admin/users"
            class="sidebar-link <?= $activeMenu === 'users' ? 'active' : ''; ?>"
        >

            <i class="bi bi-people"></i>

            <span>
                Users Admin
            </span>

        </a>
        
   
            <a
                href="<?= BASE_URL ?>/admin/pengaturan"
                class="sidebar-link <?= ($activeMenu ?? '') === 'pengaturan' ? 'active' : ''; ?>"
            >

                <i class="bi bi-gear"></i>

                <span>
                    Pengaturan Website
                </span>

            </a>

        
        
        <form
        action="<?= BASE_URL ?>/admin/logout"
        method="POST"
        onsubmit="return confirm('Apakah Anda yakin ingin logout?');"
    >

        <button
            type="submit"
            class="btn w-100 d-flex align-items-center"
            style="
                background:rgba(220,53,69,.08);
                color:#dc3545;
                border:0;
                border-radius:10px;
                padding:11px 15px;
                font-weight:600;
            "
        >

            <i class="bi bi-box-arrow-right fs-5 me-2"></i>

            Logout

        </button>

    </form>
    

</div><br>

    </nav>

    <div class="mt-auto p-12">

        <div class="sidebar-label">
            Versi Aplikasi
        </div>

        <div class="sidebar-label">
            v1.0.0
        </div>

   
    <!-- FOOTER -->

    <!-- <div class="sidebar-footer mt-auto p-12">

        <div class="sidebar-user">

            <div class="sidebar-user-avatar">

                <i class="bi bi-person-fill"></i>

            </div>


            <div class="sidebar-user-info">
        
                <strong>
                    Administrator
                </strong>

                <small>
                    Admin SISPALA
                </small>

            </div>

        </div>

    </div> -->

</aside>