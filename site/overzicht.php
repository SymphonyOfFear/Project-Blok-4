<?php
session_start();
require 'database.php';

if (!isset($_SESSION['isIngelogd']) || $_SESSION['isIngelogd'] !== true) {
    header("Location: inloggen.php");
    exit;
}

$userId = $_SESSION['gebruikerID'];
$sql = "SELECT * FROM Gebruiker WHERE gebruikerID = '$userId'";
$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

$userData = mysqli_fetch_assoc($result);

$role = isset($userData['role']) ? $userData['role'] : null;

$zoekenGebruikers = mysqli_fetch_all(mysqli_query($conn, "SELECT * FROM Gebruiker"), MYSQLI_ASSOC);
$zoekenContact = mysqli_fetch_all(mysqli_query($conn, "SELECT * FROM ContactPersoon"), MYSQLI_ASSOC);

if (isset($_POST['submit'])) {
    $zoekveld = $_POST['zoekveld'];

    $sql = "SELECT * FROM Gebruiker WHERE voornaam LIKE '%$zoekveld%' OR achternaam LIKE '%$zoekveld%'";
    $result = mysqli_query($conn, $sql);
    $GezochtenGebruiker = mysqli_fetch_all($result, MYSQLI_ASSOC);

    $sql = "SELECT * FROM ContactPersoon WHERE naam LIKE '%$zoekveld%'";
    $result = mysqli_query($conn, $sql);
    $GezochtenContact = mysqli_fetch_all($result, MYSQLI_ASSOC);
}

$sql = "SELECT * FROM Gebruiker";
$result = mysqli_query($conn, $sql);
$GebruikerTabel = mysqli_fetch_all($result, MYSQLI_ASSOC);

$sql = "SELECT * FROM ContactPersoon";
$result = mysqli_query($conn, $sql);
$ContactTabel = mysqli_fetch_all($result, MYSQLI_ASSOC);

$sql = "SELECT
    (SELECT COUNT(*) FROM ContactPersoon) AS totalContactPersons,
    (SELECT COUNT(*) FROM Gebruiker WHERE role = 'administrator') AS totalAdministrators,
    (SELECT COUNT(*) FROM Gebruiker WHERE role = 'manager') AS totalManagers,
    (SELECT COUNT(*) FROM Gebruiker WHERE role = 'regular') AS totalRegularUsers";
$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}
$TotaalAantalContact = mysqli_fetch_assoc($result);

$sql = "SELECT COUNT(*) AS total_contacts FROM ContactPersoon";
$result = mysqli_query($conn, $sql);
$AlleContacten = mysqli_fetch_assoc($result);

?>


<!DOCTYPE html>
<html>

