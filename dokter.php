<?php
include 'auth.php';    // Proteksi halaman: wajib login
include 'koneksi.php';

$pesan = "";
if (isset($_POST['simpan'])) {
    $username    = $_POST['username'];
    $password    = $_POST['password'];
    $nama_dokter = $_POST['nama_dokter'];
    $alamat      = $_POST['alamat'];
    $tgl_lahir   = $_POST['tgl_lahir'];
    $jenis       = $_POST['jenis'];
    $spesialis   = $_POST['spesialis'];

    $simpan = mysqli_query($con, "INSERT INTO dokter (username, password, nama_dokter, alamat, tgl_lahir, jenis, spesialis) 
                                  VALUES ('$username', '$password', '$nama_dokter', '$alamat', '$tgl_lahir', '$jenis', '$spesialis')");
    if ($simpan) {
        $pesan = "Data dokter berhasil ditambahkan!";
    } else {
        $pesan = "Gagal: " . mysqli_error($con);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dokter</title>
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

        input, select {
            font: 16px arial, sans-serif;
            border-radius: 5px;
            width: 100%;
            height: 35px;
            box-sizing: border-box;
            border: 1px solid #333;
            padding: 5px 10px;
            margin-bottom: 5px;
        }

        select {
            height: 38px;
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
        <h1>Dokter</h1>

        <?php if ($pesan) echo "<p class='pesan'>$pesan</p>"; ?>

        <form action="dokter.php" method="post">

            <h3>Username</h3>
            <input type="text" name="username" placeholder="Masukkan username" required>

            <h3>Password</h3>
            <input type="password" name="password" placeholder="Masukkan password" required>

            <h3>Nama Dokter</h3>
            <input type="text" name="nama_dokter" placeholder="Contoh: dr. Budi Santoso" required>

            <h3>Alamat</h3>
            <input type="text" name="alamat" placeholder="Masukkan alamat lengkap" required>

            <h3>Tanggal Lahir</h3>
            <input type="date" name="tgl_lahir" required>

            <h3>Jenis Kelamin</h3>
            <select name="jenis" required>
                <option value="">-- Pilih Jenis Kelamin --</option>
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
            </select>

            <h3>Spesialis</h3>
            <input type="text" name="spesialis" placeholder="Contoh: Dokter Umum, Spesialis Gigi" required>

            <a href="dashboard.php" id="back">Back</a>
            <button type="submit" name="simpan" id="simpan">Simpan</button>
            <div style="clear: both;"></div>

        </form>
    </div>
</body>
</html>
