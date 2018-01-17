<?php
session_start();
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
<!--    <link rel="stylesheet" type="text/css" href="style.css">-->
    <script src="jquery-3.2.1.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <style>
        body{
            height: 100%;
            width: 100%;
            margin: 0 auto;
            background:grey;
            color: #ffffff;

        }
        .container{
            margin-top: 2.5em;
            height: auto;
            width: auto;
        }


        #butn{
            color: red;
            font-size: 17px;

        }
        a:hover{
            color: cyan;
        }
        #php{
            color: red;
            font-size: 21px;
        }


    </style>
    </head>

<body>
<div class="container">
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
    <h1>Login| <a href="register.php" style="font-size: 25px">Register Now</a></h1>
    <div class="form-group">
        <div class="row">
         <div class="col-sm-4">
        <label for="username" class="form-">Username:</label>
        <input type="text" class="form-control" name="username" value="<?php if (isset($_COOKIE['username'])){echo $_COOKIE['username']; }?>">
         </div>
         </div>
        </div>
    <div class="form-group">
        <div class="row">
            <div class="col-sm-4">
    <label for="password" class="form-">Password:</label>
    <input type="password" class="form-control col-sm-6" name="password" value="<?php  if (isset($_COOKIE['password'])){echo $_COOKIE['password']; }?>">
    </div>
        </div>
        <br>
        <input type="checkbox" name="rem" <?php if (isset($_COOKIE['username'])&& isset($_COOKIE['password'])){ echo "checked";}?>> Remember me
        <br>


    </div>



    <div class="form-group" id="butn">
    <input type="submit" class="btn btn-lg btn-success" value="Login" name="login">


    </div>

    </form>
    <div id="php">


        <?php

        if(isset($_POST['login'])){

            $_SESSION['username'] = $_POST['username'];
            $_SESSION['password'] = $_POST['password'];

            if($_SESSION['username'] && $_SESSION['password']){

                $link =mysqli_connect("localhost", "root", "","Todo") or die("problem with connection...");

                $query = mysqli_query($link,"SELECT * FROM reg_users WHERE username='".$_SESSION['username']."' ");
                $numrows = mysqli_num_rows($query);

                if($numrows != 0){

                    while($row = mysqli_fetch_assoc($query)){

                        $dbname = $row['username'];
                        $dbpassword = $row['password'];
                        $user_id=$row['user_id'];
                        $_SESSION['id']=$user_id;
                    }
                    if($_SESSION['username']==$dbname){
                        if(md5($_SESSION['password'])==$dbpassword){
                            if(!empty($_POST["rem"])) {
                                setcookie ("username",$_POST["username"],time()+ (10 * 365 * 24 * 60 * 60));
                                setcookie ("password",$_POST["password"],time()+ (10 * 365 * 24 * 60 * 60));
                            } else {
                                if(isset($_COOKIE["username"])) {
                                    setcookie ("username","");
                                }
                                if(isset($_COOKIE["password"])) {
                                    setcookie ("password","");
                                }
                            }
                            echo "<script>window.open('index.php','_self')</script>";



                        }else{
                            echo "Your password is incorrect!";
                        }
                    }

                }else{
                    echo "Username doesn't exist!";
                }

            }else{
                echo "Pls,enter both fields";

            }
        }

        ?>
    </div>

    </div>


</body>
</html>