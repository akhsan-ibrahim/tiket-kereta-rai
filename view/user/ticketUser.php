<?php 
    session_start();  
    if (isset($_SESSION['role']) && $_SESSION['role']=='admin') {
        header("Location: ../admin/halamanAdmin.php");
    } 
    if (!isset($_SESSION['role'])) {
        session_destroy();
        header("Location: ../../index.php");
    }
    if ($_SESSION['transaction_state'] != "payment_fill") {
        // Jika pemesanan belum selesai, alihkan pengguna ke halaman beranda atau halaman sebelumnya
        header("Location: payment.php");
        exit;
    }

    include "../../database/config.php";
    include "../../script/functions.php";

    $transaction_id = $_SESSION['transaction_id'];
    $train = $_SESSION["train"];
    $origin = $_SESSION["origin"];
    $departure = $_SESSION["departure"];
    $arrive = $_SESSION["arrive"];
    $destination = $_SESSION["destination"];
    $price = $_SESSION["price"];
    $date_ticket = $_SESSION["date_ticket"];
    $selected_wagon = $_SESSION["selected_wagon"];
    $selected_seat = $_SESSION["selected_seat"];
    $payment = $_SESSION["payment"];

    $user_name = $_SESSION['username'];
    $user_id = $_SESSION['id'];

    $queryUser = mysqli_query($conn,"SELECT * FROM user WHERE id = '$user_id'");
    $rowUser = mysqli_fetch_array($queryUser);
    $email = $rowUser['email'];
    $phone = $rowUser['contact'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="shortcut icon" href="../../images/logorai_square.png">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran Berhasil</title>
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
                            <?php echo "$user_name"; ?>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </nav>
    <!-- akhir navbar -->

    <main class="container mt-3 d-flex flex-column">
        <div class="card shadow-lg m-3" style=" width: 60%;">
            <div class="card-header d-flex justify-content-between align-items-center flex-wrap">
                <h5 class="card-title fs-4 m-1">Pembayaran berhasil</h5>
                <a href="inputUser.php" class="btn btn-outline-primary m-1 d-flex align-items-center" tabindex="-1" role="button" aria-disabled="true">                    
                    Reservasi Lagi
                </a>
            </div>

            <div class="card-body d-flex flex-column  mb-0">
                <div class="d-flex flex-wrap mb-0">
                    <div class="me-auto mb-3 me-3">
                        <h6 class="card-subtitle mb-1 text-body-secondary fst-italic">Penumpang</h6>
                        <h5 class="card-title mb-0"><?php echo 'Sdr. '.$user_name ?></h5>
                    </div>

                    <div class="mb-3 me-3">
                        <h6 class="card-subtitle mb-1 text-body-secondary fst-italic">Kereta</h6>
                        <h5 class="card-title mb-0"><?php echo $train ?></h5>
                    </div>

                    <div class="mb-3 me-3">
                        <h6 class="card-subtitle mb-1 text-body-secondary fst-italic">Gerbong-Bangku</h6>
                        <h5 class="card-title mb-0"><?php echo 'G'.$selected_wagon.'-B'.$selected_seat; ?></h5>
                    </div>  
                </div>
                
                <div class="mb-4">
                    <h6 class="card-subtitle text-center text-body-secondary mt-3 mb-2 fst-italic"><?php echo tanggal_indonesia($date_ticket) ?></h6>
                    <div class="d-flex justify-content-center">
                        <div class="d-flex flex-column text-center mx-2">
                            <h5 class="card-title m-0"><?php echo $origin ?></h5>
                            <p class="card-text m-0"><?php echo $departure ?></p>
                        </div>
                        <div class="align-self-center mx-2">
                            <svg xmlns="http://www.w3.org/2000/svg" height="35" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
                            </svg>
                        </div>
                        <div class="d-flex flex-column text-center mx-2">
                            <h5 class="card-title m-0"><?php echo $destination ?></h5>
                            <p class="card-text m-0"><?php echo $arrive ?></p>
                        </div>
                    </div>
                </div>

                <div class="d-flex flex-wrap justify-content-evenly">
                    <div class="align-self-center mb-3 me-0">
                        <h6 class="card-subtitle mb-1 text-body-secondary text-center fst-italic">Harga</h6>
                        <h5 class="card-title mb-0"><?php echo "Rp".number_format($price, 2, ',', '.') ?></h5>
                    </div> 
                    <div class="align-self-center mb-3 me-0">
                        <h6 class="card-subtitle mb-1 text-body-secondary text-center fst-italic">Pembayaran</h6>
                        <h5 class="card-title mb-0"><?php echo $payment ?></h5>
                    </div> 
                </div>
            </div>
            <form class="col-md d-flex justify-content-center align-items-center mt-0 mb-3" action="../../script/processGeneralForm.php" method="post">
                <button type="submit" class="btn btn-primary" name="print_ticket">Cetak Tiket</button>
            </form>
        </div>
    </main>
    <footer class="text-black text-center fw-medium fst-italic" style="background-color: rgba(255, 255, 255, 0.8); backdrop-filter: blur 10px;">
        Akhsan Ibrahim - L200200253
    </footer>
</body>
</html>