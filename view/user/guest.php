<?php
    session_start();

    if (isset($_SESSION['role'])) {
        if ($_SESSION['role']=='admin') {
            header("Location: ../admin/halamanAdmin.php");
        } elseif ($_SESSION['role']=='customer') {
            header("Location: halamanUser.php");
        } else {
            header("Location: inputUser.php");
        }
    }

    include "../../database/config.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="shortcut icon" href="../../images/logorai_square.png">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Identitas Tamu</title>
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
                            <a class="nav-link" href="../../index.php">Beranda</a>
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

                    <a href="" class="nav-link d-flex justify-content-center align-items-center gap-3 fw-medium">
                        <svg xmlns="http://www.w3.org/2000/svg" width="28" fill="#2D2A70" class="bi bi-person-circle" viewBox="0 0 16 16">
                            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                            <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                        </svg>
                        Tamu
                        <!-- <?php echo "$username"; ?> -->
                    </a>
                </div>
            </div>
        </div>
    </nav>
    <!-- akhir navbar -->

    <main class="container d-flex flex-column ">
        <div class="card shadow-lg mt-3">
            <div class="card-header d-flex justify-content-between align-items-center flex-wrap">
                <h5 class="card-title fs-4 me-5">Masukkan identitas Anda</h5>
            </div>

            <div class="card-body row g-0">
                <div class=" mb-3 g-1">
                    <form action="../../script/processGeneralForm.php" method="post">
                        <div class="mb-3">
                            <label for="username" class="form-label mb-1">Nama Lengkap</label>
                            <input type="text" class="form-control mt-0 fw-medium" name="username" id="username" required>
                        </div>
        
                        <div class="mb-3">
                            <label for="email" class="form-label mb-1">Surel</label>
                            <input type="text" class="form-control mt-0 fw-medium" name="email" id="email" required>
                        </div>
        
                        <div class="mb-3">
                            <label for="contact" class="form-label mb-1">Kontak</label>
                            <input type="text" class="form-control mt-0 fw-medium" name="contact" id="contact" required>
                        </div>
                        
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary" name="guestName">Reservasi</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </main>

    <footer class="text-black text-center fw-medium fst-italic" style="background-color: rgba(255, 255, 255, 0.8); backdrop-filter: blur 10px;">
        Akhsan Ibrahim - L200200253
    </footer>
</body>
</html>