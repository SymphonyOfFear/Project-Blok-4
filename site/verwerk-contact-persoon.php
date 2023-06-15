<?php
session_start();


if ($_SERVER['REQUEST_METHOD'] != "POST") {
    header($_SERVER["SERVER_PROTOCOL"] . " 405 Method Not Allowed", true, 405);
    include '405.php';
    exit;
}

require 'database.php';

$naam = $_POST['naam'];
$adres = $_POST['adres'];
$geslacht = $_POST['geslacht'];
$telefoonnummer = $_POST['telefoonnummer'];
$notitie = $_POST['notitie'];




$sql = "INSERT INTO ContactPersoon (naam, adres, geslacht, telefoonnummer, notitie)
        VALUES ('$naam', '$adres', '$geslacht', '$telefoonnummer','$notitie')";

$result = mysqli_query($conn, $sql);

if (!$result) {
    echo "Error description: " . mysqli_error($conn);
    exit;
}
header("Location: overzicht.php");
mysqli_close($conn);
exit;
