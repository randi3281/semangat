<?php
$hasil = "";
session_start();
if (isset($_POST['kirim'])) {
    if ($_POST['nilaiCaptcha'] == $_SESSION['Captcha']) {
        header("Location: periksa_captcha.php");
    } else {
        $hasil = "Captcha Salah";
    }
}
