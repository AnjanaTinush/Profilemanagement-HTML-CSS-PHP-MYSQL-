<?php

include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
   exit(); // Stop further script execution after redirection
}

if(isset($_GET['logout'])){
   unset($user_id);
   session_destroy();
   header('location:login.php');
   exit(); // Stop further script execution after redirection
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>home</title>

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/profile.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>
<body>
<header>
        <div class="header-left">
                <img src="images/companylogo.jpg" alt="Company Logo" id="companyLogo">
            </div>
        </div>
        <div class="header-right">
            <a href="#"><i class="Home"></i> Home</a>
            <a href="order.html"><i class="Products"></i> Products</a>
            <a href="#"><i class="Service"></i> Service</a>
            <a href="#"><i class="About US"></i> About Us</a>
            <a href="#"><i class="Contact Us"></i> Contact Us</a>
            <a href="#"><i class="fas fa-user"></i>My Account</a>
            <a href="#"><i class="fas fa-shopping-cart"></i>(1)</a>
            <input type="text" placeholder="Search...">
         </div>
    </header>

    <div class="background-blur"></div>
    <main>
        <aside>
            <div class="profile-picture">
                <label for="profile-upload" class="profile-upload-lable">
                <?php
         $select = mysqli_query($conn, "SELECT * FROM `users` WHERE id = '$user_id'") or die('query failed');
         if(mysqli_num_rows($select) > 0){
            $fetch = mysqli_fetch_assoc($select);
         }
         if($fetch['image'] == ''){
            echo '<img src="images/default-avatar.png">';
         }else{
            echo '<img src="uploaded_img/'.$fetch['image'].'">';
         }
      ?>
                </label>
                <input type="file" id="upload-pic" style="display: none;">
                
                <a href="profile.php?logout" class="upload-btn">logout</a>
            </div>
            <h1><b>My Account</b></h1>
            <ul>
                <li><a href="#" class="active"><i class="fas fa-user"></i> My Details</a></li>
                <li><a href="#"><i class="fas fa-map-marker-alt"></i> My Address Book</a></li>
                <li><a href="#"><i class="fas fa-box"></i> My Orders</a></li>
                <li><a href="#"><i class="fas fa-envelope"></i> My Newsletters</a></li>
                <li><a href="#"><i class="fas fa-cog"></i> Account Settings</a></li>
                <li><a href="#"><i class="fas fa-history"></i> Purchase History</a></li>
                <li><a href="#"><i class="fas fa-heart"></i> Wishlist</a></li>
                <li><a href="#"><i class="fas fa-credit-card"></i> Payment Methods</a></li>
                <li><a href="#"><i class="fas fa-star"></i> Loyalty Points</a></li>
            </ul>
        </aside>

        <div class="container">
            
            <section class="personal-info">
                <h2>Personal Information</h2>
                <div class="personal-info-container">
                    <div class="info-group">
                        <label>Full Name:</label>
                        <span id="fullname-display"><?php echo $fetch['fullname']; ?></span>
                        <input type="text" id="fullname-input"  style="display: none;">
                    </div>
                    <div class="info-group">
                        <label>Email:</label>
                        <span id="email-display"><?php echo $fetch['email']; ?></span>
                        <input type="email" id="email-input"  style="display: none;">
                    </div>
                    <div class="info-group">
                        <label>Phone :</label>
                        <span id="phone-display"><?php echo $fetch['phone']; ?></span>
                        <input type="tel" id="phone-input"  style="display: none;">
                    </div>
                    <div class="info-group">
                        <label>Address:</label>
                        <span id="address-display"><?php echo $fetch['address']; ?></span>
                        <input type="text" id="address-input"  style="display: none;">
                    </div>
                    <div class="info-group">
                        <label>Username:</label>
                        <span id="username-display"><?php echo $fetch['username']; ?></span>
                        <input type="text" id="username-input"  style="display: none;">
                    </div>
                    
                    <button  type="Edit" class="edit-btn"><a href="update_profile.php" class="update-btn">Edit</a></button>
                </div>
            </section>
            
            <section class="purchase-history">
                <h2>Purchase History</h2>
                <div class="order-item">
                    <p><strong>Order #12345</strong> - 01/08/2024 - Rs. 150.00 </p>
                    <div class="order-actions">
                        <a href="#" class="view-order"><i class="fas fa-eye"></i> View Order</a>
                        <a href="#" class="reorder"><i class="fas fa-redo"></i> Reorder</a>
                        <a href="#" class="download-invoice"><i class="fas fa-file-download"></i> Download Invoice</a>
                    </div>
                </div>
            </section>

            
        </div>
    </main>

    <script src="profile.js"></script>
    <footer>
        <div class="footer-content">
            <div class="about-us">
                <h3>About Us</h3>
                <p>Rice Lander offers an unparalleled premium experience, providing top-quality paddy products directly from the heart of our fields. With a focus on excellence and customer satisfaction, our island-wide services are tailored to meet all your rice-related needs.</p>
            </div>
            <div class="contact-details">
                <h3>Contact Us</h3>
                <p>Email: info@ricelander.com</p>
                <p>Phone: 011-1122856</p>
                <p>Address: 123 Luxury St., Wellawatte, Colombo,Srilanka</p>
            </div>
            <div class="map">
                <h3>Our Location</h3>
                <iframe src="https://www.google.com/maps/embed?..." width="300" height="200" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2024 Rice Lander. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
