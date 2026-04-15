<?php
// Database Configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'lspweb');

$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if ($conn->connect_error) {
    die('<div style="font-family:sans-serif;padding:40px;text-align:center;color:#c0392b;">
        <h2>⚠️ Koneksi Database Gagal</h2>
        <p>' . $conn->connect_error . '</p>
        <p>Pastikan MySQL aktif dan database <strong>lspweb</strong> sudah dibuat.</p>
    </div>');
}

$conn->set_charset('utf8mb4');

// Site Config
define('SITE_NAME', 'DLANGGU');
define('SITE_TAGLINE', 'Informasi Kegiatan SMKN 1 Dlanggu');
?>
