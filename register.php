<?php
session_start();
include 'config.php';

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $designation = mysqli_real_escape_string($conn, $_POST['designation']);
   $department = mysqli_real_escape_string($conn, $_POST['department']);
   $mobile = mysqli_real_escape_string($conn, $_POST['mobile']);
   $caddress = mysqli_real_escape_string($conn, $_POST['caddress']);
   $paddress = mysqli_real_escape_string($conn, $_POST['paddress']);
   $role ="user";
   $pass = mysqli_real_escape_string($conn, $_POST['password']);
   $cpass = mysqli_real_escape_string($conn, $_POST['cpassword']);
   $image = $_FILES['image']['name'];
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = 'uploaded_img/'.$image;


   $token = bin2hex(random_bytes(15));

   $select = mysqli_query($conn, "SELECT * FROM `user_form` WHERE email = '$email'") or die('query failed');

   if(mysqli_num_rows($select) > 0){
      $message[] = 'user already exist'; 
   }else{
      if($pass != $cpass){
         $message[] = 'confirm password not matched!';
      }elseif($image_size > 20000000){
         $message[] = 'image size is too large!';
      }else{
         $insert = mysqli_query($conn, "INSERT INTO `user_form`(name, email, mobile,designation,department,caddress,paddress, password, image,total_number_courses,token,role,status) VALUES('$name', '$email','$mobile','$designation','$department','$caddress','$paddress', '$pass', '$image',0,'$token','$role','inactive')") or die('query failed1');

         if($insert){
            $subject = "Account Activation Email";
            $body ="Hi $name. Click here to activate your account http://localhost/khalid/activation.php?token=$token";
            $header ="From:hasanurrahman864@gmail.com";
            if (mail($email, $subject, $body, $header)) {
               $_SESSION['msg'] = "Check mail to activate your account";
               move_uploaded_file($image_tmp_name, $image_folder);
               header('location:login.php');
            }
            else
            {
               $message[] = 'email sending failed';
               mysqli_query($conn, "DELETE FROM `user_form` WHERE email = '$email'") or die('query failed');
            }
         }else{
            $message[] = 'registeration failed!';
            mysqli_query($conn, "DELETE FROM `user_form` WHERE email = '$email'") or die('query failed');
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
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>register</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<div class="form-container">

   <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
      <div>
         <div>
            <img src="images/du.png" alt="DU Logo" height="100px" width="80px">
         </div>
         <div>
            <h3>Register Now</h3>
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
      <input type="text" name="name" placeholder="enter username" class="box" required>
      <input type="email" name="email" placeholder="enter email" class="box" required>
      <input type="designation" name="designation" placeholder="enter designation" class="box" required>
      <input type="department" name="department" placeholder="enter department" class="box" required>
      <input type="number" name="mobile" placeholder="enter mobile number" class="box" required>
      <input type="caddress" name="caddress" placeholder="enter current address" class="box" required>
      <input type="paddress" name="paddress" placeholder="enter permanent address" class="box" required>
      <input type="password" name="password" placeholder="enter password" class="box" required>
      <input type="password" name="cpassword" placeholder="confirm password" class="box" required>
      <input type="file" name="image" class="box" accept="image/jpg, image/jpeg, image/png">
      <input type="submit" name="submit" value="register now" class="btn">
      <p>already have an account? <a href="login.php">login now</a></p>
   </form>

</div>

</body>
</html>