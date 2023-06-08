<?php
session_start();
require 'database.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    include '405.php';
    exit;
}

if (!isset($_POST['gebruikersnaam']) || !isset($_POST['wachtwoord'])) {
    header("Location: inloggen.php");
    exit;
}

$gebruikersnaam = $_POST['gebruikersnaam'];
$wachtwoord = $_POST['wachtwoord'];

$sql = "SELECT * FROM Gebruiker WHERE (email = '$gebruikersnaam' OR gebruikersnaam = '$gebruikersnaam')";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);

    if (password_verify($wachtwoord, $user['wachtwoord'])) {
        $_SESSION['isIngelogd'] = true;
        $_SESSION['login_message'] = "Je bent succesvol ingelogd!";
        header("Location: overzicht.php");
        exit;
    }
}

$_SESSION['login_message'] = "Ongeldige gebruikersnaam of wachtwoord";
header("Location: inloggen.php");
exit;
?>
