<?php
include("conn.php");

$event = $_POST['event'];

$time = $_POST['time'];


if ($event && $time) {


    $sql = "INSERT INTO todo(event, the_time) VALUES ('$event ', '$time')";

    $result=mysqli_query($link, $sql);
    if ($result){
        echo "reload";
    }


} else {
    echo "you need to enter both fields";



}



?>