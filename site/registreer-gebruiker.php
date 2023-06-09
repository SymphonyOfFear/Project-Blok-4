<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <title>Registreren</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="js/script.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Alumni+Sans:wght@200&family=Jost:wght@700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>

<body>
    <div class="navbar">
        <a class="navbar-brand" href="#">Overzichten</a>
        <div class="dropdown">
        <button class="account-btn" onclick="toggleDropdown(event)">Account</button>
            <div id="dropdown-content" class="dropdown-content">
                
            </div>
        </div>
    </div>
    <?php if (isset($_SESSION['isIngelogd']) && $_SESSION['isIngelogd'] === true) : ?>
                    <a href="instellingen.php">Instellingen</a>
                    <a href="uitloggen.php">Uitloggen</a>
                <?php else : ?>
                    <a href="inloggen.php">Inloggen</a>
                    <a href="registreer-gebruiker.php">Registreren</a>
                <?php endif; ?>
    <div class="container">
        <h1>Registreren</h1>
        <div class="progress">
            <div id="progress-bar" class="progress-bar"></div>
        </div>
        <form action="verwerk-registreren-gebruiker.php" onsubmit="return validateForm()" method="post">
            <!-- Formulier: Deel 1 -->
            <section>
                <h2>Deel 1: Persoonlijke gegevens</h2>
                <label for="voornaam">Voornaam:</label>
                <input type="text" id="voornaam" name="voornaam" required oninput="updateProgress()">

                <label for="tussenvoegsels">Tussenvoegsels:</label>
                <input type="text" id="tussenvoegsels" name="tussenvoegsels">

                <label for="achternaam">Achternaam:</label>
                <input type="text" id="achternaam" name="achternaam" required oninput="updateProgress()">

                <label for="geslacht">Geslacht:</label>
                <select id="geslacht" name="geslacht" required onchange="updateProgress()">
                    <option value=""></option>
                    <option value="Man">Man</option>
                    <option value="Vrouw">Vrouw</option>
                    <option value="Anders">Anders</option>
                </select>

                <input type="button" value="Volgende" onclick="showFormPart(2)">
            </section>

            <!-- Formulier: Deel 2 -->
            <section id="form-part-2">
                <h2>Deel 2: Contactgegevens</h2>
                <label for="email">E-mail:</label>
                <input type="email" id="email" name="email" required oninput="updateProgress()">

                <label for="telefoonnummer">Telefoonnummer:</label>
                <input type="tel" id="telefoonnummer" name="telefoonnummer" required oninput="updateProgress()">

                <label for="mobielnummer">Mobielnummer:</label>
                <input type="tel" id="mobielnummer" name="mobielnummer" oninput="updateProgress()">

                <input type="button" value="Vorige" onclick="showFormPart(1)">
                <input type="button" value="Volgende" onclick="showFormPart(3)">
            </section>

            <!-- Formulier: Deel 3 -->
            <section id="form-part-3">
                <h2>Deel 3: Accountgegevens</h2>
                <label for="gebruikersnaam">Gebruikersnaam:</label>
                <input type="text" id="gebruikersnaam" name="gebruikersnaam" required oninput="updateProgress()">

                <label for="wachtwoord">Wachtwoord:</label>
                <input type="password" id="wachtwoord" name="wachtwoord" required oninput="updateProgress()">

                <input type="button" value="Vorige" onclick="showFormPart(2)">
                <input type="submit" value="Registreren">
            </section>
        </form>
    </div>
</body>

</html>