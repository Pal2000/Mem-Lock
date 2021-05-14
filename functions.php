<?php
function check_login($con){
    if(isset($_SESSION['user_id'])){
        $id=$_SESSION['user_id'];
        $query="select * from users where user_id='$id' limit 1";
        $result=mysqli_query($con, $query);
        if($result && mysqli_num_rows($result)>0){
            $user_data=mysqli_fetch_assoc($result);
            return $user_data;
        }
        else{
            return "";
        }
    }

    // redirect to login
    else{
    // header("Location: home.php");
    // die;
    return "";
    }
}

function random_num($length){
    $text="";
    
    $len=rand(4, $length);
    for($i=0; $i<$len;$i++){
        $text.=rand(0,9);
    }
    return $text;
}

function check_story($con, $uid){
    $query="select * from stories where id=$uid";
    $result=mysqli_query($con, $query);
    if($result && mysqli_num_rows($result)>0){
        //$user_data=mysqli_fetch_assoc($result);
        //return $user_data;
        return $result;
    }
    else{
        return "";
    }
}

// function test_input($value)
// {
// $value = trim($value);
// $value = stripslashes($value);
// return $value;
// }


?>