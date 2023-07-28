<?php
 
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
    <!-- css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../../style/style_extra.css">
    <title>Data Rute Perjalanan</title>
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
//cookies
$duajamlagi = time() + 2 * 3600; 
setcookie('KunjunganTerakhir', date("G:i - m/d/y"), $duajamlagi);
?>

<div class="container flex flex-wrap max-w-screen-lg justify-center mb-52">
    <div class="flex my-10 py-3 bg-cyan-500 rounded-lg max-w-2xl">
        <div class="col-md-3"></div>
    </div>
    <br><br><br>
    <h2 class="font-serif text-4xl font-bold">DATA KERETA</h2>
        <div class="flex justify-center my-4">
        <table class="text-center table-auto border-separate border-4 border-sky-600 font-sans border-spacing-x-2 rounded-xl ">
        <thead class="border border-sky-600 bg-sky-400 font-bold">        
        <section id="train">
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
                            <th class="text-center" scope="col">Gambar</th>
                            <th class="text-center" scope="col">Pilihan</th>
                            
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
                                <td align="center" class="border bg-sky-200 font-semibold"><img style="width: 180px;" class="mb-3 rounded " src="../../images/kereta/<?php echo $d['picture'];?>"/></td>
                                
                                <td align="center" class="border bg-sky-200 font-semibold"><button type="submit" class="border-solid shadow-md py-1 px-2 m-1 font-bold text-lg border-4 rounded-md bg-white border-blue-600 hover:bg-blue-400 hover:text-slate-200"><?php echo "<a href='../../view/admin/editinput.php?id=" . $d['id'] . "'>Edit</a>"; ?></button>  <button type="submit" class="border-solid shadow-md py-1 px-2 m-1 font-bold text-lg border-4 rounded-md bg-white border-blue-600 hover:bg-blue-400 hover:text-slate-200"><?php echo "<a href='../../script/hapus.php?id=" . $d['id'] . "'>Hapus</a>"; ?></button></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </section>
        </thead>       
        </div>
</div>

<!--DATA TABEL STASIUN-->
<div class="container flex flex-wrap max-w-screen-lg justify-center mb-52">
    <div class="flex my-10 py-3 bg-cyan-500 rounded-lg max-w-2xl">
        <div class="col-md-3"></div>
    </div>
        <div class="flex justify-center my-4">
        <table class="text-center table-auto border-separate border-4 border-sky-600 font-sans border-spacing-x-2 rounded-xl ">
        <thead class="border border-sky-600 bg-sky-400 font-bold">        
        <section id="train">
        <div class="container">
            <div class="row text-center">
                <h2>Data Stasiun</h2>
                <table class="table table-dark table-sm table table-bordered border-light" width="90%">
                    <thead>
                        <tr>
                            <th class="text-center" scope="col">No</th>
                            <th class="text-center" scope="col">Nama</th>
                            <th class="text-center" scope="col">Jarak Lokasi (KM)</th>
                            <th class="text-center" scope="col">Pilihan</th> 
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        error_reporting(0);
                        include "../../database/config.php";
                        $no = 1;
                        $data = mysqli_query($conn, "select * from station") or die (mysqli_error($conn));
                        while ($d = mysqli_fetch_array($data)) {
                        ?>
                            <tr>
                            <td><?php echo $no++; ?></td>
                                <td align="center" class="border bg-sky-200 font-semibold"><?php echo $d['name']; ?></td>
                                <td align="center" class="border bg-sky-200 font-semibold"><?php echo $d['km_location']; ?></td>
                                <td align="center" class="border bg-sky-200 font-semibold"><button type="submit" class="border-solid shadow-md py-1 px-2 m-1 font-bold text-lg border-4 rounded-md bg-white border-blue-600 hover:bg-blue-400 hover:text-slate-200"><?php echo "<a href='../../view/admin/editinputStasiun.php?id=" . $d['id'] . "'>Edit</a>"; ?></button>  <button type="submit" class="border-solid shadow-md py-1 px-2 m-1 font-bold text-lg border-4 rounded-md bg-white border-blue-600 hover:bg-blue-400 hover:text-slate-200"><?php echo "<a href='../../script/hapusstasiun.php?id=" . $d['id'] . "'>Hapus</a>"; ?></button></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </section>
        </thead>       
        </div>
</div> 

<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<footer class="text-black text-center fw-medium fst-italic" style="background-color: rgba(255, 255, 255, 0.8); backdrop-filter: blur 10px;">
        Karmila Muhammad Izudin Rojak - L200200251
    </footer>
</body>

</html>