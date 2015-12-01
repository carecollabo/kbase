<?php
session_start();
unset($_SESSION['user']);
unset($_SESSION['permission']);
unset($_SESSION['status']);
session_destroy();
header("location:login.php");
?>
