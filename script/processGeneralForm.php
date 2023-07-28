<?php
session_start();  
if (!isset($_SESSION['username'])) {
    header("Location: loginUser.php");
}

include "../database/config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["general_form"])) {
        $_SESSION['transaction_state'] = "trip_fill";
        $_SESSION["train"] = $_POST["train"]; // Simpan data ke session
        $_SESSION["origin"] = $_POST["origin"];
        $_SESSION["departure"] = $_POST["departure"];
        $_SESSION["arrive"] = $_POST["arrive"];
        $_SESSION["destination"] = $_POST["destination"];
        $_SESSION["price"] = $_POST["price"];
        $_SESSION["date_ticket"] = $_POST["date_ticket"];
        $_SESSION["selected_wagon"] = 0;
        $_SESSION["selected_seat"] = 0;
        header("Location: ../view/user/seatUser.php"); // Alihkan ke halaman 2
        exit;
    }
    if (isset($_POST['seat_form'])) {
        $_SESSION['transaction_state'] = "seat_fill";
        $_SESSION["selected_seat"] = $_POST["seat"];
        if ($_SESSION["selected_seat"] > 0) {
            header("Location: ../view/user/payment.php");
            exit;
        }
        echo "<script>alert('Bangku yang Anda pilih tidak valid');window.location.href='../view/user/seatUser.php'</script>";
        // header("Location: ../view/user/seatUser.php");
        exit;
    }
    if (isset($_POST['pay'])) {
        $_SESSION['transaction_state'] = "payment_fill";
        $_SESSION["payment"] = $_POST["pay_method"];

        $user_id = $_SESSION['id'];
        $train = $_SESSION["train"];
        $origin = $_SESSION["origin"];
        $departure = $_SESSION["departure"];
        $arrive = $_SESSION["arrive"];
        $destination = $_SESSION["destination"];
        $price = $_SESSION["price"];
        $selected_wagon = $_SESSION["selected_wagon"];
        $selected_seat = $_SESSION["selected_seat"];
        $date_ticket = $_SESSION["date_ticket"];
        $payment = $_SESSION["payment"];

        date_default_timezone_set('Asia/Jakarta');
        $timestamp = time();
        $transaction_date = date('Y-m-d H:i:s', $timestamp);
        $transaction_id = $user_id . date('ymdHis', $timestamp);
        $_SESSION['transaction_id'] = $transaction_id;
        
        $queryTransaction = "INSERT INTO transaction 
        (id,user_id,train,origin,departure,arrive,destination,price,wagon,seat,ticket_date,transaction_date,payment) 
        VALUES ('$transaction_id','$user_id','$train','$origin','$departure','$arrive','$destination','$price','$selected_wagon','$selected_seat','$date_ticket','$transaction_date','$payment')";
        // mysqli_query($conn,$queryTransaction);

        if (mysqli_query($conn, $queryTransaction))
        {
            echo "
                <script>
                    alert('Pembayaran berhasil'); 
                    window.location.href='../view/user/ticketUser.php'
                </script>
            ";
        }
        else
        {
            die("Data gagal diubah; ".mysqli_errno($conn).mysqli_error($conn));
        }

        // header("Location: ../view/user/ticketUser.php");
        exit;
    }
    if (isset($_POST['guestName'])) {
        $_SESSION['username'] = $_POST['username'];
        $_SESSION['email'] = $_POST['email'];
        $_SESSION['contact'] = $_POST['contact'];
        $_SESSION['role'] = 'guest';
        
        $sql = "SELECT * FROM user WHERE email='$_SESSION[email]'";
        $result = mysqli_query($conn, $sql);
        
        if (!$result->num_rows > 0) {
            $queryGuest = "INSERT INTO user (username, email, contact, password, role) VALUES ('$_SESSION[username]', '$_SESSION[email]', '$_SESSION[contact]', 'guest', 'guest')";
            $resultGuest = mysqli_query($conn, $queryGuest);
            if ($resultGuest) {
                $queryGuestId = mysqli_query($conn,$sql);
                $resultGuestId = mysqli_fetch_array($queryGuestId);
                $_SESSION['id'] = $resultGuestId['id'];
                header("Location: ../view/user/inputUser.php");
            } else {
                echo "<script>alert('Woops! Terjadi kesalahan.')</script>";
            }
        } elseif ($result->num_rows > 0) {
            $queryUpdateUser = "UPDATE user SET username = '$username', contact = '$contact' WHERE email = '$email'";
            $resultUpdateUser = mysqli_query($conn, $queryUpdateUser);
            if ($resultUpdateUser) {
                echo "<script>alert('Registrasi akun berhasil');window.location.href='../view/user/inputUser.php'</script>";
            }
        } else {
            echo "<script>alert('Woops! Email Sudah Terdaftar.'); window.location.href='../view/user/guest.php'</script>";
        }

    }

    if (isset($_POST['print_ticket'])) {
        $_SESSION['transaction_state'] = "success";
        $transaction_id = $_SESSION['transaction_id'];
        if ($_SESSION['role']=='guest') {
            unset($_SESSION['role']);
        }
        header("Location: ../view/user/printTicket.php?id=$transaction_id");
    }

    if (isset($_POST['cancelReservation'])) {
        mysqli_query($conn,"DELETE FROM user WHERE id = '$_SESSION[id]'");
        session_destroy();
        header("Location: ../index.php");
        exit();
    }
}
?>