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
        $_SESSION['gebruikerID'] = $user['gebruikerID']; // Store the gebruikerID in session

        // Check if the user is an administrator or manager
        $adminQuery = "SELECT * FROM Administrator WHERE gebruikerID = " . $user['gebruikerID'];
        $adminResult = mysqli_query($conn, $adminQuery);
        $isAdmin = (mysqli_num_rows($adminResult) > 0);

        $managerQuery = "SELECT * FROM Manager WHERE gebruikerID = " . $user['gebruikerID'];
        $managerResult = mysqli_query($conn, $managerQuery);
        $isManager = (mysqli_num_rows($managerResult) > 0);

        if ($isAdmin || $isManager) {
            $_SESSION['isAdmin'] = $isAdmin;
            $_SESSION['isManager'] = $isManager;
            $_SESSION['login_message'] = "Je bent succesvol ingelogd!";
            header("Location: overzicht.php");
            exit;
        }
    }
}

$_SESSION['login_message'] = "Ongeldige gebruikersnaam of wachtwoord";
header("Location: inloggen.php");
exit;
?>
