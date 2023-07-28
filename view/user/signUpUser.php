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
 
// if (isset($_SESSION['username'])) {
//     header("Location: loginUser.php");
// }
 
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
 
    if ($password == $cpassword) {
        $sql = "SELECT * FROM user WHERE email='$email'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result);
        if (!$result->num_rows > 0) {
            $sql = "INSERT INTO user (username, email,contact, password)
                    VALUES ('$username', '$email', '$contact', '$password')";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_array($result);
            if ($result) {
                echo "<script>alert('Registrasi akun berhasil');window.location.href='loginUser.php'</script>";
                $username = "";
                $email = "";
                $_POST['password'] = "";
                $_POST['cpassword'] = "";
            } else {
                echo "<script>alert('Woops! Terjadi kesalahan.')</script>";
            }
        } elseif ($result->num_rows > 0 AND $row['role'] == 'guest') {
            $queryUpdateUser = "UPDATE user SET username = '$username', contact = '$contact', password = '$password', role = 'customer' WHERE email = '$email'";
            $resultUpdateUser = mysqli_query($conn, $queryUpdateUser);
            if ($resultUpdateUser) {
                echo "<script>alert('Registrasi akun berhasil');window.location.href='loginUser.php'</script>";
            }
        } else {
            echo "<script>alert('Woops! Email Sudah Terdaftar.')</script>";
        }
         
    } else {
        echo "<script>alert('Password Tidak Sesuai')</script>";
    }
}
 
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up E-Tiket Kereta Api</title>
    <link rel="shortcut icon" href="../../images/logorai_square.png">
    <!-- css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../../style/style_extra.css">
</head>

<body>
<main class="container d-flex flex-column ">
            <div class="card shadow-lg mt-3">
                <div class="card-header d-flex justify-content-between align-items-center flex-wrap">
                    <h5 class="card-title fs-4 me-5">Form Registrasi RAI</h5>
                </div>
                <div class="card-body row g-0">
                    <div class="mb-3">
                        <form action="signUpUser.php" method="POST" class="login-email">
                            <div class="mb-3">
                                <label for="username" class="form-label mb-1">Username</label>
                                <input type="text" class="form-control" id="username" placeholder="username" name="username" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label mb-1">email</label>
                                <input type="email" class="form-control" id="email" placeholder="Email" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="contact" class="form-label mb-1">Contact</label>
                                <input type="number" class="form-control" id="contact" placeholder="Contact Number" name="contact" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label mb-1">Password</label>
                                <input type="password" class="form-control" id="password"placeholder="Password" name="password" required>
                            </div>
                            <div class="mb-3">
                                <label for="cpassword" class="form-label mb-1">Confirm Password</label>
                                <input type="password" class="form-control" id="cpassword"placeholder="Password" name="cpassword" required>
                            </div>
                            <div class="input-group">
                                <button name="submit" class="btn btn-primary">Sign in</button>
                            </div>
                            <div class="mb-3">
                            <p class="login-register-text">Have an Account? <a href="loginUser.php">Sign in </a></p>
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