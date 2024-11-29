<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once 'includes/db_connect.php';
    
    $location = $_POST['location'];
    $garbage_type = $_POST['garbage_type'];
    $user_id = $_SESSION['user_id'];
    
    $stmt = $conn->prepare("INSERT INTO garbage_records (user_id, location, garbage_type) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $user_id, $location, $garbage_type);
    $stmt->execute();
    
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Garbage - Garbage Management System</title>
    <link rel="stylesheet" href="css/manage_garbage.css">
</head>
<body>
    <form method="POST" action="manage_garbage.php">
    <h2>Manage Garbage</h2>
        <input type="text" name="location" placeholder="Location" required>
        <input type="text" name="garbage_type" placeholder="Garbage Type" required>
        <a href="index.php">Go to Dashboard</a>
        <button type="submit">Add Garbage Record</button>
    </form>
</body>
</html>
