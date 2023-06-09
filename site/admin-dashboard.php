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
</head>

<body>
<div class="navbar">
  <a class="navbar-brand" href="#">Overzichten</a>
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
  

  <script src="js/script.js"></script>
</body>

</html>
