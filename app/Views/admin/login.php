<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin | SISPALA Mahardika</title>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&family=Oswald:wght@500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root{--pine:#0a2f27;--pine-deep:#06241e;--route:#ef6c31;--sand:#f5f0e7;--muted:#60716c}
        *{box-sizing:border-box}
        body{margin:0;min-height:100vh;font-family:Manrope,sans-serif;color:#132521;background:var(--pine-deep);overflow-x:hidden}
        .login-shell{min-height:100vh;display:grid;grid-template-columns:1.05fr 1fr}
        .login-scene{position:relative;background:var(--pine);color:#fff;padding:4rem;display:flex;flex-direction:column;justify-content:space-between;overflow:hidden}
        .login-scene::after{content:"";position:absolute;inset:0;opacity:.22;background-image:radial-gradient(ellipse at 30% 70%,transparent 0 11%,#c7d9cb 11.3% 11.8%,transparent 12.2% 19%,#c7d9cb 19.3% 19.8%,transparent 20.2% 28%,#c7d9cb 28.3% 28.8%,transparent 29.2%)}
        .scene-brand{position:relative;z-index:1;display:flex;align-items:center;gap:.8rem}
        .scene-brand .mark{width:2.9rem;height:2.9rem;display:grid;place-items:center;background:var(--route);border-radius:50%;font-size:1.25rem}
        .scene-brand strong,.scene-brand small{display:block;font-family:Oswald,sans-serif}
        .scene-brand strong{font-size:1.3rem;letter-spacing:.05em}
        .scene-brand small{font-size:.7rem;letter-spacing:.22em;color:#a9c6bb;margin-top:.25rem}
        .scene-copy{position:relative;z-index:1;max-width:420px}
        .scene-copy span{font-size:.72rem;font-weight:800;letter-spacing:.16em;text-transform:uppercase;color:#ffad75}
        .scene-copy h1{font-family:Oswald,sans-serif;font-size:2.5rem;line-height:1.1;margin:1rem 0;font-weight:600}
        .scene-copy p{color:#c9d8d1;font-size:.95rem}
        .login-pane{display:flex;align-items:center;justify-content:center;background:var(--sand);padding:2.5rem}
        .login-card{width:100%;max-width:380px}
        .login-card h2{font-family:Oswald,sans-serif;font-size:1.7rem;margin:0 0 .3rem;color:var(--pine)}
        .login-card .sub{color:var(--muted);font-size:.87rem;margin-bottom:2rem}
        .form-label{font-size:.76rem;font-weight:800;letter-spacing:.06em;text-transform:uppercase;color:var(--pine);margin-bottom:.5rem}
        .input-wrap{position:relative}
        .input-wrap i{position:absolute;left:1rem;top:50%;transform:translateY(-50%);color:var(--muted)}
        .form-control{height:3.1rem;border-radius:0;border:1px solid #d9d1c4;background:#fff;padding-left:2.9rem;font-size:.9rem}
        .form-control:focus{border-color:var(--route);box-shadow:0 0 0 .18rem rgba(239,108,49,.14)}
        .password-toggle{position:absolute;right:.9rem;top:50%;transform:translateY(-50%);border:0;background:none;color:var(--muted);cursor:pointer}
        .btn-login{width:100%;height:3.2rem;border:0;background:var(--route);color:#fff;font-weight:800;letter-spacing:.04em;text-transform:uppercase;font-size:.82rem;margin-top:.6rem}
        .btn-login:hover{background:#cf5524}
        .alert{border:0;border-radius:0;font-size:.83rem;border-left:3px solid #b02a37}
        .login-foot{margin-top:2rem;font-size:.72rem;color:var(--muted);text-align:center;letter-spacing:.04em}
        @media(max-width:900px){.login-shell{grid-template-columns:1fr}.login-scene{display:none}}
    </style>
</head>
<body>
<div class="login-shell">
    <section class="login-scene">
        <div class="scene-brand"><span class="mark"><i class="bi bi-signpost-split-fill"></i></span><span><strong>SISPALA</strong><small>MAHARDIKA</small></span></div>
        <div class="scene-copy">
            <span>Panel Administrator</span>
            <h1>Kelola perjalanan organisasi dari satu ruang kendali.</h1>
            <p>Kelola anggota, berita, galeri, dan pendaftaran calon anggota SISPALA Mahardika dengan mudah.</p>
        </div>
        <div></div>
    </section>
    <section class="login-pane">
        <div class="login-card">
            <h2>Masuk ke akun Anda</h2>
            <p class="sub">Silakan masuk untuk mengakses panel administrator.</p>
            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-danger d-flex align-items-center mb-4" role="alert">
                    <i class="bi bi-exclamation-circle-fill me-2"></i>
                    <div><?= htmlspecialchars($_SESSION['error']); ?></div>
                </div>
                <?php unset($_SESSION['error']); ?>
            <?php endif; ?>
            <form method="POST" action="<?= BASE_URL ?>/admin/login">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <div class="input-wrap">
                        <i class="bi bi-person"></i>
                        <input type="text" id="username" name="username" class="form-control" placeholder="Masukkan username" autocomplete="username" required>
                    </div>
                </div>
                <div class="mb-2">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-wrap">
                        <i class="bi bi-lock"></i>
                        <input type="password" id="password" name="password" class="form-control" placeholder="Masukkan password" autocomplete="current-password" required>
                        <button type="button" class="password-toggle" id="togglePassword" aria-label="Tampilkan password"><i class="bi bi-eye"></i></button>
                    </div>
                </div>
                <button type="submit" class="btn btn-login"><i class="bi bi-box-arrow-in-right me-2"></i>Masuk ke Dashboard</button>
            </form>
            <div class="login-foot">&copy; <?= date('Y'); ?> SISPALA Mahardika · Admin Panel</div>
        </div>
    </section>
</div>
<script>
const togglePassword = document.getElementById('togglePassword');
const password = document.getElementById('password');
togglePassword.addEventListener('click', function () {
    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', type);
    const icon = this.querySelector('i');
    icon.classList.toggle('bi-eye', type === 'password');
    icon.classList.toggle('bi-eye-slash', type !== 'password');
});
</script>
</body>
</html>
