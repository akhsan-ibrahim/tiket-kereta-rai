<?php
    session_start();
    if (isset($_SESSION['role']) && $_SESSION['role']=='admin') {
        header("Location: ../admin/halamanAdmin.php");
    } 
    if (!isset($_SESSION['role']) OR $_SESSION['role']=='guest') {
        echo "<script>alert('Silakan login terlebih dahulu');window.location.href='loginUser.php'</script>";
    }


    include "../../database/config.php";
    $user_id = $_SESSION['id'];
    $username = $_SESSION['username'];

    $queryProfil = mysqli_query($conn, "SELECT * FROM user WHERE id = '$user_id'");
    $rowProfil = mysqli_fetch_array($queryProfil);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="shortcut icon" href="../../images/logorai_square.png">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil <?php echo $rowProfil['username']; ?></title>
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
                            <a class="nav-link" href="history.php">Riwayat</a>
                        </li>
                    </ul>

                    <a href="profilUser.php" class="nav-link d-flex justify-content-center align-items-center gap-3 active fw-bold" aria-current="page">
                        <svg xmlns="http://www.w3.org/2000/svg" width="28" fill="#2D2A70" class="bi bi-person-circle" viewBox="0 0 16 16">
                            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                            <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                        </svg>
                        <?php echo "$username"; ?>
                    </a>
                </div>
            </div>
        </div>
    </nav>
    <!-- akhir navbar -->

    <main class="container d-flex flex-column ">
        <div class="card shadow-lg mt-3">
            <div class="card-header d-flex justify-content-between align-items-center flex-wrap">
                <h5 class="card-title fs-4 me-5">Profil Anda</h5>
                <a class="btn btn-danger ms-5" href="../../script/logout.php" role="button">Logout</a>
            </div>

            <div class="card-body row g-0">
                <div class=" mb-3 g-1">
                    <div class="mb-3">
                        <label for="username" class="form-label mb-1">Nama Pengguna</label>
                        <input type="text" readonly class="form-control mt-0 fw-medium" id="username" value="<?php echo $rowProfil['username']?>">
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label mb-1">Surel</label>
                        <input type="text" readonly class="form-control mt-0 fw-medium" id="email" value="<?php echo $rowProfil['email']?>">
                    </div>

                    <div class="mb-3">
                        <label for="contact" class="form-label mb-1">Kontak</label>
                        <input type="text" readonly class="form-control mt-0 fw-medium" id="contact" value="<?php echo $rowProfil['contact']?>">
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label mb-1">Kata Sandi</label>
                        <input type="text" readonly class="form-control mt-0 fw-medium" id="password" value="<?php echo $rowProfil['password']?>">
                    </div>

                    <div class="">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editProfil">Ubah data profil</button>
                    </div>
                </div>
            </div>

        </div>
    </main>
    
    <!-- Modal -->
    <div class="modal fade" id="editProfil" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Ubah data profil</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="profilUser.php" method="post">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="username" class="form-label mb-1">Nama Pengguna</label>
                        <input type="text" class="form-control mt-0 fw-medium" name="username" id="username" value="<?php echo $rowProfil['username']?>">
                    </div>
    
                    <div class="mb-3">
                        <label for="email" class="form-label mb-1">Surel</label>
                        <input type="text" class="form-control mt-0 fw-medium" name="email" id="email" value="<?php echo $rowProfil['email']?>">
                    </div>
    
                    <div class="mb-3">
                        <label for="contact" class="form-label mb-1">Kontak</label>
                        <input type="text" class="form-control mt-0 fw-medium" name="contact" id="contact" value="<?php echo $rowProfil['contact']?>">
                    </div>
    
                    <div class="mb-3">
                        <label for="password" class="form-label mb-1">Kata Sandi</label>
                        <input type="text" class="form-control mt-0 fw-medium" name="password" id="password" value="<?php echo $rowProfil['password']?>">
                    </div>
                </div>
                
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" name="editProfil">Ubah</button>
                </div>
            </form>
        </div>
    </div>
    </div>
    
<?php
    if (isset($_POST['editProfil'])){
        $user_id = $_SESSION['id'];
        $username = $_POST['username'];
        $contact = $_POST['contact'];
        $email = $_POST['email'];
        $password = $_POST['password']; 

        $_SESSION['username'] = $username;

        $query = "UPDATE user SET username = '$username', email = '$email',  contact = '$contact', 
        password = '$password' WHERE id = '$user_id'";

        if (mysqli_query($conn, $query))
        {
            echo "<script>alert('Data berhasil diubah'); window.location.href='profilUser.php'</script>";
        }
        else
        {
            die("Data gagal diubah; ".mysqli_errno($conn).mysqli_error($conn));
        }
    }
?>

    <footer class="text-black text-center fw-medium fst-italic" style="background-color: rgba(255, 255, 255, 0.8); backdrop-filter: blur 10px;">
        Akhsan Ibrahim - L200200253
    </footer>
</body>
</html>