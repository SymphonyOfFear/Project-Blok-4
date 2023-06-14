<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="css/style.css">
  <link href="https://fonts.googleapis.com/css2?family=Alumni+Sans:wght@200&family=Jost:wght@700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>

<body>
<div class="navbar">
        <a class="navbar-brand">Mikey's Site</a>
        <ul class="navbar-content">
            <li>
                <?php if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] === true) : ?>
                    <a href="overzicht.php">Overzichten</a>
                    <a href="contact-persoon-toevoegen.php">Contact Persoon Toevoegen</a>
                    <a href="admin-dashboard.php">Admin Panel</a>
                <?php elseif (isset($_SESSION['isManager']) && $_SESSION['isManager'] === true) : ?>
                    <a href="overzicht.php">Overzichten</a>
                    <a href="contact-persoon-toevoegen.php">Contact Persoon Toevoegen</a>
                <?php else : ?>
                    <a href="overzicht.php">Overzichten</a>

                <?php endif; ?>
            </li>
        </ul>
        <div class="dropdown">
            <button class="dropdown-toggle" id="account-dropdown-button" onclick="toggleAccountDropdown()">Account</button>
            <ul id="account-dropdown-menu" class="dropdown-menu">
                <?php if (isset($_SESSION['isIngelogd']) && $_SESSION['isIngelogd'] === true) : ?>
                    <li class="dropdown-item"><a href="instellingen.php">Instellingen</a></li>
                    <li class="dropdown-item"><a href="uitloggen.php">Uitloggen</a></li>
                <?php else : ?>
                    <li class="dropdown-item"><a href="inloggen.php">Inloggen</a></li>
                    <li class="dropdown-item"><a href="registreer-gebruiker.php">Registreren</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
  

  <script src="js/script.js"></script>
</body>

</html>
