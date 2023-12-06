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
    <link rel="stylesheet" href="css/custom.css">

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
      <a href="course_management.php" ><i class="fas fa-table"></i><span>Course Management</span></a>
      <a href="salary_management.php" style="background-color:#3399ff;"><i class="fas fa-file"></i><span>Salary Management</span></a>
      
   </div>
   <div class="newContent">
      <button class="button" onclick="redirectToUpdatePage()">Add More Bill for Question</button>
      <script>
          function redirectToUpdatePage() {
               window.location.href = "question.php";
         }
      </script>
      <div class="tableContainer">
         <table class="table">
         <caption style="border: 3px solid black;">Bill for Question Making</caption>
         <thead>
            <tr>
               <td>
                  Exam Name
               </td>
               <td> 
                  Year
               </td>
               <td>
                  Course Name
               </td>
               <td> 
                  Amount
               </td>

            </tr>
         </thead>
      </table>
      </div>
   </div>
   

</div>



</body>
</html>


