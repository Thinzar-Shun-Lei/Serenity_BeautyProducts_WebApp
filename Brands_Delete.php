<?php
session_start();
include('connection.php');

$brandID = $_GET['BrandID'];

$Delete = "DELETE FROM Brands WHERE BrandID = '$brandID'";
$ret = mysqli_query($connection,$Delete);

if($ret) {
    echo "<script>window.alert('Brands is successfully deleted')</script>";
    echo "<script>window.location='Brands.php'</script>";
}
else {
    echo "<script>window.alert('Something is wrong with deleting Brands. Please try again.')</script>";
    echo "<script>window.location='Brands.php'</script>";   
}
?>