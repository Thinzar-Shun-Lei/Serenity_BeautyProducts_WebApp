<?php
session_start();
include('connection.php');

$categoryID = $_GET['categoryID'];

$Delete = "DELETE FROM Categories WHERE CategoryID = '$categoryID'";
$ret = mysqli_query($connection,$Delete);

if($ret) {
    echo "<script>window.alert('Category is successfully deleted')</script>";
    echo "<script>window.location='Categories.php'</script>";
}
else {
    echo "<script>window.alert('Something is wrong with deleting Category. Please try again.')</script>";
    echo "<script>window.location='Categories.php'</script>";   
}
?>