<?php
session_start();
include 'conn.php'; // Include the database connection file

// Check if the user is logged in
if (!isset($_SESSION['user_name'])) {
    header('location: logout.php');
    exit;
}

// Insert orders into orders table
$uid = $_SESSION['user_id'];
$query = "SELECT textB, orderby, COUNT(cart.textB) AS total_quantity
          FROM cart
          WHERE orderby = $uid
          GROUP BY textB, orderby";

$result = mysqli_query($conn, $query);

if ($result) {
    // Start transaction
    mysqli_begin_transaction($conn);

    try {
        while ($row = mysqli_fetch_assoc($result)) {
            $textB = $row['textB'];
            $orderby = $row['orderby'];
            $quanty = $row['total_quantity'];

            // Insert into orders table
            $insert_query = "INSERT INTO orders (textB, orderby, quanti) VALUES ('$textB', '$orderby', '$quanty')";
            $insert_result = mysqli_query($conn, $insert_query);

            if (!$insert_result) {
                throw new Exception(mysqli_error($conn));
            }
        }

        // Clear the cart for the user
        $clear_cart_query = "DELETE FROM cart WHERE orderby = $uid";
        $clear_cart_result = mysqli_query($conn, $clear_cart_query);

        if (!$clear_cart_result) {
            throw new Exception(mysqli_error($conn));
        }

        // Commit the transaction
        mysqli_commit($conn);

        // Redirect or show success message
        header('location: textbook.php'); // Redirect to a success page
        exit();
    } catch (Exception $e) {
        // Rollback on error
        mysqli_rollback($conn);
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Error fetching cart items.";
}

mysqli_close($conn);
?>