<head>
    <title>Overzicht</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
    <div class="side-table">
        <div class="container">
            <?php if (isset($_GET['login']) && $_GET['login'] === 'success') : ?>
                <h1>Je bent succesvol ingelogd!</h1>
            <?php endif; ?>

            <?php if (isset($_SESSION['isIngelogd']) && $_SESSION['isIngelogd'] === true) : ?>
                <h1>Welkom op de overzichtspagina!</h1>
            <?php else : ?>
                <h1>Log in om het overzicht te bekijken</h1>
            <?php endif; ?>


            <?php if (isset($userData['role']) && $userData['role'] == 'administrator' || "manager") : ?>
                <div class="dropdown" id="option-dropdown">
                    <button class="dropdown-toggle" id="option-dropdown-button" onclick="toggleOptionDropdown()">Selecteer een Overzicht</button>
                    <ul id="option-dropdown-menu" class="dropdown-menu">

                        <li class="dropdown-item" data-table="1" onclick="ShowAndHide(1)">Bekijken Gebruikers</li>

                        <li class="dropdown-item" data-table="2" onclick="ShowAndHide(2)">Bekijken Personen</li>

                        <li class="dropdown-item" data-table="3" onclick="ShowAndHide(3)">Bekijken Statistieken</li>

                    </ul>
                </div>
            <?php endif ?>
            <!-- Overzichtstabel 1 -->
            <?php if (isset($userData['role']) && $userData['role'] == 'administrator' || "manager") : ?>

                <section class="section section1">
                    <form action="search.php" method="POST">
                        <div class="search-bar">
                            <input name="zoekveld" class="search-input" type="text" placeholder="Zoeken...">
                            <button type="submit" name="submit" class="search-button">Zoek</button>
                        </div>
                    </form>
                    <div class="table-wrapper">
                        <table class="table">
                            <h2>Gebruikers Overzicht</h2>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Voornaam</th>
                                    <th>Tussenvoegsels</th>
                                    <th>Achternaam</th>
                                    <th>Geslacht</th>
                                    <th>E-mail</th>
                                    <th>Gebruikersnaam</th>
                                    <th>Straat</th>
                                    <th>Huisnummer</th>
                                    <th>Postcode</th>
                                    <th>Plaats</th>
                                    <th>Land</th>
                                    <th>Telefoonnummer</th>
                                    <th>Mobielnummer</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($GebruikerTabel as $Gebruiker) : ?>
                                    <tr>
                                        <td><?php echo $Gebruiker['gebruikerID']; ?></td>
                                        <td><?php echo $Gebruiker['voornaam']; ?></td>
                                        <td><?php echo $Gebruiker['tussenvoegsels']; ?></td>
                                        <td><?php echo $Gebruiker['achternaam']; ?></td>
                                        <td><?php echo $Gebruiker['geslacht']; ?></td>
                                        <td><?php echo $Gebruiker['email']; ?></td>
                                        <td><?php echo $Gebruiker['gebruikersnaam']; ?></td>
                                        <td><?php echo $Gebruiker['straat']; ?></td>
                                        <td><?php echo $Gebruiker['huisnummer']; ?></td>
                                        <td><?php echo $Gebruiker['postcode']; ?></td>
                                        <td><?php echo $Gebruiker['plaats']; ?></td>
                                        <td><?php echo $Gebruiker['land']; ?></td>
                                        <td><?php echo $Gebruiker['telefoonnummer']; ?></td>
                                        <td><?php echo $Gebruiker['mobielnummer']; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </section>
            <?php endif ?>
            <!-- Overzichtstabel 2 -->
            <section class="section section2">
                <form action="search.php" method="POST">
                    <div class="search-bar">
                        <input name="zoekveld" class="search-input" type="text" placeholder="Zoeken...">
                        <button type="submit" name="submit" class="search-button">Zoek</button>
                    </div>
                </form>
                <h2>Contact Personen Overzicht</h2>
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Naam</th>
                            <th>Adres</th>
                            <th>Geslacht</th>
                            <th>Telefoonnummer</th>
                            <th>Notitie</th>
                            <th>Toevoegings Datum</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($ContactTabel as $Contact) : ?>
                            <tr>
                                <td><?php echo $Contact['contactID']; ?></td>
                                <td><?php echo $Contact['naam']; ?></td>
                                <td><?php echo $Contact['adres']; ?></td>
                                <td><?php echo $Contact['geslacht']; ?></td>
                                <td><?php echo $Contact['telefoonnummer']; ?></td>
                                <td><?php echo $Contact['notitie']; ?></td>
                                <td><?php echo $Contact['toevoegdatum']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </section>

            <!-- Overzichtstabel 3 -->
            <?php if (isset($userData['role']) && $userData['role'] == 'administrator' || "manager") : ?>
                <section class="section section3">
                    <h2>Statistieken Overzicht</h2>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Totaal Aantal Contact Personen</th>
                                <th>Totaal Aantal Admin Contact Personen</th>
                                <th>Totaal Aantal Manager Contact Personen</th>
                                <th>Totaal Aantal Regular Contact Personen</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                              
                                    <tr>
                                        <td><?php echo $TotaalAantalContact['totalContactPersons']; ?></td>
                                        <td><?php echo $TotaalAantalContact['totalAdministrators']; ?></td>
                                        <td><?php echo $TotaalAantalContact['totalManagers']; ?></td>
                                        <td><?php echo $TotaalAantalContact['totalRegularUsers']; ?></td>
                                    </tr>
                        
                         

                        </tbody>
                    </table>
                </section>
            <?php endif ?>
        </div>
    </div>
    <script src="script.js"></script>
</body>

</html>