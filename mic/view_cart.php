<?php
session_start();
include 'conn.php'; // Include the database connection file

// Check if the user is logged in
if (!isset($_SESSION['user_name'])) {
    header('location:login.php');
    exit;
}

// Fetch cart items for the logged-in user
$uid = $_SESSION['user_id'];
$query = "SELECT textB.id AS item_id, textB.title AS item_title, textB.image AS item_image, COUNT(cart.textB) AS total_quantity
          FROM textB
          LEFT JOIN cart ON textB.id = cart.textB AND cart.orderby = $uid
          GROUP BY textB.id
          HAVING total_quantity > 0";

$result = mysqli_query($conn, $query);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="ha.css">
    <title>View Cart</title>
    <style>
        /* Your CSS styles for the cart page */
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 2em;
            padding: 0;
        }
        .cart-container {
            max-width: 800px;
            margin: 60px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .item {
            display: flex;
            align-items: center;
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }
        .item img {
            width: 100px;
            height: 100px;
            margin-right: 10px;
            object-fit: cover;
        }
        .item-details {
            flex: 1;
        }
        .item-name {
            font-weight: bold;
            font-size: 18px;
            margin-bottom: 5px;
        }
        .item-quantity {
            font-size: 14px;
            color: #666;
        }
        .total {
            font-size: 20px;
            font-weight: bold;
            margin-top: 20px;
            text-align: right;
        }
        .checkout-btn {
            display: block;
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            text-align: center;
            background-color: #4CAF50;
            color: #fff;
            text-decoration: none;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .checkout-btn:hover {
            background-color: #45a049;
        }
        .back-btn {
            display: block;
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            text-align: center;
            background-color: #ad0000;
            color: #fff;
            text-decoration: none;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .back-btn:hover {
            background-color: #860000;
        }
        h2, p{
            color: black;
        }
    </style>
</head>
<body>
<div class="navbar-links">
        
        <section id="home">
    <header>
        <div class="huh">
            <nav>
           
        </div>
        </nav>
        
        <div class="logsi">
           
            <img src="./potos.png" id="leftCloud" alt="">
        <a href="#home" class="logsi"></a>
    </div>
    <div class="logsu">
    <img src="./potos.png" id="mainCloud" alt="">
    </div>
        <div class="logs">
        <a href="#home" class="logo"></a>
    </div>
   
    <div class="head">
        <div class="hev">
        <nav>
            <div class="dropdowns">
                <div class="p">
                  <button class="dropbtns"><a href="home.php">HOME</a>
                    <i class="fa fa-caret-down"></i>
                  </button>
                  <div class="dropdowns-content">
                    <div class="dropdowns-content-sub">
                        <a href="#">STUDENTS&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;></a>
                         
                        <div class="dropdowns-content-sub-sub">
                          
                         
                      <div class="dropdowns-content-subs">
                            <a href="home.php#cors">STRANDS</a>
                           
                          
                        </div>

                        
                        <div class="dropdowns-content-subss">
                    
                        <a href="home.php#textbook">ORDER TEXTBOOKS </a>
                        
                            
                        
                        
                          </div>
                    </div>
                      </div>
                    </a>
                    
                    
                    
                    <a href="home.php#alumni">ALUMNI</a>
                    <a href="home.php#visit">VISIT</a>
                    
                      <div class="dropdowns-content-sub">
                        <a href="#">ACADEMICS&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;></a>
                         
                        <div class="dropdowns-content-sub-sub">
                          
                         
                      <div class="dropdowns-content-subs">
                            <a href="home.php#acads">ACADEMIC DEPARTMENTS</a>
                           
                          
                        </div>

                        
                        <div class="dropdowns-content-subss">
                        <a href="#">CURRICULUM</a>
                        <div class="dropdowns-content-sub-subss">
                            <a href="home.php#catalog">COURSE CATALOG</a>
                           
                            
                        
                        </div>   
                          </div>
                    </div>
                      </div>
                    </a>
                    
                    <a href="home.php#studentlife">STUDENT LIFE</a>
                    <a href="#">ABOUT US</a>
                  </div>
                </div> 
              </div>


  
  <div class="dropdown">
    <div class="p">

<i class="fa fa-caret-down"></i>
</button>
<div class="dropdown-content">
<a href="#cors">STRANDS</a>
<a href="logun.php">ORDER TEXTBOOKS</a>
</div>
</div> 
</div>
       
            
           
           <a href="home.php#contact">PARENTS<span></span></a> 
           
           <a href="home.php#contact">NEWS<span></span></a> 
           <div class="iconic">
           <img src="iconic.png" alt=""  width="40" height="40">
</div>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<div class="dropdowns">
            
           <div class="p">
           <?php

include 'conn.php';

$name =  $_SESSION['user_name'];

if ($name == true) {
	
}else{
	header('location:login.php');
}


echo "<span style='margin-top: -41.7px; margin-left: 40px; font-size:20px; font-weight:bold; color:#000'>".$_SESSION['user_name']."</span>";
 


 
 if (isset($_POST['submit'])) {
 	
 	session_destroy();
 	header('location:login.php');
 }



?>
                    <i class="fa fa-caret-down"></i>
                  </button>
                  <div class="dropdowns-content">
                    <div class="dropdowns-content-sub">
                        <a href="logout.php">LOGOUT&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;></a>
          
           
        </div>
          
           
        </div>
        </nav>
        
</div>
</div>
        </div>
        
        </div>
      
    </header>
</section>
    <div class="cart-container">
        <h2>Your Shopping Cart</h2>
        <?php
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <div class="item">
                    <img src="<?php echo 'uploads/'. $row['item_image']; ?>" alt="<?php echo $row['item_title']; ?>">
                    <div class="item-details">
                        <div class="item-name"><?php echo $row['item_title']; ?></div>
                        <div class="item-quantity">Quantity: <?php echo $row['total_quantity']; ?></div>
                    </div>
                </div>
                <?php
            }
        } else {
            echo '<p>Your cart is empty.</p>';
        }
        ?>

        <a href="checkout.php" class="checkout-btn">Proceed to Checkout</a>
        <a href="textbook.php" class="back-btn">Back</a>
    </div>
</body>
</html>
