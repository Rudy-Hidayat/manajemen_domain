<?php
include 'config.php';

$today = date('Y-m-d');
$warningDate = date('Y-m-d', strtotime('+7 days'));

// Ambil domain yang SSL-nya hampir habis
$result = $conn->query("SELECT * FROM domains WHERE ssl_expiry IS NOT NULL AND ssl_expiry <= '$warningDate'");

$subject = "Peringatan SSL Expired!";
$headers = "From: admin@yourdomain.com\r\n";
$headers .= "Content-Type: text/html; charset=UTF-8\r\n";

while ($row = $result->fetch_assoc()) {
    $message = "
        <h3>Peringatan SSL Expired</h3>
        <p>Domain: <b>{$row['domain_name']}</b></p>
        <p>SSL akan kedaluwarsa pada: <b>{$row['ssl_expiry']}</b></p>
        <p>Segera perbarui sertifikat SSL sebelum habis!</p>
    ";

    // Ganti dengan email penerima yang diinginkan
    mail("admin@yourdomain.com", $subject, $message, $headers);
}

echo "Notifikasi email telah dikirim.";
$conn->close();
?>
