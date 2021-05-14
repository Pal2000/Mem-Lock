<?php
session_start();
include("connection.php");
include("functions.php");
error_reporting(0);

if($_SERVER['REQUEST_METHOD']=="POST"){
  // something was posted
  $user_name=$_POST['username'];
  $password=$_POST['password'];
  $name=$_POST['Name'];
  $gen=$_POST['gender'];
  $phone=$_POST['phone'];
  $email=$_POST['email'];

  //$username=$usernameErr = $genErr = $nameErr = $passErr = $name2 = $pass = $emailAdd = $phoneNo = $emailErr = $phoneErr = "";
  if(empty($_POST['Name']) || empty($_POST['gender']) || empty($_POST['username']) || empty($_POST['password']) || empty($_POST['phone']) || empty($_POST['email']))
  {
      echo "<script> alert('All fields are required')</script>";
  }
  else if(!empty($user_name) && !empty($password) && !empty($name) && !empty($email) && !empty($phone) && !empty($gen)){
    if(!preg_match("/^[a-zA-Z ]*$/", $name)){
      echo "<script> alert('Name should contain only alphabets')</script>";
    }

    if(!preg_match('/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[*.!@$%^&]).{5,7}$/',$password )){
      $passErr= "Password should be of length 5-7 with atleast one Uppercase, Lowercase, Digit and special character";
      echo "<script> alert('".$passErr."')</script>";
    }

    if(!preg_match('/^[a-zA-Z0-9+_.-]+@[a-zA-Z0-9.-]+$/',$email)){
      $emailErr= "Email should contain proper format eg. abc@xyz.com";
            echo "<script> alert('".$emailErr."')</script>";
    }
    if(!preg_match('/^\d{10}$/',$phone )){
      $phoneErr= "Phone number should contain 10 digits";
      echo "<script> alert('".$phoneErr."')</script>";
    }

  if(!empty($user_name) && !empty($password) && !empty($name) && !empty($email) && !empty($phone) && !empty($gen)){

    //check duplicate email
      $query2="select * from users where email='$email'";
      $result=mysqli_query($con, $query2);
      if($result && mysqli_num_rows($result)>0){
        echo "<script> alert('Account already exists'); </script>";
  
      }
      else{
            // save to db
        $user_id=random_num(5);
        $query="insert into users (user_id, user_name, password, name, gender, phone, email) values ('$user_id', '$user_name', '$password','$name','$gen','$phone','$email')";
        mysqli_query($con, $query);
        echo "<script> alert('Account created successfully!!')</script>";
        header("Location: login.php");
        die;
      }
    } else{
      echo "<script>alert('Some Error occurred')</script>";
      // header("Location: signup.php");
      // die;
    }
}
}

?>

<html>
<head>
  <link rel="stylesheet" href="css/signupstyle.css">
  <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <!-- <link rel="stylesheet" href="css/home.css"> -->
  <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
  <title>Mem-Lock</title>
</head>
<body>
<div>
  <!-- <nav>
    <ul>
      <li id="logo">toonindia</li>
      <li class="nav"><a href="about.php">About</a></li>
      <li class="nav" id="active"><a href="signup.php">Signup</a></li>
      <li class="nav"><a href="index.php">Home</a></li>
    </ul>
  </nav> -->
  <div class="main">
    <p class="sign" align="center">Sign up</p>
    <form class="form1" method="POST"  action="<?php echo $_SERVER['PHP_SELF'] ?>">
        <input class="un " type="text" align="center" placeholder="Name" name="Name">
        <input class="un " name="username" type="text" align="center" placeholder="Username">
        <select name="gender" id="gender" class="un" align="center" style="padding-left: 30%;">
            <option value="gender" disabled selected align="center">Gender</option>
            <option value="male" align="center">Male</option>
            <option value="female" align="center">Female</option>
            <option value="other" align="center">Other</option>
        </select>
        <input class="un" type="tel" align="center" placeholder="Phone" name="phone">
        <input class="un " type="text" align="center" placeholder="Email" name="email">
        <input class="pass" name="password" type="password" align="center" placeholder="Password" >
        <!-- <input class="pass" name="cpassword" type="password" align="center" placeholder="Confirm Password"> -->
        <input type="submit" class="submit" align="center" value="Sign Up">
        <p class="forgot" align="center"><a href="login.php">Already have an account?</p>
    </form>         
  </div>
</div>
</body>
</html>