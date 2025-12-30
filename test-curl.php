<?php
$ch = curl_init("https://api.brevo.com");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
$err = curl_error($ch);
curl_close($ch);

if ($err) {
    echo "cURL Error: " . $err;
} else {
    echo "Bağlantı başarılı!";
}
?>

