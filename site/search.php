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

if (!isset($_SESSION['isIngelogd']) || $_SESSION['isIngelogd'] !== true) {
    header("Location: inloggen.php");
    exit;
}

$noResultsMessage = ''; // Initialize the variable to store the "no results" message
if (isset($userData['role']) && ($userData['role'] == 'administrator' || $userData['role'] == 'manager')) {
    if (isset($_POST['submit'])) {
        $zoekveld = $_POST['zoekveld']; {
            $sql = "SELECT * FROM Gebruiker WHERE voornaam LIKE '%$zoekveld%'";
            $result = mysqli_query($conn, $sql);
            $GezochtenGebruiker = mysqli_fetch_all($result, MYSQLI_ASSOC);

            $sql = "SELECT * FROM ContactPersoon WHERE naam LIKE '%$zoekveld%'";
            $result = mysqli_query($conn, $sql);
            $GezochtenContact = mysqli_fetch_all($result, MYSQLI_ASSOC);

            if (empty($GezochtenContact) && empty($GezochtenGebruiker)) {
                $noResultsMessage = 'Geen resultaten gevonden.';
            }
        }
    }
} else {
    if (isset($_POST['submit'])) {
        $zoekveld = $_POST['zoekveld']; {

            $sql = "SELECT * FROM ContactPersoon WHERE naam LIKE '%$zoekveld%'";
            $result = mysqli_query($conn, $sql);
            $GezochtenContact = mysqli_fetch_all($result, MYSQLI_ASSOC);

            if (empty($GezochtenContact)) {
                $noResultsMessage = 'Geen resultaten gevonden voor Contactpersonen.';
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Zoekresultaten</title>
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
            <?php if (isset($_POST['submit']) && (!empty($GezochtenGebruiker) || !empty($GezochtenContact))) : ?>
                <section class="section section4">
                    <h2>Zoekresultaten</h2>
                    <?php if (!empty($GezochtenGebruiker)) : ?>
                        <h3>Gevonden Gebruikers</h3>
                        <div class="table-wrapper">
                            <table class="table">
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
                                    <?php foreach ($GezochtenGebruiker as $Gebruiker) : ?>
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
                    <?php endif; ?>


                    <h3>Gevonden Contact Personen</h3>
                    <div class="table-wrapper">
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
                                <?php foreach ($GezochtenContact as $Contact) : ?>
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
                    </div>

                </section>
                <div class="go-back-button">
                    <a href="overzicht.php">Ga terug</a>
                </div>
            <?php else : ?>
                <section class="section section4">
                    <h2>Zoekresultaten</h2>
                 
                        <h3>Gevonden Contacten</h3>
                        <div class="table-wrapper">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td><?php echo $noResultsMessage; ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
            </section>
            <div class="go-back-button">
                    <a href="overzicht.php">Ga terug</a>
                </div>
                    <?php endif; ?>
      

        </div>
    </div>
</body>

</html>