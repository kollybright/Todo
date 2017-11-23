<?php

include ("conn.php");

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <!--[if lt IE 9]>
    <script src="/js/html5shiv.js"></script>
    <![endif]-->
    <!--    <meta http-equiv="refresh" content="10">-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css"/>
    <script src="jquery-3.2.1.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>

    <script src="transport.js"> </script>


    <style>
        body{
            width: 100%;
            height: 100%;
        }
        header{
            height: 4em;
            background-color: black;
            color: white;
            font-family: algiers;
            text-align: center;
            border:  1px solid black;
        }
        #top{
            margin-top: 3px;
        }
        section{
            margin: 1em;
        }
        #event,#time{
            height: 2.5em;
        }
        #input{
            height: 3em;
            width: 100%;
            text-align: center;

        }
        .panel-group{
            margin: 1em;
        }


        .panel-footer{
            text-align: center;
        }


        .container{
            margin-top: 5em;
            height: auto;
            width: auto;
        }

        .btn{
            background-color: black;
            color: #ffffff;
        }

        .btn:active{
            background-color: red;
            color: #ffffff;
        }
        .btn:hover{
            background-color: red;
            color: #ffffff;
        }
        .btn:visited{
            background-color: red;
        }
        #error{
            color: red;
        }
        .table tr {
            width: 100%;
        }
        .table tbody tr td:nth-child(1){
            float: left;
        }
        .table tbody tr td:nth-child(2){
            text-align:center;
            color: green;
            font-size: large;


        }
        .table tbody tr td:nth-child(3){
            float: right;

        }
        .table tbody tr td{
            color:;
        }

        #plus{
            float: right;
            color: blue;
        }




    </style>
</head>
<body>
<header><h1 id="top">Todo List</h1></header>
<section>
    <div id="input">

<form id="form1">
        <input type="text" id="event" name="event"  size="50em" placeholder="What Todo?"> <input type="time" id="time"  name="time" style="margin-top:9px;">
        <span id="error"></span> <br/>
        <button type="button"  id="add" name="add"  class="btn btn-lg">Add event</button>
        <button type="button"  id="up" name="up" class="btn btn-lg"  onclick="update()" >Update event</button>
</form>



    </div>
    <div class="container">
        <div class="panel-group">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <?php
                    $s=" SElECT * FROM todo";
                    $q=mysqli_query($link,$s);
                    if(mysqli_num_rows($q)==0){
                       ?>
                        <h4>It seems your events list is empty, you can add events.&nbsp;&nbsp;  click the blue <span style="color: blue; font-size:larger">+</span> icon</h4>
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
                        <table class="table table-responsive table-striped">
                            <tbody>

                            <?php
                            $query= "SElECT * FROM  todo";
                            $res= mysqli_query($link,$query);
                            while ($row= mysqli_fetch_assoc($res)) {
                                $db_event = $row['event'];
                                $db_time = $row['the_time'];
                                $id=$row['event_id'];


                                ?>
                                <tr>

                                    <td><button type="button" class="edit" name="update">
                                            <input type="hidden" name="id" value="<?php echo $id?>">
                                            <input type="hidden" name="db_event"  value="<?php echo $db_event?>">
                                            <input type="hidden" name="db_time"  value="<?php echo $db_time?>">

                                            <span class="glyphicon glyphicon-edit" style="color: green"></span>
                                        </button></td>

                                    <td><?php echo $db_event."&nbsp;&nbsp;"."<span class='glyphicon glyphicon-time'> ".$db_time ?>




                                    </td>


                                    <td><button  type="submit"  name="delete">
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

                    <span class="glyphicon glyphicon-plus" id="plus"></span>

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
                    &copy; <?php echo $year?>
                </div>
            </div>

        </div>




</section>
</body>
</html>
<script>
</script>