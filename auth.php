<?php
/**
 * auth.php - File penjaga semua halaman
 * Include file ini di SETIAP halaman yang butuh login.
 * Jika user belum login, otomatis diarahkan ke login.php
 */
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}
?>
