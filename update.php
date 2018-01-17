<?php
session_start();
$user_id=$_SESSION['id'];
include("conn.php");

$event = mysqli_real_escape_string($link, strip_tags($_GET['event']));

$time =  mysqli_real_escape_string($link,strip_tags($_GET['time']));;
$id= mysqli_real_escape_string($link,$_GET['id']);

if ($event && $time && $id ) {


    $sql= "UPDATE  todo  SET event='$event' , the_time='$time' WHERE event_id='".$id."' AND user_id='".$user_id."' ";
    $result=mysqli_query($link, $sql);
    if ($result){
        echo "reload";
    }
}



?>




