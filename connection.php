<?php
$dbhost="localhost";
$dbuser="root";
$dbpass="";
$dbname="story_book";
$con=mysqli_connect($dbhost,$dbuser, $dbpass, $dbname);
if($con){
    ;
}
else{
    echo "Connection Failed ";
    die(mysqli_connect_error()); // to display reason for failed connection
}

?>