<?php
include('connection.php');
// error_reporting(0);
$id=$_GET['rn'];
$query = "DELETE FROM STORIES WHERE story_id=$id";
$data = mysqli_query($con, $query);
if($data){
    echo "<script>alert('Memory Deleted')</script> ";
    // now go back to display page using meta tag 
    ?>
    
    <META HTTP-EQUIV="Refresh" CONTENT="0; URL=http://localhost:8080/my_story_book/mystories.php">

    <?php

} else{
    echo "<font color='red'> Story Not Deleted";
}

?>