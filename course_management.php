<?php

include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];
if(!isset($user_id)){
   header('location:login.php');
};
if(isset($_GET['logout'])){
   unset($user_id);
   session_destroy();
   header('location:login.php');
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>home</title>


    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css" rel="stylesheet" >
    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/style1.css">

</head>
<body>

<div class="main_body">
   <div class="heading">
      <header>
         <div class="left_area"><a href="home.php" style="text-decoration:none;font-family: Time New Roman; "><h3 style="color: #1DC4E7;"><span>University </span>of Dhaka</h3></a> </div>
         <div class="right_area"><a href="home.php?logout=<?php echo $user_id; ?>" class="logout_btn">Logout</a></div> 

      </header>
   </div>

   <div class="sidebar">
      <a href="home.php"><i class="fas fa-user"></i><span>Personal Information</span></a>
      <a href="course_management.php" style="background-color:#3399ff;"><i class="fas fa-table"></i><span>Course Management</span></a>
      <a href="salary_management.php"><i class="fas fa-file"></i><span>Salary Management</span></a>
      
   </div>
   <div class="container1">

      <div class="profile1">
         <?php
            $select = mysqli_query($conn, "SELECT * FROM `user_form` WHERE email = '$user_id'") or die('query failed');
            if(mysqli_num_rows($select) > 0){
               $fetch = mysqli_fetch_assoc($select);
            }
            if($fetch['image'] == ''){
               echo '<img src="images/default-avatar.png">';
            }else{
               echo '<img src="uploaded_img/'.$fetch['image'].'">';
            }
         ?>
         <h3>Name : <?php echo $fetch['name']; ?></h3>
         <h3>Designation : <?php echo $fetch['designation']; ?></h3>
         <h3>Department : <?php echo $fetch['department']; ?></h3>
         <h3>Mobile Number : <?php echo $fetch['mobile']; ?></h3>
         <h3 style="display: inline-block;">Email : <h4 style="display: inline-block;"><?php echo $fetch['email']; ?></h4></h3>
         <a href="update_profile.php" class="btn">update personal info</a>
         
      </div>

   </div>
   

</div>



</body>
</html>


