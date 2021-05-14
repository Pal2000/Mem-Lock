<?php
session_start();

include("connection.php");
include("functions.php");
error_reporting(0);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
    <link rel="stylesheet" href="css/addstory_style.css">
    <link rel="stylesheet" href="css/stylehome.css">
	<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN"
        crossorigin="anonymous">
    
    <title>Mem-Lock</title>
</head>
<body>
    <div class="container">
		<div class="navbar">
			<div class="logo">Mem-Lock </div>
				<nav>
					<ul>
						<li>
						<a href="logout.php"> Logout </a>
						</li>
						<li>
						<a href="edit-profile.php"> Profile </a>
						</li>
                        <li>
						<a href="mystories.php"> My Memories </a>
						</li>
						<li>
							<a href="home.php">Home</a>
						</li>
						
					</ul>
				</nav>
			</div>
		</div>

		<div class="content">
            
        <div class="header">
            <h2> Add New Memory</h2>
        </div>

            <form method="POST" action="" enctype="multipart/form-data">
                <input type="text" name="title" value="" placeholder="Enter Title"><br><br>
                <input type="text" name="desc" value="" placeholder="Enter Description" ><br><br>
                <div class="upload-btn-wrapper">
                    <button class="btn">Upload a file</button>
                    <input type="file" name="file">
                </div>
                <i> <p> Upload only .jpg, .jpeg, .png image file with size less than 5MB.</p></i>
                <br><br>
                <input type="submit" name="Submit" value="Add">
            </form>
        </div>
		
    </div>
</body>
</html>


<?php
if($_POST['Submit']){
   
    $t = $_POST['title'];
    $d = $_POST['desc'];

    // fetch id of user
    $id=$_SESSION['user_id'];
    
    $query="select * from users where user_id='$id' limit 1";
    $result=mysqli_query($con, $query);
    if($result && mysqli_num_rows($result)>0){
        $user_data=mysqli_fetch_assoc($result);
        
    }
    $uid=$user_data['id'];

    // echo "id= ".$uid."<br>";
    
    move_uploaded_file($_FILES['file']['tmp_name'], "images/". $_FILES['file']['name']);
    $im = "images/". $_FILES['file']['name'];

    // echo "pp= ".$im."<br>";
    if($t!="" && $d!=""){
        // insertion is done here
        $query = "insert into stories (title,description,image,id) VALUES ('$t', '$d', '$im','$uid')";
        $data = mysqli_query($con, $query);
        if($data){
            echo '<script>alert("Memory is Added")</script>';
        }
        else{
            echo "<script>alert('problem')</script>";
        }
    }
    else{
        echo "<script>alert('All fields are required')</script>";
    }
}
?>