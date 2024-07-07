<?php
session_start();
include 'conn.php';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="logmen.css">
    <title>Login</title>
    <style>
        .inv{
            opacity: 0;
        }
    </style>
</head>
<body>
<div class="container" id="container">
    <div class="form-container sign-in">
        <form action="adlog.php" method="post">
            <?php if (isset($_GET['error'])) { ?>
                <p class="error"><?php echo $_GET['error']; ?></p>
            <?php } ?>
            <div class="name">
                <h2>Admin</h2><br><br>
            </div>

            <?php if (isset($_GET['success'])) { ?>
                <p class="success"><?php echo $_GET['success']; ?></p>
            <?php } ?>
            <label></label>
            <input type="text" name="uname" placeholder="User Name"><br>

            <label></label>
            <input type="password" name="password" placeholder="Password"><br>

            <button type="submit" class="button">Login</button>
            <a href=""><button type="button" class="back-btn">Back</button></a>
        </form>
    </div>

    <div class="toggle-container">
        <div class="toggle">
            <div class="toggle-panel toggle-left">
                <h1>Welcome Back!</h1>
                <p></p>
                <button class="hidden" id="login">Sign In</button>
            </div>
            <div class="toggle-panel toggle-right">
            <a href="logen.php"><button type="button" class="inv"></button></a>
                <h1>TNCHS</h1>
                <p>Tanza National Comprehensive High School</p>
            </div>
        </div>
    </div>
</div>
<script src="script.js"></script>
</body>
</html>


