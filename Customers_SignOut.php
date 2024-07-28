<?php
session_start();
include('connection.php');

$sessionDestroy = session_destroy();

if($sessionDestroy) {
    echo "<script>window.alert('You have successfully logged out.')</script>";
    echo "<script>window.location = 'Customers_SignIn.php' </script>";
}
else {
    echo "<script>window.alert('Please Reload the page')</script>";
}
?>