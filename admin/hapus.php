<?php
require_once 'auth_check.php';
require_once '../config.php';

$id = intval($_GET['id'] ?? 0);
if ($id > 0) {
    $stmt = $conn->prepare("SELECT gambar FROM kegiatan WHERE id = ?");
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();

    if ($data) {
        $del = $conn->prepare("DELETE FROM kegiatan WHERE id = ?");
        $del->bind_param('i', $id);
        if ($del->execute()) {
            if (!empty($data['gambar']) && file_exists("../assets/img/" . $data['gambar'])) {
                unlink("../assets/img/" . $data['gambar']);
            }
            $_SESSION['flash_success'] = 'Kegiatan dan gambar berhasil dihapus!';
        }
    }
}
header('Location: dashboard.php');
exit;