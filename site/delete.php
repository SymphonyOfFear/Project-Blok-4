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
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Alumni+Sans:wght@200&family=Jost:wght@700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>

<body>
    <div class="dashboard">
        <div class="dashboard-header">
            <h1>Admin Dashboard</h1>
        </div>
        <div class="dashboard-menu">
            <?php if (isset($userData['role']) && $userData['role'] == 'administrator') : ?>
                <div class="dashboard-menu-item">
                    <a href="overzicht.php">Overzichten</a>
                </div>
                <div class="dashboard-menu-item">
                    <a href="contact-persoon-toevoegen.php">Contact Persoon Toevoegen</a>
                </div>
                <div class="dashboard-menu-item">
                    <a href="admin-dashboard.php">Admin Panel</a>
                </div>

            <?php elseif (isset($userData['role']) && $userData['role'] == "manager") : ?>
                <div class="dashboard-menu-item">
                    <a href="overzicht.php">Overzichten</a>
                </div>
                <div class="dashboard-menu-item">
                    <a href="contact-persoon-toevoegen.php">Contact Persoon Toevoegen</a>
                </div>
            <?php else : ?>
                <div class="dashboard-menu-item">
                    <a href="overzicht.php">Overzichten</a>
                </div>
            <?php endif; ?>
        </div>

        <div class="dashboard-content">
            <h2>Delete User</h2>
            <!-- Add your form fields for deleting user data here -->
        </div>
        <div class="dashboard-footer">

        </div>
    </div>

    <script src="js/script.js"></script>
</body>

</html>