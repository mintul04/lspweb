<?php
require_once 'auth_check.php';
require_once '../config.php';

$id = intval($_GET['id'] ?? 0);
if ($id <= 0) {
    header('Location: dashboard.php');
    exit;
}

// Ambil data lama
$stmt = $conn->prepare("SELECT * FROM kegiatan WHERE id = ?");
$stmt->bind_param('i', $id);
$stmt->execute();
$kegiatan = $stmt->get_result()->fetch_assoc();

if (!$kegiatan) {
    header('Location: dashboard.php');
    exit;
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $judul     = trim($_POST['judul'] ?? '');
    $deskripsi = trim($_POST['deskripsi'] ?? '');
    $tanggal   = trim($_POST['tanggal'] ?? '');
    
    $gambar_final = $kegiatan['gambar']; 

    if (!empty($_FILES['gambar']['name'])) {
        $ext = pathinfo($_FILES['gambar']['name'], PATHINFO_EXTENSION);
        $nama_file = time() . '_' . uniqid() . '.' . $ext;
        
        if (move_uploaded_file($_FILES['gambar']['tmp_name'], "../assets/img/" . $nama_file)) {
            if (!empty($kegiatan['gambar']) && file_exists("../assets/img/" . $kegiatan['gambar'])) {
                unlink("../assets/img/" . $kegiatan['gambar']);
            }
            $gambar_final = $nama_file;
        }
    }

    if (empty($tanggal)) {
        $tanggal = $kegiatan['tanggal']; 
    }

    $stmt = $conn->prepare("UPDATE kegiatan SET judul=?, deskripsi=?, tanggal=?, gambar=? WHERE id=?");
    $stmt->bind_param('ssssi', $judul, $deskripsi, $tanggal, $gambar_final, $id);

    if ($stmt->execute()) {
        $_SESSION['flash_success'] = 'Kegiatan berhasil diperbarui!';
        header('Location: dashboard.php');
        exit;
    } else {
        $error = 'Gagal memperbarui database: ' . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kegiatan</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
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
        <a href="dashboard.php" class="sidebar-link">Dashboard</a>
        <a href="../index.php" class="sidebar-link" target="_blank">Lihat Website</a>
    </nav>
    <div class="sidebar-footer">
        <div class="admin-info">
            <div class="admin-avatar"><?= strtoupper(substr($_SESSION['admin_username'] ?? 'AD', 0, 2)) ?></div>
            <div>
                <span class="admin-name"><?= htmlspecialchars($_SESSION['admin_username'] ?? 'Admin') ?></span>
                <span class="admin-role">Administrator</span>
            </div>
        </div>
        <a href="logout.php" class="btn-logout">Logout</a>
    </div>
</aside>

<main class="admin-main">
    <div class="admin-header">
        <div>
            <h1 class="admin-title">Edit Kegiatan</h1>
            <p class="admin-sub">Perbarui informasi kegiatan</p>
        </div>
        <a href="dashboard.php" class="btn-secondary">← Kembali</a>
    </div>

    <?php if ($error): ?>
        <div class="alert alert-error">⚠️ <?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <div class="form-card">
        <form method="POST" action="edit.php?id=<?= $id ?>" enctype="multipart/form-data">
            <div class="form-group">
                <label>Judul Kegiatan</label>
                <input type="text" name="judul" class="form-control" value="<?= htmlspecialchars($kegiatan['judul']) ?>" required>
            </div>

            <div class="form-group">
                <label>Tanggal Kegiatan <span class="req">*</span></label>
                <input type="date" name="tanggal" class="form-control" value="<?= htmlspecialchars($kegiatan['tanggal']) ?>" required>
            </div>

            <div class="form-group">
                <label>Gambar (Biarkan kosong jika tidak ingin ganti)</label>
                <?php if ($kegiatan['gambar']): ?>
                    <div style="margin-bottom: 10px;">
                        <small>Gambar saat ini:</small>
                        <img src="../assets/img/<?= htmlspecialchars($kegiatan['gambar']) ?>" style="width:120px; display:block; margin-top:5px; border-radius:5px; border:1px solid #ddd;">
                    </div>
                <?php endif; ?>
                <input type="file" name="gambar" class="form-control" accept="image/*">
            </div>

            <div class="form-group">
                <label>Deskripsi</label>
                <textarea name="deskripsi" class="form-control textarea" rows="7" required><?= htmlspecialchars($kegiatan['deskripsi']) ?></textarea>
            </div>

            <div class="form-actions">
                <a href="dashboard.php" class="btn-cancel">Batal</a>
                <button type="submit" class="btn-primary">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</main>

</body>
</html>