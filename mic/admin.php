<?php
session_start();
include 'conn.php'; // Include your database connection file

// Check if the user is logged in
if (!isset($_SESSION['user_name'])) {
    header('location: logen.php');
    exit;
}

$admin = $_SESSION['name'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="sadmin.css"> <!-- Replace with your CSS file -->
    <title>Admin Dashboard</title>
    <style>
        /* Add your custom styles here */
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }
        .navbar {
            background-color: #333;
            overflow: hidden;
        }
        .navbar a {
            float: left;
            display: block;
            color: #f2f2f2;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }
        .navbar a:hover {
            background-color: #ddd;
            color: black;
        }
        .container {
            padding: 20px;
        }
        .card {
            background-color: #fff;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .card h2 {
            margin-bottom: 10px;
        }
        .card p {
            color: #666;
        }
        .cards {
            display: flex;
            justify-content: space-between;
            gap: 20px; /* Adjust the gap between cards */
        }
        h1 {
            padding-left: 14px;
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="logo">
            <h1>Admin: <?php echo $admin ?></h1>
        </div>
        <div class="navbar-links">
            <a href="orders.php">Orders</a>
            <a href="textbook_uploads.php">Textbooks</a>
            <a href="logout.php">Logout</a>
        </div>
    </nav>

    <div class="container">
        <h1>Welcome, Admin!</h1>
        <div class="cards">
            <!-- Orders Card -->
            <div class="card">
                <h2>Orders</h2>
                <p>View and manage orders.</p>
                <a href="orders.php" class="button">View Orders</a>
            </div>
            
            <!-- Textbook Uploads Card -->
            <div class="card">
                <h2>Textbooks</h2>
                <p>Upload and manage textbooks.</p>
                <a href="textbook_uploads.php" class="button">Manage Textbooks</a>
            </div>
            
            <!-- Student Accounts Card -->
            <div class="card">
                <h2>Student Accounts</h2>
                <p>Manage student accounts.</p>
                <a href="manage_accounts.php" class="button">Manage Accounts</a>
            </div>
        </div>
    </div>

    <script src="script.js"></script> <!-- Include your JavaScript file -->
</body>
</html>
