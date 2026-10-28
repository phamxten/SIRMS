<?php
include 'auth.php';    // Proteksi halaman: wajib login
include 'koneksi.php';

$pesan = "";
if (isset($_POST["simpan"])) {
    $id_pasien   = $_POST['id_pasien'];
    $keluhan     = $_POST['keluhan'];
    $tensi_darah = $_POST['tensi_darah'];
    $id_obat     = $_POST['id_obat'];
    $tgl_periksa = date('Y-m-d'); // otomatis pakai tanggal hari ini
    $id_dokter   = 1;             // sementara default, nanti bisa dari session login

    // 1. Simpan ke tabel pemeriksaan
    $query = mysqli_query($con, "INSERT INTO pemeriksaan (id_pasien, id_dokter, tgl_periksa, keluhan, tensi_darah) 
                                 VALUES ('$id_pasien', '$id_dokter', '$tgl_periksa', '$keluhan', '$tensi_darah')");

    if ($query) {
        // 2. Ambil id pemeriksaan yang baru disimpan
        $id_pemeriksaan_baru = mysqli_insert_id($con);

        // 3. Simpan relasi obat ke tabel pemeriksaan_obat
        mysqli_query($con, "INSERT INTO pemeriksaan_obat (id_pemeriksaan, id_obat) 
                            VALUES ('$id_pemeriksaan_baru', '$id_obat')");

        $pesan = "Data pemeriksaan berhasil disimpan!";
    } else {
        $pesan = "Gagal: " . mysqli_error($con);
    }
}

// Ambil daftar pasien dari tabel pasien untuk dropdown
$data_pasien = mysqli_query($con, "SELECT id, nama_pasien FROM pasien ORDER BY nama_pasien ASC");

// Ambil daftar obat dari tabel obat untuk dropdown
$data_obat = mysqli_query($con, "SELECT id, nama_obat FROM obat ORDER BY nama_obat ASC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemeriksaan</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font: 18px/30px arial, sans-serif;
            font-weight: bold;
            background-image: url(bg.png);
        }

        .container {
            box-sizing: border-box;
            font-family: "Roboto Slab", serif;
            width: 500px;
            background-color: white;
            margin: 50px auto;
            border-radius: 15px;
            padding: 30px;
            position: relative;
        }

        h1 {
            text-align: center;
            color: black;
            margin-top: 0;
        }

        h3 {
            color: black;
            margin-bottom: 5px;
        }

        input, textarea {
            font: 16px arial, sans-serif;
            border-radius: 5px;
            width: 100%;
            box-sizing: border-box;
            border: 1px solid #333;
            padding: 8px 10px;
            margin-bottom: 5px;
        }

        /* Dropdown select untuk Nama Pasien dan Obat */
        select {
            font: 16px arial, sans-serif;
            border-radius: 5px;
            width: 100%;
            height: 38px;
            box-sizing: border-box;
            border: 1px solid #333;
            padding: 5px 10px;
            margin-bottom: 5px;
        }

        textarea {
            resize: none;
            height: 120px;
        }

        #simpan {
            font: 18px/30px arial, sans-serif;
            font-weight: bold;
            border-radius: 13px;
            width: 100px;
            height: 50px;
            background-color: tomato;
            cursor: pointer;
            border: none;
            float: right;
            margin-top: 20px;
            color: white;
        }

        #simpan:hover {
            cursor: pointer;
            background-color: coral;
        }
        #back:hover {
            cursor: pointer;
            background-color: coral;
        }

        #back {
            color: white;
            background-color: tomato;
            text-decoration: none;
            padding: 10px 25px;
            border-radius: 13px;
            font-weight: bold;
            display: inline-block;
            margin-top: 20px;
        }

        .pesan {
            color: #00ff66;
            font-weight: bold;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <form action="pemeriksaan.php" method="post">
            <h1>Pasien</h1>

            <?php if ($pesan) echo "<p class='pesan'>$pesan</p>"; ?>

            <!-- DROPDOWN NAMA PASIEN (diisi otomatis dari tabel pasien) -->
            <h3>Nama</h3>
            <select name="id_pasien" required>
                <option value="">-- Pilih Pasien --</option>
                <?php while ($p = mysqli_fetch_array($data_pasien)): ?>
                    <option value="<?= $p['id']; ?>">
                        <?= htmlspecialchars($p['nama_pasien']); ?>
                    </option>
                <?php endwhile; ?>
            </select>

            <!-- TEXTAREA KELUHAN -->
            <h3>Keluhan</h3>
            <textarea name="keluhan" placeholder="Tulis keluhan pasien..." required></textarea>

            <!-- INPUT TENSI -->
            <h3>Tensi</h3>
            <input type="text" name="tensi_darah" placeholder="Contoh: 120/80" required>

            <!-- DROPDOWN NAMA OBAT (diisi otomatis dari tabel obat) -->
            <h3>Obat</h3>
            <select name="id_obat" required>
                <option value="">-- Pilih Obat --</option>
                <?php while ($o = mysqli_fetch_array($data_obat)): ?>
                    <option value="<?= $o['id']; ?>">
                        <?= htmlspecialchars($o['nama_obat']); ?>
                    </option>
                <?php endwhile; ?>
            </select>

            <a href="dashboard.php" id="back">Back</a>
            <button type="submit" name="simpan" value="Simpan" id="simpan">Simpan</button>
            <div style="clear: both;"></div>

        </form>
    </div>
</body>
</html>