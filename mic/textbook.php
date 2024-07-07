<?php
session_start();
include 'conn.php'; // Include the database connection file

// Check if the user is logged in
if (!isset($_SESSION['user_name'])) {
    header('location:login.php');
    exit;
}

?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <style>
    
.floating-cart:hover{
scale: 1.8;
bottom: 40px;
right: 40px;
transition: 0.5s;
}
.floating-cart {
position: fixed;
bottom: 20px;
right: 20px;
z-index: 1000;
}
.floating-cart img {
display: block;
width: 50px;
height: 50px;
border-radius: 50%;
box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
background-color: #ffffff;
}
.book-container {
display: flex;
flex-wrap: wrap;
justify-content: center;
gap: 20px;
max-width: 1200px;
margin: 0 auto;
}
.book {
text-align: center;
width: calc(25% - 20px);
margin-bottom: 20px;
background-color: #fff;
border-radius: 8px;
box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
transition: transform 0.2s ease-in-out;
position: relative;
overflow: hidden;
}
.book:hover {
transform: scale(1.05);
}
.book img {
width: 100%;
height: auto;
border-top-left-radius: 8px;
border-top-right-radius: 8px;
}
.book-info {
position: absolute;
bottom: 0;
left: 0;
width: 100%;
background-color: rgba(255, 255, 255, 0.9);
padding: 10px;
text-align: left;
transition: transform 0.3s ease-in-out;
transform: translateY(0);
}
.book-title {
font-weight: bold;
font-size: 16px;
margin-bottom: 5px;
color: black;
}
.book-price {
color: #666;
font-size: 14px;
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
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Activity</title>
    <link rel="stylesheet" href="ha.css">
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

        <section id="students">
            <section class="section section-light">
                <div class="book-container">
                    <?php
                    $uid = $_SESSION['user_id'];
                    // Fetch books from the database
                    $query = "SELECT id, title, image, price FROM textB";
                    $result = mysqli_query($conn, $query);
                    if ($result) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<div class="book">';
                            echo '<img src="uploads/'.$row['image'].'" alt="'.$row['title'].'">';
                            echo '<div class="book-info">';
                            echo '<div class="book-title">'.$row['title'].'</div>';
                            echo '<div class="book-price">₱ '.$row['price'].'</div>';
                            echo '<form action="buy.php" method="POST">';
                            echo '<input type="hidden" name="book_id" value="'.$row['id'].'">';
                            echo '<button type="submit" class="back-btn">Add to Cart</button>';
                            echo '</form>';
                            echo '</div>'; // Close book-info div
                            echo '</div>'; // Close book div
                        }
                    } else {
                        echo 'Error fetching books from the database.';
                    }
                    ?>
                </div>
            </section>
        </section>
        
    </div>
    <!-- Floating Cart Button -->
    <div class="floating-cart">
        <a href="view_cart.php">
            <img src="carrr.png" alt="Cart" width="50" height="50">
        </a>
    </div>

</body>
</html>
