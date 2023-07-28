<?php
    session_start();
    if (isset($_SESSION['role']) && $_SESSION['role']=='admin') {
        header("Location: ../admin/halamanAdmin.php");
    } 
    if (!isset($_SESSION['role']) OR $_SESSION['role']=='guest') {
        if (!isset($_SESSION['username'])) {
            $_SESSION['id'] = '';
            $_SESSION['username'] = 'Tamu';
        }
        // echo "<script>alert('Silakan login terlebih dahulu');window.location.href='guest.php'</script>";
    }

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
    <title>Rute dan Perhentian</title>
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
                            <a class="nav-link active fw-bold" aria-current="page" href="">Rute</a>
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

    <main class="container mt-3">
        <div class="card shadow-lg">
            <div class="card-header">
                <h5 class="card-title">Rute & Perhentian Kereta</h5>
            </div>
            <div class="card-body" style=" max-height: 500px; overflow-y: auto;">
                <div class="accordion shadow-sm" id="accordionPanelsStayOpenExample">

<?php
    $queryTrain = "SELECT * FROM train";
    $findTrain = mysqli_query($conn, $queryTrain);
    $route = 1;
    while($rowTrain = mysqli_fetch_array($findTrain)){
?>

                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed d-flex justify-content-between" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapse<?php echo $route;?>" aria-expanded="false" aria-controls="panelsStayOpen-collapse<?php echo $route;?>">
                                <div class="fw-bold me-5"><?php echo $rowTrain['name']; ?></div>
                                <div class="mx-3">
                                    <?php echo $rowTrain['start']; ?>
                                    <svg xmlns="http://www.w3.org/2000/svg" height="15" fill="currentColor" class="bi bi-arrow-left-right mx-1" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M1 11.5a.5.5 0 0 0 .5.5h11.793l-3.147 3.146a.5.5 0 0 0 .708.708l4-4a.5.5 0 0 0 0-.708l-4-4a.5.5 0 0 0-.708.708L13.293 11H1.5a.5.5 0 0 0-.5.5zm14-7a.5.5 0 0 1-.5.5H2.707l3.147 3.146a.5.5 0 1 1-.708.708l-4-4a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 4H14.5a.5.5 0 0 1 .5.5z"/>
                                    </svg>
                                    <?php echo $rowTrain['finish']; ?>
                                </div>
                            </button>
                        </h2>
                        <div id="panelsStayOpen-collapse<?php echo $route;?>" class="accordion-collapse collapse ">
                            <div class="accordion-body">
                                <ol class="list-group list-group-numbered list-group-flush">

<?php
        $queryRoute = "SELECT * FROM station INNER JOIN train_stations ON station.id = train_stations.station_id WHERE train_stations.train_id = ".$rowTrain['id'];
        $findRoute = mysqli_query($conn,$queryRoute);
        while ($rowRoute = mysqli_fetch_array($findRoute)) {       
?>
                                
                                    <li class="list-group-item d-flex justify-content-between align-items-start">
                                        <div class="ms-2 me-auto">
                                            <div class="fw-medium"><?php echo $rowRoute['name'];?></div>
                                            <!-- Content for list item -->
                                        </div>
                                        <span class="badge bg-primary rounded-pill"><?php echo "km ". $rowRoute['km_location'] ?></span>
                                    </li>

<?php
        }
?>
                                </ol>
                            </div>
                        </div>
                    </div>

<?php        
        $route++;
    }
?>

                </div>
            </div>
        </div>
    </main>

    <footer class="text-black text-center fw-medium fst-italic" style="background-color: rgba(255, 255, 255, 0.8); backdrop-filter: blur 10px;">
        Akhsan Ibrahim - L200200253
    </footer>
</body>
</html>