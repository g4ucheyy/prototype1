<?php
include('db.php');

$query = mysqli_query($conn, "SELECT * FROM users");

$row = mysqli_fetch_assoc($query);

$name = $row['name'];
$id = $row['id'];
$pwd = $row['pwd'];



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
    table, tr, th, td {
        border-collapse: collapse;
        border: 2px solid black;
        padding: 10px;
        background: whitesmoke;
    }

    .info {
background-color: whitesmoke;
    border: 4px solid black;
    border-radius: 5px;
    width: 350px;
    font-family: monospace;
    }
</style>
<body>

    <h1 id="home">InOutKVPJB</h1>

    <div class="menu">
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="add.php">Tambah Rekod</a></li>
            <li><a href="view.php">View Rekod</a></li>
              <li><a href="logout.php" onclick="return confirm('Adakah anda ingin Log keluar?');">Log Out</a></li>
        </ul>
    </div>
    <br>
    <center>

<div class="info">
    <h2>Nama User: <?php echo $name; ?> </h2>
    <h2>ID User: <?php echo $id; ?> </h2>
    
</div>
<br>

  <table border="1" id="data-table" style="border-collapse: collapse; width: 80%; text-align: left; font-family: sans-serif;">
      
            <tr style="background-color: #2c3e50; color: black;">
                <th style="padding: 10px;">Bil</th>
                <th style="padding: 10px;">Tarikh Keluar</th>
                <th style="padding: 10px;">Waktu keluar</th>
                <th style="padding: 10px;">Tujuan/Destinasi</th>
                <th style="padding: 10px;">TT Warden/Penyelia</th>
                <th style="padding: 10px;">Tarikh Masuk</th>
                <th style="padding: 10px;">Waktu Masuk</th>
                <th style="padding: 10px;">TT Penjaga</th>
                <th style="padding: 10px;">Catatan</th>                

            </tr>

            <?php
            include('db.php');

            $bil = 1;
           

            $query = mysqli_query($conn, "SELECT * FROM record");

            while ($row = mysqli_fetch_assoc($query)) {

            echo "

            <tr>
            <td>".$bil++."</td>
            <td>".$row['tarikh_keluar']."</td>
            <td>".$row['waktu_keluar']."</td>
            <td>".$row['tujuan']."</td>
            <td>".$row['tt1']."</td>
            <td>".$row['tarikh_masuk']."</td>
            <td>".$row['waktu_masuk']."</td>
            <td>".$row['tt2']."</td>
            <td>".$row['catatan']."</td>
            ";
            }
            ?>
    </table>
</center>


</body>
</html>