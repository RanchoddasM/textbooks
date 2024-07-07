<?php
session_start();

include 'conn.php'; // Ensure you have your database connection set up properly

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['book_id'])) {
    // Retrieve book ID from form submission
    $book_id = $_POST['book_id'];

    // Retrieve user ID from session (assuming it's stored in $_SESSION['user_id'])
    if (!isset($_SESSION['user_id'])) {
        // Handle case where user ID is not set in session
        echo "User ID not found in session.";
        exit;
    }
    $user_id = $_SESSION['user_id'];

    // Insert into cart table
    $query = "INSERT INTO cart (orderby, textB) VALUES (?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $user_id, $book_id);

    if ($stmt->execute()) {
        // Redirect back to the previous page or a specific page
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    } else {
        // Handle insertion failure
        echo "Error adding item to cart: " . $conn->error;
    }
} else {
    // Handle other cases where $_POST['book_id'] is not set or not a POST request
    echo "Invalid request.";
}
?>
