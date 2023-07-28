<!DOCTYPE html>
<html lang="en">
<head>
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
    <title>UPDATE</title>
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
<?php
include "../../database/config.php";
$id=$_GET['id'];
$data=mysqli_query($conn,"select * from train where id='$id'");
$d=mysqli_fetch_array($data);
foreach ($data as $item)
?>

<div class="container">
<div class="jumbotron jumbotron-fluid bg-light">
    
      <h1>UPDATE DATA</h1>
          <br>
<div class="col-md-11">

          <form action=""method="POST" enctype="multipart/form-data">
          <div class="form-group">
            <br><br><br><br><br>
                   <label>Nama Kereta</label>
                   <input class="form-control" type="text"name="name"value="<?php echo $d['name'];?>">
            </div>
               <br>
               <div class="form-group">
                   <label for="start">Stasiun Awal</label>
                   <select name="start" class="form-select mb-2" type="option" id="start" value="<?php echo$d['id'];?>">
                   <?php
                                    $datatiket = mysqli_query($conn, "SELECT * FROM station");
                                    $i = 1;
                                    foreach ($datatiket as $list) {
                                    ?>
                                    <option value="<?php echo $list['name']; ?>" 
                                    <?php $isSelected = $list['name'] == $item['name'] ? "selected" : "";
                                        echo $isSelected; ?>>
                                        <?php echo $list['name'] ?></option>
                                    <?php } ?>
                    </select>
               </div>
               <br>
               <div class="form-group">
                   <label for="finish">Stasiun Tujuan</label>
                   <select name="finish" class="form-select mb-2" type="option" id="finish" value="<?php echo$d['id'];?>">
                   <?php
                                    $datatiket = mysqli_query($conn, "SELECT * FROM station");
                                    $i = 1;
                                    foreach ($datatiket as $list) {
                                    ?>
                                    <option value="<?php echo $list['name']; ?>" 
                                    <?php $isSelected = $list['name'] == $item['name'] ? "selected" : "";
                                        echo $isSelected; ?>>
                                        <?php echo $list['name'] ?></option>
                                    <?php } ?>
                    </select>
               </div>
               <div class="form-group">
                   <label>Gerbong</label>
                   <input class="form-control" type="text"name="wagon"value="<?php echo$d['wagon'];?>">
               </div>
               <br>
               <div class="form-group">
                   <label>Kapasitas Gerbong</label>
                   <input class="form-control" type="text"name="wagon_capacity"value="<?php echo$d['wagon_capacity'];?>">
               </div>
               <br>
               <div class="form-group">
                <strong><label>Harga per KM</label></strong>
                    <input class="form-control" type="text"name="km_cost"value="<?php echo$d['km_cost'];?>">
               </div>
               <br>
               <div class="form-group">
                <strong><label>Waktu Berangkat</label></strong>
                    <input class="form-control" type="time"name="start_time"value="<?php echo$d['start_time'];?>">
               </div>
               <div class="form-group">
               <label for="picture">Gambar Kereta</label>
                    <input type="file" name="picture" class="form-control" value="<?php echo$d['picture'];?>" selected="../../images/kereta/<?php echo $d['picture'];?>">
                    <p align="right" class="text-info"><i class="text-dark">gambar saat ini : </i><?php echo$d['picture'];?></p>
                    <p align="right"><img style="width: 180px;" class="mb-3 rounded " src="../../images/kereta/<?php echo $d['picture'];?>"/></p>
                </div>
               <hr>
               <input type="Submit" value="Submit" name="proses" class="btn btn-primary w-100">
          </form>
          </div>
                                    
                                    </div>
                                    </div>
                                    </div>
                                    </div>
                                    </div>
          <br><br>


    <?php
        include"../../database/config.php";
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

        echo "data sudah update";

        mysqli_query($conn, "UPDATE train SET name = '$name', start = '$start', finish = '$finish', wagon ='$wagon', wagon_capacity = '$wagon_capacity', km_cost = '$km_cost', start_time = '$start_time', picture = '$name_p' WHERE `train`.id= '$id';") or die(mysqli_error($conn));
        echo "<meta http-equiv=refresh content=0;URL='halamanAdmin.php'>";
        }
    ?>
      </div>
</body>
</html>