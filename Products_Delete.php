<?php
session_start();
include('connection.php');

$productID = $_GET['ProductID'];

$Delete = "DELETE FROM Products WHERE ProductID = '$productID'";
$ret = mysqli_query($connection,$Delete);

if($ret) {
    echo "<script>window.alert('Product is successfully deleted')</script>";
    echo "<script>window.location='Products.php'</script>";
}
else {
    echo "<script>window.alert('Something is wrong with deleting the Product. Please try again.')</script>";
    echo "<script>window.location='Products.php'</script>";   
}
?>