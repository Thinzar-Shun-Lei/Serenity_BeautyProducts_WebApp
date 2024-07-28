<?php
session_start();
include('connection.php');

$positionID = $_GET['PositionID'];

$Delete = "DELETE FROM Positions WHERE PositionID = '$positionID'";
$ret = mysqli_query($connection,$Delete);

if($ret) {
    echo "<script>window.alert('Position is successfully deleted')</script>";
    echo "<script>window.location='Positions.php'</script>";
}
else {
    echo "<script>window.alert('Something is wrong with deleting Position. Please try again.')</script>";
    echo "<script>window.location='Positions.php'</script>";   
}
?>