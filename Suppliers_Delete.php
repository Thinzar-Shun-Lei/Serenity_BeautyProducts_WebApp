<?php
session_start();
include('connection.php');

$supplierID = $_GET['SupplierID'];

$Delete = "DELETE FROM Suppliers WHERE SupplierID = '$supplierID'";
$ret = mysqli_query($connection,$Delete);

if($ret) {
    echo "<script>window.alert('Suppliers is successfully deleted')</script>";
    echo "<script>window.location='Suppliers.php'</script>";
}
else {
    echo "<script>window.alert('Something is wrong with deleting Suppliers. Please try again.')</script>";
    echo "<script>window.location='Suppliers.php'</script>";   
}
?>