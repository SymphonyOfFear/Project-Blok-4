<?php
session_start();


if ($_SERVER['REQUEST_METHOD'] != "POST") {
    header($_SERVER["SERVER_PROTOCOL"] . " 405 Method Not Allowed", true, 405);
    include '405.php';
    exit;
}

require 'database.php';

$voornaam = $_POST['voornaam'];
$tussenvoegsels = $_POST['tussenvoegsels'];
$achternaam = $_POST['achternaam'];
$geslacht = $_POST['geslacht'];
$email = $_POST['email'];
$gebruikersnaam = $_POST['gebruikersnaam'];
$wachtwoord = $_POST['wachtwoord'];
$telefoonnummer = $_POST['telefoonnummer'];
$mobielnummer = $_POST['mobielnummer'];

$hassed_wachtwoord = password_hash($wachtwoord, PASSWORD_DEFAULT);

$sql = "INSERT INTO Gebruiker (voornaam, achternaam, geslacht, email, gebruikersnaam, wachtwoord, telefoonnummer, mobielnummer)
        VALUES ('$voornaam', '$achternaam', '$geslacht', '$email', '$gebruikersnaam', '$hassed_wachtwoord', '$telefoonnummer', '$mobielnummer')";

$result = mysqli_query($conn, $sql);

if (!$result) {
    echo "Error description: " . mysqli_error($conn);
    exit;
}

mysqli_close($conn);
session_destroy();
header("Location: inloggen.php");
exit;
