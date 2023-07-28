<?php 
    session_start();
    if (isset($_SESSION['role']) && $_SESSION['role']=='admin') {
        header("Location: ../admin/halamanAdmin.php");
    } 
    if (!isset($_SESSION['role'])) {
        header("Location: guest.php");
    }

    include "../../database/config.php";
    $username = $_SESSION['username'];

    date_default_timezone_set('Asia/Jakarta');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="shortcut icon" href="../../images/logorai_square.png">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Reservasi</title>
    <!-- css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../../style/style_extra.css">
    
</head>

<body class="isi pt-5">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg fixed-top shadow-lg" id="navigation" style="background-color: rgba(255, 255, 255, 0.8); backdrop-filter: blur 10px;">
        <div class="container">
            <a class="navbar-brand fs-5 d-flex justify-content-center align-items-center gap-3" href="#">
                <img src="../../images/logorai_compact.png" alt="" height="25" class="d-inline-block align-text-top">
                <b>Tiket Kereta</b>
            </a>

            <button class="navbar-toggler shadow-none border-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>

            <div class="sidebar offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-center flex-grow-1 pe-3">
                        <li class="nav-item mx-2">
                            <a class="nav-link" href="halamanUser.php">Beranda</a>
                        </li>
                        <li class="nav-item mx-2">
                            <a class="nav-link active fw-bold" aria-current="page" href="">Reservasi</a>
                        </li>
                        <li class="nav-item mx-2">
                            <a class="nav-link" href="route.php">Rute</a>
                        </li>
                        <li class="nav-item mx-2">
                            <a class="nav-link" href="history.php">Riwayat</a>
                        </li>
                    </ul>

                    <a href="profilUser.php" class="nav-link d-flex justify-content-center align-items-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="28" fill="#2D2A70" class="bi bi-person-circle" viewBox="0 0 16 16">
                            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                            <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                        </svg>
                        <div class="fw-medium">
                            <?php echo "$username"; ?>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </nav>
    <!-- akhir navbar -->

    <main class="container d-flex flex-column">
        <div class="card shadow-lg" >
            <div class="card-header">
                <h5 class="card-title fs-4">Mau ke mana nih?</h5>
            </div>
            <div class="card-body">
                <form class="row g-3" action="inputUser.php" method="post" enctype="multipart/form-data" id="form1">

                    <div class="col-md-6">
                        <label for="origin" class="form-label">Asal</label>
                        <input class="form-control" name="origin" list="dataOrigin" id="origin" value="<?php echo (isset($_POST['origin']) ? $_POST['origin'] : '')?>" placeholder="Cari kota asal..." required>
                        <datalist id="dataOrigin">
                            <?php                    
                            $queryStation = mysqli_query($conn,"SELECT * FROM station");
                            while($dataStation = mysqli_fetch_array($queryStation)){
                                echo "<option value=$dataStation[name]>$dataStation[name]</option>";}
                            ?>
                        </datalist>
                    </div>
                    
                    <div class="col-md-6">
                        <label for="destination" class="form-label">Tujuan</label>
                        <input class="form-control" name="destination" list="dataDestination" id="origin" value="<?php echo (isset($_POST['destination']) ? $_POST['destination'] : '')?>" placeholder="Cari kota tujuan..." required>
                        <datalist id="dataDestination">
                            <?php
                            $queryStation = mysqli_query($conn,"SELECT * FROM station");
                            while($dataStation = mysqli_fetch_array($queryStation)){
                                echo"<option value=$dataStation[name]>$dataStation[name]</option>";}
                            ?>
                        </datalist>
                    </div>
                    
                    <div class="col-md-6">
                        <label for="date" class="form-label">Tanggal</label>
                        <input type="date" class="form-control" name="date" id="date" value="<?php echo (isset($_POST['date']) ? $_POST['date'] : '')?>" pattern="d-m-Y"  min="<?php echo date('Y-m-d', strtotime('+1 day')); ?>" required>
                    </div>
                    
                    <div class="col-md-6 mt-5 d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary" name="train">Cari Kereta</button>
                    </div>

                </form>
            </div>
            
            <?php
            if (isset($_POST['train'])) {
                $origin = $_POST['origin'];
                $destination = $_POST['destination'];
                $dateTicket = $_POST['date'];

                if ($origin == $destination) {
                    echo "<script>alert('Anda memasukkan kota asal dan kota tujuan yang sama');window.location.href='inputUser.php'</script>";
                }
                
                $queryTrain = "SELECT t.name AS train_name, t.km_cost AS train_km_price, t.start_time AS train_start_time, s1.name AS origin, s1.km_location AS origin_loc, s2.name AS destination, s2.km_location AS destination_loc
                FROM train t
                JOIN train_stations ts1 ON t.id = ts1.train_id
                JOIN train_stations ts2 ON t.id = ts2.train_id
                JOIN station s1 ON ts1.station_id = s1.id
                JOIN station s2 ON ts2.station_id = s2.id
                WHERE s1.name = '$origin' AND s2.name = '$destination'";
                $findTrain = mysqli_query($conn, $queryTrain);

                if (!$findTrain->num_rows > 0) {
                    echo "<script>alert('Rute tidak tersedia, Anda bisa cek rute yang tersedia di menu Rute');window.location.href='loginUser.php'</script>";
                }
            ?>

            <div class="card-header">
                <h5 class="card-title fs-4">Pilih kereta</h5>
            </div>

            <?php
                while ($dataTrain = mysqli_fetch_row($findTrain)) {
                    #Menentukan waktu berangkat dan waktu tiba
                    $time_start = '';
                    $time_finish = '';
                    if ($dataTrain[4]<$dataTrain[6]) {
                        // Waktu berangkat
                        $ts = new DateTime("$dataTrain[2]");
                        $duration_ts = $dataTrain[4]/2;
                        $ts->add(new DateInterval('PT' . round($duration_ts) . 'M'));
                        $time_start = $ts->format('H:i');
                        // Waktu tiba
                        $tf = new DateTime("$dataTrain[2]");
                        $duration_tf = $dataTrain[6]/2;
                        $tf->add(new DateInterval('PT' . round($duration_tf) . 'M'));
                        $time_finish = $tf->format('H:i');
                    } elseif ($dataTrain[4]>$dataTrain[6]) {
                        //Ambil jarak stasiun terjauh (query MAX table train_station kolom km_loc) + jarak km terjauh ke km stasiun
                        $queryMax = "SELECT MAX(s2.km_location) AS max_km_location
                        FROM train t
                        JOIN train_stations ts1 ON t.id = ts1.train_id
                        JOIN train_stations ts2 ON t.id = ts2.train_id
                        JOIN station s1 ON ts1.station_id = s1.id
                        JOIN station s2 ON ts2.station_id = s2.id";
                        $resultMax = mysqli_query($conn, $queryMax);
                        $rowMax = mysqli_fetch_assoc($resultMax);
                        $max_km = intval($rowMax['max_km_location']);
                        // Waktu berangkat
                        $ts = new DateTime("$dataTrain[2]");
                        $duration_ts = ($max_km + ($max_km - $dataTrain[4]))/2;
                        $ts->add(new DateInterval('PT' . $duration_ts . 'M'));
                        $time_start = $ts->format('H:i');
                        // Waktu tiba
                        $tf = new DateTime("$dataTrain[2]");
                        $duration_tf = ($max_km + ($max_km - $dataTrain[6]))/2;
                        $tf->add(new DateInterval('PT' . $duration_tf . 'M'));
                        $time_finish = $tf->format('H:i');
                    }
                    #Menentukan tarif
                    $price = $dataTrain[1]*abs($dataTrain[4]-$dataTrain[6]);
            ?>
            
            <div class="card shadow-sm m-3 border-primary">            
                <div class="card-body">
                    <form class="row g-0" action="../../script/processGeneralForm.php" method="post" enctype="multipart/form-data">

                        <div class="col-md">
                            <div class="form-floating">
                                <input type="text" readonly class="form-control-plaintext" id="train" value="<?php echo $dataTrain[0]; ?>">
                                <label for="train" class="fst-italic">Kereta</label>
                                <input type='hidden' name='train' value="<?php echo $dataTrain[0]; ?>">
                            </div>
                        </div>

                        <div class="col-md">
                            <div class="form-floating">
                                <input type="text" readonly class="form-control-plaintext" id="price" value="<?php echo 'Rp'.number_format($price, 2, ',', '.') ?>">
                                <label for="price" class="fst-italic">Harga</label>
                                <input type='hidden' name='price' value="<?php echo $price; ?>">
                            </div>
                        </div>

                        <div class="col-md">
                            <div class="form-floating">
                                <input type="text" readonly class="form-control-plaintext" id="departure" value="<?php echo $time_start.' WIB' ?>">
                                <label for="departure" class="fst-italic"><?php echo "Dari ".$dataTrain[3]; ?></label>
                                <input type='hidden' name='origin' value="<?php echo $dataTrain[3]; ?>">
                                <input type='hidden' name='departure' value="<?php echo $time_start; ?>">
                            </div>
                        </div>

                        <div class="col-md">
                            <div class="form-floating">
                                <input type="text" readonly class="form-control-plaintext" id="arrive" value="<?php echo $time_finish.' WIB' ?>">
                                <label for="arrive" class="fst-italic"><?php echo "Sampai ".$dataTrain[5]; ?></label>
                                <input type='hidden' name='arrive' value="<?php echo $time_finish; ?>">
                                <input type='hidden' name='destination' value="<?php echo $dataTrain[5]; ?>">
                            </div>
                        </div>
                        
                        <div class="col-md d-flex justify-content-center align-items-center">
                            <input type='hidden' name='date_ticket' value="<?php echo $dateTicket; ?>">
                            <button type="submit" class="btn btn-primary" name="general_form">Pilih</button>
                        </div>

                    </form>
                </div>
            </div>

<?php
                    }
                }

    if ($_SESSION['role']=='guest' ) {
?>

    <div class="card-footer text-body-secondary d-flex justify-content-center">
        <form action="../../script/processGeneralForm.php" method="post">
            <button type="submit" class="btn btn-danger" name="cancelReservation">Batalkan Reservasi</button>        
        </form>
    </div>

<?php
    }
?>

        </div> 
    </main>
    
    <footer class="text-black text-center fw-medium fst-italic" style="background-color: rgba(255, 255, 255, 0.8); backdrop-filter: blur 10px;">
        Akhsan Ibrahim - L200200253
    </footer>
</body>
</html>