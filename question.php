<?php
include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];

if(isset($_POST['submit'])){
   $ename = $_POST['ename'];
   $byear = $_POST['byear'];
   $cname = $_POST['cname'];
   $qmfnumber = $_POST['qmfnumber'];
   $qmfnumberbdt = $_POST['qmfnumberbdt'];
   $qmhnumber = $_POST['qmhnumber'];
   $qmhnumberbdt = $_POST['qmhnumberbdt'];
   $avfnumber = $_POST['avfnumber'];
   $avfnumberbdt = $_POST['avfnumberbdt'];
   $avhnumber = $_POST['avhnumber'];  
   $avhnumberbdt = $_POST['avhnumberbdt'];
   $pecenter = $_POST['pecenter'];
   $penumber = $_POST['penumber'];
   $penumberbdt = $_POST['penumberbdt'];
   $vcenter = $_POST['vcenter'];
   $vnumber = $_POST['vnumber'];
   $vnumberbdt = $_POST['vnumberbdt'];
   $rmnumber = $_POST['rmnumber'];
   $rmnumberbdt = $_POST['rmnumberbdt'];
   $irnumber = $_POST['irnumber'];
   $irnumberbdt = $_POST['irnumberbdt'];
   $oamount = $_POST['oamount'];
   $select = mysqli_query($conn, "SELECT * FROM `user_form` WHERE email = '$user_id'") or die('query failed 1');
   $result = mysqli_fetch_assoc($select);
   $teacher_id = $result['id'];
   echo $teacher_id ;   
   $insert = mysqli_query($conn, "INSERT INTO `bill_management` (bmid,ename,byear,cname,qmfnumber,qmfnumberbdt,qmhnumber,qmhnumberbdt,avfnumber,avfnumberbdt,avhnumber,avhnumberbdt,pecenter,penumber,penumberbdt,vcenter,vnumber,vnumberbdt,rmnumber,rmnumberbdt,irnumber,irnumberbdt,oamount	) VALUES ('$teacher_id','$ename','$byear','$cname','$qmfnumber','$qmfnumberbdt','$qmhnumber','$qmhnumberbdt','$avfnumber','$avfnumberbdt','$avhnumber','$avhnumberbdt','$pecenter','$penumber','$penumberbdt','$vcenter','$vnumber','$vnumberbdt','$rmnumber','$rmnumberbdt','$irnumber','$irnumberbdt'	,'$oamount'	)") or die('query failed 2');
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
   <form style="width: auto" action="#" method="post" enctype="multipart/form-data">
      <div>
         <div>
            <img src="images/du.png" alt="DU Logo" height="100px" width="80px">
         </div>
         <div>
            <h3>Form for Bill management</h3>
         </div>
      </div>
      <div class="flex">
         <input type="text" name="ename" placeholder="enter exam name" class="box" required>
         <input type="text" name="byear" placeholder="enter year of exam" class="box" required>
         <input type="text" name="cname" placeholder="enter course name" class="box" required>
         <p>Bill for Question Making</p>
         <div style="display: flex; flex-direction: row; gap:15px">
            <input type="number" name="qmfnumber" placeholder="enter number of full question" class="box" required>
            <input type="number" name="qmhnumberbdt" placeholder="enter amount for full question" class="box" required>
         </div>
         <div style="display: flex; flex-direction: row; gap:15px">
            <input type="number" name="qmhnumber" placeholder="enter number of half question" class="box" required>
            <input type="number" name="qmhnumberbdt" placeholder="enter amount for half question" class="box" required>
         </div>
         <p>Bill for Answershit Evaluation</p>
         <div style="display: flex; flex-direction: row; gap:15px">
            <input type="number" name="avfnumber" placeholder="enter number of full answershit evaluation" class="box" required>
            <input type="number" name="avfnumberbdt" placeholder="enter amount for full question" class="box" required>
         </div>
         <div style="display: flex; flex-direction: row; gap:15px">
            <input type="number" name="avhnumber" placeholder="enter number of half answershit evaluation" class="box" required>
            <input type="number" name="avhnumberbdt" placeholder="enter amount for half question" class="box" required>
         </div>
         <p>Bill for Practical Exam</p>
         <input type="text" name="pecenter" placeholder="enter name of center" class="box" required>
         <input type="number" name="penumber" placeholder="enter number of students" class="box" required>
         <input type="number" name="penumberbdt" placeholder="enter amount for per students" class="box" required>
         <p>Bill for Viva</p>
         <input type="text" name="vcenter" placeholder="enter name of center" class="box" required>
         <div style="display: flex; flex-direction: row; gap:15px">
            <input type="number" name="vnumber" placeholder="enter number of students" class="box" required>
            <input type="number" name="vnumberbdt" placeholder="enter amount for per students" class="box" required>
         </div>
         <p>Bill for Result Making</p>
         <div style="display: flex; flex-direction: row; gap:15px"> 
            <input type="number" name="rmnumber" placeholder="enter number of students" class="box" required>
            <input type="number" name="rmnumberbdt" placeholder="enter amount for per students" class="box" required>
         </div>
         <p>Bill for Inspection of Result </p>
        <div style="display: flex; flex-direction: row; gap:15px">
            <input type="number" name="irnumber" placeholder="enter number of students" class="box" required>
            <input type="number" name="irnumberbdt" placeholder="enter amount for per students" class="box" required>
        </div>
         <p>Others</p>
         <input type="number" name="oamount" placeholder="enter amount" class="box" required>
         <input type="submit" name="submit" value="Submit Form" class="btn">
      </div>
   </form>

</div>

</body>
</html>
