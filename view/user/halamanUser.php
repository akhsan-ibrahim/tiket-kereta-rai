<?php
 
session_start();
 
if (isset($_SESSION['role']) && $_SESSION['role']=='admin') {
    header("Location: ../admin/halamanAdmin.php");
} 
if (!isset($_SESSION['role']) OR $_SESSION['role']=='guest' ) {
    header("Location: ../../index.php");
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
    <title>Tiket Kereta</title>
    <!-- css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../../style/style_extra.css">
</head>

<body class="mt-5">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg fixed-top shadow-lg" id="navigation" style="background-color: rgba(255, 255, 255, 0.8); backdrop-filter: blur(10px);">
        <div class="container">
            <a class="navbar-brand fs-5 d-flex justify-content-center align-items-center gap-3" href="#">
                <img src="../../images/logorai_compact.png" alt="" height="25" class="d-inline-block align-text-top">
                <b>Tiket Kereta</b>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
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
                            <a class="nav-link active fw-bold" aria-current="page"href="../../index.php">Beranda</a>
                        </li>
                        <li class="nav-item mx-2">
                            <a class="nav-link" href="inputUser.php">Reservasi</button></a>
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
                </ul>
            </div>
        </div>
    </nav>
    <!-- akhir navbar -->

    <!-- jumbotron -->
    <br>
    <section class="jumbotron text-center mt-10">
      <img src="../../images/logorai_compact.png" width="200" >
      <h1 class="text-center text-warning">E-Tiket Kereta</h1>
      <h1 class="text-center text-warning">“RAI”</h1>
      <p class="text-center text-white">Platform pemesanan tiket online kereta “E-Tiket Kereta".</p>
      <p class="text-center text-white">Reservasi Mudah, Tanpa Berebut.</p>
      <a class="nav-link" href="inputUser.php"><button type="button" class="btn btn-warning">Reservasi Langsung!</button></a>
    </section>
    <!-- akhir jumbotron -->


    <!-- jadwal -->
    <section id="jadwal"><br><br><br> <!--edit -->
        <div class="container">
            <div class="row text-center">
                <h2>Jadwal dan Rute Perjalanan</h2>
                <table class="table table-dark table-sm table table-bordered border-light" width="90%">
                    <thead>
                        <tr>
                            <th class="text-center" scope="col">No</th>
                            <th class="text-center" scope="col" >Nama</th>
                            <th class="text-center" scope="col">Stasiun Awal</th>
                            <th class="text-center" scope="col">Tujuan</th>
                            <th class="text-center" scope="col">Gerbong</th>
                            <th class="text-center" scope="col">Kapasitas Gerbong</th>
                            <th class="text-center" scope="col">Biaya KM</th>
                            <th class="text-center" scope="col">Waktu Berangkat</th>         
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        error_reporting(0);
                        include "../../database/config.php";
                        $no = 1;
                        $data = mysqli_query($conn, "select * from train") or die (mysqli_error($conn));
                        while ($d = mysqli_fetch_array($data)) {
                        ?>
                            <tr>
                            <td><?php echo $no++; ?></td>
                                <td align="center" class="border bg-sky-200 font-semibold"><?php echo $d['name']; ?></td>
                                <td align="center" class="border bg-sky-200 font-semibold"><?php echo $d['start']; ?></td>
                                <td align="center" class="border bg-sky-200 font-semibold"><?php echo $d['finish']; ?></td>
                                <td align="center" class="border bg-sky-200 font-semibold"><?php echo $d['wagon']; ?></td>
                                <td align="center" class="border bg-sky-200 font-semibold"><?php echo $d['wagon_capacity']; ?></td>
                                <td align="center" class="border bg-sky-200 font-semibold"><?php echo $d['km_cost']; ?></td>
                                <td align="center" class="border bg-sky-200 font-semibold"><?php echo $d['start_time']; ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                </table>
            </div>
    </section>
    <!-- akhir jadwal -->

    <!-- about -->
    <section id="about">
        <div class="container">
            <div class="row text-center">
                <h2>About</h2>
                <p>RAI merupakan salah satu fasilitas Pemesanan tiket online Kereta Api.
                    Selain mudah digunakan, RAI juga tentu saja terjamin keaslianya.
                    Jadi tunggu apalagi...yuk pesen tiket sekarang!!!!!!!
                </p>
            </div>
    </section>
    <!-- akhir about -->

    <!-- footer -->
    <footer class="bg-primary text-white text-center pb-2">
    <p><span class="text-white fw-bold">Kelompok 5</span> - Ilham Rian Novanto L200200247</p>
    </footer>
    <!-- akhir footer -->
</body>
</html>