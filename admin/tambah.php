<?php
require_once 'auth_check.php';
require_once '../config.php';

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $judul     = trim($_POST['judul'] ?? '');
    $deskripsi = trim($_POST['deskripsi'] ?? '');
    $tanggal   = trim($_POST['tanggal'] ?? '');

    // Proses Upload Gambar
    $gambar_nama = '';
    if (!empty($_FILES['gambar']['name'])) {
        $file_tmp  = $_FILES['gambar']['tmp_name'];
        $ext       = pathinfo($_FILES['gambar']['name'], PATHINFO_EXTENSION);
        $gambar_nama = time() . '_' . uniqid() . '.' . $ext;
        $target    = "../assets/img/" . $gambar_nama;
        move_uploaded_file($file_tmp, $target);
    }

    if (empty($judul) || empty($deskripsi) || empty($tanggal)) {
        $error = 'Semua field wajib diisi!';
    } else {
        $stmt = $conn->prepare("INSERT INTO kegiatan (judul, deskripsi, tanggal, gambar) VALUES (?, ?, ?, ?)");
        $stmt->bind_param('ssss', $judul, $deskripsi, $tanggal, $gambar_nama);
        if ($stmt->execute()) {
            $_SESSION['flash_success'] = 'Kegiatan berhasil ditambahkan!';
            header('Location: dashboard.php');
            exit;
        } else {
            $error = 'Gagal menyimpan data ke database.';
        }
        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kegiatan – <?= SITE_NAME ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body>
    <aside class="sidebar">
        <div class="sidebar-brand">
            <div class="brand-icon">SMK</div>
            <div>
                <span class="brand-name">SMKN1DLANGGU</span>
                <span class="brand-sub">Administrator</span>
            </div>
        </div>
        <nav class="sidebar-nav">
            <a href="dashboard.php" class="sidebar-link">📊 Dashboard</a>
            <a href="../index.php" class="sidebar-link" target="_blank">🌐 Lihat Website</a>
        </nav>
    </aside>

    <main class="admin-main">
        <div class="admin-header">
            <div>
                <h1 class="admin-title">Tambah Kegiatan</h1>
                <p class="admin-sub">Masukkan informasi kegiatan baru</p>
            </div>
            <a href="dashboard.php" class="btn-secondary">← Kembali</a>
        </div>

        <?php if ($error): ?>
            <div class="alert alert-error">⚠️ <?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <div class="form-card">
            <form method="POST" action="tambah.php" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Judul Kegiatan <span class="req">*</span></label>
                    <input type="text" name="judul" class="form-control" placeholder="Masukkan judul..." required>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Tanggal Kegiatan <span class="req">*</span></label>
                        <input type="date" name="tanggal" class="form-control" value="<?= date('Y-m-d') ?>" required>
                    </div>
                </div>
                <div class="form-group">
                    <label>Gambar Kegiatan <span class="req">*</span></label>
                    <input type="file" name="gambar" class="form-control" accept="image/*" required>
                </div>
                <div class="form-group">
                    <label>Deskripsi Kegiatan <span class="req">*</span></label>
                    <textarea name="deskripsi" class="form-control textarea" rows="7" required></textarea>
                </div>
                <div class="form-actions">
                    <a href="dashboard.php" class="btn-secondary">Batal</a>
                    <button type="submit" class="btn-primary">💾 Simpan Kegiatan</button>
                </div>
            </form>
        </div>
    </main>
</body>
</html>