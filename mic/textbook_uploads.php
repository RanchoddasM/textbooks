<?php
session_start();
include 'conn.php'; // Include your database connection file

// Check if the user is logged in
if (!isset($_SESSION['user_name'])) {
    header('location: login.php');
    exit;
}

$admin = $_SESSION['name'];

// Fetch all items from textB table
$query_items = "SELECT * FROM textB";
$result_items = mysqli_query($conn, $query_items);

// Handle form submission for adding an item
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $price = $_POST['price'];

    // File upload handling for image
    $targetDir = "uploads/"; // Directory where uploaded images will be stored
    $image = basename($_FILES["image"]["name"]);
    $targetFilePath = $targetDir . $image;
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if($check !== false) {
        // Allow certain file formats
        $allowTypes = array('jpg','jpeg','png','gif');
        if(in_array($fileType, $allowTypes)){
            // Upload file to server
            if(move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)){
                // Insert item into textB table with image filename
                $query_insert = "INSERT INTO textB (title, image, price) VALUES ('$title', '$image', '$price')";
                if (mysqli_query($conn, $query_insert)) {
                    header('location: textbook_uploads.php?success=ItemAdded');
                    exit;
                } else {
                    header('location: textbook_uploads.php?error=SQLExecutionError');
                    exit;
                }
            } else {
                header('location: textbook_uploads.php?error=FileUploadError');
                exit;
            }
        } else {
            header('location: textbook_uploads.php?error=InvalidFileType');
            exit;
        }
    } else {
        header('location: textbook_uploads.php?error=FileNotAnImage');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="admin.css"> <!-- Replace with your CSS file -->
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
        .add-button-container {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            margin-bottom: 10px;
        }
        .add-button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
        }
        .add-button:hover {
            background-color: #45a049;
        }
        table {
            width: 100%;
            border-collapse: collapse;
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
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0,0,0);
            background-color: rgba(0,0,0,0.4);
            padding-top: 60px;
        }
        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 600px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
            position: relative;
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
        .modal-body {
            padding: 10px;
        }
        .form-group {
            margin-bottom: 10px;
        }
        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .form-group input {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .form-group input[type="file"] {
            padding: 5px;
        }
        .form-group input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 10px;
        }
        .form-group input[type="submit"]:hover {
            background-color: #45a049;
        }
        h1{
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
            <a href="admin.php">Dashboard</a>
            <a href="orders.php">Orders</a>
            <a href="logout.php">Logout</a>
        </div>
    </nav>

    <div class="container">
        <section id="textbooks" class="card">
        <h3 style="margin: 0;">Textbooks</h3>
            <div class="add-button-container">
                <button onclick="openModal()" class="add-button">Add Item</button>
            </div>

            <!-- Display all items from textB table -->
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Image</th>
                        <th>Price</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (mysqli_num_rows($result_items) > 0) {
                        while ($row = mysqli_fetch_assoc($result_items)) {
                            echo "<tr>";
                            echo "<td>{$row['id']}</td>";
                            echo "<td>{$row['title']}</td>";
                            echo "<td><img src='uploads/{$row['image']}' width='100' height='100'></td>";
                            echo "<td>₱ {$row['price']}.00</td>";
                            echo "<td>";
                            echo "<a href='del.php?id={$row['id']}' onclick='return confirm(\"Are you sure you want to delete this item?\");'>Delete</a>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>No items found.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </section>
    </div>

    <!-- Modal for adding an item -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <div class="modal-body">
                <h2>Add New Item</h2>
                <form id="addItemForm" action="textbook_uploads.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="title">Title:</label>
                        <input type="text" id="title" name="title" required>
                    </div>
                    <div class="form-group">
                        <label for="image">Image:</label>
                        <input type="file" id="image" name="image" accept="image/*" required>
                    </div>
                    <div class="form-group">
                        <label for="price">Price:</label>
                        <input type="number" id="price" name="price" step="0.01" required>
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Add Item">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Get the modal
        var modal = document.getElementById("myModal");

        // Function to open the modal
        function openModal() {
            modal.style.display = "block";
        }

        // Function to close the modal
        function closeModal() {
            modal.style.display = "none";
            document.getElementById("addItemForm").reset(); // Reset form fields
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                closeModal();
            }
        }
    </script>
</body>
</html>
