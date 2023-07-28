<?php
require('../database/config.php');
$id = $_GET['id'];

$data = mysqli_query($conn, "DELETE from train where id = '$id'");
echo "<meta http-equiv=refresh content=0;URL='../view/admin/halamanAdmin.php'>";
?>