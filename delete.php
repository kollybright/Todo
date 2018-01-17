<?php
session_start();
$user_id=$_SESSION['id'];
/**
 * Created by PhpStorm.
 * User: Kollybright
 * Date: 11/21/2017
 * Time: 1:26 PM
 */


include("conn.php");

$id=$_POST['the'];
if ($id){

    $sql= "DELETE FROM  todo WHERE event_id='".$id."'  AND user_id='".$user_id."'" ;
     $query = mysqli_query($link,$sql);
     if ($query){
         echo "reload";
     }
}
?>