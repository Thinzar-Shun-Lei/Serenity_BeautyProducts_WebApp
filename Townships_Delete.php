<?php
session_start();
include('connection.php');

$townshipID = $_GET['TownshipID'];

$Delete = "DELETE FROM Townships WHERE TownshipID = '$townshipID'";
$ret = mysqli_query($connection,$Delete);

if($ret) {
    echo "<script>window.alert('Township is successfully deleted')</script>";
    echo "<script>window.location='Townships.php'</script>";
}
else {
    echo "<script>window.alert('Something is wrong with deleting the Township. Please try again.')</script>";
    echo "<script>window.location='Townships.php'</script>";   
}
?>