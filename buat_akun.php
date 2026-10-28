<?php
/**
 * SCRIPT SEKALI PAKAI - Hapus file ini setelah akun dibuat!
 * Buka di browser: http://localhost/SIRMS/buat_akun.php
 */
include 'koneksi.php';

// === GANTI DATA INI SESUAI KEINGINAN KAMU ===
$username    = "admin";
$password    = "12345";      // Password yang akan kamu pakai untuk login
$nama_dokter = "Dr. klontong";
$alamat      = "Jl. Klinik No. 1";
$tgl_lahir   = "1990-01-01";
$jenis       = "Laki-laki";
$spesialis   = "Dokter Umum";
// ============================================

// Hash password dengan aman
$password_hash = password_hash($password, PASSWORD_DEFAULT);

$stmt = mysqli_prepare($con, "INSERT INTO dokter (username, password, nama_dokter, alamat, tgl_lahir, jenis, spesialis) 
                               VALUES (?, ?, ?, ?, ?, ?, ?)");
mysqli_stmt_bind_param($stmt, "sssssss", $username, $password_hash, $nama_dokter, $alamat, $tgl_lahir, $jenis, $spesialis);

if (mysqli_stmt_execute($stmt)) {
    echo "<h2 style='color:green'>✅ Akun berhasil dibuat!</h2>";
    echo "<p>Username: <strong>$username</strong></p>";
    echo "<p>Password: <strong>$password</strong></p>";
    echo "<p><strong style='color:red'>⚠️ HAPUS FILE INI SEKARANG lalu pergi ke <a href='login.php'>login.php</a></strong></p>";
} else {
    echo "<h2 style='color:red'>❌ Gagal: " . mysqli_error($con) . "</h2>";
}
?>
