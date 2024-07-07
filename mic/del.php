<?php
session_start();
include 'conn.php'; // Include your database connection file

// Check if the user is logged in
if (!isset($_SESSION['user_name'])) {
    header('location: login.php');
    exit;
}

// Check if 'id' parameter exists and is valid
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    // Select the item to get the image filename if needed
    $query_select = "SELECT image FROM textB WHERE id = '$id'";
    $result_select = mysqli_query($conn, $query_select);

    if (mysqli_num_rows($result_select) > 0) {
        $row = mysqli_fetch_assoc($result_select);
        $image = $row['image'];

        // Delete item from database
        $query_delete = "DELETE FROM textB WHERE id = '$id'";
        if (mysqli_query($conn, $query_delete)) {
            // Optionally, delete the associated image file from server
            $targetFilePath = 'uploads/' . $image;
            if (file_exists($targetFilePath)) {
                unlink($targetFilePath); // Delete the file
            }

            header('location: textbook_uploads.php?success=ItemDeleted');
            exit;
        } else {
            header('location: textbook_uploads.php?error=SQLExecutionError');
            exit;
        }
    } else {
        header('location: textbook_uploads.php?error=ItemNotFound');
        exit;
    }
} else {
    // Redirect if 'id' parameter is missing or invalid
    header('location: textbook_uploads.php?error=InvalidID');
    exit;
}
?>
