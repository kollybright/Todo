<?php
session_start();
$id=$_SESSION['id'];
include("conn.php");

$event = mysqli_real_escape_string($link, strip_tags($_POST['event']));

$time =  mysqli_real_escape_string($link,strip_tags($_POST['time']));


if ($event && $time) {


    $sql = "INSERT INTO todo(event, the_time,user_id) VALUES ('$event ', '$time','".$id."')";

    $result=mysqli_query($link, $sql);
    if ($result){
        echo "reload";
    }

}



?>