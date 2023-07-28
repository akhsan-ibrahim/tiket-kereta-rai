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

include '../../database/config.php';
if (isset($_POST['submit'])) {
    $_SESSION['transaction_state'] = "login";
    $email = $_POST['email'];
    $password = $_POST['password'];
 
    $sql = "SELECT * FROM user WHERE email='$email' AND password='$password'";
    $result = mysqli_query($conn, $sql);
    if ($result->num_rows > 0) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['id'] = $row['id'];
        $_SESSION['username'] = $row['username'];
        $_SESSION['role'] = $row['role'];
        header("Location: halamanUser.php");
    } else {
        echo "<script>alert('Email atau password Anda salah. Silahkan coba lagi!')</script>";
    }
}
 
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login E-Tiket Kereta Api</title>
    <link rel="shortcut icon" href="../../images/logorai_square.png">
    <!-- css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../../style/style_extra.css">
</head>

<body>
    <!-- <div class="alert alert-warning" role="alert">
        <?php echo $_SESSION['error']?>
        
    </div> -->
    <main class="container d-flex flex-column ">
            <div class="card shadow-lg mt-3">
                <div class="card-header d-flex justify-content-between align-items-center flex-wrap">
                    <h5 class="card-title fs-4 me-5">Welcome to, E-Tiket Kereta RAI</h5>
                </div>
                <div class="card-body row g-0">
                    <div class="mb-3">
                        <form action="loginUser.php" method="POST" class="login-email">
                            <div class="mb-3">
                                <label for="email" class="form-label mb-1">Masukkan email anda</label>
                                <input type="email" class="form-control" id="email" placeholder="Email" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label mb-1">Masukkan Password anda</label>
                                <input type="password" class="form-control" id="password"placeholder="Password" name="password" required>
                            </div>
                            <div class="input-group">
                                <button name="submit" class="btn btn-primary">Sign in</button>
                            </div>
                            <div class="mb-3">
                            <p class="login-register-text">No Account? <a href="signUpUser.php">Sign up</a></p>
                            <p class="login-register-text"><a href="../../index.php">< Back</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>

        <footer class="bg-primary text-white text-center pb-2">
        <p><span class="text-white fw-bold">Kelompok 5</span> - Ilham Rian Novanto L200200247</p>
        </footer>
</body>

</html>