<?php
session_start();
 include("connection.php");
// include("stories_connection.php");
include("functions.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
    <link rel="stylesheet" href="css/stylehome.css">
	<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN"
        crossorigin="anonymous">
    
    <title>Mem-Lock</title>
</head>
<body>
    <div class="container">
		<div class="navbar">
			<div class="logo">Mem-Lock</div>
				<nav>
					<ul>
						<li>
						<a href="logout.php"> Logout </a>
						</li>
						<li>
						<a href="edit-profile.php"> Profile </a>
						</li>
						<li>
							<a href="home.php">Home</a>
						</li>
						
					</ul>
				</nav>
			</div>
		</div>

		<div class="add_story_div">
			<div  class="add_story">
				<a href="addstory.php"> <img src="https://img.icons8.com/pastel-glyph/36/000000/plus.png"/></a>
				<p><a href="addstory.php">Add Memory </a></p>
			</div>
		</div>

		<div>
			<?php
				// fetch id of user
				$id=$_SESSION['user_id'];
				$query="select * from users where user_id='$id' limit 1";
				$result=mysqli_query($con, $query);
				if($result && mysqli_num_rows($result)>0){
					$user_data=mysqli_fetch_assoc($result);
					
				}
				$uid=$user_data['id'];

				

				$user_data=check_story($con, $uid);
				if(empty($user_data)){
					echo "<h2> No Story Found </h2>";
				}
				else{
					echo "<div class='container-card'>";
					while($res=mysqli_fetch_assoc($user_data)){
						$id=$res['story_id'];
						$title=$res['title'];
						$des=$res['description'];
						$image=$res['image'];
						echo " 
							<div class='card'>
								<div class='face face1'>
									<div class='content'>
										<div class='icon'>
											<img src='".$image."' alt='' class='mem-pic'>
										</div>
									</div>
								</div>
								<div class='face face2'>
									<div class='content'>
										<h3>
											<p>".$title."</p>
										</h3>
										<p>".$des."</p>
										<div class='deleteicon'>
										<a href='Deletestory.php?rn=$id' onclick='return confirmDelete()' class='trash'><i class='fa fa-trash' style='color:red; font-size:28px;'></i></a>
										</div>
									</div>
									
								</div>
							</div>
						";

					}
					echo "</div>";
				}
			?>
		</div>
		
    </div>


<script>

function confirmDelete(){
    return  confirm("Are you sure to delete this memory??");
}
    
</script>
</body>
</html>