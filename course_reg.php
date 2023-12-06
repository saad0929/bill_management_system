<?php
include 'config.php';

if(isset($_POST['submit'])){

   $cname = $_POST['cname'];
   $ccode = $_POST['ccode'];
   $cexam = $_POST['cexam'];
   $email = $_POST['email'];
   $labstatus = $_POST['labstatus'];
   $status = "false";

   $select = mysqli_query($conn, "SELECT * FROM `user_form` WHERE email = '$email'") or die('query failed 1');
   $result = mysqli_fetch_assoc($select);
   $teacher_id = $result['id'];
   echo $teacher_id ;   
   $insert = mysqli_query($conn, "INSERT INTO `courses` (cname, ccode, cenumber, labstatus, tid) VALUES ('$cname', '$ccode', '$cexam', '$labstatus', '$teacher_id')") or die('query failed 2');
    if ($insert) {
      $select1 = mysqli_query($conn,"SELECT * FROM `courses` WHERE tid = '$teacher_id'") or die('query failed1');
      $total= mysqli_num_rows($select1);
      mysqli_query($conn, "UPDATE user_form SET total_number_courses = '$total'");
      header('location:home.php');
    } else {
         $message[] = "Query Failed";
         header('location:course_reg.php');
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Course Registration</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<div class="form-container">

   <form action="#" method="post" enctype="multipart/form-data">
      <div>
         <div>
            <img src="images/du.png" alt="DU Logo" height="100px" width="80px">
         </div>
         <div>
            <h3>Register For New Course</h3>
         </div>
      </div>
      <?php
      if(isset($message)){
         foreach($message as $message){
            echo '<div class="message">'.$message.'</div>';
         }
      }
      ?>
      <div class="message">
    </div>
      <input type="text" name="cname" placeholder="enter course name" class="box" required>
      <input type="text" name="ccode" placeholder="enter course code" class="box" required>
      <input type="number" name="cexam" placeholder="enter number of exams" class="box" required>
      <input type="email" name="email" placeholder="enter email" class="box" required>
       <p>Lab Included? <input type="checkbox" name="labstatus" value="true"></p>
      <input type="submit" name="submit" value="Submit Form" class="btn">
   </form>

</div>

</body>
</html>