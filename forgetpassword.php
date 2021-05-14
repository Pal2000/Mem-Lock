<?php
session_start();
include("connection.php");
include("functions.php");
// error_reporting(0);
?>


<html>
<head>
  <link rel="stylesheet" href="css/signupstyle.css">
  <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <!-- <link rel="stylesheet" href="css/style.css"> -->
  <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
  <title>Mem-Lock</title>
</head>

<body>
<div>

  <div class="main">
    <p class="sign" align="center">Change Password</p>
    <form class="form1" method="POST">
            <input type="email"  name="email" placeholder="Email" class="un"><br><br>
            <input type="password" name="newpass" placeholder="New Password" class="un change"><br><br>
            <input type="password" name="conpass" placeholder="Confirm Password" class="un change"><br><br>
            <input type="submit" class="save-btn" value="Save" name="Submit">
    </form>         
  </div>
</div>
</body>

</html>
<?php


if($_POST['Submit']){
  $email=$_POST['email'];
  $upnewpassword=$_POST['newpass'];
  $conpassword=$_POST['conpass'];

  if(empty($email) || empty($upnewpassword) || empty($conpassword)){
      echo "<script> alert('All fields are required!!') </script>";
  }
  else{
    $query2="select * from users where email='$email' limit 1";
    $result=mysqli_query($con, $query2);
    
    if($result && mysqli_num_rows($result)>0){
      $user_data=mysqli_fetch_assoc($result);
      $uid=$user_data['id'];
      if($upnewpassword!=$conpassword){
        echo "<script> alert('New Password and Confirm Password are not same'); </script>";
      }
      else if(!preg_match('/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[*.!@$%^&]).{6,7}$/',$upnewpassword )){
        $passErr= "Password should be of length 5-7 with atleast one Uppercase, Lowercase, Digit and special character";
        echo "<script> alert('".$passErr."')</script>";
      }

      else{
        $qe=$de=NULL;
        $qe = "update users set password='$upnewpassword' where id='$uid'";
        $de = mysqli_query($con, $qe);
        if($de){
          // echo '<script>alert("Password Changed")</script>';
          header("Location: login.php");
          die;
        }
        else{
          echo "<script>alert('Password Not Changed')</script>";
        }
      }
    }
    else{
      echo "<script> alert('Account doesnot exists') </script>";
    }
  }
}


?>