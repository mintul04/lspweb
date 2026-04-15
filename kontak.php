<?php require_once 'config.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hubungi Kami – <?= SITE_NAME ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Syne:wght@700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<nav class="navbar">
    <div class="nav-container">
        <a href="index.php" class="nav-brand">
            <div class="brand-icon">SMK</div>
            <div class="brand-text">
                <span class="brand-name"><?= SITE_NAME ?></span>
                <span class="brand-sub">SMKN 1 Dlanggu</span>
            </div>
        </a>
        <div class="nav-links">
            <a href="index.php" class="nav-link">Home</a>
            <a href="kontak.php" class="nav-link active">Hubungi Kami</a>
            <a href="login.php" class="nav-link btn-login">Login</a>
        </div>
        <button class="hamburger" onclick="toggleMenu()">
            <span></span><span></span><span></span>
        </button>
    </div>
    <div class="mobile-menu" id="mobileMenu">
        <a href="index.php" class="nav-link">Home</a>
        <a href="kontak.php" class="nav-link active">Hubungi Kami</a>
        <a href="login.php" class="nav-link">Login</a>
    </div>
</nav>

<!-- PAGE HEADER -->
<div class="page-header">
    <div class="hero-bg">
        <div class="hero-shape s1"></div>
        <div class="hero-shape s2"></div>
    </div>
    <div class="page-header-content">
        <h1 class="page-title">Hubungi <span class="accent">Kami</span></h1>
        <p>Informasi kontak dan lokasi SMK Negeri 1 Dlanggu</p>
    </div>
</div>

<!-- KONTAK CONTENT -->
<section class="section-kontak">
    <div class="container">
        <div class="kontak-grid">

            <!-- Alamat -->
            <div class="kontak-card">
                <div class="kontak-icon" style="background:#3498db20;color:#3498db;">📍</div>
                <h3>Alamat Sekolah</h3>
                <p>Jl. Raya Dlanggu No.1<br>Kecamatan Dlanggu<br>Kabupaten Mojokerto<br>Jawa Timur – 61371</p>
            </div>

            <!-- Telepon -->
            <div class="kontak-card">
                <div class="kontak-icon" style="background:#2ecc7120;color:#2ecc71;">📞</div>
                <h3>Call Center</h3>
                <p><strong>(0321) 593 056</strong></p>
                <p class="kontak-note">Senin – Jumat: 07.00 – 16.00 WIB</p>
            </div>

            <!-- Email -->
            <div class="kontak-card">
                <div class="kontak-icon" style="background:#e67e2220;color:#e67e22;">✉️</div>
                <h3>Email</h3>
                <p><strong>smkn1dlanggu@gmail.com</strong></p>
                <p class="kontak-note">Respon dalam 1×24 jam kerja</p>
            </div>

            <!-- Website -->
            <div class="kontak-card">
                <div class="kontak-icon" style="background:#9b59b620;color:#9b59b6;">🌐</div>
                <h3>Website Resmi</h3>
                <p><a href="https://www.smkn1dlanggu.sch.id" target="_blank" class="kontak-link">www.smkn1dlanggu.sch.id</a></p>
                <p class="kontak-note">Informasi resmi sekolah</p>
            </div>

        </div>

        <!-- PROGRAMMER INFO -->
        <div class="programmer-card">
            <div class="prog-left">
                <div class="prog-avatar">AD</div>
                <div>
                    <h3>Web Programmer</h3>
                    <p class="prog-name">Amanda_Defina</p>
                    <p class="prog-desc">Website <?= SITE_NAME ?> dirancang dan dikembangkan oleh Amanda_Defina sebagai portal informasi kegiatan SMKN 1 Dlanggu untuk masyarakat umum.</p>
                </div>
            </div>
            <div class="prog-tech">
                <span class="tech-badge">PHP Native</span>
                <span class="tech-badge">MySQL</span>
                <span class="tech-badge">HTML5</span>
                <span class="tech-badge">CSS3</span>
            </div>
        </div>

    </div>
</section>

<footer class="footer">
    <div class="container">
        <div class="footer-grid">
            <div class="footer-brand">
                <div class="footer-logo">
                    <div class="brand-icon sm">SMK</div>
                    <span><?= SITE_NAME ?></span>
                </div>
                <p>Portal informasi resmi kegiatan SMK Negeri 1 Dlanggu.</p>
            </div>
            <div class="footer-links">
                <h4>Navigasi</h4>
                <a href="index.php">Home</a>
                <a href="kontak.php">Hubungi Kami</a>
                <a href="login.php">Login Admin</a>
            </div>
            <div class="footer-info">
                <h4>SMKN 1 Dlanggu</h4>
                <p>Jl. Raya Dlanggu, Kec. Dlanggu,<br>Kab. Mojokerto, Jawa Timur</p>
                <a href="https://www.smkn1dlanggu.sch.id" target="_blank">🌐 www.smkn1dlanggu.sch.id</a>
            </div>
        </div>
        <div class="footer-bottom">
            <p>© 2024 <?= SITE_NAME ?> – <?= SITE_TAGLINE ?>. Dibuat oleh <strong>Amanda_Defina</strong></p>
        </div>
    </div>
</footer>

<script src="assets/js/main.js"></script>
</body>
</html>
