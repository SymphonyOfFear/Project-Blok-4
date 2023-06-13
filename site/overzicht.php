<?php
session_start();
require 'database.php';

if (!isset($_SESSION['isIngelogd']) || $_SESSION['isIngelogd'] !== true) {
    header("Location: inloggen.php");
    exit;
}


$zoekenGebruikers = mysqli_fetch_all(mysqli_query($conn, "SELECT * FROM Gebruiker"), MYSQLI_ASSOC);

if (isset($_POST['submit'])) {
    $zoekveldGebruiker = $_POST['zoekveld'];

    $sql = "SELECT * FROM GEBRUIKER WHERE * LIKE '%$zoekveld%'";

    $result = mysqli_query($conn, $sql);

    $gebruikersgezocht = mysqli_fetch_all($result, MYSQLI_ASSOC);
}


?>

<!DOCTYPE html>
<html>

<head>
    <title>Overzicht</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Alumni+Sans:wght@200&family=Jost:wght@700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        /* Add your custom CSS styles here */
    </style>
</head>
<body>
    <div class="navbar">
        <a class="navbar-brand">Mikey's Site</a>
        <ul class="navbar-content">
            <li>
                <a href="overzicht.php">Overzichten</a>
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

    <div class="container">
        <?php if (isset($_GET['login']) && $_GET['login'] === 'success') : ?>
            <h1>Je bent succesvol ingelogd!</h1>
        <?php endif; ?>

        <?php if (isset($_SESSION['isIngelogd']) && $_SESSION['isIngelogd'] === true) : ?>
            <h1>Welkom op de overzichtspagina!</h1>
        <?php else : ?>
            <h1>Log in om het overzicht te bekijken</h1>
        <?php endif; ?>

        <div class="dropdown" id="option-dropdown">
            <button class="dropdown-toggle" id="option-dropdown-button" onclick="toggleOptionDropdown()">Select an Option</button>
            <ul id="option-dropdown-menu" class="dropdown-menu">
                <li class="dropdown-item" data-table="1" onclick="ShowAndHide(1)">Bekijken Gebruikers</li>
                <li class="dropdown-item" data-table="2" onclick="ShowAndHide(2)">Bekijken Personen</li>
                <li class="dropdown-item" data-table="3" onclick="ShowAndHide(3)">Bekijken Statistieken</li>
            </ul>
        </div>

        <!-- Overzichtstabel 1 -->
        <section class="section section1">
            <div class="search-bar">
                <input id="search1" class="search-input" type="text" placeholder="Zoeken...">
                <button class="search-button">Zoek</button>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Column 1</th>
                        <th>Column 2</th>
                        <th>Column 3</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Data 1</td>
                        <td>Data 2</td>
                        <td>Data 3</td>
                    </tr>
                    <tr>
                        <td>Data 4</td>
                        <td>Data 5</td>
                        <td>Data 6</td>
                    </tr>
                    <tr>
                        <td>Data 7</td>
                        <td>Data 8</td>
                        <td>Data 9</td>
                    </tr>
                </tbody>
            </table>
        </section>

        <!-- Overzichtstabel 2 -->
        <section class="section section2">
            <div class="search-bar">
                <input id="search2" class="search-input" type="text" placeholder="Zoeken...">
                <button class="search-button">Zoek</button>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Column 1</th>
                        <th>Column 2</th>
                        <th>Column 3</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Data A</td>
                        <td>Data B</td>
                        <td>Data C</td>
                    </tr>
                    <tr>
                        <td>Data D</td>
                        <td>Data E</td>
                        <td>Data F</td>
                    </tr>
                    <tr>
                        <td>Data G</td>
                        <td>Data H</td>
                        <td>Data I</td>
                    </tr>
                </tbody>
            </table>
        </section>

        <!-- Overzichtstabel 3 -->
        <section class="section section3">
            <div class="search-bar">
                <input id="search3" class="search-input" type="text" placeholder="Zoeken...">
                <button class="search-button">Zoek</button>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Column 1</th>
                        <th>Column 2</th>
                        <th>Column 3</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Data X</td>
                        <td>Data Y</td>
                        <td>Data Z</td>
                    </tr>
                    <tr>
                        <td>Data P</td>
                        <td>Data Q</td>
                        <td>Data R</td>
                    </tr>
                    <tr>
                        <td>Data L</td>
                    </tr>
                </tbody>
            </table>
        </section>
    </div>

    <script src="js/script.js"></script>
</body>

</html>