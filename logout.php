<?php
session_start();
$expire = time() -86400;
setcookie('portal', $_SESSION['username'], $expire);
session_unset();
session_destroy();
header("Location: Login.php");
die();
?>
