<?php
session_start();

require 'database.php';

// Check if the user is logged in
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


// Check if user data exists
if (!$userData) {
  die("User data not found for user ID: " . $userId);
}


?>

<!DOCTYPE html>
<html>

<head>
  <title>Instellingen</title>
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
  <div class="container">
    <h1 class="page-title">Instellingen</h1>

    <div class="tab-content" id="persoonlijke-info">
      <h2>Persoonlijke Informatie</h2>
      <form class="personal-info-form" action="update-settings.php" method="post">
        <label for="gebruikersnaam">Gebruikersnaam</label>
        <input type="text" id="gebruikersnaam" name="gebruikersnaam" value="<?php echo $userData['gebruikersnaam']; ?>">

        <label for="email">E-mail</label>
        <input type="email" id="email" name="email" value="<?php echo $userData['email']; ?>">

        <label for="wachtwoord">Wachtwoord</label>
        <input type="password" id="wachtwoord" name="wachtwoord" value="<?php echo $userData['wachtwoord']; ?>">

        <label for="voornaam">Voornaam</label>
        <input type="text" id="voornaam" name="voornaam" value="<?php echo $userData['voornaam'] ?>">

        <label for="tussenvoegsels">Tussenvoegsels</label>
        <input type="text" id="tussenvoegsels" name="tussenvoegsels" value="<?php echo $userData['tussenvoegsels']; ?>">

        <label for="achternaam">Achternaam</label>
        <input type="text" id="achternaam" name="achternaam" value="<?php echo $userData['achternaam']; ?>">

        <label for="geslacht">Geslacht</label>
        <select id="geslacht" name="geslacht">
          <option value="man" <?php if ($userData['geslacht'] === 'Man') echo 'selected'; ?>>Man</option>
          <option value="vrouw" <?php if ($userData['geslacht'] === 'Vrouw') echo 'selected'; ?>>Vrouw</option>
          <option value="anders" <?php if ($userData['geslacht'] === 'Anders') echo 'selected'; ?>>Anders</option>
        </select>

        <label for="straat">Straat</label>
        <input type="text" id="straat" name="straat" value="<?php echo $userData['straat']; ?>">

        <label for="postcode">Postcode</label>
        <input type="text" id="postcode" name="postcode" value="<?php echo $userData['postcode']; ?>">

        <label for="huisnummer">Huisnummer</label>
        <input type="text" id="huisnummer" name="huisnummer" value="<?php echo $userData['huisnummer']; ?>">

        <label for="plaats">Plaats</label>
        <input type="text" id="plaats" name="plaats" value="<?php echo $userData['plaats']; ?>">

        <label for="land">Land</label>
        <input type="text" id="land" name="land" value="<?php echo $userData['land']; ?>">

        <label for="telefoonnummer">Telefoonnummer</label>
        <input type="tel" id="telefoonnummer" name="telefoonnummer" value="<?php echo $userData['telefoonnummer']; ?>">

        <label for="mobielnummer">Mobielnummer</label>
        <input type="tel" id="mobielnummer" name="mobielnummer" value="<?php echo $userData['mobielnummer']; ?>">

        <input type="submit" value="Opslaan">
      </form>
    </div>
  </div>

  <script src="js/script.js"></script>

</body>

</html>