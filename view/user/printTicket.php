<?php
session_start();
require('../../lib/fpdf.php');
require('../../lib/phpqrcode/qrlib.php');
include "../../database/config.php";
include "../../script/functions.php";

if ($_SESSION['transaction_state'] != "success") {
    // Jika pemesanan belum selesai, alihkan pengguna ke halaman beranda atau halaman sebelumnya
    header("Location: ticketUser.php");
    exit;
}

$transaction_id = $_GET['id'];

$queryShowTransaction = "SELECT * FROM transaction WHERE id = $transaction_id";
$resultTransactions = mysqli_query($conn, $queryShowTransaction);
$row = mysqli_fetch_assoc($resultTransactions);

$train = $row["train"];
$origin = $row["origin"];
$departure = $row["departure"];
$arrive = $row["arrive"];
$destination = $row["destination"];
$price = $row["price"];
$selected_wagon = $row["wagon"];
$selected_seat = $row["seat"];
$date_ticket = $row["ticket_date"];
$transaction_date =  $row["transaction_date"];
$payment = $row["payment"];

$user_id = $_SESSION['id'];

$queryUser = mysqli_query($conn,"SELECT * FROM user WHERE id = '$user_id'");
$rowUser = mysqli_fetch_array($queryUser);
$user_name = $rowUser['username'];
$email = $rowUser['email'];
$phone = $rowUser['contact'];

function drawDottedLine($pdf, $x1, $y1, $x2, $y2, $dotLength = 1, $spaceLength = 0.5, $color = array(192, 192, 192))
{
    $pdf->SetDrawColor($color[0], $color[1], $color[2]);

    $lineLength = sqrt(pow($x2 - $x1, 2) + pow($y2 - $y1, 2));
    $dotLengthNormalized = $dotLength / $lineLength;
    $spaceLengthNormalized = $spaceLength / $lineLength;

    $x = $x1;
    $y = $y1;
    $length = 0;
    $drawing = true;

    while ($length <= $lineLength) {
        $xEnd = $x + ($x2 - $x1) * $dotLengthNormalized;
        $yEnd = $y + ($y2 - $y1) * $dotLengthNormalized;

        if ($drawing) {
            $pdf->Line($x, $y, $xEnd, $yEnd);
        }

        $x = $xEnd + ($x2 - $x1) * $spaceLengthNormalized;
        $y = $yEnd + ($y2 - $y1) * $spaceLengthNormalized;
        $drawing = !$drawing;

        $length += $dotLength + $spaceLength;
    }
}

$pdf = new FPDF('P','mm',array(80,160));
$pdf->AddPage();
$pdf->SetLeftMargin(7);
$pdf->SetAutoPageBreak(false, 1);

$pdf->Image('../../images/logorai_compact.png',27,8,25,0);

$pdf->Ln(15);

$pdf->SetFont('Arial','B',9);
$pdf->Cell(31,5,'Id Transaksi',0,0,'L');
$pdf->SetFont('Arial','',9);
$pdf->Cell(35,5,$transaction_id,0,1,'R');

drawDottedLine($pdf, 5, 32.5, 74, 32.5);
$pdf->Ln(5);

$pdf->SetFont('Arial','B',9);
$pdf->Cell(31,5,'Nama',0,0,'L');
$pdf->SetFont('Arial','',9);
$pdf->Cell(35,5,$user_name,0,1,'R');

$pdf->SetFont('Arial','B',9);
$pdf->Cell(31,5,'Email',0,0,'L');
$pdf->SetFont('Arial','',9);
$pdf->Cell(35,5,$email,0,1,'R');

$pdf->SetFont('Arial','B',9);
$pdf->Cell(31,5,'Kontak',0,0,'L');
$pdf->SetFont('Arial','',9);
$pdf->Cell(35,5,$phone,0,1,'R');

drawDottedLine($pdf, 5, 52.5, 74, 52.5);
$pdf->Ln(5);

$pdf->SetFont('Arial','B',9);
$pdf->Cell(31,5,'Hari, Tanggal',0,0,'L');
$pdf->SetFont('Arial','',9);
$pdf->Cell(35,5,tanggal_indonesia($date_ticket),0,1,'R');

$pdf->Ln(1);

$pdf->SetFont('Arial','B',9);
$pdf->Cell(31,5,'Asal',0,0,'L');
$pdf->SetFont('Arial','',9);
$pdf->Cell(35,5,$origin,0,1,'R');

$pdf->SetFont('Arial','B',9);
$pdf->Cell(31,5,'Berangkat',0,0,'L');
$pdf->SetFont('Arial','',9);
$pdf->Cell(35,5,substr($departure, 0, 5)." WIB",0,1,'R');

$pdf->Ln(1);

$pdf->SetFont('Arial','B',9);
$pdf->Cell(31,5,'Tujuan',0,0,'L');
$pdf->SetFont('Arial','',9);
$pdf->Cell(35,5,$destination,0,1,'R');

$pdf->SetFont('Arial','B',9);
$pdf->Cell(31,5,'Tiba',0,0,'L');
$pdf->SetFont('Arial','',9);
$pdf->Cell(35,5,substr($arrive, 0, 5)." WIB",0,1,'R');

$pdf->Ln(1);

$pdf->SetFont('Arial','B',9);
$pdf->Cell(31,5,'Kereta',0,0,'L');
$pdf->SetFont('Arial','',9);
$pdf->Cell(35,5,$train,0,1,'R');

$pdf->SetFont('Arial','B',9);
$pdf->Cell(31,5,'Gerbong/Bangku',0,0,'L');
$pdf->SetFont('Arial','',9);
$pdf->Cell(35,5,$selected_wagon." / ".$selected_seat,0,1,'R');

drawDottedLine($pdf, 5, 95, 74, 95);
$pdf->Ln(5);

setlocale(LC_MONETARY, 'id_ID');
$pdf->SetFont('Arial','B',9);
$pdf->Cell(31,5,'Harga',0,0,'L');
$pdf->SetFont('Arial','',9);
$pdf->Cell(35,5,"Rp".number_format($price, 2, ',', '.'),0,1,'R');

$pdf->SetFont('Arial','B',9);
$pdf->Cell(31,5,'Pembayaran',0,0,'L');
$pdf->SetFont('Arial','',9);
$pdf->Cell(35,5,$payment,0,1,'R');

QRcode::png("http://localhost/kereta/view/user/printTicket.php?id=".$transaction_id, "../../images/qrcode/".$transaction_id.".png", QR_ECLEVEL_H, 4);
$pdf->Image("../../images/qrcode/".$transaction_id.".png", 25, 113, 30);

$pdf->SetY(-10);
$pdf->SetFont('Arial','I',9);
$pdf->Cell(66,5,"Selamat menikmati perjalanan Anda:)",0,1,'C');

$pdf->SetTitle("Train Ticket by RAI");
$pdf->SetAuthor($user_name);
$pdf->SetSubject($origin." - ".$destination);
$pdf->SetKeywords($transaction_id);
$pdf->SetCreator("RAI Tiket Kereta");

$pdf->Output();
?>

    
</body>
</html>