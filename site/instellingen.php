<?php session_start();?>

<!DOCTYPE html>
<html>
<head>
    <title>Login pagina</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="js/script.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Alumni+Sans:wght@200&family=Jost:wght@700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
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

    
</body>
</html>
