<?php
session_start();
require 'database.php';
$userId = $_SESSION['gebruikerID'];
$sql = "SELECT * FROM Gebruiker WHERE gebruikerID = '$userId'";
$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

$userData = mysqli_fetch_assoc($result);

$role = isset($userData['role']) ? $userData['role'] : null;



if (isset($userData['role']) && $userData['role'] == 'regular') {
    header("Location: overzicht.php");
    exit;
  }


?>
<!DOCTYPE html>
<html>

<head>
    <title>Toevoegen Contact Persoon</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="js/script.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Alumni+Sans:wght@200&family=Jost:wght@700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>

<body>
<div class="title-opdracht">
        <h1>Contact Personen</h1>
    </div>
    <div class="stripe">

    </div>
<div class="navbar">
        <a class="navbar-brand">Mikey's Site</a>
        <ul class="navbar-content">
            <?php if (isset($userData['role']) && $userData['role'] == 'administrator') : ?>
                <li><a href="overzicht.php">Overzichten</a></li>
                <li><a href="contact-persoon-toevoegen.php">Contact Persoon Toevoegen</a></li>
                <li><a href="admin-dashboard.php">Admin Panel</a></li>
         
            <?php elseif (isset($userData['role']) && $userData['role'] == "manager") : ?>
                <li><a href="overzicht.php">Overzichten</a></li>
                <li><a href="contact-persoon-toevoegen.php">Contact Persoon Toevoegen</a></li>
            <?php else : ?>
                <li><a href="overzicht.php">Overzichten</a></li>
            <?php endif; ?>

        </ul>
        <div class="dropdown">
            <button class="dropdown-toggle" id="account-dropdown-button" onclick="toggleAccountDropdown()">Account</button>
            <ul id="account-dropdown-menu" class="dropdown-menu">
                <?php if (isset($_SESSION['isIngelogd']) && $_SESSION['isIngelogd'] === true) : ?>
                    <li class="dropdown-item"><a data-table="4" href="instellingen.php">Instellingen</a></li>
                    <li class="dropdown-item"><a data-table="5" href="uitloggen.php">Uitloggen</a></li>
                <?php else : ?>
                    <li class="dropdown-item"><a href="inloggen.php">Inloggen</a></li>
                    <li class="dropdown-item"><a href="registreer-gebruiker.php">Registreren</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
    
    <div class="container">
        <h1>Contact Persoon Toevoegen</h1>
        
        <form action="verwerk-contact-persoon.php" method="post" class="personal-info-form" id="user-form">
       
                <label for="naam">Naam:</label>
                <input type="text" id="voornaam" name="naam" required >

                <label for="adres">Adres:</label>
                <input type="text" id="adres" name="adres">

                <label for="geslacht">Geslacht:</label>
                <select id="geslacht" name="geslacht" required>
                    <option value=""></option>
                    <option value="Man">Man</option>
                    <option value="Vrouw">Vrouw</option>
                    <option value="Anders">Anders</option>
                </select>
               
              

                <label for="telefoonnummer">Telefoonnummer:</label>
                <input type="tel" id="telefoonnummer" name="telefoonnummer" required>

                <label for="notitie">Notitie:</label>
                <textarea name="notitie" id="notitie" form="user-form"></textarea>
                

           
                <input type="submit" value="Registreren">
         
        </form>
    </div>
</body>

</html>