<?php
    session_start();
    if (isset($_SESSION['role']) && $_SESSION['role']=='admin') {
        header("Location: ../admin/halamanAdmin.php");
    } 
    if (!isset($_SESSION['role']) OR $_SESSION['role']=='guest') {
        echo "<script>alert('Silakan login terlebih dahulu');window.location.href='loginUser.php'</script>";
    }

    $_SESSION['transaction_state'] = "success";

    include "../../script/functions.php";
    include "../../database/config.php";
    $user_id = $_SESSION['id'];
    $username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="shortcut icon" href="../../images/logorai_square.png">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Transaksi</title>
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
                            <a class="nav-link" href="inputUser.php">Reservasi</a>
                        </li>
                        <li class="nav-item mx-2">
                            <a class="nav-link" href="route.php">Rute</a>
                        </li>
                        <li class="nav-item mx-2">
                            <a class="nav-link active fw-bold" aria-current="page" href="">Riwayat</a>
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

    <main class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Riwayat Transaksi Anda</h5>
            </div>
            <div class="card-body" style="max-height: 450px; overflow-y: auto;">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover">
                        <caption>Ket. G/B (Gerbong/Bangku)</caption>
                        <thead class="text-center sticky-top">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Transaksi</th>
                                <th scope="col">Kereta</th>
                                <th scope="col">Berangkat</th>
                                <th scope="col">Tiba</th>
                                <th scope="col">G/B</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Bayar</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Cetak</th>
                            </tr>
                        </thead>
                        <tbody>

<?php
    $queryProfil = mysqli_query($conn, "SELECT * FROM transaction WHERE user_id = '$user_id'");
    $no = 1;
    while($rowProfil = mysqli_fetch_array($queryProfil)){
?>

                            <tr>
                                <th scope="row" class="text-center"><?php echo $no ?></th>
                                <td><?php echo $rowProfil['transaction_date'] ?></td>
                                <td><?php echo $rowProfil['train'] ?></td>
                                <td><?php echo $rowProfil['origin'].' - '.substr($rowProfil['departure'], 0, 5) ?></td>
                                <td><?php echo $rowProfil['destination'].' - '.substr($rowProfil['arrive'], 0, 5) ?></td>
                                <td class="text-center"><?php echo $rowProfil['wagon'].'/'.$rowProfil['seat'] ?></td>
                                <td><?php echo 'Rp'.number_format($rowProfil['price'], 2, ',', '.') ?></td>
                                <td><?php echo $rowProfil['payment'] ?></td>
                                <td><?php echo tanggal_indonesia($rowProfil['ticket_date']) ?></td>
                                <td>
                                    <a href="printTicket.php?id=<?php echo $rowProfil['id'] ?>" class="btn btn-outline-primary btn-sm m-1 d-flex align-items-center" tabindex="-1" role="button" aria-disabled="true">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer-fill" viewBox="0 0 16 16">
                                            <path d="M5 1a2 2 0 0 0-2 2v1h10V3a2 2 0 0 0-2-2H5zm6 8H5a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1z"/>
                                            <path d="M0 7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-1v-2a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v2H2a2 2 0 0 1-2-2V7zm2.5 1a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"/>
                                        </svg>
                                    </a>
                                </td>
                            </tr>

<?php
        $no++;
    }
?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <footer class="text-black text-center fw-medium fst-italic" style="background-color: rgba(255, 255, 255, 0.8); backdrop-filter: blur 10px;">
        Akhsan Ibrahim - L200200253
    </footer>
</body>
</html>