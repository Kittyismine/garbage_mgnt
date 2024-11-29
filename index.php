<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

require_once 'includes/db_connect.php';

$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM garbage_records WHERE user_id = $user_id";
$result = $conn->query($sql);

// Logout functionality
if (isset($_POST['logout'])) {
    session_unset();  // Remove all session variables
    session_destroy();  // Destroy the session
    header('Location: login.php');  // Redirect to login page
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Garbage Management System</title>
    <link rel="stylesheet" href="css/dashboard.css">
</head>
<body>
    <h2>Welcome to Garbage Management System</h2>
    <a href="manage_garbage.php">Manage Garbage</a>

    <!-- Logout Button -->
    <form method="POST" action="index.php" style="display:inline;">
        <button type="submit" name="logout" style="padding: 10px 20px; background-color: red; color: white; border: none; cursor: pointer;">
            Logout
        </button>
    </form>

    <!-- Cancel Button (Redirect to Homepage or Previous Page) -->
    <form method="POST" action="index.php" style="display:inline;">
    </form>

    <h3>Your Garbage Records</h3>
    <table>
        <tr>
            <th>Location</th>
            <th>Garbage Type</th>
            <th>Status</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['location']; ?></td>
            <td><?php echo $row['garbage_type']; ?></td>
            <td><?php echo $row['status']; ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
