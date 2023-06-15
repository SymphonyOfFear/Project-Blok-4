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


  if (!isset($userData['role']) || $userData['role'] !== 'administrator') {
    header("Location: overzicht.php");
    exit;
  }






  $sql = "SELECT * FROM Gebruiker";
  $result = mysqli_query($conn, $sql);
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
    <div class="title-opdracht">
        <h1>Contact Personen</h1>
    </div>
    <div class="stripe">
        
    </div>
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
            <h2>User List</h2>
            <table class="user-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Voornaam</th>
                        <th>Tussenvoegsels</th>
                        <th>Achternaam</th>
                        
                        <th>Role</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php while ($data = mysqli_fetch_assoc($result)) : ?>
                    <tr>
                        <td>
                            <input type="text" name="voornaam" value="<?php echo $data['gebruikerID']; ?>" readonly>
                        </td>
                        <td>
                            <input type="text" name="voornaam" value="<?php echo $data['voornaam']; ?>" readonly>
                        </td>
                        <td>
                            <input type="text" name="voornaam" value="<?php echo $data['tussenvoegsels']; ?>" readonly>
                        </td>
                        <td>
                            <input type="text" name="voornaam" value="<?php echo $data['achternaam']; ?>" readonly>
                        </td>
                        <td>
                            <input type="text" name="role" value="<?php echo $data['role']; ?>" readonly>
                        </td>
                        <td>
                            <button class="action-button" type="submit" form="edit-form">Edit</button>
                            <button class="action-button" type="submit" form="delete-form">Delete</button>
                        </td>
                    </tr>
                
                    <?php endwhile; ?>
                </tbody>
            </table>

            <!-- Edit form -->
            <form id="edit-form" action="edit.php" method="POST">
                <input type="hidden" name="user_id" value="">
                <!-- Add more input fields for editing user data -->
            </form>

            <!-- Delete form -->
            <form id="delete-form" action="delete.php" method="POST">
                <input type="hidden" name="user_id" value="">
                <!-- Add more input fields for deleting user data -->
            </form>
        </div>
        <div class="dashboard-footer">

        </div>
    </div>

    <script src="js/script.js"></script>
</body>

</html>