<?php
session_start();
if(empty($_SESSION['username'])){
    header("Location:Login.php");
    exit;
}
include ("conn.php");
$id=$_SESSION['id'];
$user=$_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <!--    <meta http-equiv="refresh" content="10">-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="jquery-3.2.1.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="transport.js"> </script>
</head>
<body>
<header><a href="logout.php" class="btn btn-primary btn-md" role="button" style="float: left">Logout</a><h1 id="top">Todo List</h1></header>

<p style="color:midnightblue;font-size: 22px">Welcome,  <?php echo $user ?>!</p>

<section>

    <div id="input">
<form id="form1">
        <input type="text" id="event" name="event" size="20em" placeholder="What Todo?"><input type="time" id="time"  name="time" style="margin-top:9px;">
        <button class="close" style="color:red; font-size: 40px">&times;</button><br>
        <span id="error" style="font-size: 1.3em"></span><br/>
        <button type="button"  id="add" name="add"  class="btn btn-lg btn-danger"">Add event</button>
        <button type="button"  id="up" name="up" class="btn btn-lg btn-danger"  onclick="update()" >Update event</button>

</form>

        </div>
    <div class="container">
        <div class="panel-group">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <?php
                    $s=" SElECT * FROM todo WHERE user_id='".$id."'";
                    $q=mysqli_query($link,$s);
                    if(mysqli_num_rows($q)==0){
                       ?>
                        <h4>It seems your events list is empty, you can add events.&nbsp;&nbsp;  click the blue <span style="color: blue; font-size:larger">+</span> icon below</h4>
                    <?php
                    }
                    else{
                       ?>
                        <h4>You can add more events</h4>
                    <?php
                    }
                    ?>

                </div>
                <div class="panel-body panel-body">
                    <form method="post">
                        <table class="table table-responsive table-striped table-bordered">
                            <tbody>
                            <?php
                            while ($row= mysqli_fetch_assoc($q)) {
                                $db_event = $row['event'];
                                $db_time = $row['the_time'];
                                $id=$row['event_id'];
                                ?>
                                <tr>
                                    <td><button type="button" class="edit" name="update" data-toggle="tooltip" title="Update '<?php echo $db_event;?>'?">
                                            <input type="hidden" name="id" value="<?php echo $id?>">
                                            <input type="hidden" name="db_event"  value="<?php echo $db_event?>">
                                            <input type="hidden" name="db_time"  value="<?php echo $db_time?>">
                                            <span class="glyphicon glyphicon-edit" style="color: green"></span>
                                        </button>
                                    </td>
                                    <td><?php echo $db_event."&nbsp;&nbsp;"."<span class='glyphicon glyphicon-time'> ".$db_time ?>
                                    </td>
                                    <td><button  type="submit"  name="delete" data-toggle="tooltip" title="You are about to delete '<?php echo $db_event;?>' ">
                                            <input type="hidden" name="id" value="<?php echo $id?>">
                                            <span class="glyphicon glyphicon-remove-sign" style="color: red"></span>
                                        </button>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                            </tbody>
                        </table>
                    </form>
                    <span class="glyphicon glyphicon-plus" id="plus"data-toggle="tooltip" title="Add new events"></span>
                </div>
                <div class="panel-footer">
                    <?php
                    $start= 2017;
                    $year=0;
                    if (date("Y")>$start){
                        $year=$start."-".date("Y");
                    }
                    else {
                        $year=$start;
                    }
                    ?>
                    &copy; Kollybright <?php echo $year?>
                </div>
            </div>
        </div>
</section>
<script>
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>
</body>
</html>
