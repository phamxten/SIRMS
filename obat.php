<?php
include 'auth.php';    // Proteksi halaman: wajib login
include 'koneksi.php';

$pesan = "";
if (isset($_POST['simpan'])) {
    $kode_obat = $_POST['kode_obat'];
    $nama_obat = $_POST['nama_obat'];

    $simpan = mysqli_query($con, "INSERT INTO obat (kode_obat, nama_obat) VALUES ('$kode_obat', '$nama_obat')");
    if ($simpan) {
        $pesan = "Data obat berhasil ditambahkan!";
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
    <title>Obat</title>
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

        input {
            font: 16px arial, sans-serif;
            border-radius: 5px;
            width: 100%;
            height: 35px;
            box-sizing: border-box;
            border: 1px solid #333;
            padding: 5px 10px;
            margin-bottom: 5px;
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
        <h1>Obat</h1>

        <?php if ($pesan) echo "<p class='pesan'>$pesan</p>"; ?>

        <form action="obat.php" method="post">

            <h3>Kode Obat</h3>
            <input type="text" name="kode_obat" placeholder="Contoh: OBT-001" required>

            <h3>Nama Obat</h3>
            <input type="text" name="nama_obat" placeholder="Contoh: Paracetamol 500mg" required>

            <a href="dashboard.php" id="back">Back</a>
            <button type="submit" name="simpan" id="simpan">Simpan</button>
            <div style="clear: both;"></div>

        </form>
    </div>
</body>
</html>