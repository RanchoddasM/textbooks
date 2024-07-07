<?php 
session_start(); 
include "conn.php";

if (isset($_POST['uname']) && isset($_POST['password'])) {

	function validate($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}

	$uname = validate($_POST['uname']);	
	$pass = validate($_POST['password']);

	if (empty($uname)) {
		header("Location: logun.php?error=User Name is required");
	    exit();
	}else if(empty($pass)){
        header("Location: logun.php?error=Password is required");
	    exit();
	}else{
        
		$sql = "SELECT * FROM `admins` WHERE `name`= '$uname' AND `pass` = '$pass'";

		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) === 1) {
			$row = mysqli_fetch_assoc($result);
            if ($row['name'] === $uname && $row['pass'] === $pass) {
            	$_SESSION['user_name'] = $row['name'];
				$_SESSION['user_id'] = $row['id'];
            	$_SESSION['name'] = $row['name'];
            	$_SESSION['id'] = $row['id'];
            	header("Location: admin.php");
		        exit();
            }else{
				header("Location: logen.php?error=Incorect User name or password");
		        exit();
			}
		}else{
			header("Location: logen.php?error=Incorect User name or password");
	        exit();
		}
	}
	 if (mysqli_num_rows($result) > 0) {
    // Verify the password using password_verify()
    if (password_verify($password, $row['password'])) {
      $_SESSION["login"] = true;
      $_SESSION["admin"] = $row["admin"];
      header("Location: home.php");
    } else {
      echo "<script> alert('Wrong Password'); </script>";
    }
  } else {
    echo "<script> alert('User Not Registered'); </script>";
  }
}else{
	header("Location: home.php");
	exit();
}