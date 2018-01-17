
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
    <script src='https://www.google.com/recaptcha/api.js'></script>


    <style>
        body{
            height: 100%;
            width: 100%;
            margin: 0 auto;
            background:grey;
            color: #ffffff;

        }

        .container{
            margin-top: 1.5em;
            margin-left: 30px;
            height: auto;
            width: auto;
        }
        #php{
            color: red;
            font-size: 19px;
        }
        a:hover{
            color:cyan;
        }



    </style>
</head>

<body>
<div class="container">
<form id="form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
        <div class="form-group">
          <h1>REGISTER|<a href="Login.php" style="font-size: 19px">Already Registered?</a></h1>

            <div class="row">
                <div class="col-sm-4">
                    <hr>
                    <label for="username" class="form-">Username:</label>
                    <input type="text" class="form-control" name="username" id="username" onkeyup="register()">
                </div>

            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-sm-4">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" name="email"  id="email">
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-sm-4">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" name="password" id="password">
                </div>
            </div>
            </div>


        <div class="form-group">
            <div class="row">
                <div class="col-sm-4">
                    <label for="cpassword">Confirm Password:</label>
                    <input type="password" class="form-control" name="cpassword" id="cpassword">
                </div>
            </div>
        </div>
        <div class="g-recaptcha" data-sitekey="6LdXR0AUAAAAACmw0v5RI8ZjWyTuJyCY9hAaI8iV"></div><br>
        <div class="form-group" >
            <input type="submit" class="btn btn-lg btn-success" value="Submit" id="submit" name="submit">
        </div>
        </form>
        <div id="php">
            <?php
            /**
             * Created by PhpStorm.
             * User: Kollybright
             * Date: 12/21/2017
             * Time: 1:12 PM
             */
            $con= new mysqli('localhost','root','','Todo');

            if(isset($_POST['submit'])) {
                $username = $con->real_escape_string(strip_tags($_POST['username']));
                $email = $con->real_escape_string(strip_tags($_POST['email']));
                $password = $con->real_escape_string(strip_tags($_POST['password']));
                $cpassword = $con->real_escape_string(strip_tags($_POST['cpassword']));
                $recaptcha = $_POST['g-recaptcha-response'];
                if ($username && $email && $password && $recaptcha) {
                    if (strlen($username) > 4) {
                        if ($password == $cpassword) {
                            if (strlen($password)>4) {
                                $sql = "SELECT * FROM reg_users WHERE username='".$username."'";
                                $s = $con->query($sql);
                                $count = $s->num_rows;
                                if ($count != 0) {
                                    echo "User name already exits";
                                } else {
                                    $pass=md5($password);
                                    $stm = $con->prepare("INSERT INTO reg_users(email, username, password) VALUES(?,?,?)");
                                    $stm->bind_param('sss',$email,$username, $pass);
                                    $ex = $stm->execute();


                                    if ($ex) {
                                        header("Location: login.php");
                                        exit;
                                    }
                                }
                            }
                            else{
                                echo "Your password must be greater than 4 characters";
                            }

                        }
                        else{
                            echo "Your passwords doesn't match";

                        }

                    }
                    else{

                        echo "Your username must be greater than 4 characters";

                    }
                }else{
                    echo "please enter all the fields including the reCAPTCHA";
                }
            }

            ?>
        </div>

    </div>
</body>
</html>
