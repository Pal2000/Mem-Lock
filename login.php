<?php
session_start();
include("connection.php");
include("functions.php");

if($_SERVER['REQUEST_METHOD']=="POST"){
  // something was posted
  $user_name=$_POST['username'];
  $password=$_POST['password'];
  if(!empty($user_name) && !empty($password)){
    // read from db
    
    $query="select * from users where user_name='$user_name' limit 1";
    $result=mysqli_query($con, $query);

    if($result){
      if($result && mysqli_num_rows($result)>0){
        $user_data=mysqli_fetch_assoc($result);
        if($user_data['password']==$password){
          $_SESSION['user_id']=$user_data['user_id'];
          header("Location: home.php");
          die;
        }
      }
    }
    echo "<h4>wrong username and password </h4>";
    header("Location: login.php");
    die;

  } else{
    echo "<h4>wrong username and password </h4>";
    header("Location: login.php");
    die;
  }
}

?>


<html>
<head>
  <link rel="stylesheet" href="css/loginstyle.css">
  <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <!-- <link rel="stylesheet" href="css/style.css"> -->
  <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
  <title>Mem-Lock</title>
</head>

<body>
<div>

  <div class="main">
    <p class="sign" align="center">Login</p>
    <form class="form1" method="POST">
      <input class="un "  name="username" type="text" align="center" placeholder="Username">
      <input class="pass" name="password" type="password" align="center" placeholder="Password"> <br>
      <input type="submit" class="submit" align="center" value="Sign in">
      <p class="forgot" align="center"><a href="forgetpassword.php">Forgot Password?</p>
      <p class="forget" align="center"><a href="signup.php">Don't have Account? Create New Account</a></p>
    </form>         
  </div>
</div>
</body>

</html>