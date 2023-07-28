<?php
include '../../database/config.php';
session_start();
 
if (!isset($_SESSION['username'])) {
    header("Location: loginAdmin.php");
}
 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="shortcut icon" href="../../images/logorai_square.png">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- bootstrap css -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../../style/style_extra.css">
    <!-- my css -->
    <link rel="stylesheet" href="../../style/style.css">
    <title>Tambah Data</title>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm fixed-top">
        <div class="container">
            <a class="navbar-brand fs-5 d-flex justify-content-center align-items-center gap-3" href="#">
                <img src="../../images/logorai_compact.png" alt="" height="25" class="d-inline-block align-text-top">
                <b>Admin Tiket Kereta</b>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="halamanAdmin.php"><button type="button"
                                class="btn btn-secondary">List Data</button></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="form.php"><button type="button"
                                class="btn btn-light">Tambah Data</button></a>
                    </li>
                    <li class="nav-item">
                        <a href="../../script/logout.php" class="nav-link"><button type="button" class="btn btn-danger">Logout</button></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- akhir navbar -->

<br><br><br>

            <section class="text-center">
            <img src="../../images/logorai_compact.png" width="200">
        <h1 class="text-center text-solid"><b><u> INPUT DATA KERETA</u></b></h1><br>
</section>
        <section id="form">
            <div class="container">
                <div class="row text-center">
                    <div class="col">
                    </div>
                </div>
                <div class="row row-cols-1 row-cols-md-1 g-4 row justify-content-center fs-5">
                    <div class="col-mb-4 mb-3">
                        <div class="">
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <strong><label for="name">Nama Kereta</label></strong>
                        <input type="text" name="name"class="form-control" id="name">
                    </div>
                    <div class="form-group">
                        <strong><label for="start">Stasiun Awal</label></strong>
                        <select name="start" class="form-select mb-2" type="option" id="start">
                                <?php
                                include "../../database/config.php";
                                $query = mysqli_query($conn,"SELECT * FROM station") or die(mysqli_error($conn));
                                while($data=mysqli_fetch_array($query)){
                                    echo"<option value=$data[name]>$data[name]</option>";}
                                ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <strong><label for="finish">Stasiun Tujuan</label></strong>
                        <select name="finish" class="form-select mb-2" type="option" id="finish">
                                <?php
                                include "../../database/config.php";
                                $query = mysqli_query($conn,"SELECT * FROM station") or die(mysqli_error($conn));
                                while($data=mysqli_fetch_array($query)){
                                    echo"<option value=$data[name]>$data[name]</option>";}
                                ?>
                        </select>
                    </div>
                    <div class="form-group" >
                        <strong><label for="wagon">Gerbong</label></strong>
                        <input type="text" name="wagon"class="form-control" id="wagon">
                    </div>
                    <div class="form-group" >
                        <strong><label for="wagon_capacity">Kapasitas Gerbong</label></strong>
                        <input type="text" name="wagon_capacity"class="form-control" id="wagon_capacity">
                    </div>
                    <div class="form-group" >
                        <strong><label for="km_cost">Harga KM</label></strong>
                        <input type="text" name="km_cost"class="form-control" id="km_cost">
                    </div>
                    <div class="form-group" >
                        <strong><label for="start_time">Waktu Berangkat</label></strong>
                        <input type="time" name="start_time"class="form-control" id="start_time">
                    </div>
                    <div class="form-group">
                    <strong><label for="picture">Gambar Kereta</label></strong><br>
                        <input type="file" name="picture" value="picture" class="form-control">
                    </div>
               <hr>
                    <div class="form-group">
                            <input type="Submit" value="Submit" name="proses" class="btn btn-primary w-100">
                    </div>
               </form>
               <hr>
                            </div>
                            </div>
                            </div>
                            </div>
                            </div>
                            </div>
                            </div>
                            </div>
               




    <br><br><br>

            <section class="text-center">
            <img src="../../images/logorai_compact.png" width="200">
        <h1 class="text-center text-solid"><b><u> INPUT DATA STASIUN</u></b></h1><br>
</section>
        <section id="form">
            <div class="container">
                <div class="row text-center">
                    <div class="col">
                    </div>
                </div>
                <div class="row row-cols-1 row-cols-md-1 g-4 row justify-content-center fs-5">
                    <div class="col-mb-4 mb-3">
                        <div class="">
                <form action="" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                <strong><label for="name">Nama Stasiun</label></strong>
                    <input type="text" name="name"class="form-control" id="name">
               </div>
               <div class="form-group" >
                <strong><label for="km_location">Jarak Lokasi (KM)</label></strong>
                    <input type="text" name="km_location"class="form-control" id="km_location">
               </div>
               <hr>
               <div class="form-group">
                    <input type="Submit" value="Submit" name="proses2" class="btn btn-primary w-100">
                </div>
               </form>
               <hr>
                            </div>
                            </div>
                            </div>
                            </div>
                            </div>
                            </div>
                            </div>
                            </div>
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
        <path fill="#273036" fill-opacity="1"
            d="M0,32L80,64C160,96,320,160,480,160C640,160,800,96,960,74.7C1120,53,1280,75,1360,85.3L1440,96L1440,320L1360,320C1280,320,1120,320,960,320C800,320,640,320,480,320C320,320,160,320,80,320L0,320Z">
        </path>
    </svg>
    <footer class="text-black text-center fw-medium fst-italic" style="background-color: rgba(255, 255, 255, 0.8); backdrop-filter: blur 10px;">
        Karmila Muhammad Izudin Rojak - L200200251
    </footer>
</body>
</html>

<?php
if(isset($_POST['proses'])){
    $name=$_POST['name'];
    $start=$_POST['start'];
    $finish=$_POST['finish'];
    $wagon=$_POST['wagon'];
    $wagon_capacity=$_POST['wagon_capacity'];
    $km_cost=$_POST['km_cost'];
    $start_time=$_POST['start_time'];
    
    $folder = '../../images/kereta/';
    $name_p = $_FILES['picture']['name'];
    $sumber_p = $_FILES['picture']['tmp_name'];
    move_uploaded_file($sumber_p, $folder.$name_p);
    $insert = mysqli_query($conn, "INSERT INTO train VALUES (NULL, '".$name."', '".$start."', '".$finish."', '".$wagon."','".$wagon_capacity."','".$km_cost."','".$start_time."','".$_FILES['picture']['name']."')");
if($insert){
    echo "<script>alert('Data berhasil ditambahkan')</script>";
    echo "<script>location='halamanAdmin.php'</script>";
}else{
    echo "<script>alert('Gagal menambahkan data')</script>";
}
}
?>

<?php
if(isset($_POST['proses2'])){
    
    $insert = mysqli_query($conn, "INSERT INTO station VALUES (NULL,'".$_POST['name']."','".$_POST['km_location']."')");
if($insert){
    echo "<script>alert('Data berhasil ditambahkan')</script>";
    echo "<script>location='halamanAdmin.php'</script>";
}else{
    echo "<script>alert('Gagal menambahkan data')</script>";
}
}
?>

<?php
    error_reporting(0);
?>