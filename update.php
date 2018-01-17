<?php
include("conn.php");

$event = $_GET['event'];
$time = $_GET['time'];
$id= $_GET['id'];

if ($event && $time && $id ) {


    $sql= "UPDATE  todo  SET event='$event' , the_time='$time' WHERE event_id='$id'";
    $result=mysqli_query($link, $sql);
    if ($result){
        echo "reload";
    }


} else {
    echo "you need to enter both fields";


}



?>




