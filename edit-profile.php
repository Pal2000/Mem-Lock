<?php

session_start();
 include("connection.php");
include("functions.php");
error_reporting(0);

$user_data=check_login($con);

$uid=$user_data['user_id'];
$username=$user_data['user_name'];
$name=$user_data['name'];
$phone=$user_data['phone'];
$email=$user_data['email'];
$pass=$user_data['password'];
$gen=$user_data['gender'];
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/edit-profile.css">
    <title>Mem-Lock</title>
</head>
<body>

<h3 class="home" style="margin-left:7%; margin-top:3%;"> <a href="home.php" style="color:rgb(235, 82, 82); text-decoration:none;">Home</a></h3>
    <div class="container">
        <h1> Profile</h1>
        <hr>
        <div class="personal-details">
            <h3 style="text-align: left; margin-left: 20px; padding-top: 2%;">Personal Details</h3>
            <div class="form-personal">
            <form method="POST" action="edit-profile.php" enctype="multipart/form-data">
                <span class="label">Name</span> <input type="text" name="name" placeholder="<?php echo $name; ?>" class="un"><br><br>
                <span class="label">Email</span> <input type="email"  name="email" placeholder="<?php echo $email; ?>" class="un"><br><br>
                <span class="label">Phone</span> <input type="phone" name="phone"  placeholder="<?php echo $phone; ?>" class="un"><br><br>
                <span class="label">Gender</span> <select class="un" align="center" name="gender" placeholder="<?php echo $gen; ?>" style="padding-left: 30%;">
                    <!-- <option disabled selected align="center"><?php //echo $gen; ?></option> -->
                    <option value="female" align="center">Female</option>
                    <option value="male" align="center">Male</option>
                    <option value="other" align="center">Other</option>
                </select> 
                
                <div class="btns">
                    <div class="save">
                        <input type="submit" class="save-btn" value="Save" name="Submit">
                    </div>
                    <div class="cancel">
                    <a  href="edit-profile.php" class="cancel-btn" >Cancel</a>
                    </div>
                </div>
            </form>
            </div>
        </div>
        <hr class="acc">
        <div class="account-details">
            <h3 style="text-align: left; margin-left: 20px; padding-top: 2%;">Account Details</h3>
            <div class="form-account">
            <form method="POST" action="" enctype="multipart/form-data">
            <span class="label acc">Username</span> <input type="text" name="username" placeholder="<?php echo $username; ?>" class="un change"><br>
            <h4> Change Password </h4>
            <input type="password" name="old" placeholder="Old Password" class="un change"><br><br>
            <input type="password" name="newpass" placeholder="New Password" class="un change"><br><br>
            <input type="password" name="conpass" placeholder="Confirm Password" class="un change"><br><br>
            
       

            <div class="btns">
                <div class="save">
                        <input type="submit" class="save-btn" value="Save" name="AccountSubmit">
                </div>
                <div class="cancel">
                    <a href="edit-profile.php" class="cancel-btn" >Cancel</a>
                </div>
            </div>
            </form>
            </div>
        </div>
        </form>
        
        <!-- <hr> -->

        <!-- <div class="deactivate">
            <p class="deactive-p"> <span style="font-weight: bold;"> Deactivate your account</span><br>
                Details about your company account and password</p>
            <button class="deactive-btn">Deactivate</button>
        </div> -->


    </div>

</body>
</html>


<?php

if($_POST['Submit']){
    $upname=$_POST['name'];
    $upgen=$_POST['gender'];
    $upphone=$_POST['phone'];
    $upemail=$_POST['email'];

  
    if( $upname && !preg_match("/^[a-zA-Z ]*$/", $name)){
        echo "<script> alert('Name should contain only alphabets')</script>";
    }
    if($upemail && !preg_match('/^[a-zA-Z0-9+_.-]+@[a-zA-Z0-9.-]+$/',$email)){
        $emailErr= "Email should contain proper format eg. abc@xyz.com";
            echo "<script> alert('".$emailErr."')</script>";
    }
    if($upphone && !preg_match('/^\d{10}$/',$phone )){
        $phoneErr= "Phone number should contain 10 digits";
        echo "<script> alert('".$phoneErr."')</script>";
    }

    $qn=$dn=$qp=$dp=$qe=$de=$qg=$dg=NULL;

    if($upname!=""){
    $qn = "update users set name='$upname' where user_id='$uid'";
    $dn = mysqli_query($con, $qn);
    
    }
    if($upemail!=""){
    $qe = "update users set email='$upemail' where user_id='$uid'";
    $de = mysqli_query($con, $qe);
    }
    if($upphone!=""){
    $qp = "update users set phone='$upphone' where user_id='$uid'";
    $dp = mysqli_query($con, $qp);
    }
    if($upgen!=""){
    $qg = "update users set gender='$upgen' where user_id='$uid'";
    $dg = mysqli_query($con, $qg);
    }
    if($dn || $de || $dg || $dp){
       // echo '<script>alert("Profile Updated")</script>';
        header("Location: edit-profile.php");
          die;
    }
    
    else{
        echo "<script>alert('Profile Not Updated')</script>";
    }
}


if($_POST['AccountSubmit']){
    
      $upuser_name=$_POST['username'];
      $upnewpassword=$_POST['newpass'];
      $oldpassword=$_POST['old'];
      $conpassword=$_POST['conpass'];

      
      if($oldpassword && $upnewpassword  && $conpassword){

            if($pass != $oldpassword){
                echo "<script> alert('Old Password is wrong!!') </script>";
                // header("Location: edit-profile.php");
                // die;
            }

            else if($upnewpassword!= $conpassword){
                echo "<script> alert(' New Password and Confirm Password are not same!!') </script>";
                // header("Location: edit-profile.php");
                // die;
            }
            else if(!preg_match('/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[*.!@$%^&]).{5,7}$/',$upnewpassword )){
                $passErr= "Password should be of length 5-7 with atleast one Uppercase, Lowercase, Digit and special character";
                echo "<script> alert('".$passErr."')</script>";
           }
           else{
                $qn=$dn=$qe=$de=NULL;
    
                if($upuser_name!=""){
                $qn = "update users set user_name='$upuser_name' where user_id='$uid'";
                $dn = mysqli_query($con, $qn);
                
                }
                if($upnewpassword!=""){
            
                $qe = "update users set password='$upnewpassword' where user_id='$uid'";
                $de = mysqli_query($con, $qe);
                }
                
            
                if($dn || $de){
                echo '<script>alert("Profile Updated")</script>';
                //   header("Location: edit-profile.php");
                //   die;
                }
            
                else{
                    echo "<script>alert('Profile Not Updated')</script>";
                }
           }
      }
      else if($oldpassword!="" || $upnewpassword!=""  || $conpassword!=""){
        echo "<script> alert('All Password field must be filled!!') </script>";
            // header("Location: edit-profile.php");
            // die;
      }
  }
  

?>
