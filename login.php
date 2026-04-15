<?php
session_start();
require_once 'config.php';

// Redirect if already logged in
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header('Location: admin/dashboard.php');
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if (empty($username) || empty($password)) {
        $error = 'Username dan password wajib diisi!';
    } else {
        $stmt = $conn->prepare("SELECT * FROM admin WHERE username = ? AND password = ? LIMIT 1");
        $stmt->bind_param('ss', $username, $password);
        $stmt->execute();
        $res = $stmt->get_result();

        if ($res->num_rows === 1) {
            $admin = $res->fetch_assoc();
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_username'] = $admin['username'];
            header('Location: admin/dashboard.php');
            exit;
        } else {
            $error = 'Username atau password salah!';
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
    <title>Login Administrator – <?= SITE_NAME ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Syne:wght@700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="login-body">

<div class="login-bg">
    <div class="hero-shape s1"></div>
    <div class="hero-shape s2"></div>
    <div class="hero-shape s3"></div>
</div>

<div class="login-wrapper">
    <div class="login-card">
        <div class="login-brand">
            <div class="brand-icon lg">SMK</div>
            <h2><?= SITE_NAME ?></h2>
            <p>Area Administrator</p>
        </div>

        <?php if ($error): ?>
        <div class="alert alert-error">
            <span>⚠️</span> <?= htmlspecialchars($error) ?>
        </div>
        <?php endif; ?>

        <form method="POST" action="login.php" class="login-form">
            <div class="form-group">
                <label for="username">Username</label>
                <div class="input-wrapper">
                    <span class="input-icon">👤</span>
                    <input type="text" id="username" name="username" placeholder="Masukkan username"
                           value="<?= htmlspecialchars($_POST['username'] ?? '') ?>" required>
                </div>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <div class="input-wrapper">
                    <span class="input-icon">🔒</span>
                    <input type="password" id="password" name="password" placeholder="Masukkan password" required>
                    <button type="button" class="toggle-pass" onclick="togglePassword()">👁</button>
                </div>
            </div>
            <button type="submit" class="btn-submit">Masuk ke Dashboard</button>
        </form>

        <div class="login-footer">
            <a href="index.php">← Kembali ke Halaman Utama</a>
        </div>
    </div>
</div>

<script>
function togglePassword() {
    const input = document.getElementById('password');
    input.type = input.type === 'password' ? 'text' : 'password';
}
</script>
</body>
</html>
