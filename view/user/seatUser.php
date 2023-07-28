<?php 
    session_start();  
    if (isset($_SESSION['role']) && $_SESSION['role']=='admin') {
        header("Location: ../admin/halamanAdmin.php");
    } 
    if (!isset($_SESSION['role'])) {
        header("Location: guest.php");
    }
    if ($_SESSION['transaction_state'] != "trip_fill") {
        // Jika pemesanan belum selesai, alihkan pengguna ke halaman beranda atau halaman sebelumnya
        header("Location: inputUser.php");
        exit;
    }


    $train = $_SESSION["train"];
    $origin = $_SESSION["origin"];
    $departure = $_SESSION["departure"];
    $arrive = $_SESSION["arrive"];
    $destination = $_SESSION["destination"];
    $price = $_SESSION["price"];
    $date_ticket = $_SESSION["date_ticket"];
    $selected_wagon = $_SESSION["selected_wagon"];
    $selected_seat = $_SESSION["selected_seat"];

    $username = $_SESSION['username'];
    $user_id = $_SESSION['id'];

    include "../../database/config.php";
    include "../../script/functions.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="shortcut icon" href="../../images/logorai_square.png">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cari Bangku</title>
    <!-- css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../../style/style_extra.css">
</head>
<body>
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
        <div class="card shadow-lg m-3">
            <div class="card-header d-flex justify-content-between align-items-center flex-wrap">
                <a href="inputUser.php" class="btn btn-outline-primary m-1 d-flex align-items-center" tabindex="-1" role="button" aria-disabled="true">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" fill="currentColor" class="bi bi-chevron-left me-1" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/>
                    </svg>
                    Kembali
                </a>
                <h5 class="card-title fs-4 m-1"><?php echo "Perjalananmu di hari ". tanggal_indonesia($date_ticket) ?></h5>
            </div>

            <div class="card-body row g-0">

                <div class="col-md">
                    <div class="form-floating">
                        <input type="text" readonly class="form-control-plaintext" id="train" value="<?php echo $train; ?>">
                        <label for="train" class="fst-italic">Kereta</label>
                    </div>
                </div>

                <div class="col-md">
                    <div class="form-floating">
                        <input type="text" readonly class="form-control-plaintext" id="price" value="<?php echo 'Rp'.number_format($price, 2, ',', '.') ?>">
                        <label for="price" class="fst-italic">Harga</label>
                    </div>
                </div>

                <div class="col-md">
                    <div class="form-floating">
                        <input type="text" readonly class="form-control-plaintext" id="departure" value="<?php echo $departure.' WIB' ?>">
                        <label for="departure" class="fst-italic"><?php echo "Dari ".$origin; ?></label>
                    </div>
                </div>

                <div class="col-md">
                    <div class="form-floating">
                        <input type="text" readonly class="form-control-plaintext" id="arrive" value="<?php echo $arrive.' WIB' ?>">
                        <label for="arrive" class="fst-italic"><?php echo "Sampai ".$destination; ?></label>
                    </div>
                </div>
            </div>

            <div class="card-header ">
                <h5 class="card-title fs-4"><?php echo "Mau duduk di sebelah mana?" ?></h5>
            </div>

            <div class="card-body row g-3">
                <?php
                    $queryWagon = "SELECT * FROM train";
                    $resultWagon = mysqli_query($conn,$queryWagon);
                    $rowWagon = mysqli_fetch_array($resultWagon);
                    $wagon = intval($rowWagon['wagon']);
                    $wagonCap = intval($rowWagon['wagon_capacity']);
                ?>        
                
                <form class="col-md-6 g-3" action="seatUser.php" method="post">
                    <div class="col-md">
                        <label for="wagon" class="form-label">Gerbong</label>
                        <select name="wagon" id="wagon" class="form-select" aria-label="Default select example">
                            <?php
                            $w = 0;
                            while ($w <= $wagon) {
                                if (isset($_POST['wagon']) && $_POST['wagon'] == $w) {
                                    echo "<option value=$w selected>$w</option>";
                                }
                                elseif ($w==0) {
                                    echo "<option value=$w>Pilih gerbong</option>";
                                } else {
                                    echo "<option value=$w>$w</option>";
                                }      
                                $w++;
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-md d-flex justify-content-center align-items-center  mt-3">
                        <button type="submit" class="btn btn-primary" name="wagon_form">Cari Bangku</button>
                    </div>                        
                </form>                

                <?php
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    if (isset($_POST['wagon_form'])) {
                        $_SESSION['selected_wagon'] = $_POST['wagon'];
                        $selected_wagon = $_SESSION['selected_wagon'];
                        if ($selected_wagon>0) {
                            // echo "You choose wagon ".$selected_wagon;
                ?>

                <form class="col-md-6 g-3" action="../../script/processGeneralForm.php" method="post">
                    <div class="col-md">
                        <label for="seat" class="form-label">Bangku</label>
                        <select name="seat" id="seat" class="form-select" aria-label="Default select example">
                            <?php
                            $s = 0;
                            while ($s <= $wagonCap) {
                                $querySeats = mysqli_query($conn,"SELECT * FROM transaction WHERE 
                                train = '$train' AND ticket_date = '$date_ticket' AND wagon = $selected_wagon AND seat = '$s'");
                                if ($s==0) {
                                    echo "<option value=$s>Pilih bangku di gerbong $selected_wagon</option>";
                                } else {
                                    if (mysqli_num_rows($querySeats) > 0) {
                                        echo "<option value=$s disabled>$s (sudah terisi)</option>";
                                    } else {
                                        echo "<option value=$s>$s</option>";
                                    }
                                }                                
                                $s++;
                            }
                            ?>
                        </select>
                    </div>    
                    <div class="col-md d-flex justify-content-center align-items-center mt-3">
                        <button type="submit" class="btn btn-primary" name="seat_form">Lanjut Bayar</button>
                    </div>
                </form>

                <?php
                        }
                    }
                }        
                ?>    

            </div>

<?php
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