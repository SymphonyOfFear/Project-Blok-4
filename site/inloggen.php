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
<div class="navbar">
    <z></z>
    <div class="dropdown">
        <button class="account-btn" onclick="toggleDropdown()">Account</button>
        <div id="dropdown-content" class="dropdown-content">
            <?php if (isset($_SESSION['isIngelogd']) && $_SESSION['isIngelogd'] === true): ?>
                <a href="instellingen.php">Instellingen</a>
                <a href="uitloggen.php">Uitloggen</a>
            <?php else: ?>
                <a href="inloggen.php">Inloggen</a>
                <a href="registreer-gebruiker.php">Registreren</a>
            <?php endif; ?>
        </div>
    </div>
</div>

<div class="container">
    <form method="post" action="verwerk-inloggen.php">
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
