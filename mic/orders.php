<?php
session_start();
include 'conn.php'; // Include your database connection file

// Check if the user is logged in
if (!isset($_SESSION['user_name'])) {
    header('location: login.php');
    exit;
}

$admin = $_SESSION['user_name']; // Assuming 'user_name' holds the admin's name

// Fetch all orders with joins to textB and users tables
$query_orders = "SELECT orders.id AS order_id, textB.title AS book_title, users.user_name AS ordered_by, orders.quanti AS quantity
                 FROM orders
                 JOIN textB ON orders.textB = textB.id
                 JOIN users ON orders.orderby = users.id";
$result_orders = mysqli_query($conn, $query_orders);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="admin.css"> <!-- Replace with your CSS file -->
    <title>Orders Management</title>
    <style>
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
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table th, table td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        table th {
            background-color: #f2f2f2;
        }
        table tr:hover {
            background-color: #f5f5f5;
        }
        .actions a {
            margin-right: 10px;
            text-decoration: none;
            color: #007bff;
        }
        .actions a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="logo">
            <h1>Admin: <?php echo $admin ?></h1>
        </div>
        <div class="navbar-links">
            <a href="admin.php">Dashboard</a>
            <a href="textbook_uploads.php">Textbook Uploads</a>
            <a href="logout.php">Logout</a>
        </div>
    </nav>

    <div class="container">
        <h1>Manage Orders</h1>
        <div class="card">
            <h2>Orders</h2>
            <p>View and manage orders.</p>

            <!-- Display all orders -->
            <table>
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Ordered By</th>
                        <th>Book Title</th>
                        <th>Quantity</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (mysqli_num_rows($result_orders) > 0) {
                        while ($row = mysqli_fetch_assoc($result_orders)) {
                            echo "<tr>";
                            echo "<td>{$row['order_id']}</td>";
                            echo "<td>{$row['ordered_by']}</td>";
                            echo "<td>{$row['book_title']}</td>";
                            echo "<td>{$row['quantity']}</td>";
                            echo "<td class='actions'>
                                      <a href='#'><button>Approved</button></a>
                                      <a href='#'>Delete</a>
                                  </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>No orders found.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="script.js"></script> <!-- Include your JavaScript file -->
</body>
</html>
