<?php
require_once 'auth_check.php';
require_once '../config.php';

$success = $_SESSION['flash_success'] ?? '';
$error_msg = $_SESSION['flash_error'] ?? '';
unset($_SESSION['flash_success'], $_SESSION['flash_error']);

// Count total kegiatan
$total_result = $conn->query("SELECT COUNT(*) as c FROM kegiatan");
$total = ($total_result) ? $total_result->fetch_assoc()['c'] : 0;

// Fetch all kegiatan (Hanya kolom yang ada di database)
$result = $conn->query("SELECT id, judul, deskripsi, tanggal, gambar FROM kegiatan ORDER BY tanggal DESC, id DESC");
$list = [];
if ($result) {
    while ($row = $result->fetch_assoc()) $list[] = $row;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Administrator – <?= SITE_NAME ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/admin.css">
    <style>
        /* Tambahan style agar deskripsi dan gambar rapi */
        .img-preview {
            width: 80px;
            height: 50px;
            object-fit: cover;
            border-radius: 6px;
            border: 1px solid #eee;
        }
        .desc-column {
            max-width: 300px;
            font-size: 0.85rem;
            color: #64748b;
            line-height: 1.5;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        .stat-card-single {
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            display: inline-flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 25px;
            border-left: 5px solid #3498db;
        }
    </style>
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
        <a href="dashboard.php" class="sidebar-link active">📊 Dashboard</a>

        <a href="../index.php" class="sidebar-link" target="_blank">🌐 Lihat Website</a>
    </nav>
    <div class="sidebar-footer">
        <div class="admin-info">
            <div class="admin-avatar"><?= strtoupper(substr($_SESSION['admin_username'] ?? 'AD', 0, 2)) ?></div>
            <div>
                <span class="admin-name"><?= htmlspecialchars($_SESSION['admin_username'] ?? 'Admin') ?></span>
                <span class="admin-role">Administrator</span>
            </div>
        </div>
        <a href="logout.php" class="btn-logout">🚪Logout</a>
    </div>
</aside>

<main class="admin-main">
    <div class="admin-header">
        <div>
            <h1 class="admin-title">Dashboard</h1>
            <p class="admin-sub">Kelola informasi kegiatan SMKN 1 Dlanggu</p>
        </div>
        <a href="tambah.php" class="btn-primary">+ Tambah Kegiatan</a>
    </div>

    <?php if ($success): ?>
        <div class="alert alert-success" style="padding: 15px; background: #dcfce7; color: #166534; border-radius: 8px; margin-bottom: 20px;">✅ <?= htmlspecialchars($success) ?></div>
    <?php endif; ?>

    <div class="table-card" style="background: white; border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); overflow: hidden;">
        <div class="table-header" style="padding: 20px; border-bottom: 1px solid #f1f5f9; display: flex; justify-content: space-between; align-items: center;">
            <h2 style="font-size: 1.1rem; font-weight: 700;">Daftar Kegiatan Terbaru</h2>
            <span style="background: #f1f5f9; padding: 4px 12px; border-radius: 20px; font-size: 0.85rem; color: #64748b;"><?= count($list) ?> baris</span>
        </div>
        
        <div class="table-responsive">
            <table class="admin-table" style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="text-align: left; background: #f8fafc;">
                        <th style="padding: 15px; width: 50px;">#</th>
                        <th style="padding: 15px; width: 100px;">Gambar</th>
                        <th style="padding: 15px; width: 200px;">Judul</th>
                        <th style="padding: 15px;">Deskripsi</th>
                        <th style="padding: 15px; width: 130px;">Tanggal</th>
                        <th style="padding: 15px; width: 150px; text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($list)): ?>
                        <tr>
                            <td colspan="6" style="padding: 40px; text-align: center; color: #94a3b8;">Belum ada data kegiatan.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($list as $i => $k): ?>
                        <tr style="border-bottom: 1px solid #f1f5f9;">
                            <td style="padding: 15px;"><?= $i + 1 ?></td>
                            <td style="padding: 15px;">
                                <?php if (!empty($k['gambar']) && file_exists("../assets/img/" . $k['gambar'])): ?>
                                    <img src="../assets/img/<?= htmlspecialchars($k['gambar']) ?>" class="img-preview">
                                <?php else: ?>
                                    <div style="width: 80px; height: 50px; background: #f1f5f9; border-radius: 6px; display: flex; align-items: center; justify-content: center; font-size: 10px; color: #cbd5e1; border: 1px dashed #cbd5e1;">No Img</div>
                                <?php endif; ?>
                            </td>
                            <td style="padding: 15px;">
                                <div style="font-weight: 700; color: #1e293b;"><?= htmlspecialchars($k['judul']) ?></div>
                            </td>
                            <td style="padding: 15px;">
                                <div class="desc-column"><?= htmlspecialchars($k['deskripsi']) ?></div>
                            </td>
                            <td style="padding: 15px; color: #64748b; font-size: 0.9rem;">
                                 <?= date('d M Y', strtotime($k['tanggal'])) ?>
                            </td>
                            <td style="padding: 15px; text-align: center;">
                                <div style="display: flex; gap: 8px; justify-content: center;">
                                    <a href="edit.php?id=<?= $k['id'] ?>" class="btn-edit" style="text-decoration: none; font-size: 0.85rem; padding: 6px 10px; background: #f9fbfcff; border-radius: 5px; color: #1e293b;">✏️ Edit</a>
                                    <button class="btn-delete" 
                                            style="cursor: pointer; font-size: 0.85rem; padding: 6px 10px; background: #e98e95ff; border-radius: 5px; color: #1e293b; border: none;"
                                            onclick="confirmDelete(<?= $k['id'] ?>, '<?= addslashes(htmlspecialchars($k['judul'])) ?>')">🗑️ Hapus</button>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>

<div class="modal-overlay" id="deleteModal" style="position: fixed; top:0; left:0; width:100%; height:100%; background: rgba(0,0,0,0.5); display:none; align-items:center; justify-content:center; z-index:9999;">
    <div class="modal-box sm" style="background: white; padding: 25px; border-radius: 12px; max-width: 400px; width: 90%; text-align: center;">
        <h3 style="margin-bottom: 10px;">Konfirmasi Hapus</h3>
        <p id="deleteMsg" style="color: #64748b; margin-bottom: 20px; font-size: 0.95rem;"></p>
        <div style="display: flex; gap: 10px; justify-content: center;">
            <button onclick="closeDeleteModal()" style="padding: 8px 20px; border-radius: 6px; border: 1px solid #e2e8f0; background: white; cursor: pointer;">Batal</button>
            <a href="#" id="deleteConfirmBtn" style="padding: 8px 20px; border-radius: 6px; background: #e11d48; color: white; text-decoration: none; font-weight: 600;">Ya, Hapus</a>
        </div>
    </div>
</div>

<script>
function confirmDelete(id, title) {
    document.getElementById('deleteMsg').textContent = 'Apakah Anda yakin ingin menghapus "' + title + '"?';
    document.getElementById('deleteConfirmBtn').href = 'hapus.php?id=' + id;
    document.getElementById('deleteModal').style.display = 'flex';
}
function closeDeleteModal() {
    document.getElementById('deleteModal').style.display = 'none';
}
</script>

</body>
</html>