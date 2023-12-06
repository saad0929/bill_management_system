<?php

include 'config.php';
session_start();

if(isset($_POST['submit'])){

   $email = $_POST['email'];
   $pass = $_POST['password'];
   $select = mysqli_query($conn, "SELECT * FROM `user_form` WHERE email = '$email' AND status='active'") or die('query failed');

   if(mysqli_num_rows($select))
   {
      $email_pass = mysqli_fetch_assoc($select);
      $db_pass = $email_pass['password'];
      $_SESSION['user_id'] = $email_pass['email'];
      $message[] = $email_pass['email'];
      // $pass_decode = password_verify($pass, $db_pass);
      if($pass == $db_pass){
         if($email_pass['role'] == "Admin"){
            header('location:admin_home.php');
         }else{
            header('location:home.php');
         }
      }else{
         $message[] = 'incorrect email or password!';
      }
   }else{
      $message[] = 'invalid email';
   }

   // if(mysqli_num_rows($select) > 0){
   //    $row = mysqli_fetch_assoc($select);
   //    $_SESSION['user_id'] = $row['id'];
   //    header('location:home.php');
   // }else{
   //    $message[] = 'incorrect email or password!';
   // }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>login</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<div class="form-container">

   <form action="" method="post" enctype="multipart/form-data">
      <div>
         <div>
            <img src="images/du.png" alt="DU Logo" height="100px" width="80px">
         </div>
         <div>
            <h3>Login Now</h3>
         </div>
      </div>
      <?php
      if(isset($message)){
         foreach($message as $message){
            echo '<div class="message">'.$message.'</div>';
         }
      }
      ?>
      <div class="message"><?php 

      if(isset($_SESSION['msg'])){
         echo $_SESSION['msg'];
         } 
       ?>
     </div>
      <input type="email" name="email" placeholder="enter email" class="box" required>
      <input type="password" name="password" placeholder="enter password" class="box" required>
      <input type="submit" name="submit" value="login now" class="btn">
      <p>Forgot your password don't worry.<a href="recover.php">click here</a></p>
      <p>don't have an account? <a href="register.php">register now</a></p>
   </form>

</div>

</body>
</html>