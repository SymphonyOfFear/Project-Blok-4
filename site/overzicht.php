<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Overzicht</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Alumni+Sans:wght@200&family=Jost:wght@700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="navbar">
        <?php if (isset($_SESSION['isIngelogd']) && $_SESSION['isIngelogd'] === true): ?>
            <a>Overzicht 1</a>
            <a>Overzicht 2</a>
        <?php endif; ?>
        <div class="dropdown">
            <button class="account-btn" onclick="toggleDropdown()">Account</button>
            <div id="dropdown-content" class="dropdown-content">
                <?php if (isset($_SESSION['isIngelogd']) && $_SESSION['isIngelogd'] === true): ?>
                    <a href="#">Instellingen</a>
                    <a href="uitloggen.php">Uitloggen</a>
                <?php else: ?>
                    <a href="inloggen.php">Inloggen</a>
                    <a href="registreer-gebruiker.php">Registreren</a>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="content">
        <?php if (isset($_SESSION['login_message'])): ?>
            <h1><?php echo $_SESSION['login_message']; ?></h1>
            <?php unset($_SESSION['login_message']); ?>
        <?php endif; ?>

        <?php if (isset($_SESSION['isIngelogd']) && $_SESSION['isIngelogd'] === true): ?>
            <h1>Welkom op het overzichtspagina!</h1>
        <?php else: ?>
            <h1>Log in om het overzicht te bekijken</h1>
        <?php endif; ?>
    </div>

    <script src="js/script.js"></script>
</body>
</html>
