<?php
session_start();
include('connection.php');

$staffID = $_GET['StaffID'];

$Delete = "DELETE FROM Staff WHERE StaffID = '$staffID'";
$ret = mysqli_query($connection,$Delete);

if($ret) {
    echo "<script>window.alert('Staff is successfully deleted')</script>";
    echo "<script>window.location='Staff.php'</script>";
}
else {
    echo "<script>window.alert('Something is wrong with deleting Staff. Please try again.')</script>";
    echo "<script>window.location='Staff.php'</script>";   
}
?>