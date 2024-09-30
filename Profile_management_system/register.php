<?php

include 'config.php';

if(isset($_POST['submit'])){

   $fname = mysqli_real_escape_string($conn, $_POST['fullname']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $phon = mysqli_real_escape_string($conn, $_POST['phone']);
   $add = mysqli_real_escape_string($conn, $_POST['address']);
   $uname = mysqli_real_escape_string($conn, $_POST['username']);
   $pass = mysqli_real_escape_string($conn, md5($_POST['password']));
   $cpass = mysqli_real_escape_string($conn, md5($_POST['cpassword']));
   $image = $_FILES['image']['name'];
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = 'uploaded_img/'.$image;

   $select = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email' AND password = '$pass'") or die('query failed');

   if(mysqli_num_rows($select) > 0){
      $message[] = 'user already exist'; 
   }else{
      if($pass != $cpass){
         $message[] = 'confirm password not matched!';
      }elseif($image_size > 2000000){
         $message[] = 'image size is too large!';
      }else{
         $insert = mysqli_query($conn, "INSERT INTO `users`(fullname, email,phone,address,username, password, image) VALUES('$fname', '$email','$phon','$add','$uname', '$pass', '$image')") or die('query failed');

         if($insert){
            move_uploaded_file($image_tmp_name, $image_folder);
            $message[] = 'registered successfully!';
            header('location:login.php');
         }else{
            $message[] = 'registeration failed!';
         }
      }
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <title>Join Us</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="css/register.css">
   <!-- custom css file link  -->
   

</head>
<body>
   
<div class="container">
        <div class="image-container">
            <img src="images/join1.jpg" alt="Signup Image">
        </div>
        <div class="form-container">
            <h1>Join Us</h1>

   <form action="" method="post" enctype="multipart/form-data" id="signupForm">
     
      <?php
      if(isset($message)){
         foreach($message as $message){
            echo '<div class="message">'.$message.'</div>';
         }
      }
      ?>
     <label for="fullName">Full Name</label>
      <input type="text" name="fullname" placeholder="enter username"  required>
      <label for="email">Email</label>
      <input type="email" name="email" placeholder="enter email"  required>
      <label for="phone">Phone Number</label>
      <input type="tel" name="phone" placeholder="enter phone" required>
      <label for="address">Address</label>
      <input type="text" name="address" placeholder="enter address"  required>
      <label for="username">Username</label>
      <input type="text" name="username" placeholder="enter username"  required>
      <label for="password">Password</label>
      <input type="password" name="password" placeholder="enter password"  required>
      <label for="confirmPassword">Confirm Password</label>
      <input type="password" name="cpassword" placeholder="confirm password"  required>
      <label for="confirmPassword">Profile image</label>
      <input type="file" name="image"  accept="image/jpg, image/jpeg, image/png">
      <div class="button-container">
      <input type="submit" name="submit" value="register now" class="btn">
      </div>
     
   </form>

   <div class="login">
                <p>Already have an account? <a href="login.php"><strong>Login</strong></a></p>
            </div>
            
                
            <hr>

            <button class="social-btn facebook"><i class="fab fa-facebook-f"></i> Signup with Facebook</button> 
            <button class="social-btn google"><i class="fab fa-google"></i> Signup with Google</button>
        </div>
    </div>
        <script src="signup.js"></script>

</body>
</html>