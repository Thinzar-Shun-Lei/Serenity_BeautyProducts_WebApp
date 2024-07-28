<?php
session_start();
include('connection.php');


    if(isset($_REQUEST['orderID'])) {
        $orderid = $_REQUEST['orderID'];
        $query = "UPDATE Orders 
                  SET OrderStatus = 'Confirmed'
                  WHERE OrderID = '$orderid'";
        $ret = mysqli_query($connection,$query);
        if($ret) {
            echo "<script>alert('The order has been confirmed.')</script>";
            echo "<script>window.location='Orders_Display.php'</script>";
        }
    }
?>