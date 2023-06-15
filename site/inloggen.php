<?php 
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login pagina</title>
    <link rel="stylesheet" href="css/style.css">
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

    <div class="container">
        <form class="personal-info-form" method="post" action="verwerk-inloggen.php">
            <h1>Inloggen</h1>
            <label for="gebruikersnaam">Gebruikersnaam of e-mail:</label>
            <input type="text" id="gebruikersnaam" name="gebruikersnaam">

            <label for="wachtwoord">Wachtwoord:</label>
            <input type="password" id="wachtwoord" name="wachtwoord">
            <p>Registreren? <a href="registreer-gebruiker.php">klik hier</a></p>

            <input type="submit" value="Inloggen">
        </form>
    </div>

    <script src="js/script.js"></script>
</body>
</html>
