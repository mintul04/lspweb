<?php
require_once 'config.php';

// Fetch kegiatan ordered by tanggal DESC (newest first)
$sql = "SELECT id, judul, deskripsi, tanggal, gambar FROM kegiatan ORDER BY tanggal DESC, id DESC";
$result = $conn->query($sql);
$kegiatan_list = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $kegiatan_list[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= SITE_NAME ?> – <?= SITE_TAGLINE ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Syne:wght@700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css?v=2">
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
                <a href="kontak.php" class="nav-link">Hubungi Kami</a>
                <a href="login.php" class="nav-link btn-login">Login</a>
            </div>
            <button class="hamburger" onclick="toggleMenu()">
                <span></span><span></span><span></span>
            </button>
        </div>
        <div class="mobile-menu" id="mobileMenu">
            <a href="index.php" class="nav-link active">Home</a>
            <a href="kontak.php" class="nav-link">Hubungi Kami</a>
            <a href="login.php" class="nav-link">Login</a>
        </div>
    </nav>

    <section class="hero">
        <div class="hero-bg">
            <div class="hero-shape s1"></div>
            <div class="hero-shape s2"></div>
            <div class="hero-shape s3"></div>
        </div>
        <div class="hero-content">
            <h1 class="hero-title">Informasi Kegiatan<br><span class="">SMKN 1 Dlanggu</span></h1>
            <div class="hero-stats">
                <div class="stat-divider"></div>
                <div class="stat-item">
                    <span class="stat-num">2026</span>
                    <span class="stat-label">Tahun Pelajaran</span>
                </div>
                <div class="stat-divider"></div>
                <div class="stat-item">
                    <span class="stat-num">SMKN 1 DLANGGU</span>
                    <span class="stat-label">Sekolah Terbaik</span>
                </div>
            </div>
        </div>
    </section>

    <section class="section-kegiatan">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Kegiatan Terkini</h2>
                <p class="section-sub">Daftar seluruh kegiatan sekolah SMK Negeri 1 Dlanggu</p>
            </div>

            <?php if (empty($kegiatan_list)): ?>
                <div class="empty-state">
                    <div class="empty-icon"></div>
                    <h3>Belum Ada Kegiatan</h3>
                    <p>Kegiatan akan ditampilkan di sini setelah administrator menambahkannya.</p>
                </div>
            <?php else: ?>
                <div class="card-grid">
                    <?php foreach ($kegiatan_list as $i => $k):
                        $bulan = date('M', strtotime($k['tanggal']));
                        $hari  = date('d', strtotime($k['tanggal']));
                    ?>
                        <article class="card" style="--card-accent: #3498db;">
                            <div class="card-img-wrapper">
                                <?php if (!empty($k['gambar'])): ?>
                                    <img src="assets/img/<?= htmlspecialchars($k['gambar']) ?>"
                                        alt="<?= htmlspecialchars($k['judul']) ?>"
                                        style="width: 100%; height: 200px; object-fit: cover;">
                                <?php else: ?>
                                    <div style="width: 50%; height: 100px; background: #eee; display: flex; align-items: center; justify-content: center; color: #999;">No Image</div>
                                <?php endif; ?>
                            </div>

                            <div class="card-header">
                                <div class="card-date-box">
                                    <span class="date-day"><?= $hari ?></span>
                                    <span class="date-month"><?= $bulan ?></span>
                                </div>
                            </div>

                            <div class="card-body">
                                <h3 class="card-title"><?= htmlspecialchars($k['judul']) ?></h3>
                                <p class="card-desc">
                                    <?= nl2br(htmlspecialchars(substr($k['deskripsi'], 0, 120))) ?>
                                </p>
                            </div>

                            <div class="card-footer">
                                <button class="btn-detail" onclick="openModal(<?= $k['id'] ?>)">Baca Selengkapnya →</button>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <?php foreach ($kegiatan_list as $k):
        $tanggal_fmt = date('d F Y', strtotime($k['tanggal']));
    ?>
        <div class="modal-overlay" id="modal-<?= $k['id'] ?>" onclick="closeModalOutside(event, <?= $k['id'] ?>)">
            <div class="modal-box">
                <div class="modal-top" style="border-top: 4px solid #3498db;">
                    <button class="modal-close" onclick="closeModal(<?= $k['id'] ?>)">✕</button>
                </div>
                <h2 class="modal-title"><?= htmlspecialchars($k['judul']) ?></h2>
                <p class="modal-date">📅 <?= $tanggal_fmt ?></p>

                <?php if (!empty($k['gambar'])): ?>
                    <img src="assets/img/<?= htmlspecialchars($k['gambar']) ?>"
                        style="width: auto; max-height: 250px; display: block; margin: 0 auto 20px auto; border-radius: 12px;">
                <?php endif; ?>

                <div class="modal-desc"><?= nl2br(htmlspecialchars($k['deskripsi'])) ?></div>
            </div>
        </div>
    <?php endforeach; ?>

    <footer class="footer">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-brand">
                    <div class="footer-logo">
                        <div class="brand-icon sm">SMK</div>
                        <span><?= SITE_NAME ?></span>
                    </div>
                    <p>Portal informasi resmi kegiatan SMK Negeri 1 Dlanggu. Menyebarkan informasi terkini untuk masyarakat.</p>
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
                <p>© 2026 <?= SITE_NAME ?> – <?= SITE_TAGLINE ?>. Dibuat oleh <strong>Amanda_Defina</strong></p>
            </div>
        </div>
    </footer>

    <script src="assets/js/main.js"></script>
</body>

</html>