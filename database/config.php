<?php
$conn = mysqli_connect("localhost", "root", "", "kereta");

if (!$conn) {
    die("<script>alert('Gagal tersambung dengan database.')</script>");
}
?>