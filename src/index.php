<?php
include('db.php');

session_start();

if (!isset($_SESSION['user_id'])) {
    header('location:login.php');
    exit();
}

$query = mysqli_query($conn, "SELECT * FROM users");

$row = mysqli_fetch_assoc($query);

$name = $row['name'];


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="home.png">
</head>
<style>
    body {
        background-color:rgb(234, 203, 255);
    }
</style>
<body>

    <h1 id="home">InOutKVPJB</h1>
    <h3 id="home2">Sistem Pengurusan Kolej Kediaman</h3>

    <div class="menu">
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="add.php">Tambah Rekod</a></li>
            <li><a href="view.php">View Rekod</a></li>
            <li><a href="logout.php" onclick="return confirm('Adakah anda ingin Log keluar?');">Log Out</a></li>
        </ul>
    </div>

    <marquee direction="right" id="grr">SELAMAT DATANG KE SISTEM InOutKVPJB, <?php echo $name; ?>!</marquee>
    
    
    <center>
        <br>
        <img id="img1" src="img.jpg" width="350px" height="250px">
        
    </center>


    
</body>
</html>