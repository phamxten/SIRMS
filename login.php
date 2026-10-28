<?php
session_start();
include 'koneksi.php';

// --- KONFIGURASI BATAS LOGIN ---
define('MAX_PERCOBAAN', 5);       // Maksimal 5x salah
define('DURASI_KUNCI', 5 * 60);   // Kunci selama 5 menit (dalam detik)

$error   = "";
$sisa_waktu = 0;

// Jika sudah login, langsung ke dashboard
if (isset($_SESSION['user_id'])) {
    header('Location: dashboard.php');
    exit();
}

// Inisialisasi session counter jika belum ada
if (!isset($_SESSION['gagal'])) {
    $_SESSION['gagal']      = 0;
    $_SESSION['waktu_kunci'] = null;
}

// Cek apakah akun sedang dikunci
if ($_SESSION['waktu_kunci'] !== null) {
    $sisa = DURASI_KUNCI - (time() - $_SESSION['waktu_kunci']);
    if ($sisa > 0) {
        $sisa_waktu = $sisa;
        $menit = floor($sisa / 60);
        $detik = $sisa % 60;
        $error = "Akun terkunci! Coba lagi dalam {$menit} menit {$detik} detik.";
    } else {
        // Waktu kunci habis, reset counter
        $_SESSION['gagal']      = 0;
        $_SESSION['waktu_kunci'] = null;
    }
}

// Proses form login
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_SESSION['waktu_kunci'] === null) {

    // Ambil input dan bersihkan
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if (empty($username) || empty($password)) {
        $error = "Username dan password wajib diisi!";
    } else {
        // === ANTI SQL INJECTION: Pakai Prepared Statement ===
        $stmt = mysqli_prepare($con, "SELECT id, username, password, nama_dokter FROM dokter WHERE username = ? LIMIT 1");
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $dokter = mysqli_fetch_assoc($result);
        mysqli_stmt_close($stmt);

        // Cek apakah username ada dan password cocok
        // password_verify() dipakai karena password disimpan dengan password_hash()
        if ($dokter && password_verify($password, $dokter['password'])) {
            // LOGIN BERHASIL: Reset counter, simpan session
            $_SESSION['gagal']       = 0;
            $_SESSION['waktu_kunci']  = null;
            $_SESSION['user_id']     = $dokter['id'];
            $_SESSION['username']    = $dokter['username'];
            $_SESSION['nama_dokter'] = $dokter['nama_dokter'];

            header('Location: dashboard.php');
            exit();

        } else {
            // LOGIN GAGAL: Tambah hitungan gagal
            $_SESSION['gagal']++;
            $sisa_percobaan = MAX_PERCOBAAN - $_SESSION['gagal'];

            if ($_SESSION['gagal'] >= MAX_PERCOBAAN) {
                // Kunci akun selama 5 menit
                $_SESSION['waktu_kunci'] = time();
                $error = "Akun terkunci selama 5 menit karena terlalu banyak percobaan gagal!";
            } else {
                $error = "Username atau password salah! Sisa percobaan: <strong>{$sisa_percobaan}x</strong>";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SIRMS</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font: 18px/30px arial, sans-serif;
            font-weight: bold;
            background-image: url(bg.png);
            margin: 0;
        }

        .container {
            font-family: "Roboto Slab", serif;
            padding: 30px;
            border-radius: 15px;
            width: 500px;
            margin: 80px auto;
            background-color: white;
            position: relative;
            box-sizing: border-box;
        }

        h1 {
            text-align: center;
            margin-bottom: 10px;
        }

        h3 {
            margin-bottom: 5px;
        }

        input {
            font: 16px arial, sans-serif;
            width: 100%;
            height: 40px;
            border-radius: 10px;
            border: 1px solid #ccc;
            padding: 5px 12px;
            box-sizing: border-box;
            margin-bottom: 5px;
        }

        input:focus {
            outline: none;
            border-color: tomato;
        }

        button {
            font: 18px/30px arial, sans-serif;
            font-weight: bold;
            border-radius: 13px;
            width: 100%;
            height: 50px;
            background-color: tomato;
            color: white;
            border: none;
            cursor: pointer;
            margin-top: 20px;
        }

        button:hover {
            background-color: coral;
        }

        button:disabled {
            background-color: #aaa;
            cursor: not-allowed;
        }

        .error {
            background-color: #ffe0e0;
            border-left: 4px solid red;
            color: #cc0000;
            padding: 10px 15px;
            border-radius: 5px;
            margin: 10px 0;
            font-size: 15px;
        }

        .info-percobaan {
            text-align: center;
            font-size: 14px;
            color: #888;
            margin-top: 10px;
        }

        /* Countdown timer */
        #countdown {
            font-size: 28px;
            color: red;
            text-align: center;
            margin: 10px 0;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <form action="login.php" method="post">
        <div class="container">
            <h1>Login</h1>

            <?php if (!empty($error)): ?>
                <div class="error"><?= $error ?></div>
            <?php endif; ?>

            <?php if ($sisa_waktu > 0): ?>
                <!-- Hitung mundur saat akun terkunci -->
                <div id="countdown"></div>
                <script>
                    let sisa = <?= $sisa_waktu ?>;
                    function updateCountdown() {
                        let m = Math.floor(sisa / 60);
                        let s = sisa % 60;
                        document.getElementById('countdown').innerText = 
                            `⏳ ${m}:${s < 10 ? '0' + s : s}`;
                        if (sisa <= 0) {
                            location.reload(); // Refresh otomatis saat kunci habis
                        }
                        sisa--;
                    }
                    updateCountdown();
                    setInterval(updateCountdown, 1000);
                </script>
            <?php endif; ?>

            <h3>Username</h3>
            <input 
                type="text" 
                name="username" 
                placeholder="Masukkan username"
                <?= $sisa_waktu > 0 ? 'disabled' : '' ?>
                autocomplete="off"
            >

            <h3>Password</h3>
            <input 
                type="password" 
                name="password" 
                placeholder="Masukkan password"
                <?= $sisa_waktu > 0 ? 'disabled' : '' ?>
            >

            <button type="submit" <?= $sisa_waktu > 0 ? 'disabled' : '' ?>>
                Login
            </button>

            <?php if ($_SESSION['gagal'] > 0 && $sisa_waktu === 0): ?>
                <p class="info-percobaan">
                    Percobaan gagal: <?= $_SESSION['gagal'] ?>/<?= MAX_PERCOBAAN ?>
                </p>
            <?php endif; ?>

        </div>
    </form>
</body>
</html>