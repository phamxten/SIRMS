<?php
include 'auth.php'; // Proteksi halaman: wajib login
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
    body{
        font: 16px/28px arial,san-serif ;
        background-image: url(bg.png);
    }

    #login:hover{
        background-color: red;
        color: white;
        border-radius: 3px;
    }
    
.twitter{
    width: 200px;
    height: 200px;
    background-image: url(twitter.png);
    background-repeat: no-repeat;
    display: inline-block;
    text-indent: -99999px;
    position: absolute;
    top: -40px;
    right: -65px;
}

.container{
    width: 800px;
    background-color: #fff;
    border-radius: 10px;
    margin: 100px auto;
    position: relative;
}

.header h2{
    font-size: 40px;
    font-weight: bold;

}

.header{
    padding: 10px;
}

.header a{
    margin-right: 10px;
    text-decoration: none;
    display: inline-block;
    color: tomato;
    font-weight: bold;
}

.header a:hover{
    background-color: coral;
    color: white;
    border-radius: 3px;
}

.hero{
    height: 350px;
    background-image: url(clinic.jpg);
    background-size: cover;
    background-position: 0px;

}

.content h2{
    font-size: 40px;
    font-weight: bold;
}


.content{
    font-size: 15px;
    margin: 15px;
}


.content a{
    text-decoration: none;
    color: tomato;
    font-weight: bold;
}

.content a:hover{
    background-color: coral;
    color: white;
    border-radius: 3px;
}

.footer{
    background-color: #1F2937;
    padding: 5px;
}

.footer .copy p{
    font-size: 15px;
    font-weight: bold;
    color: #fff;
    text-align: center;
}

    </style>
</head>
<body>
    <div class="container">
        <a href="http://twitter.com/" target="_blank" class="twitter">My Twitter</a>
        <div class="header">
            <h2>SIRMS</h2>
            <hr>
            <a href="pasien.php">Pasien</a>
            <a href="dokter.php">Dokter</a>
            <a href="obat.php">Obat</a>
            <a href="pemeriksaan.php">Pemeriksaan</a>
            <span style="color:#555; font-size:14px; margin-right:10px;">
                👤 <?= htmlspecialchars($_SESSION['nama_dokter'] ?? 'Dokter'); ?>
            </span>
            <a href="logout.php" id="login">Logout</a>
        </div>
        <div class="hero"></div>

        <div class="footer">
            <div class="copy">
                <p>Copyright 2026. phamx. all rights reserved</p>
            </div>
        </div>

        
    </div>
</body>
</html>