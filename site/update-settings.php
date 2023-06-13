<?php
session_start();
require 'database.php';

if (isset($_SESSION['gebruikerID'])) {
    $userId = $_SESSION['gebruikerID'];
} else {
    header("Location: uitloggen.php");
    exit;
}

$sql = "SELECT * FROM Gebruiker WHERE gebruikerID = $userId";
$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

$userData = mysqli_fetch_assoc($result);

$gebruikersnaam = $_POST['gebruikersnaam'];
$email = $_POST['email'];
$wachtwoord = $_POST['wachtwoord'];
$voornaam = $_POST['voornaam'];
$tussenvoegsels = $_POST['tussenvoegsels'];
$achternaam = $_POST['achternaam'];
$geslacht = $_POST['geslacht'];
$straat = $_POST['straat'];
$postcode = $_POST['postcode'];
$huisnummer = $_POST['huisnummer'];
$plaats = $_POST['plaats'];
$land = $_POST['land'];
$telefoonnummer = $_POST['telefoonnummer'];
$mobielnummer = $_POST['mobielnummer'];

$sql = "UPDATE Gebruiker SET
    gebruikersnaam = '$gebruikersnaam',
    email = '$email',
    wachtwoord = '$wachtwoord',
    voornaam = '$voornaam',
    tussenvoegsels = '$tussenvoegsels',
    achternaam = '$achternaam',
    geslacht = '$geslacht',
    straat = '$straat',
    postcode = '$postcode',
    huisnummer = '$huisnummer',
    plaats = '$plaats',
    land = '$land',
    telefoonnummer = '$telefoonnummer',
    mobielnummer = '$mobielnummer'
    WHERE gebruikerID = $userId";

if (mysqli_query($conn, $sql)) {
    header("Location: overzicht.php");
    exit;
} else {
    die("Query failed: " . mysqli_error($conn));
}
?>
